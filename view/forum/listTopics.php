<?php

$topics = $result["data"]['topics'];
    
?>

<h1>liste topics</h1>

<?php
foreach($topics as $topic ){

    ?>
    <p><?=$topic->getTitre()?> (sujet de : <?=$topic->getUser()->getPseudo()?>)</p>
    <?php
    /* Quand on fait un var_dump de $topic->getUser, on voit qu'il récupère l'objet associé (user), il n'y a donc plus qu'à mettre la propriété que nous souhaitons à partir de cet objet (ici ->getPseudo()) */
    // var_dump($topic->getUser());
}
?>





