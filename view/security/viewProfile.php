<?php 
/* S'il y a des datas... */
$topics = $result["data"]['topics'];
$lastTopics = $result["data"]['lastTopics'];
$lastPosts = $result["data"]['lastPosts'];

// var_dump($activitesReverse);
// var_dump(array_count_values($activitesReverse));
// var_dump($_SESSION['activites']);
?>

<div id="main-viewprofile">
    <h3>Mon profil</h3>

    <div class="infos-profil">
        <p>Pseudo : <?= $_SESSION["user"]->getPseudo() ?></p>

        <p>Adresse e-mail : <?= $_SESSION["user"]->getMail() ?></p>    
    </div>


    <br>
    <div class="derniers-posts">
        <ul>Mes derniers posts :
            <?php
            if(isset($lastPosts)){
                foreach($lastPosts as $lastPost){
                ?>
                    <li>Vous avez répondu au Topic <?= $lastPost->getTopic()->getTitre() ?> (<?= $lastPost->getDateCreation() ?>)</li>
                <?php
                }
            }else{
                ?>
                <p>Aucune activité</p>
                <?php
            }
            ?>
        </ul>   
    </div>

    <br>


    <div class="sujets-profil">
        <p>Mes sujets : </p>
        <?php 
        if(isset($topics)){
                foreach($topics as $topic){
                ?>
                <div>
                    <a href="index.php?ctrl=forum&action=detailTopic&id=<?= $topic->getId()?>"><?=  $topic->getTitre()?></a> 
                    <p><?= $topic->getDateCreation() ?></p>
                    <?php
                        if($topic->getVerrouillage()==0){
                    ?>
                            <a href="index.php?ctrl=security&action=closeTopic&id=<?= $topic->getId()?>">Clore le sujet <i class="fa-solid fa-lock"></i></a>
                    <?php
                        }else{
                    ?>
                    Sujet clos
                    <?php } ?>
                        </div>
                <?php
                }
        }else{
            ?>
            <p>Aucun sujet pour le moment..</p>
            <?php
        }
        ?>
    </div>    
</div>





