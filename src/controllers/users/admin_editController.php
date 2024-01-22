<?php

$usersMessage = [
    'nickname' => 
    [
        'class' => false,
        'message' => false,
        'status' => false
    ],

    'email' => 
    [
        'class' => false,
        'message' => false,
        'status' => false 
    ],

    'pwd' => 
    [
        'class' => false,
        'message' => false,
        'status' => false 
    ],

    'pwd-confirm' => 
    [
        'class' => false,
        'message' => false,
        'status' => false 
    ],

    'status' =>
    [
        'class' => false,
        'message' => false
    ]
];

if (!empty($_POST)) {
    // Rules for email field
    if(!empty($_POST['email'])){

        if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){

            $usersMessage['email']['class'] = 'text-danger';
            $usersMessage['email']['message'] = 'L\'adresse email n\'est pas valide';
            $usersMessage['email']['status'] = true;

        } else if (checkAlreadyExistEmail()){

            $usersMessage['email']['class'] = 'text-danger';
            $usersMessage['email']['message'] = 'L\'adresse email existe déjà dans la base de données.';
            $usersMessage['email']['status'] = true;

        }

    }

    // Rules for nickname field
    if (!empty($_POST['nickname'])){

        if (checkAlreadyExistNickname()){

            $usersMessage['nickname']['class'] = 'text-danger';
            $usersMessage['nickname']['message'] = 'Le pseudo existe déjà dans la base de données.';
            $usersMessage['nickname']['status'] = true;

        }

    } else {

        $usersMessage['nickname']['class'] = 'text-danger';
        $usersMessage['nickname']['message'] = 'Merci de renseigner un pseudo';
        $usersMessage['nickname']['status'] = true;

    };

    // Check pwd correspondence and force

    if (!empty($_POST['pwd'])){

        $pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\W).{10,}$/';

        if (!preg_match($pattern, $_POST['pwd'])){

            $usersMessage['pwd']['class'] = 'text-danger';
            $usersMessage['pwd']['message'] = 'Merci de respecter le format indiqué.';
            $usersMessage['pwd']['status'] = true;


        } else if($_POST['pwd'] !== $_POST['pwd-confirm']) {

            $usersMessage['pwd-confirm']['class'] = 'text-danger';
            $usersMessage['pwd-confirm']['message'] = 'Les mots de passe saisis ne sont pas identiques';
            $usersMessage['pwd-confirm']['status'] = true;

        }


    }

    // Save user in the database


    if (!empty($_POST['email']) && !empty($_POST['email']) && !empty($_POST['pwd']) && !empty($_POST['pwd-confirm'])){


        if ($usersMessage['nickname']['status'] !== true &&
        $usersMessage['email']['status'] !== true &&
        $usersMessage['pwd']['status'] !== true &&
        $usersMessage['pwd']['status'] !== true
        ){
            if(!empty($_GET['id'])){

                updateUser();
                alert('Un utilisateur a bien été modifié', 'success');

            } else {

                addUser('Un utilisateur a été ajouté avec success');
                
            }


        } else {

            alert('Erreur lors de l\'ajout de l\'utilisateur', 'danger');

        }
     
    } else {

        alert('Merci de remplir toutes les champs obligatoires.');

    }

}
