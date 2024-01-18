<?php 


/**
* Add a user in the database
*/

function addUser (): bool
{

    global $db;
    $data = [
        'email' => $_POST['email'],
        'pwd' => password_hash($_POST['pwd'], PASSWORD_DEFAULT),
        'role_id' => 1
    ];

    $sql = 'INSERT INTO users (email, pwd, role_id) values (:email, :pwd, :role_id)';
    $query = $db -> prepare($sql);
    $query ->execute($data);


    return true;
};


    

/**
* Check if the email already exists in the database
*  
*/

function checkAlreadyExistEmail(): mixed
{

    global $db;
    $sql = 'SELECT id FROM users WHERE email = :email';
    $query = $db->prepare($sql);
    $query->bindParam(':email', $_POST['email'], PDO::PARAM_STR);
    $query->execute();

    return $query -> fetch();

};

function updateUser()
{

    global $db;
    $data = [
        'email' => $_POST['email'],
        'pwd' => password_hash($_POST['pwd'], PASSWORD_DEFAULT),
        'id' => $_GET['id']
    ];

    $sql = 'UPDATE users SET email = :email, pwd = :pwd WHERE id = :id';
    $query = $db -> prepare($sql);
    $query ->execute($data);

};



