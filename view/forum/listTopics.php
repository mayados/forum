<?php

$topics = $result["data"]['topics'];
    
?>

<h1>liste topics</h1>

<?php
foreach($topics as $topic ){

    ?>
    <p><?=$topic->getTitre()?></p>
    <?php
}
?>
    <h4>Ajouter un nouveau topic :</h4>

    
    <form action="index.php?ctrl=forum&action=" method="post">

        <label for="">Titre du topic :</label>
        <input type="text">

        <label for="">Message</label>
        <textarea name="" id="" cols="30" rows="10"></textarea>

        <input name="submit" type="submit" value="Envoyer">

    </form>




