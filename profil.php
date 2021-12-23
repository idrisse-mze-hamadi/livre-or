<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="lvrdor.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
        <title>Modifier son profil</title>
    </head>

    <?php

        //ouverture de la session
        session_start();

        if(isset($_POST["deconnexion"]))
        {
            session_destroy();
            header("location:connexion.php");
        }
        //Modification du profil

        $bdd = mysqli_connect("localhost", "root", "", "livreor"); //On ce connecte a la base de donnée

        if (isset($_SESSION["login"])) // Quand on est connecté
        {
            $login = $_SESSION["login"];
            $rq = mysqli_query($bdd, "SELECT password FROM utilisateurs WHERE login='$login'");
            $ri = mysqli_fetch_assoc($rq); //on récupère le mdp pour l'afficher
            $password = $ri['password'];
                        
            if (isset($_POST["modification"])) // Quand on appuis sur valider 
            {

                $nlogin = $_POST["login"];
                $password = $_POST["password"];
                $npassword = $_POST["npassword"];
                $rnpassword = $_POST["rnpassword"];

                if ($rnpassword != $npassword)
                {
                    echo "Les mots de passe sont différents";
                }
                else
                {
                    // si toutes les informations rentré ne sont pas connu de la base de donnée la modification sera faite.
                    $rqtu = mysqli_query($bdd, "UPDATE utilisateurs SET login='$nlogin', password='$npassword' WHERE login='$login'");            
                    $_SESSION["login"] = $nlogin;
                    $_SESSION["password"] = $npassword;
                    $_SESSION["npassword"] = $npassword;
                    $_SESSION["rnpassword"] = $npassword;

                    if ($rqtu)
                    {
                        echo "modification réussie.";
                    }
                    else
                    {
                        echo "modification échoué";
                    }
                }
            }
            elseif (isset($_POST["annuler"]))
            {
                header("location:index.php");
            }
        }
        else
        {
            header("location:connexion.php");
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
        <!--Formulaire d'inscription-->

        <form action="" method="post">
            <div class="pro">

                <h1>Modifier son profil</h1>
                <p>Veuillez remplir ce formulaire pour modifier les informations de votre profil.</p>
                
                <hr>
                    <div class="inlapro">
                        <label for="login"><b>Login</b></label>
                        <input type="text" placeholder="Login" name="login" value="<?php echo ($_SESSION["login"]);?>"required>
                        
                        <label for="password"><b>Mot de passe</b></label>
                        <input type="text" placeholder="Votre mot de passe actuel" name="password" value="<?php echo ($password);?>"required>

                        <label for="npassword"><b>Nouveau mot de passe</b></label>
                        <input type="password" placeholder="Votre nouveau mot de passe" name="npassword">

                        <label for="rnpassword"><b>Confirmation du nouveau mot de passe</b></label>
                        <input type="password" placeholder="Confirmation du nouveau mot de passe" name="rnpassword">
                    </div>
                <hr>

                <div class="inp">
                    <input type="submit" name="modification" class="button_inp" value="valider" action="">
                    <input type="submit" name="annuler" class="button_inp" value="annuler" action="">
                </div>

            </div>
        </form>

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
</html>