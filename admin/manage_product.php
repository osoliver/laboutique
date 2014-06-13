<HTML>
<HEAD>
	<TITLE>Modifier un produit</TITLE>
</HEAD>
<BODY>
<H2>Modifier un produit</H2>
<?PHP
include_once("../mysqlconnect.php");
$link = my_connect();

/* EDITION D'UN PRODUIT */

if ($_POST['modify'] === "Valider")
{
	foreach ($_POST as $value)
	{
		if ($value === '')
			exit("Erreur survenue! Un champ est vide!<br />");
	}
	$query = "UPDATE `product` SET `name` = '".$_POST['name']."',
									`description` = '".$_POST['description']."' ,
									`quantity` = '".$_POST['quantity']."',
									`price` = '".$_POST['price']."'WHERE `product_id`= ".$_POST['id'];
	if(!mysqli_query($link, $query))
		echo mysqli_error($link);
	$query = "DELETE FROM `catalog` WHERE `product_id` = ".$_POST['id'];
	if(!mysqli_query($link, $query))
		echo mysqli_error($link);
	foreach ($_POST as $key => $value)
	{
		if (substr_compare("catalog_", $key, 0, 8) === 0)
		{
				$val = substr($key, 8);
				$query = "INSERT INTO `catalog` (product_id, category_id) VALUES ($_POST[id], $val)";
				if(!mysqli_query($link, $query))
					echo mysqli_error($link);
		}
	}
	echo("<script>window.onload = function(){window.opener.location.reload(true);window.close();}();</script>");
}


if ($_GET['action'] === "edit" && !empty($_GET['id']))
{
	$edit = mysqli_query($link, "SELECT * FROM `product` WHERE `product_id` = ".$_GET['id']);
	echo("<div id='product_datas'>
			<H3>Modifier le produit</H3>
			<form method='POST' action='manage_product.php'>");
	$edit_prod = mysqli_fetch_array($edit);
	echo("<input type='hidden' name='id' value=".$edit_prod['product_id'].">");
	echo("Nom : <input type='text' name='name' value='".$edit_prod['name']."'><br />");
	echo("Description : <input type='text' name='description' value='".$edit_prod['description']."'><br />");
	echo("Quantite : <input type='text' name='quantity' value='".$edit_prod['quantity']."'><br />");
	echo("Prix : <input type='text' name='price' value='".$edit_prod['price']."'><br />");
	$res = mysqli_query($link, "SELECT * FROM `categories`");
	while($cat = mysqli_fetch_array($res))
	{
		$catalog = mysqli_query($link, "SELECT * FROM `catalog`");
		echo($cat['name']." : <input type='checkbox' name='catalog_".$cat['category_id']."' value='catalog_".$cat['name']."'");
		while ($checked = mysqli_fetch_array($catalog))
		{
			if ($checked['product_id'] === $edit_prod['product_id'] && $checked['category_id'] === $cat['category_id'])
				echo(" checked");
		}
		echo("><br />");
	}
	echo("<input type='submit' name='modify' value='Valider'>");
	echo("</form></div>");
}
?>
</BODY>
</HTML>
