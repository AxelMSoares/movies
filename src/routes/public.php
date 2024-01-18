<?php

// // Users
// $router->map( 'GET','/connexion', 'login.php', 'login');
// $router->map( 'GET','/inscription', 'signup.php');
// $router->map( 'GET','/deconnexion', 'logout.php');
// $router->map( 'GET','/profil', 'profile.php');
// $router->map( 'GET','/mot-de-passe-oublie', 'forgottenPassword.php');

// Movies
$router->map( 'GET','/', 'home');
$router->map( 'GET','/recherche', 'search.php');
$router->map( 'GET','/details/[i:id]', 'details.php');
$router->map( 'GET','/dernieres-sorties', 'releases.php');
$router->map( 'GET','/mieux-votes', 'rated.php');

// Pages
$router->map( 'GET','/politique-confidentialite', 'privacy.php');
$router->map( 'GET','/mentions-legales', 'legalNotice.php');