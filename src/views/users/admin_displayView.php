<?php get_header('Liste des utilisateurs', 'admin'); ?>

<table class="table">
  <thead>
    <tr>
      <th scope="col">Pseudo:</th>
      <th scope="col">Utilisateur:</th>
      <th scope="col">Creation:</th>
      <th scope="col">Mis à jour:</th>
      <th scope="col">Editer</th>
      <th scope="col">Supprimer</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($users as $user) { ?>
        <tr>
          <td><?= $user['nickname'] ?></td>
          <td><?= $user['email'] ?></td>
          <td><?= $user['created'] ?></td>
          <td><?= $user['updated'] ?></td>
          <td><a href="<?= $router->generate('admin_edit') . '/' . $user['id']?>">Editer</a></td>
          <td><a href="<?= $user['id'] ?>">Supprimer</a></td>
        </tr>
    <?php } ?>
  </tbody>
</table>

<?php get_footer('admin'); ?>
