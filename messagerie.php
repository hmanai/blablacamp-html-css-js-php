
<?php
 require_once 'fonctions.php';
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
  <section id="messagerieBloc">
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

     <section id="messagerie">

        <label class="titre"> messagerie</label>
        <?php
        if (empty($res)) 
         { echo "<p class='errormsgnores'>Messagerie Vide!</p>";
          
         }
        else
        foreach($res as $key => $value )
        { 
        $type = $value-> type_msg;
        $idTraj = $value-> id_traj;
//////////////////////////info trajet///////////////////////////////////////////////////////////
        $req3 =  "SELECT * FROM trajet WHERE id_trajet = $idTraj";
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
////////////////////////////////info emetteur////////////////////////////////////////////////////
$req4 =  "SELECT * FROM  message WHERE id_traj = $idTraj";
$rep4= connect()->prepare($req4);
$rep4->execute();
$res4 = $rep4->fetch(PDO::FETCH_OBJ); 
$sender = $res4->emetteur;
$idMsg = $res4->id_message;
// var_dump($sender);
                ///////////////////////photo du sender////////////////////////

$req5 =  "SELECT * FROM  utilisateur WHERE username = '$sender'";
$rep5= connect()->prepare($req5);
$rep5->execute();
$res5 = $rep5->fetch(PDO::FETCH_OBJ); 
$photo2 = $res5->photo;
// var_dump($res5);
///////////////////////////////////////////////////////////////////////////////////////////////


?>
        <div class="messagerieContainer">
            <div class="headerAcc">
                <div class="headerPhotoAccountMsg"> 
                        <img class="headerPhotoProfilMsg" src="assets/img/avatar/<?php echo $photo2; ?>" alt="photo de profil">
                </div>
               
                <div class="msgContainer">
                    <div class="user-nameMsg"><?php echo $sender; ?></div>
                    <div class="corpsMsg">
                        <p class="textjustify"><span class="typeMsg"><?php echo $type ?></span>
                        <?php if ($type=="Demande") {  

                         ?> <a href="validationReservation.php?id=<?php echo $idTraj?>&sender=<?php echo $sender ?>&idmsg=<?php echo $idMsg ?>" > <?php echo '<span class="corpsDemande"> de réservation pour le trajet <span class="departure">';  echo $depart; echo ' - </span> '; echo $destination;''; echo ' du '; '<span class="dateDeparture">'; echo $jour; echo " "; echo changeMonth($mois2); echo " "; echo $annee;'</span></span></p> '; ?> </a> <?php
                        }  else { echo '<span class="corpsDemande"> de votre réservation pour le trajet <span class="departure">';  echo $depart; echo ' - </span> '; echo $destination; ' '; echo '&nbsp du &nbsp';'<span class="dateDeparture">'; echo $jour; '&nbsp'; echo " "; echo changeMonth($mois2); echo " "; echo $annee;'</span></span></p>';}
                            ?>
                   
                        </div>
                </div>
            </div> 
            <span class="separateur"></span>
        </div>

        <?php } ?>
     </section>
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
<script>
        let messagerieBloc = document.querySelector('#messagerieBloc')
        let displayPC7 = document.querySelector('.cadreDisplay')

        if (window.matchMedia("(min-width: 600px)").matches) {
            displayPC7.appendChild(messagerieBloc)
        }else{    displayPC7.removeChild(messagerieBloc);
}

     </script>
<!-- <script src="assets/pcDisplay.js"></script> -->


</body>
</html>