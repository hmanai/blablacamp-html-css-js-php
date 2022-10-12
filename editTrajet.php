

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
///////////////////////INFO TRAJET//////////////////////////////////
$idTrajet = $_GET['id'];
$req =  "SELECT * FROM trajet WHERE id_trajet = '$idTrajet' ";
$rep = connect()->prepare($req);
$rep->execute();
$res = $rep->fetch(PDO::FETCH_OBJ);  
$pt_depart = $res->pt_depart;

$pt_arrive = $res->pt_arrive ;
$date_trajet = $res->date_trajet ;
$heure_depart = $res->heure_trajet ;
$heure_Arrive = $res->heure_Arrive ;
$type_trajet = $res->type_trajet ;
$nb_places = $res->nb_places ;
$etapes = $res->etapes ;
$tabType=explode("/", $etapes);
$chauffeur = $res->chauffeur ;
$nb = sizeof($tabType);


?>

<!DOCTYPE html>
<html lang="fr">

<?php
include 'displayPc.php';

?>
<body>
  <section id="editTrajBloc">
   <div id="felicitation">
        <header class="felicitationheader">
            <a class="logoHeader" href="rechercher.php"><img  class="logoHeader" src="assets/img/logo.png" alt="logo"></a> 
            <span class="headConnexion"> confirmation</span>     
        </header>
        <div class=" felicitationcorps">
            <h2> Félicitation <span class="styleusername"></span></h2>
            <p>Votre trajet à bien été modifié!</p>
        </div>

</div> 
<section id="editTraj">
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
                    <a href="proposerTrajet.php"> <button class= "searchTrajetButton" type="submit" id='submit' value='proposer un trajet' > 
                        <img class="iconplus" src="assets/img/searchtrajet.png" alt="icone de recherche trajet">
                        <span> PROPOSER UN TRAJET</span>
                    </button></a>
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
         <p class="confirm" >Modification effectuée avec succè</p> 
                <a class="backtoSearch" href="mesTrajets.php"> Retour </a>
            <p class="confAjoutTrajet" >Trajet bien édité</p>
            <a class="backtoSearch" href="rechercher.php"> Retour </a>
            <div class="propositionTraj" ><label >éditer un trajet</label></div>

            <p class="propTraj"> D'où partez-vous?</p>
            <div id="startPoint">
                <iconify-icon icon="akar-icons:location" class="positionIcon"></iconify-icon>
 
            </div>


            <p class="propTraj"> Pour aller où  </p>

            <div class="destination">
                <iconify-icon icon="akar-icons:location" class="destinationIcon"></iconify-icon>
                <select name="destinationAdress" class="destinationSelection" value="">
                    <option> <?php echo $pt_arrive ?></option>
                    <option value="Avenue du Stade">Avenue du Stade</option>
                    <option value="Route Montaigu">Route Montaigu</option>
                </select>
            </div>
            <p class="propTraj"> Quand partez vous?  </p>
                 <div class="dateTrajet">
                    <iconify-icon icon="uil:calender" class="calenIcon"></iconify-icon>
                    <input class="dateLabel" type="date" name="date" value="<?php echo $date_trajet ?>">
                </div> 
                <p class="propTraj" type="text" value="">Heure Du Départ</label>

                <div class="heureTraj">
                    <iconify-icon icon="tabler:clock-hour-10" class="heureTrajet"></iconify-icon>
                    <input type="time" class="inputHour" name="heureDepart" min="0" max="8" placeholder="Heure" value="<?php echo $heure_depart?>">
                </div> 
                <p class="propTraj" type="text" value="">Heure D'arrivée</label>

                <div class="heureTraj">
                    <iconify-icon icon="tabler:clock-hour-10" class="heureTrajet"></iconify-icon>
                    <input type="time" class="inputHour" name="heureArrive" min="0" max="8" placeholder="Heure" value="<?php echo $heure_Arrive ?>">
                </div>

                <p class="propTraj"> Type de trajet:  </p>
                <div class="typeTrio">
                    <div class="checkBoxTypeTraj">
                      
                        <input type="checkbox" id="allez-simple" clas="typeTrajet" name="typeTrajet[]" value="allez-simple" <?php if ($type_trajet =="allez-simple") echo "checked" ?>>
                        <label for="scales">Allez simple</label>
                      </div>
                  
                      <div class="checkBoxTypeTraj">
                        <input type="checkbox" id="allez-retour" clas="typeTrajet" name="typeTrajet[]" value="Allez-Retour" <?php if ($type_trajet =="Allez-Retour") echo "checked" ?>>
                        <label for="allez-retour">Allez/Retour</label>
                      </div>
                </div>
                <p class="propTraj" type="text" value="">Nombre de place disponibles:</label>

                <div class="placesDispo">
                    <img class="iconPlaces" src="assets/img/nbplaces.png" alt="icone plusieurs personnes">
                    <input type="number" class="inputnbPlace" name="nbPlace" min="0" max="8" placeholder="Places disponibles" value="<?php echo $nb_places ?>">
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
                        <div class="alignicon6"><input class="etape1" type="text" name="etape1" id="etape1" value="<?php echo $tabType[0] ?>" >
                        <i class="fa-solid fa-circle-minus iconeMoin6" style="color: #D41E45; font-size: 40px;"></i></div>
                        <div class="alignicon7"><input class="etape2" type="text" name="etape2" id="etape2" value="<?php echo $tabType[1] ?>" >
                        <i class="fa-solid fa-circle-minus iconeMoin7" style="color: #D41E45 ;font-size: 40px;"></i></div>
                        <div class="alignicon8"><input class="etape3" type="text" name="etape3" id="etape3" value="<?php echo $tabType[2] ?>" >
                        <i class="fa-solid fa-circle-minus iconeMoin8" style="color: #D41E45 ;font-size: 40px;"></i></div>
                        <div class="alignicon9"><input class="etape4" type="text" name="etape4" id="etape4" value="<?php echo $tabType[3] ?>" >
                        <i class="fa-solid fa-circle-minus iconeMoin9" style="color: #D41E45 ;font-size: 40px;"></i></div>
                        <div class="alignicon10"><input class="etape5" type="text" name="etape5" id="etape5" value="<?php echo $tabType[4] ?>" >
                        <i class="fa-solid fa-circle-minus iconeMoin10" style="color: #D41E45 ;font-size: 40px;"></i></div>

                </div>

                <div class="bouttonrechercher">
                    <input class= "searchButton" type="submit" id='submit' value='mettre à jour' name="update"> 
                </div> 
                <div id="displayEtape"></div>
 


                <?Php 
                    if (ISSET($_POST['update'])){
                     
                        editTrajet();

                    }
                ?>
         </form>
     </section>
