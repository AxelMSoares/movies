<?php 

function deleteMovie(){
    global $db;
    global $router;

    $currentId = $_GET['id'];

    $query = 'DELETE FROM movies where id = :id';
    $statement = $db->prepare($query);
    $statement ->bindParam('id', $currentId);
    $statement -> execute();

    header('Location:' . $router->generate('displayMovie'));

};