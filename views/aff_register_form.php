<?PHP

function	aff_register_form($login = '', $firstname = '', $lastname = '', $address = '', $zipcode = '', $city = '', $email = '')
{
	echo '
		<div id="register_form"><h2>Inscription</h2>
		<div id="register_form_2"><form action="index.php?page=register" method="POST">
			<h3>Informations basiques</h3>
			<ul>
				<li><label for="login">Login :</label><input type="text"
				name="login" value="'.$login.'"/></li>
				<li><label for="passwd">Mot de passe :</label><input type="password"
				name="passwd" /></li>
				<li><label for="passwd_conf">Confirmer mot de passe :</label><input
				type="password" name="passwd_conf" /></li>
			</ul>
			<h3>Personnel</h3>
			<ul>
				<li><label for="firstname">Prenom :</label><input type="text"
				name="firstname" value="'.$firstname.'" /></li>
				<li><label for="lastname">Nom :</label><input type="text"
				name="lastname" value="'.$lastname.'" /></li>
				<li><label for="email">Email :</label><input type="text"
				name="email" value="'.$email.'" /></li>
			</ul>
			<h3>Necessaire pour les commandes</h3>
			<ul>
				<li><label for="address">Adresse :</label><input type="text"
				name="address" value="'.$address.'" /></li>
				<li><label for="zipcode">Code Postal :</label><input type="text"
				name="zipcode" value="'.$zipcode.'" /></li>
				<li><label for="city">Ville :</label><input type="text"
				name="city" value="'.$city.'" /></li>
                <li><input type="submit" class="submit" /></li>
			</ul>
		</form></div></div>';
}

function	aff_register_erreur($str)
{
	echo "
		<span class=\"register_error\">Erreur pendant l'enregistrement :<br />
		$str<br />Veuillez reessayer.</span>";
}

function	aff_register_erreurc($str)
{
	echo "
		<span class=\"register_error\">Erreur CRITIQUE pendant
		l'enregistrement :<br />$str</span>";
}

function	aff_register_succes()
{
	echo "
		<span class=\"register_ok\">L'enregistrement s'est bien 
		deroule.<br />Vous pouvez desormais vous connecter.</span>";
}
?>
