

        ///////////////////////////// ajouter etape en cliquant sur icon plus /////////////////////////////





/////////////////////////////////show action for 3 seconds and then hide it /////////////////////////////////////////

   const trajetContainers = document.querySelectorAll(".trajetContainer");

// This handler will be executed only once when the cursor
// moves over the trajetdetail 
for (let i = 0; i < trajetContainers.length; i++){

    trajetContainers[i].addEventListener("mouseenter", (event) => {
        
               let action =  document.querySelectorAll('.action')
                    action[i].style.display ="flex" 
                    // reset the display after a short delay
                    setTimeout(() => {
                    action[i].style.display ="none" 
                    }, 5000);
                    }, false)};

                
    // console.log(param);

//})



/////////////////display flex to action when mouseover////////////////////////


