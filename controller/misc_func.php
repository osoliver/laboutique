<?PHP

function	category_exists($connection, $name, &$result)
{
	global $SUCCES;

	$query_prep_chaine = "SELECT 1 FROM categories WHERE name=?";
	if (!$query_prep = mysqli_prepare($connection, $query_prep_chaine))
		return (ret_errc("Echec de la preparation de la requete '$query_prep_chaine':<br />".mysqli_error($connection)));
	if (!mysqli_stmt_bind_param($query_prep, 's', $name))
		return (ret_errc("Echec de la liaison pour la requete '$query_prep_chaine'
		pour la chaine '$name':<br />".mysqli_error($connection)));
	if (!mysqli_stmt_execute($query_prep))
		return (ret_errc("Echec de l'execution de la requete '$query_prep_chaine':<br />".mysqli_error($connection)));
	if (!mysqli_stmt_bind_result($query_prep, $test))
		return (ret_errc("Echec de l'attachement du resultat de la requete '$query_prep_chaine':<br />".mysqli_error($connection)));
	$ret = mysqli_stmt_fetch($query_prep);
	$result = ($ret != NULL);
	if ($result && $ret == FALSE)
		return (ret_errc("Echec de la recuperation du resultat de la requete '$query_prep_chaine':<br />".mysqli_error($connection)));
	if (!mysqli_stmt_close($query_prep))
		return (ret_errc("Echec de la cloture de la requete '$query_prep_chaine':<br />".mysqli_error($connection)));

	return ($SUCCES);
}

function	category_create($connection, $name)
{
	global $SUCCES;

	if (($ret = category_exists($connection, $name, $result)) != $SUCCES)
		return ($ret);
	if ($result == TRUE)
		return (ret_err("Une categorie avec ce nom existe deja"));
	//Actual Insertion
	$query_prep_chaine = "INSERT INTO categories(name) VALUES(?)";
	if (!$query_prep = mysqli_prepare($connection, $query_prep_chaine))
		return (ret_errc("Echec de la preparation de la requete '$query_prep_chaine':
		<br />".mysqli_error($connection)));
	if (!mysqli_stmt_bind_param($query_prep, "s", $name))
		return (ret_errc("Echec de la liaison pour la requete '$query_prep_chaine'
		:<br />".mysqli_error($connection)));
	if (!mysqli_stmt_execute($query_prep))
		return (ret_errc("Echec de l'execution de la requete '$query_prep_chaine':<br />".mysqli_error($connection)));
	if (!mysqli_stmt_close($query_prep))
		return (ret_errc("Echec de la cloture de la requete '$query_prep_chaine':<br />".mysqli_error($connection)));

	return ($SUCCES);
}

function	product_exists($connection, $name, &$result)
{
	global $SUCCES;

	$query_prep_chaine = "SELECT 1 FROM product WHERE name=?";
	if (!$query_prep = mysqli_prepare($connection, $query_prep_chaine))
		return (ret_errc("Echec de la preparation de la requete '$query_prep_chaine':<br />".mysqli_error($connection)));
	if (!mysqli_stmt_bind_param($query_prep, 's', $name))
		return (ret_errc("Echec de la liaison pour la requete '$query_prep_chaine'
		pour la chaine '$name':<br />".mysqli_error($connection)));
	if (!mysqli_stmt_execute($query_prep))
		return (ret_errc("Echec de l'execution de la requete '$query_prep_chaine':<br />".mysqli_error($connection)));
	if (!mysqli_stmt_bind_result($query_prep, $test))
		return (ret_errc("Echec de l'attachement du resultat de la requete '$query_prep_chaine':<br />".mysqli_error($connection)));
	$ret = mysqli_stmt_fetch($query_prep);
	$result = ($ret != NULL);
	if ($result && $ret == FALSE)
		return (ret_errc("Echec de la recuperation du resultat de la requete '$query_prep_chaine':<br />".mysqli_error($connection)));
	if (!mysqli_stmt_close($query_prep))
		return (ret_errc("Echec de la cloture de la requete '$query_prep_chaine':<br />".mysqli_error($connection)));

	return ($SUCCES);
}

function	product_create($connection, $name, $description, $quantity, $price)
{
	global $SUCCES;

	if (($ret = product_exists($connection, $name, $result)) != $SUCCES)
		return ($ret);
	if ($result == TRUE)
		return (ret_err("Un produit avec ce nom existe deja"));
	//Actual Insertion
	$query_prep_chaine = "INSERT INTO product(name, description, quantity, price)
		VALUES(?, ?, ?, ?)";
	if (!$query_prep = mysqli_prepare($connection, $query_prep_chaine))
		return (ret_errc("Echec de la preparation de la requete '$query_prep_chaine':
		<br />".mysqli_error($connection)));
	if (!mysqli_stmt_bind_param($query_prep, "ssid", $name, $description, $quantity, $price))
		return (ret_errc("Echec de la liaison pour la requete '$query_prep_chaine'
		:<br />".mysqli_error($connection)));
	if (!mysqli_stmt_execute($query_prep))
		return (ret_errc("Echec de l'execution de la requete '$query_prep_chaine':<br />".mysqli_error($connection)));
	if (!mysqli_stmt_close($query_prep))
		return (ret_errc("Echec de la cloture de la requete '$query_prep_chaine':<br />".mysqli_error($connection)));

	return ($SUCCES);
}
