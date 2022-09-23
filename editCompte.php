
<?php
 
require_once 'fonctions.php';

$nom_utilisateur = $_SESSION['username'];
$password = $_SESSION['username'];

$req =  "SELECT * FROM utilisateur WHERE username = '$nom_utilisateur' ";
$rep = connect()->prepare($req);
$rep->execute();
$res = $rep->fetch(PDO::FETCH_OBJ);  
$nom = $res->nom;
$user = $res->username;
$pass = $password;
$email = $res->email;
$bio = $res->bio;
$photo = $res->photo;

// var_dump($photo)
?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chercher un trajet</title>
   
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bungee&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@400;500&display=swap" rel="stylesheet">
    <script src="https://code.iconify.design/iconify-icon/1.0.0-beta.3/iconify-icon.min.js"></script> <!-- link for car icon -->   
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <header>
        <a class="logoHeader" href="index.html"> <img class="logoHeader" src="assets/img/logo.png" alt="logo">  </a>
        <a class="logoProfil" href="#"> <img class="logoProfil" src="assets/img/logoProfil.png" alt="logo">  </a>
     </header>
         <div class="compteInfor">
      
            <div class="compteInfo">
                <iconify-icon class="close" icon="clarity:close-line"></iconify-icon>
                <div class="accounthead">
                <div class="headerPhotoAccount"> 
                        <img class="headerPhotoProfil" src="assets/img/avatar/<?php echo $photo ?>" alt="photo de profil">
                    </div>
                    <div class="bioHeader">
                        <div class="user-name"><?php echo $nom; ?></div>
                        <p class="biographie-user"><?php echo $bio; ?></p>
                    </div>
                </div>
                <div class="bouttonrechercherTrajet">
                    <button class= "searchTrajetButton" type="submit" id='submit' value='proposer un trajet' > 
                        <img class="iconplus" src="assets/img/searchtrajet.png" alt="icone de recherche trajet">
                        <span> PROPOSER UN TRAJET</span>
                    </button>
                </div> 
                <div class="navbar">
                    <a class="accountInformation" href="mesTrajets.php"><img class="iconnavbar" src="assets/img/metrajet.png" alt="icone profile"> Mes trajets</a>
                    <a class="accountInformation" href="#"><img class="iconnavbar" src="assets/img/iconreservation.png" alt="icone réservation"> Mes réservations</a>
                    <a class="accountInformation" href="editCompte.php?user-name=<?php echo $_SESSION['username']; ?>"><img class="iconnavbar" src="assets/img/metrajet.png" alt="icone profile"> Modifier mes informations</a>
                    <a class="accountInformation" href="#"><img class="iconnavbar" src="assets/img/iconmessagerie.png" alt="icone Messagerie"> Messagerie</a>
                    <a class="accountInformation" href="logout.php"><iconify-icon class="iconnavbarflech" icon="bx:arrow-back"></iconify-icon>Se déconnecter</a>
                  </div>
             </div>


         </div>
     <section id="searchTrajet">
        <div class="enregistrementForm">
            <form class="registerForm" action="" method="post" enctype="multipart/form-data">
                <p class="confirm" >Modification effectuée avec succè</p> 
                <a class="backtoSearch" href="rechercher.php"> Retour </a>
                <label class="labelRegister"> Modifier vos coordonnées</label>
                <input class="inputRegister" type="text" placeholder="Nom" name="nom"value="<?php echo $nom ?>">
                <input class="inputRegister" type="text" placeholder="Nom d'utilisateur" name="username" value="<?php echo $user ?>">
                <label class="labelRegister"> Modifier votre mot de passe</label>
                <input class="inputRegister" type="password" placeholder="Mot de passe" name="password" value="<?php echo $pass?>">
                <label class="labelRegister"> Modifier votre email</label>
                <input class="inputRegister" type="text" placeholder="Email" name="email" value="<?php echo $email?>">
                    <p>Ajoutez votre adresse e-mail pour recevoir des notifications sur votre activité sur Foundation. Cela ne sera pas affiché sur votre profil.</p>
                <label class="labelRegister"> Modifier votre biographie</label>
                <textarea class="textareaRegister" type="text" placeholder="<?php echo $bio?>" aria-placeholder="" name="bio" ></textarea>  
                <label class="labelRegister">Modifier votre image de profil </label>
                <label class="fileRegister" > 
                    <label class="inputFile" name="inputFile" value=""> <img class="PhotoProfil" src="assets/img/avatar/<?php echo $photo ?>"></label>
                    <div class= "infoImageCompte">
                        <img  src="assets/img/icon-file.png" alt="icone de telechargement">
                        <h2 class="registerTitle" > Glisser-déposer ou parcourir un fichier</h2>
                        <p> Taille recommandée JPG, PNG, GIF (150x150px. Max 10mb) </p>
                        <input type="file" class="uploadRegister" name="photo" value="<?php echo $photo?>">
                    </div>
                </label>
                <div class="centerButton">
                    <input class= "registerButton" type="submit" id='submit' value='mettre à jour' name="confirm" >
                    <a class="cancelRegister" href="rechercher.php">Annuler</a>
                </div>

            </form>
        </div>
     </section>

     <?php
               
                  if ((ISSET($_POST['confirm']))) {         
                          editCompte();   
 

              }
     ?>


     <script>

        let logoProfil = document.querySelector('.logoProfil')
        logoProfil.addEventListener('click', function(){
        document.querySelector('#searchTrajet').style.display ="none" 
        document.querySelector('.compteInfo').style.display="flex"
        
        })

        let close = document.querySelector('.close')                                                             
        close.addEventListener('click', function(){
        document.querySelector('#searchTrajet').style.display ="flex" 
        document.querySelector('.compteInfo').style.display="none"
        })

        let fileRegister = document.querySelector('.fileRegister')  
        fileRegister.addEventListener('click', function(){
        document.querySelector('.infoImageCompte').style.display ="flex" 
        document.querySelector('.inputFile').style.display="none"
        })                                                           



     </script>
</body>
</html>