<?php
session_start();
//On récupère l'ID utilisteur de l'ami associé
$id_ami = $_POST["Id_friend"];
// on se connecte à la base de données
$bdd = new PDO("mysql:host=localhost;dbname=projet_ifd;charset=utf8", "root", "");

$req1 = $bdd->query('SELECT * FROM utilisateur WHERE Email="'.$_SESSION['Email'].'"');
$return = $req1->fetch(); //On récupère les données associée à l'utilisateur connecté grâce au tableau $_Session
$id_utilisateur = $return['ID'];// on récupère l'ID utilisateur pour l'utiliser dans la prochaine requête
$req3 = $bdd->query('SELECT * FROM ami WHERE ID_Utilisateur="'.$id_utilisateur.'" AND ID_ami ="'.$id_ami.'" ');
$user = $req3->fetch();
if ($user) { //On récupère les données associée à l'ID de l'utilisateur connecté et à l'ID amis que l'on souhaite ajouter, puis on vérifie si l'utilisateur n'a pas déjà ajouté cet ami
    header("Location: Fail_add_friend.html");
}
Else { //si ami inexistant, alors on envoit les infos de l'ami à la base de données
    $req2 = $bdd->prepare("INSERT INTO ami (ID_Utilisateur,ID_ami) VALUES (?,?);");
    $req2->execute([$return['ID'], $id_ami]);
    header("Location: Sucess_friend.html");
    //on redirige vers une page de succès
}