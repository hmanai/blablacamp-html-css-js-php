
<?php
session_start();
function connect(){

    $host = 'localhost';
    $dbname = 'db_blablacampus';
    $username = 'root';
    $password = '';
    
    try {
    
    $db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    
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
                header("location: rechercher.php");
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
            // utilisateur n'existe pas
        
            //     $img_taille = $_FILES['photo']['size'];   
            //     $taille_max = 10000000;
            //     if ($img_taille > $taille_max) {
            //         echo "Trop gros !";
            //         return false;
            //     }
            // $img_type = $_FILES['photo']['type'];
            // $img_nom  = $_FILES['photo']['name'];
            // $img_blob = file_get_contents ($_FILES['photo']['tmp_name']);

            ///////////////////////////////////////////////////////////////////////////////////////

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
                //}
 

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

?>

