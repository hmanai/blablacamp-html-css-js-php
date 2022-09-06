

// fonction pour glisser des photo de profil

function dropHandler(ev) {

    // Evite l'ouverture du fichier texte dans le navigateur
    ev.preventDefault();

    //Pour chaque fichier
    for (var i = 0; i < ev.dataTransfer.files.length; i++) {

        // le fichier
        file = ev.dataTransfer.files[i];

        reader = new FileReader();

        reader.onload = function () {
            //Ecriture dans la zone de texte
            document.querySelector('.textareaRegister').value = reader.result;
        }
                        //En cas d'erreur
                        reader.onerror = function () {
                            console.error("File reader error code = " + reader.error.code);
                        }
        
                        //Lecture du fichier
                        reader.readAsText(file);
        
                    }
        
                }