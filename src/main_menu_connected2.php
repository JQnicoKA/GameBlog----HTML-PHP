<link rel="stylesheet" href="wallpaper.css">
<div Align = right >
    <a href="main_menu_connected.html">  Retourner sur la page accueil </a>
</div>
<?php
session_start();
if (empty($_SESSION['Email'])) {                             //on verifie que l'utilisateur est bien connecté
    header('location: login.html');
    exit;
}
$plateforme = $_POST["Plateforme"];                         //on recupère les informations du jeu (plateforme,genre et Pegi)
$genre = $_POST["Genre"];
$pegi = $_POST["Pegi"];
$bdd = new PDO("mysql:host=localhost;dbname=projet_ifd;charset=utf8", "root", ""); // connexion a la base de données

$req = $bdd->query("SELECT * from jeu inner join  genre on ID= genre.ID_jeu INNER JOIN plateforme on ID=plateforme.ID_Jeu WHERE plateforme.Plateforme = '$plateforme' AND genre.GENRE= '$genre' AND jeu.PEGI= '$pegi'"); //on selectionne dans la base de données les jeux qui correspondent aux critères recherchées par l'utilisateur
$return = $req->fetch();
if ($return) {
echo "La liste des jeux qui correspondent à votre recherche ( pour commenter, taper le nom du jeu dans la barre de recherche de l'accueil ):";
do              //on utilise une boucle do while pour faire afficher tous les jeux correspondant à la recherche
{
    ?>
    <p>

        <strong>Jeu</strong> : <?php echo $return['nom'];                               // on affiche les informations du jeu depuis la base de données?> &nbsp; &nbsp;
        <strong> Date de sortie : </strong><?php echo $return['Date_sortie']; ?> &nbsp; &nbsp;
        <strong> Nombre maximum de joueurs : </strong> <?php echo $return['Nb_joueurs_max'];?> &nbsp; &nbsp;
        <strong> Prix : </strong> <?php echo $return['Prix'];?>€&nbsp; &nbsp;
        <strong> Genre : </strong> <?php echo $return['Genre'];?>&nbsp; &nbsp;
        <strong> Plateforme : </strong> <?php echo $return['Plateforme'];?>&nbsp; &nbsp;
        <strong> Editeur : </strong> <?php echo $return['Editeur'];?>&nbsp; &nbsp;
        <strong> PEGI : </strong> <?php echo $return['PEGI'];?>&nbsp; &nbsp;
    </p>
    <?php

}while ($return= $req->fetch());
} Else
{    exit('Aucun jeu ne correpond à votre recherche');  //si aucun jeu ne correspond aux critères alors on l'indique à l'utilisateur
}

?>




