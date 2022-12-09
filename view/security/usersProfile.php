<?php
    $user = $result["data"]['users'];
    $topics = $result["data"]['topics'];
    $lastPosts = $result["data"]['lastPosts'];

?>



<h4>Profil de <?= $user->getPseudo() ?></h4>

<p>Pseudo : <?= $user->getPseudo() ?></p>

<p>Adresse e-mail : <?= $user->getMail() ?></p>

<p>Date de creation du compte : <?= $user->getDateInscription() ?></p>
<br>
<p>Derniers posts :</p>
<?php
    if($lastPosts !==null){
        foreach($lastPosts as $lastPost){
            ?>
            <div>
                 <p>Vous avez répondu au Topic <?= $lastPost->getTopic()->getTitre() ?></p>
            </div>
            <?php
        }
    }else{
        ?>
            <p>Pas de posts</p>
        <?php
    }
?>
<br>
<p>Topics créés: </p>

<?php
    if($topics !==null){
        foreach($topics as $topic ){

            ?>
            <div>
                <a href="index.php?ctrl=forum&action=detailTopic&id=<?= $topic->getId()?>"><?=$topic->getTitre()?></a>
                <p><?= $topic->getDateCreation() ?></p>
            </div>
            <?php
        }
    }else{
        ?>
            <p>Pas de topics créés</p>
        <?php
    }
if(App\Session::isAdmin()){?>
<a href="index.php?ctrl=security&action=ban&id=<?= $user->getId() ?>">Bannir</a>
<?php
}
?>