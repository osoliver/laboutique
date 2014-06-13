<HTML>
<HEAD>
	<TITLE>Modifier une categorie</TITLE>
</HEAD>
<BODY>
<H2>Modifier une categorie</H2>
<?PHP
include_once("../mysqlconnect.php");
$link = my_connect('mydb');

/* EDITION D'UNE CATEGORIE */

if ($_POST['modify'] === "Valider")
{
	foreach ($_POST as $value)
	{
		if ($value === '')
			exit("Erreur survenue! Un champ est vide!<br />");
	}
	$query = "UPDATE `categories` SET `name` = '".$_POST['name']."'WHERE `category_id`= ".$_POST['id'];
	if(!mysqli_query($link, $query))
		echo mysqli_error($link);
	echo("<script>window.onload = function(){window.opener.location.reload(true);window.close();}();</script>");
}


if ($_GET['action'] === "edit" && !empty($_GET['id']))
{
	$edit = mysqli_query($link, "SELECT * FROM `categories` WHERE `category_id` = ".$_GET['id']);
	echo("<div id='product_datas'>
			<H3>Modifier la categorie</H3>
			<form method='POST' action='manage_category.php'>");
	$edit_cat = mysqli_fetch_array($edit);
	echo("<input type='hidden' name='id' value='".$edit_cat['category_id']."'>");
	echo("Nom : <input type='text' name='name' value='".$edit_cat['name']."'><br />");
	echo("<input type='submit' name='modify' value='Valider'>");
	echo("</form></div>");
}
?>
</BODY>
</HTML>
