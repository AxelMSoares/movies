<?php  

get_header('Films', 'admin') ; 

?>


<div class="d-flex justify-content-sm-between flex-wrap">
  <?php foreach ($movies as $movie) { ?>

    <div class="card m-5" style="width: 34rem;">
      <img src="..." class="card-img-top" alt="<?= $movie['title'] ?>">
      <div class="card-body">
        <h5 class="card-title"><?= $movie['title'] ?></h5>
      </div>
      <ul class="list-group list-group-flush">
        <li class="list-group-item">Réalisateur: <?= $movie['director'] ?></li>
        <li class="list-group-item">Categorie: <?= $movie['categories'] ?></li>
        <li class="list-group-item">Durée: <?= $movie['duration'] ?> min</li>
        <li class="list-group-item">Date de sortie: <?= $movie['release_date'] ?></li>
        <li class="list-group-item">Casting: <?= $movie['casting'] ?></li>
        <li class="list-group-item">Description: Modifier pour voir</li>
      </ul>
      <div class="card-body">
        <a href="<?= $router->generate('deleteMovie'); ?><?= $movie['id'] ?>" class="card-link btn btn-danger">Supprimer</a>
        <a href="<?= $router->generate('editMovie'); ?>/<?= $movie['id'] ?>" class="card-link btn btn-primary">Modifier</a>
      </div>
    </div>

  <?php } ?>
</div>

<?php get_footer('admin'); ?>