<?PHP

function	aff_product_header()
{
	echo '
<html>
	<head>
		<title>Ajouter produit</title>
	</head>
	<body>';
	include('adm_header.php');
}

function	aff_product_form($name = '', $description = '', $quantity = '',
	$price ='')
{
	echo '
		<h1>Ajouter produit</h1>
		<form action="add_product.php" method="POST">
			<ul>
				<li><label for="name">Nom :</label><input type="text"
				name="name" value="'.$name.'"/></li>
				<li><label for="description">Description :</label><input type="text"
				name="description" value="'.$description.'"/></li>
				<li><label for="name">Prix :</label><input type="text"
				name="price" value="'.$price.'"/></li>
				<li><label for="name">Quantite :</label><input type="text"
				name="quantity" value="'.$quantity.'"/></li>
			</ul>
			<input type="submit" />
		</form>';
}

function	aff_product_footer()
{
	echo '
	</body>
	</html>';
}

function	aff_product_erreur($str)
{
	echo "
		<span style=\"color:red;font-weight:bold\">Erreur pendant la creation de produit :<br />
		$str<br />Veuillez reessayer.</span>";
}

function	aff_product_erreurc($str)
{
	echo "
		<span style=\"color:red;font-weight:bold\">Erreur CRITIQUE pendant
		la creation de produit :<br />$str</span>";
}

function	aff_product_succes()
{
	echo "
		<span style=\"color:green;font-weight:bold\">La creation de produit s'est bien deroule.</span>";
}
?>
