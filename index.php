<?php
    session_start();

// pour afficher la quantité totale des produits sur le button "Panier"
    $qttTotal = 0;
    if (isset($_SESSION['products']) && !empty($_SESSION['products'])){

        foreach($_SESSION['products'] as $index => $qtt){ // boucle pour afficher la quantité totale des produits sur le button "Panier"
        $qttTotal+= $qtt['qtt'];
        }        

    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <title>
        <Ajout produit></title>
</head>
<body>
<nav class="navbar bg-body-tertiary">
  <div class="container-fluid">
    <form class="d-flex" role="search">
      <a  href="index.php" class="btn btn-primary" type="submit">Ajouter un produit</a>
      <a  href ="recap.php" class="btn btn-outline-primary position-relative">
  Panier
  <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
    <?= $qttTotal ?>
    <?php //echo $qttTotal ?>
    <span class="visually-hidden"></span>
  </span>
</a>
    </form>
  </div>
</nav> 
    <h1 class ="text-primary">Ajouter un produit</h1>
    <form action="traitement.php?action=addProduct" method="post"> 
        <div class="mb-3">
            <p>
                <label>
                    Nom du produit : 
                    <input type="text" name="name" class="form-control" >
                </label>
            </p>
        </div>    
            <p>
                <label>
                    Prix du produit en € : 
                    <input type="number" step="any" name="price" class="form-control" >
                </label>
            </p>
            <p>
                <label>
                    Quantité désirée : 
                    <input type="number" name="qtt" value="1" class="form-control">
                </label>
            </p>
            <p>
                <input type="submit" name="submit" value="Ajouter le produit" class="btn btn-primary btn-lg">
            </p>

    </form>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>

<?php

if (!isset($_SESSION["message"]) || empty($_SESSION["message"])){
    // s'il n'y a pas de messages --> on n'affiche pas les messages
} else{
        echo $_SESSION["message"];

        unset($_SESSION["message"]);
} 

// Adaptation du ce fichier pour inclure le fichier template.php

  // Recupere le contenu et le stocke dans la variable $content
$content = ob_get_clean();

  //Recupere le code du fichier 
	require_once "template.php";
	
?>
