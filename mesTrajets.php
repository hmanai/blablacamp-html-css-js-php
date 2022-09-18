<!DOCTYPE html>
<html lang="en">
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

    <title>Mes trajets</title>
 
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
                <img class="headerPhotoProfil" src="assets/img/me3.png" alt="">
            </div>
            <div class="bioHeader">
                <div class="user-name">Hamza</div>
                <p class="biographie-user">Avec moi ça passe ou ça casse</p>
            </div>
        </div>
        <div class="bouttonrechercherTrajet">
            <button class= "searchTrajetButton" type="submit" id='submit' value='proposer un trajet' > 
                <img class="iconplus" src="assets/img/searchtrajet.png" alt="icone de recherche trajet">
                <span> PROPOSER UN TRAJET</span>
            </button>
        </div> 
        <div class="navbar">
            <a class="accountInformation" href="#"><img class="iconnavbar" src="assets/img/metrajet.png" alt="icone profile"> Mes trajets</a>
            <a class="accountInformation" href="#"><img class="iconnavbar" src="assets/img/iconreservation.png" alt="icone réservation"> Mes réservations</a>
            <a class="accountInformation" href="#"><img class="iconnavbar" src="assets/img/metrajet.png" alt="icone profile"> Modifier mes informations</a>
            <a class="accountInformation" href="#"><img class="iconnavbar" src="assets/img/iconmessagerie.png" alt="icone Messagerie"> Messagerie</a>
            <a class="accountInformation" href="#"><iconify-icon class="iconnavbarflech" icon="bx:arrow-back"></iconify-icon>Se déconnecter</a>
          </div>
     </div>

     <section id="mesTrajets">
        <label class="titre"> mes trajet</label>

        <div class="trajetContainer">
            <div class="action">
                <div class="editer">
                    <label class="titrePage"> editer</label>
                </div>
                <div class="supprimer">
                    <label class="titrePage"> supprimer</label>
                </div>
            </div>
            <div class="trajetDetail">
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
        </div>

     </section>





<script>

/////////////affichage de boite des information d'un compte/////////

    let logoProfil = document.querySelector('.logoProfil')
    logoProfil.addEventListener('click', function(){
    document.querySelector('.compteInfo').style.display="flex"
    document.querySelector('#mesTrajets').style.display ="none"  
 
})
    let close = document.querySelector('.close')
    close.addEventListener('click', function(){
    document.querySelector('#mesTrajets').style.display ="flex" 
    document.querySelector('.compteInfo').style.display="none"
})

//////////////affichage de editer et supprimer trajet //////////

// let trajetContainer = document.querySelector('.trajetContainer')
// trajetContainer.addEventListener('click', function(){
// document.querySelector('.action').style.display ="flex" 
// })
 const trajetContainers = document.querySelectorAll('.trajetContainer')
 trajetContainers.forEach(trajetContainer => {
    trajetContainer.addEventListener('click', function(){
    document.querySelector('.action').style.display ="flex" 
    })
});


</script>
<script src="assets/trajet.js"> </script>
</body>
</html>