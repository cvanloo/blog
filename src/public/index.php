<?php
	require '/var/php/config/config.php';
	require PHP_MODULES.'Session/session.php';
?>

<?php
	$uri =  $_SERVER['REQUEST_URI'];

	if (substr($uri, 1, 1) === '@') {
		include_once PHP_TEMPLATES.'Blog/PersonalPage.php';
	}
	else {
		switch ($uri) {
		case '/':
			include_once PHP_TEMPLATES.'Blog/HomePage.php';
			break;
		case '/info':
			phpinfo();
			break;
		case '/login':
			include_once PHP_TEMPLATES.'Auth/LoginPage.html';
			break;
		case '/LoginPage.php':
			include_once PHP_TEMPLATES.'Auth/LoginPage.php';
			break;
		case '/register':
			include_once PHP_TEMPLATES.'Auth/RegisterPage.html';
			break;
		case '/RegisterPage.php':
			include_once PHP_TEMPLATES.'Auth/RegisterPage.php';
			break;
		case '/logout':
			include_once PHP_TEMPLATES.'Auth/LogoutPage.php';
			break;
		case '/upload':
			include_once PHP_TEMPLATES.'Blog/UploadPage.php';
			break;
		case '/upload.php':
			include_once PHP_TEMPLATES.'Blog/upload.php';
			break;
		case '/b':
			include_once PHP_TEMPLATES.'Blog/BlogPage.php';
			break;
		case '/admin':
			include_once PHP_TEMPLATES.'Admin/AdminPage.php';
			break;
		case '/var/php/Templates/admin.php':
			include_once PHP_TEMPLATES.'Admin/admin.php';
			break;
		case '/pref':
			include_once PHP_TEMPLATES.'Admin/PreferencesPage.php';
			break;
		case '/pref.php':
			include_once PHP_TEMPLATES.'Admin/preferences.php';
			break;
		case '/search.php':
			include_once PHP_MODULES.'Search/Search.php';
			break;
		default:
			echo $uri;
		}
	}

?>
