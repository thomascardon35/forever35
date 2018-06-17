"use strict";


// Avec cette fonction , on vérifie que notre valeur est un nombre entier 
function isInteger(value) {

    /*if(isNumber(value) && value%1 === 0){
     return true;
     } else {
     return false
     }*/

    //on teste que la valeur est bien un nombre(isNumber) et que celui-ci est un entier avec modulo 1 === 0
    // si modulo 1 etait égal à 0 virgule quelque chose : cela signifierait que notre nombre serait un nombre a virgule et la fonction retournerait false
    return (isNumber(value) && value % 1 === 0);
}

// Avec cette fonction, on vérifie que la valeur passé en argument est bien un nombre
function isNumber(value) {
    /* if(!isNaN(value)) {
     return true;
     } else {
     return false
     }*/

     // La valeur est différente de is Not A Number donc valeur est un nombre
    return !isNaN(value);
}