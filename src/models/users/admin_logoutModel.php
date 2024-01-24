<?php

unset($_SESSION['user']);
alert('Vous êtes deconnecté. Au revoir');
header ('location: ' . $router->generate('login'));
die;