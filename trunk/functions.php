<?php
// ---- List of functions:

/**************************/
// Functions
/**************************/

require_once ("banned.php");

function ExistsInRBL()
{
	/* function check_rbl()
	* Checks to see if the client is listed in any proxy blacklists
	* Returns true if the host if blacklisted, false if not
	* http://www.jhurliman.org/index.php/2005/open-proxy-rbl-lookups-in-php/
	*/
	$rbls = array('http.dnsbl.sorbs.net', 'misc.dnsbl.sorbs.net');
	$remote = $_SERVER['REMOTE_ADDR'];

	if (preg_match("/([0-9]+)\.([0-9]+)\.([0-9]+)\.([0-9]+)/", $remote, $matches))
	{
		foreach ($rbls as $rbl)
		{
			$rblhost = $matches[4] . "." . $matches[3] . "." .
			$matches[2] . "." . $matches[1] . "." . $rbl;

			$resolved = gethostbyname($rblhost);

			if ($resolved != $rblhost)
			{
				return true;
			}
		}
	}
	return false;
}

function URLCounter()
{
	DBConnect();
	$count_url = mysql_query("SELECT ncane_id FROM ncane_tbl where ncane_exp = 0") or die(mysql_error());
	$num_rows = mysql_num_rows($count_url);
	$e_count_url = mysql_query("SELECT ncane_id FROM ncane_tbl where ncane_exp = 1") or die(mysql_error());
	$e_num_rows = mysql_num_rows($e_count_url);
	return "<center>Active URLs: " . number_format($num_rows, 0, '.', ',') . ". Disabled URLs: " . number_format($e_num_rows, 0, '.', ',') . ".</center>";
	//DBCloseConnection();
}

function DBConnectInsert()
{
	$connectionInsert = @mysql_connect(DB_SERVER, DB_USER, DB_PASS) or die("BM: There was a problem processing your request. Error # x020.<br><br>Please mail us at <a href=\"mailto:info@ncane.com\"><i>info@ncane.com</i></a> to let us know, or click <a href=\"index.php\">here</a> to try again.");
	$dbname = DB_NAME;
	$db = @mysql_select_db($dbname, $connectionInsert) or die("BM: Could not select a valid database.");
}

function DBConnectUpdate()
{
	$connectionUpdate = @mysql_connect(DB_SERVER, DB_USER, DB_PASS) or die("BM: There was a problem processing your request. Error # x021.<br><br>Please mail us at <a href=\"mailto:info@ncane.com\"><i>info@ncane.com</i></a> to let us know, or click <a href=\"index.php\">here</a> to try again.");
	$dbname = DB_NAME;
	$db = @mysql_select_db($dbname, $connectionUpdate) or die("BM: Could not select a valid database.");
}

function DBConnect()
{
	$connection = @mysql_connect(DB_SERVER, DB_USER, DB_PASS) or die("BM: There was a problem processing your request. Error # x022.<br><br>Please mail us at <a href=\"mailto:info@ncane.com\"><i>info@ncane.com</i></a> to let us know, or click <a href=\"index.php\">here</a> to try again.");
	$dbname = DB_NAME;
	$db = @mysql_select_db($dbname, $connection) or die("BM: Could not select a valid database.");
}

/*
function DBCloseConnection()
{
	mysql_close($connection);
}

function DBCloseConnectionUpdate()
{
	mysql_close($connectionUpdate);
}

function DBCloseConnectionInsert()
{
	mysql_close($connectionInsert);
}
*/

function CheckURLExists($url)
{
	$url = @parse_url($url);

	if (! $url) {
		return false;
	}

	$url = array_map('trim', $url);
	$url['port'] = (!isset($url['port'])) ? 80 : (int)$url['port'];
	$path = (isset($url['path'])) ? $url['path'] : '';

	if ($path == '')
	{
		$path = '/';
	}

	$path .= (isset ($url['query'])) ? "?$url[query]" : '';

	if (isset ($url['host']) AND $url['host'] != gethostbyname ($url['host']))
	{
		try
		{
			$headers = get_headers("$url[scheme]://$url[host]:$url[port]$path");
			$headers = (is_array ($headers)) ? implode ("\n", $headers) : $headers;
			return (bool) preg_match ('#^HTTP/.*\s+[(200|301|302)]+\s#i', $headers);
		}
		catch (Exception $getHeaderException)
		{
			return false;
		}
	}
	return false;
}

