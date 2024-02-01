<?php 



// Request to select all elements of movies 
$query = 'SELECT * FROM movies order by title';
$statement = $db->prepare($query);
$statement->execute();
$movies = $statement -> fetchAll(PDO::FETCH_ASSOC);
    


