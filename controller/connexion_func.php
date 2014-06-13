<?PHP

function	connexion_check(&$result)
{
	global	$SUCCES, $ERREURC;

	if	(empty($_SESSION)
		|| !isset($_SESSION['login'])
		|| !isset($_SESSION['passwd']))
	{
		$result = FALSE;
		return ($SUCCES);
	}
	if (user_check($_SESSION['login'], $_SESSION['passwd'], $result) != $SUCCES)
		return ($ERREURC);
	return ($SUCCES);
}
