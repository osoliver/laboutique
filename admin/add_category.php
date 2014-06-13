<?PHP

include_once('../misc/error.php');
include_once('../mysqlconnect.php');
include_once('../views/aff_category_form.php');
include_once('../controller/misc_func.php');
include_once('../misc/get_secured_value.php');

function	category_check($name)
{
	global $SUCCES;

	if ($name == '')
		return (ret_err("Le champ 'Nom' est vide"));
	if (strlen($name) > 255)
		return (ret_err("Le nom ne doit pas faire plus de 255 caracteres"));
	return ($SUCCES);
}

function	category($name)
{
	global	$SUCCES, $ERREURC;

	if (($ret = category_check($name)) != $SUCCES)
		return ($ret);
	if (!($connection = my_connect()))
		return ($ERREURC);
	if (($ret = category_create($connection, $name)) != $SUCCES)
		return ($ret);
	if (!mysqli_close($connection))
		return (ret_errc("Erreur lors de la cloture de la connexion sql"
		.mysqli_error($connection)));
	return ($SUCCES);
}

//----MAIN----

aff_category_header();
if (!isset($_POST) || empty($_POST))
		aff_category_form();
else
{
	$name = get_secured_value($_POST['name']);
	if (($ret = category($name)) != $SUCCES)
	{
		if ($ret == $ERREURC)
			aff_category_erreurc($CHAINE_ERREUR);
		else if ($ret == $ERREUR)
		{
			aff_category_erreur($CHAINE_ERREUR);
			aff_category_form($name);
		}
	}
	else
		aff_category_succes();

}
aff_category_footer();
?>
