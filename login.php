<?

require_once ("header.php");

// User has already logged in, so display relevant links, including
// a link to the admin Centre if the user is an administrator.

echo "<table><tr><td>";

if($session->logged_in)
{
	echo "<h3>NCANE.COM Premium User Control Panel</h3>";
	echo "Welcome <b>$session->username</b>, you are logged in. <br><br>";
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
else
{
?>

<h3>NCANE.COM Premium User Login</h3>
<?
/**
 * User not logged in, display the login form.
 * If user has already tried to login, but errors were
 * found, display the total number of errors.
 * If errors occurred, they will be displayed.
 */
if($form->num_errors > 0)
{
   echo "<font size=\"1\" color=\"#ff0000\">".$form->num_errors." error(s) found</font>";
}
?>
<form action="process.php" method="POST">
<table align="left" border="0" cellspacing="0" cellpadding="3">
<tr><td>Username:</td><td><input type="text" name="user" maxlength="30" value="<? echo $form->value("user"); ?>"></td><td><? //echo $form->error("user"); ?></td></tr>
<tr><td>Password:</td><td><input type="password" name="pass" maxlength="30" value="<? echo $form->value("pass"); ?>"></td><td><? //echo $form->error("pass"); ?></td></tr>
<tr><td colspan="2" align="left"><input type="checkbox" name="remember" <? if($form->value("remember") != ""){ echo "checked"; } ?>>
<font size="1">Remember me next time &nbsp;&nbsp;&nbsp;&nbsp;
<input type="hidden" name="sublogin" value="1">
<input type="submit" value="Login"></td></tr>

<?php

$today = date("Ymd");
if ($today < '20090101')
{
	echo "<tr><td colspan=\"2\" align=\"left\"><br><font size=\"1\">[<a href=\"forgotpass.php\">Forgot Password?</a>]</font></td><td align=\"right\"></td></tr>\n";
	echo "<tr><td colspan=\"2\" align=\"left\"><br>Not registered? <a href=\"register.php\">Sign-Up!</a></td></tr>\n";
}
?>

</table>
</form>

<?
}

/**
 * Just a little page footer, tells how many registered members
 * there are, how many users currently logged in and viewing site,
 * and how many guests viewing site. Active users are displayed,
 * with link to their user information.
 */
echo "</td></tr></table>";
//echo "<b>Member Total:</b> ".$database->getNumMembers()."<br>";
//echo "There are $database->num_active_users registered members and ";
//echo "$database->num_active_guests guests viewing the site.<br><br>";

//require_once ("view_active.php");

require_once ("footer.php");

?>