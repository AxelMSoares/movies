<?php 

/** 
* Get the header
* @param string $title The title of the page
* @param string $layout The layout to use
* @return void
*/

function get_header($title, $layout ='public') :void {
    global $router;
    require '../src/views/layouts/' . $layout . '/header.php';
} 

/**
* Get the footer
* @param string $layouts The layout to use
* @return void 
*/

function get_footer($layout = 'public') :void{
    require '../src/views/layouts/' . $layout . '/footer.php';
}


/**
* Create notification alert
* @param string $message The message to save in alert
* @param string $type The type of the alert
* @param string void
*/
function alert(string $message, string $type = 'danger'): void
{
    $_SESSION['alert'] = [
        'message' => $message,
        'type' => $type
    ];
}

/**
* Display the alert message and destroy the session after display the alert
* @return void
*/
function displayAlert(): void{

    if (!empty($_SESSION['alert'])){

        $content = '<div ';
        $content .= 'class="alert alert-' . $_SESSION['alert']['type'] . '" role="alert">';
        $content .= $_SESSION['alert']['message'];
        $content .= '</div>';

        echo $content;
        unset ($_SESSION['alert']);

    }
}

/**
* Validate if the date format is YYYY-MM-DD
*@param $date
*@return bool
*/
function validateDate($date, $format = 'Y-m-d') : bool
{
    $d = DateTime::createFromFormat($format, $date);
    // Retourne true si la date est valide et correspond au format, false sinon
    return $d && $d->format($format) === $date;
}


/**
 * Check if the user is logged in
 * @param array $match
 * @param AltoRouter $router The router
 */

function checkAdmin(array $match, AltoRouter $router){


    $existAdmin = strpos($match['target'], 'admin_');
    if ($existAdmin !== false && empty($_SESSION['user']['id'])) {

        header('location: ' . $router->generate('login'));
        die;

    }
    
}

/**
* Check if the email already exists in the database
*  
*/

function checkAlreadyExistEmail(): mixed
{
    global $db;
    if (!empty($_GET['id'])) {

        $email = getUsersInfosById()->email;

        if($email === $_POST['email']){
            return false;
        }

    }

    $sql = 'SELECT id FROM users WHERE email = :email';
    $query = $db->prepare($sql);
    $query->bindParam(':email', $_POST['email'], PDO::PARAM_STR);
    $query->execute();

    return $query -> fetch();

};

function logoutTimer ()
{
    global $router;

    if (!empty($_SESSION['user']['lastLogin'])) {
        $expireHour = 1;

        $now = new DateTime();
        $now->setTimezone(new DateTimeZone('Europe/Paris'));

        $lastLogin = new DateTime($_SESSION['user']['lastLogin']);

        if ($now->diff($lastLogin)->h >= $expireHour) {
            unset($_SESSION['user']);
            alert('Vous avez été déconnecté pour inactivité', 'danger');
            header('Location: ' . $router->generate('login'));
            die;
        }
    }
}