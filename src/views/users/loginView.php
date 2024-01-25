<?php  

get_header('Se connecter', 'login') ; 

?>

<style>
    html,
    body,
    .vertical-center {
        height: 100%;
    }

    .form-signin {
        max-width: 330px;
        padding: 1rem;
    }

    .form-signin .form-floating:focus-within {
        z-index: 2;
    }

    .form-signin input[type="email"] {
        margin-bottom: -1px;
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 0;
    }

    .form-signin input[type="password"] {
        margin-bottom: 10px;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
    }
</style>

<div class="d-flex align-items-center py-4 bg-body-tertiary vertical-center">
    <form class="form-signin w-100 m-auto" action="" method="post">
        <h1 class="h3 mb-3 fw-normal text-center">Se connecter</h1>
        <div class="d-none">
            <label for="nickname">Pseudo</label>
            <input type="text" class="form-control" id="nickname" placeholder="Pseudo" name="nickname">
        </div>
        <div class="form-floating">
            <?php $error = checkEmptyFields('email') ?>
            <input type="email" class="form-control <?= $error['class']; ?>" id="floatingInput" placeholder="Email" name="email">
            <label for="floatingInput">Email</label>
            <?= $error['message']; ?>
        </div>
        <div class="form-floating">
            <input type="password" class="form-control <?= $error['class']; ?>" id="floatingPassword" placeholder="Mot de passe" name="pwd">
            <label for="floatingPassword">Mot de passe</label>
            <?= $error['message']; ?>
        </div>
        <button class="btn btn-primary w-100 py-2" type="submit">Connexion</button>
        <p class="mt-4 mb-3 text-body-secondary text-center">
            <a href="<?= $router->generate('lostPassword'); ?>">Mot de passe oublié ?</a>
        </p>
        <?= $_SESSION['login_attempts'] ?>
    </form>
</div>


<?php get_footer('login'); ?>