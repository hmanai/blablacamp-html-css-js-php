<?php 
include 'fonctions.php';
include 'displayPc.php';
?>
<!DOCTYPE html>
<html lang="fr">

<body>
   <section id="changePassBloc">
    <header>
        <a class="logoHeader" href="index.php"> <img class="logoHeader" src="assets/img/logo.png" alt="logo"> </a>
        <p class="headConnexion"> Mot de passe perdu</p>
    </header>

    <section id="passwordPerdu">
        <h2 class="informations"> pas de stress!</h2>
        <P class="pass"> Vous ne vous souvez plus de votre mot de passe et ne parvenez plus à vous connecter. Entrez votre email et réinitialisez le. </P>
        <div id="containerForm">
            <form id="connexionForm" action="" method="post">
                <input class="confirmEmail" type="text" placeholder="Email" name="email" >
                <button class="changePass" type="submit" id='submit' value='' name="confirm"> réinitialiser le </br> mot de passe</button>
                <a class="canceLogin" href="index.php"> Annuler</a>
<?php
                if(isset($_POST["email"]) && (!empty($_POST["email"])) && isset($_POST["confirm"])){
                    $mail = ($_POST["email"]);
                    $password = uniqid();
                    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                    // var_dump($hashedPassword);
                    $message = "Bonjour, voici votre nouveau mot de passe pour le site de Blabla Campus : $password";
                    $headers = 'Content-Type: text/plain; charset="utf-8"'."";
                    if (mail($_POST['email'], 'Mot de passe oublié pour le site Blabla Campus', $message, $headers))
                    {
                     $sql = "UPDATE utilisateur SET password = :passwd where email= :mail";
                     $stmt = connect()->prepare($sql);
                     $stmt->execute(array(
                         ':passwd' => $hashedPassword, 
                         ':mail' => $mail
                     ));
                     echo "Mail envoyé";
                    }    
                    else{
                     echo "<p style='color:red'>Erreur!!, veuillez réessayer ultérieurement!</p>";
         
                    }}  
?>
            </form>

        </div>
    </section>
   </section>
   <script>
        let changePassBloc = document.querySelector('#changePassBloc')
        let displayPC2 = document.querySelector('.cadreDisplay')

        if (window.matchMedia("(min-width: 600px)").matches) {
            displayPC2.appendChild(changePassBloc)
        }else{    displayPC2.removeChild(changePassBloc);
}

     </script>
   <!-- <script src="assets/pcDisplay.js"></script> -->

</body>

</html>