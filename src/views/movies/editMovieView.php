<?php  

get_header('Créer un film', 'admin') ; 

?>

<div class="container mb-5" style="max-width: 400px">
    <form action="" method="post">

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
            <label for="title" class="form-label">Titre du film:</label>
            <input type="text" class="form-control" id="title" name="title" value="<?= getValue('title') ?>">
        </div>
        <div class="mb-3">
            <label for="cat" class="form-label">Categories:</label>
            <input type="text" class="form-control" id="cat" name="cat" value="<?= getValue('cat') ?>">
        </div>
        <div class="mb-3">
            <label for="release" class="form-label">Date Sortie:</label>
            <input type="date" class="form-control" id="release" name="release" max="31-12-2024" required pattern="\d{4}-\d{2}-\d{2}"  value="<?= getValue('release') ?>">
            <?php if (isset($dateErrorMsg)) { ?>
                <div class="invalid-feedback"><p><?= $dateErrorMsg ?></p></div>
            <?php } ?>
        </div>
        <div class="mb-3">
            <label for="duration" class="form-label">Durée: (en minutes)</label>
            <input type="number" class="form-control" id="duration" name="duration"  value="<?= getValue('duration') ?>" max="600">
            <?php if (isset($hourErrorMsg)) { ?>
                <div class="invalid-feedback"><p> <?= $hourErrorMsg ?></p></div>
            <?php } ?>
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
            <label for="synopsis" class="form-label">Description:</label>
            <textarea class="form-control" id="synopsis" name="synopsis" style="resize:none;height:180px;"><?= getValue('synopsis') ?></textarea>
        </div>
        <div class="text-center">
            <button type="Submit" class="btn btn-primary" style="align-self:center">Envoyer</button>
        </div>
    </form>
</div>

<?php get_footer('admin'); ?>


