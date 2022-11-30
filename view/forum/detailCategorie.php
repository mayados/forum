<?php

$topics = $result["data"]['topics'];
$idCategorie = (isset($_GET["id"])) ? $_GET["id"] : null;
    
?>

<h1>liste des topics</h1>

<?php
foreach($topics as $topic ){

    ?>
    <p><a href="index.php?ctrl=forum&action=detailTopic&id=<?= $topic->getId()?>"><?=$topic->getTitre()?></a><?= $topic->getDateCreation() ?><?= $topic->getCategorie() ?></p>

    <?php
}

?>

<h4>Ajouter un nouveau topic :</h4>

    
<form action="index.php?ctrl=forum&action=nouveauTopic&id=<?= $idCategorie ?>" method="post">

    <label for="titre">Titre du topic :</label>
    <input type="text" id="titre" name="titre">

    <label for="">Message</label>
    <textarea name="" id="" cols="30" rows="10"></textarea>

    <input name="submit" type="submit" value="Envoyer">

</form>