<?php  

get_header('Films', 'admin') ; 

?>
<div>
  <form class="d-flex" role="search">
    <input class="form-control me-2" type="search" placeholder="Rechercher un film par son nom" aria-label="Search" name=search>
    <button class="btn btn-outline-success" type="submit">Rechercher</button>
  </form>
</div>
<div class="d-flex justify-content-sm-between flex-wrap">
  <?php foreach ($movies as $movie) { ?>
    <?php if (empty($_GET['search']) || searchByName($movie['title'], $_GET['search'])){ ?>
      <div class="card m-4" style="width: 16rem;">
        <img src="/<?= htmlentities($movie['poster']) ?>" class="img-fluid" style="width: 280px; height: 320px"alt="<?= htmlentities($movie['title']) ?>">
        <div class="card-body">
          <h5 class="card-title"><?= htmlentities($movie['title']) ?></h5>
        </div>
        <ul class="list-group list-group-flush">
          <li class="list-group-item">Réalisateur: <?= htmlentities($movie['director']) ?></li>
          <li class="list-group-item">Durée: <?= htmlentities($movie['duration']) ?> min</li>
          <li class="list-group-item">Date de sortie: <?= htmlentities($movie['release_date']) ?></li>
          <li class="list-group-item">Casting: <?= htmlentities($movie['casting']) ?></li>
          <li class="list-group-item">Description: Modifier pour voir</li>
        </ul>
        <div class="card-body">
          <a href="<?= $router->generate('deleteMovieConfirm'); ?><?= $movie['id'] ?>" class="card-link btn btn-danger">Supprimer</a>
          <a href="<?= $router->generate('editMovie'); ?>/<?= $movie['id'] ?>" class="card-link btn btn-primary">Modifier</a>
        </div>
      </div>
    <?php } ?>
  <?php } ?>
</div>

<?php get_footer('admin'); ?>