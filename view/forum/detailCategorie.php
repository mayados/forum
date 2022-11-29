<?php

$topics = $result["data"]['topics'];
    
?>

<h1>liste des topics</h1>

<?php
foreach($topics as $topic ){

    ?>
    <p><a href="index.php?ctrl=forum&action=detailTopic&id=<?= $topic->getId()?>"><?=$topic->getTitre()?></a><?= $topic->getDateCreation() ?></p>

    <?php
}

