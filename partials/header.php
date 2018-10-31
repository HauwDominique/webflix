<?php

// inclusion du fichier config (qui contient les variables globales au site)
require_once(__DIR__.'/../config/config.php');

  // inclusion du fichier database
  require_once(__DIR__.'/../config/database.php');

?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Accueil Webflix</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-color section-nav">
    <h3 class="siteName">Webflix</h3>
  <!-- <a class="navbar-brand" href="#">Accueil</a> -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
    <li class="nav-item <?php echo $currentPageUrl === 'index' ? 'active' : ''; ?>">
            <a class="nav-link" href="index.php">Accueil</a>
          </li>

      <!-- <li class="nav-item active">
        <a class="nav-link" href="#">Voir un film <span class="sr-only">(current)</span></a>
      </li> -->
      <!-- <li class="nav-item">
        <a class="nav-link" href="movies_single.php">Voir un film</a>
      </li> -->
      <li class="nav-item">
        <a class="nav-link" href="movie_add.php">Ajouter un film</a>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#">Se connecter</a>
      </li>
    </ul>
  </div>
</nav>

</body> 
</html>