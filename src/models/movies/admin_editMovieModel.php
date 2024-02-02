<?php 

/**
* Add a movie in the database
* @param $checkedHour ($_POST['release'])
* @return void
*/
function addMovie($targetToSave)
{
    global $db;
    $movies = [
            'title' => $_POST['title'],
            'director' => $_POST['director'],
            'casting' => $_POST['casting'],
            'synopsis' => $_POST['synopsis'],
            'duration' => $_POST['duration'],
            'release_date' => $_POST['release_date'],
            'trailer' => $_POST['trailer'],
            'poster' => $targetToSave,
            'slug' => renameFile($_POST['title'])
        ];

    try {

        $sql = "INSERT INTO movies (title, director, casting, synopsis, duration, release_date, poster, trailer, slug) VALUES (:title, :director, :casting, :synopsis, :duration, :release_date, :poster, :trailer, :slug)";
        $query = $db->prepare($sql);
        $query->execute($movies);
        alert('Le film a bien été ajouté.', 'success');
        $lastInsertedId = $db->lastInsertId();
        return $lastInsertedId;

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
        'director' => $_POST['director'],
        'casting' => $_POST['casting'],
        'synopsis' => $_POST['synopsis'],
        'duration' => $_POST['duration'],
        'release_date' => $_POST['release_date'],
        'id' => $_GET['id'],
        'trailer' => $_POST['trailer'],
        'slug' => renameFile($_POST['title'])
    ];


    
    if (!empty($targetToSave)) {

        $data['poster'] = $targetToSave;
        $sql = 'UPDATE movies SET 
            title = :title,
            director = :director,
            casting = :casting,
            synopsis = :synopsis,
            duration = :duration,
            release_date = :release_date,
            poster = :poster,
            trailer = :trailer,
            slug = :slug 
            WHERE id = :id';

    } else {

        $sql = 'UPDATE movies SET 
            title = :title,
            director = :director,
            casting = :casting,
            synopsis = :synopsis,
            duration = :duration,
            release_date = :release_date,
            trailer = :trailer,
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

        $query = "SELECT title, director, casting, synopsis, duration, release_date, poster, trailer FROM movies where id = :id";
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

/**
 * Check if the url is from youtube
 */
function checkYoutubeUrl($url) {
    $substring = "https://www.youtube.com/";
    if (strpos($url, $substring) === 0) {
        return true;
    } else {
        return false;
    }
}

/**
 * Get categories infos
 */

function getCategories(){
    global $db;
    $sql = 'SELECT * FROM categories ORDER by name';
    $query = $db -> prepare($sql);
    $query -> execute();
    return (array) $query -> fetchAll();
}

/**
 * Create categories for a movie
 * @return void;
 */
function createMoviesCat($lastId ,$currentCategorie){

    global $db;
    
    $data = [
        'movies_id' => $lastId,
        'categories_id' => $currentCategorie
    ];

    try{

        $sql = 'INSERT INTO movies_categories (movies_id, categories_id) VALUES (:movies_id, :categories_id)';
        $query = $db -> prepare($sql);
        $query -> execute($data);

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
 * Delete the categories of a movie
 * @return void
 */
function deleteMoviesCat(){

    global $db;
    
    $data = [
        'movies_id' => $_GET['id']
    ];
    
    try {

        $sql = 'DELETE from movies_categories WHERE movies_id = :movies_id';
        $query = $db -> prepare($sql);
        $query -> execute($data);

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
 * Get the categories of a movie
 */
function getMovieCategories(){

    global $db;
    $data = [
        'movies_id' => $_GET['id']
    ];


    $sql = 'SELECT categories_id FROM movies_categories WHERE movies_id = :movies_id';
    $query = $db -> prepare($sql);
    $query -> execute($data);
    return $query -> fetchAll(PDO::FETCH_ASSOC);

  
}

function checkMatchMovieCat(int $catToCheck, array $movieCategories){

    foreach($movieCategories as $cat){

        $result[] = $cat['categories_id'];
        
    }

    return (in_array($catToCheck, $result)) ? 'checked' : '';
};