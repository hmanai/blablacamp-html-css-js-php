


var requestOptions = {
    method: 'GET',
  };
  
  fetch("https://api.geoapify.com/v2/places?categories=commercial.supermarket&filter=rect%3A10.716463143326969%2C48.755151258420966%2C10.835314015356737%2C48.680903341613316&limit=20&apiKey=bfbf77f946494523b86efd1c25fda4e7", requestOptions)
    .then(response => response.json())
    .then(result => console.log(result))
    .catch(error => console.log('error', error));
  /* 
      The addressAutocomplete takes as parameters:
    - a container element (div)
    - callback to notify about address selection
    - geocoder options:
         - placeholder - placeholder text for an input element
       - type - location type
  */
  
  
  var searchelement = document.getElementById("searchelement")
  var startInput = document.querySelector(".startInput")
  
  function addressAutocomplete2(containerElement, callback, options) {
    // create input element
    var inputElement2 = document.createElement("input");
    inputElement2.setAttribute("type", "text");
    inputElement2.setAttribute("class", "inputdepartpoint2");
    inputElement2.setAttribute("id", "inputId2");
    inputElement2.setAttribute("name", "departPointValue2");
  
    inputElement2.setAttribute("placeholder", options.placeholder);
    containerElement.appendChild(inputElement2);
  
    // add input field clear button
    var clearButton = document.createElement("div");
    clearButton.classList.add("clear-button");
    addIcon(clearButton);
    clearButton.addEventListener("click", (e) => {
      e.stopPropagation();
      inputElement2.value = '';
      callback(null);
      clearButton.classList.remove("visible");
      closeDropDownList();
    });
    containerElement.appendChild(clearButton);
  
    /* Current autocomplete items data (GeoJSON.Feature) */
    var currentItems;
  
    /* Active request promise reject function. To be able to cancel the promise when a new request comes */
    var currentPromiseReject;
  
    /* Focused item in the autocomplete list. This variable is used to navigate with buttons */
    var focusedItemIndex;
  
    /* Execute a function when someone writes in the text field: */
    inputElement2.addEventListener("input", function(e) {
      var currentValue = this.value;
  
      /* Close any already open dropdown list */
      closeDropDownList();
  
      // Cancel previous request promise
      if (currentPromiseReject) {
        currentPromiseReject({
          canceled: true
        });
      }
  
      if (!currentValue) {
        clearButton.classList.remove("visible");
        return false;
      }
  
      // Show clearButton when there is a text
      clearButton.classList.add("visible");
  
      /* Create a new promise and send geocoding request */
      var promise = new Promise((resolve, reject) => {
        currentPromiseReject = reject;
  
        var apiKey = "bfbf77f946494523b86efd1c25fda4e7";
        var url = `https://api.geoapify.com/v1/geocode/autocomplete?text=${encodeURIComponent(currentValue)}&limit=5&apiKey=${apiKey}`;;
        
        if (options.type) {
            url += `&type=${options.type}`;
        }
  
        fetch(url)
          .then(response => {
            // check if the call was successful
            if (response.ok) {
              response.json().then(data => resolve(data));
            } else {
              response.json().then(data => reject(data));
            }
          });
      });
  
      promise.then((data) => {
        currentItems = data.features;
  
        /*create a DIV element that will contain the items (values):*/
        var autocompleteItemsElement = document.createElement("div");
        autocompleteItemsElement.setAttribute("class", "autocomplete-items");
        containerElement.appendChild(autocompleteItemsElement);
  
        /* For each item in the results */
        data.features.forEach((feature, index) => {
          /* Create a DIV element for each element: */
          var itemElement = document.createElement("DIV");
          /* Set formatted address as item value */
          itemElement.innerHTML = feature.properties.formatted;
  
          /* Set the value for the autocomplete text field and notify: */
          itemElement.addEventListener("click", function(e) {
            inputElement2.value = currentItems[index].properties.city;
            console.log(inputElement2.value);

            callback(currentItems[index]);
  
            /* Close the list of autocompleted values: */
            closeDropDownList();
  
          });
  
          autocompleteItemsElement.appendChild(itemElement);
        });
      }, (err) => {
        if (!err.canceled) {
          console.log(err);
        }
      });
    });
  
    /* Add support for keyboard navigation */
    inputElement2.addEventListener("keydown", function(e) {
      var autocompleteItemsElement = containerElement.querySelector(".autocomplete-items");
      if (autocompleteItemsElement) {
        var itemElements = autocompleteItemsElement.getElementsByTagName("div");
        if (e.keyCode == 40) {
          e.preventDefault();
          /*If the arrow DOWN key is pressed, increase the focusedItemIndex variable:*/
          focusedItemIndex = focusedItemIndex !== itemElements.length - 1 ? focusedItemIndex + 1 : 0;
          /*and and make the current item more visible:*/
          setActive(itemElements, focusedItemIndex);
        } else if (e.keyCode == 38) {
          e.preventDefault();
  
          /*If the arrow UP key is pressed, decrease the focusedItemIndex variable:*/
          focusedItemIndex = focusedItemIndex !== 0 ? focusedItemIndex - 1 : focusedItemIndex = (itemElements.length - 1);
          /*and and make the current item more visible:*/
          setActive(itemElements, focusedItemIndex);
        } else if (e.keyCode == 13) {
          /* If the ENTER key is pressed and value as selected, close the list*/
          e.preventDefault();
          if (focusedItemIndex > -1) {
            closeDropDownList();
          }
        }
      } else {
        if (e.keyCode == 40) {
          /* Open dropdown list again */
          var event = document.createEvent('Event');
          event.initEvent('input', true, true);
          inputElement2.dispatchEvent(event);
        }
      }
    });
  
    function setActive(items, index) {
      if (!items || !items.length) return false;
  
      for (var i = 0; i < items.length; i++) {
        items[i].classList.remove("autocomplete-active");
      }
  
      /* Add class "autocomplete-active" to the active element*/
      items[index].classList.add("autocomplete-active");
  
      // Change input value and notify
      inputElement2.value = currentItems[index].properties.formatted;
      callback(currentItems[index]);
    }
  
    function closeDropDownList() {
      var autocompleteItemsElement = containerElement.querySelector(".autocomplete-items");
      if (autocompleteItemsElement) {
        containerElement.removeChild(autocompleteItemsElement);
      }
  
      focusedItemIndex = -1;
    }
  
    function addIcon(buttonElement) {
      var svgElement = document.createElementNS("http://www.w3.org/2000/svg", 'svg');
      svgElement.setAttribute('viewBox', "0 0 24 24");
      svgElement.setAttribute('height', "24");
  
      var iconElement = document.createElementNS("http://www.w3.org/2000/svg", 'path');
      iconElement.setAttribute("d", "M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z");
      iconElement.setAttribute('fill', 'currentColor');
      svgElement.appendChild(iconElement);
      buttonElement.appendChild(svgElement);
    }
    
      /* Close the autocomplete dropdown when the document is clicked. 
        Skip, when a user clicks on the input field */
    document.addEventListener("click", function(e) {
      if (e.target !== inputElement2) {
        closeDropDownList();
      } else if (!containerElement.querySelector(".autocomplete-items")) {
        // open dropdown list again
        var event = document.createEvent('Event');
        event.initEvent('input', true, true);
        inputElement2.dispatchEvent(event);
      }
    });
   /////////////////////////////////////
   ////////////////////// script ajouter etape en cliquant sur l'icone plus///////////////////
  
   
   let click = document.querySelectorAll('.iconPlus')
   var count = 0;
   for (let i = 0; i < click.length; i++) {
       click[i].addEventListener('click', function(){
                   count++;
                   console.log('hi')
                   console.log(inputElement2.value);
                   var disp = document.getElementById("displayEtape");
                       //disp.innerHTML = count;
                      var etape1 = document.getElementById('etape1').value 
                      var etape2 = document.getElementById('etape2').value
                      var etape3 = document.getElementById('etape3').value  
                      var etape4 = document.getElementById('etape4').value 
                      if (inputElement2.value =="") {document.querySelector('.msgErreur').style.display="flex"}
                        else{
                          document.querySelector('.msgErreur').style.display="none"
                          if ((etape1  == "" ))
                          {
                                document.querySelector('.etape1').value = inputElement2.value
                                document.querySelector('.etape1').style.display="flex"
                                document.querySelector('.alignicon6').style.display='flex' 

                                count++;
                                }
                                else if ((etape1 !== "")&& (etape2 == ""))
                                {
                                      document.querySelector('.etape2').value = inputElement2.value
                                      document.querySelector('.etape1').style.display="flex"
                                      document.querySelector('.etape2').style.display="flex"
                                      document.querySelector('.alignicon6').style.display='flex' 
                                      document.querySelector('.alignicon7').style.display='flex' 

  
                                      count++;
                                      }
                                      else if ((etape1 !== "") && (etape2 !== "") && (etape3 == ""))
                                      {
                                      document.querySelector('.etape3').value = inputElement2.value
                                      document.querySelector('.etape1').style.display="flex"
                                      document.querySelector('.etape2').style.display="flex"
                                      document.querySelector('.etape3').style.display="flex"
                                      document.querySelector('.alignicon6').style.display='flex' 
                                      document.querySelector('.alignicon7').style.display='flex' 
                                      document.querySelector('.alignicon8').style.display='flex' 

                                      count++;
                                      }
                                            else if ((etape1 !== "") && (etape2 !== "") && (etape3 !== "") && (etape4 == "") )
                                            {
                                            document.querySelector('.etape4').value = inputElement2.value
                                            document.querySelector('.etape1').style.display="flex"
                                            document.querySelector('.etape2').style.display="flex"
                                            document.querySelector('.etape3').style.display="flex"
                                            document.querySelector('.etape4').style.display="flex"      
                                            document.querySelector('.alignicon6').style.display='flex' 

                                            document.querySelector('.alignicon7').style.display='flex' 
                                            document.querySelector('.alignicon8').style.display='flex' 
                                            document.querySelector('.alignicon9').style.display='flex' 

  
                                            count++;
                                            }
                                                    else 
                                                    {
                                                    document.querySelector('.etape5').value = inputElement2.value
                                                    document.querySelector('.etape1').style.display="flex"
                                                    document.querySelector('.etape2').style.display="flex"
                                                    document.querySelector('.etape3').style.display="flex"
                                                    document.querySelector('.etape4').style.display="flex"
                                                    document.querySelector('.etape5').style.display="flex"
                                                    document.querySelector('.alignicon6').style.display='flex' 
                                                    document.querySelector('.alignicon7').style.display='flex' 
                                                    document.querySelector('.alignicon8').style.display='flex' 
                                                    document.querySelector('.alignicon9').style.display='flex' 
                                                    document.querySelector('.alignicon10').style.display='flex' 

  
                                                    count++;
                                                    }
                                                  }
        
   
                       })
           
   ///////////////////////////////////////////////
   ////////////////////////////////////////////
  
  }
}
  
  //////////////////display input to write the "etape"/////////////////////// 
  
  addressAutocomplete2(document.getElementById("etapes"), (data) => {
    console.log("Selected option: ");
    console.log(data);
  }, {
      placeholder: "Etapes"
  });
  
  
  ///////////////////////////////////////Supprimer les étapes qui ont été affiché automatiquement depuis la base de donnée////////////////////////////////////////////

 
  let clicktoDelete6 = document.querySelector('.iconeMoin6')
  let clicktoDelete7 = document.querySelector('.iconeMoin7')
  let clicktoDelete8 = document.querySelector('.iconeMoin8')
  let clicktoDelete9 = document.querySelector('.iconeMoin9')
  let clicktoDelete10 = document.querySelector('.iconeMoin10')

    clicktoDelete6.addEventListener('click', function(){
         console.log("heeeeey");
        document.querySelector('.alignicon6').style.display="none"
        document.querySelector('.etape1').value=""

       })

       clicktoDelete7.addEventListener('click', function(){
        console.log("heeeeey");
       document.querySelector('.alignicon7').style.display="none"
       document.querySelector('.etape2').value=""
      })
      clicktoDelete8.addEventListener('click', function(){
        console.log("heeeeey");
       document.querySelector('.alignicon8').style.display="none"
       document.querySelector('.etape3').value=""
      })
      clicktoDelete9.addEventListener('click', function(){
        console.log("heeeeey");
       document.querySelector('.alignicon9').style.display="none"
       document.querySelector('.etape4').value=""
      })
      clicktoDelete10.addEventListener('click', function(){
        console.log("heeeeey");
       document.querySelector('.alignicon10').style.display="none"
       document.querySelector('.etape5').value=""
      })