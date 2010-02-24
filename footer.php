<?

$tab1 = "\t";
$tab2 = "\t\t";
$tab3 = "\t\t\t";
$tab4 = "\t\t\t\t";
$tab5 = "\t\t\t\t\t";
$tab6 = "\t\t\t\t\t\t";
$tab7 = "\t\t\t\t\t\t\t";

echo $tab7 . "<p><hr></p>\n";
echo $tab7 . "<form action=\"make.php\" method=\"POST\" name=\"n\">\n";
echo $tab7 . "Type any<font color=\"#ff0000\">*</font> long URL in the box provided, and watch our generator create a much <b>shorter</b>\n";
echo $tab7 . "<br>\n";
echo $tab7 . "(and <b>permanent</b>) URL for you that will take you <b>directly</b> to the original address.\n";
echo $tab7 . "<br><br>\n";
//echo $tab7 . "(The URL you enter will be validated. If it does not exist, a short URL will not be generated.)\n";
//echo $tab7 . "<br><br>\n";
echo $tab7 . "<input type=\"text\" size=\"80\" maxlength=\"2000\" name=\"strURL\">\n";
echo $tab7 . "<br>\n";
echo $tab7 . "<input type=\"checkbox\" name=\"m_adult\" value=\"checked\"> Check this box if the target URL contains any adult content\n";

if($session->logged_in)
{
	echo $tab7 . "<p align=\"left\">\n";
	echo $tab7 . "<input type=\"radio\" name=\"optID\" value=\"rnd\"> Randomly generated link <b>OR</b>\n";
	echo $tab7 . "<br>\n";
	echo $tab7 . "<input type=\"radio\" name=\"optID\" value=\"own\"> Choose own link (max 15-char): http://ncane.com/<input type=\"text\" size=\"10\" maxlength=\"15\" name=\"ncane_id\">\n";
	echo $tab7 . "</p>\n";
	echo $tab7 . "Description:<br>\n";
	echo $tab7 . "<input type=\"text\" size=\"80\" maxlength=\"255\" name=\"ncane_desc\">\n";
	echo $tab7 . "<input type=\"hidden\" name=\"username\" value=\"" . $session->username . "\">\n";
}

echo $tab7 . "<br><br>\n";

echo $tab7 . "<input type=\"submit\" value=\"Ncane! (Make it small)\">\n";
echo $tab7 . "<input type=\"reset\" value=\"Sula! (Clear)\">\n";

