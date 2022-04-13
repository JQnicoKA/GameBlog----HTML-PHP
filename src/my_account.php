<link rel="stylesheet" href="wallpaper.css">
<?php                                   //cette partie permet d'afficher les informations du compte de l'utilisateur
session_start();
if(empty($_SESSION['Email'])){                      //on verifie si l'utilisateur est connecté
    header('location: login.html');     //sinon il est dirigé vers la page de connexion
    exit;
}
$bdd = new PDO("mysql:host=localhost;dbname=projet_ifd;charset=utf8", "root", "");
$req1 = $bdd->query('SELECT * FROM utilisateur WHERE Email="'.$_SESSION['Email'].'"');      //on identifie l'utilisateur dans la base de données
$return = $req1->fetch();
?>

<div Align = right >
    <a href="main_menu_connected.html">Accueil</a>
</div>
<p>
    <h> <strong> Voici vos données personnelles </strong> </h> <br /> <br /> <br />                             <! on affiche les informations personnelles de l'utilisateur >
    <strong>Votre nom </strong> : <?php echo $return['Nom']; ?> <br /> <br />
    <strong> Votre prenom : </strong><?php echo $return['Prenom']; ?><br /> <br />
    <strong> Date de naissance : </strong><?php echo $return['Date_naissance']; ?><br /> <br />
    <strong> Pays : </strong><?php echo $return['Pays']; ?><br /> <br />
    <strong> Ville : </strong><?php echo $return['Ville']; ?><br /> <br />
    <strong> Genre : </strong><?php echo $return['Genre']; ?><br /> <br />
    <strong> Votre compte a été créé le : </strong><?php echo $return['Date_creation']; ?><br /> <br />
    <strong> ID : </strong><?php echo $return['ID']; ?><br /> <br />
