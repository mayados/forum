<?php

$topic = $result["data"]['topic'];
$post = $result["data"]['post'];
// var_dump($post->getId());

if($_SESSION["user"]->getId() == $topic->getUser()->getId()){
?>

<div id="main-modifierTopic">
        <h4>Modifier le topic :</h4>

        <form id="form-topic" action="index.php?ctrl=security&action=updateTopic&id=<?= $topic->getId()?>&idPost=<?= $post->getId() ?>" method="post">

            <div class="form-field">
                <label for="titre">Titre du topic :</label>
                <input type="text" id="titre" name="titre" maxlength="80" value="<?= $topic->getTitre() ?>" required>
            </div>
            <div class="form-field">
                <label for="texte">Message</label>
                <textarea name="texte" id="texte" cols="30" rows="10" required><?= $post->getTexte() ?></textarea>
            </div>

            <div class="form-field">
                <input class="form-button" name="submit" type="submit" value="Envoyer">
            </div>
        </form>

<?php
}
?>    
</div>

