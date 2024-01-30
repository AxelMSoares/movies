<?php

/**
* Get all movies order by added date
 */
function getMovies()
{

    global $db;
    $sql = 'SELECT slug, title, poster, casting, director, synopsis, categories FROM movies ORDER BY created DESC';
    $query = $db->prepare($sql);
    $query->execute();

    return $query->fetchAll();
    
}
