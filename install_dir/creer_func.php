<?PHP
function	creer_bdd($connection, $bdd)
{
	global $SUCCES;

	$query_chaine = "DROP DATABASE IF EXISTS $bdd";
	if (!mysqli_query($connection, $query_chaine))
		return (ret_errc("Echec de l'execution de la requete '$query_chaine' :<br />
		".mysqli_error($connection)));

	$query_chaine = "CREATE DATABASE IF NOT EXISTS $bdd";
	if (!mysqli_query($connection, $query_chaine))
		return (ret_errc("Echec de l'execution de la requete '$query_chaine' :<br />
		".mysqli_error($connection)));

	return ($SUCCES);
}

function	remplit_tables($connection)
{
	global $SUCCES;

	$query_chaine = "INSERT INTO role(name) VALUES ('admin')";
	if (!mysqli_query($connection, $query_chaine))
		return (ret_errc("Echec de l'execution de la requete '$query_chaine'<br />:
		".mysqli_error($connection)));
	$query_chaine = "INSERT INTO role(name) VALUES ('user')";
	if (!mysqli_query($connection, $query_chaine))
		return (ret_errc("Echec de l'execution de la requete '$query_chaine'<br />:
		".mysqli_error($connection)));

	return ($SUCCES);
}
?>
