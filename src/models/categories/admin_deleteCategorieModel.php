<?php

/**
 * Delete a categorie by its ID
 * @param int $_GET['id'] 
 */
function deleteCategorie(){

    global $db;

    $currentId = $_GET['id'];

    try {

        $sql = 'DELETE FROM categories WHERE id = :id';
        $query = $db->prepare($sql);
        $query -> bindParam('id', $currentId);
        $query -> execute();

    } catch (PDOException $e) {

        if ($_ENV['DEBUG'] == 'true'){

            dump($e->getMessage());
            die;

        } else {

            alert('Une erreur est survenue. Merci de réessayer plus tard','danger');

        }

    }

}