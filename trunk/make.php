<?php

require_once ("session.php");

$banned_ip = CheckBannedIP($_SERVER['REMOTE_ADDR']);

if ($banned_ip == 1)
{
	ShowBlankPage();
	exit;
}

if($session->logged_in)
{
	$username = $session->username;
	$ncane_id = $_POST['ncane_id'];
	$ncane_desc = $_POST['ncane_desc'];
	$optID = $_POST['optID'];
}
else
{
	$username = 'free_user';
	$ncane_desc = 'Free';
}

$m_adult = trim($_POST['m_adult']);

$strAdult = 0;

if ($m_adult == "checked")
{
	$strAdult = 1;
}

$strURL = $_POST['strURL'];
if (trim($strURL) == "")
	$strURL = $_GET['strURL'];
$strURL = ltrim($strURL, "/");
$strURL = rtrim($strURL, "/");
$strURL = trim($strURL);
$strURL = preg_replace("/\s\s+/", " ", $strURL);// multiple spaces
$strURL = preg_replace("/ /", "%20", $strURL);// spaces to %20
$tab = "\t\t\t\t\t\t\t";

if (strlen($strURL) > 512)
{
	$strURL = substr(trim($strURL), 0, 2000);
	echo "<b>IMPORTANT NOTE</b>: Your URL has been truncated to the first 2000 characters. It may not function correctly.<br><br>";
}// checks for URLs over 2000 characters long

if (trim($strURL) == "")
{
	header("Location: index.php");
}

if (strtolower(substr($strURL, 0, 7)) != "http://")
{
	if (strtolower(substr($strURL, 0, 8)) != "https://")
	{
		$strURL = "http://" . $strURL;
	}
}
// prepends "http://" to the string ... does not validate existing string, merely attaches if it can't be found at the beginning.

// Check that the link being added does not contain the URLs from any of the group's sites:
// ncane.com, ncane.net, ncane.co.za, kleinurl.com, kleinurl.net,
// kleinurl.co.za, minurl.net, minurl.co.za, adres.co.za or derivations

$sr_flag = CheckBannedDomains($strURL);

if ($sr_flag == 1)
{
	// Self-Referencing flag raised to avoid people creating infinite loops
	require_once ("header.php");
	echo "<br>";
	echo "<font face=\"sans-serif\" size=\"2\">\n\n";
	echo "<font color=\"#FF0000\"><b>FORBIDDEN URL WARNING</b></font>\n\n";
	echo "<br><br>You may not create a link using the URL you provided. This behaviour is by design.\n\n";
	require_once ("footer.php");
	$strURL = "";
	exit;
}

