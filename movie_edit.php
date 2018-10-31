<?php
// Le fichier header.php est inclus dans la page
require_once(__DIR__.'/partials/header.php');

$id = isset($_GET['id']) ? $_GET['id'] : 0;
    
    //récupère la liste des films
    $query = $db->prepare('SELECT * FROM movie WHERE id=:id');
    $query->bindValue(':id', $id, PDO::PARAM_STR);
    $query->execute();
    $movie = $query->fetch();
    var_dump($movie);


// Le fichier header.php est inclus dans la page
require_once(__DIR__.'/partials/header.php');

// on déclare les variables utiles à chaque champs.
$title = $movie['title'];
$description = $movie['description'];
$category = $movie['category_id'];
$released_at = $movie['released_at'];
$cover = $movie['cover'];
$video_link = $movie['video_link'];

// var_dump($_POST);

		// $message = null;
        if (!empty($_POST)) { // $post Récupére les informations saisies dans le formulaire
		    $title = $_POST['title']; 
            $description = $_POST['description'];
            $category = $_POST['category'];
            $released_at = $_POST['released_at'];
            $video_link = $_POST['video_link'];
            $cover = $_FILES['cover']; //ATTENTION ICI IL FAUT PENSER A METTR $_FILES pour les images

            // $message = $_POST['message'];
            
			$errors = [];

		    if (empty($title)) {
		    	$errors['title'] = 'Le titre ne doit pas être vide. <br />';
		        // echo 'Le titre ne doit pas être vide. <br />';
            }
            if (empty($description)) {
		    	$errors['description'] = 'Le champ description ne doit pas être vide. <br />';
            }
            if (empty($category)) {
		    	$errors['category'] = 'Le champ catégorie ne doit pas être vide. <br />';
            }
            if (empty($released_at)) {
		    	$errors['released_at'] = 'Le champ date de sortie ne doit pas être vide. <br />';
            }
            if (empty($video_link)) {
		    	$errors['video_link'] = 'Le champ lien vers la vidéo ne doit pas être vide. <br />';
            }
            if (empty($cover)) {
		    	$errors['cover'] = 'Le champ image doit avoir une image de sélectionnée. <br />';
            }

            // upload de l'image
            if (empty($errors)) {
                var_dump($cover);
                $file=$cover['tmp_name'];//emplacement du fichier temporaire
                $fileName='img/'.$cover['name'];// variable pour la  base de donnée
            }
    
                $info=finfo_open(FILEINFO_MIME_TYPE);//permet d'ouvrir un fichier pour analyser sont type
                $mimeType = finfo_file($info, $file); //ouvre le fichier et renvoie image/jpg
                $allowedExtensions= ['image/jpg', 'image/jped', 'image/gif', 'image/png'];
                
                // si l'extension n'est pas autorisée, il y a une erreur
                if(in_array($mimeType, $allowedExtensions)){
                    $errors['cover']='ce type de fichier n\'est pas autorisé';
                }

                // vérifier la taille de l'image
                if($cover['size']/1024 > 100) {
                    $errors['cover'] = 'l\image est trop lourde';
                }

                if(!isset($errors['cover'])) {
                    move_uploaded_file($file, __DIR__.'/assets/'.$fileName);
                    //on déplace le fichier upload où on le souhaite
                }
            // }

                // S'il n'y a pas d'erreurs dans le formulaire
            if (empty($errors)) {
                $query = $db->prepare("
                UPDATE movie SET title=:title, description=:description, video_link=:video_link, cover=:cover, released_at=:released_at, category_id=:category WHERE id=$id;");
                $query->bindValue(':title', $title, PDO::PARAM_STR);
                $query->bindValue(':description', $description, PDO::PARAM_STR);
                $query->bindValue(':video_link', $video_link, PDO::PARAM_STR);
                $query->bindValue(':cover', $fileName, PDO::PARAM_STR);
                $query->bindValue(':released_at', $released_at, PDO::PARAM_STR);
                $query->bindValue(':category', $category, PDO::PARAM_STR);

    
                if ($query->execute()) { // On insère le film dans la BDD
                    $success = true;
                    // Envoyer un mail ?
                    // Logger la création du film
                }
            }
        }

?>

<main class="container">

    <h1 class="page_title">Modifier un film dans le catalogue.</h1><br>
    
    <form method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col">

            <!-- champ titre du film -->
                <label for="title" class='label_title'>Titre du film</label>
                <input class="form-control <?= (isset($errors['title'])) ? 'is-invalid' : ''; ?>" type="text" name="title" id="title"
                value="<?= $title; ?>" />
                <div class="invalid-feedback">
                    <?php echo (isset($errors['title'])) ? $errors['title']: ''; ?>
                </div>

            <!-- champ de description -->
                <label for="description" class='label_title'>Description du film</label>

                <textarea name="description" id="description" rows="8" class="form-control <?php echo isset($errors['description']) ? 'is-invalid' : ''; ?>"><?php echo $description; ?></textarea>

                <?php if (isset($errors['description'])) {
                    echo '<div class="invalid-feedback">';
                        echo $errors['description'];
                    echo '</div>';
                } ?>
            </div>

<!-- changement de colonne -->

        <div class="col">
                <!-- champs categorie du film-->
                <label for="category" class='label_title'>Catégorie</label>
                <select class="form-control col-6<?= isset($errors['category']) ? 'is-invalid' : '';?>" name="category">
                    <option value="">Choisissez la catégorie</option>
                    <option  <?php echo ($category === '1') ? 'selected' : ''; ?> value="1">Science fiction</option>
                    <option  <?php echo ($category === '2') ? 'selected' : ''; ?> value="2">Comédie</option>
                    <option  <?php echo ($category === '3') ? 'selected' : ''; ?> value="3">Action</option>
                </select>
                <div class="invalid-feedback">
                    <?php echo (isset($errors['category'])) ? $errors['category']: ''; ?>
                </div>
               
                <!-- champs date de sortie du film-->
                <label for="released_at" class='label_title'>Date de sortie du film</label>
                <input class="form-control <?= (isset($errors['released_at'])) ? 'is-invalid' : ''; ?>" type="text" 
                name="released_at" id="released_at" value="<?= $released_at; ?>" />
                <div class="invalid-feedback">
                    <?php echo (isset($errors['released_at'])) ? $errors['released_at']: ''; ?>
                </div>

                <!-- champ cover du film -->
                <label for="cover" class='label_title' >Affiche du film</label>
                <input type="file" class="form-control <?= (isset($errors['cover'])) ? 'is-invalid' : ''; ?>" name="cover"
                    id="cover"/>

                <div class="invalid-feedback">
                    <?php echo (isset($errors['cover'])) ? $errors['cover']: ''; ?>
                </div>

                <!-- champ lien du film -->
                <label for="video_link" class='label_title'>Lien de la vidéo du film</label>
                    <input class="form-control <?= (isset($video_link['released_at'])) ? 'is-invalid' : ''; ?>" type="text" 
                    name="video_link" id="video_link" value="<?= $video_link; ?>" />
                    <div class="invalid-feedback">
                        <?php echo (isset($errors['video_link'])) ? $errors['video_link']: ''; ?>
                    </div>

            </div>
        </div>
    </div>

    <button type="submit" class="btn btn-bkg-color form-control">Modifiez votre film</button>



    </form>
</main>