<?php

if (!empty($_GET['id'])){

    deleteCategorie();
    alert('Catégorie Supprimée');
    header ('Location:' . $router->generate('categories'));
    die;

}