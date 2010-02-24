<?
require_once ("header.php");

if($session->logged_in)
{
?>
							<form action="make.php" method="POST">

							<br>

							<font face="sans-serif" size="2">
							<i>ncane</i> is a Zulu word meaning "small", and that's what we're doing here: saving you space.

							<br><br>
							<b>ADVERTISER LINKS : <?php echo $session->username ?></b>

							<br><br>
							This page shows your links created on <i><b>ncane.com</b></i>.

							<br>
							
							<table><tr><td><font size="1">

							<ol>

							<?php

DBConnect();
$toptensql = "SELECT ncane_id, ncane_url, ncane_desc, ncane_hit FROM ncane_tbl WHERE user_name = '$session->username' ORDER BY ncane_hit DESC";
$result = mysql_query($toptensql) or die('Query failed: ' . mysql_error());

while ($row = mysql_fetch_array($result, MYSQL_ASSOC))
{
	$ncane_url = $row['ncane_url'];

	if (strlen($ncane_url) > 50)
	{
		$ncane_url = substr($ncane_url, 0, 50) . "...";
	}

	$ncane_id = "http://ncane.com/" . $row['ncane_id'];
	$ncane_hit = $row['ncane_hit'];
	$ncane_desc = $row['ncane_desc'];

	if ($row['ncane_hit'] < 2)
	{
		$hit_text = " hit";
	}
	else
	{
		$hit_text = " hits";
	}

	echo "\t<li><a href=\"" . $ncane_id . "\" target=\"_blank\">" . $ncane_url .
		"</a> - " . $ncane_desc . " - " . $ncane_hit . $hit_text . "</li>";
}
//DBCloseConnection();

?>

							</ol>

<?php
	echo "<table align=\"center\" width=\"100%\"><tr><td align=\"center\"><p><hr></p>";
	echo "[<a href=\"userinfo.php\">My Account</a>] ";
	echo "[<a href=\"useredit.php\">Edit Account</a>] ";
	echo "[<a href=\"userlinks.php\">My URLs</a>] ";
	if($session->isAdmin())
	{
		echo "[<a href=\"admin.php\">Admin Centre</a>] ";
	}
	echo "[<a href=\"process.php\">Logout</a>]";
	echo "</td></tr></table>";
 ?>
							
							</font></td></tr></table><br>

<? require_once ("footer.php");
}
else
{
   header("Location: index.php");
}
?>
