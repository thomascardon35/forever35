"use strict"


var nav = $('.nav-header');


function onClickBtnDisplayNav(){
    //$('.nav-header').slideToggle(500);

    nav.toggleClass("width-nav"); // fait apparaitre/disparaitre la nav
    $('.fa-bars').toggleClass("rotate-nav-btn"); // rotation de l'icone ".fa-bars"

}


function onClickBodyRemoveNav(event){

    //Si le clic s'est produit en dehors du bouton et de la nav
    if(!$(event.target).closest('.div-nav-btn span, nav').length) {  
        
        nav.removeClass("width-nav"); // Alors on fait disparaitre la nav
        $('.fa-bars').removeClass("rotate-nav-btn"); // et on fait une rotation du bouton
    } 
};

/* var listReasons = $('#aloe-vera .reasons ol li');
listReasons.addClass('vis-hidden'); */

function onScrollDisplayReasons(){

    var firstReason   = $('#aloe-vera .reasons ol li:first-of-type');
    var secondReason  = $('#aloe-vera .reasons ol li:nth-of-type(2)');
    var thirdReason   = $('#aloe-vera .reasons ol li:nth-of-type(3)');
    var fourthReason  = $('#aloe-vera .reasons ol li:nth-of-type(4)');
    var fifthReason   = $('#aloe-vera .reasons ol li:nth-of-type(5)');
    var sixthReason   = $('#aloe-vera .reasons ol li:nth-of-type(6)');
    var seventhReason = $('#aloe-vera .reasons ol li:nth-of-type(7)');
    var eighthReason  = $('#aloe-vera .reasons ol li:nth-of-type(8)');
    var ninthReason   = $('#aloe-vera .reasons ol li:nth-of-type(9)');
    var tenthReason   = $('#aloe-vera .reasons ol li:nth-of-type(10)');
    

    var winMidlHght   = ($(window).height()) * 0.4; 
    //valeur en px qui représente 40% de la hauteur de la fenetre de l'utilisateur
    var reasonsTitleTop    = $(".reasons").offset().top;
    //valeur en px qui représente le haut de l'article ".reasons" par rapport au début de la page
    var reasonsTitleMidl   = reasonsTitleTop - winMidlHght;   
    //valeur en px qui indique le haut de l'article".reasons" soustrait de la valeur en px des 40% de la fenetre de l'utilisateur.

    var firstReasonTop = firstReason.offset().top;
    var firstReasonMidl= firstReasonTop - winMidlHght;

    var secondReasonTop = secondReason.offset().top;
    var secondReasonMidl= secondReasonTop - winMidlHght;   
    
    var thirdReasonTop = thirdReason.offset().top;
    var thirdReasonMidl= thirdReasonTop - winMidlHght;  

    var fourthReasonTop = fourthReason.offset().top;
    var fourthReasonMidl= fourthReasonTop - winMidlHght;

    var fifthReasonTop = fifthReason.offset().top;
    var fifthReasonMidl= fifthReasonTop - winMidlHght;

    var sixthReasonTop = sixthReason.offset().top;
    var sixthReasonMidl= sixthReasonTop - winMidlHght;

    var seventhReasonTop = seventhReason.offset().top;
    var seventhReasonMidl= seventhReasonTop - winMidlHght;

    var eighthReasonTop = eighthReason.offset().top;
    var eighthReasonMidl= eighthReasonTop - winMidlHght;

    var ninthReasonTop = ninthReason.offset().top;
    var ninthReasonMidl= ninthReasonTop - winMidlHght;

    var tenthReasonTop = tenthReason.offset().top;
    var tenthReasonMidl= tenthReasonTop - winMidlHght;

    if($(this).scrollTop() < reasonsTitleMidl){
        firstReason.removeClass('vis-visible');
    } else if($(this).scrollTop() < firstReasonMidl){
        firstReason.addClass('vis-visible');
        secondReason.removeClass('vis-visible');
    } else if($(this).scrollTop() < secondReasonMidl){
        secondReason.addClass('vis-visible');
        thirdReason.removeClass('vis-visible');
    }else if($(this).scrollTop() < thirdReasonMidl){
        thirdReason.addClass('vis-visible');
        fourthReason.removeClass('vis-visible');
    }else if($(this).scrollTop() < fourthReasonMidl){
        fourthReason.addClass('vis-visible');
        fifthReason.removeClass('vis-visible');
    }else if($(this).scrollTop() < fifthReasonMidl){
        fifthReason.addClass('vis-visible');
        sixthReason.removeClass('vis-visible');
    }else if($(this).scrollTop() < sixthReasonMidl){
        sixthReason.addClass('vis-visible');
        seventhReason.removeClass('vis-visible');
    }else if($(this).scrollTop() < seventhReasonMidl){
        seventhReason.addClass('vis-visible');
        eighthReason.removeClass('vis-visible');
    }else if($(this).scrollTop() < eighthReasonMidl){
        eighthReason.addClass('vis-visible');
        ninthReason.removeClass('vis-visible');
    }else if($(this).scrollTop() < ninthReasonMidl){
        ninthReason.addClass('vis-visible');
        tenthReason.removeClass('vis-visible');
    }else if($(this).scrollTop() < tenthReasonMidl){
        tenthReason.addClass('vis-visible');
    }
}


$(function(){
    $('.div-nav-btn span').click(onClickBtnDisplayNav); // Suite au clique sur le bouton on fait appel à la fonction onClickDisplayNav
    $(document).click(onClickBodyRemoveNav); // Suite au clique sur le document(sauf la nav et le bouton d'ouverture/fermeture de la nav), on fait appel à la fonction onClickBodyRemoveNav
    $(window).scroll(onScrollDisplayReasons); // Selon où on se situe sur la page : apparition/ disparition des 10 raisons de boire la pulpe d'Aloe Vera
});
