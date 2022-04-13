
<link rel="stylesheet" href="wallpaper.css">

<div Align = right >
    <a href="main_menu_connected.html">  Retourner sur la page accueil </a>
</div>

<head>
    <meta charset="UTF-8">
    <title>top_commentaires</title>
</head>
<body>
<h1>Voici la section consacrée au commentaires les plus populaires</h1>

<div>
<h2>Numero 1 :</h2>
            <?php
            //On se connecte à la BDD
            $bdd = new PDO("mysql:host=localhost;dbname=projet_ifd;charset=utf8", "root", "");

            /*On compte le nombre de critiques au total, et on récupère ce nombre en demandant sur
            combien de lignes cette requête s'est effectuée*/
            @ $recuperation_nb_critiques = $bdd->query("SELECT COUNT(*) FROM critique");
            $recuperation_nb_comm = $recuperation_nb_critiques -> fetchColumn();

            //Declaration de l'ID et le nombre de likes des meilleur commentaire
            $ID_du_meilleur_commentaire = 0;
            $nb_like_du_meilleur_commentaire = 0;
            $ID_du_meilleur_commentaire2 = 0;
            $nb_like_du_meilleur_commentaire2 = 0;
            $ID_du_meilleur_commentaire3 = 0;
            $nb_like_du_meilleur_commentaire3 = 0;

            //Pour i allant de 1 au nombre de requêtes total
            for($i = 1; $i <= $recuperation_nb_comm; $i++)
            {
                //Cette variable va compter le nombre de like d'un commentaire d'ID = $i
                $variable_compte = 0;

                //On récupère les évaluations associées au commentaire d'ID = $i
                @ $recuperation_nb_like = $bdd->query("SELECT * FROM critique_critique WHERE critique_critique.ID_critique = '$i'");
                $return_nb_like = $recuperation_nb_like->fetch();

                //Ce do while fait effet tant que la $recuperation_nb_like trouve des lignes
            do{
                //On récupère le pouce de l'évaluation associée au commentaire d'ID = $i
            $pouce = @ $return_nb_like['Pouce'];

            //Si pouce == 1 <=> Evaluation positive, notre $variable_compte s'itère de 1
            if ($pouce == 1) {
            $variable_compte++;
                             }

              }while($return_nb_like = $recuperation_nb_like->fetch());

            //On compare ainsi chaque "record de like" de chaque commentaire au meilleur d'entre eux
                //Si le commentaire trouvé rentre dans le top 3, on redécale les suivants pour ne pas perdre des commentaires

                    if ($variable_compte > $nb_like_du_meilleur_commentaire) {
                        $nb_like_du_meilleur_commentaire3 = $nb_like_du_meilleur_commentaire2;
                        $ID_du_meilleur_commentaire3 = $ID_du_meilleur_commentaire2;

                        $nb_like_du_meilleur_commentaire2 = $nb_like_du_meilleur_commentaire;
                        $ID_du_meilleur_commentaire2 = $ID_du_meilleur_commentaire;

                        $nb_like_du_meilleur_commentaire = $variable_compte;
                        $ID_du_meilleur_commentaire = $i;
                    } else if ($variable_compte > $nb_like_du_meilleur_commentaire2) {
                        $nb_like_du_meilleur_commentaire3 = $nb_like_du_meilleur_commentaire2;
                        $ID_du_meilleur_commentaire3 = $ID_du_meilleur_commentaire2;

                        $nb_like_du_meilleur_commentaire2 = $variable_compte;
                        $ID_du_meilleur_commentaire2 = $i;
                    } else if ($variable_compte > $nb_like_du_meilleur_commentaire3) {
                        $nb_like_du_meilleur_commentaire3 = $variable_compte;
                        $ID_du_meilleur_commentaire3 = $i;
                    }

            }//Fin du for

            //On fait les requêtes pour récupérer les informations sur les meilleurs commentaire
            $recuperation_best_comm = $bdd->query("SELECT * FROM critique WHERE critique.ID_critique = '$ID_du_meilleur_commentaire'");
            $return_best_comm = $recuperation_best_comm -> fetch();

            $recuperation_second_comm = $bdd->query("SELECT * FROM critique WHERE critique.ID_critique = '$ID_du_meilleur_commentaire2'");
            $return_second_comm = $recuperation_second_comm -> fetch();

            $recuperation_third_comm = $bdd->query("SELECT * FROM critique WHERE critique.ID_critique = '$ID_du_meilleur_commentaire3'");
            $return_third_comm = $recuperation_third_comm -> fetch();

            //On fait la requête pour récupérer les informations sur l'utilisateur associé à ces commentaires
            $recuperation_best_utilisateur = $bdd->query("SELECT * FROM utilisateur INNER JOIN critique ON utilisateur.ID = critique.ID_utilisateur WHERE critique.ID_critique = '$ID_du_meilleur_commentaire'");
            $return_best_utilisateur = $recuperation_best_utilisateur -> fetch();

            $recuperation_second_utilisateur = $bdd->query("SELECT * FROM utilisateur INNER JOIN critique ON utilisateur.ID = critique.ID_utilisateur WHERE critique.ID_critique = '$ID_du_meilleur_commentaire2'");
            $return_second_utilisateur = $recuperation_second_utilisateur -> fetch();

            $recuperation_third_utilisateur = $bdd->query("SELECT * FROM utilisateur INNER JOIN critique ON utilisateur.ID = critique.ID_utilisateur WHERE critique.ID_critique = '$ID_du_meilleur_commentaire3'");
            $return_third_utilisateur = $recuperation_third_utilisateur -> fetch();

            @ $recup_prenom = $return_best_utilisateur['Prenom'];
            @ $recup_nom = $return_best_utilisateur['Nom'];
            @ $recup_commentaire = $return_best_comm['Commentaire'];

            //Récuperation du nom du jeu associé au meilleur commentaire
            $recuperation_best_comm_jeu = $bdd->query("SELECT * FROM jeu INNER JOIN critique ON jeu.ID = critique.ID_jeu WHERE critique.ID_critique = '$ID_du_meilleur_commentaire'");
            $return_best_comm_jeu = $recuperation_best_comm_jeu -> fetch();
            @ $recup_meilleur_comm_jeu = $return_best_comm_jeu['nom'];


            echo " Le meilleur commentaire est celui de $recup_prenom $recup_nom sur le jeu $recup_meilleur_comm_jeu
            avec $nb_like_du_meilleur_commentaire likes : [$recup_commentaire]";
            ?>

