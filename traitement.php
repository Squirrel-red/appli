<?php
//-- ce fichier fait l'enregistrement des produits en session sur le serveur

//-- on appele la fonction session_start pour démarrer/récupérer une session
    session_start();

//-- les fonctions PHP sont dans sa documentation : https://www.php.net/manual/fr/intro.session.php
//-- les filtres pour les nombeux cas de validation de données : https://www.php.net/manual/fr/filter.filters.php
    
//-- on utilise les superglobales PHP: 
//-- $_GET contient tous les paramères ayant été transmis au serveur par l'intermédiaire de l'url de la requète
//-- $_POST contient toutes les données transmises au serveur par l'intermédiaire d'un formulaire
//-- $_SESSION contients les données stockées dans la session utilisateur coté serveur(si cette session a été démarrée au préalable)


    if (isset($_GET['action'])){ //si l'utilisateur fait une action
        
        switch ($_GET['action']){

            case "addProduct": //ajout de produit
                if(isset($_POST['submit'])){
        
                    $name=  filter_input(INPUT_POST, "name", FILTER_SANITIZE_FULL_SPECIAL_CHARS); //nouveau filtre
                    $price= filter_input(INPUT_POST, "price", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                    $qtt= filter_input(INPUT_POST, "qtt", FILTER_VALIDATE_INT);
                    $description=  filter_input(INPUT_POST, "description", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                
                    if (isset($_FILES['file'])) {
                        $tmpName = $_FILES['file']['tmp_image'];
                        $name = $_FILES['file']['image'];
                        $destination = __DIR__ . '/upload/' . $image;
       
                   if (move_uploaded_file($tmpImage, $destination)) {
                       $file = 'upload/' . $image; 
                   } else {
                       echo "Échec du téléchargement.";
                       exit; 
                   }
               }   
                    // Filtres pour la sécurité
            
                    if($name && $price && $qtt && $description && isset($file)){
            
                        $product = [
                            "file" => $file,
                            "name"=> $name,
                            "price" => $price,
                            "qtt" => $qtt,
                            "total" => $price*$qtt,
                            "description" => $description,
                        ];
                        // si la saisie est correct
                        $_SESSION['products'][]= $product;
                        $_SESSION['message'] = "<div  class='alert alert-success''>$name est mis dans le panier</div>";
                    }
                    else {  
                        $_SESSION['message'] = "<div  class='alert alert-danger'>Il faut remplir tous les champs</div>";
                    }
                }
                else {  
                    $_SESSION['message'] = "<div  class='alert alert-danger'>erreur</div>";
                }
                header("Location:index.php"); //a mettre en dernier, renvoie à l'index une fois le formulaire envoyé, correct ou non
                exit;
                break;

                
//-- fonctions pour modifier le panier, en lien avec les <a href> dans recap, sur les icones


            case 'removeOne': //action pour retirer une quantité 
                if ($_SESSION['products'][$_GET['id']]['qtt'] > 1){
                    // Vérifier qu'il y ait déjà au moins un article
                    $_SESSION['products'][$_GET['id']]['qtt'] -= 1;
                    //ensuite mettre à jour le total
                    $_SESSION['products'][$_GET['id']]['total'] = $_SESSION['products'][$_GET['id']]['qtt'] * $_SESSION['products'][$_GET['id']]['price'] ;

                    $name = $_SESSION['products'][$_GET['id']]["name"]; 
                    $_SESSION['message']= "<div  class='alert alert-danger'>Quantité de $name est diminuée</div>";
                }
               else {
                   unset($_SESSION['products'][$_GET['id']]);
                   $_SESSION['message']= "<div  class='alert alert-danger'Un produit vient d'être supprimer totalement du récapitulatif</div>";
               }
                break;

            case 'add' : //action pour ajouter une quantité
                $_SESSION['products'][$_GET['id']]['qtt'] += 1;
               //ensuite mettre à jour le total
                $_SESSION['products'][$_GET['id']]['total'] = $_SESSION['products'][$_GET['id']]['qtt'] * $_SESSION['products'][$_GET['id']]['price'] ;
              
                $name = $_SESSION['products'][$_GET['id']]["name"]; 
                $_SESSION['message']= "<div  class='alert alert-danger'>Quantité de $name est augmentée</div>";

                break;

// function unset() supprime une variable dans un tableau

            case 'delete': //action pour supprimer une catégorie entière de produit
                $name = $_SESSION['products'][$_GET['id']]["name"]; 
                unset($_SESSION['products'][$_GET['id']]);

                $_SESSION['message'] = "<div  class='alert alert-danger'>Produit $name est supprimé</div>";
                // pour les cas "addProduct" et 'deleteEverything'
                break;

            case 'deleteEverything' : // action pour supprimer tout son panier
                unset($_SESSION['products']);

                $_SESSION['message'] = "<div  class='alert alert-danger'>Panier est supprimé</div>";
                break;

            default : 
                break;
        }

        header("Location:recap.php"); // Une fois l'action finie à travers la page traitement, retour à recap
        exit;

    }

?>    