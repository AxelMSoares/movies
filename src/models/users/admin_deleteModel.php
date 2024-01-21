<?php

function deleteUserById(){
    
    $user_id = $_GET['id'];

    global $db;
    $query = 'DELETE FROM users where id = :id';
    $statement = $db -> prepare($query);
    $statement -> bindParam('id', $user_id);
    $statement -> execute();


}