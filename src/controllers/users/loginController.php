<?php 

if (!empty($_POST['email']) && !empty($_POST['pwd'])){

    if (checkAlreadyExistEmail()){
        $accessUser = checkUserAccess();
        if (!empty($accessUser)) {


            $_SESSION['user'] = 
            [
                'id'=> $accessUser,
                'lastLogin' => date('Y-m-d H:i:s')
                
            ];

            saveLastLogin($accessUser);

            alert('Vous êtes connecté', 'success');
            header ('Location: ' . $router->generate('displayMovie'));
            die;

        } else {

            alert('Identifiants incorrects');

        }

    } else {

        alert('Identifiants incorrects');

    }
    
}