<?php
// Le fichier header.php est inclus dans la page
require_once(__DIR__.'/partials/header.php');
    
//récupère la liste des films
    $query = $db->query('SELECT * FROM movie ORDER BY RAND() LIMIT 4');
    $random = $query->fetchall();

    ?>

<main class="container">
    <h1 class="page_title">Proposition aléatoire de films.</h1><br>

        <div class="row">
            <?php foreach($random as $movie) { ?>
                <div class="affiche-random">
                    <h5><?php echo $movie['title'];?></h5>
                    <img src=" <?php echo 'assets/'.$movie['cover'];?>">
                    
                <div class="bouton_div">
                    <!-- bouton pour commander -->
                    <a href="movie_single.php?id=<?php echo $movie['id'];?>" class="btn btn-color-command">Voir le film</a>
                </div>
            </div>
                <?php } ?>

        </div>
 