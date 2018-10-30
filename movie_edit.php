<?php
// Le fichier header.php est inclus dans la page
require_once(__DIR__.'/partials/header.php');
    
//récupère la liste des catégories
    $query = $db->query('SELECT * FROM category');
    $categorys = $query->fetchall();

    //récupère la liste des films
    $query2 = $db->query('SELECT * FROM movie');
    $movies = $query2->fetchall();

?>

<main>

    <h1 class="page_title">Modification du film</h1><br>



</main>