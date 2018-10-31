<?php
// Le fichier header.php est inclus dans la page
require_once(__DIR__.'/partials/header.php');
    
//récupère la liste des catégories
    $query = $db->query('SELECT * FROM category');
    $categorys = $query->fetchall();

//récupère la liste des films
    $query2 = $db->query('SELECT * FROM movie');
    $movies = $query2->fetchall();

    // var_dump($movies);

    ?>

<main class="container">
    <h1 class="page_title">Bienvenue sur Webflix, le site dédié au cinéma et aux séries.</h1><br>

    <div class="row">
        <?php
        // on affiche les catégories
        foreach($categorys as $category) { ?>
        <div class="col-md-4">
            <h3 class="nameCategory">
                <?php echo $category['name'];?>
            </h3>
            <?php foreach($movies as $movie) { ?>
                <?php if($movie['category_id'] == $category['id']) { ?>
            <div class="affiche">
                <h5>
                    <?php echo $movie['title'];?>
                </h5>
                <img src=" <?php echo 'assets/'.$movie['cover'];?>">

            <div class="bouton_div">
            <!-- bouton pour commander -->
            <a href="movie_single.php?id=<?php echo $movie['id'];?>" class="btn btn-color-command">Voir un film</a>

            <!-- <div class="boutons"> -->
            <!-- bouton pour modifier -->
            <a href="movie_edit.php?id=<?php echo $movie['id'];?>" class="btn btn-color-modif">Modifier</a>

            <!-- bouton pour supprimer -->
            <a href="movie_delete.php?id=<?php echo $movie['id'];?>" class="btn btn-color-delete">Supprimer</a>
                    
            </div>
            </div>

            <?php } ?>

            <?php } ?>
        </div>
        <?php } ?>
    </div>

</main>


<?php
// Le fichier footerer.php est inclus dans la page
require_once(__DIR__.'/partials/footer.php');
?>