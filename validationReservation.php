
<?php
 
 require_once 'fonctions.php';

 $idTrajet = $_GET['id'];

  ////////////////////////////////////////// récuperer info utilisateur ////////////////////////////////////

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
 

 ////////////////////////////////////////// récuperer les info du demandeur de place et du trajet ////////////////////////////////////
$req =  "SELECT * FROM message WHERE recepteur = '$nom_utilisateur' ";
 $rep = connect()->prepare($req);
 $rep->execute();
 $res = $rep->fetchAll(PDO::FETCH_OBJ);  

 ?>

<!DOCTYPE html>
<html lang="fr">
    <?php
include 'displayPc.php';
?>
<body>
  <section id="validReserBloc">
    <header>
        <a class="logoHeader" href="rechercher.php"> <img class="logoHeader" src="assets/img/logo.png" alt="logo">  </a>
        <a class="logoProfil" href="#"> <img class="logoProfil" src="assets/img/logoProfil.png" alt="logo">  </a>
     </header>
     <div id="felicitationPlace">
     
        <div class=" felicitationcorps">
            <h2> Félicitation <span class="styleusername"></span></h2>
            <p>Votre message a bien été envoyé!</p>
        </div>

     </div> 
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
              <a class="accountInformation" href="messagerie.php"><img class="iconnavbar" src="assets/img/iconmessagerie.png" alt="icone Messagerie"> Messagerie</a>
              <a class="accountInformation" href="logout.php"><iconify-icon class="iconnavbarflech" icon="bx:arrow-back"></iconify-icon>Se déconnecter</a>
            </div>
       </div>
   </div>

     <section id="validmessagerie">

        <label class="titre"> Validation de la réservation</label>
       <?php
////////////////////////////////info emetteur////////////////////////////////////////////////////
$req4 =  "SELECT * FROM  message WHERE id_traj =  $idTrajet";
$rep4= connect()->prepare($req4);
$rep4->execute();
$res4 = $rep4->fetch(PDO::FETCH_OBJ); 
$sender = $res4->emetteur;
// var_dump($sender);
                ///////////////////////photo du sender////////////////////////

$req5 =  "SELECT * FROM  utilisateur WHERE username = '$sender'";
$rep5= connect()->prepare($req5);
$rep5->execute();
$res5 = $rep5->fetch(PDO::FETCH_OBJ); 
$photo2 = $res5->photo;
// var_dump($res5);
////////////////////////////////////////info trajet ///////////////////////////////////////////////////////
$req3 =  "SELECT * FROM trajet WHERE id_trajet = $idTrajet";
$rep3= connect()->prepare($req3);
$rep3->execute();
$res3 = $rep3->fetch(PDO::FETCH_OBJ); 
$depart = $res3->pt_depart;
$destination = $res3->pt_arrive;
$date = $res3->date_trajet;
$date_explosee = explode("-", $date);
$jour = $date_explosee[2];
$mois2 = $date_explosee[1];
$annee = $date_explosee[0];



?>
        <div class="messagerieContainer">
            <div class="headerAcc">
                <div class="headerPhotoAccountMsg"> 
                        <img class="headerPhotoProfilMsg" src="assets/img/avatar/<?php echo $photo2; ?>" alt="photo de profil">
                </div>
               
                <div class="msgContainer">
                    <div class="user-nameMsg"><?php echo $sender; ?></div>
                    <div class="corpsMsg">
                        <p class="textjustify"><span class="corpsDemande"><?php echo "Demande" ?></span>
                       

                      <?php echo '<span class="corpsDemande"> de réservation pour le trajet <span class="departure">';  echo $depart; echo ' - </span> '; echo $destination; echo ' du ';'<span class="dateDeparture">'; echo $jour; echo " "; echo changeMonth($mois2); echo " "; echo $annee;'</span></span></p> '; 
                            ?>
                        </div>
                </div>
            </div> 
                <!-- ---------------------------------------------------- -->

                <div class="corpsParagraph">
            <p class="bonjour"> Bonjour <span class="bjrUser"><?php echo $sender ?></span></p></br>
            <p class="paragrafReserv">je t’informe qu’une place t’attend dans ma voiture pour le trajet. <span class="ptdep_ptarr"><?php echo $depart ?> - <?php echo $destination ?></span>.</br></br></br>
            A tout bientot. </p>
        </div>
        </div>
        <form class="reserveForm" action="" method="POST" >
            <div class="bouttonEnvoy"><input class= "registerButton" type="submit" id='send' value='valider la réservation' name="valider" ></div>
        <?php
            if (ISSET($_POST['valider'])){
                reservePlace();
                
            }
        ?>
        </form>
    
     </section>
        </section>
<script>

/////////////affichage de boite des information d'un compte/////////

    let logoProfil = document.querySelector('.logoProfil')
    logoProfil.addEventListener('click', function(){
    document.querySelector('.compteInfo').style.display="flex"
    document.querySelector('#validmessagerie').style.display ="none"  
 
})
    let close = document.querySelector('.close')
    close.addEventListener('click', function(){
    document.querySelector('#validmessagerie').style.display ="flex" 
    document.querySelector('.compteInfo').style.display="none"
})

//////////////affichage de editer et supprimer trajet //////////

</script>
<script>
        let validReserBloc = document.querySelector('#validReserBloc')
        let displayPC13 = document.querySelector('.cadreDisplay')

        if (window.matchMedia("(min-width: 600px)").matches) {
            displayPC13.appendChild(validReserBloc)
        }else{    displayPC13.removeChild(validReserBloc);
}

     </script>
</body>
</html>