<?php
    $user = $result["data"]['users'];
    $topics = $result["data"]['topics'];
?>



<h4>Profil de <?= $user->getPseudo() ?></h4>

<p>Pseudo : <?= $user->getPseudo() ?></p>

<p>Adresse e-mail : <?= $user->getMail() ?></p>

<p>Date de creation du compte : <?= $user->getDateInscription() ?></p>

<p>Topics créés: </p>

<?php
    if($topics !==null){
        foreach($topics as $topic ){

            ?>
                <p><?=$topic->getTitre()?></p>
            <?php
        }
    }else{
        ?>
            <p>Pas de topics créés</p>
        <?php
    }
?>
