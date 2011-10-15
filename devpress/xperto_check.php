<?PHP
if (!isset($_SESSION['BID']))
	{
	$URL = "Location:/administration/index.php";
	HEADER($URL);
	}

?>