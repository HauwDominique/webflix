# webflix en PHP uniquement (pas de Symfony)

On veut créer un nouveau Netflix pour le web. 

Projet :
- créer un dépôt Github -- OK FAIT
- Faire le lien entre le dépôt local -- OK FAIT
- Penser à la BDD -- OK FAIT

Pages :

---PARTIE 1--- OK
- Accueil (index.php) -> Liste de films triés par cagégorie --OK

- Voir un film (movie_single.php?id=4) -> On peut voir un film --OK
- Ajouter un film (movie_add.php) -> On peut ajouter un film dans la BDD --OK

---PARTIE 2 ---
- Modifier un film (movie_edit.php?id=4) -> On peut modifier un film dans la BDD --OK
- Supprimer un film (movie_delete.php?id=4) -> On peut supprimer un film dans la BDD. On doit avoir un bouton supprimer sur la liste des films, on clique, on supprime le film en question et on revient sur la liste des films --OK
- Film rando (movie_random.php) -> On affiche 4 films de manière aléatoire --OK

--- PARTIE 3 ---
- Inscription (register.php) -> Formulaire d'inscription (email, username, mot de passe, confirmer le mot de passe)
- Connexion (login.php)-> Formulaire de connexion (email, mot de passe)

--- PARTIE 4 ---
- Les pages Voir, Ajouter, Modifier et Supprimer un film ne sont accessible que par quelqu'un qui est connecté

---PARTIE 5 ---
- Mot de passe oublié  (forget.php) -> 1er formulaire où on saisit l'email, s'il existe, on envoie un lien à l'utilisateur par mail pour redéfinir son mot de passe. Ce lien doit être unique et optionnellement valide seulement 24h (sinon 404). Si le lien est valide, on arrive sur un 2eme forlumaire où on redéfinit son mot de passe (mot de passe, confirmer le mot de passe)


Structure

BDD :
- Movie : id, title, description, video_link, cover, released_at, category_id -- OK FAIT
- Category : id, name -- OK FAIT
- User : id, username, email, password, token, token_expiration