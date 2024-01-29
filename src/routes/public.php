<?php

// // Users
// $router->map( 'GET','/connexion', 'login.php', 'login');
// $router->map( 'GET','/inscription', 'signup.php');
// $router->map( 'GET','/deconnexion', 'logout.php');
// $router->map( 'GET','/profil', 'profile.php');
// $router->map( 'GET','/mot-de-passe-oublie', 'forgottenPassword.php');

$router->addMatchTypes(['slug' => '[a-z0-9]+(?:-[a-z0-9]+)*']);

// Movies
$router->map('GET|POST','/', 'home', 'home');
$router->map('GET|POST','/homeTwig', 'homeTwig', 'homeTwig');
$router->map('GET','/recherche', 'search.php');
$router->map('GET','/film/[slug:slug]', 'detailsMovie', 'details');
$router->map('GET','/dernieres-sorties', 'releases.php');
$router->map('GET','/mieux-votes', 'rated.php');

// Pages
$router->map('GET','/politique-confidentialite', 'privacy.php');
$router->map('GET','/mentions-legales', 'legalNotice.php');