<?PHP
include_once("../mysqlconnect.php");
$link = my_connect();

/* REQUETE POUR RECUPERER LES PRODUITS */

$res = mysqli_query($link, "SELECT * FROM `product`");

?>

<div id="content">
<H2>Gestion Produits</H2>
	<a href="add_product.php">Ajouter</a>
	<TABLE>
		<tr>
			<th>Image</th>
			<th>ID</th>
			<th>Nom</th>
			<th>Description</th>
			<th>quantit&eacute;</th>
			<th>Prix</th>
			<th>Edition</th>
		</tr>
		<?PHP
			while($products = mysqli_fetch_array($res))
			{
				echo("<tr>
					<td class='product_image'><img style='max-height:100px;max-width:100px' src='../shop/img/catalog/".$products['name'].".png'></td>
					<td class='product_id'>".$products['product_id']."</td>
					<td class='product_login'>".$products['name']."</td>
					<td class='product_infos'>".$products['description']."</td>
					<td class='product_infos'>".$products['quantity']."</td>
					<td class='product_infos'>".$products['price']."</td>
					<td class='product_edit'><a href='#' onClick=\"javascript:window.open('manage_product.php?action=edit&id=".$products['product_id']."','Modification produit', 'width=400, height=500')\">modifier</a></td>
					<td class='product_edit'><a href='index.php?action=del&type=prod&id=".$products['product_id']."&page=adm_products'>supprimer</a></td></tr>");
			}
		?>
	</TABLE>
</div>
