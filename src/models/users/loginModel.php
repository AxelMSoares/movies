<?php

function checkUserAccess()
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

function saveLastLogin(string $userId) : void
{

    global $db;
    $sql = 'UPDATE users SET lastLogin = NOW() WHERE id = :id';
    $query = $db->prepare($sql);
    $query->execute(['id' => $userId]);

}

// Login function, start the user session and save his last connection
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

// Login failed function, start a count of the login attempts and save the time of the last login attempt
function failedLogin() {

    // Vérifier si la clé 'login_attempts' existe dans la session
    if (!isset($_SESSION['login_attempts'])) {

        $_SESSION['login_attempts'] = 0; // Si elle n'existe pas, initialiser à 1

    } else {

        $_SESSION['login_attempts']++; // Si elle existe, incrémenter
        $_SESSION['lastLogin_attempts'] = time(); // Enregistrer l'heure de la dernière tentative de connexion (HH:MM:SS)

    }

}




