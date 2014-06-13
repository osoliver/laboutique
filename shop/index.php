<HTML>
<HEAD><meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Coustard' rel='stylesheet' type='text/css'>
    <LINK href="css/index.css" rel="stylesheet" type="text/css">
    <LINK href="css/myaccount.css" rel="stylesheet" type="text/css">
    <LINK href="css/register.css" rel="stylesheet" type="text/css">
    <LINK href="css/product.css" rel="stylesheet" type="text/css">
    <LINK href="css/basket.css" rel="stylesheet" type="text/css">
    <LINK href="css/header.css" rel="stylesheet" type="text/css">
    <LINK href="css/footer.css" rel="stylesheet" type="text/css">
	<TITLE>Bienvenue sur la boutique SUPERNOM</TITLE>
</HEAD>
<BODY>
<div id="content">
<?PHP

include_once("../misc/error.php");
include_once("../misc/get_secured_value.php");
include_once("../controller/user_func.php");
include_once("../controller/connexion_func.php");
include_once("../mysqlconnect.php");

$link = my_connect();
session_start();

if (isset($_GET['page']) && $_GET['page'] == 'logout')
{
	connexion_check($result);
	if ($result)
	{
		$_SESSION['login'] = '';
		$_SESSION['passwd'] = '';
		unset($_SESSION['login']);
		unset($_SESSION['passwd']);
	}
}

if (!isset($_SESSION['basket-total']))
	$_SESSION['basket-total'] = 0;
if (isset($_GET['buyproduct']))
{
	include_once("../misc/get_secured_value.php");
	$product = get_secured_value($_GET['buyproduct']);
	if (!isset($_SESSION['basket']))
		$_SESSION['basket'] = Array();
	if (!isset($_SESSION['basket'][$product]))
		$_SESSION['basket']{$product} = 0;
	$_SESSION['basket']{$product} += 1;
	$_SESSION['basket-total'] += 1;
}

include("inc/header.php");
echo '<div id="middle">';

if (isset($_GET['page']) && $_GET['page'] == 'logout')
	echo '<span class="register_ok">Deconnection effectuee.</span>';

if (isset($_GET['buyproduct']))
	echo '
		<span class="register_ok">Ajout d\'un '.$product.' au basket</span>';
include("inc/content.php");
echo '</div>';
include("inc/footer.php");

?>
</div>
</BODY>
</HTML>
