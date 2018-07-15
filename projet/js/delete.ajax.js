"use strict";

//les mois écrits en français dans un tableau afin d'éviter le bug des mois écrits en anglais,
// malgré le " PDO::MYSQL_ATTR_INIT_COMMAND => "SET lc_time_names = 'fr_FR'" " indiqué dans databaseClass.php
var months = ["janvier","février","mars","avril","mai","juin","juillet","août","septembre","octobre","novembre","décembre"];

function ajaxDeleteMessage(messages){
    var index;
    // on vide le tableau '#tbody-message' du précédent affichage pour le mettre à jour
    $('#tbody-message').empty();
    //on boucle sur les messages
    for(index = 0; index < messages.length; index++){
        // on ajoute chaque message dans le tableau ,on reconstitue ici le html à réinsérer
        $('<tr>').append(
            '<td onclick=\'location.href="mymsgs?read_message=' + messages[index].id + '"\' data-id=' + messages[index].id + '>' + messages[index].sendingday + ' ' + months[(messages[index].sendingmonth) - 1]  + ' ' + messages[index].sendingyear + '</td>',
            '<td onclick=\'location.href="mymsgs?read_message=' + messages[index].id + '"\' data-id=' + messages[index].id + '>' + messages[index].sendingtime + '</td>',
            '<td onclick=\'location.href="mymsgs?read_message=' + messages[index].id + '"\' data-id=' + messages[index].id + ' class="hidden"> ' + messages[index].gender + '</td>',
            '<td onclick=\'location.href="mymsgs?read_message=' + messages[index].id + '"\' data-id=' + messages[index].id + '>' + messages[index].lastname.substring(0,10) + '</td>',
            '<td onclick=\'location.href="mymsgs?read_message=' + messages[index].id + '"\' data-id=' + messages[index].id + ' class="hidden"> ' + messages[index].firstname.substring(0,10) + '</td>',
            '<td onclick=\'location.href="mymsgs?read_message=' + messages[index].id + '"\' data-id=' + messages[index].id + ' class="hidden"> ' + messages[index].zipcode + '</td>',
            '<td onclick=\'location.href="mymsgs?read_message=' + messages[index].id + '"\' data-id=' + messages[index].id + ' class="hidden"> ' + messages[index].city.substring(0,17) + '</td>',
            '<td onclick=\'location.href="mymsgs?read_message=' + messages[index].id + '"\' data-id=' + messages[index].id + '>' + messages[index].subjectmessage  + '</td>',
            '<td onclick=\'location.href="mymsgs?read_message=' + messages[index].id + '"\' data-id=' + messages[index].id + ' class="hidden"> ' + messages[index].usermessage.substring(0,20) + '</td>',
            '<td  class="hidden"><a class="remove" data-choice="message" data-remove="' + messages[index].id + '" href="admin?delete_message=' + messages[index].id + '" ><i class="fa fa-trash"></i></a></td> '

        ).appendTo('#tbody-message'); // et qu'on ajoute apres #tbody-message
    }
    
    // pour redire a jQuery qu'un écouteur d'événement existe sur '.remove'
    // sinon celui-ci disparait !! 
    $(".remove").on('click', onClickExecute); 

}


function ajaxDeleteEvent(events){
console.log(events);
    var index;
    var month;

    // on vide le tableau '#tbody-event' du précédent affichage pour le mettre à jour
    $('#tbody-event').empty();
    //on boucle sur les evenements
    for(index = 0; index < events.length; index++){
        // Dans ces if, on indique que si la valeur vaut null on souhaite afficher à l'écran une chaine de caractères vide plutot que le mot null
        if(events[index].eventday == null){
            events[index].eventday = ""
        };
        if(events[index].eventmonth == null){
            month = ""
        }else{
            month = months[(events[index].eventmonth) - 1];
        }; 
        if(events[index].eventyear == null){
            events[index].eventyear = ""
        };
        if(events[index].eventtime == null){
            events[index].eventtime = ""
        };
        if(events[index].endtime == null){
            events[index].endtime = ""
        };
        // on ajoute chaque message dans le tableau ,on reconstitue ici le html à réinsérer
        $('<tr>').append(
            '<td onclick=\'location.href="myevents?update_event=' + events[index].id + '"\' >' + events[index].eventday + ' ' +  month + ' ' + events[index].eventyear + '</td>',
            '<td onclick=\'location.href="myevents?update_event=' + events[index].id + '"\' class="hidden">' + events[index].eventtime + '</td>',
            '<td onclick=\'location.href="myevents?update_event=' + events[index].id + '"\' class="hidden">' + events[index].endtime + '</td>',
            '<td onclick=\'location.href="myevents?update_event=' + events[index].id + '"\' >' + events[index].city.substring(0,15) + '</td>',
            '<td onclick=\'location.href="myevents?update_event=' + events[index].id + '"\' >' + events[index].eventtype.substring(0,15) + '</td>',
            '<td onclick=\'location.href="myevents?update_event=' + events[index].id + '"\' >' + events[index].eventdescription.substring(0,30) + '</td>',
            '<td class="hidden"><div><a data-action="update" href="myevents?update_event=' + events[index].id + '"><i class="fa fa-edit"></i></a><a class="remove" data-choice="event" data-remove="' + events[index].id + '" href="admin?delete_event=' + events[index].id + '"><i class="fa fa-trash"></i></a></div></td>'

        ).appendTo('#tbody-event'); // et qu'on ajoute apres #tbody-event
    }
    // pour redire a jQuery qu'un écouteur d'événement existe sur '.remove'
    // sinon celui-ci disparait !! 
    $(".remove").on('click', onClickExecute); 

}

