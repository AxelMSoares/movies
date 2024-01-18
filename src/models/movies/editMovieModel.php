<?php 

/**
* Add a movie in the database
* @param $checkedHour ($_POST['release'])
* @return void
*/
function addMovie($checkedHour) : void
{
    global $db;
    $movies = [
            'title' => $_POST['title'],
            'categories' => $_POST['cat'],
            'director' => $_POST['director'],
            'casting' => $_POST['casting'],
            'synopsis' => $_POST['synopsis'],
            'duration' => $_POST['duration'],
            'release_date' => $_POST['release']
        ];

    $sql = "INSERT INTO movies (title, categories, director, casting, synopsis, duration, release_date) VALUES (:title, :categories, :director, :casting, :synopsis, :duration, :release_date)";
    $query = $db->prepare($sql);
    try {
        $query->execute($movies);
    } catch (PDOException $e) {
        dump($e->getMessage());
        die;
    }
}

