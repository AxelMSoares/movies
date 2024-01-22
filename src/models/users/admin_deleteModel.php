<?php

function deleteUserById(){
    global $router;
    global $db;
    
    $user_id = $_GET['id'];

    $query = 'DELETE FROM users where id = :id';
    $statement = $db -> prepare($query);
    $statement -> bindParam('id', $user_id);
    $statement -> execute();

    alert('Utilisateur supprimé avec success');
    header('location:' . $router->generate('admin_display'));
    die;

}