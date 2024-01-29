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


/**
*   Clean a text for insert into the database
 */
function cleanText(string $text){

    // Suppression des espaces vides en debut et fin de chaque ligne
	$text = preg_replace("#^[\t\f\v ]+|[\t\f\v ]+$#m",'',$text);

    // Remplacement des caractères accentués par leurs équivalents non accentués
	$text = htmlentities($text, ENT_NOQUOTES, 'utf-8');
	$text = preg_replace('#&([A-za-z])(?:acute|cedil|caron|circ|grave|orn|ring|slash|th|tilde|uml);#', '\1', $text);
	$text = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $text); // pour les ligatures e.g. 'œ'
	$text = html_entity_decode($text); 
	

    // Transforme tout le texte en minuscule
    $text = mb_strtolower($text, 'UTF-8');

    // Remplace les tabulations par des espaces
	$text = preg_replace("#\h#u", " ", $text);


    // Remplace les espaces multiples par des espaces simples
	$text = preg_replace('#[" "]{2,}#',' ',$text);

	// Remplace 1 entrée (\r\n) par 1 espace
	$text = str_replace(array("\r","\n"),' ',$text);

	// Supprime toutes les balises html
	$text = strip_tags($text);


    return $text;

}

/**
* Get the ip adresse of the client
 */
function get_ip() {
    	// IP si internet partagé
    	if (isset($_SERVER['HTTP_CLIENT_IP'])) {

    		return $_SERVER['HTTP_CLIENT_IP'];

    	}
    	// IP derrière un proxy
    	elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {

    		return $_SERVER['HTTP_X_FORWARDED_FOR'];

    	}
    	// Sinon : IP normale
    	else {

    		return (isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '');

    	}

}


