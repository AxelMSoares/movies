<?php  

get_header('Catégories', 'admin'); 

?>

<div class="container mb-5" style="max-width: 400px">
    <form action="" method="post">
        <h1 class="mb-5"><?= $variables['title']; ?>catégorie:</h1>
        <div class="mb-3">
            <label for="name" class="form-label">Nom de la catégorie:</label>
            <input type="text" class="form-control" id="name" name="name" value="<?= getValue('name'); ?>">
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary" style="align-self:center"><?= $variables['button'] ?></button>
        </div>
    </form>
</div>


<?php get_footer('admin'); ?>