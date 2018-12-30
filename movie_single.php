<?php

// récupérer l'ID du film dans l'URL
$id = $_GET['id'];

// inclure la base de données
require_once(__DIR__.'/config/database.php');

// récupérer les informations du film
$query=$db->prepare('SELECT * FROM movie WHERE id = :id'); // :id est un paramètre
// $query=$db->prepare('SELECT * FROM pizza WHERE id = '.$id); // :id est un paramètre
$query->bindvalue(':id', $id, PDO::PARAM_INT); //Liaison des 2 valeurs entre elle (:id devient $id) 
// on s'assure que l'id est bien un entier
$query->execute(); //Execute la requête
$movie = $query->fetch();

// var_dump($movie);

// renvoyer une 404 si le film n'existe pas
if($movie === false){
    http_response_code(404);
    // on pourrait aussi rediriger l'utilisateur vers la liste des pizzas
    // header('location: pizza_list.php);
    require_once(__DIR__.'/partials/header.php'); ?>
<h1>404. Redirection dans 5 secondes...</h1>
<script>
    setTimeout(function () {
        window.location = 'index.php';
    }, 5000);
</script>

<?php require_once(__DIR__.'/partials/footer.php');
    die();
}

// Le fichier header.php est inclus dans la page
require_once(__DIR__.'/partials/header.php');
?>

<main class="container">

    <div class="row row_single_movie">

        <div class="col-md-9">
            <h3 class="title_movie">
                <?php echo $movie['title'];?>
            </h3>
            <p class="description_movie">
                <?php echo $movie['description'];?>
            </p>
            <p class="released_date"><span class="released_date_span">Date de sortie :</span>
                <?php echo $movie['released_at'];?>
            </p>
        </div>

        <div class="col-md-3">
            <img src="assets/<?php echo $movie['cover'];?>" alt=<?php $movie['title'];?> class="img-fluid">
        </div>
    </div>

<div class="embed-responsive embed-responsive-16by9">
<iframe class="embed-responsive-item" src="<?php echo $movie['video_link']?>" allowfullscreen></iframe>
</div>

</main>

<?php
// Le fichier footerer.php est inclus dans la page
require_once(__DIR__.'/partials/footer.php');
?>