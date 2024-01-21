<?php



$query = 'SELECT * FROM users';
$statement = $db -> prepare($query);
$statement -> execute();
$users = $statement -> fetchAll(PDO::FETCH_ASSOC);


