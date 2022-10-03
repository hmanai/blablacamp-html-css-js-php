
<?php
 
 require_once 'fonctions.php';
 
 $nom_utilisateur = $_SESSION['username'];
 $req =  "SELECT * FROM utilisateur WHERE username = '$nom_utilisateur' ";
 $rep = connect()->prepare($req);
 $rep->execute();
 $res = $rep->fetch(PDO::FETCH_OBJ);  
 $nom = $res->nom;
 $user = $res->username;
 $pass = $res->password;
 $email = $res->email;
 $bio = $res->bio;
 $photo = $res->photo;
 
 
 ////////////////////////////////////////// récuperer mes trajet ////////////////////////////////////
 

 ?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bungee&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Epilogue:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@400;500&display=swap" rel="stylesheet">
    <script src="https://code.iconify.design/iconify-icon/1.0.0-beta.3/iconify-icon.min.js"></script> <!-- link for car icon -->  
    <link rel="stylesheet" href="assets/style.css">
    <title>Messagerie</title>
 
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
              <a href="proposerTrajet.php"><button class= "searchTrajetButton" type="submit" id='submit' value='proposer un trajet' > 
                  <img class="iconplus" src="assets/img/searchtrajet.png" alt="icone de recherche trajet">
                  <span> PROPOSER UN TRAJET</span>
                  </button>
              </a>
          </div> 
          <div class="navbar">
              <a class="accountInformation" href="mesTrajets.php"><img class="iconnavbar" src="assets/img/metrajet.png" alt="icone profile"> Mes trajets</a>
              <a class="accountInformation" href="mesReservations.php"><img class="iconnavbar" src="assets/img/iconreservation.png" alt="icone réservation"> Mes réservations</a>
              <a class="accountInformation" href="editCompte.php?user-name=<?php echo $_SESSION['username']; ?>"><img class="iconnavbar" src="assets/img/metrajet.png" alt="icone profile"> Modifier mes informations</a>
              <a class="accountInformation" href="#"><img class="iconnavbar" src="assets/img/iconmessagerie.png" alt="icone Messagerie"> Messagerie</a>
              <a class="accountInformation" href="logout.php"><iconify-icon class="iconnavbarflech" icon="bx:arrow-back"></iconify-icon>Se déconnecter</a>
            </div>
       </div>
   </div>

     <section id="messagerie">

        <label class="titre"> messagerie</label>

        <div class="messagerieContainer">
            <div class="headerAcc">
                <div class="headerPhotoAccountMsg"> 
                        <img class="headerPhotoProfilMsg" src="assets/img/avatar/<?php echo $photo ?>" alt="photo de profil">
                </div>
               
                <div class="msgContainer">
                    <div class="user-nameMsg"><?php echo $nom; ?></div>
                    <div class="corpsMsg">
                        <p class="textjustify"><span class="typeMsg">Demande</span>
                        <span class="corpsDemande"> de réservation pour le trajet <span class="departure"> Dole</span> Lons le Saunier du <span class="dateDeparture"> 05 Septembre 2022</span></span></p>
                    </div>
                </div>
            </div>
            <span class="separateur"></span>
        
        </div>


     </section>





<script>

/////////////affichage de boite des information d'un compte/////////

    let logoProfil = document.querySelector('.logoProfil')
    logoProfil.addEventListener('click', function(){
    document.querySelector('.compteInfo').style.display="flex"
    document.querySelector('#messagerie').style.display ="none"  
 
})
    let close = document.querySelector('.close')
    close.addEventListener('click', function(){
    document.querySelector('#messagerie').style.display ="flex" 
    document.querySelector('.compteInfo').style.display="none"
})

//////////////affichage de editer et supprimer trajet //////////

</script>

</body>
</html>