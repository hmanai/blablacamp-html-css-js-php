   
   
   
   
//    let dateLabel = document.querySelector('.dateLabelToday')
//    dateLabel.addEventListener('click', function(){
//    document.querySelector('.dateLabelToday').style.display ="none" 

//  })

  let logoProfil = document.querySelector('.logoProfil')
  logoProfil.addEventListener('click', function(){
  document.querySelector('#searchTrajet').style.display ="none" 
  document.querySelector('.compteInfo').style.display="flex"
 
})

let close = document.querySelector('.close')                                                             
close.addEventListener('click', function(){
  document.querySelector('#searchTrajet').style.display ="flex" 
  document.querySelector('.compteInfo').style.display="none"
})

