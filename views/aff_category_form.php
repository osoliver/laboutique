<?PHP

function	aff_category_header()
{
	echo '
<html>
	<head>
		<title>Ajouter categorie</title>
	</head>
	<body>';
	include('adm_header.php');
}

function	aff_category_form($name = '')
{
	echo '
		<h1>Ajouter categorie</h1>
		<form action="add_category.php" method="POST">
			<ul>
				<li><label for="name">Nom :</label><input type="text"
				name="name" value="'.$name.'"/></li>
			</ul>
			<input type="submit" />
		</form>';
}

function	aff_category_footer()
{
	echo '
	</body>
	</html>';
}

function	aff_category_erreur($str)
{
	echo "
		<span style=\"color:red;font-weight:bold\">Erreur pendant la creation de categorie :<br />
		$str<br />Veuillez reessayer.</span>";
}

function	aff_category_erreurc($str)
{
	echo "
		<span style=\"color:red;font-weight:bold\">Erreur CRITIQUE pendant
		la creation de categorie :<br />$str</span>";
}

function	aff_category_succes()
{
	echo "
		<span style=\"color:green;font-weight:bold\">La creation de categorie s'est bien deroule.</span>";
}
?>
