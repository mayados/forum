<?php

/* On dit que la variable $categories à pour valeur $result avec les data ayant pour nom 'categories' */
/* $categories est égale aux datas categories */
$categories = $result["data"]['categories'];
    
?>

<div id="main-listcategories">
    <h1>Liste des catégories</h1>
    <div class="categories">
    <?php
    /* Pour chaque data de categories qu'on appelle $categorie, on appelle la méthode qui nous intéresse présente dans l'entities Categorie */
    foreach($categories as $categorie ){
        /* On fait appelle à la méthode getNomCategorie de l'entité Categorie */
        ?>
        <div class="categorie-item">
            <a href="index.php?ctrl=forum&action=detailCategorie&id=<?= $categorie->getId()?>"><?=$categorie->getNomCategorie()?></a>
        </div>
        <?php
    }
    ?>
    </div>    
</div>





  
