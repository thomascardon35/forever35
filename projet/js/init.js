"use strict";

function loadForm() {
    var form = $('#form');
    
    if(form.length > 0 ){
        var validator = new Validator(form);
        validator.init();
        
    }

}



$(function(){
/****************************************************************************************
*                                                                                       *
*                                ECOUTEURS D'EVENEMENTS                                 *
*                                                                                       *
****************************************************************************************/
    // Suite au clique sur le bouton de la nav on fait appel à la fonction onClickDisplayNav dans script.js
    $('.div-nav-btn span').click(onClickBtnDisplayNav); 
    // rotation des fleches à l'entrée et à la sortie de la souris
    $('#product .return button').mouseenter(addRotateArrowComm);
    $('#product .return button').mouseout(removeRotateArrowComm);
    $('#product .return a').mouseenter(addRotateArrowReturn);
    $('#product .return a').mouseout(removeRotateArrowReturn);

    // Appel aux fonctions concernées apres click sur écouteur d'événements
    $(".onclick-product").click(onClickLineProduct); 
    $(".onclick-event").click(onClickLineEvent); 
    $(".onclick-msg").click(onClickLineMessage); 
    $('.bg-slider').click(onClickNextEvent);
    $('.previous-page').click(onClickPreviousPage);

     // Suite au clique sur le document(sauf nav bouton de la nav), on fait appel à la fonction onClickBodyRemoveNav dans script.js
    $(document).click(onClickBodyRemoveNav);

    // écouteur d'evenement sur le scroll, appel de la fonction onScroll dans script.js
    $(window).scroll(onScroll); 

/****************************************************************************************
*                                                                                       *
*                        AFFICHAGE DES ERREURS SUR FORMULAIRE                           *
*                                                                                       *
****************************************************************************************/
    // permet l'affichage PHP des erreurs
    var errorMessage = $('.error-message');
    if (errorMessage.children('p').text().length > 0) {
        errorMessage.slideDown();
    }
    // fonction loadForm permet la vérification du formulaire avec appel au constructeur Validator dans validator.js
    loadForm();

/****************************************************************************************
*                                                                                       *
*                           "SLIDER" PROCHAINS EVENEMENTS                               *
*                                                                                       *
****************************************************************************************/
    // on récupère ici la valeur de l'input caché qui représente le nombre de news/events enregistrés en BDD
    var retrieve = $('#retrieve').val();
    // si le nombre de news/events est de 0 alors on cache la section qui a pour classe .next-event
    if(retrieve == null || retrieve == 0){
        $('.next-event').hide();
    // si le nombre de news/events est de 1 alors on la fait apparaitre/disparaitre
    }else if(retrieve == 1){
        setInterval( // avec un interval de 6 secondes entre chaque apparition de la news/events
            function(){
                // la news/events "remonte" (disparait) en 1 seconde
                $(".bg-slider p").slideUp(1000, function() {
                    // et elle redescend (apparait) en 1 seconde
                    $(this).slideDown(1000)
                });
            }, 6000
        );

    }else{ //sinon
        // on masque tous les news/events sauf le premier
        $('.bg-slider p:gt(0)').hide();

        setInterval( // avec un interval de 6 secondes entre chaque apparition d'une news/events
            function(){
                // la news/events en cours d'affichage "remonte" (disparait) en 1 seconde
                $(".bg-slider > :first-child").slideUp(1000, function() {
                    // et la prochaine news/events redescend (apparait) en 1 seconde
                    $(this).next('.bg-slider p').slideDown(1000).end().appendTo('.bg-slider')
                });
            }, 6000
        );
    }
});