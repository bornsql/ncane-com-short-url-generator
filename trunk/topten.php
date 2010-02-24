<?
require_once ("header.php");

?>

							<form action="make.php" method="POST">

							<br>

							<font face="sans-serif" size="2">
							<i>ncane</i> is a Zulu word meaning "small", and that's what we're doing here: saving you space.

							<br><br>
							<b>STATISTICS:</b>
							
							<br><br>
							
							TOP TEN

							<table><tr><td><font size="2">

							<ol>

							<?php

DBConnect();
$toptensql = "SELECT ncane_id, ncane_url, ncane_hit FROM ncane_tbl where ncane_exp = 0 ORDER BY ncane_hit DESC LIMIT 0, 10";
$result = mysql_query($toptensql) or die('Query failed: ' . mysql_error());

while ($row = mysql_fetch_array($result, MYSQL_ASSOC))
{
	$ncane_url = $row['ncane_url'];
	$ncane_id = "http://ncane.com/" . $row['ncane_id'];
	$ncane_hit = $row['ncane_hit'];

	if ($row['ncane_hit'] < 2)
	{
		$hit_text = " hit";
	}
	else
	{
		$hit_text = " hits";
	}

	echo "\t<li><a href=\"" . $ncane_id . "\" target=\"_blank\">" . $ncane_id .
		"</a> - " . number_format($ncane_hit, 0, '.', ',') . $hit_text . "</li>\n";
}

//DBCloseConnection();
?>

							</ol>
							
							</table>
							
							<br><br>
							ELEVEN TO TWENTY-FIVE

							<table><tr><td><font size="2">

							<ol start="11">

							<?php

DBConnect();
$toptensql = "SELECT ncane_id, ncane_url, ncane_hit FROM ncane_tbl where ncane_exp = 0 ORDER BY ncane_hit DESC LIMIT 10, 15";
$result = mysql_query($toptensql) or die('Query failed: ' . mysql_error());

while ($row = mysql_fetch_array($result, MYSQL_ASSOC))
{
	$ncane_url = $row['ncane_url'];
	$ncane_id = "http://ncane.com/" . $row['ncane_id'];
	$ncane_hit = $row['ncane_hit'];

	if ($row['ncane_hit'] < 2)
	{
		$hit_text = " hit";
	}
	else
	{
		$hit_text = " hits";
	}

	echo "\t<li><a href=\"" . $ncane_id . "\" target=\"_blank\">" . $ncane_id .
		"</a> - " . number_format($ncane_hit, 0, '.', ',') . $hit_text . "</li>\n";
}

//DBCloseConnection();
?>

							</ol>

							</table>

							<br><br>
							TOP TEN CONTRIBUTORS

							<table><tr><td><font size="2">

							<ol>

							<?php

DBConnect();
$toptensql = "SELECT ncane_ip, count(ncane_ip) as ncane_counter FROM ncane_vw where ncane_exp = 0 and ncane_ip <> '127.255.255.255' GROUP BY ncane_ip ORDER BY count(ncane_ip) DESC LIMIT 0, 10";
$result = mysql_query($toptensql) or die('Query failed: ' . mysql_error());

while ($row = mysql_fetch_array($result, MYSQL_ASSOC))
{
	$ncane_ip = $row['ncane_ip'];
	$ncane_hit = $row['ncane_counter'];

	if ($row['ncane_counter'] < 2)
	{
		$hit_text = " URL";
	}
	else
	{
		$hit_text = " URLs";
	}

	echo "\t<li>" . number_format($ncane_hit, 0, '.', ',') . $hit_text . "</li>\n";
}

//DBCloseConnection();
?>

							</ol>

							<? echo URLCounter(); ?>

							</font></td></tr></table>

<? require_once ("footer.php"); ?>
