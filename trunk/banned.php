<?php

function CheckBannedIP($request)
{
	// Check for banned IP addresses
	$banned_ip = 0;
	if (substr($request, 0, 3) == "84.") $banned_ip = 1;
	if (substr($request, 0, 6) == "92.48.") $banned_ip = 1;
	if (substr($request, 0, 6) == "68.57.") $banned_ip = 1;
	if (substr($request, 0, 6) == "71.70.") $banned_ip = 1;
	if (substr($request, 0, 6) == "76.20.") $banned_ip = 1;
	if (substr($request, 0, 7) == "67.161.") $banned_ip = 1;
	if (substr($request, 0, 7) == "67.183.") $banned_ip = 1;
	if (substr($request, 0, 7) == "68.105.") $banned_ip = 1;
	if (substr($request, 0, 7) == "69.112.") $banned_ip = 1;
	if (substr($request, 0, 7) == "71.204.") $banned_ip = 1;
	if (substr($request, 0, 7) == "75.191.") $banned_ip = 1;
	if (substr($request, 0, 7) == "96.238.") $banned_ip = 1;
	if (substr($request, 0, 7) == "71.165.") $banned_ip = 1;
	if (substr($request, 0, 7) == "195.24.") $banned_ip = 1;
	if (substr($request, 0, 8) == "66.14.6.") $banned_ip = 1;
	if (substr($request, 0, 8) == "216.178.") $banned_ip = 1;
	if (substr($request, 0, 9) == "24.74.71.") $banned_ip = 1;
	if (substr($request, 0, 9) == "67.76.14.") $banned_ip = 1;
	if (substr($request, 0, 9) == "77.92.88.") $banned_ip = 1;
	if (substr($request, 0, 10) == "24.182.45.") $banned_ip = 1;
	if (substr($request, 0, 10) == "24.44.121.") $banned_ip = 1;
	if (substr($request, 0, 10) == "67.166.23.") $banned_ip = 1;
	if (substr($request, 0, 10) == "67.19.218.") $banned_ip = 1;
	if (substr($request, 0, 10) == "68.189.44.") $banned_ip = 1;
	if (substr($request, 0, 10) == "69.94.137.") $banned_ip = 1;
	if (substr($request, 0, 10) == "72.237.18.") $banned_ip = 1;
	if (substr($request, 0, 10) == "83.69.224.") $banned_ip = 1;
	if (substr($request, 0, 11) == "66.232.107.") $banned_ip = 1;
	if (substr($request, 0, 11) == "69.251.101.") $banned_ip = 1;
	if (substr($request, 0, 11) == "74.232.252.") $banned_ip = 1;
	if (substr($request, 0, 11) == "78.129.202.") $banned_ip = 1;
	if (substr($request, 0, 11) == "82.166.246.") $banned_ip = 1;
	if (substr($request, 0, 11) == "85.255.120.") $banned_ip = 1;
	if (substr($request, 0, 11) == "87.252.242.") $banned_ip = 1;
	if (substr($request, 0, 11) == "91.124.214.") $banned_ip = 1;
	if (substr($request, 0, 11) == "91.145.214.") $banned_ip = 1;
	if (substr($request, 0, 11) == "193.37.152.") $banned_ip = 1;
	if (substr($request, 0, 11) == "196.11.241.") $banned_ip = 1;
	if (substr($request, 0, 11) == "202.44.183.") $banned_ip = 1;
	if (substr($request, 0, 11) == "202.63.107.") $banned_ip = 1;
	if (substr($request, 0, 11) == "205.177.72.") $banned_ip = 1;
	if (substr($request, 0, 11) == "210.18.107.") $banned_ip = 1;
	if (substr($request, 0, 11) == "193.34.144.") $banned_ip = 1;
	if (substr($request, 0, 11) == "74.192.199.") $banned_ip = 1;
	if (substr($request, 0, 12) == "195.210.210.") $banned_ip = 1;
	if (substr($request, 0, 12) == "207.127.128.") $banned_ip = 1;
	return $banned_ip;
}

