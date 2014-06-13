<?PHP
include_once("../views/aff_products.php");
include_once("../controller/products.php");
include_once("../misc/get_secured_value.php");

function aff_header($name)
{
	echo '
<div id="accueil">
	<div id="selection"><h2>'.$name.'</h2>';
}

function aff_footer()
{
	echo '
	</div>
</div>';
}

if (!isset($_GET['name']))
{
	$products = get_products($link, "SELECT name, description, price FROM `product`");
	$name = "Tous nos produits";
}
else
{
	$name = get_secured_value($_GET['name']);
	$query = "	SELECT p.name, p.description, p.price FROM `product` as p
					INNER JOIN `catalog` as ca ON ca.product_id = p.product_id
					INNER JOIN `categories` ci ON ci.category_id = ca.category_id
					WHERE ci.name = '".mysqli_real_escape_string($link, $_GET['name'])."'";
	$products = get_products($link, $query);
}
aff_header($name);
aff_all_products($products);
aff_footer();
?>
