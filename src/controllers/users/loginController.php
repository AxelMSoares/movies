<?php 

if (!empty($_POST['email']) && !empty($_POST['pwd'])) {


    if (!empty($_POST['nickname'])) {

        // Honeyspot
        alert('Bienvenue admin', 'success');
        header ('Location: http://www.google.com');
        

    } else if($_SESSION['login_attempts'] >= 4){

        header('location:' . $router-> generate('home'));
        die;
        

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