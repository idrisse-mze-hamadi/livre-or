<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="lvrdor.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <title>Commentaires</title>
</head>
<body>
        
    <header>

        <a href="index.php"><h2>livre d'or</h2></a>

        <div>
            <?php
            session_start();

            if(isset($_POST["deconnexion"]))
            {
                session_destroy();
                header("location:connexion.php");
            }
            
            if(isset($_SESSION["login"]))
            {
                echo "Connecté à ".$_SESSION["login"];
                echo "<form action='' method='post'><input type='submit' name='deconnexion' value='se deconnecter'></form>";
                echo "<a href='profil.php'>Mon profil</a>";
            }
            else
            {
                echo "<a href='connexion.php'>Se connecter</a> ";
                echo "<a href='inscription.php'>S'inscrire</a>";
            }
            ?>
        </div>

    </header>
    <main>
        <?php
            /* REQUETE DE LA BASE DE DONNE ET COINJOINTURE DE DEUX TABLES*/
            $bdd = mysqli_connect("localhost","root", "", "livreor");
            $rqc = mysqli_query($bdd, "SELECT * FROM commentaires INNER JOIN utilisateurs WHERE utilisateurs.id = commentaires.id_utilisateur ORDER BY commentaires.date DESC");
            $rsltc = mysqli_fetch_all($rqc);/*recuperation des résultats*/

            foreach($rsltc as $comm)
            {
                echo "<div class='tabadmin'>Par $comm[5] Posté le $comm[3] <br>$comm[1]</div>"; /*je les affiches ici*/
            }
            if(isset($_SESSION["login"]))
            {
                echo "<a href='commentaire.php'>Laisser un commentaire</a>";
                echo "<a href='index.php'> Revenir a la page d'acceuil</a>";
            }
            else
            {
                echo "<a href='connexion.php'>Connectez-vous pour laisser un commentaire</a>";
            }
        ?>
    </main>
    <footer>
        <div class="footer-content">
            <h3>livre d'or</h3>
            <p>Liens utiles:</p>
            <ul class="socials">
                <li><a href="https://github.com/idrisse-mze-hamadi/livre-or"><i class="fa fa-github"></i></a></li>
            </ul>
        </div>
    </footer>
</body>