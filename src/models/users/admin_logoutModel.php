<?php

// Disconnect a user and redirect to connexion page
unset($_SESSION['user']);
alert('Vous êtes deconnecté. Au revoir');
header ('location: ' . $router->generate('login'));
die;