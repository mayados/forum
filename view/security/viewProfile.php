<?php
/* S'il y a des datas... */
$topics = $result["data"]['topics'];
$lastTopics = $result["data"]['lastTopics'];
$lastPosts = $result["data"]['lastPosts'];

// var_dump($activitesReverse);
// var_dump(array_count_values($activitesReverse));
// var_dump($_SESSION['activites']);
?>

<div id="main-viewprofile">
    <h3>Mon profil</h3>

    <div class="infos-profil">
        <p>Pseudo : <?= $_SESSION["user"]->getPseudo() ?></p>

        <p>Adresse e-mail : <?= $_SESSION["user"]->getMail() ?></p>
    </div>

    <div class="sujets-posts">
        <div class="derniers-posts">
            <h4>Mes derniers posts :</h4>
            <?php
            if (isset($lastPosts)) {
                foreach ($lastPosts as $lastPost) {
            ?>
                    <div class="dernier-post">
                        <p>Vous avez répondu au Topic <?= $lastPost->getTopic()->getTitre() ?> (<?= $lastPost->getDateCreation() ?>)</p>
                    </div>
                <?php
                }
            } else {
                ?>
                <p>Aucune activité</p>
            <?php
            }
            ?>
        </div>

        <div class="sujets-profil">
            <h4>Mes sujets : </h4>
            <?php
            if (isset($topics)) {
                foreach ($topics as $topic) {
            ?>
                    <div class="sujet-profil">
                        <div class="titre-sujet">
                            <a href="index.php?ctrl=forum&action=detailTopic&id=<?= $topic->getId() ?>"><?= $topic->getTitre() ?></a>
                        </div>
                        <div class="date-sujet">
                            <p><?= $topic->getDateCreation() ?></p>
                        </div>
                        <?php
                        if ($topic->getVerrouillage() == 0) {
                        ?>
                            <div class="verrouillage-sujet">
                                <a href="index.php?ctrl=security&action=closeTopic&id=<?= $topic->getId() ?>">Clore le sujet <i class="fa-solid fa-lock"></i></a>
                            </div>
                        <?php
                        } else {
                        ?>
                            <div class="verrouillage-sujet">
                                <p>Sujet clos</p>
                            </div>
                        <?php } ?>
                    </div>
                <?php
                }
            } else {
                ?>
                <p>Aucun sujet pour le moment..</p>
            <?php
            }
            ?>
        </div>
    </div>

</div>