"use strict";


function ajaxGetJsonData(datas){

    var index;
    // en cas de succès on montre la div #comments-title
    $("#comments-title").show();    

    // on montre la bouton 'Masquer les commentaires" 
    $('#hideComments').show();

    // on cache le bouton ' Voir les commentaires'
    $('#showComments').hide();

    // on montre le paragraphe #target dans lequel est affiché tous les commentaires
    // ( Dans le cas où il aurait été caché avec le bouton 'Masquer les commentaires')
    $('#target').show();

    // on vide le paragraphe #target d'un éventuel précédent affichage et on lui ajoute un <ul>
    $('#target').empty().append('<ul class="comments">');

    // On boucle sur les commentaires
    for(index = 0; index < datas.length; index++){

        // et on ajoute au <li> le commentaire en cours dans la boucle
        $('<li>').append(
            '<p>Commentaire laissé par : </p>',
            '<p><span class="pseudo">' + datas[index].pseudo + '</span></p>' ,
            '<p>Le ' + datas[index].reformeddate + ' à ' + datas[index].reformedhour + '</p>' ,
            '<p>Avis sur le produit : <span class="satisfaction">' + datas[index].satisfaction + '</span></p>' ,
            '<p>Commentaire : <span>'+ datas[index].usercomment + '</span></p>'
        ).appendTo('#target ul'); // qu'on ajoute à la suite du < ul > pour former la liste de commentaire
        
    }
}

$(function(){
    // au lancement de la page, on cache la div des commentaires
    $("#comments-title").hide();
    // ainsi que le bouton 'Masquer les commentaires" 
    $('#hideComments').hide();

    // écouteur d'evenement sur le click du bouton 'Voir les commentaires'
    $("#showComments").on('click', function(){
        // on récupère dans la data-comments le numéro de référence du produit
        var data = $(this).data("comments");

        // on veut récupérer des données JSON 
        $.getJSON(
            // l'url à laquelle on fait appel avec query string et numéro de ref du produit
            'controllers/read_com.ajax.php?read_comments=' + data,
            // En cas de succès on appelle la fonction ajaxGetJsonData
            ajaxGetJsonData
        );
    });

    // écouteur d'evenement sur le click du bouton 'Masquer les commentaires'
    $("#hideComments").on('click', function(){

        // Ici on masque le bouton 'Masquer les commentaires'
        $('#hideComments').hide();

        // Ici on masque la div avec titre et référence
        $("#comments-title").hide();

        // Ici on vide le paragraphe avec les commentaires
        $('#target').empty();

        //Et on remontre le bouton 'Voir les commentaires'
        $('#showComments').show();

    });

});