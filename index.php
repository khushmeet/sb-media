<?php
/**
 * This is a small bootstrap file.
 */
define('ROOT_PATH', __DIR__ . '/');

// display errors, because why not?
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require ROOT_PATH . 'app/users.php';

// call user class 
$all_user = new Users();

// export the data
if(isset($_GET['export']) && $_GET['export'] == 1 )
{
	$all_user->exportCSV();
	exit();
}

require ROOT_PATH . 'views/index.php';

