<?php
$bdd = new PDO("mysql:host=localhost;dbname=projet_ifd;charset=utf8", "root", ""); //on se connecte à la base de données
$nom = $_POST["Nom"];                           //les informations de la page html sont stockées dans des variables
$prenom = $_POST["Prenom"];
$date_naissance = $_POST["Date_naissance"];
$ville = $_POST["Ville"];
$pays = $_POST["Pays"];
$genre = $_POST["Genre"];
$email = $_POST["Email"];
$date_creation = date('Y-m-d');     //on utilise le format année-mois-jour pour stocker la date
$mot_de_passe = $_POST["password"];
$question_secrete = $_POST["Question_secrete"];
$question_secrete_hash = md5($question_secrete);    //la sécurité md5() est utilisée pour hasher le mot de passe dans la base de donnéess
$mot_de_passe_hash = md5($mot_de_passe);

$req1 = $bdd->prepare("SELECT * FROM utilisateur WHERE email=?"); //on cherche dans la base de données si le email saisie par l'utilisateur à déjà été utilisé par un des utilisateurs
$req1->execute([$email]);
$user = $req1->fetch();

if ($user) {
    header("Location: Fail_register.html"); //si l'email est présent dans la base de données on demande à l'utilisateur de changer l'adresse email
}
Else {                                              //sinon on stock l'ensemble des informations de l'utilisateur dans la base de données
    $req2 = $bdd->prepare("INSERT INTO utilisateur(Nom, Prenom, Date_naissance, Ville, Pays, Genre, Email, Date_creation, Mot_de_passe, Question_secrete) VALUES (?,?,?,?,?,?,?,?,?,?);");
    $req2->execute([$nom, $prenom, $date_naissance, $ville, $pays, $genre, $email, $date_creation, $mot_de_passe_hash, $question_secrete_hash]);


    header("Location: Sucess.html");        //on affiche un message à l'utilisateur s'il a été bien inscrit
}
?>