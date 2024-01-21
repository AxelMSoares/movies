<?php

if (!empty($_GET['id'])){

    deleteUserById($_GET['id']);
    header('location:' . $router->generate('admin_display'));
}