function SanitiseURI($randomString)
{
	// get the request_uri out of the browser, and strip off the first "/".
	// sanitise the uri to avoid any unwanted characters
	// adapted from http://mysite.verizon.net/vzep00rh/formhandler.html

	$randomString = str_replace("/ncane.com", "", $randomString);
	$randomString = ltrim($randomString, "/");
	$randomString = trim($randomString);
	$randomString = preg_replace("/\s\s+/", " ", $randomString);// multiple spaces
	$randomString = preg_replace("/[^a-zA-z0-9 ]/", "", $randomString);// non alphanumeric
	$randomString = preg_replace("/ /", ",", $randomString);// spaces to commas
	$randomString = substr($randomString, 0, 15);
	return $randomString;
}

function IncreaseHitCounter($id)
{
	DBConnectUpdate();
	// update the hit counter for this page
	$hitincrsql = "UPDATE ncane_tbl SET ncane_hit = ncane_hit + 1, ncane_lastdate = NOW() WHERE ncane_id = '" .
		$id . "'";
	mysql_query($hitincrsql) or die(mysql_error());
	//DBCloseConnectionUpdate();
}

function CheckImageExtension($id, $URL)
{
	// Checks whether URL ends with an image extension
	// in gif, jpg, jpeg, png or swf
	ob_clean();
	$checkimg = 0;
	$newlen = strlen($url) - 4;
	if (substr($URL, $newlen, 4) == ".jpg")
		$checkimg = 1;
	if (substr($URL, $newlen, 4) == ".gif")
		$checkimg = 1;
	if (substr($URL, $newlen, 4) == "jpeg")
		$checkimg = 1;
	if (substr($URL, $newlen, 4) == ".png")
		$checkimg = 1;
	if (substr($URL, $newlen, 4) == ".swf")
		$checkimg = 1;
	if (substr($URL, $newlen, 4) == ".cgi")
		$checkimg = 1;
	if (strpos(strtolower($URL), '/ncane.com/eset') > 0)
		$checkimg = 1;
	if (strpos(strtolower($URL), 'topkapi') > 0)
		$checkimg = 1;
	if (strpos(strtolower($URL), 'rabryst') > 0)
		$checkimg = 1;
	if (strpos(strtolower($URL), 'itsol.co.za') > 0)
		$checkimg = 1;
	if (strpos(strtolower($URL), 'xqrx.com') > 0)
		$checkimg = 1;
	if ($checkimg == 1)
	{
		ShowNcaneURL($URL);
		exit;
	}
}

function ShowNcaneURL($URL)
{
	// Redirects to the URL
	ob_clean();
	header("Location: $URL");
	exit;
}

function ShowBlankPage()
{
	// Displays a blank page
	ob_clean();
	echo "Your IP address is banned. Someone on your IP range is either blacklisted on a realtime block list, or your IP range was manually banned by our automatic system.";
	exit;
}

function ShowMainPage()
{
	// Displays main page
	ob_clean();
	require_once ("header.php");
	require_once ("std.php");
	require_once ("footer.php");
	exit;
}

function ShowAdultContent($URL)
{
	// Checks if adult flag is true
	ob_clean();
	require_once ("header.php");
	echo "<br>\n\n";
	echo "<font face=\"sans-serif\" size=\"3\"><b><font color=\"red\">ADULT CONTENT WARNING!</font></b>\n\n";
	echo "<br><br>The URL you entered has been classified by the link creator as an adult-oriented site.\n";
	echo "<br><br><font color=\"red\"><b>If you received this link in an email, please DO NOT click \"continue\" unless you are sure that the link is safe to look at. NCANE.COM does not tolerate spam or abuse of our services. Please contact us on abuse@ncane.com to report spam.</b></font>\n";
	echo "<br>You must be 18 years or older to view the URL. If you are 18 or older, click <a href=\"" .
		$URL . "\"><b>continue</b></a>.\n\n";
	echo "<font size=\"1\"><br>(By clicking \"continue\", you agree that you are over the age of 18.)</font>\n";
	echo "<br><font size=\"1\">(Link " . (strlen($URL) > 50 ? "starts with: " : "is: ") . substr($URL, 0, 50) . (strlen($URL) > 50 ? "..." : "") . ")</font>.\n";
	require_once ("footer.php");
	exit;
}

