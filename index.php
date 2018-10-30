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
    <h1 class="page_title">Bienvenue sur Webflix, le site dédié au cinéma et aux séries.</h1>

    <div class="row">
        <?php
        // on affiche les catégories
        foreach($categorys as $category) { ?>
            <div class="col-md-4">
                <h3 class="nameCategory"><?php echo $category['name'];?></h3>
        
        <?php foreach($movies as $movie) { ?>
            <?php if($movie['category_id'] == $category['id']) { ?>
              <h5> <?php echo $movie['title'];?></h5>
              <img src=" <?php echo 'assets/'.$movie['cover'];?>">
               <a href="movie_single.php?id=<?php echo $movie['id'];?>" 
            class="btn btn-danger">Commandez</a>
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