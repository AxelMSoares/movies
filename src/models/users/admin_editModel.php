<?php 


/**
* Add a user in the database
*/

function addUser ()
{

    global $db;
    $data = [
        'nickname' => $_POST['nickname'],
        'email' => $_POST['email'],
        'pwd' => password_hash($_POST['pwd'], PASSWORD_DEFAULT),
        'role_id' => 1
    ];

    try {

        $sql = 'INSERT INTO users (id, nickname, email, pwd, role_id) values (UUID(), :nickname, :email, :pwd, :role_id)';
        $query = $db -> prepare($sql);
        $query ->execute($data);
        alert('Un utilisateur a bien été ajouté.', 'success');

    } catch (PDOException $e){

        if ($_ENV['DEBUG'] == 'true'){

            dump($e->getMessage());
            die;

        } else {

            alert('Une erreur est survenue. Merci de réessayer plus tard','danger');

        }

    }

    
};


/**
* Check if the nickname already exists in the database
*  
*/

function checkAlreadyExistNickname(): mixed
{

    global $db;

    if (!empty($_GET['id'])) {

        $nickname = getUsersInfosById()->nickname;

        if($nickname === $_POST['nickname']){
            return false;
        }

    }
    
    $sql = 'SELECT id FROM users WHERE nickname = :nickname';
    $query = $db->prepare($sql);
    $query->bindParam(':nickname', $_POST['nickname'], PDO::PARAM_STR);
    $query->execute();

    return $query -> fetch();

};


/**
* Update a user where id = :id
*/
function updateUser()
{

    global $db;
    $data = [
        'nickname' => $_POST['nickname'],
        'email' => $_POST['email'],
        'pwd' => password_hash($_POST['pwd'], PASSWORD_DEFAULT),
        'id' => $_GET['id']
    ];

    try {
        
        $sql = 'UPDATE users SET nickname = :nickname, email = :email, pwd = :pwd WHERE id = :id';
        $query = $db -> prepare($sql);
        $query ->execute($data);
        alert('L\'utilisateur a bien été modifié.', 'success');

    } catch (PDOException $e){

        if ($_ENV['DEBUG'] == 'true'){

            dump($e->getMessage());
            die;

        } else {

            alert('Une erreur est survenue. Merci de réessayer plus tard','danger');

        }

    }
};

/**
* Get users info by id
*/
function getUsersInfosById(){
    
    global $db;

    $user_id = $_GET['id'];
    
    try {
    $query = "SELECT nickname, email FROM users where id = :id";
    $statement = $db -> prepare($query);
    $statement -> bindParam('id', $user_id);
    $statement -> execute ();
    return $statement->fetch();

    } catch (PDOException $e) {

        if ($_ENV['DEBUG'] == 'true'){

            dump($e->getMessage());
            die;

        } else {

            alert('Une erreur est survenue. Merci de réessayer plus tard','danger');

        }

    }
}