function ajaxDeleteProduct(products){

    var index;
    // on vide le tableau '#tbody-product' du précédent affichage pour le mettre à jour
    $('#tbody-product').empty();
    //on boucle sur les evenements
    for(index = 0; index < products.length; index++){
        $('<tr>').append(
            '<td onclick=\'location.href="myproducts?update_product=' + products[index].id + '"\' >' + products[index].ref + '</td>',
            '<td onclick=\'location.href="myproducts?update_product=' + products[index].id + '"\' >' + products[index].category + '</td>',
            '<td onclick=\'location.href="myproducts?update_product=' + products[index].id + '"\' >' + products[index].title + '</td>',
            '<td><a href="myproducts?update_product=' + products[index].id + '"><i class="fa fa-edit"></i></a><a class="remove" data-choice="product" data-remove="' + products[index].id + '" href="admin?delete_product=' + products[index].id + '"><i class="fa fa-trash"></i></a></td>'
        ).appendTo('#tbody-product');// et qu'on ajoute apres #tbody-product
    };
    // pour redire a jQuery qu'un écouteur d'événement existe sur '.remove'
    // sinon celui-ci disparait !! 
    $(".remove").on('click', onClickExecute); 

}

function ajaxDeleteComm(comm){

    var index;
    console.log(comm);

    $('#comments').empty();

    for(index = 0; index < comm.length; index++){
        $('<li>').append(
            '<p>Commentaire laissé par : </p>',
            '<p><a href="mailto:' + comm[index].email + '">' + comm[index].pseudo + '</a></p>' ,
            '<p>Le ' + comm[index].reformeddate + ' à  ' + comm[index].reformedhour + '</p>' ,
            '<p>Avis sur le produit : <span class="satisfaction">' + comm[index].satisfaction + '</span></p>' ,
            '<p>Commentaire : <span>'+ comm[index].usercomment + '</span></p>',
            '<input type="hidden" name="id" value="' + comm[index].id + '">',
            '<input type="hidden" name="refproduct" value="' + comm[index].refproduct + '">',
            '<input class="del-comm-btn remove" type="submit" name="delete_comm" value="Supprimer ce commentaire" data-remove="' + comm[index].id + '" data-choice="comm" data-ref="' + comm[index].refproduct + '">'
        ).appendTo('#comments');

    };

    $(".remove").on('click', onClickExecute); 
}


function onClickExecute(event){

    event.preventDefault();
    
    // on récupère dans la data-remove le numéro de l'id du message
    var data = $(this).data("remove");

    var refproduct = $(this).data("ref");

    // on récupère dans la data-choice pour le bonchoix dans le switch
    var trashChoice = $(this).data("choice");

    switch(trashChoice){

        case 'message':
        // on veut récupérer des données JSON 
        $.getJSON(
            // l'url à laquelle on fait appel avec query string et numéro l'id du message récupéré plus haut
            // pour supprimer le message
            'controllers/delete.ajax.php?delete_message=' + data,
            // En cas de succès on appelle la fonction ajaxDeleteMessage
            ajaxDeleteMessage);

        break;

        case 'event' : 

        $.getJSON(
            // l'url à laquelle on fait appel avec query string et numéro l'id de l'evenement récupéré plus haut
            // pour supprimer l'evenement
            'controllers/delete.ajax.php?delete_event=' + data,
            // En cas de succès on appelle la fonction ajaxDeleteEvent
            ajaxDeleteEvent);

        break;

        case 'product' : 

        $.getJSON(
            // l'url à laquelle on fait appel avec query string et numéro l'id du produit récupéré plus haut
            // pour supprimer le produit
            'controllers/delete.ajax.php?delete_product=' + data,
            // En cas de succès on appelle la fonction ajaxDeleteProduct
            ajaxDeleteProduct);

        break;

        case 'comm' : 

        $.getJSON(
            // l'url à laquelle on fait appel avec query string et numéro l'id du produit récupéré plus haut
            // pour supprimer le produit
            'controllers/delete.ajax.php?delete_comm=' + data + '&refproduct=' + refproduct,
            // En cas de succès on appelle la fonction ajaxDeleteProduct
            ajaxDeleteComm);

        break;

    };
};


$(function(){

    $(".remove").on('click', onClickExecute); 

      
});