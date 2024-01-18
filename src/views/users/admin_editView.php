<?php get_header('Editer un utilisateur', 'admin'); ?>

<h1 class="mb-4">Editer un compte: </h1>

<form action="" method="post" novalidate>
    <div class="mb-4">
        <?php $error = checkEmptyFields('email'); ?>
        <label for="email" class="form-label">Adresse email : *</label>
        <input type="email" name="email" id="email" value="<?= getValue('email') ?>" class="form-control <?= $error['class']; ?>">
        <?= $error['message']; ?>
        <p class = "<?= $globalMessage['class'] ?>"><?= $errorsMessage['email']; ?></p>
    </div>
    <div class="mb-4">
        <?php $error = checkEmptyFields('pwd'); ?>
        <label for="pwd" class="form-label">Mot de passe : *</label>
        <input type="text" name="pwd" id="pwd" class="form-control <?= $error['class']; ?>">
        <p class="form-text mb-0">Le mot de passe doit contenir au moins: 10 caractères dont au moins 1 majuscule, 1 minuscule, un chiffre et un caractère spécial</p>
        <?= $error['message']; ?>
        <p class = "<?= $globalMessage['class'] ?>"><?= $errorsMessage['pwd']; ?></p>
    </div>
    <div class="mb-4">
        <?php $error = checkEmptyFields('pwd-confirm'); ?>
        <label for="pwd-confirm" class="form-label">Confirmation du mot de passe : *</label>
        <input type="text" name="pwd-confirm" id="pwd-confirm" class="form-control <?= $error['class']; ?>">
        <?= $error['message']; ?>
        <p class = "<?= $globalMessage['class'] ?>"><?= $errorsMessage['pwd-confirm']; ?></p>
    </div>
    <div>
        <input type="submit" class="btn btn-success" value="Sauvegarder">
    </div>
</form>

<?php get_footer('admin'); ?>