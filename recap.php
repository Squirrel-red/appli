<?php
//pour récupérer les données utilisateurs
    session_start();
    ob_start(); //demarre la temporisation de sortie
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Récapitulatif des produits</title>
</head>
<body>  
  <?php
    if(!isset($_SESSION['products']) || empty($_SESSION['products'])){
        echo "<p> Aucun produit en session... </p>";
    } 
    else{
        echo "<table>",
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
                    "<td>".number_format($product['price'], 2, ",", "&nbssp;")."&nbsp;€</td>", //la fonction number_format permet de modifier l'affichage d'une valeur numérique en présisant plusieurs paramétres
                    "<td>", //retirer ou ajouter une quantité
                        "<a href='traitement.php?action=removeOne&id=$index'><i class='fa-solid fa-minus'></i></a>",
                            $product['qtt'],
                        "<a href='traitement.php?action=add&id=$index'><i class='fa-solid fa-plus'></a></i>",
                    "</td>",
                    "<td>".number_format($product['total'], 2, ",", "&nbssp;")."&nbsp;€ </td>",
                 "</tr>";
            $totalGeneral+= $product['total'];
        }
        echo     "<tr>",
                    "<td colspan=4>Total général : </td>",
                    "<td> <strong>".number_format($totalGeneral, 2, ",", "&nbssp;")."&nbsp;€</strong></td>",
                 "<tr>",
                 "<tr>",
                    "<td colspan=4> Supprimer le panier : </td>",
                    "<td><a href='traitement.php?action=deleteEverything'><i class='fa-solid fa-trash'></i></a></td>",
                 "</tr>",
                 "</tbody>",
             "</table>",

    }
var_dump($_SESSION);

    $title = "Récap des produits";
    $content= ob_get_clean();

  ?>
</body>
</html>
