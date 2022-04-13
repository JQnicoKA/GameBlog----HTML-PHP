<?php

$bdd = new PDO("mysql:host=localhost;dbname=projet_ifd;charset=utf8", "root", "");

session_start();
//$note et $commentaire sont la note et le commentaire que l'utilisateur attribue au jeu, formulaire plus bas
@ $note = $_POST["Note"];
@ $commentaire = $_POST["Critique"];
@ $ID_jeu = $_POST["ID_du_jeu"];

//$return_utilisateur regroupe toutes les informations sur l'utilisateur connecté avec la variable de session Email
$req_utilisateur = $bdd->query('SELECT * FROM utilisateur WHERE Email="'.$_SESSION['Email'].'"');
$return_utilisateur = $req_utilisateur->fetch();
$id_utilisateur = $return_utilisateur['ID'];
$req_user = $bdd->query('SELECT * FROM critique WHERE ID_utilisateur="'.$id_utilisateur.'" AND ID_jeu ="'.$ID_jeu.'" ');
$user = $req_user->fetch();

if ($user) {
    header("Location: Fail_critique.html");
}
Else {

//$req_ajout_critique est la requête qui permet de mettre la critique de l'utilisateur dans la bdd
    $req_ajout_critique = $bdd->prepare("Insert INTO critique (Note,ID_utilisateur,Commentaire,ID_jeu) VALUES (?,?,?,?);");
    $req_ajout_critique->execute([$note, $return_utilisateur['ID'], $commentaire, $ID_jeu]);
}
?>

<link rel="stylesheet" href="wallpaper.css">
<p>Merci d'avoir noté un jeu !</p>
<div Align = right >
    <a href="main_menu_connected.html">  Retourner sur la page accueil </a>
</div>
