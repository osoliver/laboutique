<?PHP

function	get_role($connection, $login, $role, &$result)
{
	global	$SUCCES;

	$query_prep_chaine = "	SELECT 1 FROM `client_roles`
					INNER JOIN `client` on client.client_id = client_roles.client_id
					INNER JOIN `role` on role.role_id = client_roles.role_id
				WHERE client.login = ? && role.name = ?";
	if (!$query_prep = mysqli_prepare($connection, $query_prep_chaine))
		return (ret_errc("Echec de la preparation de la requete '$query_prep_chaine':
		<br />".mysqli_error($connection)));
	if (!mysqli_stmt_bind_param($query_prep, 'ss', $login, $role))
		return (ret_errc("Echec de la liaison pour la requete '$query_prep_chaine'
		pour la chaine '$login':<br />".mysqli_error($connection)));
	if (!mysqli_stmt_execute($query_prep))
		return (ret_errc("Echec de l'execution de la requete '$query_prep_chaine':<br />"
		.mysqli_error($connection)));
	if (!mysqli_stmt_bind_result($query_prep, $test))
		return (ret_errc("Echec de l'attachement du resultat de la requete 
		'$query_prep_chaine':<br />".mysqli_error($connection)));
	$ret = mysqli_stmt_fetch($query_prep);
	$result = ($ret != NULL);
	if ($result && $ret == FALSE)
		return (ret_errc("Echec de la recuperation du resultat de la requete 
		'$query_prep_chaine':<br />".mysqli_error($connection)));
	if (!mysqli_stmt_close($query_prep))
		return (ret_errc("Echec de la cloture de la requete '$query_prep_chaine':<br />
		".mysqli_error($connection)));
	return ($SUCCES);
}

function	set_role($connection, $login, $role)
{
	global	$SUCCES, $ERREURC;

	$query = "SELECT role_id from role where name = '$role'";
	if (!($unfetched_res = mysqli_query($connection, $query)))
		return (ret_errc("Erreur lors de la requete '$query' :<br />".mysqli_error($connection)));
	if (!($res = mysqli_fetch_row($unfetched_res)))
		return (ret_errc("Erreur en recuperant le resultat de la requete
		'$query'"));
	$admin_id = $res[0];
	mysqli_free_result($unfetched_res);

	$query_prep_chaine = "SELECT client_id FROM client WHERE login=?";
	if (!$query_prep = mysqli_prepare($connection, $query_prep_chaine))
		return (ret_errc("Echec de la preparation de la requete '$query_prep_chaine':<br />".mysqli_error($connection)));
	if (!mysqli_stmt_bind_param($query_prep, "s", $login))
		return (ret_errc("Echec de la liaison pour la requete '$query_prep_chaine'
		pour la chaine '$login':<br />".mysqli_error($connection)));
	if (!mysqli_stmt_execute($query_prep))
		return (ret_errc("Echec de l'execution de la requete '$query_prep_chaine':<br />".mysqli_error($connection)));
	if (!mysqli_stmt_bind_result($query_prep, $login_id))
		return (ret_errc("Echec de l'attachement du resultat de la requete '$query_prep_chaine':<br />".mysqli_error($connection)));
	if (!mysqli_stmt_fetch($query_prep))
		return (ret_errc("Echec de la recuperation du resultat de la requete '$query_prep_chaine':<br />".mysqli_error($connection)));
	if (!mysqli_stmt_close($query_prep))
		return (ret_errc("Echec de la cloture de la requete '$query_prep_chaine':<br />".mysqli_error($connection)));
	if (user_add_role($connection, $login_id, $admin_id) != $SUCCES)
		return ($ERREURC);
	return ($SUCCES);
}

function	user_check($login, $passwd, &$result)
{
	global	$SUCCES, $ERREURC;

	if (!($link = my_connect()))
		return ($ERREURC);
	$query_prep_chaine = "SELECT 1 FROM `client` WHERE `login`=? AND `pwd`=?";
	if (!$query_prep = mysqli_prepare($link, $query_prep_chaine))
		return (ret_errc("Echec de la preparation de la requete '$query_prep_chaine':<br />".mysqli_error($link)));
	if (!mysqli_stmt_bind_param($query_prep, 'ss', $login, $passwd))
		return (ret_errc("Echec de la liaison pour la requete '$query_prep_chaine'
		pour la chaine '$login':<br />".mysqli_error($link)));
	if (!mysqli_stmt_execute($query_prep))
		return (ret_errc("Echec de l'execution de la requete '$query_prep_chaine':<br />".mysqli_error($link)));
	if (!mysqli_stmt_bind_result($query_prep, $test))
		return (ret_errc("Echec de l'attachement du resultat de la requete '$query_prep_chaine':<br />".mysqli_error($link)));
	$ret = mysqli_stmt_fetch($query_prep);
	$result = ($ret != NULL);
	if ($result && $ret == FALSE)
		return (ret_errc("Echec de la recuperation du resultat de la requete '$query_prep_chaine':<br />".mysqli_error($link)));
	if (!mysqli_stmt_close($query_prep))
		return (ret_errc("Echec de la cloture de la requete '$query_prep_chaine':<br />".mysqli_error($link)));
	if (!mysqli_close($link))
		return (ret_errc("Erreur lors de la cloture de la connexion sql"
		.mysqli_error($link)));
	return ($SUCCES);
}

function	user_add_role($connection, $id, $role)
{
	global	$SUCCES;

	$query_prep_chaine = "INSERT INTO client_roles(client_id, role_id) VALUES(?, ?)";
	if (!$query_prep = mysqli_prepare($connection, $query_prep_chaine))
		return (ret_errc("Echec de la preparation de la requete '$query_prep_chaine':<br />".mysqli_error($connection)));
	if (!mysqli_stmt_bind_param($query_prep, "ii", $id, $role))
		return (ret_errc("Echec de la liaison pour la requete '$query_prep_chaine'
		:<br />".mysqli_error($connection)));
	if (!mysqli_stmt_execute($query_prep))
		return (ret_errc("Echec de l'execution de la requete '$query_prep_chaine':<br />".mysqli_error($connection)));
	if (!mysqli_stmt_close($query_prep))
		return (ret_errc("Echec de la cloture de la requete '$query_prep_chaine':<br />".mysqli_error($connection)));
	return ($SUCCES);
}

function	user_exists($connection, $login, &$result)
{
	global $SUCCES;

	$query_prep_chaine = "SELECT 1 FROM client WHERE login=?";
	if (!$query_prep = mysqli_prepare($connection, $query_prep_chaine))
		return (ret_errc("Echec de la preparation de la requete '$query_prep_chaine':<br />".mysqli_error($connection)));
	if (!mysqli_stmt_bind_param($query_prep, 's', $login))
		return (ret_errc("Echec de la liaison pour la requete '$query_prep_chaine'
		pour la chaine '$login':<br />".mysqli_error($connection)));
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

function	user_create($connection, $login, $passwd, $lastname, $firstname, $address, $zipcode, $city, $email)
{
	global $SUCCES;

	//Verify the login doesn't exist already
	if (($ret = user_exists($connection, $login, $result)) != $SUCCES)
		return ($ret);
	if ($result == TRUE)
		return (ret_err("Un utilisateur avec ce pseudo existe deja"));
	//Actual Insertion
	$hashed_passwd = hash('whirlpool', $passwd);
	$query_prep_chaine = "INSERT INTO client(login, pwd, lastname, firstname, address, zipcode, city, email) VALUES(?, ?, ?, ?, ?, ?, ?, ?)";
	if (!$query_prep = mysqli_prepare($connection, $query_prep_chaine))
		return (ret_errc("Echec de la preparation de la requete '$query_prep_chaine':
		<br />".mysqli_error($connection)));
	if (!mysqli_stmt_bind_param($query_prep, "sssssiss", $login, $hashed_passwd, $firstname,
		$lastname, $address, $zipcode, $city, $email))
		return (ret_errc("Echec de la liaison pour la requete '$query_prep_chaine'
		:<br />".mysqli_error($connection)));
	if (!mysqli_stmt_execute($query_prep))
		return (ret_errc("Echec de l'execution de la requete '$query_prep_chaine':<br />".mysqli_error($connection)));
	if (!mysqli_stmt_close($query_prep))
		return (ret_errc("Echec de la cloture de la requete '$query_prep_chaine':<br />".mysqli_error($connection)));

	return ($SUCCES);
}
