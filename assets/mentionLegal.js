
//////////////////// affichage mention legal///////////////////////////////

let mentionLegal = document.querySelector('.droit');
let closeLegal = document.querySelector('.closeLegal');

mentionLegal.addEventListener('click', function(e){
  e.preventDefault();
  document.querySelector('.legal').style.display ="flex"; 
  document.querySelector('#affichOrdi').style.filter="blur(5px)";
})
closeLegal.addEventListener('click', function(){
  document.querySelector('.legal').style.display ="none";
  document.querySelector('#affichOrdi').style.filter="blur(0)";

})

