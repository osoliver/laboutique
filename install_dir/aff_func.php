<?PHP
function	aff_header()
{
	echo '
<html>
	<head>
		<title>Installation</title>
	</head>
	<body>';
}

function	aff_formulaire($login = '', $bdd = '', $bdd_host = '', $bdd_login = '')
{
	echo '
		<h1>Installation</h1>
		<form action="install.php" method="POST">
			<h2>Base de donnees</h2>
			<p>Attention, si la base de donnee existe deja elle sera remplacee.</p>
			<ul>
				<li><label for="bdd_host">Host de la BDD :</label><input type="text"
				name="bdd_host" value="'.$bdd_host.'"></li>
				<li><label for="bdd_login">Login de la BDD :</label><input type="text"
				name="bdd_login" value="'.$bdd_login.'"></li>
				<li><label for="bdd_pwd">Mot de passe de la BDD :</label><input
				type="password" name="bdd_pwd"></li>
				<li><label for="bdd">Nom de la base de donnees</label><input type="text"
				name="bdd" value="'.$bdd.'"/></li>
			</ul>
			<h2>Administrateur</h2>
			<ul>
				<li><label for="login">Login :</label><input type="text"
				name="login" value="'.$login.'"/></li>
				<li><label for="passwd">Mot de passe :</label><input type="password"
				name="passwd" /></li>
			</ul>
			<input type="submit" />
		</form>';
}

function	aff_footer()
{
	echo '
	</body>
	</html>';
}

function	aff_erreur($str)
{
	echo "
		<span style=\"color:red;font-weight:bold\">Erreur pendant la creation :<br />
		$str<br />Veuillez reessayer.</span>";
}

function	aff_erreurc($str)
{
	echo "
		<span style=\"color:red;font-weight:bold\">Erreur CRITIQUE pendant
		la creation :<br />$str</span>";
}
function	aff_succes()
{
	echo "
		<span style=\"color:green;font-weight:bold\">La creation s'est bien deroulee.<br />
		Dans le cadre de l'exercice, install.php ne sera pas supprime.</span>";
}
?>
