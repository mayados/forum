<?php

$posts = $result["data"]['posts'];

$idTopic = (isset($_GET["id"])) ? $_GET["id"] : null;

// var_dump($posts);
    
?>

<div id="main-listposts">
    <h1>liste des posts</h1>
    <div id="posts">
        <?php
        foreach($posts as $post ){
            ?>
            <div class="post-topic">
                <p><?=$post->getTexte()?> </p>
                <p class="infos-post">Posté par <?=$post->getUser()->getPseudo() ?> le <?= $post->getDateCreation() ?></p>
            </div>
            <?php
        }    
        ?>        
    </div>

    <?php
    if(App\Session::getUser()){
    ?>
    <div id="ajout-post">
        <h4>Ecrire un message :</h4>
        <form id="form-topic" action="index.php?ctrl=forum&action=nouveauPost&id=<?=$idTopic?>" method="post">
            <div class="form-field">
                <label for="texte">Message</label>
                <textarea name="texte" id="texte" cols="30" rows="10" required></textarea>                
            </div>

            <div class="form-field">
                 <input class="form-button" name="submit" type="submit" value="Envoyer">                
            </div>
        </form>             
    </div>
    <?php
    }
    ?>
</div>




  
