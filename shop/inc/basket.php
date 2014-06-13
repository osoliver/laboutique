<?PHP

function	aff_basket($link)
{
	echo '
		<div id="basket_form"><h2>Mon panier</h2>
		<div id="basket_form_2">';

	if (!isset($_SESSION['basket']))
		echo 'Panier vide !';
	else
	{
		$sum = 0;
		echo '<form method="POST">
		<table id="table_basket">
		<tr>
			<th>Nom</th>
			<th>Prix</th>
			<th>Quantite</th>
			<th>total</th>
			</tr>';
		foreach($_SESSION['basket'] as $product=>$quantity)
		{
			if ($quantity == 0)
				continue ;
			$query = "SELECT price FROM `product` WHERE name = '$product'";
			$res = mysqli_query($link, $query);
			$res_arr = mysqli_fetch_row($res);
			$price = $res_arr[0];
			$sum += $price * $quantity;
			echo '
		<tr>
			<td><div id="basket_prod_name">'.$product.'</div></td>
			<td><div id="basket_prod_price">'.$price.' EUR</div></td>
			<td><div id="basket_prod_quantity"><input type="text" name="q_'.
			str_replace(' ', '', $product).'" value="'.$quantity
			.'" /></div></td>
			<td><div id="basket_prod_total">'.($price * $quantity).' EUR</div></td>
		</tr>';
		
		}
		echo '
			<tr>
			<td colspan="4"><div id="basket_total">Total : '.$sum.' EUR</div></td>
		</tr>
		</table>
		<input type="submit" value="Valider" />
		</form>';
	}

	echo '
	</div>
	</div>';
}

function	aff_basket_succes()
{
	echo '<span class="register_ok">Commande confirmee</span>';
}

function	aff_basket_erreurc($str)
{
	echo '<span class="register_error">Erreur critique : '.$str.'</span>';
}

function	aff_basket_erreur($str)
{
	echo '<span class="register_error">Erreur : <br />'.$str.'<br />
		Veuillez reessayer.</span>';
}

function	basket($link, $login)
{
	global	$SUCCES;

	$sum = 0;
	foreach (array_keys($_SESSION['basket']) as $product)
	{
		$quantity = $_POST['q_'.str_replace(' ', '', $product)];
		if ($quantity <= 0)
			continue ;
		$query = "SELECT product_id, price, quantity FROM product WHERE
			name = '$product'";
		$res_raw = mysqli_query($link, $query);
		$res_arr = mysqli_fetch_row($res_raw);
		$values[$product]['product_id'] = $res_arr[0];
		$values[$product]['stock'] = $res_arr[2];
		if ($quantity > $res_arr[2])
			return (ret_err("Manque de stock, seulement ".intval($res_arr[2])." restants pour
			$product"));
		$sum += $quantity * $res_arr[1];
	}
	$query = "	INSERT INTO `command`(command_amount, date, client_id)
					SELECT $sum, ".time().", client.client_id
					FROM `client` WHERE client.login = '$login'";
	mysqli_query($link, $query);
	$command_id = mysqli_insert_id($link);
	foreach (array_keys($_SESSION['basket']) as $product)
	{
		$quantity = $_POST['q_'.str_replace(' ', '', $product)];
		$query = "INSERT INTO `history`(product_id, product_quantity, command_id)
					SELECT product.product_id, $quantity, $command_id
					FROM `product` WHERE product.name = '$product'";
		mysqli_query($link, $query);
		$query = "UPDATE `product` SET quantity = quantity - $quantity WHERE
			name = '$product'";
		mysqli_query($link, $query);
	}
	return ($SUCCES);
}

if (!isset($_POST) || empty($_POST))
	aff_basket($link);
else if (connexion_check($result) != $SUCCES)
	aff_basket_erreurc($chaine_erreur);
else if (!$result)
	aff_basket_erreur("vous devez etre connecte pour confirmer");
else
{
	$login = get_secured_value($_SESSION['login']);
	if (($ret = basket($link, $login)) != $SUCCES)
	{
		if ($ret == $ERREURC)
			aff_basket_erreurc($CHAINE_ERREUR);
		else if ($ret == $ERREUR)
		{
			aff_basket_erreur($CHAINE_ERREUR);
			aff_basket($link);
		}
	}
	else
	{
		$_SESSION['basket'] = array();
		unset($_SESSION['basket']);
		$_SESSION['basket-total'] = 0;
		aff_basket_succes();
	}
}
?>
