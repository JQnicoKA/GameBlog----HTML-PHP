<?php
$email = $_POST["Email"];               //on stocke l'email et le mot de passe de l'utilisateur  dans des variables pour effectuer des vérifications
$mot_de_passe = $_POST["Mot_de_passe"];
$mot_de_passe_hash = md5($mot_de_passe);

$bdd = new PDO("mysql:host=localhost;dbname=projet_ifd;charset=utf8", "root", ""); //on se connecte a la base de données
$req1 = $bdd->prepare("SELECT Mot_de_passe FROM utilisateur WHERE email=?");    //on cherche dans la base l'email saisie par l'utilisateur
$req1->execute([$email]);
$b_ligne = $req1->fetch();
$b_mot_de_passe = $b_ligne['Mot_de_passe'];

if ( $mot_de_passe_hash == $b_mot_de_passe )               //on verifie maintenant si le mot de passe saisie par l'utilisateur correspond bien au mot de passe qui est dans la base de données
    {
        session_start();
        $_SESSION['Email'] = $email;
        header("Location: main_menu_connected.html");   //si les identifiants sont corrects alors on demarre la session
    } else
        {
        header("Location: Fail_login.html");          //si les informations ne sont pas vérifiées alors on demande à l'utilisateur de vérifier ses identifiants
        }
?>