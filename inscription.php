<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="lvrdor.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
        <title>Inscrivez vous</title>
    </head>

    <?php

        //ouverture de la session
        session_start();

        if (isset($_SESSION["login"]))
        {
            header("location:index.php");
        }
        //Vérification des informations

        $bdd = mysqli_connect("localhost", "root", "", "livreor"); //On ce connecte a la base de donnée

        if (isset($_POST["inscription"])) // Quand on appuis sur s'inscrire..on définit chaque $_POST avec une $variable
        {
            $login = $_POST["login"];
            $password = $_POST["password"];
            $rpassword = $_POST["rpassword"];

            if(isset($_POST["login"]))
            {
                $rq = mysqli_query($bdd, "SELECT * FROM utilisateurs WHERE login='$login'");
                $r = mysqli_num_rows($rq);
                if($r == 1)
                {
                    echo "login déja existant";
                }
                elseif ($rpassword != $password) // On vérifie que les mots de passe soit similaire..
                {
                    echo "Les mots de passe sont différents";
                }
                elseif (strlen($login) < 4 || strlen($password) < 4 ) //j'impose un nombre caractère minimum
                {
                    echo "Nombre de caractère insuffisant";
                }
                elseif (isset($login) && isset($password)) // Et on stocke dans la base de donné les valeurs $
                {
                    $rqt = mysqli_query($bdd, "INSERT INTO utilisateurs (login, password) VALUES ('$login', '$password')");
                    header("location:connexion.php");
                }
            }   
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
                    
                    if($_SESSION["login"] == "admin")
                    {
                        echo "<a href='admin.php'>administrateur</a>";
                    }
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
            
            <div class="ins">
                
                <h1>Créer un compte</h1>
                <p>Veuillez remplir ce formulaire.</p>

                <hr>
                    <div class="inla">
                        <label for="login"><b>Login</b></label>
                        <input type="text" placeholder="Login" name="login" required>
                        
                        <label for="password"><b>Mot de passe</b></label>
                        <input type="password" placeholder="Votre mot de passe" name="password" required>

                        <label for="rpassword"><b>Confirmation du mot de passe</b></label>
                        <input type="password" placeholder="Confirmation du mot de passe" name="rpassword" required>
                    </div>
                <hr>

                <input type="submit" name="inscription" class="button_ins" value="S'inscrire" action="">
            
            </div>

            <div class="ins inla signin">
                <p>Vous avez déjà un compte? <a href="connexion.php">Connectez-vous</a>.</p>
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