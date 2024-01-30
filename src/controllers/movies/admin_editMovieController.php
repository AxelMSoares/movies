<?php 

$path = 'images/posters';
$targetToSave = '';

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


    // dump($_FILES);
    // die;



        // If Success in all the verifications, the movie is add in the database.
        if ($moviesMessage['release_date']['status'] !== true &&
            $moviesMessage['title']['status'] !== true &&
            $moviesMessage['synopsis']['status'] !== true &&
            $moviesMessage['duration']['status'] !== true)
        {

            if(!empty($_GET['id'])) {

                $targetToSave = uploadFile($path, 'poster');
                updateMovie($targetToSave);
                alert('Le film a été mis a jour avec success.', 'success');
                header('location: ' . $router->generate('displayMovie'));
                die;

            } else {

                addMovie($targetToSave);
                uploadFile($path, 'poster');
                alert('Le film a été ajouté avec success.', 'success');

            }

        }

} else if(!empty($_GET['id'])) {

    $_POST = (array) getMovie();

}

