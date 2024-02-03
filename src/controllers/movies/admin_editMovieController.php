<?php 

$targetToSave = '';

// Images directory
$path = 'images/posters';

// Width to resize images
$imageWidth = 200;

// Get all the categories for the form inputs
$categoriesList = getCategories();

// Start the movies categories empty for the create movie case
$movieCategories = [];

// Get the categories of a movie in a update case
if (!empty($_GET['id'])){

    $movieCategories = getMovieCategories();

}


// Array with status, classes and messages for the verifications before create or update a movie
$moviesMessage = [

    'title' => [
        'message' => false,
        'class' => false,
        'status' => false

    ],

    'categories' => [
        'message' => false,
        'class' => false,
        'status' => false

    ],

    'casting' => [
        'message' => false,
        'class' => false,
        'status' => false

    ],

    'director' => [
        'message' => false,
        'class' => false,
        'status' => false

    ],

    'synopsis' => [
        'message' => false,
        'class' => false,
        'status' => false

    ],

    'duration' => [
        'message' => false,
        'class' => false,
        'status' => false

    ],
    
    'release_date' => [
        'message' => false,
        'class' => false,
        'status' => false

    ],

    'trailer' => [
        'message' => false,
        'class' => false,
        'status' => false

    ],

    'global' => [
        'message' => false
    ]

];


if(!empty($_POST)){

    // Check if the title input is empty
    if (empty($_POST['title'])){
        $moviesMessage['title']['status'] = true;
        $moviesMessage['title']['class'] = 'is-invalid';
        $error = "Merci de remplir toutes les cases obligatoires!";

    } else if(checkAlreadyExistMovie()){
        $moviesMessage['title']['status'] = true;
        $moviesMessage['title']['class'] = 'is-invalid';
        $moviesMessage['title']['message'] = 'Il existe déjà un film avec ce titre';
        $error = "Il existe déjà un film avec ce titre";
    }
    
    // Check if the synopsis input is empty
    if (empty($_POST['synopsis'])) {

        $moviesMessage['synopsis']['status'] = true;
        $moviesMessage['synopsis']['class'] = 'is-invalid';
        $error = "Merci de remplir toutes les cases obligatoires!";

    }
    
    // Check if the release_date input is empty
    if (empty($_POST['release_date'])) {

        $moviesMessage['release_date']['status'] = true;
        $moviesMessage['release_date']['class'] = 'is-invalid';
        $error = "Merci de remplir toutes les cases obligatoires!";

    } else {
        
        if(!validateDate($_POST['release_date'])) {
        
            $moviesMessage['release_date']['message'] = 'Le format de la date doit etre JJ/MM/AAAA';
            $moviesMessage['release_date']['class'] = 'is-invalid';
            $moviesMessage['release_date']['status'] = true;
    
        }

    }
    

    // If duration exists, check if the duration is numeric and over 3 numbers
    if (!empty($_POST['duration'])){

        if (!is_numeric($_POST['duration'])) {

            $moviesMessage['duration']['message'] = 'La durée du film doit être un nombre entier';
            $moviesMessage['duration']['class'] = 'is-invalid';
            $moviesMessage['duration']['status'] = true; 

        } else if (strlen($_POST['duration']) > 3) {

            $moviesMessage['duration']['message'] = 'La durée du film doit être composé d\'au maximum 3 chiffres';
            $moviesMessage['duration']['class'] = 'is-invalid';
            $moviesMessage['duration']['status'] = true; 

        }
    }   

    // If a url is sent, check if is a youtube url 
    if (!empty($_POST['trailer'])){
        if(!checkYoutubeUrl($_POST['trailer'])){
            $moviesMessage['trailer']['status'] = true;
            alert('Le format de l\'url est invalide. Il doit commencer par: https://youtube.com/');
        }
    }

    // Checks if there is at least one category
    if (empty($_POST['categories'])){

        $moviesMessage['categories']['status'] = true;
        alert('Merci de choisir au moins une catégorie');

    }

    // If Success in all the verifications, the movie is created or update in the database.
    if ($moviesMessage['release_date']['status'] !== true &&
        $moviesMessage['title']['status'] !== true &&
        $moviesMessage['synopsis']['status'] !== true &&
        $moviesMessage['trailer']['status'] !== true &&
        $moviesMessage['categories']['status'] !== true &&
        $moviesMessage['duration']['status'] !== true)
    {

        // Update case
        if(!empty($_GET['id'])) {

            // If a new poster is updated by the user, replace the actual. If no one send, dont replace the actual
            // Resize the file before save
            if (!empty($_FILES['poster']['name'])){

                $targetToSave = uploadFile($path, 'poster');
                imageResize($targetToSave, $imageWidth);
            }
            
            // Delete all movies categories
            deleteMoviesCat();

            foreach ($_POST['categories'] as $cat){

                // Recreate the movies categories
                createMoviesCat($_GET['id'], $cat);

            }

            updateMovie($targetToSave);
            alert('Le film a été mis a jour avec success.', 'success');
            header('location: ' . $router->generate('displayMovie'));
            die;
        
        // Create case
        // If a poster is send, resize before save
        } else {

            $targetToSave = uploadFile($path, 'poster');
            $lastId = addMovie($targetToSave);

            if (!empty($_FILES['poster']['name'])){
                imageResize($targetToSave, $imageWidth);
            }

            if (!empty($_POST['categories'])){
                foreach ($_POST['categories'] as $cat) {
                    createMoviesCat($lastId, $cat);
                }
            }

            alert('Le film a été ajouté avec success.', 'success');
        }

    }

} else if(!empty($_GET['id'])) {

    $_POST = (array) getMovie();
} 

