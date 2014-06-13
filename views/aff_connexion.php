<?PHP

function	aff_connexion_form($login = '', $firstname = '', $lastname = '', $address = '', $zipcode = '', $city = '', $email = '')
{
	echo '
		<div id="register_form"><h2>Connexion</h2>
		<div id="login_form_2"><form method="POST">
			<ul>
				<li><label for="login">Login :</label><input type="text"
				name="login" value="'.$login.'"/></li>
				<li><label for="passwd">Mot de passe :</label><input type="password"
				name="passwd" /></li>
                <li><input type="submit" class="submit" /></li>
			</ul>
		</form></div></div>';
}

function	aff_connexion_erreur($str)
{
	echo "
		<span class=\"register_error\">Erreur pendant la connexion :<br />
		$str<br />Veuillez reessayer.</span>";
}

function	aff_connexion_erreurc($str)
{
	echo "
		<span class=\"register_error\">Erreur CRITIQUE pendant
		la connexion :<br />$str</span>";
}

function	aff_connexion_succes()
{
	echo "
		<span class=\"register_ok\">La connexion s'est bien 
		deroulee.</span>";
}
?>
