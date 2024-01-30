<?php 

/**
* Add a movie in the database
* @param $checkedHour ($_POST['release'])
* @return void
*/
function addMovie($targetToSave) : void
{
    global $db;
    $movies = [
            'title' => $_POST['title'],
            'categories' => $_POST['categories'],
            'director' => $_POST['director'],
            'casting' => $_POST['casting'],
            'synopsis' => $_POST['synopsis'],
            'duration' => $_POST['duration'],
            'release_date' => $_POST['release_date'],
            'poster' => $targetToSave
        ];

    try {

        $sql = "INSERT INTO movies (title, categories, director, casting, synopsis, duration, release_date, poster) VALUES (:title, :categories, :director, :casting, :synopsis, :duration, :release_date, :poster)";
        $query = $db->prepare($sql);
        $query->execute($movies);
        alert('Le film a bien été ajouté.', 'success');

    } catch (PDOException $e) {

        if ($_ENV['DEBUG'] == 'true'){

            dump($e->getMessage());
            die;

        } else {

            alert('Une erreur est survenue. Merci de réessayer plus tard','danger');

        }

    }
}

/**
* Check if the email already exists in the database
*  
*/

function checkAlreadyExistMovie(): mixed
{

    global $db;

    if (!empty($_GET['id'])) {

        $title = getMovie()->title;

        if($title === $_POST['title']){
            return false;
        }

    }

    $sql = 'SELECT id FROM movies WHERE title = :title';
    $query = $db->prepare($sql);
    $query->bindParam(':title', $_POST['title'], PDO::PARAM_STR);
    $query->execute();

    return $query -> fetch();

};

/**
* Fonction for update a movie
*/
function updateMovie($targetToSave)
{

    global $db;
    $data = ['title' => $_POST['title'],
            'categories' => $_POST['categories'],
            'director' => $_POST['director'],
            'casting' => $_POST['casting'],
            'synopsis' => $_POST['synopsis'],
            'duration' => $_POST['duration'],
            'release_date' => $_POST['release_date'],
            'id' => $_GET['id'],
            'poster' => $targetToSave
    ];

    try {
        $sql = 'UPDATE movies SET title = :title, categories = :categories, director = :director, casting = :casting, synopsis = :synopsis, duration = :duration, release_date = :release_date, poster = :poster WHERE id = :id';
        $query = $db -> prepare($sql);
        $query ->execute($data);

    } catch (PDOException $e) {

        if ($_ENV['DEBUG'] == 'true'){

            dump($e->getMessage());
            die;

        } else {

            alert('Une erreur est survenue. Merci de réessayer plus tard','danger');

        }

    }

};

function getMovie(){

    global $db;

    $movie_id = $_GET['id'];

    try {

        $query = "SELECT title, categories, director, casting, synopsis, duration, release_date FROM movies where id = :id";
        $statement = $db -> prepare($query);
        $statement -> bindParam('id', $movie_id);
        $statement -> execute ();
        return $statement->fetch();

    } catch (PDOException $e) {

        if ($_ENV['DEBUG'] == 'true'){

            dump($e->getMessage());
            die;

        } else {

            alert('Une erreur est survenue. Merci de réessayer plus tard','danger');

        }

    }
    
}
