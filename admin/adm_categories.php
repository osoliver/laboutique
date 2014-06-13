<?PHP
include_once("../mysqlconnect.php");
$link = my_connect();

/* REQUETE POUR RECUPERER LES CATEGORIES */

$res = mysqli_query($link, "SELECT * FROM `categories`");

?>

<div id="content">
<H2>Gestion des cat&eacute;gories</H2>
<a href="add_category.php">Ajouter</a>
	<TABLE>
		<tr>
			<th>ID</th>
			<th>Nom</th>
			<th>Edition</th>
		</tr>
		<?PHP
			while($cat = mysqli_fetch_array($res))
			{
				echo("<tr><td class='category_id'>".$cat['category_id']."</td>
					<td class='category_name'>".$cat['name']."</td>
					<td class='category_edit'><a href='#' onClick=\"javascript:window.open('manage_category.php?action=edit&id=".$cat['category_id']."','Modification cat&eacute;gorie', 'width=400, height=500')\">modifier</a></td>
					<td class='category_edit'><a href='index.php?action=del&type=cat&id=".$cat['category_id']."&page=adm_categories'>supprimer</a></td></tr>");
			}
		?>
	</TABLE>
</div>
<?PHP
mysqli_close($link);
?>
