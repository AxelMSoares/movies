<?php


/**
 * Create a new categorie
 * @return void
 */
function createCategorie() : void
{

    global $db;

    $categories = [
        'name' => $_POST['name']
    ];


    try {

        $sql = 'INSERT INTO categories (name) VALUES (:name)';
        $query = $db->prepare($sql);
        $query->execute($categories);
        alert('Catégorie crée avec success', 'success');

    } catch (PDOException $e){

        if ($_ENV['DEBUG'] == 'true'){

            dump($e->getMessage());
            die;

        } else {

            alert('Une erreur est survenue. Merci de réessayer plus tard','danger');

        }

    }
    

}

/**
 * Update a categorie
 * @return void
 */
function updateCategorie() : void
{
    global $db;

    $data = ['name' => $_POST['name'],
            'id' => $_GET['id']
    ];

    try {
        $sql = 'UPDATE categories SET name = :name WHERE id = :id';
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


}

/**
 * Get categories by ID
 * @param $_GET['id']
 * @return mixed
 */
function getCategories() :mixed
{

    global $db;

    $currentId = $_GET['id'];


    try {

        $sql = 'SELECT name FROM categories WHERE id = :id';
        $query = $db->prepare($sql);
        $query -> bindParam('id', $currentId);
        $query -> execute();
        $result = $query->fetch();
        return $result;


    } catch (PDOException $e) {

        if ($_ENV['DEBUG'] == 'true'){

            dump($e->getMessage());
            die;

        } else {

            alert('Une erreur est survenue. Merci de réessayer plus tard','danger');

        }

    }


}


function checkAlreadyExistCategorie(): mixed
{

    global $db;

    if (!empty($_GET['id'])) {

        $categorie = (array) getCategories();
        $categorie['name'];

        if($categorie['name'] === $_POST['name']){
            return false;
            die;
        }

    }

    $sql = 'SELECT id FROM categories WHERE name = :name';
    $query = $db->prepare($sql);
    $query->bindParam(':name', $_POST['name'], PDO::PARAM_STR);
    $query->execute();

    $result = $query -> fetch(PDO::FETCH_ASSOC);
    return $result;

};

    


