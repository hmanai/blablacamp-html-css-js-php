
<?php
require_once 'fonctions.php';
include 'displayPc.php';
?>

<body>
    <section id="registerBloc">
       <div id="felicitation">
        <header class="felicitationheader">
            <a class="logoHeader" href="index.php"><img  class="logoHeader" src="assets/img/logo.png" alt="logo"></a> 
            <span class="headConnexion"> confirmation</span>     
        </header>
        <div class=" felicitationcorps">
            <h2> Félicitation <span class="styleusername"></span></h2>
            <p>Votre compte à bien été créé!</p>
        </div>

        </div> 
    <section id="register">
        <header >
           <a class="logoHeader" href="index.php"><img  class="logoHeader" src="assets/img/logo.png" alt="logo"></a> 
            <p class="headConnexion"> Creer un compte</p>     
        </header>

        <div class="enregistrementForm">
            <form class="registerForm" action="" method="post" enctype="multipart/form-data">
                <p class="erreur"> Veuillez remplir tous les champs !</p>
                <p class="erreur2">le Nom d'utilisateur existe déjà, veuillez choisir un autre!</p>
                <label class="labelRegister"> Entrez vos coordonnées</label>
                <input class="inputRegister" type="text" placeholder="Nom" name="nom">
                <input class="inputRegister" type="text" placeholder="Nom d'utilisateur" name="username">
                <label class="labelRegister"> Entrez votre mot de passe</label>
                <input class="inputRegister" type="password" placeholder="Mot de passe" name="password">
                <label class="labelRegister"> Entrez votre email</label>
                <input class="inputRegister" type="email" placeholder="Email" name="email">
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
                    <a class="cancelRegister" href="connexion.php">Annuler</a>
                </div>

                <?php
                    if (ISSET($_POST['register'])){
                        if((!empty($_POST['nom'])) && (!empty($_POST['username'])) && (!empty($_POST['password'])) && (!empty($_POST['email'])) && (!empty($_POST['bio'])) 
                        ){
                            $_SESSION['username'] = $_POST['username'];
                            
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
            </section>
            <script>

            let registerBloc = document.querySelector('#registerBloc')
            let displayPC19 = document.querySelector('.cadreDisplay')

            if (window.matchMedia("(min-width: 600px)").matches) {
                displayPC19.appendChild(registerBloc)
            }else{    displayPC19.removeChild(registerBloc);
    }
  </script>
 </body>
</html>