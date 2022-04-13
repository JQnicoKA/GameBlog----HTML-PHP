<link rel="stylesheet" href="wallpaper.css">
<div Align = right >
    <a href="main_menu_connected.html">Accueil</a>
</div>
<?php
session_start();
if (empty($_SESSION['Email'])) { //on verifie que l'utilisateur est connecté, le cas échéant, on le redirige vers la page de connexion
    header('location: login.html');
    exit;
}
$bdd = new PDO("mysql:host=localhost;dbname=projet_ifd;charset=utf8", "root", ""); //connexion à la base
$req1 = $bdd->query('SELECT * FROM utilisateur WHERE Email="'.$_SESSION['Email'].'"');
$return1 = $req1->fetch(); //on récupère les infos de l'utilisateur connecté grâce au tableau $_SESSION
$req = $bdd->query('SELECT * FROM Utilisateur INNER JOIN ami on ID = ami.ID_ami WHERE ID_Utilisateur="'.$return1['ID'].'"');
$return = $req->fetch(); // On récupère les infos des amis de l'utilisateur connecté
if ($return) {  // si l'utilisateur possède des amis, alors on les affiche
echo "Voici vos amis :";
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
} Else //Sinon, on le notifie qu'il n'en possède pas
{    exit('Vous ne suivez aucun ami');
}
?>
<form method="post" action="search_critique.php"> <! Formulaire permettant d'inscrire l'ID d'un amis, puis de les envoyer dans le fichier php search_critique>
    <label>
        <br />
        Vous souhaitez consulter les avis de vos amis ?:
        <br />
        Tapez l'ID de votre ami :<input type="text" name="Id_friend" required="required" placeholder="999"/>
    </label>
    <br />
    <br />
    <input type="submit" />
</form>
