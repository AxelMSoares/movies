<?php 

function detailsMovie(){

    global $db;
    
    $sql = 'SELECT movies.*, GROUP_CONCAT(categories.name) AS categories_names 
    FROM movies 
    JOIN movies_categories ON movies.id = movies_categories.movies_id
    JOIN categories ON movies_categories.categories_id = categories.id
    WHERE slug = :slug
    GROUP BY movies.id';
    $query = $db->prepare($sql);
    $query -> execute(['slug' => $_GET['slug']]);

    return $query -> fetch();
    
}