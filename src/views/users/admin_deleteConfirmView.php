<?php get_header('Editer un utilisateur', 'admin'); ?>

<div class="position-absolute top-50 start-50 translate-middle">
  <div class="card" style="width: 18rem;">
    <div class="card-body">
      <h5 class="card-title">Etês vous certain de vouloir supprimer cet utilisateurs?</h5>
      <a href="<?= $router -> generate ('admin_display'); ?>" class="card-link btn btn-secondary m-3">Annuler</a>
      <a href="<?= $router -> generate('admin_delete', ['id' => $_GET['id']]); ?>" class="card-link btn btn-danger">Supprimer</a>
    </div>
  </div>
</div>

<?php get_footer('admin'); ?>