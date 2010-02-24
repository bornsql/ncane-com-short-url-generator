<?
/**
 * UserInfo.php
 *
 * This page is for users to view their account information
 * with a link added for them to edit the information.
 *
 * Written by: Jpmaster77 a.k.a. The Grandmaster of C++ (GMC)
 * Last Updated: August 26, 2004
 */

require_once ("session.php");

/* Requested Username error checking */
//$req_user = trim($_GET['user']);

if($session->logged_in)
{
	$req_user = $session->username;
	if(!$req_user || strlen($req_user) == 0 ||
	   !eregi("^([0-9a-z])+$", $req_user) ||
	   !$database->usernameTaken($req_user)){
	//   die("You are not permitted to view this page. Your IP address (" . $_SERVER['REMOTE_ADDR'] . ") has been recorded.");
	   header("Location: login.php");
   }
}
else
{
   header("Location: login.php");
}

require_once ("header.php");
echo "<table><tr><td>";

/* Logged in user viewing own account */
if(strcmp($session->username,$req_user) == 0)
{
   echo "<h3>NCANE.COM Premium User Account Information</h3>";

	/* Display requested user information */
	$req_user_info = $database->getUserInfo($req_user);

	/* Username */
	echo "<b>Username: ".$req_user_info['username']."</b><br>";

	/* Email */
	echo "<b>Email:</b> ".$req_user_info['email']."<br>";

}
/* Visitor not viewing own account */
else
{
   header("Location: login.php");
}

//else{
//   echo "<h1>User Info</h1>";
//}

/**
 * Note: when you add your own fields to the users table
 * to hold more information, like homepage, location, etc.
 * they can be easily accessed by the user info array.
 *
 * $session->user_info['location']; (for logged in users)
 *
 * ..and for this page,
 *
 * $req_user_info['location']; (for any user)
 */

/* If logged in user viewing own account, give link to edit */
if(strcmp($session->username,$req_user) == 0)
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

echo "</td></tr></table>";
require_once ("footer.php");

?>
