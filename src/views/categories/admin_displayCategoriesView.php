<?php

get_header('Catégories', 'admin'); 
$categories = getCategories();

?>

<a href="<?= $router->generate('editCategories'); ?>" class="btn btn-primary mt-5">Créer Nouvelle Catégorie</a>
<table class="table table-striped mt-3">
    <thead>
      <tr>
        <th scope="col">Catégories:</th>
        <th scope="col"></th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
        <?php foreach($categories as $categorie) { ?>
            <tr>
              <td><?= $categorie['name'] ?></td>
              <td><a class="btn btn-primary" href="<?= $router->generate('editCategories') . $categorie['id'] ?>">Editer</a></td>
              <td><a class="btn btn-danger" href="<?= $router->generate('deleteCategorie') . $categorie['id'] ?>">Supprimer</a></td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<?php get_footer('admin'); ?>