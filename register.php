
<?php
require_once 'fonctions.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creer un compte</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bungee&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@400;500&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Bungee&family=Work+Sans:wght@400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bungee&family=Epilogue:wght@500&family=Work+Sans:wght@400;500&display=swap" rel="stylesheet">
    <script src="https://code.iconify.design/iconify-icon/1.0.0-beta.3/iconify-icon.min.js"></script> <!-- link for car icon -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script> <!-- CDN jquery -->

    <link rel="stylesheet" href="assets/style.css">
    <script src="assets/style.js" async ></script>
</head>
<body>
 <div id="felicitation">
        <header class="felicitationheader">
            <a class="logoHeader" href="index.html"><img  class="logoHeader" src="assets/img/logo.png" alt="logo"></a> 
            <span class="headConnexion"> confirmation</span>     
        </header>
        <div class=" felicitationcorps">
            <h2> Félicitation <span class="styleusername"></span></h2>
            <p>Votre compte à bien été créé!</p>
        </div>

</div> 
    <section id="register">
        <header>
           <a class="logoHeader" href="index.html"><img  class="logoHeader" src="assets/img/logo.png" alt="logo"></a> 
            <p class="headConnexion"> Creer un compte</p>     
        </header>

        <div class="enregistrementForm">
            <form class="registerForm" action="" method="post" enctype="multipart/form-data">
                <p class="erreur"> Veuillez remplir tous les champs !</p>
                <?php 
                if (($erreur=1) && (ISSET($_POST['register'])) && (!empty($_POST['username']))){
                    echo "<p style='color:red'>le Nom d'utilisateur existe déjà, veuillez choisir un autre!</p>";

                }
                ?>
                <label class="labelRegister"> Entrez vos coordonnées</label>
                <input class="inputRegister" type="text" placeholder="Nom" name="nom">
                <input class="inputRegister" type="text" placeholder="Nom d'utilisateur" name="username">
                <label class="labelRegister"> Entrez votre mot de passe</label>
                <input class="inputRegister" type="text" placeholder="Mot de passe" name="password">
                <label class="labelRegister"> Entrez votre email</label>
                <input class="inputRegister" type="text" placeholder="Email" name="email">
                    <p>Ajoutez votre adresse e-mail pour recevoir des notifications sur votre activité sur Foundation. Cela ne sera pas affiché sur votre profil.</p>
                <label class="labelRegister"> Entrez votre biographie</label>
                <textarea class="textareaRegister" type="text" placeholder="Entrez votre bio ici" aria-placeholder="" name="bio"></textarea>  
                <label class="labelRegister">Téléchargez une image de profil </label>
                <label class="fileRegister"> 
                    <img src="assets/img/icon-file.png" alt="icone de telechargement">
                    <h2 class="registerTitle" > Glisser-déposer ou parcourir un fichier</h2>
                    <p> Taille recommandée JPG, PNG, GIF (150x150px. Max 10mb) </p>
                    <input type="file" class="uploadRegister" name="photo">
                </label>
                <div class="centerButton">
                    <input class= "registerButton" type="submit" id='submit' value='Créer mon compte' name="register" >
                    <a class="cancelRegister" href="connexion.html">Annuler</a>
                </div>

                <?php
                    if (ISSET($_POST['register'])){
                        if((!empty($_POST['nom'])) && (!empty($_POST['username'])) && (!empty($_POST['password'])) && (!empty($_POST['email'])) && (!empty($_POST['bio'])) && (!empty($_FILES['photo']))
                        ){
                            $_SESSION['username'] = $_POST['username'];
                            var_dump($_SESSION['username']);
                        register();
                        }
                        else{
                 ?>
                            <script>
                                document.querySelector('.erreur').style.visibility="visible";
                            </script>
                 <?php
                  } 
                }
                  ?>

           </form>
        </div>
    </section>
    
</body>
</html>