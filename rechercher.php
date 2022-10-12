<?php
require_once 'fonctions.php';



////////////////////////////// afficher les info des utilisateur ///////////////////////////
$nom_utilisateur = $_SESSION['username'];

$req =  "SELECT * FROM utilisateur WHERE username = '$nom_utilisateur' ";
$rep = connect()->prepare($req);
$rep->execute();
$res = $rep->fetch(PDO::FETCH_OBJ);  
$nom = $res->nom;
$bio = $res->bio;
$photo = $res->photo;
?>

<!DOCTYPE html>
<html lang="fr">
<?php
include 'displayPc.php';

?>
<body>
  <section id="rechercherBloc">
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
                    <a href="proposerTrajet.php">
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
     <section id="searchTrajet">
     <label class="labelRegister">Rechercher un trajet</label>

         <form class="searchForm" method="GET" id="searchelement" action="resultRecherch.php">
            
            <p class="erreurRecherch">Veuillez remplir tous les champs !</p>
                <div class="alignerInput">
                    <div id="startPoint">
                        <iconify-icon icon="akar-icons:location" class="positionIcon"></iconify-icon>
                    </div>
                    <div class="destination">
                        <iconify-icon icon="akar-icons:location" class="destinationIcon"></iconify-icon>
                        <select name="destinationAdress" class="destinationSelection">
                            <option> Destination</option>
                            <option value="Avenue du Stade">Avenue du Stade</option>
                            <option value="Route Montaigu">Route Montaigu</option>
                        </select>
                    </div>
                        <div class="dateTrajet">
                            <iconify-icon icon="uil:calender" class="calenIcon"></iconify-icon>
                            <input class="dateLabel" type="date" name="date">
                        </div>
                        <div class="typeTrio">
                    <div class="checkBoxTypeTraj">
                        <input type="checkbox" id="allez-simple" clas="typeTrajet" name="typeTrajet[]" value="allez-simple" checked>
                        <label for="scales">Allez simple</label>
                      </div>
                  
                      <div class="checkBoxTypeTraj">
                        <input type="checkbox" id="allez-retour" clas="typeTrajet" name="typeTrajet[]" value="Allez-Retour">
                        <label for="Allez-Retour">Allez/Retour</label>
                      </div>
                </div> 
                        <div class="bouttonrechercher">
                       
                           <a href="" target="_blank"><input class= "searchButton" type="submit" id='submit' value='Rechercher' name='search' > </a>
                        </div>
                        <?php


                        ?>

         </form>
     </section>
  </section>
  <script>
        let rechercherBloc = document.querySelector('#rechercherBloc')
        let displayPC12 = document.querySelector('.cadreDisplay')

        if (window.matchMedia("(min-width: 600px)").matches) {
            displayPC12.appendChild(rechercherBloc)
        }else{    displayPC12.removeChild(rechercherBloc);
}

     </script>
     <script src="assets/style.js"></script>
     <script src="assets/visibility.js"></script>
</body>
</html>