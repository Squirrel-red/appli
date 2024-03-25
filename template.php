<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--  Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
   
    <title><Ajout un produit></title>
    <title><?php echo $title; ?></title>

</head>
<body>

<?php require "nav.php";
?>


<!--on affiche le contenu de la variable $content -->
    <div id="wrapper">
        <?= $content ?>
    </div>

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
                        "<a href='traitement.php?action=add&id=$index'> + </a>",
                            $product['qtt'],
                        "<a href='traitement.php?action=removeOne&id=$index'> - </i>",
                        "<a href='traitement.php?action=delete&id=$index'> x</i>",
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
 
  ?>
 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>