"use strict";

/*******************************************************************************
*                                                                              *
*                                    NAV                                       *
*                                                                              *
*******************************************************************************/

function onClickBtnDisplayNav(){
    //$('.nav-header').slideToggle(500);
    $('.nav-header').toggleClass("width-nav"); // fait apparaitre/disparaitre la nav
    $('.fa-bars').toggleClass("rotate-nav-btn"); // rotation de l'icone ".fa-bars"
};


function onClickBodyRemoveNav(event){
    //Si le clic s'est produit en dehors du bouton et de la nav
    if(!$(event.target).closest('.div-nav-btn span').length) {  

        $('.nav-header').removeClass("width-nav"); // Alors on fait disparaitre la nav
        $('.fa-bars').removeClass("rotate-nav-btn"); // et on fait une rotation du bouton
    };
};

/* function onClickDescription(event){
    event.preventDefault();
    $('.description').toggleClass("hidden");
} */


function onScroll(){

    // On stocke dans une variable la position verticale en px
    var windowTop = $(this).scrollTop();

/*******************************************************************************
*                                                                              *
*                        Background Animé Bulles                               *
*                                                                              *
*******************************************************************************/
    //si la largeur de l'écran utilisateur égale ou dépasse les 1025px(comme le mediaquerry) alors on anime les bulles en fond d'écran
    if (window.matchMedia("(min-width: 1025px)").matches){
        $('#bubble0').css('top', windowTop * 1.25 + 'px'); 
        $('#bubble1').css('top', windowTop * .15 + 'px'); 
        $('#bubble2').css('top', -windowTop * .1 + 'px'); 
        $('#bubble3').css('top', -windowTop * .25 + 'px');
        $('#bubble4').css('top', -windowTop * .15 + 'px');
        $('#bubble5').css('top', -windowTop * .35 + 'px');
        $('#bubble6').css('top', windowTop * .25 + 'px');
        $('#bubble7').css('top',windowTop * .05 + 'px');
        $('#bubble8').css('top', -windowTop * .05 + 'px'); 
        $('#bubble9').css('top', windowTop * .2 + 'px'); 
    };
/*******************************************************************************
*                                                                              *
*                     Barre de Progression en haut du site                     *
*                                                                              *
*******************************************************************************/

    // Calcul de la hauteur maximum qu'un point fixe peut parcourir verticalement 
    var height = $(document).height()-$(window).height();
    // Récupération de la largeur de la fenêtre
    var width = $(window).width();
    // Calcul de la largeur de la barre		
    var bar = windowTop / height * width;
    // Modification du css en fonction de la position sur la page	
    $("#progressbar").css("width",bar);

/*******************************************************************************
*                                                                              *
*      Affichage Nav et Fleche de remontée du doc en fonction du scroll        *
*                                                                              *
*******************************************************************************/

    // si le haut de la fenetre atteint la hauteur du header + 200px alors
    if(windowTop > $('header').height()+200){  
        $('main .arrow-up').removeClass('hidden');  // on fait apparaitre la fleche de remontée du document
        $('.nav-header').removeClass("width-nav");  // on fait disparaitre la nav
        $('.fa-bars').removeClass("rotate-nav-btn");  // et on fait une rotation du bouton
    }else{
        $('main .arrow-up').addClass('hidden');  // sinon on fait disparaitre la fleche de remontée du document
    };
};