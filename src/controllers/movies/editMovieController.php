<?php 

$moviesMessage = [

    'title' => [
        'message' => false,
        'class' => false,
        'status' => false

    ],

    'cat' => [
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
    
    'release' => [
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
    
    // Check if the release input is empty
    if (empty($_POST['release'])) {

        $moviesMessage['release']['status'] = true;
        $moviesMessage['release']['class'] = 'is-invalid';
        $error = "Merci de remplir toutes les cases obligatoires!";

    } else {
        
        if(!validateDate($_POST['release'])) {
        
            $moviesMessage['release']['message'] = 'Le format de la date doit etre JJ/MM/AAAA';
            $moviesMessage['release']['class'] = 'is-invalid';
            $moviesMessage['release']['status'] = true;
    
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


    
        // If Success in all the verifications, the movie is add in the database.
    if ($moviesMessage['title']['status'] === true ||
        $moviesMessage['synopsis']['status'] === true ||
        $moviesMessage['release']['status'] === true ||
        $moviesMessage['duration']['status'] === true)
    {

        $moviesMessage['global']['message'] = 'Erreur lors de l\'insertion dans la base de données. Une des données est invalide.';

    } else {
        
        addMovie($_POST['duration']);
        $success = 'Le film a été ajouté avec success.';

    }

}