<?
/**
 * UserEdit.php
 *
 * This page is for users to edit their account information
 * such as their password, email address, etc. Their
 * usernames can not be edited. When changing their
 * password, they must first confirm their current password.
 *
 * Written by: Jpmaster77 a.k.a. The Grandmaster of C++ (GMC)
 * Last Updated: August 26, 2004
 */

require_once ("header.php");

echo "<table><tr><td>";

/**
 * User has submitted form without errors and user's
 * account has been edited successfully.
 */
if(isset($_SESSION['useredit'])){
   unset($_SESSION['useredit']);
   
   $oops = 1;
   
   echo "<h3>NCANE.COM Premium User Account Edit</h3>";
   echo "<p><b>$session->username</b>, your account has been successfully updated. ";
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
else{
?>

<?
/**
 * If user is not logged in, then do not display anything.
 * If user is logged in, then display the form to edit
 * account information, with the current email address
 * already in the field.
 */
if($session->logged_in){
?>

<h3>NCANE.COM Premium User Account Edit : <? echo $session->username; ?></h3>
<?
if($form->num_errors > 0){
   echo "<td><font size=\"2\" color=\"#ff0000\">".$form->num_errors." error(s) found</font></td>";
}
?>
<form action="process.php" method="POST">
<table align="left" border="0" cellspacing="0" cellpadding="3">
<tr>
<td>Current Password:</td>
<td><input type="password" name="curpass" maxlength="30" value="
<?echo $form->value("curpass"); ?>"></td>
<td><? echo $form->error("curpass"); ?></td>
</tr>
<tr>
<td>New Password:</td>
<td><input type="password" name="newpass" maxlength="30" value="
<? echo $form->value("newpass"); ?>"></td>
<td><? echo $form->error("newpass"); ?></td>
</tr>
<tr>
<td>Email:</td>
<td><input type="text" name="email" maxlength="50" value="
<?
if($form->value("email") == ""){
   echo $session->userinfo['email'];
}else{
   echo $form->value("email");
}
?>">
</td>
<td><? echo $form->error("email"); ?></td>
</tr>
<tr><td colspan="2" align="right">
<input type="hidden" name="subedit" value="1">
<input type="submit" value="Edit Account"></td></tr>
<tr><td colspan="2" align="left"></td></tr>
</table>
</form>

<?
}
}

echo "</td></tr></table>";

if ($oops != 1){
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

?>
