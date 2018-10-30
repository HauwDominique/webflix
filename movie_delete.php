<?php
// Le fichier header.php est inclus dans la page
require_once(__DIR__.'/partials/header.php');
    
//récupère la liste des films
$query2 = $db->query('SELECT * FROM movie');
$movies = $query2->fetchall();

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

?>

<main class="container">

    <h1 class="page_title">Suppression du film</h1><br>

    <div class="row row_single_movie">

        <div class="col-md-9">
            <h3 class="title_movie">
                <?php echo $movie['title'];?>
            </h3>
        </div>

        <div class="col-md-3">
            <img src="assets/<?php echo $movie['cover'];?>" alt=<?php $movie['title'];?> class="img-fluid">
        </div>

        <!-- bouton pour supprimer -->
        <a href="#movie_delete.php?id=<?php echo $movie['id'];?>" class="btn btn-danger">Souhaitez-vous vraiment supprimer le film ?</a>

    </div>



</main>