function ShowExecutable($URL)
{
	// Checks if URL is an EXE file
	ob_clean();
	require_once ("header.php");
	echo "<br>\n\n";
	echo "<font face=\"sans-serif\" size=\"2\"><b><font color=\"red\">EXECUTABLE FILE WARNING!</font></b>\n\n";
	echo "<br><br>The URL you entered is an executable file.\n";
	echo "<br>Please ensure that your antivirus software is up to date.\n";
	echo "<br>NCANE.COM is not responsible for any content downloaded from this page.\n";
	echo "<br><br><font color=\"red\"><b>If you received this link in an email, please DO NOT click \"continue\" unless you are sure that the link is safe to look at. NCANE.COM does not tolerate spam or abuse of our services. Please contact us on abuse@ncane.com to report spam.</b></font>\n";
	echo "<br>Click <font size=\"3\"><a href=\"" .
		$URL . "\"><b>continue</b></a></font> to download the file at your own risk.\n\n";
	echo "<font size=\"1\"><br>(By clicking \"continue\", you agree that you wish to download the executable file.)</font>\n";
	echo "<br><font size=\"1\">(Link " . (strlen($URL) > 50 ? "starts with: " : "is: ") . substr($URL, 0, 50) . (strlen($URL) > 50 ? "..." : "") . ")</font>.\n";
	require_once ("footer.php");
	exit;
}

function ShowFreeLinkNotice($URL, $hits)
{
	// If hit counter exceeds a certain value, show this intermediate page
	ob_clean();
	require_once ("header.php");
	echo "<br>\n\n";
	echo "<font face=\"sans-serif\" size=\"2\"><b><font color=\"red\">FREE LINK NOTIFICATION</font></b>\n\n";
	echo "<br><br>The URL you requested has been accessed " . $hits . " times.\n";
	echo "<br><br>NCANE.COM is supported by advertising.\n";
	echo "<br><br><font color=\"red\"><b>If you received this link in an email, please DO NOT click \"continue\" unless you are sure that the link is safe to look at. NCANE.COM does not tolerate spam or abuse of our services. Please contact us on abuse@ncane.com to report spam.</b></font>\n";
	echo "<br><br><font size=\"3\">You can continue to the site you entered by clicking <a href=\"" .
		$URL . "\"><b>continue</b></a></font>.\n";
	echo "<br><font size=\"1\">(Link " . (strlen($URL) > 50 ? "starts with: " : "is: ") . substr($URL, 0, 50) . (strlen($URL) > 50 ? "..." : "") . ")</font>.\n";
	require_once ("footer.php");
	exit;
}

// function to generate random strings
function RandomString($length = 5)
{
	$randstr = '';
	srand((double)microtime() * 1000000);
	//our array
	$chars = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm',
		'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', '0', '1', '2',
		'3', '4', '5', '6', '7', '8', '9');
	for ($rand = 0; $rand <= $length; $rand++)
	{
		$random = rand(0, count($chars) - 1);
		$randstr .= $chars[$random];
	}
	return $randstr;
}

