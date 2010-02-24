<?
// Make sure the form was indeed POSTed:
// (requires your html form to use: action="post")
if (!$_SERVER['REQUEST_METHOD'] == "POST")
{
	die("Forbidden - You are not authorized to view this page");
	header("Location: /");
}

// Host names from where the form is authorised
// to be posted from:
$authHosts = array("ncane.com", "ncane.co.za");

// Where have we been posted from?
$fromArray = parse_url(strtolower($_SERVER['HTTP_REFERER']));

// Test to see if the $fromArray used www to get here.
$wwwUsed = strpos($fromArray['host'], "www.");

// Make sure the form was posted from an approved host name.
if (!in_array(($wwwUsed === false ? $fromArray['host']:substr(stristr($fromArray['host'],
	'.'), 1)), $authHosts))
{
	header("Location: /");
	exit;
}

// Attempt to defend against header injections:
$badStrings = array("Content-Type:", "MIME-Version:",
	"Content-Transfer-Encoding:", "bcc:", "cc:");

// Loop through each POSTed value and test if it contains
// one of the $badStrings:
foreach ($_POST as $k => $v)
{
	foreach ($badStrings as $v2)
	{
		if (strpos($v, $v2) !== false)
		{
			header("Location: /");
			exit;
		}
	}
}

// Made it past spammer test, free up some memory
// and continue rest of script:
unset($k, $v, $v2, $badStrings, $authHosts, $fromArray, $wwwUsed);

$m_cookie = trim($_POST['m_cookie']);

if ($m_cookie == "checked")
{
	$expiration = time() + 60 * 60 * 24 * 30;
	setcookie("NcaneUserName", $m_from_name, $expiration);
	setcookie("NcaneUserMail", $m_from_mail, $expiration);
}
else
{
	setcookie("NcaneUserName", "", time() - 3600);
	setcookie("NcaneUserMail", "", time() - 3600);
}

require_once ("header.php");
?>
							<br>

							<font face="sans-serif" size="2">

<?

$m_to_mail = trim($_POST['m_to_mail']);
$m_to_name = trim($_POST['m_to_name']);
$m_link = trim($_POST['m_link']);
$m_from_mail = trim($_POST['m_from_mail']);
$m_from_name = trim($_POST['m_from_name']);
$m_descr = trim($_POST['m_descr']);

$strIP = $_SERVER['REMOTE_ADDR'];
$date = date('Y/m/d G:i:s');

$m_to_name = preg_replace("/\s\s+/", " ", $m_to_name);// multiple spaces
$m_to_name = preg_replace("/[^a-zA-z0-9 ]/", "", $m_to_name);// non alphanumeric
$m_from_name = preg_replace("/\s\s+/", " ", $m_from_name);// multiple spaces
$m_from_name = preg_replace("/[^a-zA-z0-9 ]/", "", $m_from_name);// non alphanumeric
$m_descr = preg_replace("/\s\s+/", " ", $m_descr);// multiple spaces
$m_descr = preg_replace("/[^a-zA-z0-9 ]/", "", $m_descr);// non alphanumeric

if (preg_match('/^([0-9a-zA-Z]([-.\w]*[0-9a-zA-Z])*@([0-9a-zA-Z][-\w]*[0-9a-zA-Z]\.)+[a-zA-Z]{2,9})$/i',
	$m_to_mail) || preg_match('/^([0-9a-zA-Z]([-.\w]*[0-9a-zA-Z])*@([0-9a-zA-Z][-\w]*[0-9a-zA-Z]\.)+[a-zA-Z]{2,9})$/i',
	$m_from_mail))
{
	if((stristr($m_to_mail, '.ru') === TRUE) || ((stristr($m_to_mail, '.cn') === TRUE)))
	{
		$m_to_mail = "";
		$m_from_mail = "";
	}
}

if (preg_match('/^([0-9a-zA-Z]([-.\w]*[0-9a-zA-Z])*@([0-9a-zA-Z][-\w]*[0-9a-zA-Z]\.)+[a-zA-Z]{2,9})$/i',
	$m_to_mail))
{
	if (preg_match('/^([0-9a-zA-Z]([-.\w]*[0-9a-zA-Z])*@([0-9a-zA-Z][-\w]*[0-9a-zA-Z]\.)+[a-zA-Z]{2,9})$/i',
		$m_from_mail))
	{

		$m_body = "";

		$m_body .= "Dear " . $m_to_name . ",\n\n";
		$m_body .= $m_from_name .
			" thought you might be interested in the following link, courtesy of ncane.com, the small URL generator:\n\n";
		$m_body .= "http://ncane.com/" . $m_link . "\n\n";

		if (trim($m_descr) != "")
		{
			$m_body .= "Description: " . $m_descr . "\n\n";
		}

		$m_body .= "This email was sent at " . date("Y/m/d G:i:s") .
			" from http://ncane.com/.\n";
		$m_body .= "If you received this message in error, please forward this e-mail\n";
		$m_body .= "and all headers to spam@ncane.com.\n\n";
		$m_body .= "--\n\n";
		$m_body .= "-ncane.com- the small URL generator\n";

		DBConnect();//false is for R/O, true is for R/W
		$check_mail = mysql_query("SELECT mail_id FROM mail_tbl WHERE mail_to_mail = '" .
			$m_to_mail . "' AND ncane_id = '" . $m_link . "'") or die(mysql_error());
		$result = mysql_num_rows($check_mail);

		if ($result == 0)
		{

			echo "</center><font size=\"1\"><pre>" . $m_body;
			echo "</pre></font><center>";

			echo "<p>";

			$sql = "INSERT INTO mail_tbl VALUES ('', '" . $date . "', '" . $strIP . "', '" .
				$m_to_mail . "', '" . $m_to_name . "', '" . $m_from_mail . "', '" . $m_from_name .
				"', '" . $m_link . "')";
			mysql_query($sql) or die(mysql_error());
			//DBCloseConnection();

			if (trim($m_descr) == "")
			{
				mail($m_to_name . " <" . $m_to_mail . ">", "[ncane.com] Interesting Link", $m_body,
					"From: " . $m_from_name . " <" . $m_from_mail . ">\r\n" . "Reply-To: " . $m_from_name .
					" <" . $m_from_mail . ">");
			}
			else
			{
				mail($m_to_name . " <" . $m_to_mail . ">", "[ncane.com] " . $m_descr, $m_body,
					"From: " . $m_from_name . " <" . $m_from_mail . ">\r\n" . "Reply-To: " . $m_from_name .
					" <" . $m_from_mail . ">");
			}

			echo "Mail delivered successfully!";

		}
		else
		{

			echo "<b>Link already sent</b><p>Thank you for using <b>ncane.com</b>.<br><br>Fortunately, your requested recipient (<i>" .
				$m_to_mail . "</i>) has already received the link <b>http://ncane.com/" . $m_link .
				"</b>.<br><br>To avoid abuse of our email service, your email has NOT been sent.<br><br>If you have any queries in this regard, please contact us on <a href=\"mailto:email@ncane.com\"><i>email@ncane.com</i></a>.</p>";

		}

		echo "</p>";

	}
	else
	{
		echo "Invalid email address for \"From:\" address.";
	}
}
else
{
	echo "Invalid email address for \"To:\" address.";
}

require_once ("footer.php");
?>
