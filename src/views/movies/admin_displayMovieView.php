<?php  

get_header('Films', 'admin') ; 

?>


<div class="d-flex justify-content-sm-between flex-wrap">
  <?php foreach ($movies as $movie) { ?>

    <div class="card m-5" style="width: 34rem;">
      <img src="/<?= htmlentities($movie['poster']) ?>" class="card-img-top" alt="<?= htmlentities($movie['title']) ?>">
      <div class="card-body">
        <h5 class="card-title"><?= htmlentities($movie['title']) ?></h5>
      </div>
      <ul class="list-group list-group-flush">
        <li class="list-group-item">Réalisateur: <?= htmlentities($movie['director']) ?></li>
        <li class="list-group-item">Categorie: <?= htmlentities($movie['categories']) ?></li>
        <li class="list-group-item">Durée: <?= htmlentities($movie['duration']) ?> min</li>
        <li class="list-group-item">Date de sortie: <?= htmlentities($movie['release_date']) ?></li>
        <li class="list-group-item">Casting: <?= htmlentities($movie['casting']) ?></li>
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