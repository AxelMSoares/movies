<?php

/**
 * Check the user access by his email and his pwd
 */
function checkUserAccess() : mixed
{

    global $db;
    $sql = 'SELECT id, pwd FROM users WHERE email = :email';
    $query = $db->prepare($sql);
    $query -> execute(['email' => $_POST['email']]);

    $user = $query->fetch();
     
    
    if (password_verify($_POST['pwd'], $user -> pwd)) {

        return $user -> id;

    } else {

        return false;

    }

}

/**
 * Save in the database the last time a user has loggin
 * @param string $userId
 * @return void
 */
function saveLastLogin(string $userId) : void
{

    global $db;
    $sql = 'UPDATE users SET lastLogin = NOW() WHERE id = :id';
    $query = $db->prepare($sql);
    $query->execute(['id' => $userId]);

}

/**
 * Login function, start the user session and save his last connection and redirect to display movie page
 * @param int $accessUser the user id
 * @param mixed the router
 * @return mixed Return a alert
 */
function successfulLogin($accessUser, $router) {

    // Démarrer la session utilisateur et enregistrer l'heure de la connexion
    $_SESSION['user'] = [
        'id'=> $accessUser,
        'lastLogin' => date('Y-m-d H:i:s')
    ];

    // Effacer le compteur de tentatives de connexion
    unset($_SESSION['login_attempts']);

    // Enregistrer la dernière connexion
    saveLastLogin($accessUser);

    alert('Bienvenue!', 'success');

    // Rediriger l'utilisateur vers la page d'accueil
    header ('Location: ' . $router->generate('displayMovie'));
    die;
}

/**
* Login failed function, start a count of the login attempts and save the time of the last login attempt
*/

function failedLogin() {

    // Verify if the login_attemps key exist in the function
    if (!isset($_SESSION['login_attempts'])) {

        $_SESSION['login_attempts'] = 0; // If the key dont exist, make one started at zero

    } else {

        $_SESSION['login_attempts']++; // If the counter exist, increment
        $_SESSION['lastLogin_attempts'] = time(); // Save the last loggin attempt (HH:MM:SS)

    }

}




