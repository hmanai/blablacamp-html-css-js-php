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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/style.css">
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
    <title>Trajets Disponibles</title>
 
</head>
<body>
    <header>
        <a class="logoHeader" href="index.html"> <img class="logoHeader" src="assets/img/logo.png" alt="logo">  </a>
        <a class="logoProfil" href="#"> <img class="logoProfil" src="assets/img/logoProfil.png" alt="logo">  </a>
     </header>
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
            <a href="proposerTrajet">
                <button class= "searchTrajetButton" type="submit" id='submit' value='proposer un trajet' > 
                <img class="iconplus" src="assets/img/searchtrajet.png" alt="icone de recherche trajet">
                <span> PROPOSER UN TRAJET</span>
                </button>
            </a>
        </div> 
        <div class="navbar">
            <a class="accountInformation" href="mesTrajets.php"><img class="iconnavbar" src="assets/img/metrajet.png" alt="icone profile"> Mes trajets</a>
            <a class="accountInformation" href="#"><img class="iconnavbar" src="assets/img/iconreservation.png" alt="icone réservation"> Mes réservations</a>
            <a class="accountInformation" href="editCompte.php?user-name=<?php echo $_SESSION['username']; ?>"><img class="iconnavbar" src="assets/img/metrajet.png" alt="icone profile"> Modifier mes informations</a>
            <a class="accountInformation" href="#"><img class="iconnavbar" src="assets/img/iconmessagerie.png" alt="icone Messagerie"> Messagerie</a>
            <a class="accountInformation" href="logout.php"><iconify-icon class="iconnavbarflech" icon="bx:arrow-back"></iconify-icon>Se déconnecter</a>
        </div>
     </div>

     <section id="searchResult">
        <div class="titretraj"><h2 class="resultTitle"> Trajets Disponibles</h2></div>
        <div class="trajetDetails">
            <div class="dateTraj">
                <div class="dayTrajet">05</div>
                <div class="monthTrajet">Sep</div>
            </div>
            <div class="places">
                <div class="startLocation">Dole</div>
                <div class="finishLocation">Lons le Saunier</div> 
            </div>
            <div class="iconflech">
                <img class="fleche" src="assets/img/flechhautbas.png" alt="image de deux fleches haut et bas">
            </div>
        </div>
       <div class="nombretrj"> <p class="nbTrajet"><span class="nombreTrajet">5</span> trajets disponibles</p></div>
        <div class="triTrajet">
            <img class="horloge" src="assets/img/horloge.png" alt="photo horloge">
            <p class="trajetTri" > Les trajets sont triés chronologiquement par heure de départ.</p>

        </div>
        <div class="detailsTrajet">
            <div class="nbrslttrj">
                <p class="nbplace">places disponibles:<span class="nomnrePlace"> 5</span></p>
            </div>
            <div class="details">

                <div class="hourTrip">
                    <span class="startHour">6H40</span>
                    <span class="finishHour">9H50</span>
                </div>
                <div class="liaison">
                    <img class="cercleLiaison" src="assets/img/deuxCercles.png" alt="deux cercles liés par un trait">
                </div>
                <div class="citiestrip">
                    <div class="cityStart">Dole</div>
                    <div class="cityFinish">lons le Saunier</div>
                </div>

            </div>
            <div class="accountdetails">
                <div class="photoAccount"> 
                    <img class="photoProfil" src="assets/img/me3.png" alt="">
                </div>
                <div class="bio">
                    <div class="nomUtilisateur">Hamza</div>
                    <p class="biographie">Avec moi ça passe ou ça casse</p>
                </div>

            </div>
            
        </div>





     </section>





<script>
    let logoProfil = document.querySelector('.logoProfil')
    logoProfil.addEventListener('click', function(){
    document.querySelector('.compteInfo').style.display="flex"
    document.querySelector('#searchResult').style.display ="none"  
 
})
    let close = document.querySelector('.close')
    close.addEventListener('click', function(){
    document.querySelector('#searchResult').style.display ="flex" 
    document.querySelector('.compteInfo').style.display="none"
})
</script>

</body>
</html>