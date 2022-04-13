<?php                           //les utilisateurs doivent être connectés pour pouvoir ajouter des jeux dans la base
session_start();                            //on vérifie si l'utilisateur est bien connecté sur le site
if (empty($_SESSION['Email'])) {
    header('location: login.html');  // si ce n'est pas le cas on dirige l'utilisateur vers la page connexion
    exit;
}
$nom=$_POST["nom"];                             // on récupère les informations du jeu saisi par l'utilisateur en utilisant les variables
$date_sortie = $_POST["release_date"];
$plateforme = $_POST["Plateforme"];
$nombre_joueurs_max = $_POST["nb_player"];
$prix = $_POST["price"];
$pegi = $_POST["pegi"];
$genre = $_POST["genre"];
$editeur = $_POST["Editeur"];


$bdd = new PDO("mysql:host=localhost;dbname=projet_ifd;charset=utf8", "root", "");      //on se connecte a la base de données
$req =  $bdd->prepare("INSERT INTO jeu (Date_sortie,Nb_joueurs_max,Prix,PEGI,nom,Editeur) VALUES (?,?,?,?,?,?);");  //on insere le nouveau jeu dans la base de données dans le jeu table
$req -> execute([$date_sortie,$nombre_joueurs_max,$prix,$pegi,$nom,$editeur]);
$last_id = $bdd->lastInsertId();
$req2 = $bdd ->prepare("Insert INTO genre (Genre,Id_jeu) VALUES (?,?);");           //on insère le genre du jeu dans la bdd dans la table genre
$req2-> execute([$genre,$last_id]);
$req3 = $bdd ->prepare("Insert INTO plateforme (Plateforme,Id_jeu) VALUES (?,?);"); //de la même manière on insère le plateforme du jeu dans la bdd dans la table plateforme
$req3-> execute([$plateforme,$last_id]);
header("Location: Sucess_add_game.html");           //on indique à l'utilisateur que le jeu est ajouté dans la base de données
?>