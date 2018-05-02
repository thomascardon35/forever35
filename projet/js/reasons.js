"use strict"

var listReasons = $('#aloe-vera .reasons ol li');

listReasons.addClass('vis-hidden');

var winMidlHght = ($(window).height()) * 0.45;  //valeur en px qui représente 45% de la hauteur de la fenetre de l'utilisateur
var reasonsTop = $(".reasons").offset().top;  //valeur en px qui représente le haut de l'article ".reasons" par rapport au haut de la page
var reasonsMidl = reasonsTop - winMidlHght;   //valeur en px qui indique que le haut de l'article".reasons" atteint 45% de la fenetre.




function onScrollDisplayReasons(){
    if($(this).scrollTop()> reasonsMidl){
        $('#aloe-vera .reasons ol li:first-of-type').removeClass('vis-hidden').fadeIn(500);
    }else{
        $('#aloe-vera .reasons ol li:first-of-type').addClass('vis-hidden').fadeOut(500);
        
    }
}

/* 


var secondReason  = $('#aloe-vera .reasons ol li:nth-of-type(2)');
var thirdReason   = $('#aloe-vera .reasons ol li:nth-of-type(3)');
var fourthReason  = $('#aloe-vera .reasons ol li:nth-of-type(4)');
var fifthReason   = $('#aloe-vera .reasons ol li:nth-of-type(5)');
var sixthReason   = $('#aloe-vera .reasons ol li:nth-of-type(6)');
var seventhReason = $('#aloe-vera .reasons ol li:nth-of-type(7)');
var eighthReason  = $('#aloe-vera .reasons ol li:nth-of-type(8)');
var ninthReason   = $('#aloe-vera .reasons ol li:nth-of-type(9)');
var tenthReason   = $('#aloe-vera .reasons ol li:nth-of-type(10)');

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

if($(this).scrollTop()> firstReasonMidl){
    secondReason.fadeIn(500);        
    if($(this).scrollTop()> secondReasonMidl){
        thirdReason.fadeIn(500);        
        if($(this).scrollTop()> thirdReasonMidl){
            fourthReason.fadeIn(500);        
            if($(this).scrollTop()> fourthReasonMidl){
                fifthReason.fadeIn(500);        
                if($(this).scrollTop()> fifthReasonMidl){
                    sixthReason.fadeIn(500);        
                    if($(this).scrollTop()> sixthReasonMidl){
                        seventhReason.fadeIn(500);        
                        if($(this).scrollTop()> seventhReasonMidl){
                            eighthReason.fadeIn(500);        
                            if($(this).scrollTop()> eighthReasonMidl){
                                ninthReason.fadeIn(500);        
                                if($(this).scrollTop()> ninthReasonMidl){
                                    tenthReason.fadeIn(500);
                                }else{
                                    tenthReason.fadeOut(500);
                                }
                                
                            }else{
                                ninthReason.fadeOut(500);
                            }
                        }else{
                            eighthReason.fadeOut(500);
                        }
                    }else{
                        seventhReason.fadeOut(500);
                    }
                }else{
                    sixthReason.fadeOut(500);
                }
            }else{
                fifthReason.fadeOut(500);
            }
        }else{
            fourthReason.fadeOut(500);
        }
    }else{
        thirdReason.fadeOut(500);
    }
}else{
    secondReason.fadeOut(500);
} */