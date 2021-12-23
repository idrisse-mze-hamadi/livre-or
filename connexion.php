<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="lvrdor.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
        <title>Connectez vous</title>
    </head>

    <?php

    session_start();

    if(isset($_SESSION["login"]))
    {
        header("location:index.php"); //permet de rediriger vers la page d'accueil une fois connecté.
    }
    $bdd = mysqli_connect("localhost:3306","idrisse", "idrisse", "idrisse-mze-hamadi_livre-or");

    if (isset($_POST["connexion"])) // lorsqu'on ce connecte
    {
        if (isset($_POST["login"]) && isset($_POST["password"])) //Nous vérifions que les informations écrites soit valide.
        {
            $login = $_POST["login"];
            $password = $_POST["password"];
            $rqt = mysqli_query($bdd, "SELECT * FROM utilisateurs WHERE login='$login' and password='$password'"); //requête sur login et password
            $r = mysqli_num_rows($rqt);
            if ($r == 1) // si il reconnait les informations envoyé il ce connecte
            {
                $_SESSION["login"] = $login;
                header("Location:index.php");
            }
            else
            {
                echo "Le login ou le mot de passe sont incorrect.";
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
        
        <!--Formulaire de connexion-->

        <form action = "" method = "post">
            
            <div class="connect">

                <h1>Connectez-vous</h1>
                <p>Veuillez remplir les champs.</p>
                
                <hr>
                    <div class="inlaconn">
                        <div>
                            <label for="login"><b>Login</b></label>
                            <input type="text" placeholder="Login" name="login" required>
                        </div>
                        <div>
                            <label for="password"><b>Mot de passe</b></label>
                            <input type="password" placeholder="Votre mot de passe" name="password" required>
                        </div>
                    </div>
                </hr>

                <input type="submit" name="connexion" class="button_connect" value="Connectez vous" action="">
                
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