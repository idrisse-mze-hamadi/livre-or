<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="lvrdor.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
        <title>Accueil</title>
    </head>

    <?php
        session_start();

        if (isset($_POST["deconnexion"])) // Lorsqu'on appuie sur deconnexion
        {
            session_destroy(); //la session est détruite et nous sommes redirigé vers la page de connexion.
            header("location:connexion.php");
        }
    ?>

    <body>

        <header>

            <h2>livre d'or</h2>
            
            <div>
                <?php
                if(isset($_SESSION["login"])) //Si on est connecté a un compte 
                {
                    echo "Connecté à ".$_SESSION["login"]; //le header du site affichera le bouton se deconnecter
                    echo "<form action='' method='post'><input type='submit' name='deconnexion' value='se deconnecter'></form>";
                    echo "<a href='profil.php'>Mon profil</a>"; //et un lien vers profil.php
                }
                else // autrement les liens connexion et inscription s'afficheront.
                {
                    echo "<a href='connexion.php'>Se connecter</a> ";
                    echo "<a href='inscription.php'>S'inscrire</a>";
                }
                ?>
            </div>

        </header>
        
        <main>
            <h1>BIENVENUE SUR LE SITE LIVRE D'OR</h1>
            <h4>
                Ce site est un aperçu qui permet d'observer les résultats d'intéractions sur les différents éléments de la page.
                <br>
                Vous êtes actuellement sur la page d'accueil du site, celle ci permet de rediriger l'utilisateurs qui le souhaite vers une page d'inscription ou de connexion.
                <br>
                La page d'inscription permettra aux visteurs de renseigner leurs informations avec une confirmation de mot de passe et cela sera stocker sur une base de donnée.(voir tuto wamp/phpMyadmin )
                <br>
                La page de connexion permettra aux nouveaux utilisateurs de ce connecter au site grace aux informations stocké dans la base de donnée.
                <br>
                Une fois inscrit et connecté vous pourrez modifié les informations de votre profil, visualiser ou posté des commentaires.
            </h4>
            <br>
            <p>Pour visualiser ou laisser un commentaire cliquer sur le lien ci-dessous:</p>
            <a href="livre-or.php">Commentaires</a>
            <br>
            <h1>BONNE VISITE</h1>
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
</html>