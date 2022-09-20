

////////////////////ajout automatiques des div contenaire trajet//////////trajetbox=trajetCONTAINER//////////

// let click = document.getElementById(mesTrajets)
// click=document.addEventListener('click', function(){

//     // var trajetbox = document.createElement('div');
//     // trajetbox.classList.add('trajetDetail');
//     // document.body.appendChild(trajetbox)
// console.log("hello");
// // for (let i = 0; i < 2; i++) {

//     var trajetDetail = document.querySelector('.trajetContainer')
//     var trajetDetailClon = trajetDetail.cloneNode(true)
//     trajetDetail.parentNode.appendChild(trajetDetailClon)
//     //document.querySelector('.action').style.display ="none" 

//     // var action =document.querySelector('.action')
//     // var actionClon = action.cloneNode(true)
//     // var param = action.parentNode.appendChild(actionClon)





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


