<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mot de passe Perdu</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bungee&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@400;500&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Bungee&family=Work+Sans:wght@400;500&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Epilogue:wght@500&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="assets/style.css"> 
</head>

<body>

    <header>
        <a class="logoHeader" href="index.php"> <img class="logoHeader" src="assets/img/logo.png" alt="logo"> </a>
        <p class="headConnexion"> Mot de passe perdu</p>
    </header>

    <section id="passwordPerdu">
        <h2 class="informations"> pas de stress!</h2>
        <P class="pass"> Vous ne vous souvez plus de votre mot de passe et ne parvenez plus à vous connecter. Entrez votre email et réinitialisez le. </P>
        <div id="containerForm">
            <form id="connexionForm" action="" method="post">
                <input class="confirmEmail" type="text" placeholder="Email" name="username" >
                <button class="changePass" type="submit" id='submit' value='' name="confirm"> réinitialiser le </br> mot de passe</button>
                <a class="canceLogin" href="index.php"> Annuler</a>

            </form>

        </div>
    </section>

</body>

</html>