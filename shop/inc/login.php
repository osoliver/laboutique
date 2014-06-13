<?PHP

include_once('../misc/error.php');
include_once('../mysqlconnect.php');
include_once('../views/aff_connexion.php');
include_once('../controller/connexion_func.php');
include_once('../controller/user_func.php');
include_once('../misc/get_secured_value.php');

function connexion($login, $passwd)
{
	global	$SUCCES;

	$passwd = hash('whirlpool', $passwd);
	if (($ret = user_check($login, $passwd, $verif)) != $SUCCES)
		return ($ret);
	if (!$verif)
		return (ret_err("Mauvaise combinaison de Login et Mot de passe"));
	$_SESSION['login'] = $login;
	$_SESSION['passwd'] = $passwd;
	return ($SUCCES);
}


//----MAIN----
if (connexion_check($result) != $SUCCES)
	aff_connexion_erreurc($chaine_erreur);
else if ($result)
	aff_connexion_erreur("vous etes deja connecte ".$_SESSION['login']);
else if (!isset($_POST) || empty($_POST))
	aff_connexion_form();
else
{
	$login = get_secured_value($_POST['login']);
	$passwd = get_secured_value($_POST['passwd']);
	if (($ret = connexion($login, $passwd)) != $SUCCES)
	{
		if ($ret == $ERREURC)
			aff_connexion_erreurc($CHAINE_ERREUR);
		else if ($ret == $ERREUR)
		{
			aff_connexion_erreur($CHAINE_ERREUR);
			aff_connexion_form($login);
		}
	}
	else
		aff_connexion_succes();
}
?>
