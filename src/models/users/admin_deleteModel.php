<?php

/**
 * Delete a user by its ID
 * @param int $_GET['id']
 */
function deleteUserById(){
    global $router;
    global $db;
    
    $user_id = $_GET['id'];


    try {

    $query = 'DELETE FROM users where id = :id';
    $statement = $db -> prepare($query);
    $statement -> bindParam('id', $user_id);
    $statement -> execute();

    } catch (PDOException $e){

        if ($_ENV('DEBUG') == 'true'){

            dump ($e -> getMessage());
            die;

        } else {
            alert ('Une erreur est survenue. Merci de réessayer plus tard', 'danger');
        }

    }

}

/**
 * Check if the id exist in the db
 * @param $_GET['id']
 */
function getAlreadyExistId ()
{
    try {

        global $db;
        $sql = 'SELECT id FROM users WHERE id = :id';
        $query = $db->prepare($sql);
        $query->execute(['id' => $_GET['id']]);

        return $query->fetch();

    } catch (PDOException $e) {

        if ($_ENV['DEBUG'] == 'true') {
            dump($e->getMessage());
            die;

        } else {

            alert('Une erreur est survenue. Merci de réessayer plus tard.', 'danger');

        }
    }
}

/**
 * Count the number of users
 */
function countUsers()
{
    global $db;
    $sql = 'SELECT COUNT(*) FROM users';
    $query = $db -> prepare($sql);
    $query -> execute();

    return $query -> fetchColumn();

}