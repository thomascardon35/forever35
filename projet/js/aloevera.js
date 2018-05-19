"use strict";

$(window).scroll(function(){ 
    var reasons;
    var winHghtPctage;
    var index;
    var windowTop;
    var reasonsHeight;
    var reason;

    reasons = [
        $(".reasons"),
        $('#aloe-vera .reasons ol li:first-of-type'),
        $('#aloe-vera .reasons ol li:nth-of-type(2)'),
        $('#aloe-vera .reasons ol li:nth-of-type(3)'),
        $('#aloe-vera .reasons ol li:nth-of-type(4)'),
        $('#aloe-vera .reasons ol li:nth-of-type(5)'),
        $('#aloe-vera .reasons ol li:nth-of-type(6)'),
        $('#aloe-vera .reasons ol li:nth-of-type(7)'),
        $('#aloe-vera .reasons ol li:nth-of-type(8)'),
        $('#aloe-vera .reasons ol li:nth-of-type(9)'),
        $('#aloe-vera .reasons ol li:nth-of-type(10)')
    ];


    //Ici, en fonction de la hauteur de l'écran utilisateur on modifie la valeur que l'on va soustraire afin de faire apparaitre/disparaitre les éléments sur la page.
    if (window.matchMedia("(max-height: 950px)").matches){
        winHghtPctage   = ($(window).height()) * .37; 
    } else if(window.matchMedia("(max-height: 1200px)").matches){
        winHghtPctage   = ($(window).height()) * .5; 
    } else if(window.matchMedia("(max-height: 1720px)").matches){
        winHghtPctage   = ($(window).height()) * .65; 
    } else if(window.matchMedia("(max-height: 100000px)").matches){
        for ( index = 0; index < reasons.length; index++) { 
            reasons[index].addClass('vis-visible');
        };
        return;
    };


    // Récupération de la difference entre le haut de la fenetre et 
    // le haut du document en px (valeur changeante en fonction du scroll)
    windowTop = $(this).scrollTop();

    // on crée un tableau vide dans lequel on stockera les valeurs
    reasonsHeight=[];

    //on boucle sur le tableau du titre + "les 10 raisons"
    for (index = 0; index < reasons.length; index++) {
        reason= reasons[index];
        // on enregistre dans le tableau vide les 11 nouvelles valeurs en px 
        // qui représentent chacune la difference entre le haut de l'élément
        // et le haut du document - winHghtPctage
        reasonsHeight.push(reason.offset().top - winHghtPctage);
    };

    // Si on est en haut du document alors disparition des "10 raisons"
    // (Permet d'éviter le bug lorsqu'on clique sur la flèche de remontée du document)
    if(windowTop == 0){
        for (index = 0; index < reasons.length; index++){
            reasons[index].removeClass('vis-visible');
        };
    };

    // Selon où on se situe sur la page : apparition/ disparition des 10 raisons de boire la pulpe d'Aloe Vera
    if(windowTop < reasonsHeight[0]){
        reasons[1].removeClass('vis-visible');
    } else if(windowTop < reasonsHeight[1]){
        reasons[1].addClass('vis-visible');
        reasons[2].removeClass('vis-visible');
    } else if(windowTop < reasonsHeight[2]){
        reasons[2].addClass('vis-visible');
        reasons[3].removeClass('vis-visible');
    }else if(windowTop < reasonsHeight[3]){
        reasons[3].addClass('vis-visible');
        reasons[4].removeClass('vis-visible');
    }else if(windowTop < reasonsHeight[4]){
        reasons[4].addClass('vis-visible');
        reasons[5].removeClass('vis-visible');
    }else if(windowTop < reasonsHeight[5]){
        reasons[5].addClass('vis-visible');
        reasons[6].removeClass('vis-visible');
    }else if(windowTop < reasonsHeight[6]){
        reasons[6].addClass('vis-visible');
        reasons[7].removeClass('vis-visible');
    }else if(windowTop < reasonsHeight[7]){
        reasons[7].addClass('vis-visible');
        reasons[8].removeClass('vis-visible');
    }else if(windowTop < reasonsHeight[8]){
        reasons[8].addClass('vis-visible');
        reasons[9].removeClass('vis-visible');
    }else if(windowTop < reasonsHeight[9]){
        reasons[9].addClass('vis-visible');
        reasons[10].removeClass('vis-visible');
    }else if(windowTop < reasonsHeight[10]){
        reasons[10].addClass('vis-visible');
    };


    /*     var reasonsTitle  = $(".reasons");
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

    var reasonsTitleTop    = $(".reasons").offset().top;
    //valeur en px qui représente le haut de l'article ".reasons" par rapport au début de la page
    var reasonsTitleMidl   = reasonsTitleTop - winHghtPctage;   
    //valeur en px qui indique le haut de l'article".reasons" soustrait de la valeur en px des 40% de la fenetre de l'utilisateur.

    var firstReasonTop = firstReason.offset().top;
    var firstReasonMidl= firstReasonTop - winHghtPctage;

    var secondReasonTop = secondReason.offset().top;
    var secondReasonMidl= secondReasonTop - winHghtPctage;   

    var thirdReasonTop = thirdReason.offset().top;
    var thirdReasonMidl= thirdReasonTop - winHghtPctage;  

    var fourthReasonTop = fourthReason.offset().top;
    var fourthReasonMidl= fourthReasonTop - winHghtPctage;

    var fifthReasonTop = fifthReason.offset().top;
    var fifthReasonMidl= fifthReasonTop - winHghtPctage;

    var sixthReasonTop = sixthReason.offset().top;
    var sixthReasonMidl= sixthReasonTop - winHghtPctage;

    var seventhReasonTop = seventhReason.offset().top;
    var seventhReasonMidl= seventhReasonTop - winHghtPctage;

    var eighthReasonTop = eighthReason.offset().top;
    var eighthReasonMidl= eighthReasonTop - winHghtPctage;

    var ninthReasonTop = ninthReason.offset().top;
    var ninthReasonMidl= ninthReasonTop - winHghtPctage;

    var tenthReasonTop = tenthReason.offset().top;
    var tenthReasonMidl= tenthReasonTop - winHghtPctage;

    */
});