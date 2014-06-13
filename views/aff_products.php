<?PHP

function aff_product($product)
{
	$new_get = $_GET;
	$new_get['buyproduct'] = $product['name'];
	$link = http_build_query($new_get);
	echo '
  		<div class="product">
		<div class="prod_img"><img src="img/catalog/'.$product['name'].'.png"></div>
		<div class="prod_name">'.$product['name'].'</div>
            <div class="prod_desc">'.$product['description'].'</div>
            <div class="prod_prix">'.$product['price'].' EUR</div>
            <div class="prod_buy"><a href="?'.$link.'">ACHETER</a></div>
         </div>';
}

function aff_all_products($products)
{
	echo '
	<div class="prod_selection">';

	for ($i = 0; $i < count($products); ++$i)
		aff_product($products[$i]);
	echo '
	</div>';
}
?>
