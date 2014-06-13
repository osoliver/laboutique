<?PHP
include_once("../controller/connexion_func.php");
connexion_check($result);
if ($result === FALSE)
	exit();
?>
<div id="account_form"><h2>Mon compte</h2>
<?PHP
$query = "SELECT * FROM `client` WHERE `login` = '".$_SESSION[login]."'";
$res = mysqli_query($link, $query);
$res_arr = mysqli_fetch_array($res);
echo '<div id="data_form_2"><ul>
	<li><label for="login">Login :</label><input type="text"
	name="login" value="'.$res_arr['login'].'"/></li>
	</ul>
	<h3>Personnel</h3>
	<ul>
	<li><label for="firstname">Prenom :</label><input type="text"
	name="firstname" value="'.$res_arr['firstname'].'" /></li>
	<li><label for="lastname">Nom :</label><input type="text"
	name="lastname" value="'.$res_arr['lastname'].'" /></li>
	<li><label for="email">Email :</label><input type="text"
	name="email" value="'.$res_arr['email'].'" /></li>
	</ul>
	<h3>Necessaire pour les commandes</h3>
	<ul>
	<li><label for="address">Adresse :</label><input type="text"
	name="address" value="'.$res_arr['address'].'" /></li>
	<li><label for="zipcode">Code Postal :</label><input type="text"
	name="zipcode" value="'.$res_arr['zipcode'].'" /></li>
	<li><label for="city">Ville :</label><input type="text"
	name="city" value="'.$res_arr['city'].'" /></li>
	</ul></div>';
?>
<div id="account_form_2">
<table id="table_account">
    <tr>
        <th>Numero de Commande</th>
        <th>Date</th>
        <th>Prix total</th>
        <th>Details</th>
    </tr>
     <?PHP
        date_default_timezone_set('Europe/Paris');
		$query = "	SELECT * FROM `command`
						INNER JOIN client on client.login = '".$_SESSION['login']."'
					WHERE command.client_id = client.client_id";
		$res = mysqli_query($link, $query);
        while ($res_arr = mysqli_fetch_array($res))
        {
            echo '    <tr>
        <td><div id="basket_prod_name">'.$res_arr['command_id'].'</div></td>
        <td><div id="basket_prod_price">'.date("Y-m-d H:i:s",$res_arr['date']).'</div></td>
        <td><div id="basket_prod_price">'.$res_arr['command_amount'].'EUR</div></td>
        <td><div class="command_details">';
        echo "<a href='#' onClick=\"javascript:window.open('inc/history.php?id=".$res_arr['command_id']."','Affichage commande', 'width=400, height=500')\">Details</a></div></td>
    </tr>";
        }
    ?>
    </table>
</div>
</div>
