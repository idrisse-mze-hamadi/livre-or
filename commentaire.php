<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="lvrdor.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <title>Ajouter un commentaire</title>
</head>

<?php
    session_start();
    if(isset($_POST["deconnexion"]))
    {
        session_destroy();
        header("location:connexion.php");
    }

    if(isset($_SESSION["login"]))
    {
        $login = $_SESSION["login"];

    }
    elseif(!isset($_SESSION["login"]))
    {
        header("location:connexion.php");
    }
    $bdd = mysqli_connect("localhost","root", "", "livreor");
    
    if(isset($_POST["valider"])) /*Lorsqu'on valide le commentaire*/
    {
        $com = $_POST["commentaire"];
        $date = date("Y-m-d H:i:s");
        $rid = mysqli_query($bdd, "SELECT id FROM utilisateurs WHERE login = '$login'");/*une requete est effectué*/
        $r = mysqli_fetch_array($rid);
        $userid = $r['id']; /*on récupere et on crée une variable pour les resultats*/
        header("location:livre-or.php");

        if(isset($com)) /*Ajout du commentaire dans la BDD*/
        {
            $co = mysqli_query($bdd, "INSERT INTO commentaires (commentaire, id_utilisateur, date) VALUES ('$com', '$userid', '$date')");
        }
        else
        {
            echo "Champs vide veuillez le remplir.";
        }
        /*var_dump($co);*/
    }
    elseif(isset($_POST["retour"]))
    {
        header("location:livre-or.php");
    }
?>

<body>
    
    <header>

        <a href="index.php"><h2>livre d'or</h2></a>

        <div>
            <?php
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
        <h1> Commentaire </h1>

        <form class="comcom" method="post">
            <label> Ajouter un commentaire: </label><br>
            <textarea name="commentaire" placeholder="laisser votre commentaire"></textarea><br>
            <button type="submit" name="valider">Ajouter</button> <button type="submit" name="retour">Retour</button><br>
        </form>
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

