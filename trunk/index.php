<?php

require_once ("session.php");

// 1. Check if we have a banned IP accessing the page

$bool = "false";

$banned_ip = CheckBannedIP($_SERVER['REMOTE_ADDR']);

if ($banned_ip == 1)
{
	ShowBlankPage();
	exit;
}

if (ExistsInRBL())
{
	ShowBlankPage();
	exit;
}

// 2. Set the REQUEST_URI to readable format

$id = $_SERVER['REQUEST_URI'];
$id = trim(SanitiseURI($id));

if ($id == "")
{
	ShowMainPage();
	exit;
}

// 3. Do a select from the database where the $id is the request_uri
DBConnect();
$check_id = mysql_query("SELECT user_name, ncane_url, ncane_hit, ncane_adult FROM ncane_tbl WHERE ncane_id = '" .
	$id . "' AND ncane_exp = 0") or die(mysql_error());
while ($row = mysql_fetch_assoc($check_id))
{
	$ncaneuser = $row['user_name'];
	$result = trim($row['ncane_url']);
	$hitcount = $row['ncane_hit'];
	$adult = $row['ncane_adult'];
}

//DBCloseConnection();

$hitcounter = intval($hitcount);
$countermax = intval("24");
if($ncaneuser != 'free_user') $countermax = intval("1000000");

if ($hitcounter > $countermax)
{
	$bool = "true";
}
else
{
	$bool = "false";
}

// 4. Redirect to main page if no URL is set
if ($result == "")
{
	ShowMainPage();
	exit;
}

// 5. Increase hit counter for URL
IncreaseHitCounter($id);

// 6. Redirect to Adult commentary if adult flag is set
if ($adult == "1")
{
	ShowAdultContent($result);
	exit;
}

// 7. If URL ends with image extension, redirect to the URL directly
CheckImageExtension($id, $result);

// 8. If hit counter is under 25, redirect to the URL directly

if ($bool == "true")
{
	ShowFreeLinkNotice($result, $hitcounter);
	exit;
}

// 9. If URL ends in .EXE, redirect to executable file commentary
$newlen = strlen($result) - 4;
if (substr($result, $newlen, 4) == ".exe") {
	ShowExecutable($result);
}

// 10. Finally, redirect to the URL
ShowNcaneURL($result);
exit;

// ---- List of functions:

?>
