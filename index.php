
<?php include 'displayPc.php' ?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <!-- ************************************************ -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BlaBla Campus</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bungee&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@400;500&display=swap" rel="stylesheet">
    <script src="https://code.iconify.design/iconify-icon/1.0.0-beta.3/iconify-icon.min.js"></script> <!-- link for car icon -->
    <script src="https://kit.fontawesome.com/573723cbf2.js" crossorigin="anonymous"></script>
    <link rel="manifest" href="assets/manifest.json">
    <link rel="stylesheet" href="assets/style.css">
    <!-- <script>
        //if browser support service worker
        window.addEventListener('load', () =>{

        if('serviceWorker' in navigator) {
          navigator.serviceWorker.register('sw.js');
        }
        });
      </script> -->
      <script type="module">
        import 'https://cdn.jsdelivr.net/npm/@pwabuilder/pwaupdate';
        const el = document.createElement('pwa-update');
        document.body.appendChild(el);
      </script>
    <!-- ************************************************ -->
</head>


    <!-- ----------------------------------------------------- -->
   
    <section id= "accueil">
        <div class="logo">
            <img src="assets/img/logo.png" alt="">
            <p class="blabla"> BLABLA </br> <span class="compus"> campus</span> </p>
        </div>
        <img class="voiture" src="assets/img/voiture.png" alt="photo voiture et homme">
        <div class="commencer">
          <a class="enregistrer" href="register.php"> 
                <button class="start" > 
                <iconify-icon icon="ant-design:car-outlined" class="carIcon"></iconify-icon>
                <span> commencer</span>
                </button>
          </a>
            <a class="seConnecter" href="connexion.php"> se connecter</a>
        </div>
    </section>
    <script>
        let accueil = document.querySelector('#accueil')
        let displayPC15 = document.querySelector('.cadreDisplay')

        if (window.matchMedia("(min-width: 600px)").matches) {
            displayPC15.appendChild(accueil)
        }else{    displayPC15.removeChild(accueil);
}

     </script>
</body>
</html>