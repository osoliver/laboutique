<?PHP
function	get_secured_value($str)
{
	$res = mb_convert_encoding($str, 'UTF-8', 'UTF-8');
	$res = htmlentities($res, ENT_QUOTES, 'UTF-8');
	return ($res);
}
?>
