<?php 

/**
* Add a movie in the database
* @param $checkedHour ($_POST['release'])
* @return void
*/
function addMovie() : void
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

/**
* Check if the email already exists in the database
*  
*/

function checkAlreadyExistMovie(): mixed
{

    global $db;
    $sql = 'SELECT id FROM movies WHERE title = :title';
    $query = $db->prepare($sql);
    $query->bindParam(':title', $_POST['title'], PDO::PARAM_STR);
    $query->execute();

    return $query -> fetch();

};

/**
* Fonction for update a movie
*/
function updateMovie()
{

    global $db;
    $data = ['title' => $_POST['title'],
            'categories' => $_POST['cat'],
            'director' => $_POST['director'],
            'casting' => $_POST['casting'],
            'synopsis' => $_POST['synopsis'],
            'duration' => $_POST['duration'],
            'release_date' => $_POST['release'],
            'id' => $_GET['id']
    ];

    $sql = 'UPDATE movies SET title = :title, categories = :categories, director = :director, casting = :casting, synopsis = :synopsis, duration = :duration, release_date = :release_date WHERE id = :id';
    $query = $db -> prepare($sql);
    $query ->execute($data);

};
