<?php
  require_once 'fonctions.php';
// session_start();
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

// var_dump($photo)

////////////////////////////////////////// récuperer mes trajet ////////////////////////////////////



$req =  "SELECT * FROM trajet WHERE chauffeur = :chauffeur";
$rep = connect()->prepare($req);
$rep->execute([':chauffeur' => $nom_utilisateur ]);
// $rep->execute();
$res = $rep->fetchAll(PDO::FETCH_OBJ);  
$count = $rep->rowCount();
//var_dump($count);
// var_dump($res);
////////////////////////////////////////////////////////////////////////////

// resultRecherchTrajet();
?>

<!DOCTYPE html>
<html lang="en">
<?php
  include 'displayPc.php';

?>
<body>
  <section id="mesTrajBloc">
    <header>
        <a class="logoHeader" href="rechercher.php"> <img class="logoHeader" src="assets/img/logo.png" alt="logo">  </a>
        <a class="logoProfil" href="#"> <img class="logoProfil" src="assets/img/logoProfil.png" alt="logo">  </a>
     </header>
     <!-- <div class="compteInfor"> -->
      
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
   <!-- </div> -->

     <section id="mesTrajets">
        <label class="titre"> mes trajet</label>
        <?php
         if (empty($res)) 
         { echo "<p class='errormsgnores'>Pas de Trajets Disponibles!</p>";
          
         }
        else
         foreach($res as $key => $value )
    
         {  $id_traj = $value-> id_trajet;
            $pt_depart = $value-> pt_depart ;
            $pt_arrive = $value-> pt_arrive ;
            $date_Trajet = $value-> date_trajet ;
            $type_Trajet = $value-> type_trajet ;
            $date_explosee = explode("-", $date_Trajet);
            $jour = $date_explosee[2];
            $mois = $date_explosee[1];
     
     
        
        ?>
   
        <div class="trajetContainer">
            <div class="action">
                <div class="editer">
                    <label class="titrePage"><a class="editLink" href="editTrajet.php?id=<?php echo $id_traj ?>"> editer</a></label> 
                </div>
                <div class="supprimer">
                    <label class="titrePage"><a class="editLink" href="deleteTrajet.php?id=<?php echo $id_traj ?>"> supprimer</a></label>
                </div>
            </div>
            <div class="trajetDetail">
                <div class="dateTraj">
                    <div class="dayTrajet"><?php echo $jour ?> </div>
                    <div class="monthTrajet"><?php echo changeDate($mois) ?></div>
                </div>
                <div class="places">
                    <div class="startLocation"><?php echo $pt_depart ?></div>
                    <div class="finishLocation"><?php echo  $pt_arrive ?></div> 
                </div>
                <div class="iconflech">
                    <img class="fleche" src="assets/img/<?php echo $type_Trajet ?>.png" alt="image de deux fleches haut et bas">
                </div>
            </div>
        </div>
<?php }?>
     </section>
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
</script>
<script>
        let mesTrajBloc = document.querySelector('#mesTrajBloc')
        let displayPC8 = document.querySelector('.cadreDisplay')

        if (window.matchMedia("(min-width: 600px)").matches) {
            displayPC8.appendChild(mesTrajBloc)
        }else{    displayPC8.removeChild(mesTrajBloc);
}

     </script>
<script src="assets/trajet.js"> </script>
<!-- <script src="assets/pcDisplay.js"></script> -->

</body>
</html>