<?php

/* On dit que la variable $categories à pour valeur $result avec les data ayant pour nom 'categories' */
/* $categories est égale aux datas categories */
$categories = $result["data"]['categories'];
    
?>

<h1>liste topics</h1>

<?php
/* Pour chaque data de categories qu'on appelle $categorie, on appelle la méthode qui nous intéresse présente dans l'entities Categorie */
foreach($categories as $categorie ){
    /* On fait appelle à la méthode getNomCategorie de l'entité Categorie */
    ?>
    <p><?=$categorie->getNomCategorie()?></p>
    <?php
}


  
