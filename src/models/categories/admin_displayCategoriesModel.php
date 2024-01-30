<?php 

// Access to catégories infos
function getCategories()
{

    global $db;
    $sql = 'SELECT id, name FROM categories';
    $query = $db -> prepare($sql);
    $query -> execute();
    $categories = $query -> fetchAll(PDO::FETCH_ASSOC);

    return $categories;

}