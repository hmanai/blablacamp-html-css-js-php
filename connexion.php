
<?php
require_once 'fonctions.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>connexion</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bungee&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@400;500&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Bungee&family=Work+Sans:wght@400;500&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script> <!-- CDN jquery -->


    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
<div id="felicitationLogin">
        <header class="felicitationheader">
            <a class="logoHeader" href="index.php"><img  class="logoHeader" src="assets/img/logo.png" alt="logo"></a> 
            <span class="headConnexion"> confirmation</span>     
        </header>
        <div class=" felicitationcorps">
            <h2> Félicitation <span class="styleusername"></span></h2>
            <p>Vous êtes bien connecté!!</p>
        </div>

</div> 
    <section id="login">
    <header>
       <a class="logoHeader" href="index.php"> <img class="logoHeader" src="assets/img/logo.png" alt="logo">  </a>
        <p class="headConnexion"> se connecter</p>     
    </header>
        <p class="informations"> entrez vos informations</p>
        
        <?php
        //gestion d'erreur de saisie de login et mot de passe

            if(isset($_GET['erreur'])){
                $err = $_GET['erreur'];
                if($err==1 )
                    echo "<p style='color:red; text-align:center; font-size:12px'>Utilisateur ou mot de passe incorrect</p>";
                 else{
                    echo "<p style='color:red; text-align:center; font-size:12px'>Entrer votre login et mot de passe</p>";
                 }
            }
            
        ?>

        <div id="containerForm">
            <form id="connexionForm" action="" method="POST">
                <input class="loginInput" type="text" placeholder="Nom d’utilisateur" name="username" >
                <input class="loginInput" type="password" placeholder=" Mot de passe" name="password" >
                <input class= "loginButton" type="submit" id='submit' value='se connecter' name="login" >
                <a class="canceLogin" href="changerPassword.php"> mot de passe oublier</a>
                <?php
if(ISSET($_POST['login'])){
    login();


}
    ?>


                

            </form>
        </div>
    </section>


</body>
</html>