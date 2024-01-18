<?php

use PSpell\Config;

// Constants
define ('SRC', '../src/');


// Load vendor (composer)
require ('../vendor/autoload.php');

//  Load environment variables form .env file
$dotenv = Dotenv\Dotenv::createImmutable(SRC . 'config');
$dotenv->load();

session_start();

require (SRC . 'config/database.php');
require (SRC . 'includes/forms.php');

// Load router
$router = new AltoRouter();

require (SRC . 'routes/public.php');
require (SRC . 'routes/admin.php');

$match = $router->match();
require (SRC . 'includes/functions.php');
if (!empty($match['target'])){
    $_GET = array_merge($_GET, $match['params']);
    require SRC . 'models/' . $match['target'] .'Model.php';
    require SRC . 'controllers/' . $match['target'] . 'Controller.php';
    require SRC . 'views/' . $match['target'] . 'View.php';
} else {
    header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
    echo '404';
}

?>

