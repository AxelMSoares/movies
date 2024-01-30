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
            'poster' => $targetToSave,
            'slug' => renameFile($_POST['title'])
        ];

    try {

        $sql = "INSERT INTO movies (title, categories, director, casting, synopsis, duration, release_date, poster, slug) VALUES (:title, :categories, :director, :casting, :synopsis, :duration, :release_date, :poster, :slug)";
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
    $data = [
        'title' => $_POST['title'],
        'categories' => $_POST['categories'],
        'director' => $_POST['director'],
        'casting' => $_POST['casting'],
        'synopsis' => $_POST['synopsis'],
        'duration' => $_POST['duration'],
        'release_date' => $_POST['release_date'],
        'id' => $_GET['id'],
        'slug' => renameFile($_POST['title'])
    ];


    
    if (!empty($targetToSave)) {

        $data['poster'] = $targetToSave;
        $sql = 'UPDATE movies SET 
            title = :title,
            categories = :categories,
            director = :director,
            casting = :casting,
            synopsis = :synopsis,
            duration = :duration,
            release_date = :release_date,
            poster = :poster,
            slug = :slug 
            WHERE id = :id';

    } else {

        $sql = 'UPDATE movies SET 
            title = :title,
            categories = :categories,
            director = :director,
            casting = :casting,
            synopsis = :synopsis,
            duration = :duration,
            release_date = :release_date,
            slug = :slug 
            WHERE id = :id';

    }

    try {
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

/**
* Get infos about the movies
 */
function getMovie(){

    global $db;

    $movie_id = $_GET['id'];

    try {

        $query = "SELECT title, categories, director, casting, synopsis, duration, release_date, poster FROM movies where id = :id";
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
