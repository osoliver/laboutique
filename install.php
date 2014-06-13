<?PHP

include_once('misc/error.php');
include_once('mysqlconnect.php');
include_once('install_dir/aff_func.php');
include_once('install_dir/creer_func.php');
include_once('controller/user_func.php');
function	install_check($login, $passwd, $bdd)
{
	global $SUCCES;

	if ($login == '')
		return (ret_err("Le champ 'Login' est vide"));
	if ($passwd == '')
		return (ret_err("Le champ 'Mot de passe' est vide"));
	if ($bdd == '')
		return (ret_err("Le champ 'Nom de la base de donnees' est vide"));
	if (strlen($login) > 20)
		return (ret_err("Le login ne doit pas faire plus de 20 caracteres"));
	if (strlen($passwd) > 20)
		return (ret_err("Le login ne doit pas faire plus de 20 caracteres"));

	return ($SUCCES);
}

function	get_secured_value($str)
{
	$res = mb_convert_encoding($str, 'UTF-8', 'UTF-8');
	$res = htmlentities($res, ENT_QUOTES, 'UTF-8');
	return ($res);
}

function	install($login, $passwd, $bdd, $bdd_host, $bdd_login, $bdd_pwd)
{
	global	$SUCCES, $ERREURC, $ERREUR;

	if (install_check($login, $passwd, $bdd) != $SUCCES)
		return ($ERREUR);
	if (set_connection_settings($bdd_host, $bdd_login, $bdd_pwd, '') != $SUCCES)
		return ($ERREURC);
	if (!($connection = my_connect()))
		return ($ERREURC);
	if (creer_bdd($connection, $bdd) != $SUCCES)
		return ($ERREURC);
	if (!mysqli_select_db($connection, $bdd))
		return (ret_errc("Erreur lors de la selection de la bdd '$bdd':<br />"
		.mysqli_error($connection)));
	if (set_db($bdd) != $SUCCES)
		return ($ERREURC);
	if (!($sql = file_get_contents('src/ecommerce.sql')))
		return (ret_errc("Erreur lors du chargement du fichier sql"));
	mysqli_multi_query($connection, $sql);	//Checking the return value is tedious and unnecessary here.
	while (mysqli_more_results($connection))
	{
		mysqli_next_result($connection); // flush multi_queries
	}
	if (remplit_tables($connection) != $SUCCES)
		return ($ERREURC);
	if (($ret = user_create($connection, $login, $passwd, 'value', 'value', 'value', 0, 'value', 'value')) != $SUCCES)
		return ($ret);
	if (($ret = set_role($connection, $login, 'admin')) != $SUCCES)
		return ($ERREURC);
	if (!mysqli_close($connection))
		return (ret_errc("Erreur lors de la cloture de la connexion sql"
		.mysqli_error($connection)));
	return ($SUCCES);
}

//----MAIN----

aff_header();
if (!isset($_POST) || empty($_POST))
	aff_formulaire();
else
{
	$login = get_secured_value($_POST['login']);
	$passwd = get_secured_value($_POST['passwd']);
	$bdd = get_secured_value($_POST['bdd']);
	$bdd_host = get_secured_value($_POST['bdd_host']);
	$bdd_login = get_secured_value($_POST['bdd_login']);
	$bdd_pwd = get_secured_value($_POST['bdd_pwd']);
	if (($ret = install($login, $passwd, $bdd, $bdd_host, $bdd_login,
		$bdd_pwd)) != $SUCCES)
	{
		if ($ret == $ERREURC)
			aff_erreurc($CHAINE_ERREUR);
		else if ($ret == $ERREUR)
		{
			aff_erreur($CHAINE_ERREUR);
			aff_formulaire($login, $bdd, $bdd_host, $bdd_login);
		}
	}
	else
		aff_succes();

}
aff_footer();
?>
