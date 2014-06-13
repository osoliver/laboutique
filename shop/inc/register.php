<?PHP

include_once('../misc/error.php');
include_once('../mysqlconnect.php');
include_once('../views/aff_register_form.php');
include_once('../controller/user_func.php');
include_once('../misc/get_secured_value.php');

function	register_check($login, $passwd, $passwd_conf, $firstname, $lastname, $address, $zipcode, $city, $email)
{
	global $SUCCES;

	if ($login == '')
		return (ret_err("Le champ 'Login' est vide"));
	if ($passwd == '')
		return (ret_err("Le champ 'Mot de passe' est vide"));
	if ($passwd_conf == '')
		return (ret_err("Le champ 'Confirmer mot de passe' est vide"));
	if ($firstname == '')
		return (ret_err("Le champ 'Prenom' est vide"));
	if ($lastname == '')
		return (ret_err("Le champ 'Nom' est vide"));
	if ($address == '')
		return (ret_err("Le champ 'Adresse' est vide"));
	if ($zipcode == 0)
		return (ret_err("Le champ 'Code Postal' est vide"));
	if ($city == '')
		return (ret_err("Le champ 'Ville' est vide"));
	if ($email == '')
		return (ret_err("Le champ 'Email' est vide"));
	if (strlen($login) > 20)
		return (ret_err("Le login ne doit pas faire plus de 20 caracteres"));
	if (strlen($passwd) > 20)
		return (ret_err("Le mot de passe ne doit pas faire plus de 20 caracteres"));
	if (strlen($lastname) > 45)
		return (ret_err("Le nom ne doit pas faire plus de 45 caracteres"));
	if (strlen($firstname) > 45)
		return (ret_err("Le prenom ne doit pas faire plus de 45 caracteres"));
	if (strlen($address) > 45)
		return (ret_err("L'adresse ne doit pas faire plus de 45 caracteres"));
	if ($zipcode >= 100000)
		return (ret_err("Le code postal ne doit pas faire plus de 5 caracteres"));
	if (strlen($city) > 45)
		return (ret_err("Le nom de ville ne doit pas faire plus de 45 caracteres"));
	if (strlen($email) > 45)
		return (ret_err("L'email ne doit pas faire plus de 45 caracteres"));
	if ($passwd != $passwd_conf)
		return (ret_err("Les deux mots de passe ne sont pas les memes"));
	return ($SUCCES);
}

function	register($login, $passwd, $passwd_conf, $firstname, $lastname, $address, $zipcode, $city,
				$email)
{
	global	$SUCCES, $ERREURC;

	if (($ret = register_check($login, $passwd, $passwd_conf, $firstname, $lastname, $address, $zipcode,
			$city, $email)) != $SUCCES)
		return ($ret);
	if (!($connection = my_connect()))
		return ($ERREURC);
	if (($ret = user_create($connection, $login, $passwd, $lastname, $firstname, $address, $zipcode, $city, $email)) != $SUCCES)
		return ($ret);
	if (set_role($connection, $login, 'user') != $SUCCES)
		return ($ERREURC);
	if (!mysqli_close($connection))
		return (ret_errc("Erreur lors de la cloture de la connexion sql"
		.mysqli_error($connection)));
	return ($SUCCES);
}

//----MAIN----

if (!isset($_POST) || empty($_POST))
	aff_register_form();
else
{
	$login = get_secured_value($_POST['login']);
	$passwd = get_secured_value($_POST['passwd']);
	$passwd_conf = get_secured_value($_POST['passwd_conf']);
	$firstname = get_secured_value($_POST['firstname']);
	$lastname = get_secured_value($_POST['lastname']);
	$address = get_secured_value($_POST['address']);
	$zipcode = get_secured_value($_POST['zipcode']);
	$zipcode = intval($zipcode);
	$city = get_secured_value($_POST['city']);
	$email = get_secured_value($_POST['email']);
	if (($ret = register($login, $passwd, $passwd_conf, $firstname, $lastname, $address,
		$zipcode, $city, $email)) != $SUCCES)
	{
		if ($ret == $ERREURC)
			aff_register_erreurc($CHAINE_ERREUR);
		else if ($ret == $ERREUR)
		{
			aff_register_erreur($CHAINE_ERREUR);
			aff_register_form($login, $firstname, $lastname, $address, $zipcode, $city,
				$email);
		}
	}
	else
		aff_register_succes();

}
?>
