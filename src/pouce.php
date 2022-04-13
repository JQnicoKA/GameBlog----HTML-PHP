<?php
session_start();
$ID_critique =  $_POST["ID_de_la_critique"]; // on récupère les infos du formulaire précédent
$Pouce = $_POST["process"];
$bdd = new PDO("mysql:host=localhost;dbname=projet_ifd;charset=utf8", "root", ""); //on se connecte à la base de données
$req1 = $bdd->query('SELECT * FROM utilisateur WHERE Email="'.$_SESSION['Email'].'"');
$return = $req1->fetch(); //on récupère les infos de l'utilisateur connecté grace au tableau $_SESSION

$id_utilisateur = $return['ID'];

if ($Pouce == "Interessant"){ //on fixe la valeur du bouton interessant
    $valeur = 1;
}else{
    $valeur = 0;
}
$req_user = $bdd->query('SELECT * FROM critique_critique  WHERE ID_utilisateur="'.$id_utilisateur.'" AND ID_critique ="'.$ID_critique.'" ');
$user = $req_user->fetch(); // on récupère les critiques (interessant) associé à l'utilisateur et au commentaire en question

if ($user) { //condition permettant d'empêcher l'ajout de plusieurs critiques sur un même commentaire de jeu
    header("Location: Fail_pouce.html");
}
Else { //si la critique n'existe pas, alors on peut ajouter les infos dans la base de données
    $req_pouce = $bdd->prepare("Insert INTO critique_critique (ID_critique, Pouce, ID_utilisateur) VALUES (?,?,?);");
    $req_pouce->execute([$ID_critique, $valeur, $id_utilisateur]);
}
?>

<link rel="stylesheet" href="wallpaper.css">
Merci d'avoir noté ce commentaire ! <a href="main_menu_connected.html">Accueil</a>
