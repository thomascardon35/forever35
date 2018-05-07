"use strict"

function onClickBtnDisplayNav(){
    //$('.nav-header').slideToggle(500);
    $('.nav-header').toggleClass("width-nav"); // fait apparaitre/disparaitre la nav
    $('.fa-bars').toggleClass("rotate-nav-btn"); // rotation de l'icone ".fa-bars"
}


function onClickBodyRemoveNav(event){
    //Si le clic s'est produit en dehors du bouton et de la nav
    if(!$(event.target).closest('.div-nav-btn span').length) {  

        $('.nav-header').removeClass("width-nav"); // Alors on fait disparaitre la nav
        $('.fa-bars').removeClass("rotate-nav-btn"); // et on fait une rotation du bouton
    } 
};



function onScroll(){
    var bubble4 = $(#bubble4);
    var bubble5 = $('#bubble5');

    var scrolltop = window.pageYOffset // get number of pixels document has scrolled vertically
    bubble4.style.top = -scrolltop * .2 + 'px' // move bubble1 at 20% of scroll rate
    bubble5.style.top = -scrolltop * .5 + 'px'

    // On stocke dans une variable la position verticale en px
    var windowTop = $(this).scrollTop();

    // Calcul de la hauteur maximum qu'un point fixe peut parcourir verticalement 
    var height = $(document).height()-$(window).height();
    // Récupération de la largeur de la fenêtre
    var width = $(window).width();
    // Calcul de la largeur de la barre		
    var bar = windowTop / height * width;
    
    // Modification du css en fonction de la position sur la page	
    $("#progressbar").css("width",bar);


    // si le haut de la fenetre atteint la hauteur du header + 200px alors
    if(windowTop > $('header').height()+200){  
        $('main .arrow-up').removeClass('hidden');  // on fait apparaitre la fleche qui remonte en haut
        $('.nav-header').removeClass("width-nav");  // on fait disparaitre la nav
        $('.fa-bars').removeClass("rotate-nav-btn");  // et on fait une rotation du bouton
    }else{
        $('main .arrow-up').addClass('hidden')  // sinon on fait disparaitre la fleche
    }
}

/* function onClickDescription(event){
    event.preventDefault();
    $('.description').toggleClass("hidden");
} */