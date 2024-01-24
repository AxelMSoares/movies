<?php

session_unset();
header ('location: ' . $router->generate('login'));
die;