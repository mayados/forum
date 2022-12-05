<?php

/* On dit que la variable $categories à pour valeur $result avec les data ayant pour nom 'categories' */
/* $categories est égale aux datas categories */
$users = $result["data"]['users'];
    
?>

<h1>liste des membres</h1>

<?php
/* Pour chaque data de categories qu'on appelle $categorie, on appelle la méthode qui nous intéresse présente dans l'entities Categorie */
foreach($users as $user ){
    /* On fait appelle à la méthode getNomCategorie de l'entité Categorie */
    ?>
    <div>
        <p><?=$user->getPseudo()?></p>
    </div>

    <?php
}


