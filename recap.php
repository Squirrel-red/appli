<?php
//pour récupérer les données utilisateurs
    session_start();
    // var_dump($_SESSION);
    // session_destroy();
     ob_start(); //demarre la temporisation de sortie


// pour afficher la quantité totale des produits sur le button "Panier"
$qttTotal = 0;
if (isset($_SESSION['products']) && !empty($_SESSION['products'])){

    foreach($_SESSION['products'] as $index => $qtt){ // boucle pour afficher la quantité totale des produits sur le button "Panier"
    $qttTotal+= $qtt['qtt'];
    }        

}  

?>

<h1 class ="text-primary">Récapitulatif des produits</h1>   
  <?php
    if(!isset($_SESSION['products']) || empty($_SESSION['products'])){
        echo "<p> Aucun produit en session... </p>";
    } 
    else{
        echo "<table class='table'>",
                "<thead>",
                    "<tr>",
                        "<th>#</th>",
                        "<th>Nom</th>",
                        "<th>Prix</th>",
                        "<th>Quantité</th>",
                        "<th>Total</th>",
                    "</tr>",
                "</thead>",
               "<tbody>";
        $totalGeneral = 0 ;
        $totalQtt = 0;

        foreach($_SESSION['products'] as $index => $product){ // boucle pour afficher tout le panier, number_format pour un meilleur affichage des prix
            echo "<tr>",
                    "<td>".$index."</td>",
                    "<td>".$product['name']."</td>",
                    "<td>".number_format($product['price'], 2, ",", "&nbsp;")."&nbsp;€</td>", //la fonction number_format permet de modifier l'affichage d'une valeur numérique en présisant plusieurs paramétres
                    "<td>", //retirer ou ajouter une quantité
                        "<a href='traitement.php?action=add&id=$index'>  +  </a>",
                            $product['qtt'],
                        "<a href='traitement.php?action=removeOne&id=$index'> -  </i>",
                        "<a href='traitement.php?action=delete&id=$index'>  x  </i>",
                    "</td>",
                    "<td>".number_format($product['total'], 2, ",", "&nbsp;")."&nbsp;€ </td>",
                 "</tr>";
            $totalGeneral+= $product['total'];
        }
        echo     "<tr>",
                    "<td colspan=4>Total général : </td>",
                    "<td> <strong>".number_format($totalGeneral, 2, ",", "&nbsp;")."&nbsp;€</strong></td>",
                 "</tr>",
                 "</tbody>",
             "</table>";
    }

    echo '<a href="traitement.php?action=deleteEverything" class="btn btn-primary">Supprimer le panier</a>';

// Adaptation du ce fichier pour inclure le fichier template.php
  // --Recupere le contenu et le stocke dans la variable $content
$content = ob_get_clean();

  //--Recupere le code du fichier 
	require_once "template.php";
	
?>