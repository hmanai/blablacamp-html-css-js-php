<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>proposer un trajet</title>
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


         </div>
     <section id="searchTrajet">
         <form class="searchForm" method="" id="searchelement" action="">
            <div class="propositionTraj" ><label >proposer un trajet</label></div>
            <p class="propTraj"> D'où partez-vous?</p>
            <div id="startPoint">
                <iconify-icon icon="akar-icons:location" class="positionIcon"></iconify-icon>
            </div>
            <p class="propTraj"> Pour aller où  </p>

            <div class="destination">
                <iconify-icon icon="akar-icons:location" class="destinationIcon"></iconify-icon>
                <select name="destinationAdress" class="destinationSelection">
                    <option> Arrivée</option>
                    <option value="stade">Avenue du Stade</option>
                    <option value="montaigu">Route Montaigu</option>
                </select>
            </div>
            <p class="propTraj"> Quand partez vous?  </p>
                 <div class="dateTrajet">
                    <iconify-icon icon="uil:calender" class="calenIcon"></iconify-icon>
                    <input class="dateLabel" type="date" >
                    <label class="dateLabelToday" type="text" value="">Aujourd'hui</label>
                </div> 

                <p class="propTraj"> Type de trajet:  </p>
                <div class="typeTrio">
                    <div class="checkBoxTypeTraj">
                        <input type="checkbox" id="allez-simple" name="allez-simple"
                               checked>
                        <label for="scales">Allez simple</label>
                      </div>
                  
                      <div class="checkBoxTypeTraj">
                        <input type="checkbox" id="allez-retour" name="allez-retour">
                        <label for="allez-retour">Allez/Retour</label>
                      </div>

                </div>

                <div class="bouttonrechercher">
                    <input class= "searchButton" type="submit" id='submit' value='Rechercher' > 
                </div> 
         </form>
     </section>
     <script src="assets/style.js"></script>
     <script src="assets/visibility.js"></script>
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
     </script>
</body>
</html>