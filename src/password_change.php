<?php

$email = $_POST["Email"];                       //on recupere l'email et la question secrète saisie par l'utilisateur
$question_secrete = $_POST["Question_secrete"];
$question_secrete_hash = md5($question_secrete);

$mot_de_passe2 = $_POST["password"];
$mot_de_passe_hash2 = md5($mot_de_passe2);

$bdd = new PDO("mysql:host=localhost;dbname=projet_ifd;charset=utf8", "root", "");      //on se connecte à la base de données
$req1 = $bdd->prepare("SELECT Question_secrete FROM utilisateur WHERE email=?");                // dans cette partie du code ,on verifie la question secrète
$req1->execute([$email]);
$b_ligne = $req1->fetch();
$b_question_secrete = $b_ligne['Question_secrete'];

if ( $question_secrete_hash == $b_question_secrete )
{

    $req2 = $bdd->prepare("UPDATE utilisateur SET utilisateur.Mot_de_passe = '$mot_de_passe_hash2' WHERE utilisateur.Email =?");        // si la question secrète est verifiée alors on modifie le mot de passe de l'utilisateur dans la base de données
    $req2->execute([$email]);
    header("Location: Sucess_password_change.html");                    //on indique à l'utilisateur que son mot de passe à été modifié
} else
{
    header("Location: Fail_forgot.html");
}

?>