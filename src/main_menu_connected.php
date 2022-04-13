<link rel="stylesheet" href="wallpaper.css">
<div Align = right >
    <a href="main_menu_connected.html">  Retourner sur la page accueil </a>
</div>
<?php
session_start();                                    //on vérifie si l'utilisateur est bien connecté
if (empty($_SESSION['Email'])) {
    header('location: login.html');             //si ce n'est pas le cas on le dirige vers la page de connexion
    exit;
}

$nom = $_POST["Nom"];                   //on recupère le nom du jeu recherché par l'utilisateur

$bdd = new PDO("mysql:host=localhost;dbname=projet_ifd;charset=utf8", "root", "");      //connexion à la base de données
$req = $bdd->query("SELECT * FROM jeu inner join Genre on ID = genre.ID_jeu INNER JOIN plateforme on ID = plateforme.ID_Jeu WHERE jeu.nom LIKE '$nom%'"); //requete pour selectionner les jeux qui contiennent le nom cherché par l'utilisateur

$return = $req->fetch();
if ($return) {
echo "La liste des jeux qui correspondent à votre recherche :";
do                                                      //utilisation d'une boucle do while afin de faire afficher tous les jeux correspondant à la recherche
{
    ?>
    <p>

        <strong>Jeu</strong> : <?php echo $return['nom']; //cette partie permet de faire afficher les informations des jeux ?> &nbsp; &nbsp;
        <strong> Date de sortie : </strong><?php echo $return['Date_sortie']; ?> &nbsp; &nbsp;
        <strong> Nombre maximum de joueurs : </strong> <?php echo $return['Nb_joueurs_max'];?> &nbsp; &nbsp;
        <strong> Prix : </strong> <?php echo $return['Prix'];?>€&nbsp; &nbsp;
        <strong> Genre : </strong> <?php echo $return['Genre'];?>&nbsp; &nbsp;
        <strong> Plateforme : </strong> <?php echo $return['Plateforme'];?>&nbsp; &nbsp;
        <strong> Editeur : </strong> <?php echo $return['Editeur'];?>&nbsp; &nbsp;
        <strong> PEGI : </strong> <?php echo $return['PEGI'];?>
        <strong> ID du jeu : </strong> <mark><?php echo $return['ID'];?></mark>
    </p>
    <?php
}
while ($return= $req->fetch());
} Else
{    exit('Aucun jeu ne correpond à votre recherche');
}
?>
<form method = "post" action = "game_page.php">
    <br>
    Vous avez trouvé votre Jeu ? Tapez son ID <input type = number maxlength="4" name ="ID_du_jeu">         <! on demande à l'utilisateur de saisir le ID du jeu qu'il veut noter et commenter >
    <input type="submit" />
</form>