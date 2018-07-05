<?php
session_start();

if (isset($_SESSION['login'])){//On vérifie que le variable existe.
    $login=$_SESSION['login'];//On récupère la valeur de la variable de session.
}else{
    $login=0;//Si $_SESSION['connect'] n'existe pas, on donne la valeur "0".
}


if ($login == "1"){ // Si le visiteur s'est identifié,on affiche la page

    require_once 'models/productModel.php';
    require_once 'models/errorModel.php';

    // on instancie le modèle Product
    $productModel = new Product;
    $errorModel = new Error;

    //après le clique sur le btn Ajouter le produit OU Modifier le produit
    if(array_key_exists('addProduct', $_POST) || array_key_exists('updateProduct', $_POST)){
        // on récupère les données du formulaire
        $ref                = $_POST['ref'];
        $category           = trim($_POST['category']);
        $title              = trim($_POST['title']);
        $capacity           = trim($_POST['capacity']);
        $composition        = trim($_POST['composition']);
        $productDescription = trim($_POST['productdescription']);

        // Suivant la catégorie de produit on enregistre en BDD des noms de classe corrects pour le CSS
        if($category       == 'Nouveautés'){
            $categoryForCSS = 'new';
        }else if($category == 'Santé'){
            $categoryForCSS = 'health';
        }else if($category == 'Douleur'){
            $categoryForCSS = 'pain';
        }else if($category == 'Peau'){
            $categoryForCSS = 'skin';
        }else if($category == 'Quotidien'){
            $categoryForCSS = 'daily';
        }else if($category == 'Maison Animaux'){
            $categoryForCSS = 'house-animals';
        }

        try{
            if(empty($ref) || empty($category) || empty($title)) 
            throw new DomainException("Veuillez remplir les champs obligatoires *.");

            if(!ctype_digit($ref))
            throw new DomainException("La Référence doit correspondre à un nombre entier positif.");    
            
            if(strlen($ref) > 5)
            throw new DomainException("La Référence ne peut pas contenir plus de 5 caractères.");
            if(strlen($title) > 64)
            throw new DomainException("Le Titre ne peut pas contenir plus de 64 caractères.");
            if(strlen($capacity) > 128)
            throw new DomainException("La Contenance ne peut pas contenir plus de 128 caractères.");
            if(strlen($composition) > 256)
            throw new DomainException("La Composition dépasse la limite de 256 caractères.");
            if(strlen($productDescription) > 512)
            throw new DomainException("La Description du produit dépasse la limite de 512 caractères.");

            if(array_key_exists('addProduct', $_POST)){ // si le bouton cliqué est "ajouter l'événement"
                // alors on fait appel à la méthode create du modèle NewsEvents pour insérer en BDD
                $productModel->create($ref,$category,$categoryForCSS,$title,$capacity,$composition,$productDescription);

            } else if (array_key_exists('updateProduct', $_POST)){ // si le bouton cliqué est "modifier l'événement"
                // on récupère l'id du produit a modifier
                $id = intval($_POST['id']);
                // alors on fait appel à la méthode update du modèle NewsEvents pour changer cette newsevents en BDD
                $productModel->update($ref,$category,$categoryForCSS,$title,$capacity,$composition,$productDescription,$id);
            }

        }catch (DomainException $error){
            $errorModel->setErrorMessage($error->getMessage());
        }

        // s'il y a absence d'erreur
        if($errorModel->getErrorMessage() == null){
            // on redirige vers la page admin
            header('Location: admin.php');
            exit();
        }

    }



    if(array_key_exists('update_product', $_GET)){
        $productUpdate = $productModel->readById($_GET['update_product']);
    }


    if(array_key_exists('delete_id', $_POST)){ 

        $productModel->delete([$_POST['id']]); // on utlilise la méthode delete de newsEventsModel

        header('Location: admin.php');
        exit();
    }

    if(array_key_exists('logout', $_POST)){
        $_SESSION = [];

        if (isset($_COOKIE[session_name()])){
            setcookie(session_name(),'',time()-4200,'/');
        }

        session_destroy();
    }
    
    $template="view/admin_product";
    include "view/layout.phtml";

}else{
    header('Location: admin_login.php');
    exit();
}