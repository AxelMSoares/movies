<?php

/**
* Get all users
*/
function getUsers () {

    global $db;

    $query = 'SELECT id, email, nickname, updated, created FROM users';
    $statement = $db -> prepare($query);
    $statement -> execute();
    return $statement -> fetchAll();
}

