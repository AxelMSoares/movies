<?php 

if (!empty($_POST['email']) && !empty($_POST['pwd'])) {


    if (!empty($_POST['nickname'])) {

        // Honeyspot
        alert('Bienvenue admin', 'success');
        header ('Location:' . $router -> generate('home'));
        

    } else if($_SESSION['login_attempts'] >= 4){

        alert('Trop de tentatives de connexion. Réessayez dans 5 minutes');
        // Rajouter un reset login_attempts avec un timer.

    } else {


        if (checkAlreadyExistEmail()) {

            $accessUser = checkUserAccess();

            if (!empty($accessUser)) {

                // Authentification réussie
                successfulLogin($accessUser, $router);

            } else {

                // Identifiants incorrects
                alert('Identifiants incorrects');
                failedLogin();

            }

        } else {

            // Identifiants incorrects
            alert('Identifiants incorrects');
            failedLogin();

        }

    }

}

if (!isset($_SESSION['login_attempts'])){

    $_SESSION['login_attempts'] = 0;
            
}