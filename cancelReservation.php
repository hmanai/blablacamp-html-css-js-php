<?php
 
require_once 'fonctions.php';
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

?>

<!DOCTYPE html>
<html lang="fr">
<?php
include 'displayPc.php';

?>
<body>
    <section id="cancelResBloc">
     <header>
        <a class="logoHeader" href="rechercher.php"> <img class="logoHeader" src="assets/img/logo.png" alt="logo">  </a>
        <a class="logoProfil" href="#"> <img class="logoProfil" src="assets/img/logoProfil.png" alt="logo">  </a>
     </header>
     <div class=" felicitationcorpsdelete">
            <h2> Félicitation! <span class="styleusername"></span></h2>
            <p>Votre réservation à bien été annulée!</p>
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
                    <a href="proposerTrajet">
                        <button class= "searchTrajetButton" type="submit" id='submit' value='proposer un trajet' > 
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
    <section id= "deleteTraj">
    <div id="corpsDelete">
            <h2 class="deleteTitle"> Anulation</h2>
            <p class="deleteParag">Etes vous sure de vouloir annuler cette réservation?</p>
    </div> 
    <form class="deleteForm" method="POST" id="supTraj" action="">

        <div class="deleteBloc">
             <input class="registerButton" type="submit" name="cancel" value="annuler ma réservation">
            <a class="seConnecter" href="mesReservations.php"> Retour</a>
        </div>
    </form>
    </section>
    </section>
<?php 
    if (ISSET($_POST['cancel'])){

        cancelReservation();
    }
?>


    <script>

/////////////affichage de boite des information d'un compte/////////

    let logoProfil = document.querySelector('.logoProfil')
    logoProfil.addEventListener('click', function(){
    document.querySelector('.compteInfo').style.display="flex"
    document.querySelector('#deleteTraj').style.display ="none"  
 
})
    let close = document.querySelector('.close')
    close.addEventListener('click', function(){
    document.querySelector('#deleteTraj').style.display ="flex" 
    document.querySelector('.compteInfo').style.display="none"
})
</script>
</script>
     <script>
        let cancelResBloc = document.querySelector('#cancelResBloc')
        let displayPC1 = document.querySelector('.cadreDisplay')

        if (window.matchMedia("(min-width: 600px)").matches) {
            displayPC1.appendChild(cancelResBloc)
        }else{    displayPC1.removeChild(cancelResBloc);
}

     </script>
<!-- <script src="assets/pcDisplay.js"></script> -->

</body>
</html>
