<HTML>
<HEAD>
	<TITLE>Administration de la boutique</TITLE>
</HEAD>
<BODY>
<?PHP
include_once("../misc/error.php");
include_once("../mysqlconnect.php");
include_once("../controller/connexion_func.php");
include_once("../controller/user_func.php");

session_start();

if (connexion_check($result_connexion) != $SUCCES)
	echo 'Erreur critique';
else if (!$result_connexion)
	echo 'Non connecte';
else 
{
	$link = my_connect();
	if (get_role($link, $_SESSION['login'], 'admin', $result_rights) != $SUCCES)
		echo 'Erreur critique';
	else if (!$result_rights)
		echo 'Pas le droit d\'etre la';
	else
	{
		if ($_GET['action'] === "del" && $_GET['type'] === "cat" && !empty($_GET['id']))
		{
			$query = "DELETE FROM `catalog` WHERE `category_id` = ".$_GET['id'];
			if (mysqli_query($link, $query))
				echo "ERREUR : ".mysqli_error($link)."<br />";
			echo "EXECUTED : $query<br />";
			$query = "DELETE FROM `categories` WHERE `category_id` = "
				.intval($_GET['id']);
			echo $query;
			if (mysqli_query($link, $query))
				echo ("Cat&eacute;gorie supprim&eacute;e avec succ&egrave;s!<br />");
			else
				echo ("Erreur survenue!<br />");
		}
		if ($_GET['action'] === "del" && $_GET['type'] === "prod" && !empty($_GET['id']))
		{
			$query = "DELETE FROM `catalog` WHERE `product_id` = ".$_GET['id'];
			mysqli_query($link, $query);
			if (mysqli_query($link, "DELETE FROM `product` WHERE `product_id` = "
				.$_GET['id']))
				echo ("Produit supprim&eacute; avec succ&egrave;s!<br />");
			else
				echo ("Erreur survenue!<br />");
		}

		if ($_GET['action'] === "del" && $_GET['type'] === "user" && !empty($_GET['id']))
		{
			$query = "DELETE FROM `client_roles` WHERE `client_id` = ".$_GET['id'];
			mysqli_query($link, $query);
			if (mysqli_query($link, "DELETE FROM `client` WHERE `client_id` = ".$_GET['id']))
				echo ("Utilisateur supprim&eacute; avec succ&egrave;s!<br />");
			else
				echo ("Erreur survenue!<br />");
		}
		include("adm_header.php");
		if (!isset($_GET['page']) || $_GET['page'] == 'logout' || (include($_GET['page'].".php")) === FALSE)
			include("adm_home.php");
	}
	mysqli_close($link);
}
?>
</BODY>
</HTML>
