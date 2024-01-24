<?php 

if (!empty($_POST['email']) && !empty($_POST['pwd'])){

    $accessUser = checkUserAccess();
    if (!empty($accessUser)) {
        

        $_SESSION['user'] = $accessUser;
        alert('Vous êtes connecté', 'success');
        header ('Location: ' . $router->generate('displayMovie'));
        die;

    } else {

        alert('Identifiants incorrects');

    }
}