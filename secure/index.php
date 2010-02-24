<html>

<head><title>NCANE.COM - small URL generator</title></head>

<body>

<font face="Arial" size="2">

<?php

echo "<h3>NCANE.COM Administration Panel</h3>\n";

echo "For this to work, you have to know the redirector ID. For example, if \"http://ncane.com/q4r\" has been blacklisted, the redirector ID is <i>q4r</i>.\n";

echo "<br><br>\n";

echo "<form action=\"lock.php\" method=\"post\">\n";

echo "Lock redirector ID: <input type=text name=ncane_id>\n";

echo "<input type=\"submit\" value=\"Lock URL\">\n";
echo "<input type=\"reset\" value=\"Clear\">\n";

echo "</form>\n";

echo "<br>\n";

echo "<form action=\"unlock.php\" method=\"post\">\n";

echo "Unlock redirector ID: <input type=text name=ncane_id>\n";

echo "<input type=\"submit\" value=\"Unlock URL\">\n";
echo "<input type=\"reset\" value=\"Clear\">\n";

echo "</form>\n";

?>

</font>

</body>

</html>