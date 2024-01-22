<?php


if (!empty($_GET['id']) && !empty(getAlreadyExistId() -> id) && countUsers() > 1) {

    deleteUserById();
    alert('Utilisateur supprimé avec success', 'success');

} else {

    alert('Vous n\'avez pas le droit de faire ça', 'danger');
    

}

header ('location: ' . $router -> generate ('admin_display'));
die;
