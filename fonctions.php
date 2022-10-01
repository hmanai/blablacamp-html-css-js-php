
<?php
session_start();
function connect(){

    $host = 'localhost';
    $dbname = 'db_blablacampus';
    $username = 'root';
    $password = '';
    
    try {
    
    $db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password,  array(\PDO::MYSQL_ATTR_INIT_COMMAND =>  'SET NAMES utf8')); // pour prendre l'accent dans la base de donnée
    
    // echo "Connecté à $dbname sur $host avec succès.";
    
    return $db;
    } catch (PDOException $e) {
    
    die("Impossible de se connecter à la base de données $dbname :" . $e->getMessage());
    
    }
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////
function login(){
        if($_POST['username'] != "" && $_POST['password'] != ""){
            
            $username = $_POST['username'];
            $password = $_POST['password'];
            $sql = "SELECT * FROM `utilisateur` WHERE `username`=?  ";
            $query = connect()->prepare($sql);
            $query->execute(array($username));
            $row = $query->rowCount();
            $fetch = $query->fetch();
            if (($row > 0) && ((password_verify($password, $fetch['password'])))) {

                $_SESSION['username'] = $fetch['username'];
                $_SESSION['password'] = $password;
                ?>
                <!-- script for redirection after 1 second to research page -->
                <script>
                document.getElementById("felicitationLogin").style.display = "flex";
                setTimeout(function() { $("#felicitationLogin").hide(); }, 1000);
                document.getElementById("login").style.display = "none";

                function redirectionLogin() {
                    location.href="rechercher.php"               
                        }
                        setTimeout("redirectionLogin()", 1000); 
                </script>             
                <?php
                // header("location: rechercher.php");
                echo "Bienvenue ".$_SESSION['username'];
                    } else{
                        header("location: connexion.php?erreur=1");  
                        echo "<p style='color:red'>Utilisateur ou mot de passe incorrect</p>";
                      }
                    }
         else
         {
             header("location: connexion.php?erreur=2");  
    
         }}
         
//////////////////////////////////////////////////////////////////////////////////////////////////////////

    function register(){   
// verifier si le nom d'utilisateur existe déja

        $login=$_POST['username'];
        $erreur=0;
        $stmt = connect()->prepare("SELECT * FROM utilisateur WHERE username=?");
        $stmt->execute([$login]); 
        $user = $stmt->fetch();
        if ($user) {
            $erreur=1;
        } else {
       

            ///////////////////////////////////////upload photo de profil////////////////////////////////////////////////

            if(isset($_FILES['photo']) AND !empty($_FILES['photo']['name'])) {
                $tailleMax = 10000000;
                $extensionsValides = array('jpg', 'gif', 'png');
                if($_FILES['photo']['size'] <= $tailleMax) {
                   $extensionUpload = strtolower(substr(strrchr($_FILES['photo']['name'], '.'), 1));
                   if(in_array($extensionUpload, $extensionsValides)) {
                      $chemin = "assets/img/avatar/".$_SESSION['username'].".".$extensionUpload;
                      $resultat = move_uploaded_file($_FILES['photo']['tmp_name'], $chemin);
                      if($resultat) {
            //////////////////////////////////////////////////////////////////////////////////////////
            $nom=$_POST['nom'];
            $login=$_POST['username'];
            $pass=password_hash($_POST['password'],  PASSWORD_DEFAULT);
            $email=$_POST['email'];
            $bio=$_POST['bio'];
            $_SESSION['username']=$login;
            $img_blob = file_get_contents ($_FILES['photo']['tmp_name']);
                $req = connect()->prepare("insert into utilisateur(nom,username,password,email,bio,photo) values (?,?,?,?,?,?)");
                $req->execute(array($nom,$login,$pass,$email,$bio,$_SESSION['username'].".".$extensionUpload));
              if($req){
                ?>
                <!-- script for redirection after 1 second to research page -->
                <script>
                document.getElementById("felicitation").style.display = "flex";
                setTimeout(function() { $("#felicitation").hide(); }, 1000);
                document.getElementById("register").style.display = "none";
                function redirection() {
                    location.href="rechercher.php"               
                        }
                        setTimeout("redirection()", 1000); 
                </script>             
                <?php
                   header('Location: ./rechercher.php');   
               ///////////////////////////////
              }   
             else {
                     echo 'Error during registration';
                 }}}}}}}
            
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////function to display account informations in header///////////////////////

function displayInfo(){
    $nom_utilisateur = $_SESSION['username'];

    $req =  "SELECT * FROM utilisateur WHERE NOM_UTILISATEUR = '$nom_utilisateur' ";
    $rep = connect()->prepare($req);
    $rep->execute();
    $res = $rep->fetchAll(PDO::FETCH_ASSOC);     
    $number_of_rows = $rep->fetchColumn(); 
    print_r($number_of_rows) ;
    for ($i=0; $i < 1 ; $i++) { 
        foreach($res as $key => $value )
        
        { 
            $nom = $value['nom'];
            $user = $value['username'];
            $biog = $value['bio'];
            $photo = $value['photo'];
        }
}}


