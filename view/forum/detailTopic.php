<?php

$posts = $result["data"]['posts'];
    
?>

<h1>liste des posts</h1>

<?php
foreach($posts as $post ){

    ?>
    <p><?=$post->getTexte()?> <?= $post->getDateCreation() ?></p>
    <?php
}


  
