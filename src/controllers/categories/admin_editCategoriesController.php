<?php

// Adaptable texts
$variables = [
    'title' => 'Créer une nouvelle ',
    'button' => 'Créer'
];





if (!empty($_POST)){

    

    if(!empty($_POST['name'])){

        if(checkAlreadyExistCategorie()) {

            alert('Cette catégorie existe déjà');

        } else {

            if(!empty($_GET['id'])){

                updateCategorie();
                alert('Catégorie editée avec success', 'success');
                header('location: ' . $router -> generate('categories'));
                die;

            } else {

                $categorieName = $_POST['name'];
                $categorieName = cleanText($categorieName);
                createCategorie();
                alert('Catégorie crée avec success','success');
                header('location: ' . $router -> generate('categories'));
                die;
            }

        }


    } else {

        alert('Merci de remplir le nom de la catégorie');
        
    }


}

// Titles change if ID exist
if(!empty($_GET['id'])){

    $variables['title'] = 'Editer ';
    $variables['button'] = 'Editer';
    $_POST = (array) getCategories();

}

