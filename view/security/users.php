<?php

/* On dit que la variable $categories à pour valeur $result avec les data ayant pour nom 'categories' */
/* $categories est égale aux datas categories */
$users = $result["data"]['users'];
    
?>

<div id="main-users">
    <h1>liste des membres</h1>

    <div id="list-users">
        <?php
        /* Pour chaque data de categories qu'on appelle $categorie, on appelle la méthode qui nous intéresse présente dans l'entities Categorie */
        foreach($users as $user ){
            /* On fait appelle à la méthode getNomCategorie de l'entité Categorie */
            ?>
            <div class="user">
                <div class="user-pseudo">
                    <a href="index.php?ctrl=security&action=viewProfileUsers&id=<?= $user->getId() ?>" ><?=$user->getPseudo()?></a>
                </div>  
                <div class="user-date">
                    <p><?=$user->getDateInscription()?></p>
                </div>
                <div class="ban-user">
                    <a href="index.php?ctrl=security&action=ban&id=<?= $user->getId() ?>">Bannir <i class="fa-solid fa-ban"></i></a>                    
                </div>              
            </div>
            <?php
        }    
        ?>        
    </div>

</div>