//////////////////////////////function modifier informations du compte/////////////////////////////////////

function editCompte(){

$user = $_GET["user-name"];
//var_dump($user);
       $nom=$_POST['nom'];
       $username=$_POST['username'];
       $password=password_hash($_POST['password'],  PASSWORD_DEFAULT);
       $email=$_POST['email'];
       $bio=$_POST['bio'];
      // $img_blob = file_get_contents ($_FILES['photo']['tmp_name']);

       //////////////modifier la photo////////////////
       if(isset($_FILES['photo']) && !empty($_FILES['photo']['name'])) {

       $tailleMax = 10000000;
       $extensionsValides = array('jpg', 'gif', 'png');
       if($_FILES['photo']['size'] <= $tailleMax) {
          $extensionUpload = strtolower(substr(strrchr($_FILES['photo']['name'], '.'), 1));
          if(in_array($extensionUpload, $extensionsValides)) {
             $chemin = "assets/img/avatar/".$_SESSION['username'].".".$extensionUpload;
             $resultat = move_uploaded_file($_FILES['photo']['tmp_name'], $chemin);

             if($resultat) {

       //////////////////////////////
       if ((!empty($_POST['nom'])) || (!empty($_POST['username'])) || (!empty($_POST['password'])) || (!empty($_POST['email'])) || (!empty($_POST['bio'])) || (!empty($_POST['photo']))){
     $req =  "UPDATE utilisateur SET nom = :nom, username = :username, password = :password, email = :email, bio = :bio, photo = :photo WHERE username = :login";
     $rep = connect()->prepare($req);
     $rep->execute(array(':nom' => $nom, 
    ':username' => $username, 
    ':password' => $password, 
    ':email' => $email,
    ':bio' => $bio, 
    ':photo' => $_SESSION['username'].".".$extensionUpload,
    ':login' => $user ));
     //header("location: index.php");
     if ($rep){
     //echo "<p style='color:green; text-ali'>" . "Modification effectuée avec succè" . "</p> ";
     
     ?>
             <script>
              document.querySelector('.confirm').style.display="flex"
              document.querySelector('.backtoSearch').style.display="flex"

              </script>
     <?php
   }
        else{
                echo "<p style='color:red;'>" . "Modification echouée" . "</p> ";
                }}}}
                }}
     else{ 
        $req =  "UPDATE utilisateur SET nom = :nom, username = :username, password = :password, email = :email, bio = :bio WHERE username = :login";
        $rep = connect()->prepare($req);
        $rep->execute(array(':nom' => $nom, 
       ':username' => $username, 
       ':password' => $password, 
       ':email' => $email,
       ':bio' => $bio, 
       ':login' => $user ));
        //header("location: index.php");
        if ($rep){
        //echo "<p style='color:green; text-ali'>" . "Modification effectuée avec succè" . "</p> ";
        
        ?>
                <script>
                 document.querySelector('.confirm').style.display="flex"
                 document.querySelector('.backtoSearch').style.display="flex"
   
                 </script>
        <?php

    }}
    }

    //////////////////////////////function Ajout d'un trajet /////////////////////////////////////

    function addTrajet(){
        $user=$_SESSION["username"];
        $depart=$_POST['departPointValue'];
        $arrivee=$_POST['destinationAdress'];
        $date=$_POST['date'];
        $heure=$_POST['heureDepart'];
        $heureArrive=$_POST['heureArrive'];
        $typeTrajet = implode(' ', $_POST["typeTrajet"]); // récuperer la valeur du checkbox (allez simple ou allez-retour)
        //echo  $typeTrajet;
        $nbPlace=$_POST['nbPlace'];
        $etape1 = $_POST['etape1'];
        $etape2 = $_POST['etape2'];
        $etape3 = $_POST['etape3'];
        $etape4 = $_POST['etape4'];
        $etape5 = $_POST['etape5'];
        $sql = "INSERT INTO `trajet` (id_trajet, pt_depart, pt_arrive, date_trajet, heure_trajet, heure_Arrive, type_trajet, nb_places, etapes, chauffeur )
                VALUES (NULL, :pt_depart, :pt_arrive, :date_trajet, :heure_trajet, :heure_Arrive, :type_trajet, :nb_places, :etapes, :chauffeur )";
        connect()->prepare($sql)->execute([
            ":pt_depart" => $depart,
            ":pt_arrive" => $arrivee,
            ":date_trajet" => $date, 
            ":heure_trajet" => $heure,
            ":heure_Arrive" => $heureArrive,
            ":type_trajet" => $typeTrajet,
            ":nb_places" => $nbPlace,
            ":etapes" => $etape1."/".$etape2."/".$etape3."/".$etape4."/".$etape5,
            ":chauffeur" => $user

        ]);
        if ($sql){
         ?>
         
            <script>
                document.querySelector('.confAjoutTrajet').style.display='flex'
                document.querySelector('.backtoSearch').style.display='flex'

            </script>
<?php        
        }
       
    }

