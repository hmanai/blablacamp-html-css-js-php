

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
<?php
include 'displayPc.php';

?>
<body>
  <section id="propTrajBloc">
    <header>
        <a class="logoHeader" href="rechercher.php"> <img class="logoHeader" src="assets/img/logo.png" alt="logo">  </a>
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
              <a class="accountInformation" href="mesReservations.php"><img class="iconnavbar" src="assets/img/iconreservation.png" alt="icone réservation"> Mes réservations</a>
              <a class="accountInformation" href="editCompte.php?user-name=<?php echo $_SESSION['username']; ?>"><img class="iconnavbar" src="assets/img/metrajet.png" alt="icone profile"> Modifier mes informations</a>
              <a class="accountInformation" href="messagerie.php"><img class="iconnavbar" src="assets/img/iconmessagerie.png" alt="icone Messagerie"> Messagerie</a>
              <a class="accountInformation" href="logout.php"><iconify-icon class="iconnavbarflech" icon="bx:arrow-back"></iconify-icon>Se déconnecter</a>
            </div>
       </div>


         </div>
         <section id="searchTrajet">
         <form class="searchForm" method="POST" id="searchelement" action="">
            <p class="confAjoutTrajet" >Trajet bien ajouté</p>
            <a class="backtoSearch" href="rechercher.php"> Retour </a>
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
                    <option value="Avenue du Stade">Avenue du Stade</option>
                    <option value="Route Montaigu">Route Montaigu</option>
                </select>
            </div>
            <p class="propTraj"> Quand partez vous?  </p>
                 <div class="dateTrajet">
                    <iconify-icon icon="uil:calender" class="calenIcon"></iconify-icon>
                    <input class="dateLabel" type="date" name="date">
                </div> 
                <p class="propTraj" type="text" value="">Heure Du Départ</label>

                <div class="heureTraj">
                    <iconify-icon icon="tabler:clock-hour-10" class="heureTrajet"></iconify-icon>
                    <input type="time" class="inputHour" name="heureDepart" min="0" max="8" placeholder="Heure">
                </div> 
                <p class="propTraj" type="text" value="">Heure D'arrivée</label>

                <div class="heureTraj">
                    <iconify-icon icon="tabler:clock-hour-10" class="heureTrajet"></iconify-icon>
                    <input type="time" class="inputHour" name="heureArrive" min="0" max="8" placeholder="Heure">
                </div>

                <p class="propTraj"> Type de trajet:  </p>
                <div class="typeTrio">
                    <div class="checkBoxTypeTraj">
                        <input type="checkbox" id="allez-simple" clas="typeTrajet" name="typeTrajet[]" value="allez-simple" checked>
                        <label for="scales">Allez simple</label>
                      </div>
                  
                      <div class="checkBoxTypeTraj">
                        <input type="checkbox" id="allez-retour" clas="typeTrajet" name="typeTrajet[]" value="Allez-Retour">
                        <label for="allez-retour">Allez-Retour</label>
                      </div>
                </div>
                <p class="propTraj" type="text" value="">Nombre de place disponibles:</label>

                <div class="placesDispo">
                    <img class="iconPlaces" src="assets/img/nbplaces.png" alt="icone plusieurs personnes">
                    <input type="number" class="inputnbPlace" name="nbPlace" min="0" max="8" placeholder="Places disponibles">
                </div> 
                    <p class="propTraj" type="text" value="">Etapes éventuelles:</label>
                
                <div class="etapesTrajet">
                       <div class="displayEtapes">
                            <div id="etapes" class="etapeTraj">
                                <iconify-icon icon="akar-icons:location" class="positionIcon"></iconify-icon>
                            </div> 
                       </div> 
                       <img class="iconPlus" src="assets/img/etapePlus.png" alt="icone Plus">
                  <!-- <input type="text" class="inputEtape" name="nbPl" min="0" max="8" placeholder="Etape"> -->   
                </div>
                <div class="etapList">
                        <p class="msgErreur"> Veuillez entrez au moin une étape </p>
                        <input class="etape1" type="text" name="etape1" id="etape1" >
                        <input class="etape2" type="text" name="etape2" id="etape2" >
                        <input class="etape3" type="text" name="etape3" id="etape3" >
                        <input class="etape4" type="text" name="etape4" id="etape4" >
                        <input class="etape5" type="text" name="etape5" id="etape5" >
                </div>
               
                <div class="bouttonrechercher">
                    <input class= "searchButton" type="submit" id='submit' value='proposer un trajet' name="propTrajButton"> 
                </div> 
                <div id="displayEtape"></div>
 


                <?Php 
                    if (ISSET($_POST['propTrajButton'])){
                       addTrajet();
                       

                    }
                ?>
         </form>
     </section>
  </section>
     <!-- <input class = "time" type="text"> -->

     <script src="assets/AjouEtape.js"></script>
     <script src="assets/style.js"></script>
     <script src="assets/visibility.js"></script>
     <!-- <script src="assets/trajet.js"></script> -->


    <!-- -------------------------------------------------------------- -->


     <script>
        let logooProfil = document.querySelector('.logoProfil')
        logooProfil.addEventListener('click', function(){
        document.querySelector('#searchTrajet').style.display ="none" 
        document.querySelector('.compteInfo').style.display="flex"
        
        })

        let cloose = document.querySelector('.close')                                                             
        cloose.addEventListener('click', function(){
        document.querySelector('#searchTrajet').style.display ="flex" 
        document.querySelector('.compteInfo').style.display="none"
        })
  

 
     </script>
     <script>
        let propTrajBloc = document.querySelector('#propTrajBloc')
        let displayPC = document.querySelector('.cadreDisplay')

        if (window.matchMedia("(min-width: 600px)").matches) {
            displayPC.appendChild(propTrajBloc)
        }else{    displayPC.removeChild(propTrajBloc);
}

     </script>
 <!-- <script src="assets/pcDisplay.js"></script> -->

</body>
</html>
