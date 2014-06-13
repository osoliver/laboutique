<?PHP

include_once("../views/aff_products.php");
include_once("../controller/products.php");

function aff_header()
{
	echo '
<div id="accueil">
	<div id="selection"><h2>La selection du mois</h2>';
}

function aff_footer()
{
	echo '
	</div>
</div>';
}

$products = get_products($link, "SELECT name, description, price FROM `product` ORDER BY product_id DESC LIMIT 4");
aff_header();
aff_all_products($products);
aff_footer();
?>