</div>
<br>
<hr>
<div>
    <h2>Numero 2 :</h2>
    <?php
    @ $recup_prenom2 = $return_second_utilisateur['Prenom'];
    @ $recup_nom2 = $return_second_utilisateur['Nom'];
    @ $recup_commentaire2 = $return_second_comm['Commentaire'];

    //Récuperation du nom du jeu associé au deuxieme meilleur commentaire
    $recuperation_second_comm_jeu = $bdd->query("SELECT * FROM jeu INNER JOIN critique ON jeu.ID = critique.ID_jeu WHERE critique.ID_critique = '$ID_du_meilleur_commentaire2'");
    $return_second_comm_jeu = $recuperation_second_comm_jeu -> fetch();
    @ $recup_second_comm_jeu = $return_second_comm_jeu['nom'];

    echo " Le deuxième meilleur commentaire est celui de $recup_prenom2 $recup_nom2 sur $recup_second_comm_jeu  avec $nb_like_du_meilleur_commentaire2 likes : [$recup_commentaire2]";
    ?>
    </div>
<br>
<hr>
<div>
    <h2>Numero 3 :</h2>
    <?php
    @ $recup_prenom3 = $return_third_utilisateur['Prenom'];
    @ $recup_nom3 = $return_third_utilisateur['Nom'];
    @ $recup_commentaire3 = $return_third_comm['Commentaire'];

    //Récuperation du nom du jeu associé au troisième meilleur commentaire
    $recuperation_third_comm_jeu = $bdd->query("SELECT * FROM jeu INNER JOIN critique ON jeu.ID = critique.ID_jeu WHERE critique.ID_critique = '$ID_du_meilleur_commentaire3'");
    $return_third_comm_jeu = $recuperation_third_comm_jeu -> fetch();
    @ $recup_third_comm_jeu = $return_third_comm_jeu['nom'];

    echo " Le troisième meilleur commentaire est celui de $recup_prenom3 $recup_nom3 sur $recup_third_comm_jeu avec $nb_like_du_meilleur_commentaire3 likes : [$recup_commentaire3]";
    ?>
</div>
</body>
