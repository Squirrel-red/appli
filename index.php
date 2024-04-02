<?php
    session_start();
    ob_start();

// pour afficher la quantité totale des produits sur le button "Panier"
    $qttTotal = 0;
    if (isset($_SESSION['products']) && !empty($_SESSION['products'])){

        foreach($_SESSION['products'] as $index => $qtt){ // boucle pour afficher la quantité totale des produits sur le button "Panier"
        $qttTotal+= $qtt['qtt'];
        }        

    }

?>

    <h1 class ="text-primary">Ajouter un produit</h1>
    <form action="traitement.php?action=addProduct" method="post" enctype="multipart/form-data"> 
        <div class="mb-3">

            <label for="file">Fichier:</label>
				    <input type="file" name="file">
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
                    <input type="number" min ="0" step="any" name="price" class="form-control" >
                </label>
            </p>
            <p>
                <label>
                    Quantité désirée : 
                    <input type="number" min="1" name="qtt"  class="form-control">
                </label>
            </p>
            <p>
				<label> Description du produit :
					<br>
					<textarea name="description"></textarea>
				</label>
			</p>
            <p>
                <input type="submit" name="submit" value="Ajouter le produit" class="btn btn-primary btn-lg">
            </p>

    </form>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>



<?php


// Adaptation du ce fichier pour inclure le fichier template.php

  // Recupere le contenu et le stocke dans la variable $content
$content = ob_get_clean();

  //Recupere le code du fichier 
	require_once "template.php";
	
?>
