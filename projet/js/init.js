"use strict";

$(function(){
    // Suite au clique sur le bouton de la nav on fait appel à la fonction onClickDisplayNav
    $('.div-nav-btn span').click(onClickBtnDisplayNav); 
     // Suite au clique sur le document(sauf nav bouton de la nav), on fait appel à la fonction onClickBodyRemoveNav
    $(document).click(onClickBodyRemoveNav);
    // écouteur d'evenement sur le scroll
    $(window).scroll(onScroll); 
    

    /* $('#products a').click(onClickDescription); */
});