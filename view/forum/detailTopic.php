<?php

$posts = $result["data"]['posts'];

// var_dump($posts);
    
?>

<h1>liste des posts</h1>

<?php
foreach($posts as $post ){

    ?>
    <p><?=$post->getTexte()?> <?= $post->getDateCreation() ?> (posté par <?=$post->getUser()->getPseudo() ?>)</p>
    <?php
}


  
