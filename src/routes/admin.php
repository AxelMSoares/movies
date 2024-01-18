<?php
$admin = '/' . $_ENV['ADMIN_FOLDER'];

// Users
$router->map( 'GET|POST', $admin . '/connexion', 'users/admin_login', ''); // 3
$router->map( 'GET', $admin . '/deconnexion', '', ''); // 4
$router->map( 'GET', $admin . '/mot-de-passe-oublie', '', 'lostPassword'); // 7
$router->map( 'GET', $admin . '/utilisateurs', '', ''); // 1
$router->map( 'GET|POST', $admin . '/utilisateurs/editer', 'users/admin_edit', ''); // 2 / 5
$router->map( 'GET|POST', $admin . '/utilisateurs/editer/[i:id]', 'users/admin_edit', ''); // 2 / 5
$router->map( 'GET', $admin . '/utilisateurs/supprimer/[i:id]', '', ''); // 6

// Movies
$router->map( 'GET', $admin . '/films', '', '');
$router->map( 'GET|POST', $admin . '/films/editer', 'movies/editMovie', '');
$router->map( 'GET|POST', $admin . '/films/editer/[i:id]', 'movies/editMovie', '');
$router->map( 'GET', $admin . '/films/supprimer/[i:id]', '', '');

// Categories
$router->map( 'GET', $admin . '/categories', '', '');
$router->map( 'GET', $admin . '/categories/editer/[i:id]', '', '');
$router->map( 'GET', $admin . '/categories/supprimer/[i:id]', '', '');