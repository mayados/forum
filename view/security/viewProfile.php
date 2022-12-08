<?php 
/* S'il y a des datas... */
$topics = $result["data"]['topics'];
?>
<h4>Mon profil</h4>

<p>Pseudo : <?= $_SESSION["user"]->getPseudo() ?></p>

<p>Adresse e-mail : <?= $_SESSION["user"]->getMail() ?></p>

<p>Mes sujets : </p>
<div id="mes-sujets">
<?php 
    foreach($topics as $topic){
    ?>
    <p><?=  $topic->getTitre()?>
        <?php
            if($topic->getVerrouillage()==0){
        ?>
                <a href="index.php?ctrl=security&action=closeTopic&id=<?= $topic->getId()?>">Clore le sujet</a>
        <?php
            }else{
        ?>
        Sujet clos
        <?php } ?>
    </p>
    <?php
    }
?>
</div>


