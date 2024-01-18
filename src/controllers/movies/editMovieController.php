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

    ]

];


if(!empty($_POST)){

    // Return a global message if one of the required inputs are empty
    if (empty($_POST['title']) || 
        empty($_POST['synopsis']) ||
        empty($_POST['release']))
    {

        $error = "Merci de remplir toutes les cases obligatoires!";

    }
    

    // If duration exists, check if the duration is numeric and over 3 numbers
    if (!empty($_POST['duration'])){
        if (!is_numeric($_POST['duration'])) {

            $moviesMessage['duration']['message'] = 'La durée du film doit être un nombre entier';
            $moviesMessage['duration']['class'] = 'danger';
            $moviesMessage['duration']['status'] = true; 

        } else if (strlen($_POST['duration']) > 3) {

            $moviesMessage['duration']['message'] = 'La durée du film doit être composé d\'au maximum 3 chiffres';
            $moviesMessage['duration']['class'] = 'danger';
            $moviesMessage['duration']['status'] = true; 

        }
    }    

    // If release exists, check if the release date format is valid
    if(!empty($_POST['release'])){
        if(!validateDate($_POST['release'])) {
        
            $moviesMessage['release']['message'] = 'La durée du film doit être un nombre entier';
            $moviesMessage['release']['class'] = 'danger';
            $moviesMessage['release']['status'] = true;
    
        }
        
    }  
    
        // If Success in all the verifications, the movie is add in the database.
    if (true){
    
        addMovie($_POST['duration']);
        $success = 'Le film a été ajouté avec success.';
    }

}