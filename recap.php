<?php
//pour récupérer les données utilisateurs
    session_start();
    // var_dump($_SESSION);
    // session_destroy();
    // ob_start(); //demarre la temporisation de sortie
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <title>Récapitulatif des produits</title>
</head>
<body> 
<nav class="navbar bg-body-tertiary">
  <div class="container-fluid">
    <form class="d-flex" role="search">
      <a  href="index.php" class="btn btn-primary" type="submit">Ajouter un produit</a>
      <a  href ="recap.php" class="btn btn-outline-primary position-relative">
  Panier
  <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
    
    0
    <span class="visually-hidden"></span>
  </span>
</a>
    </form>
  </div>
</nav>  
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
                 "</tr>",
                
                 "</tbody>",
             "</table>";
    }

    echo '<a href="traitement.php?action=deleteEverything" class="btn btn-primary">Supprimer le panier</a>';



  ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>
