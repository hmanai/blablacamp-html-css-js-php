
<?php
require_once 'fonctions.php';

$nom_utilisateur = $_SESSION['username'];

$req =  "SELECT * FROM utilisateur WHERE username = '$nom_utilisateur' ";
$rep = connect()->prepare($req);
$rep->execute();
$res = $rep->fetch(PDO::FETCH_OBJ);  
$nom = $res->nom;
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
    <link rel="stylesheet" href="assets/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bungee&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@400;500&display=swap" rel="stylesheet">
    <script src="https://code.iconify.design/iconify-icon/1.0.0-beta.3/iconify-icon.min.js"></script> <!-- link for car icon -->   
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
                    <a class="accountInformation" href="editCompte.php?user-name"><img class="iconnavbar" src="assets/img/metrajet.png" alt="icone profile"> Modifier mes informations</a>
                    <a class="accountInformation" href="#"><img class="iconnavbar" src="assets/img/iconmessagerie.png" alt="icone Messagerie"> Messagerie</a>
                    <a class="accountInformation" href="logout.php"><iconify-icon class="iconnavbarflech" icon="bx:arrow-back"></iconify-icon>Se déconnecter</a>
                  </div>
             </div>


         </div>
     <section id="searchTrajet">
         <form class="searchForm" method="" id="searchelement" action="">
            <label class="labelRegister">Rechercher un trajet</label>
            <div id="startPoint">
                <iconify-icon icon="akar-icons:location" class="positionIcon"></iconify-icon>
            </div>
            <div class="destination">
                <iconify-icon icon="akar-icons:location" class="destinationIcon"></iconify-icon>
                <select name="destinationAdress" class="destinationSelection">
                    <option> Destination</option>
                    <option value="stade">Avenue du Stade</option>
                    <option value="montaigu">Route Montaigu</option>
                </select>
            </div>
                 <div class="dateTrajet">

                    <iconify-icon icon="uil:calender" class="calenIcon"></iconify-icon>
                    <input class="dateLabel" type="date" >
                    <label class="dateLabelToday" type="text" value="">Aujourd'hui</label>
                </div> 
                <div class="bouttonrechercher">
                    <input class= "searchButton" type="submit" id='submit' value='Rechercher' > 
                </div> 
         </form>
     </section>
     <script src="assets/style.js"></script>
     <script src="assets/visibility.js"></script>
</body>
</html>