<?php 

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

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

// Remove accent for all characters
function removeAccent($string) {
	$string = str_replace(
		['à','á','â','ã','ä', 'ç', 'è','é','ê','ë', 'ì','í','î','ï', 'ñ', 'ò','ó','ô','õ','ö', 'ù','ú','û','ü', 'ý','ÿ', 'À','Á','Â','Ã','Ä', 'Ç', 'È','É','Ê','Ë', 'Ì','Í','Î','Ï', 'Ñ', 'Ò','Ó','Ô','Õ','Ö', 'Ù','Ú','Û','Ü', 'Ý'], 
		['a','a','a','a','a', 'c', 'e','e','e','e', 'i','i','i','i', 'n', 'o','o','o','o','o', 'u','u','u','u', 'y','y', 'A','A','A','A','A', 'C', 'E','E','E','E', 'I','I','I','I', 'N', 'O','O','O','O','O', 'U','U','U','U', 'Y'], 
		$string
	);
	return $string;
}

// Clean a name for stock in the database
function renameFile(string $name) {
	$name = trim($name);
	$name = strip_tags($name);
	$name = removeAccent($name);
    $name = preg_replace('/[\s-]+/', ' ', $name);  // Clean up multiple dashes and whitespaces
	$name = preg_replace('/[\s_]/', '-', $name); // Convert whitespaces and underscore to dash
	$name = preg_replace('/[^A-Za-z0-9\-]/', '', $name);
	$name = strtolower($name);
	$name = trim($name, '-');

	return $name;
}

// Convert a size
function formatBytes($size, $precision = 2) {
	$base     = log($size, 1024);
	$suffixes = ['', 'Ko', 'Mo', 'Go', 'To'];

	return round(pow(1024, $base - floor($base)), $precision) . ' ' . $suffixes[floor($base)];
}

/**	
 * Upload file
 * 
 * @param string $path to save file
 * @param string $field name of input type file
 */
function uploadFile(string $path, string $field, array $exts = ['jpg', 'png', 'jpeg'], int $maxSize = 2097152): string
{
	// Check submit form with post method
	if (empty($_FILES)) :
		return '';
	endif;
	
	// Check exit directory if not create
	if (!is_dir($path) && !mkdir($path, 0755)) :
		return 'Impossible d\'importer votre fichier.';
	endif;

	// Check not empty input file
	if (empty($_FILES[$field]['name'])) :
		return 'Merci d\'uploader un fichier';
	endif;
	
	// Check exts
	$currentExt = pathinfo($_FILES[$field]['name'], PATHINFO_EXTENSION);
	$currentExt = strtolower($currentExt);
	if (!in_array($currentExt, $exts)) :
		$exts = implode(', ', $exts);
		return 'Merci de charger un fichier avec l\'une de ces extensions : ' . $exts . '.';
	endif;

	// Check no error into current file
	if ($_FILES[$field]['error'] !== UPLOAD_ERR_OK) :
		return 'Merci de sélectionner un autre fichier.';
	endif;

	// Check max size current file
	if ($_FILES[$field]['size'] > $maxSize) :
		return 'Merci de charger un fichier ne dépassant pas cette taille : ' . formatBytes($maxSize);
	endif;

	$filename = pathinfo($_FILES[$field]['name'], PATHINFO_FILENAME);
	$filename = renameFile($filename);
	$targetToSave = $path . '/' . $filename . '.' . $currentExt;
	
	if(move_uploaded_file($_FILES[$field]['tmp_name'], $targetToSave)) :
		return $targetToSave;
	endif;

	return '';
}

/**
* Resize image
* @param string $imageName image direction
* @param int $width width
* @return void
 */
function imageResize(string $imageName, int $width) : void
{

	$manager = new ImageManager(new Driver());
	$image = $manager->read($imageName);
	$image->scale(width: $width);
	$image->save($imageName);

}