<?php
    $user = $result["data"]['users'];
    $topics = $result["data"]['topics'];
    $lastPosts = $result["data"]['lastPosts'];

?>

<div id="main-usersProfile">
    <h3>Profil de <?= $user->getPseudo() ?></h3>

    <div class="infos-profil">
        <p>Pseudo : <?= $user->getPseudo() ?></p>
        <p>Adresse e-mail : <?= $user->getMail() ?></p>
        <p>Date de creation du compte : <?= $user->getDateInscription() ?></p>
        <?php
        if(App\Session::isAdmin()){?>
        <p class="ban">
            <a href="index.php?ctrl=security&action=ban&id=<?= $user->getId() ?>">Bannir <i class="fa-solid fa-ban"></i></a>
        </p>
        <?php
        }
        ?>         
    </div>


    <div class="sujets-posts">
        <div class="derniers-posts">
            <h4>Derniers posts :</h4>
            <?php
                if($lastPosts !==null){
                    foreach($lastPosts as $lastPost){
                        ?>
                        <div class="dernier-post">
                            <p>Réponse au Topic <?= $lastPost->getTopic()->getTitre() ?></p>
                        </div>
                        <?php
                    }
                }else{
                    ?>
                        <p>Pas de posts</p>
                    <?php
                }
            ?>            
        </div>
        <div class="sujets-profil">
            <h4>Topics créés: </h4>
            <?php
                if($topics !==null){
                    foreach($topics as $topic ){
                        ?>
                        <div class="sujet-profil">
                            <div class="titre-sujet">
                                <a href="index.php?ctrl=forum&action=detailTopic&id=<?= $topic->getId()?>"><?=$topic->getTitre()?></a>
                            </div>
                            <div class="date-sujet">
                                <p><?= $topic->getDateCreation() ?></p>
                            </div>                        
                        </div>

                        <?php
                    }
                }else{
                    ?>
                        <p>Pas de topics créés</p>            
        </div>
                <?php
            }
                ?>  
    </div>
 
</div>