function WriteMailer($URLcatcher)
{

	$m_from_n = trim($_COOKIE['NcaneUserName']);
	$m_from_m = trim($_COOKIE['NcaneUserMail']);
	if (strlen($m_from_m) > 0)
		$m_cookie_chk = " checked";
	$tab = "\t\t\t\t\t\t\t";

	$mail_form_writer = "";

	$mail_form_writer .= $tab . "<p><hr></p>\n";
	$mail_form_writer .= $tab . "<form action=\"xmit.php\" method=\"post\">\n";
	$mail_form_writer .= $tab . "<table width=\"80%\">\n";
	$mail_form_writer .= $tab . "\t<tr><td align=\"left\" valign=\"middle\" colspan=\"2\"><font size=\"2\"><b>Send this link to a friend!</b> <font size=\"1\" color=\"#FF0000\">(* Required fields)</td></tr>\n";
	$mail_form_writer .= $tab . "\t<tr height=\"4\"><td colspan=\"2\" align=\"center\"><font size=\"1\"> </font></td></tr>\n";
	$mail_form_writer .= $tab . "\t<tr><td align=\"right\"><font size=\"2\"><font color=\"#FF0000\">*</font> Your friend's name:</font></td><td align=\"left\"><input type=\"text\" name=\"m_to_name\" size=\"30\" maxlength=\"100\"></td></tr>\n";
	$mail_form_writer .= $tab . "\t<tr><td align=\"right\"><font size=\"2\"><font color=\"#FF0000\">*</font> Your friend's e-mail address:</font></td><td align=\"left\"><input type=\"text\" name=\"m_to_mail\" size=\"30\" maxlength=\"100\"></td></tr>\n";
	$mail_form_writer .= $tab . "\t<tr><td align=\"right\"><font size=\"2\">Link description:</font></td><td align=\"left\"><input type=\"text\" name=\"m_descr\" size=\"30\" maxlength=\"100\"></td></tr>\n";
	$mail_form_writer .= $tab . "\t<tr height=\"4\"><td colspan=\"2\" align=\"center\"><font size=\"1\"> </font></td></tr>\n";
	$mail_form_writer .= $tab . "\t<tr><td align=\"right\"><font size=\"2\"><font color=\"#FF0000\">*</font> Your name:</font></td><td align=\"left\"><input type=\"text\" name=\"m_from_name\" value=\"" .
		$m_from_n . "\" size=\"30\" maxlength=\"100\"></td></tr>\n";
	$mail_form_writer .= $tab . "\t<tr><td align=\"right\"><font size=\"2\"><font color=\"#FF0000\">*</font> Your e-mail address:</font></td><td align=\"left\"><input type=\"text\" name=\"m_from_mail\" value=\"" .
		$m_from_m . "\" size=\"30\" maxlength=\"100\"></td></tr>\n";
	$mail_form_writer .= $tab . "\t<tr><td align=\"right\" valign=\"middle\"><font size=\"2\">Remember details:</font></td><td align=\"left\" valign=\"middle\"><input type=\"checkbox\" name=\"m_cookie\" value=\"checked\"" .
		$m_cookie_chk . "><font size=\"1\">(Remember your name and email.<br>PLEASE NOTE: cookies must be enabled!)</font></td></tr>\n";
	$mail_form_writer .= $tab . "\t<tr height=\"4\"><td colspan=\"2\" align=\"center\"><font size=\"1\"> </font></td></tr>\n";
	$mail_form_writer .= $tab . "\t<tr><td align=\"center\" colspan=\"2\"><font size=\"1\">(Your IP Address has been logged. Any abuse will be reported to your ISP.)</font></td></tr>\n";
	$mail_form_writer .= $tab . "\t<tr><td colspan=\"2\"><input type=\"hidden\" name=\"m_link\" value=\"" .
		$URLcatcher . "\"></td></tr>\n";
	$mail_form_writer .= $tab . "\t<tr><td align=\"right\"><input type=\"submit\" value=\"Send E-mail\"></td><td align=\"left\"><input type=\"reset\" value=\"Clear Form\"></td></tr>\n";
	$mail_form_writer .= $tab . "</table>\n";
	$mail_form_writer .= $tab . "</form>\n";

	return $mail_form_writer;
}

function CheckArray($rString, $array)
	// Searching array for existence of generated string
{
	$result = 0;
	$temp = array_search($rString, $array);
	if ($temp > 0)
	{
		$result = 1;
	}
	unset($temp);
	return $result;
}
?>
