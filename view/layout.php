<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tiny.cloud/1/zg3mwraazn1b2ezih16je1tc6z7gwp5yd4pod06ae5uai8pa/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <?php /* Il faut diriger vers public, car la redirection de base ne fonctionne pas  */ ?>
    <link rel="stylesheet" href="public/css/style.css">
    <title>FORUM</title>
</head>
<body>
    <div id="wrapper"> 
       
        <div id="mainpage">
            <!-- c'est ici que les messages (erreur ou succès) s'affichent-->
            <h3 class="message" style="color: red"><?= App\Session::getFlash("error") ?></h3>
            <h3 class="message" style="color: green"><?= App\Session::getFlash("success") ?></h3>
            <header>
                <nav>
                    <div id="nav-left">
                        <a href="index.php?ctrl=security&action=index">Accueil</a>
                        <?php
                        /* Si l'user est admin on affiche cette portion */
                        if(App\Session::isAdmin()){
                            ?>
                            <a href="index.php?ctrl=home&action=users">Liste utilisateurs</a>
                            <a href="index.php?ctrl=home&action=newCategorie">Nouvelle catégorie</a>
                            <?php
                        }
                        ?>
                    </div>
                    <div id="nav-right">
                    <?php
                        /* Si l'user n'est pas admin et est en $_SESSION on affiche cette portion */
                        if(App\Session::getUser()){
                            ?>
                            <a href="index.php?ctrl=security&action=viewProfile&id=<?=$_SESSION["user"]->getId() ?>"><span class="fas fa-user"></span>&nbsp;<?= App\Session::getUser()?></a>
                            <a href="index.php?ctrl=security&action=deconnexion">Déconnexion</a>
                            <a href="index.php?ctrl=forum&action=listTopics">Topics</a> 
                            <a href="index.php?ctrl=forum&action=listCategories">Categories</a>                             
                            <?php
                        }
                        else{
                            /* En cas de déconnexion ou si non connecté*/
                            ?>
                            <a href="index.php?ctrl=security&action=directionConnexion">Connexion</a>
                            <a href="index.php?ctrl=security&action=directionInscription">Inscription</a>
                            <a href="index.php?ctrl=forum&action=listTopics">Topics</a> 
                            <a href="index.php?ctrl=forum&action=listCategories">Categories</a>   
                        <?php
                        }
                   
                        
                    ?>
                    </div>
                </nav>
            </header>
            
            <main id="forum">
                <?= $page ?>
            </main>
        </div>
        <footer>
            <p>&copy; 2020 - Forum CDA - <a href="/home/forumRules.html">Règlement du forum</a> - <a href="">Mentions légales</a></p>
            <!--<button id="ajaxbtn">Surprise en Ajax !</button> -> cliqué <span id="nbajax">0</span> fois-->
        </footer>
    </div>
    <script
        src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous">
    </script>
    <script>

        $(document).ready(function(){
            $(".message").each(function(){
                if($(this).text().length > 0){
                    $(this).slideDown(500, function(){
                        $(this).delay(3000).slideUp(500)
                    })
                }
            })
            $(".delete-btn").on("click", function(){
                return confirm("Etes-vous sûr de vouloir supprimer?")
            })
            tinymce.init({
                selector: '.post',
                menubar: false,
                plugins: [
                    'advlist autolink lists link image charmap print preview anchor',
                    'searchreplace visualblocks code fullscreen',
                    'insertdatetime media table paste code help wordcount'
                ],
                toolbar: 'undo redo | formatselect | ' +
                'bold italic backcolor | alignleft aligncenter ' +
                'alignright alignjustify | bullist numlist outdent indent | ' +
                'removeformat | help',
                content_css: '//www.tiny.cloud/css/codepen.min.css'
            });
        })

        

        /*
        $("#ajaxbtn").on("click", function(){
            $.get(
                "index.php?action=ajax",
                {
                    nb : $("#nbajax").text()
                },
                function(result){
                    $("#nbajax").html(result)
                }
            )
        })*/
    </script>
</body>
</html>