"use strict";


var Validator = function (form){
    this.form = form;  // le formulaire passé en argument devient une propriété de Validator
    this.errors=[];    // on crée une propriété errors : un tableau vide pour y stocker les éventuelles erreurs
    this.errorMessage = $('.error-message'); // La propriété errorMessage représente le message d'erreur lui meme (CSS HTML)
    this.errorFields = [];
}


Validator.prototype.requiredField = function () {
    // on récupère les champs ayant commen attribut data-required
    var requiredFields = this.form.find('[data-required]');

    // on boucle sur tous les éléments trouvés
    for (var index = 0; index < requiredFields.length; index++) {
        var requiredField = $(requiredFields[index]);

        // si le champ est vide
        if (requiredField.val() === '') {

            var requiredName = $(requiredFields[index]).data('name');// on récupère ici le nom du champ afin d'apporter une meilleure information à l'utilisateur
            this.errors.push('Le champ ' + requiredName + ' est requis');//On insère l'erreur dans le tableau prévu pour ça
            this.errorFields.push(requiredField); // on enregistre le champ fautif dans le tableau prévu à cet effet
        }
    }

};

Validator.prototype.fieldType = function () {
    // on récupère les champs ayant comme attribut data-required
    var fieldTypes = this.form.find('[data-type]');

    // boucle sur tous les éléments concernés
    for (var index = 0; index < fieldTypes.length; index++) {
        var fieldType = $(fieldTypes[index]);
        var type = fieldType.data('type');
        var value = fieldType.val();
        var fieldName = $(fieldTypes[index]).data('name');

        if (value === "")
            continue;

        switch (type) {
            case 'email':
                if (value.match(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/) === null) {
                    this.errors.push('le champ ' + fieldName + ' doit être un E-mail valide');
                    this.errorFields.push(fieldType); // on enregistre le champ fautif dans le tableau prévu à cet effet
                }
                break;
                
            case 'positiveInteger':
                if (!isInteger(value) || value < 0) {
                    this.errors.push('le champ ' + fieldName + ' doit être un entier positif');
                    this.errorFields.push(fieldType); // on enregistre le champ fautif dans le tableau prévu à cet effet
                }
                break;

            case 'alphanum':
                if (value.match(/^[\w\s'-]+$/) === null) {
                    this.errors.push('le champ ' + fieldName + ' doit être composé de caractère alphanumériques');
                    this.errorFields.push(fieldType); // on enregistre le champ fautif dans le tableau prévu à cet effet
                }
                break;

        }
    }
};


Validator.prototype.miniLength = function(){
    // on récupère les champs ayant commen attribut data-min
    var dataMins = this.form.find('[data-min]');

    // on boucle sur tous les éléments trouvés
    for(var index = 0 ; index < dataMins.length; index++){
        var dataMin = $(dataMins[index]); //on stocke le champ, en cours dans la boucle, dans dataMin
        var minLength = $(dataMins[index]).data('min'); //on stocke la valeur de data-min du champ, en cours dans la boucle

        // Si la valeur du champ est différent de vide ET inférieur au minimum requis
        if(dataMin.val() !== "" && dataMin.val().length < minLength ){
            var dataMinName = dataMin.data('name'); // on récupère ici le nom du champ afin d'apporter une meilleure information à l'utilisateur
            this.errors.push('Le champ ' + dataMinName + ' doit contenir au minimum ' + minLength + ' caractères.'); //On insère l'erreur dans le tableau prévu pour ça
            this.errorFields.push(dataMin); // on enregistre le champ fautif dans le tableau prévu à cet effet
        }

    }
};


Validator.prototype.maxiLength = function() {
    // on récupère les champs ayant commen attribut data-max
    var dataMaxs = this.form.find('[data-max]');

    // on boucle sur tous les éléments trouvés
    for(var index = 0 ; index < dataMaxs.length; index++){
        var dataMax = $(dataMaxs[index]); //on stocke le champ, en cours dans la boucle, dans dataMax
        var maxiLength = $(dataMaxs[index]).data('max'); //on stocke la valeur de data-max du champ, en cours dans la boucle

        // Si la valeur du champ est différent de vide ET supérieur au minimum requis
        if(dataMax.val() !== "" && dataMax.val().length > maxiLength ){
            var dataMaxName = dataMax.data('name'); // on récupère ici le nom du champ afin d'apporter une meilleure information à l'utilisateur
            this.errors.push('Le champ ' + dataMaxName + ' doit contenir au maximum ' + maxiLength + ' caractères.'); //On insère l'erreur dans le tableau prévu pour ça
            this.errorFields.push(dataMax); // on enregistre le champ fautif dans le tableau prévu à cet effet
        }
    } 
};


Validator.prototype.submitForm = function (event) {

    // cette boucle for remet la couleur de fond initiale des input, select et textarea du formulaire (en cas d'erreur précédente).
    for(var index=0 ; index < (this.errorFields).length ; index++){
        var errorField = this.errorFields[index];
        errorField.removeClass('error-field');
    }

     // on remet les tableaux vide pour remettre à 0 les eventuelles précédentes erreurs
    this.errors = [];
    this.errorFields = [];

    // on lance les propriétés afin de vérfier les champs de formulaire
    this.miniLength();
    this.maxiLength();
    this.requiredField();
    this.fieldType();


    // s'il y a des erreurs, on l'indique à l'utilisateur
    if (this.errors.length > 0) {
        event.preventDefault(); // on n'empeche l'envoi du formulaire

        document.location.href="contact.php#form"; // on redirige vers le haut du formulaire pour indiquer les erreurs

        var ul = $('<ul>'); // on crée une balise html <ul> qu'on stocke dans une variable

        $(this.errors).each(function () {   // pour chaque erreur
            ul.append($('<li>').text(this)) // on rajoute au "ul" , un "li" contenant le texte de cette erreur
            
        });

        // on boucle sur les champs de formulaire ou il y a une erreur
        for(var index=0 ; index < (this.errorFields).length ; index++){
            var errorField = this.errorFields[index];

            // et on leur ajoute la classe qui rend la couleur de fond rouge qui apporte une information visuelle a l'utilisateur
            errorField.addClass('error-field');
        }

        this.errorMessage.empty().append(ul).slideDown();
    }
};


Validator.prototype.init = function(){

    // Lorsque le formulaire est soumis, on fait appel a submitForm pour la verification des champs de formulaire
    // Ici bind(this) permet d'indiquer à submitForm qu'il ne doit pas prendre this.form mais bien Validator
    this.form.submit(this.submitForm.bind(this));

}