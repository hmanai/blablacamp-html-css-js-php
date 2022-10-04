
<?php
 
 require_once 'fonctions.php';
 
 $nom_utilisateur = $_SESSION['username'];
  $idTrajet = $_GET['id'];
 

 
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
 

 $req =  "SELECT * FROM trajet WHERE id_trajet = :id";
 $rep = connect()->prepare($req);
 $rep->execute([':id' => $idTrajet ]);
 $res = $rep->fetch(PDO::FETCH_OBJ);  
 $count = $rep->rowCount();
 $id_traj = $res-> id_trajet;
 $pt_depart = $res-> pt_depart ;
 $pt_arrive = $res-> pt_arrive ;
 $date_Trajet = $res-> date_trajet ;
 $type_Trajet = $res-> type_trajet ;
 $date_explosee = explode("-", $date_Trajet);
 $jour = $date_explosee[2];
 $mois = $date_explosee[1];
 $chauff = $res -> chauffeur;
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
    <title>Réserver une Place</title>
 
</head>
<body>
<header>
        <a class="logoHeader" href="index.html"> <img class="logoHeader" src="assets/img/logo.png" alt="logo">  </a>
        <a class="logoProfil" href="#"> <img class="logoProfil" src="assets/img/logoProfil.png" alt="logo">  </a>
     </header>
     <div id="felicitation">
        <header class="felicitationheader">
            <a class="logoHeader" href="index.html"><img  class="logoHeader" src="assets/img/logo.png" alt="logo"></a> 
            <span class="headConnexion"> confirmation</span>     
        </header>
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
              <a class="accountInformation" href="#"><img class="iconnavbar" src="assets/img/iconmessagerie.png" alt="icone Messagerie"> Messagerie</a>
              <a class="accountInformation" href="logout.php"><iconify-icon class="iconnavbarflech" icon="bx:arrow-back"></iconify-icon>Se déconnecter</a>
            </div>
       </div>
   </div>

     <section id="mesTrajets">

        <label class="titre"> réserver une Place</label>

        <div class="trajetContainer">

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
                    <img class="fleche" src="assets/img/<?php echo $type_Trajet ?>" alt="image de deux fleches haut et bas">
                </div>
            </div>
        </div>
        <div class="corpsParagraph">
            <p class="bonjour"> Bonjour <span class="bjrUser"><?php echo $chauff ?></span></p></br>
            <p class="paragrafReserv">Je souhaiterai réserver une place dans ta voiture pour le trajet <span class="ptdep_ptarr"><?php echo $pt_depart ?> - <?php echo $pt_arrive ?></span>.</br></br></br>
            En te remerciant. </p>
        </div>
        <form class="reserveForm" action="" method="POST" >
        <div class="bouttonEnvoy"><input class= "registerButton" type="submit" id='send' value='envoyer ma demande' name="valider" ></div>
<?php 


if (ISSET($_POST['valider'])){reserve();}
                //     $date_msg = date('d-m-Y');
                //     $type_msg = "demande";
                //     var_dump($idTrajet);
                //     var_dump($date_msg);
                //     var_dump($type_msg);
                //     var_dump($nom_utilisateur);
                //     var_dump($chauff);
                //     if (ISSET($_POST['valider'])){

                //         // $req = connect()->prepare("insert into message(id_trajet,date_msg,type_msg,emetteur,recepteur) values (?,?,?,?,?)");
                //         // $req->execute(array($idTrajet,$date_msg,$type_msg,$nom_utilisateur,$chauff));

                //         $sql = "INSERT INTO `message` (id_message, id_trajet, date_msg, type_msg, emetteur, recepteur)
                //         VALUES (NULL, :id_trajet, :date_msg, :type_msg, :emetteur, :recepteur)";
                //     connect()->prepare($sql)->execute([
                //     ":id_trajet" => $idTrajet,
                //     ":date_msg" => $date_msg,
                //     ":type_msg" => $type_msg ,
                //     ":emetteur" => $nom_utilisateur,
                //     ":recepteur" => $chauff
                // ]);
                // if ($sql){
                //     ?>
                    <script>
                //          document.querySelector("#felicitation").style.display = "flex";
                //               setTimeout(function() { $(".felicitation").hide(); }, 1000);
                //               document.getElementById("mesTrajets").style.display = "none";
                //               function redirection() {
                //                   location.href="rechercher.php"               
                //                       }
                //                       setTimeout("redirection()", 1000); 
                //     </script>
                    <?php
                //     }}


                 
?>
    </form>
        

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

//////////////redirection//////////


</script>

</body>
</html>