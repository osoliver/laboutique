<?PHP
include_once("../mysqlconnect.php");
$link = my_connect('mydb');

/* REQUETE POUR RECUPERER LES CLIENTS */

$res = mysqli_query($link, "SELECT * FROM `client`");

?>

<div id="content">
<H2>Gestion utilisateurs</H2>
	<TABLE>
		<tr>
			<th>ID</th>
			<th>Identifiant</th>
			<th>Nom</th>
			<th>Pr&eacute;nom</th>
			<th>Edition</th>
		</tr>
		<?PHP
			while($users = mysqli_fetch_array($res))
			{
				echo("<tr><td class='client_id'>".$users['client_id']."</td>
					<td class='client_login'>".$users['login']."</td>
					<td class='client_infos'>".$users['lastname']."</td>
					<td class='client_infos'>".$users['firstname']."</td>
					<td class='client_edit'><a href='#' onClick=\"javascript:window.open('manage_user.php?action=edit&id=".$users['client_id']."','Modification utilisateur', 'width=400, height=500')\">modifier</a></td>
					<td class='client_edit'><a href='index.php?action=del&type=user&id=".$users['client_id']."&page=adm_users'>supprimer</a></td></tr>");
			}
		?>
	</TABLE>
</div>
