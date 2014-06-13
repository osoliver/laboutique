<?PHP

function	set_connection_settings($host, $user, $passwd, $bdd)
{
	global	$SUCCES;

	$settings['host'] = $host;
	$settings['user'] = $user;
	$settings['passwd'] = $passwd;
	$settings['bdd'] = $bdd;
	$string_settings = '<?PHP $serial_settings = \''.serialize($settings).'\'; ?>';
	if (!file_put_contents('settings.php', $string_settings))
		return (ret_errc("Impossible d'enregister la configuration dans settings.php"));
	return ($SUCCES);
}

function	get_connection_settings()
{
	include('settings.php');
	$settings = unserialize($serial_settings);
	return ($settings);
}

function	my_connect()
{
	global	$CHAINE_ERREUR;

	$settings = get_connection_settings();
	$connection = @mysqli_connect($settings['host'], $settings['user'],
		$settings['passwd'], $settings['bdd'], 3306);
	if (mysqli_connect_errno())
	{
		$CHAINE_ERREUR = "Connexion a la base mysql echouee :<br />"
			.mysqli_connect_error();
		return (NULL);
	}
	return ($connection);
}

function	set_db($bdd)
{
	global	$SUCCES;

	$settings = get_connection_settings();
	if (set_connection_settings($settings['host'], $settings['user'], $settings['passwd'],
			$bdd) != $SUCCES)
		return (ret_errc("Impossible de changer la base de donnee"));
	return ($SUCCES);
}

?>