function CheckBannedDomains($strURL)
{
// Check that the link being added does not contain the URLs from any of the group's sites:
// ncane.com, ncane.net, ncane.co.za, kleinurl.com, kleinurl.net,
// kleinurl.co.za, minurl.net, minurl.co.za, adres.co.za or derivations

// These values are not stored in the database to reduce number of DB hits

	$sr_flag = 0;

	if (strpos(strtolower($strURL), 'ncane.com') > 0)
		$sr_flag = 1;
	if (strpos(strtolower($strURL), 'ncane.net') > 0)
		$sr_flag = 1;
	if (strpos(strtolower($strURL), 'ncane.co.za') > 0)
		$sr_flag = 1;
	if (strpos(strtolower($strURL), 'kleinurl.com') > 0)
		$sr_flag = 1;
	if (strpos(strtolower($strURL), 'kleinurl.net') > 0)
		$sr_flag = 1;
	if (strpos(strtolower($strURL), 'kleinurl.co.za') > 0)
		$sr_flag = 1;
	if (strpos(strtolower($strURL), 'minurl.net') > 0)
		$sr_flag = 1;
	if (strpos(strtolower($strURL), 'minurl.co.za') > 0)
		$sr_flag = 1;
	if (strpos(strtolower($strURL), 'adres.co.za') > 0)
		$sr_flag = 1;

	// BANNED DOMAINS start
	if (strpos(strtolower($strURL), 'myspace') > 0)
		$sr_flag = 1;
	if (strpos(strtolower($strURL), 'mayspace.') > 0)
		$sr_flag = 1;
	if (strpos(strtolower($strURL), 'myspcae.') > 0)
		$sr_flag = 1;
	if (strpos(strtolower($strURL), '.adlt.') > 0)
		$sr_flag = 1;
	if (strpos(strtolower($strURL), 'tracking101') > 0)
		$sr_flag = 1;
	if (strpos(strtolower($strURL), 'tinyurl.') > 0)
		$sr_flag = 1;
	if (strpos(strtolower($strURL), 'tinypic.') > 0)
		$sr_flag = 1;
	if (strpos(strtolower($strURL), 'seenplace') > 0)
		$sr_flag = 1;
	if (strpos(strtolower($strURL), 'freelife') > 0)
		$sr_flag = 1;
	if (strpos(strtolower($strURL), 'geocities') > 0)
		$sr_flag = 1;
	if (strpos(strtolower($strURL), 'shrunk.') > 0)
		$sr_flag = 1;
	if (strpos(strtolower($strURL), 'mb.com') > 0)
		$sr_flag = 1;
	if (strpos(strtolower($strURL), 'link-protec') > 0)
		$sr_flag = 1;
	if (strpos(strtolower($strURL), 'bbzspace') > 0)
		$sr_flag = 1;
	if (strpos(strtolower($strURL), 'shortenurl.') > 0)
		$sr_flag = 1;
	if (strpos(strtolower($strURL), 'smallerurl.') > 0)
		$sr_flag = 1;
	if (strpos(strtolower($strURL), 'imeem') > 0)
		$sr_flag = 1;
	if (strpos(strtolower($strURL), 'myturl.') > 0)
		$sr_flag = 1;
	if (strpos(strtolower($strURL), 'snipurl.') > 0)
		$sr_flag = 1;
	if (strpos(strtolower($strURL), 'tiny.cc') > 0)
		$sr_flag = 1;
	if (strpos(strtolower($strURL), 'fyad.org') > 0)
		$sr_flag = 1;
	if (strpos(strtolower($strURL), 'ustockonline.') > 0)
		$sr_flag = 1;
	if (strpos(strtolower($strURL), '4buy.') > 0)
		$sr_flag = 1;
	if (strpos(strtolower($strURL), 'elfurl.') > 0)
		$sr_flag = 1;
	if (strpos(strtolower($strURL), 'smurl.') > 0)
		$sr_flag = 1;
	if (strpos(strtolower($strURL), '6url.') > 0)
		$sr_flag = 1;
	if (strpos(strtolower($strURL), 'cuturl.') > 0)
		$sr_flag = 1;
	if (strpos(strtolower($strURL), 'shortenurl.') > 0)
		$sr_flag = 1;
	if (strpos(strtolower($strURL), 'deadsmall.') > 0)
		$sr_flag = 1;
	if (strpos(strtolower($strURL), 'cheapcityusa.') > 0)
		$sr_flag = 1;
	if (strpos(strtolower($strURL), 'masl.') > 0)
		$sr_flag = 1;
	if (strpos(strtolower($strURL), 'notlong.') > 0)
		$sr_flag = 1;
	if (strpos(strtolower($strURL), 'smallurl') > 0)
		$sr_flag = 1;
	if (strpos(strtolower($strURL), 'chueca') > 0)
		$sr_flag = 1;
	if (strpos(strtolower($strURL), 'gotoassist') > 0)
		$sr_flag = 1;
	if (strpos(strtolower($strURL), 'micrositehost') > 0)
		$sr_flag = 1;
	if (strpos(strtolower($strURL), 'sitefwd') > 0)
		$sr_flag = 1;
	if (strpos(strtolower($strURL), 'yourfasthost') > 0)
		$sr_flag = 1;
	if (strpos(strtolower($strURL), 'freehost') > 0)
		$sr_flag = 1;
	if (strpos(strtolower($strURL), 'freesitehost') > 0)
		$sr_flag = 1;
	if (strpos(strtolower($strURL), 'yourgoldhost') > 0)
		$sr_flag = 1;
	if (strpos(strtolower($strURL), 'ri.info') > 0)
		$sr_flag = 1;
	if (strpos(strtolower($strURL), 'blogspot.com') > 0)
		$sr_flag = 1;
	if (strpos(strtolower($strURL), 'synthebyte') > 0)
		$sr_flag = 1;
	if (strpos(strtolower($strURL), 'wblogs.org') > 0)
		$sr_flag = 1;
	if (strpos(strtolower($strURL), 'progetto') > 0)
		$sr_flag = 1;
	if (strpos(strtolower($strURL), 'performancing.com') > 0)
		$sr_flag = 1;
	if (strpos(strtolower($strURL), '.cn') > 0)
		$sr_flag = 1;
	if (strpos(strtolower($strURL), 'blog.com') > 0)
		$sr_flag = 1;
	if (strpos(strtolower($strURL), 'ropemeh.net') > 0)
		$sr_flag = 1;
	if (strpos(strtolower($strURL), 'werotiya.net') > 0)
		$sr_flag = 1;
	if (strpos(strtolower($strURL), 'xhost.ro') > 0)
		$sr_flag = 1;
	if (strpos(strtolower($strURL), 'host-page.com') > 0)
		$sr_flag = 1;
	if (strpos(strtolower($strURL), 'host.com') > 0)
		$sr_flag = 1;
	if (strpos(strtolower($strURL), 'myblog.ma') > 0)
		$sr_flag = 1;
	if (strpos(strtolower($strURL), 'sakolideg.net') > 0)
		$sr_flag = 1;
	if (strpos(strtolower($strURL), 'ijopa.info') > 0)
		$sr_flag = 1;
	if (strpos(strtolower($strURL), 'sakolideb.net') > 0)
		$sr_flag = 1;
	if (strpos(strtolower($strURL), 'redir.opoint.com') > 0)
		$sr_flag = 1;
	if (strpos(strtolower($strURL), 'hugeurl') > 0)
		$sr_flag = 1;
	if (strpos(strtolower($strURL), 'ctaill.com') > 0)
		$sr_flag = 1;
	if (strpos(strtolower($strURL), 'bloghi.com') > 0)
		$sr_flag = 1;
	if (strpos(strtolower($strURL), 'blogs.net') > 0)
		$sr_flag = 1;
	if (strpos(strtolower($strURL), 'citi.com') > 0)
		$sr_flag = 1;
	if (strpos(strtolower($strURL), 'logmein.com') > 0)
		$sr_flag = 1;
	if (strpos(strtolower($strURL), 'currencysource') > 0)
		$sr_flag = 1;
	if (strpos(strtolower($strURL), 'bit.ly') > 0)
		$sr_flag = 1;
	if (strpos(strtolower($strURL), 'j.mp') > 0)
		$sr_flag = 1;
	if (strpos(strtolower($strURL), 'payments.') > 0)
		$sr_flag = 1;
	if (strpos(strtolower($strURL), 'babochkashop') > 0)
		$sr_flag = 1;
	if (strpos(strtolower($strURL), 'globo.com') > 0)
		$sr_flag = 1;
	if (strpos(strtolower($strURL), 'hotshorturl.') > 0)
		$sr_flag = 1;
	if (strpos(strtolower($strURL), 'lix.in') > 0)
		$sr_flag = 1;
	if (strpos(strtolower($strURL), 'qype.') > 0)
		$sr_flag = 1;
	if (strpos(strtolower($strURL), 'medical-') > 0)
		$sr_flag = 1;
	if (strpos(strtolower($strURL), 'medsupermart') > 0)
		$sr_flag = 1;
	if (strpos(strtolower($strURL), '-network.') > 0)
		$sr_flag = 1;
	if (strpos(strtolower($strURL), 'paymate-') > 0)
		$sr_flag = 1;
	if (strpos(strtolower($strURL), 'themedicalnet') > 0)
		$sr_flag = 1;
	if (strpos(strtolower($strURL), 'themoneyfund') > 0)
		$sr_flag = 1;
	if (strpos(strtolower($strURL), 'getjob') > 0)
		$sr_flag = 1;
	if (strpos(strtolower($strURL), 'clickbank') > 0)
		$sr_flag = 1;
	if (strpos(strtolower($strURL), 'vitonlineoffice') > 0)
		$sr_flag = 1;
	if (strpos(strtolower($strURL), 'mycurriencies') > 0)
		$sr_flag = 1;
	if (strpos(strtolower($strURL), 'onlineofficevit') > 0)
		$sr_flag = 1;
	if (strpos(strtolower($strURL), 'revolvingcards') > 0)
		$sr_flag = 1;
	if (strpos(strtolower($strURL), 'softster') > 0)
		$sr_flag = 1;
	if (strpos(strtolower($strURL), 'buisness-smart.') > 0)
		$sr_flag = 1;
	if (strpos(strtolower($strURL), 'community.icontact.') > 0)
		$sr_flag = 1;
	if (strpos(strtolower($strURL), 'community.usatourist.') > 0)
		$sr_flag = 1;
	if (strpos(strtolower($strURL), 'crisislinefinance.') > 0)
		$sr_flag = 1;
	if (strpos(strtolower($strURL), 'musicplayer.') > 0)
		$sr_flag = 1;
	if (strpos(strtolower($strURL), 'forumotion.') > 0)
		$sr_flag = 1;
	if (strpos(strtolower($strURL), 'slimdevices.com') > 0)
		$sr_flag = 1;
	if (strpos(strtolower($strURL), 'successin10steps.') > 0)
		$sr_flag = 1;
	if (strpos(strtolower($strURL), 'wetpaint.') > 0)
		$sr_flag = 1;
	if (strpos(strtolower($strURL), 'coroflot.') > 0)
		$sr_flag = 1;
	if (strpos(strtolower($strURL), 'fuel.tv') > 0)
		$sr_flag = 1;
	if (strpos(strtolower($strURL), 'jacksonville.com') > 0)
		$sr_flag = 1;
	if (strpos(strtolower($strURL), 'kendo-world.com') > 0)
		$sr_flag = 1;
	if (strpos(strtolower($strURL), 'world66.com') > 0)
		$sr_flag = 1;

	// BANNED DOMAINS end

	return $sr_flag;

}

?>