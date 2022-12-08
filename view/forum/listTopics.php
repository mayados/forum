<?php

$topics = $result["data"]['topics'];
    
?>

<h1>liste topics</h1>

<?php
foreach($topics as $topic ){

    ?>
    <p><?=$topic->getTitre()?> (sujet de : 
        <?php
            if($topic->getUser()==false){
            ?>
            Utilisateur banni
            <?php
            }else{
        ?>
        <a href="index.php?ctrl=security&action=viewProfileUsers&id=<?= $topic->getUser()->getId() ?>"><?=$topic->getUser()->getPseudo()?></a>)
        <?php
            }
        ?>
    </p>
    <?php
    /* Quand on fait un var_dump de $topic->getUser, on voit qu'il récupère l'objet associé (user), il n'y a donc plus qu'à mettre la propriété que nous souhaitons à partir de cet objet (ici ->getPseudo()) */
    // var_dump($topic->getUser());
}
?>





