"use strict";



function loadForm() {
    var form = $('#contact form');
    
    if(form.length > 0 ){
        var validator = new Validator(form);
        validator.init();
        
    }

}





$(function(){


    var errorMessage = $('.error-message');
    if (errorMessage.children('p').text().length > 0) {
        errorMessage.slideDown();
    }

    loadForm();


});