if (strlen(trim($strURL)) == 0)
{
	$URL = "/";
	header("Location: $URL");
}
else
{

	require_once ("header.php"); ?>

							<br>

							<font face="sans-serif" size="2">

<?php

	if (preg_match('/^(http|https):\/\/[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}' .
		'((:[0-9]{1,5})?\/.*)?$/i', $strURL))
	{

		// Load the random strings from the database to compare against the random string.
		DBConnect();
		$check_id = mysql_query("SELECT ncane_id FROM ncane_tbl") or die(mysql_error());

		$x = 0;
		while ($row = mysql_fetch_assoc($check_id))
		{
			// Add all elements of SQL to array
			$check_array[$x] = trim($row['ncane_id']);
			$x++;
		}

		//DBCloseConnection();

		unset($x);

		if ($optID == "own")
		{
			$randomString = $ncane_id;
		}
		else
		{
			$i = 1;
			$randomString = RandomString($i);
		}

		// DEBUG $randomString = "8j";

		$result = CheckArray($randomString, $check_array);

		while ($result != 0)
		{

			// Check if logged in, otherwise do normal random generation
			if($session->logged_in)
			{
				if ($optID == "own")
				{
					echo "You have selected a short URL that already occurs in the database. Please try again.";
					echo "<input type=\"hidden\" name=\"strURL\" value=\"" . $strURL . "\">";
					echo "<br><br>Target URL: <b>" . $strURL . "</b>";
					echo "<br><br>";
					echo "<input type=\"hidden\" name=\"optID\" value=\"own\"> Choose own link (max 15-char): http://ncane.com/<input type=\"text\" size=\"10\" maxlength=\"15\" name=\"ncane_id\">";
					echo "<br><br>";
					echo "<input type=\"hidden\" name=\"ncane_desc\" value=\"" . $ncane_desc . "\">";
					echo "Description:<br>";
					echo "<b>" . $ncane_desc . "</b>";
					echo "<input type=\"hidden\" name=\"username\" value=\"" . $username . "\">";
					echo "<br><br>";
					echo "<input type=\"submit\" value=\"Ncane! (Create URL)\">";
					echo "<input type=\"reset\" value=\"Sula! (Clear)\">";
					echo "<p><hr></p>";
				}
				else
				{
					for ($i = 1; $i < 9; $i++)
					{
						$randomString = RandomString($i);
						//echo "Getting new Random String!";
						$result = CheckArray($randomString, $check_array);
						if ($result == 0)
							break;
					}
				}
			}
			else
			{
				for ($i = 1; $i < 9; $i++)
				{
					$randomString = RandomString($i);
					//echo "Getting new Random String!";
					$result = CheckArray($randomString, $check_array);
					if ($result == 0)
						break;
				}
			}
		}

		if ($result == 0)
		{

			// Continue Processing
			// ----

			// Check that the URL does not already exist in the database.
			DBConnect();
			$check_url = mysql_query("SELECT ncane_id, ncane_url FROM ncane_tbl WHERE ncane_url = '" .
				$strURL . "'") or die(mysql_error());

			while ($row = mysql_fetch_assoc($check_url))
			{
				$result_id = $row['ncane_id'];
				$result_url = $row['ncane_url'];
			}
			//DBCloseConnection();

			if ($result_url == $strURL)
			{

				// echo $tab . "THIS SITE IS IN A BETA TESTING PHASE!<br><br>\n";
				echo $tab . "You have requested a Ncane URL for the following address:<br><br>" .
					$strURL . "<br><br><hr><br>\n";
				echo $tab . "The URL was already added to the Ncane database. Please bookmark the following link:<br><br>\n";

				$newString = "http://ncane.com/" . $result_id;

				echo $tab . "<a href=\"" . $newString . "\" target=\"_blank\">" . $newString . "</a>\n";
				echo $tab . "<br><br><i>This link is " . strlen($newString) . " characters, or " .
					number_format(strlen($newString) / strlen($strURL) * 100, 2, ".", "") .
					"% of the size of your original link (" . strlen($strURL) . " characters)</i>\n";
				echo $tab . "<br><br>";

				echo URLCounter();
				$form_writer = WriteMailer($result_id);
				echo $form_writer;

			}
			else
			{

				$isValidURL = CheckURLExists($strURL);

				if ($isValidURL == true)
				{
					// Insert this row into the database:
					$strIP = $_SERVER['REMOTE_ADDR'];
					DBConnectInsert();

					// ip address as string
					// $sql = "INSERT INTO ncane_tbl VALUES ('" . $randomString . "', '" . $username . "', '" . $strURL .
					// 	"', '" . $ncane_desc . "', 0, '" . $strIP . "', NOW(), NOW(), 0, " . $strAdult . ")";

					// ip address as int
					$sql = "INSERT INTO ncane_tbl (ncane_id, user_name, ncane_url, ncane_desc, ncane_hit, ncane_ip, ncane_date,
					    ncane_lastdate, ncane_exp, ncane_adult) VALUES ('" . $randomString . "', '" . $username . "', '" .
						$strURL . "', '" . $ncane_desc . "', 0, INET_ATON('" . $strIP . "'), NOW(), NOW(), 0, " . $strAdult . ")";
	
					mysql_query($sql) or die(mysql_error());

					//DBCloseConnectionInsert();

					// echo $tab . "THIS SITE IS IN A BETA TESTING PHASE!<br><br>\n";
					echo $tab . "You have requested a Ncane URL for the following address:<br><br>" .
						$strURL . "<br><br><hr><br>\n";
					echo $tab . "Add this link to your bookmarks by right-clicking on the link below.<br><br>\n";
	
					$newString = "http://ncane.com/" . $randomString;
	
					echo $tab . "<a href=\"" . $newString . "\" target=\"_blank\">" . $newString .
						"</a>\n";
					echo $tab . "<br><br><i>This link is " . strlen($newString) . " characters, or " .
						number_format(strlen($newString) / strlen($strURL) * 100, 2, ".", "") .
						"% of the size of your original link (" . strlen($strURL) . " characters)</i>\n";
					echo $tab . "<br><br>\n";

					/* start temp code
					{
						mail("<temp@ncane.com>", "[ncane.com] New link created", $sql,
						"From: <website@ncane.com>\r\n" . "Reply-To: <website@ncane.com>");
					}
					finish temp code */
					
					echo URLCounter();
					$form_writer = WriteMailer($randomString);
					echo $form_writer;
				}
				else
				{
					echo $strURL . ' does not exist. Please try again.<br><br>';
				}

			}

		}
		else
		{

			echo "An unlikely event has occurred! Error # x030.<br><br>Please mail us at <a href=\"mailto:info@ncane.com\"><i>info@ncane.com</i></a> to let us know, or click <a href=\"/\">here</a> to try again.";

		}
	}
	else
	{
		echo $strURL . ' is <b>not</b> a valid URL. Please try again.<br><br>';
	}

	if($session->logged_in)
	{
		echo "<table><tr><td><p><hr></p>";
		echo "[<a href=\"userinfo.php\">My Account</a>] ";
		echo "[<a href=\"useredit.php\">Edit Account</a>] ";
		echo "[<a href=\"userlinks.php\">My URLs</a>] ";
		if($session->isAdmin())
		{
			echo "[<a href=\"admin.php\">Admin Centre</a>] ";
		}
		echo "[<a href=\"process.php\">Logout</a>]";
		echo "</td></tr></table>";
	}

	require_once ("footer.php");

} ?>
