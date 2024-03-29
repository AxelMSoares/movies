<?php get_header('Liste des utilisateurs', 'admin'); ?>

<table class="table">
  <thead>
    <tr>
      <th scope="col">Pseudo:</th>
      <th scope="col">Utilisateur:</th>
      <th scope="col">Creation:</th>
      <th scope="col">Mis à jour:</th>
      <th scope="col"> </th>
      <th scope="col"> </th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($users as $user) { ?>
        <tr>
          <td><?= htmlentities($user->nickname) ?></td>
          <td><?= htmlentities($user->email) ?></td>
          <td><?= htmlentities($user->created) ?></td>
          <td><?= htmlentities($user->updated) ?></td>
          <td><a class="card-link btn btn-primary" href="<?= $router->generate('admin_edit', ['id' => htmlentities($user->id)]); ?>">Editer</a></td>
          <td><a class="card-link btn btn-danger" href="<?= $router->generate('admin_deleteConfirm', ['id' => htmlentities($user->id)]); ?>">Supprimer</a></td>
        </tr>
    <?php } ?>
  </tbody>
</table>

<?php get_footer('admin'); ?>
