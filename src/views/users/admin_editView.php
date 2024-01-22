<?php 

get_header('Editer un utilisateur', 'admin'); 

if (isset($_GET['id'])){
    $title = 'Editer';
} else {
    $title = 'Ajouter';
};

?>

<h1 class="mb-4"><?= $title ?> un compte: </h1>

<form action="" method="post" novalidate>
    
    <div class="mb-4">
        <?php $error = checkEmptyFields('nickname'); ?>
        <label for="nickname" class="form-label">Pseudo : *</label>
        <input type="nickname" name="nickname" id="nickname" value="<?= getValue('nickname') ?>" class="form-control <?= $error['class']; ?>">
        <?= $error['message']; ?>
        <p class = "<?= $usersMessage['nickname']['class'] ?>"><?= $usersMessage['nickname']['message']; ?></p>
    </div>
    <div class="mb-4">
        <?php $error = checkEmptyFields('email'); ?>
        <label for="email" class="form-label">Adresse email : *</label>
        <input type="email" name="email" id="email" value="<?= getValue('email') ?>" class="form-control <?= $error['class']; ?>">
        <?= $error['message']; ?>
        <p class = "<?= $usersMessage['email']['class'] ?>"><?= $usersMessage['email']['message']; ?></p>
    </div>
    <div class="mb-4">
        <?php $error = checkEmptyFields('pwd'); ?>
        <label for="pwd" class="form-label">Mot de passe : *</label>
        <input type="text" name="pwd" id="pwd" class="form-control <?= $error['class']; ?>">
        <p class="form-text mb-0">Le mot de passe doit contenir au moins: 10 caractères dont au moins 1 majuscule, 1 minuscule, un chiffre et un caractère spécial</p>
        <?= $error['message']; ?>
        <p class = "<?= $usersMessage['pwd']['class'] ?>"><?= $usersMessage['pwd']['message']; ?></p>
    </div>
    <div class="mb-4">
        <?php $error = checkEmptyFields('pwd-confirm'); ?>
        <label for="pwd-confirm" class="form-label">Confirmation du mot de passe : *</label>
        <input type="text" name="pwd-confirm" id="pwd-confirm" class="form-control <?= $error['class']; ?>">
        <?= $error['message']; ?>
        <p class = "<?= $usersMessage['pwd-confirm']['class'] ?>"><?= $usersMessage['pwd-confirm']['message']; ?></p>
    </div>
    <div>
        <input type="submit" class="btn btn-primary" value="Sauvegarder">
    </div>
</form>

<?php get_footer('admin'); ?>