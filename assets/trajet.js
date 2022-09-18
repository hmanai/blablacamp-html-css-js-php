

////////////////////ajout automatiques des div contenaire trajet//////////trajetbox=trajetCONTAINER//////////

let click = document.getElementById(mesTrajets)
click=document.addEventListener('click', function(){

    // var trajetbox = document.createElement('div');
    // trajetbox.classList.add('trajetDetail');
    // document.body.appendChild(trajetbox)



console.log("hello");



// for (let i = 0; i < 2; i++) {

    var trajetDetail = document.querySelector('.trajetContainer')
    var trajetDetailClon = trajetDetail.cloneNode(true)
    trajetDetail.parentNode.appendChild(trajetDetailClon)
    document.querySelector('.action').style.display ="none" 

    // var action =document.querySelector('.action')
    // var actionClon = action.cloneNode(true)
    // var param = action.parentNode.appendChild(actionClon)

    const trajetContainers = document.querySelectorAll(".trajetDetail");

// This handler will be executed only once when the cursor
// moves over the trajetdetail 
  trajetContainers.forEach(trajetDetail => {

    trajetDetail.addEventListener("mouseenter", (event) => {
  document.querySelector('.action').style.display ="flex" 
  // reset the display after a short delay
  setTimeout(() => {
    document.querySelector('.action').style.display ="none" 
}, 5000);
}, false);

})


    // console.log(param);
//}
})



/////////////////display flex to action when mouseover////////////////////////


