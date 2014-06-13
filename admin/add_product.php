<?PHP

include_once('../misc/error.php');
include_once('../mysqlconnect.php');
include_once('../views/aff_product_form.php');
include_once('../controller/misc_func.php');
include_once('../misc/get_secured_value.php');

function	product_check($name, $description, $quantity, $price)
{
	global $SUCCES;

	if ($name == '')
		return (ret_err("Le champ 'Nom' est vide"));
	if (strlen($name) > 30)
		return (ret_err("Le nom ne doit pas faire plus de 30 caracteres"));
	if ($description == '')
		return (ret_err("Le champ 'Description' est vide"));
	if (strlen($description) > 100)
		return (ret_err("La description ne doit pas faire plus de 100 caracteres"));
	if ($price == 0.0)
		return (ret_err("Le champ 'Prix' est vide"));
	return ($SUCCES);
}

function	product($name, $description, $quantity, $price)
{
	global	$SUCCES, $ERREURC;

	if (($ret = product_check($name, $description, $quantity, $price)) != $SUCCES)
		return ($ret);
	if (!($connection = my_connect()))
		return ($ERREURC);
	if (($ret = product_create($connection, $name, $description, $quantity, $price)) != $SUCCES)
		return ($ret);
	if (!mysqli_close($connection))
		return (ret_errc("Erreur lors de la cloture de la connexion sql"
		.mysqli_error($connection)));
	return ($SUCCES);
}

//----MAIN----

aff_product_header();
if (!isset($_POST) || empty($_POST))
		aff_product_form();
else
{
	$name = get_secured_value($_POST['name']);
	$description = get_secured_value($_POST['description']);
	$quantity = intval($_POST['quantity']);
	$price = floatval($_POST['price']);
	if (($ret = product($name, $description, $quantity, $price)) != $SUCCES)
	{
		if ($ret == $ERREURC)
			aff_product_erreurc($CHAINE_ERREUR);
		else if ($ret == $ERREUR)
		{
			aff_product_erreur($CHAINE_ERREUR);
			aff_product_form($name, $description, $quantity, $price);
		}
	}
	else
		aff_product_succes();

}
aff_product_footer();
?>
