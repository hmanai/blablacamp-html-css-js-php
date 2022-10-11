<?php include 'displayPc.php' ?>


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