<?php
require_once 'fonctions.php';

if ((ISSET($_GET['search'])) && ((empty($_GET['departPointValue'])) || (empty($_GET['destinationAdress'])) || (empty($_GET['date']))  )) {

       header('Location: ./rechercher.php'); 
       ?>
    <script>
  document.querySelector('.erreurRecherch').style.display ="flex" 
    </script>
     <?php
} 
else{
//////////////////////////////////// récuperer nom, bio et photo du chauffeur //////////////////////////////////////
$nom_utilisateur = $_SESSION['username'];
$req =  "SELECT * FROM utilisateur WHERE username = '$nom_utilisateur' ";
$rep = connect()->prepare($req);
$rep->execute();
$res = $rep->fetch(PDO::FETCH_OBJ);  
$nom = $res->nom;
$bio = $res->bio;
$photo = $res->photo;


//////////////////////////searchTraj();/////////////////////////////////// 

$departure = $_GET['departPointValue'];
$destination = $_GET['destinationAdress'];
$date_Trajet = $_GET['date'];
$type_traj = implode(' ', $_GET["typeTrajet"]);
$srcImg = "";
///////////////////////gerer type de trajet pour afficher le logo qui correspond //////



$date_explosee = explode("-", $date_Trajet);
$jour = $date_explosee[2];
$mois = $date_explosee[1];
// var_dump($destination);
// var_dump($date_Trajet);
$req =  "SELECT * FROM trajet WHERE pt_depart = :departure AND pt_arrive = :pt_arrive AND date_trajet = :date_Trajet AND type_trajet = :type_trajet";
$rep = connect()->prepare($req);
$rep->execute([':departure' => $departure,
               ':pt_arrive' => $destination,
               ':date_Trajet' => $date_Trajet,
               'type_trajet' => $type_traj
                ]);
// $rep->execute();
$res = $rep->fetchAll(PDO::FETCH_OBJ);  
$count = $rep->rowCount();
//var_dump($count);
// var_dump($res);
////////////////////////////////////////////////////////////////////////////

// resultRecherchTrajet();
?>
<!DOCTYPE html>
<html lang="fr">
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
                <div class="dayTrajet"><?php  echo $jour ?> </div>
                <div class="monthTrajet"> <?php echo changeDate($mois) ?></div>
            </div>
            <div class="places">
                <div class="startLocation"><?php echo $departure ?></div>
                <div class="finishLocation"><?php echo $destination ?></div> 
            </div>
            <div class="iconflech">
                <img class="fleche" src="assets/img/<?php echo $type_traj ?>" alt="image de deux fleches haut et bas">
           
            </div>
        </div>

       <div class="nombretrj"> <p class="nbTrajet"><span class="nombreTrajet"><?php echo $count ?></span> trajets disponibles</p></div>
        <div class="triTrajet">
            <img class="horloge" src="assets/img/horloge.png" alt="photo horloge">
            <p class="trajetTri" > Les trajets sont triés chronologiquement par heure de départ.</p>

        </div>
        <?php
         foreach($res as $key => $value )
    
         {  $id = $value -> id_trajet;
            $pt_depart = $value-> pt_depart ;
            $pt_arrive = $value-> pt_arrive ;
            $date_Trajet = $value-> date_trajet ;
            $heure_trajet = $value-> heure_trajet ;
            $heure_Arrive = $value-> heure_Arrive ;
            $type_trajet = $value-> type_trajet ;
            $nb_places = $value-> nb_places ;
            $etapes = $value-> etapes ;
            $chauffeur = $value-> chauffeur ;
            $tabType=explode("/", $etapes);
            //var_dump($tabType);
     
        
        ?>
     
        <a href="reserver.php?id=<?php echo $id ?>" class="linkreservePlace"><div class="detailsTrajet">
            <div class="nbrslttrj">
                <p class="nbplace">places disponibles:<span class="nomnrePlace"><?php echo $nb_places  ?></span></p>
            </div>
            <div class="details">
    
                <div class="hourTrip">
                    <span class="startHour"><?php echo $heure_trajet ?></span>
                    <span class="finishHour"><?php echo $heure_Arrive ?></span>
                </div>
                <div class="liaison">
                    <!-- <img class="cercleLiaison" src="assets/img/deuxCercles.png" alt="deux cercles liés par un trait"> -->
                
                    <span class="cercleHaut" > </span>
                    <span class="cercleBas"></span>
                   
                </div>
                <div class="citiestrip">
                    <div class="cityStart"><?php echo $pt_depart ?> </div>
                    <div class="cityFinish"><?php echo $pt_arrive ?></div>
                </div>

            </div>
            <div class="accountdetails">
            <?php ////////////////////////// récuperer photo et bio du chauffeur //////////////////////////////////////
                        $req =  "SELECT * FROM utilisateur WHERE username = '$chauffeur' ";
                        $rep = connect()->prepare($req);
                        $rep->execute();
                        $res = $rep->fetch(PDO::FETCH_OBJ);  
                        $nomChauf = $res->nom;
                        $bioChauf = $res->bio;
                        $photoChauf = $res->photo;
                    ?>
                <div class="photoAccount"> 
                    <img class="photoProfil" src="assets/img/avatar/<?php echo $photoChauf ?>" alt="">
                </div>
                <div class="bio">
                    <div class="nomUtilisateur"><?php echo $nomChauf ?></div>
                    <p class="biographie"><?php echo $bioChauf ?></p>
                </div>

            </div>
            
        </div></a>
        <?php
          }}
        
          ?>
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