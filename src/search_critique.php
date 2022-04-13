<link rel="stylesheet" href="wallpaper.css">
<div Align = right >
    <a href="main_menu_connected.html">  Retourner sur la page accueil </a>
</div>
<?php
$id_friend = $_POST['Id_friend']; // on récupère les infos du formulaire précédent
$bdd = new PDO("mysql:host=localhost;dbname=projet_ifd;charset=utf8", "root", ""); // connection a la base de données
$req = $bdd->query("SELECT * from critique INNER JOIN utilisateur ON critique.ID_utilisateur= utilisateur.ID INNER JOIN jeu ON critique.ID_Jeu=jeu.ID INNER JOIN plateforme ON critique.ID_Jeu = plateforme.ID_Jeu WHERE ID_utilisateur = '$id_friend'");

$return = $req->fetch(); // on récupère les infos des critiques associées à l'utilisateur, au jeu, à la plateforme et à l'utilisateur
$ID_a_viser=$return['ID_critique'];
@ $recuperation_du_pouce = $bdd->query("SELECT * FROM critique_critique inner join critique on critique_critique.ID_critique = critique.ID_critique  WHERE critique.ID_critique = '$ID_a_viser'");
@ $return_pouce = $recuperation_du_pouce->fetch();

// on récupère le nombre de pouces associée au commentaire (critique) en question
if ($return) { //condition permmettant de ne pas afficher les critiques si rien n'est retourné par la requête précédente
    echo "Voici les critiques associées à votre ami(e) ";
    echo $return['Prenom'];
    echo " ";
    echo $return['Nom'];
    do // boucle permettant d'afficher toutes les critiques existantes associées a l'ami en question
    {
        ?>
        <p>


            <strong> Nom du jeu : </strong><?php echo $return['nom']; ?> &nbsp; &nbsp;
            <strong> Plateforme : </strong><?php echo $return['Plateforme']; ?> &nbsp; &nbsp;
            <strong> Critique : </strong><?php echo $return['Commentaire']; ?> &nbsp; &nbsp;
            <strong> Note : </strong><?php echo $return['Note']; ?> &nbsp; &nbsp;
            <strong> Pouces : </strong> <?php if (@$return_pouce['count(Pouce)'] > 0) { echo $return_pouce['Pouce'];} Else {echo '0';}  ?> &nbsp; &nbsp;
        </p>
        <?php

    }while ($return= $req->fetch());
} Else
{    exit('Votre ami ne possède pas de critique');
}
?>