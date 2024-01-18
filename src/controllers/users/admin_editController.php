<?php

$errorsMessage = [
    'email' => false,
    'pwd' => false,
    'pwd-confirm' => false
];

if (!empty($_POST)) {
    // Rules for email field
    if(!empty($_POST['email'])){

        if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){

            $errorsMessage['email'] = 'L\'adresse email n\'est pas valide';

        } else if (checkAlreadyExistEmail()){

            $errorsMessage['email'] = 'L\'adresse email existe déjà dans la base de données.';

        }

    }

    // Check pwd correspondence and force

    if (!empty($_POST['pwd'])){

        $pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\W).{10,}$/';

        if (!preg_match($pattern, $_POST['pwd'])){

            $errorsMessage['pwd'] = 'Merci de respecter le format indiqué.';

        } else if($_POST['pwd'] !== $_POST['pwd-confirm']) {

            $errorsMessage['pwd-confirm'] = 'Les mots de passe saisis ne sont pas identiques';

        }


    }

    // Save user in the database


        if (!empty($_POST['email']) && !empty($_POST['pwd']) && !empty($_POST['pwd-confirm'])){

            if (!$errorsMessage['email'] && !$errorsMessage['pwd'] && !$errorsMessage['pwd']){

                if(!empty($_GET['id'])){
                    updateUser();
                }else {
                    addUser();
                }

            } else {

               alert('Erreur lors de l\'ajout de l\'utilisateur');
            }

        } else {
            alert('Merci de remplir toutes les champs obligatoires.');
        }
}