

////////////////////ajout automatiques des div contenaire trajet//////////trajetbox=trajetCONTAINER//////////

let click = document.getElementById(mesTrajets)
click=document.addEventListener('click', function(){

    // var trajetbox = document.createElement('div');
    // trajetbox.classList.add('trajetDetail');
    // document.body.appendChild(trajetbox)



console.log("hello");



for (let i = 0; i < 9; i++) {

    var trajetDetail = document.querySelector('.trajetContainer')
    var trajetDetailClon = trajetDetail.cloneNode(true)
    trajetDetail.parentNode.appendChild(trajetDetailClon)
    // var action =document.querySelector('.action')
    // var actionClon = action.cloneNode(true)
    // var param = action.parentNode.appendChild(actionClon)


    // console.log(param);




}



})







