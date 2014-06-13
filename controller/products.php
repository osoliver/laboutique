<?PHP
function	get_products($link, $query)
{
	$products = array();
	$res = mysqli_query($link, $query);
	while ($prod_raw = mysqli_fetch_assoc($res))
	{
		$products[] = array(
			'name'=>$prod_raw['name'],
			'description'=>$prod_raw['description'],
			'price'=>$prod_raw['price']);
	}
	return ($products);
}
?>
