<?php 

/**
 * Delete a movie by its ID and redirect to movie display page
 * @param $_GET['id'] movie ID
 * @return void  alert with message
 */
function deleteMovie(){
    global $db;
    global $router;

    $currentId = $_GET['id'];

    $query = 'DELETE FROM movies where id = :id';
    $statement = $db->prepare($query);
    $statement ->bindParam('id', $currentId);
    $statement -> execute();

    alert('Film supprimé avec success');
    header('Location:' . $router->generate('displayMovie'));
    die;

};

/**
 * Delete categories of a movie by the movie ID
 * @param int $_GET['id'] movie id 
 */
function deleteMovieCat(){

    $movie_id = $_GET['id'];

    global $db;
    $sql = 'DELETE FROM movies_categories where movies_id = :movies_id';
    $query = $db->prepare($sql);
    $query ->bindParam('movies_id', $movie_id);
    $query -> execute();


}