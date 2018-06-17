"use strict";


function loadForm() {
    var form = $('#contact form');
    
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
});