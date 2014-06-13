<?PHP
$ERREURC = 2;
$ERREUR = 1;
$SUCCES = 0;
$CHAINE_ERREUR = '';

function	ret_errc($str = '')
{
	global $ERREURC, $CHAINE_ERREUR;

	if ($str == '')
		return ($ERREURC);
	$CHAINE_ERREUR = $str;
	return ($ERREURC);
}

function	ret_err($str = '')
{
	global $ERREUR, $CHAINE_ERREUR;

	if ($str == '')
		return ($ERREUR);
	$CHAINE_ERREUR = $str;
	return ($ERREUR);
}
?>
