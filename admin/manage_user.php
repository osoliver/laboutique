<HTML>
<HEAD>
	<TITLE>Modifier une fiche client</TITLE>
</HEAD>
<BODY>
<H2>Modifier une fiche client</H2>
<?PHP
include_once("../mysqlconnect.php");
$link = my_connect('mydb');

/* EDITION D'UN UTILISATEUR */

if ($_POST['modify'] === "Valider")
{
	foreach ($_POST as $value)
	{
		if ($value === '')
			exit("Erreur survenue! Un champ est vide!<br />");
	}
	$query = "UPDATE `client` SET `login` = '".$_POST['login']."',
									`lastname` = '".$_POST['lastname']."' ,
									`firstname` = '".$_POST['firstname']."',
									`address` = '".$_POST['address']."',
									`zipcode` = '".$_POST['zipcode']."',
									`city` = '".$_POST['city']."',
									`email` = '".$_POST['email']."'WHERE `client_id`= ".$_POST['id'];
	if(!mysqli_query($link, $query))
		echo mysqli_error($link);
	echo("<script>window.onload = function(){window.opener.location.reload(true);window.close();}();</script>");
}


if ($_GET['action'] === "edit" && !empty($_GET['id']))
{
	$edit = mysqli_query($link, "SELECT * FROM `client` WHERE `client_id` = ".$_GET['id']);
	echo("<div id='client_datas'>
			<H3>Modifier l'utilisateur</H3>
			<form method='POST' action='manage_user.php'>");
	$edit_user = mysqli_fetch_array($edit);
	echo("<input type='hidden' name='id' value=".$edit_user['client_id'].">");
	echo("identifiant : <input type='text' name='login' value='".$edit_user['login']."'><br />");
	echo("Nom : <input type='text' name='lastname' value='".$edit_user['lastname']."'><br />");
	echo("Prenom : <input type='text' name='firstname' value='".$edit_user['firstname']."'><br />");
	echo("Adresse : <input type='text' name='address' value='".$edit_user['address']."'><br />");
	echo("Code postale : <input type='text' name='zipcode' value='".$edit_user['zipcode']."'><br />");
	echo("Ville : <input type='text' name='city' value='".$edit_user['city']."'><br />");
	echo("E-mail : <input type='text' name='email' value='".$edit_user['email']."'><br />");
	echo("<input type='submit' name='modify' value='Valider'>");
	echo("</form></div>");
}
?>
</BODY>
</HTML>