////////////////////////////////////////Function change date ////////////////////////////////////////////

function changeDate($month){

    switch ($month) {
    case 01:
        echo "JAN";
        break;
    case 02:
        echo "FEV";
        break;
    case 03:
        echo "MAR";
        break;
    case 04:
        echo "AVR";
        break;
    case 05:
         echo "MAI";
         break;
    case 06:
        echo "JUIN";
        break;
    case 07:
        echo "JUILL";
        break;
    case 8:
        echo "AOUT";
        break;
    case 9:
        echo "SEP";
        break;
    case 10:
        echo "OCT";
        break;
    case 11:
        echo "NOV";
        break;
     case 12:
        echo "DEC";
        break;
    }
}

////////////////////////////////////////function edit Trajet/////////////////////////////////////////////////////////


function editTrajet(){

    $idTrajet = $_GET['id'];
    $user=$_SESSION["username"];
    $depart=$_POST['departPointValue'];
    $arrivee=$_POST['destinationAdress'];
    $date=$_POST['date'];
    $heure=$_POST['heureDepart'];
    $heureArrive=$_POST['heureArrive'];
    $typeTrajet = implode(' ', $_POST["typeTrajet"]); // récuperer la valeur du checkbox (allez simple ou allez-retour)
    //echo  $typeTrajet;
    $nbPlace=$_POST['nbPlace'];
    $etape1 = $_POST['etape1'];
    $etape2 = $_POST['etape2'];
    $etape3 = $_POST['etape3'];
    $etape4 = $_POST['etape4'];
    $etape5 = $_POST['etape5'];   
    $sql = "UPDATE trajet SET pt_depart = :pt_depart, pt_arrive = :pt_arrive, date_trajet = :date_trajet , heure_trajet = :heure_trajet, heure_Arrive = :heure_Arrive, type_trajet = :type_trajet, nb_places = :nb_places, etapes = :etapes, chauffeur = :chauffeur WHERE id_Trajet = $idTrajet ";
    connect()->prepare($sql)->execute(array(":pt_depart" => $depart,
                                            ":pt_arrive" => $arrivee,
                                            ":date_trajet" => $date, 
                                            ":heure_trajet" => $heure,
                                            ":heure_Arrive" => $heureArrive,
                                            ":type_trajet" => $typeTrajet,
                                            ":nb_places" => $nbPlace,
                                            ":etapes" => $etape1."/".$etape2."/".$etape3."/".$etape4."/".$etape5,
                                            ":chauffeur" => $user

    ));
    if($sql){
        ?>
        <!-- script for redirection after 1 second to research page -->
        <script>
        document.getElementById("felicitation").style.display = "flex";
        setTimeout(function() { $("#felicitation").hide(); }, 1000);
        document.getElementById("editTraj").style.display = "none";
        function redirection() {
            location.href="mesTrajets.php"               
                }
                setTimeout("redirection()", 1000); 
        </script>             
        <?php
           header('Location: ./mesTrajets.php');   
       ///////////////////////////////
      }   
     else {
             echo 'Error during registration';
         
    }
}

////////////////////////////////////////////delete trajet/////////////////////////////////////////////////////////////

function deleteTrajet(){

    $id = $_GET['id'];
    $sql = 'DELETE FROM trajet WHERE id_trajet=:id';
    $res = connect()->prepare($sql);
    if ($res->execute([':id' => $id])) {
        ?>
      <script>
                document.querySelector(".felicitationcorpsdelete").style.display = "flex";
                setTimeout(function() { $(".felicitationcorpsdelete").hide(); }, 1000);
                document.getElementById("deleteTraj").style.display = "none";
                function redirection() {
                    location.href="mesTrajets.php"               
                        }
                        setTimeout("redirection()", 1000); 
      </script>
      <?php
       
}}

///////////////////////////////////////////////////cancel reservation//////////////////////////////////////////////////////////////////////

function cancelReservation(){

    $id = $_GET['id'];
    var_dump($id);
    $sql = 'DELETE FROM reservation WHERE id_reservation = :id';
    $res = connect()->prepare($sql);
    if ($res->execute([':id' => $id])) {
        ?>
      <script>
                document.querySelector(".felicitationcorpsdelete").style.display = "flex";
                setTimeout(function() { $(".felicitationcorpsdelete").hide(); }, 1000);
                document.getElementById("deleteTraj").style.display = "none";
                function redirection() {
                    location.href="mesReservations.php"               
                        }
                        setTimeout("redirection()", 1000); 
      </script>
      <?php
       
}}








?>

