<?php

$topics = $result["data"]['topics'];
    
?>

<h1>liste topics</h1>

<?php
foreach($topics as $topic ){
    ?>
    <p><a href="index.php?ctrl=forum&action=detailTopic&id=<?= $topic->getId()?>"><?=$topic->getTitre()?></a> (sujet de : 
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
        if(App\Session::isAdmin()){
            if($topic->getVerrouillage()==NULL){
                ?>
                    <a href="index.php?ctrl=security&action=closeTopic&id=<?= $topic->getId()?>">Clore</a>
                <?php
            }else{
                ?>
                    <p>Sujet clos</p>
                <?php
            }
        }
        ?>
    </p>
    <?php
    /* Quand on fait un var_dump de $topic->getUser, on voit qu'il récupère l'objet associé (user), il n'y a donc plus qu'à mettre la propriété que nous souhaitons à partir de cet objet (ici ->getPseudo()) */
    // var_dump($topic->getUser());
}
?>





