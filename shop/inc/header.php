<div id="header">
	<div id="shop"><a href = "index.php">LA BOUTIQUE</a></div>
	<div id="menu">
		<ul>
			<li id="open_menu"><a href="?page=category">Boutique</a>
                <ul id="menu_cat">
                <?PHP
                $query = "SELECT * FROM `categories`";
                $res = mysqli_query($link, $query);
                while ($res_arr = mysqli_fetch_array($res))
                    
                    echo "<li><a href='?page=category&name=".$res_arr['name']."'>".$res_arr['name']."</a></li>";
                ?>
                </ul>
            </li>
			<li><a href="?page=contacts">Contacts</a></li>
			<li><a href="?page=info">Informations</a></li>
		</ul>
	</div>
	<div id="user">
	<div id="basket"><a href="index.php?page=basket">Mon panier(<?PHP echo intval($_SESSION['basket-total']) ?>)</a></div>
<?PHP
		connexion_check($result);
        if (!$result)
        {
            echo'
		<div id="register"><a href="index.php?page=register">Inscription</a></div>
        <div class="separator">|</div>
        <div id="connect"><a href="index.php?page=login">Connexion</a></div>';
        }
        else
        {
            echo'
		<div id="register"><a href="index.php?page=logout">Deconnexion</a></div>
        <div class="separator">|</div>
		<div id="account"><a href="index.php?page=myaccount">Mon compte</a></div>';
        }
        ?>
	</div>
</div>
