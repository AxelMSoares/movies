<?php

/**
 * Get all movies order by added date
 * @return array
 */
function getMovies()
{

    global $db;
    $sql = 'SELECT slug, title, poster, casting, director, synopsis, trailer FROM movies ORDER BY created DESC';
    $query = $db->prepare($sql);
    $query->execute();

    return $query->fetchAll();
    
}
