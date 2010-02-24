<?
// Make sure the form was indeed POSTed:
// (requires your html form to use: action="post")
if(!$_SERVER['REQUEST_METHOD'] == "POST") {
	die("Forbidden - You are not authorized to view this page");
	header ("Location: /");
}

// Host names from where the form is authorised
// to be posted from:
$authHosts = array("ncane.com", "ncane.co.za");

// Where have we been posted from?
$fromArray = parse_url(strtolower($_SERVER['HTTP_REFERER']));

// Test to see if the $fromArray used www to get here.
$wwwUsed = strpos($fromArray['host'], "www.");

// Make sure the form was posted from an approved host name.
if(!in_array(($wwwUsed === false ? $fromArray['host'] : substr(stristr($fromArray['host'], '.'), 1)), $authHosts)) {
	header ("Location: /");
	exit;
}

// Attempt to defend against header injections:
$badStrings = array("Content-Type:", "MIME-Version:", "Content-Transfer-Encoding:", "bcc:", "cc:");

// Loop through each POSTed value and test if it contains
// one of the $badStrings:
foreach($_POST as $k => $v){
	foreach($badStrings as $v2) {
		if(strpos($v, $v2) !== false) {
			header ("Location: /");
			exit;
		}
	}
}

// Made it past spammer test, free up some memory
// and continue rest of script:
unset($k, $v, $v2, $badStrings, $authHosts, $fromArray, $wwwUsed);

$ipAddress = $_SERVER['REMOTE_ADDR'];
$lockString = $_POST['ncane_id'];

require_once ("../session.php");
DBConnect();
// set the URL redirect to expired
$locksql = "UPDATE ncane_tbl SET ncane_exp = 0 WHERE ncane_id = '" . $lockString . "'";

mysql_query($locksql) or die(mysql_error());

// log the unlock attempt
$logsql = "INSERT INTO ncane_log VALUES ('', NOW(), 'unlock.php', '" . $lockString . " was unlocked by " . $ipAddress . "')";

mysql_query($logsql) or die(mysql_error());

echo "<br><br>The redirector '" . $lockString . "' was re-enabled.\n";

?>