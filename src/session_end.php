<?php //cette partie permet à l'utilisateur de se déconnecter
session_start();
if (empty($_SESSION['Email'])) { //si l'utilisateur n'est pas connecté, alors on le redirige vers la page de connexion
    header('location: login.html');
    exit;
}
$_SESSION = array(); //on vide le tableau session
session_destroy(); //on s'assure de détruire le cookie de session et les infos du tableau
?>
<body>
Déconnexion réussie
<br/>
<br/>
<a href="Login.html"> Se connecter </a>
<br/>
<br/>
</body>
</html>