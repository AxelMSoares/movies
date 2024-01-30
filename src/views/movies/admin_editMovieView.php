<?php  

get_header('Créer un film', 'admin') ; 

?>

<div class="container mb-5" style="max-width: 400px" >
    <form action="" method="post" enctype="multipart/form-data" novalidate>

        <?php if (isset($error)) { ?>
            <div class="m-2 alert alert-danger"><?= $error ?></div>
        <?php } ?>
        <?php if (isset($success)) { ?>
            <div class="m-2 alert alert-success"><?= $success ?></div>
        <?php } ?>

        <div class="input-group mb-3">
          <label class="input-group-text" for="poster">Affiche:</label>
          <input type="file" class="form-control" id="poster" name="poster">
        </div>
        <div class="mb-3">
            <?php $error = checkEmptyFields('title'); ?>
            <label for="title" class="form-label">Titre du film: *</label>
            <input type="text" class="form-control <?= $moviesMessage['title']['class'] ?>" id="title" name="title" value="<?= getValue('title') ?>" required>
            <div class="invalid-feedback"><p> <?= $moviesMessage['title']['message'] ?></p></div>
            <?= $error['message']; ?>
            
        </div>
        <div class="mb-3">
            <label for="categories" class="form-label">Categories:</label>
            <input type="text" class="form-control" id="categories" name="categories" value="<?= getValue('categories') ?>">
        </div>
        <div class="mb-3">
            <?php $error = checkEmptyFields('release_date'); ?>
            <label for="release_date" class="form-label">Date Sortie: *</label>
            <input type="date" class="form-control  <?= $moviesMessage['release_date']['class'] ?>" id="release_date" name="release_date" max="31-12-2024" required pattern="\d{4}-\d{2}-\d{2}"  value="<?= getValue('release_date') ?>">
            <div class="invalid-feedback"><p> <?= $moviesMessage['release_date']['message'] ?></p></div>
            <?= $error['message']; ?>
        </div>
        <div class="mb-3">
            <label for="duration" class="form-label">Durée: (en minutes)</label>
            <input type="number" class="form-control  <?= $moviesMessage['duration']['class'] ?>" id="duration" name="duration"  value="<?= getValue('duration') ?>" max="600">
            <div class="invalid-feedback"><p> <?= $moviesMessage['duration']['message'] ?></p></div>
        </div>
        <div class="mb-3">
            <label for="director" class="form-label">Réalisateur:</label>
            <input type="text" class="form-control" id="director" name="director"  value="<?= getValue('director') ?>">
        </div>
        <div class="mb-3">
            <label for="casting" class="form-label">Casting:</label>
            <input type="text" class="form-control" id="casting" name="casting"  value="<?= getValue('casting') ?>">
        </div>
        <div class="mb-3">
            <?php $error = checkEmptyFields('synopsis'); ?>
            <label for="synopsis" class="form-label">Description: *</label>
            <textarea class="form-control <?= $moviesMessage['synopsis']['class'] ?>" id="synopsis" name="synopsis" style="resize:none;height:180px;" required><?= getValue('synopsis') ?></textarea>
            <?= $error['message']; ?>
        </div>
        <div class="text-center">
            <button type="Submit" class="btn btn-primary" style="align-self:center">Envoyer</button>
        </div>
    </form>
</div>

<?php get_footer('admin'); ?>


