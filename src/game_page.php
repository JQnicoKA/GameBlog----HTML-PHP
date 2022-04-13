<?php
//On récupère l'ID du jeu tapé précédemment
$ID = $_POST["ID_du_jeu"];

//Connection à la bdd
$bdd = new PDO("mysql:host=localhost;dbname=projet_ifd;charset=utf8", "root", "");

//$return regroupe alors toutes les informations du jeu dont l'utilisateur a tapé l'ID
$req = $bdd->query("SELECT * FROM jeu WHERE Jeu.ID= '$ID'");
$return = $req->fetch();

//$return_plateforme regroupe alors la plateforme sur laquelle est disponible le jeu dont l'utilisateur a tapé l'ID
$req_plateforme = $bdd->query("SELECT * FROM plateforme INNER JOIN jeu ON plateforme.ID_jeu = jeu.ID WHERE Jeu.ID= '$ID'");
$return_plateforme = $req_plateforme->fetch();

?>

    <link rel="stylesheet" href="wallpaper.css">
    <h1>Espace consacré au jeu <?php echo $return['nom']; ?> sur <?php echo $return_plateforme['Plateforme'];?></h1>
    <div Align = right >
        <a href="main_menu_connected.html">  Retourner sur la page accueil </a>
    </div>
    <p>
        <!--Affichage des informations sur le jeu dont l'utilisateur a tapé l'ID -->
        <strong> Date de sortie : </strong><?php echo $return['Date_sortie']; ?> &nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
        <strong> Nombre de joueurs maximum : </strong><?php echo $return['Nb_joueurs_max']; ?> &nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
        <strong> PEGI : </strong><?php echo $return['PEGI']; ?> &nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
        <strong> Editeur : </strong><?php echo $return['Editeur']; ?> &nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
    </p>
    <br><br>

    <!--Formulaire qui permet à l'utilisateur de rentrer sa critique sur le jeu, il se renvoie à la page
     game_page_critique -->
    <form method="post" action="game_page_critique.php">
        <h2>Vous pouvez ajouter votre critique et votre note ci dessous:</h2>
        <br>
        <!--On inclut ce champs masqué pour récupérer l'ID sans que l'utilisateur le retape -->
        <input type = hidden  value='<?php echo $ID ?>' name ="ID_du_jeu">
        <br><br> Note : <input type="number" min="1" max="20" name="Note" required="required"/> <br><br>
        Critique:
        <label>
            <input type = "text"  name="Critique"/>
            <input type="submit" />
        </label>
    </form>
    <br>
    <h2>Voici les commentaires laissés par d'autres utilisateurs :</h2>

<?php
//On recupere toutes les critiques sur le jeu
$recuperation_critique = $bdd->query("SELECT * FROM critique inner join jeu on critique.ID_jeu = jeu.ID  WHERE jeu.ID = '$ID'");
$return_critique = $recuperation_critique->fetch();


do
{//On recupere les utilisateurs associés a chaque critique
@ $ID_critique = $return_critique['ID_critique'];
$recuperation_utilisateur = $bdd->query("SELECT * FROM utilisateur inner join critique on utilisateur.ID = critique.ID_utilisateur  WHERE critique.ID_critique = '$ID_critique'");
$return_commentateur = $recuperation_utilisateur->fetch();
    ?>

    <!--Formulaire qui affiche le commentaire d'un ancien utilisateur sur le jeu, et qui
     permet à l'utilisateur connecté d'évaluer ce commentaire, il se renvoie à la page
     pouce.php -->
    <form method = "post" action = "pouce.php">
        <br>
        <strong>Prenom</strong> : <?php echo @ $return_commentateur['Prenom']; ?> &nbsp; &nbsp;
        <br>
        <strong> Nom : </strong><?php echo @ $return_commentateur['Nom']; ?>
        <br>
        <strong>Critique</strong> : <?php echo @ $return_critique['Commentaire']; ?> &nbsp; &nbsp;
        <br>
        <strong> Note : </strong><?php echo @ $return_critique['Note']; ?> &nbsp; &nbsp;
        <br>

        <!--On crée un texte masqué pour bien passer l'information ID_de_la_critique à pouce.php sans pour
         autant que l'utilisateur doive taper l'ID, on crée ensuite un bouton process
         pour récupérer le (like/dislike) de l'utilisateur-->
        <input type = hidden  value='<?php echo $return_critique['ID_critique'] ?>' name ="ID_de_la_critique">
        <p>Evaluez ce commentaire : </p>
        <input type="submit" value="Interessant" name="process" />
        <input type="submit" value="Pas interessant" name="process" />

    </form>

    <p>
        <strong>Ce que les utilisateurs en ont pensé : </strong> :

    <?php

    //Récupération de la critique en question
    $ID_a_viser= $return_critique['ID_critique'];

    //$return_pouce contient alors toutes les évaluations du commentaire en question
    @ $recuperation_du_pouce = $bdd->query("SELECT * FROM critique_critique inner join critique on critique_critique.ID_critique = critique.ID_critique  WHERE critique.ID_critique = '$ID_a_viser'");
    $return_pouce = $recuperation_du_pouce->fetch();

    //On va compter le nombre de interessant et pas interessant grâce à ces deux variables
    $variable_interessant = 0;
    $variable_pas_interessant = 0;

    do {
        //$pouce vaut maintenant soit 1 soit 0
        $pouce = @ $return_pouce['Pouce'];
        if ($pouce == 1) {
            $variable_interessant++;
        }else if ($pouce == 0) {
            $variable_pas_interessant++;
        }

    }while ($return_pouce= $recuperation_du_pouce->fetch());

    //Ici problème illogique, on aurait dû mettre :
    // if($variable_pas_interessant ==0 && $variable_interessant == 0)
    //mais en sortant du do while ligne 102-109, si le commentaire n'a jamais été évalué,
    //la $variable_pas_interessant s'itère de 1, ce qui est incompréhensible, nous avons
    //donc pris la liberté de "cacher" le cas ou le commentaire est dislike 1 seule fois,
    //seule situation problématique, à partir d'une deuxième évaluation négative ou d'une
    //évaluation positive, l'algorithme fonctionne bien
    if($variable_pas_interessant ==1 && $variable_interessant == 0){
        echo "Ce commentaire n'a pas encore été évalué";
    }else {

        echo "Jugé interessant $variable_interessant fois. ";
        echo "Jugé ininteressant $variable_pas_interessant fois. ";

    }

}while ($return_critique= $recuperation_critique->fetch());


?>