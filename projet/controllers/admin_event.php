<?php
session_start();

if (isset($_SESSION['login'])){//On vérifie que le variable existe.
    $login=$_SESSION['login'];//On récupère la valeur de la variable de session.
}else{
    $login=0;//Si $_SESSION['connect'] n'existe pas, on donne la valeur "0".
}


if ($login == "1"){ // Si le visiteur s'est identifié,on affiche la page

    require_once '../models/newsEventsModel.php';
    require_once '../models/errorModel.php';

    // on instancie le modèle NewsEvents
    $newsEventsModel = new NewsEvents;
    $errorModel      = new ErrorModel;

    //après le clique sur le btn Ajouter l'événement OU Modifier l'événement
    if(array_key_exists('addEvent', $_POST) || array_key_exists('updateEvent', $_POST)){

        //on récupère les champs tels qu'indiqués par l'admin
        $day                = intval($_POST['day']);
        $month              = intval($_POST['month']);
        $year               = intval($_POST['year']);
        $appointementHour   = $_POST['appointementhour'];
        $appointementMinutes= $_POST['appointementminutes'];
        $endTimeHour        = $_POST['endtimehour'];
        $endTimeMinutes     = $_POST['endtimeminutes'];
        $city               = htmlspecialchars(trim($_POST['city']));
        $eventType          = htmlspecialchars(trim($_POST['eventtype']));
        $eventDescription   = htmlspecialchars(trim($_POST['eventdescription']));
        
        try{
            // si tous les champs sont vides
            if((empty($day) && empty($month) && empty($year) && empty($appointementHour) && empty($appointementMinutes) && empty($endTimeHour) && empty($endTimeMinutes) && empty($city) && empty($eventType) && empty($eventDescription)))
            // alors on affiche ce message d'erreur
            throw new DomainException("Tous les champs sont vides");

            // si le champ jour est rempli MAIS PAS le champ mois OU heure de RDV OU ville OU type d'événement
            if(!empty($day) && (empty($month) || empty($appointementHour) || empty($city) || empty($eventType))  ||

            // OU si le champ mois est rempli MAIS PAS le champ jour OU heure de RDV OU ville OU type d'événement
            (!empty($month) && (empty($day) || empty($appointementHour) || empty($city) || empty($eventType)) ) ||

            // OU si le champ heure de RDV est rempli MAIS PAS le champ mois OU jour OU ville OU type d'événement
            (!empty($appointementHour) && (empty($month) || empty($day) || empty($city) || empty($eventType)) ) ||

            // OU si le champ ville est rempli MAIS PAS le champ mois OU heure de RDV OU jour OU type d'événement
            (!empty($city) && (empty($month) || empty($appointementHour) || empty($day) || empty($eventType)) ) ||

            // OU si le champ type d'événement est rempli MAIS PAS le champ mois OU heure de RDV OU ville OU jour
            (!empty($eventType) && (empty($month) || empty($appointementHour) || empty($city) || empty($day)) ) ||

            // OU si le champ minutes du RDV est rempli MAIS PAS le champ jour OU le champ mois OU heure de RDV OU ville OU type d'événement
            (!empty($appointementMinutes) && (empty($day) || empty($month) || empty($appointementHour) || empty($city) || empty($eventType)) ) ||  

            // OU si le champ année est rempli MAIS PAS le champ jour OU le champ mois OU heure de RDV OU ville OU type d'événement
            (!empty($year) && (empty($day) || empty($month) || empty($appointementHour) || empty($city) || empty($eventType)) ) ||

            // OU si le champ heure de fin du RDV est rempli MAIS PAS le champ jour OU le champ mois OU heure de RDV OU ville OU type d'événement
            (!empty($endTimeHour) && (empty($day) || empty($month) || empty($appointementHour) || empty($city) || empty($eventType)) ) ||

            // OU si le champ minutes de fin du RDV est rempli MAIS PAS le champ jour OU le champ mois OU heure de RDV OU ville OU type d'événement
            (!empty($endTimeMinutes) && (empty($day) || empty($month) || empty($appointementHour) || empty($city) || empty($eventType)) ))

            // alors on affiche ce message d'erreur
            throw new DomainException("L'événement n'est pas complet. </br> Les champs Heure de fin,Minutes et Année ne sont pas obligatoires. </br> Le champ Description n'est pas obligatoire mais il peut être rempli seul.");
        
            // Si le champ minutes de fin est rempli MAIS PAS heure de fin 
            if(!empty($endTimeMinutes) && empty($endTimeHour))

            // alors on affiche ce message d'erreur
            throw new DomainException("Vous avez rempli le champ minutes de la fin d'événement.</br>Pensez à préciser l'heure !");

            if(strlen($city) > 64)
            throw new DomainException("La Ville ne peut pas contenir plus de 64 caractères.");
            if(strlen($eventType) > 64)
            throw new DomainException("Le type d'événement ne peut pas contenir plus de 64 caractères.");
            if(strlen($eventDescription) > 512)
            throw new DomainException("La description de l'événement dépasse la limite de 512 caractères.");

            //Si le champ minutes d'heure de RDV est vide alors le champ vaut 00
            if($appointementMinutes == null){
                $appointementMinutes = '00';
            }

            //Si le champ minutes d'heure de fin est vide alors le champ vaut 00
            if($endTimeMinutes == null){
                $endTimeMinutes = '00';
            }

            //Si le champ année de la date de RDV est vide alors le champ vaut l'année en cours
            if($year == null){
                $year = date("Y");
            }

            // Si le champ heure de fin de RDV est vide
            if($endTimeHour == null){
                $endTimeEvent=null; // alors l'heure de fin de RDV vaudra null 
            }else{// sinon on récupère les champs tels qu'indiqués par l'admin
                $endTimeEvent       = $endTimeHour . ":" . $endTimeMinutes;
            }

            //Si le champ mois et jour et heure de RDV sont vides
            if($day == null && 
            $month == null &&
            $appointementHour == null){
                // alors les date et heure de RDV vaudront null
                $appointementDate=null;

            }else{
            // Sinon on récupère les champs date et heure de rdv pour les adapter à l'enregistrement en base de données (DATETIME) */
            $appointementDate   = $year . ":" . $month . ":" . $day . " " . $appointementHour . ":" .$appointementMinutes;
            }

            if(array_key_exists('addEvent', $_POST)){ // si le bouton cliqué est "ajouter l'événement"
            // alors on fait appel à la méthode create du modèle NewsEvents pour insérer en BDD
                
                $newsEventsModel->create($appointementDate,$endTimeEvent,$city,$eventType,$eventDescription);
                
            } else if (array_key_exists('updateEvent', $_POST)){ // si le bouton cliqué est "modifier l'événement"
                // on récupère l'id de la news event a modifier
                $id = intval($_POST['id']);
                // alors on fait appel à la méthode update du modèle NewsEvents pour changer cette newsevents en BDD
                $newsEventsModel->update($appointementDate,$endTimeEvent,$city,$eventType,$eventDescription,$id);
            }

        }catch (DomainException $error){
            $errorModel->setErrorMessage($error->getMessage());
        }

        // s'il y a absence d'erreur
        if($errorModel->getErrorMessage() == null){
            // on redirige vers la page admin
            header('Location: admin');
            exit();
        }

    }

    //après le clique sur le btn Modifier l'événement
    if(array_key_exists('update_event', $_GET)){
        // on fait appel à la méthode readById de newsEventsModel
        $newsEventsUpdate = $newsEventsModel->readById(intval($_GET['update_event']));
    }

    //après le clique sur le btn Supprimer l'événement
    if(array_key_exists('delete_id', $_POST)){ 
        // on utlilise la méthode delete de newsEventsModel
        $newsEventsModel->delete(intval($_POST['id'])); 

        header('Location: admin');
        exit();
    }

    if(array_key_exists('logout', $_POST)){
        $_SESSION = [];

        if (isset($_COOKIE[session_name()])){
            setcookie(session_name(),'',time()-4200,'/');
        }

        session_destroy();
    }
    
    $template="../view/admin_event";
    include "../view/layout.phtml";

}else{
    header('Location: log');
    exit();
}