</section>
                </section>


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

 <?php
    if ((($tabType[0]) !== "")&&(($tabType[1]) == "")&&(($tabType[2]) == "")&&(($tabType[3]) == "")&&(($tabType[4]) == "")){
?>
<script> 
      document.querySelector('.alignicon6').style.display='flex' 
      document.querySelector('.etape1').style.display='flex' 

</script>
<?php
    }
    else if ((($tabType[0]) !== "")&&(($tabType[1]) !== "")&&(($tabType[2]) == "")&&(($tabType[3]) == "")&&(($tabType[4]) == "")){
?>
<script> 
      document.querySelector('.alignicon6').style.display='flex' 
      document.querySelector('.alignicon7').style.display='flex' 
      document.querySelector('.etape1').style.display='flex' 
      document.querySelector('.etape2').style.display='flex' 



</script>
<?php
    }
else if ((($tabType[0]) !== "")&&(($tabType[1]) !== "")&&(($tabType[2]) !== "")&&(($tabType[3]) == "")&&(($tabType[4]) == "")){
?>
<script> 
      document.querySelector('.alignicon6').style.display='flex' 
      document.querySelector('.alignicon7').style.display='flex' 
      document.querySelector('.alignicon8').style.display='flex'
      document.querySelector('.etape1').style.display='flex' 
      document.querySelector('.etape2').style.display='flex'  
      document.querySelector('.etape3').style.display='flex' 



</script>
<?php
    }
else if ((($tabType[0]) !== "")&&(($tabType[1]) !== "")&&(($tabType[2]) !== "")&&(($tabType[3]) !== "")&&(($tabType[4]) == "")){
?>
<script> 
      document.querySelector('.alignicon6').style.display='flex' 
      document.querySelector('.alignicon7').style.display='flex' 
      document.querySelector('.alignicon8').style.display='flex' 
      document.querySelector('.alignicon9').style.display='flex' 
      document.querySelector('.etape1').style.display='flex' 
      document.querySelector('.etape2').style.display='flex'  
      document.querySelector('.etape3').style.display='flex' 
      document.querySelector('.etape4').style.display='flex' 

</script>

<?php
        }
 else if ((($tabType[0]) !== "")&&(($tabType[1]) !== "")&&(($tabType[2]) !== "")&&(($tabType[3]) !== "")&&(($tabType[4]) !== "")){
 ?>
<script> 
       document.querySelector('.alignicon6').style.display='flex' 
       document.querySelector('.alignicon7').style.display='flex' 
       document.querySelector('.alignicon8').style.display='flex' 
       document.querySelector('.alignicon9').style.display='flex' 
       document.querySelector('.alignicon10').style.display='flex' 
       document.querySelector('.etape1').style.display='flex' 
      document.querySelector('.etape2').style.display='flex'  
      document.querySelector('.etape3').style.display='flex' 
      document.querySelector('.etape4').style.display='flex' 
      document.querySelector('.etape5').style.display='flex' 


</script>
<?php
 }
?>
    
   
     <script src="assets/style.js"></script>
     <script src="assets/visibility.js"></script>
     <script src="assets/AjouEtape.js"></script>
     <script> // //////////////// afficher le point de départ automatiquement depuis la base de donnée //////////////////
                    var editDepartPoint=document.querySelector(".inputdepartpoint")
                    editDepartPoint.value="<?php echo $pt_depart ?>"
                    
     </script>
<!-- <script src="assets/pcDisplay.js"></script> -->
<script>
        let editTrajBloc = document.querySelector('#editTrajBloc')
        let displayPC5 = document.querySelector('.cadreDisplay')

        if (window.matchMedia("(min-width: 600px)").matches) {
            displayPC5.appendChild(editTrajBloc)
        }else{    displayPC5.removeChild(editTrajBloc);
}

     </script>

</body>
</html>
