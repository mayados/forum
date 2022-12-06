<?php

$topics = $result["data"]['topics'];
/* On peut récupérer l'id de la catégorie grâce à l'id placé dans le lien de la  page listCategories.php */
$idCategorie = (isset($_GET["id"])) ? $_GET["id"] : null;
    
?>

<h1>liste des topics</h1>

<?php
foreach($topics as $topic ){

    ?>
    <p><a href="index.php?ctrl=forum&action=detailTopic&id=<?= $topic->getId()?>"><?=$topic->getTitre()?></a><?= $topic->getDateCreation() ?> (posté par <?=$topic->getUser()->getPseudo()?></p>

    <?php
}

?>

<h4>Ajouter un nouveau topic :</h4>


<form action="index.php?ctrl=forum&action=nouveauTopic&id=<?= $idCategorie ?>" method="post">

    <label for="titre">Titre du topic :</label>
    <input type="text" id="titre" name="titre" maxlength="80" required>

    <label for="texte">Message</label>
    <textarea name="texte" id="texte" cols="30" rows="10" required></textarea>

    <input name="submit" type="submit" value="Envoyer">

</form>