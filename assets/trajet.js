

        ///////////////////////////// ajouter etape en cliquant sur icon plus /////////////////////////////





/////////////////////////////////show action for 3 seconds and then hide it /////////////////////////////////////////

   const trajetContainers = document.querySelectorAll(".trajetContainer");

// This handler will be executed only once when the cursor
// moves over the trajetdetail 
for (let i = 0; i < trajetContainers.length; i++){

    trajetContainers[i].addEventListener("mouseenter", (event) => {
        
               let action =  document.querySelectorAll('.action')
               //let actionCancel = document.querySelectorAll('.actionCancel')
                    action[i].style.display ="flex" 
                   // actionCancel[i].style.display ="flex"
                    // reset the display after a short delay
                    setTimeout(() => {
                    action[i].style.display ="none" 
                  //  actionCancel[i].style.display ="none" 

                    }, 5000);
                    }, false)};

/////////////////display flex to action when mouseover on page mes reservations////////////////////////


const trajetContainerdelete = document.querySelectorAll(".trajetContainerdelete");

// This handler will be executed only once when the cursor
// moves over the trajetdetail 
for (let i = 0; i < trajetContainerdelete.length; i++){

    trajetContainerdelete[i].addEventListener("mouseenter", (event) => {
        
               let actionCancel =  document.querySelectorAll('.actionCancel')
               actionCancel[i].style.display ="flex" 
                  setTimeout(() => {
                        actionCancel[i].style.display ="none" 

                    }, 5000);
                    }, false)};



///////////////////////////////////////////redirection pour confirmer l'envoie d'une demande d eréservation pour un trajet////////////////////////////////////////////////////////////