echo $tab7 . "<br><br>\n";
echo $tab7 . "Still can't find what you're looking for?\n";
echo $tab7 . "<br><br>\n";
?>
<table cellpadding="0" cellspacing="0" border="0" align="center">
<tr align="center">
<td align="center">
<style type="text/css">
@import url(http://www.google.co.za/cse/api/branding.css);
</style>
<div class="cse-branding-bottom" style="background-color:#EEEEEE;color:#000000">
  <div class="cse-branding-form">
    <form action="http://www.google.co.za/cse" id="cse-search-box">
      <div>
        <input type="hidden" name="cx" value="<GOOGLE_ID>" />
        <input type="hidden" name="ie" value="ISO-8859-1" />
        <input type="text" name="q" size="31" />
        <input type="submit" name="sa" value="Search" />
      </div>
    </form>
  </div>
  <div class="cse-branding-logo">
    <img src="http://www.google.com/images/poweredby_transparent/poweredby_FFFFFF.gif" alt="Google" />
  </div>
  <div class="cse-branding-text">
    Custom Search
  </div>
</div>

</td>
</tr>
</table>
<?php

echo $tab7 . "<br><br>\n";
echo $tab7 . "<a href=\"index.php\">Home</a> -\n";

if($session->logged_in)
{
	echo $tab7 . "<a href=\"userinfo.php\">My Account</a> -\n";
}
else
{
	echo $tab7 . "<a href=\"login.php\">My Account</a> -\n";
}

echo $tab7 . "<a href=\"about.php\">About Us</a> -\n";
echo $tab7 . "<a href=\"news.php\">What's New</a> -\n";
echo $tab7 . "<a href=\"link.php\">Link To Us</a> -\n";
echo $tab7 . "<a href=\"topten.php\">Top Hits</a> -\n";
echo $tab7 . "<a href=\"advertise.php\">Advertise With Us</a>\n";
//echo $tab7 . "<p>BETA TESTING PHASE ENDING SOON!</p>\n";
echo $tab7 . "<p><font color=\"red\" size=\"1\"><b>* WE RESERVE THE RIGHT TO DENY ACCESS TO CERTAIN URLs. SPAM AND ILLEGAL USE OF OUR SERVICE IS FORBIDDEN, AND WILL RESULT IN EXPIRATION OF THE LINKS AND REPORTING TO YOUR INTERNET SERVICE PROVIDER AND LOCAL LAW ENFORCEMENT.</b></font></p>\n";

echo $tab7 . "<p><i>(<a href=\"http://www.site5.com\" target=\"_blank\">Site5.com</a>, this site's ISP, is the most awesome ISP ever. They are <b>not</b> idiots. If you need hosting, speak to them first.)</i></p>\n";

echo $tab7 . "</font>\n";
echo $tab7 . "</form>\n";
echo $tab6 . "</center>\n";
echo $tab5 . "</td>\n";
echo $tab4 . "</tr>\n";
echo $tab3 . "</table>\n";
echo $tab3 . "<table align=\"center\">\n";
echo $tab4 . "<tr>\n";
echo $tab5 . "<td colspan=\"2\" align=\"center\"><font face=\"sans-serif\" size=\"1\">Copyright &copy; 2010 <a href=\"http://itsol.co.za/\" title=\"Intelligent Technology Solutions\">Intelligent Technology Solutions</a>. All rights reserved. Logo by Delano.\n";
echo $tab6 . "<br>The NCANE family includes the following domain names:\n";
echo $tab6 . "<br><nobr>ncane.com, ncane.co.za, ncane.net, kleinurl.com, kleinurl.co.za, kleinurl.net, minurl.co.za, minurl.net, adres.co.za</nobr>\n";
echo $tab6 . "<br>\n";
echo $tab6 . "<br>Report spam on abuse@ncane.com.\n";
//echo $tab6 . "<br>\n";
//echo $tab6 . "<br>Last modified 23 October 2008, including spam URLs and expired links removed.\n";
echo $tab6 . "<br><br>\n";
echo $tab5 . "</td>\n";
echo $tab4 . "</tr>\n";
echo $tab4 . "<tr>\n";
echo $tab5 . "<td valign=\"middle\" align=\"center\" width=\"234\">\n";
echo $tab6 . "<script type=\"text/javascript\"><!--\n";
echo $tab6 . "google_ad_client = \"<GOOGLE_ID>\";\n";
echo $tab6 . "google_ad_width = 234;\n";
echo $tab6 . "google_ad_height = 60;\n";
echo $tab6 . "google_ad_format = \"234x60_as\";\n";
echo $tab6 . "google_ad_type = \"text_image\";\n";
echo $tab6 . "google_ad_channel =\"4805890056\";\n";
echo $tab6 . "google_color_border = \"000000\";\n";
echo $tab6 . "google_color_bg = \"F0F0F0\";\n";
echo $tab6 . "google_color_link = \"0000FF\";\n";
echo $tab6 . "google_color_url = \"008000\";\n";
echo $tab6 . "google_color_text = \"000000\";\n";
echo $tab6 . "//--></script>\n";
echo $tab6 . "<script type=\"text/javascript\"\n";
echo $tab6 . "  src=\"http://pagead2.googlesyndication.com/pagead/show_ads.js\">\n";
echo $tab6 . "</script>\n";
echo $tab5 . "</td>\n";
echo $tab5 . "<td valign=\"middle\" align=\"center\" width=\"180\">\n";
echo $tab6 . "<script type=\"text/javascript\"><!--\n";
echo $tab6 . "google_ad_client = \"<GOOGLE_ID>\";\n";
echo $tab6 . "google_ad_width = 180;\n";
echo $tab6 . "google_ad_height = 60;\n";
echo $tab6 . "google_ad_format = \"180x60_as_rimg\";\n";
echo $tab6 . "google_cpa_choice = \"<GOOGLE_ID>\";\n";
echo $tab6 . "//--></script>\n";
echo $tab6 . "<script type=\"text/javascript\" src=\"http://pagead2.googlesyndication.com/pagead/show_ads.js\">\n";
echo $tab6 . "</script>\n";
echo $tab5 . "</td>\n";
echo $tab4 . "</tr>\n";
echo $tab3 . "</table>\n";
echo $tab2 . "</td>\n";
echo $tab1 . "</tr>\n";
echo "</table>\n";
echo "<script type=\"text/javascript\">\n";
echo "var gaJsHost = ((\"https:\" == document.location.protocol) ? \"https://ssl.\" : \"http://www.\");\n";
echo "document.write(unescape(\"%3Cscript src='\" + gaJsHost + \"google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E\"));\n";
echo "</script>\n";
echo "<script type=\"text/javascript\">\n";
echo "try {\n";
echo "var pageTracker = _gat._getTracker(\"<GOOGLE_ID>\");\n";
echo "pageTracker._trackPageview();\n";
echo "} catch(err) {}</script>\n";
echo "</body>\n";
echo "</html>\n";
?>

