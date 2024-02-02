<?php


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