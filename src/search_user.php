<link rel="stylesheet" href="wallpaper.css">
<?php
session_start();
if (empty($_SESSION['Email'])) { //On vérfie que l'utilisateur est connecté, sinon on le redirige vers la page de connexion
    header('location: login.html');
    exit;
}
$nom = $_POST["Username"]; //on récupère les données du formulaire précèdent
$bdd = new PDO("mysql:host=localhost;dbname=projet_ifd;charset=utf8", "root", ""); //Connexion à la base de données
$req = $bdd->query("SELECT * FROM Utilisateur WHERE utilisateur.Prenom LIKE '$nom%' OR utilisateur.Nom LIKE '$nom%'");
$return = $req->fetch(); //on récupère la liste des utilisateurs par rapport à leur nom et prénom ressemblant aux données du formulaire précédent

if ($return) { // Condition permettant d'afficher les infos des utilisateurs, affiche un message le cazs échéant.
echo "Voici les utilisateurs correspondants à votre recherche :";
do
{
    ?>
    <p>

        <strong>Prénom : </strong><?php echo $return['Prenom']; ?> &nbsp; &nbsp;
        <strong> Nom : </strong><?php echo $return['Nom']; ?> &nbsp; &nbsp;
        <strong> ID : </strong><?php echo $return['ID']; ?> &nbsp; &nbsp;
    </p>
    <?php

}while ($return= $req->fetch());
} Else // Message pour informer l'utilisateur que sa recherche ne correspond a rien
{    exit('Aucun utilisateur ne correpond à votre recherche');
}
?>
<form method="post" action="add_friend.php"> <! Formulaire permettant d'envoyer l'ID utilisateur choisi au fichier add_friend.php >
    <label>
        <br />
        ID de l'utilisateur : <input type="number" name="Id_friend" min = "1"  required="required" placeholder="999"/>
    </label>
    <br />
    <br />
    <input type="submit" />
</form>
