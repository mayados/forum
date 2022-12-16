<?php

$posts = $result["data"]['posts'];
$topic = $result["data"]['topics'];

$idTopic = (isset($_GET["id"])) ? $_GET["id"] : null;

?>

<div id="main-listposts">
    <h1><?= $topic->getTitre() ?></h1>
    <a href="index.php?ctrl=forum&action=detailCategorie&id=<?= $topic->getCategorie()->getId() ?>">Retour</a>
    <div id="posts">
        <?php
        if(isset($_SESSION["user"]) && $_SESSION["user"]->getId() == $topic->getUser()->getId()){
                ?>
                    <a href="index.php?ctrl=security&action=closeTopic&id=<?= $topic->getId() ?>">Clore le sujet <i class="fa-solid fa-lock"></i></a>
                    <a href="index.php?ctrl=security&action=viewModifierTopic&id=<?= $topic->getId() ?>">Modifier le topic</a>
                <?php
        }
        foreach($posts as $post ){
            ?>
            <div class="post-topic">
                <p id="texte"><?=$post->getTexte()?> </p>
                <p class="infos-post">Posté par 
                    <?php
                        if($post->getUser()==false){
                            ?>
                            Utilisateur banni le <?= $post->getDateCreation() ?>
                            <?php
                        }else{
                        ?>
                            <a href="index.php?ctrl=security&action=viewProfileUsers&id=<?= $post->getUser()->getId() ?>"><?=$post->getUser()->getPseudo() ?></a> le <?= $post->getDateCreation() ?>
                        <?php
                        }
                        ?>
                </p>
                <?php
                    if(App\Session::isAdmin()){
                    ?>
                        <div class="supprimer-post">
                            <a href="index.php?ctrl=security&action=deletePost&id=<?= $post->getId() ?>&idTopic=<?= $topic->getId() ?>">Supprimer</a>
                        </div>
                    <?php
                    }
                ?>
            </div>
            <?php
            
        }    
        ?>        
    </div>

    <?php
    if(App\Session::getUser()){
        if($post->getTopic()->getVerrouillage()==0 ){
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
        }else{
            ?>
                <p>Ce sujet est clos</p>
            <?php
        }
    }
    ?>
</div>




  
