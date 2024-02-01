<?php
$admin = '/' . $_ENV['ADMIN_FOLDER'];

$router->addMatchTypes(['uuid' => '[0-9a-fA-F]{8}-[0-9a-fA-F]{4}-[0-9a-fA-F]{4}-[0-9a-fA-F]{4}-[0-9a-fA-F]{12}']);

// Users
$router->map( 'GET|POST', $admin . '/connexion', 'users/login', 'login'); // 3
$router->map( 'GET', $admin . '/deconnexion', 'users/admin_logout', 'logout'); // 4
$router->map( 'GET', $admin . '/mot-de-passe-oublie', '', 'lostPassword'); // 7
$router->map( 'GET', $admin . '/utilisateurs', 'users/admin_display', 'admin_display'); // 1
$router->map( 'GET|POST', $admin . '/utilisateurs/editer', 'users/admin_edit', ''); // 2 / 5
$router->map( 'GET|POST', $admin . '/utilisateurs/editer/[uuid:id]', 'users/admin_edit', 'admin_edit'); // 2 / 5
$router->map( 'GET', $admin . '/utilisateurs/supprimer/[uuid:id]', 'users/admin_delete', 'admin_delete'); // 6
$router->map( 'GET', $admin . '/utilisateurs/supprimer-confirm/[uuid:id]', 'users/admin_deleteConfirm', 'admin_deleteConfirm'); // 6

// Movies
$router->map( 'GET', $admin . '/films', 'movies/admin_displayMovie', 'displayMovie');
$router->map( 'GET|POST', $admin . '/films/editer', 'movies/admin_editMovie', 'editMovie');
$router->map( 'GET|POST', $admin . '/films/editer/[i:id]', 'movies/admin_editMovie', '');
$router->map( 'GET', $admin . '/films/supprimer/[i:id]', 'movies/admin_deleteMovie', 'deleteMovie');
$router->map( 'GET', $admin . '/films/supprimer-confirm/[i:id]', 'movies/admin_deleteConf', 'deleteMovieConfirm');

// Categories
$router->map( 'GET|POST', $admin . '/categories', 'categories/admin_displayCategories', 'categories');
$router->map( 'GET|POST', $admin . '/categories/editer', 'categories/admin_editCategories', 'editCategories');
$router->map( 'GET|POST', $admin . '/categories/editer/[i:id]', 'categories/admin_editCategories', '');
$router->map( 'GET|POST', $admin . '/categories/supprimer/[i:id]', 'categories/admin_deleteCategorie', 'deleteCategorie');