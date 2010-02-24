<? require_once ("header.php"); ?>
							<form action="make.php" method="POST">

							<br>

							<font face="sans-serif" size="2">
							<i>ncane</i> is a Zulu word meaning "small", and that's what we're doing here: saving you space.
							<br><br>
							LIVE SITE LAUNCHED ON 14 FEBRUARY 2008 (after two years of beta testing).
							<br><br>
							<b>WHAT'S NEW ON NCANE.COM</b>
							<br>
							
							<div align="left">
							<ul>
								<li><i><b>ncane.com</b></i> now incorporates an intermediate page for URLs of executable files (.exe only) to
									warn users of potentially dangerous files. Users are given the option to download the file should they feel
									it is safe.<br><br></li>
								<li><i><b>ncane.com</b></i> now incorporates an intermediate page, displaying Google Ads, to support the cost
									of traffic to this site. Owing to the terms and conditions of Google AdSense, users will
									be required to manually click the link should they wish to follow it. Premium subscribers will not see this
									intermediate page. (This intermediate page only affects links with 25 or more hits, and does not include images).<br><br></li>
								<li><i><b>ncane.com</b></i> periodically (and on request) expires URLs that are in violation of the terms of use. These do not
									include stale URLs (older than six months with zero hit count), which are deleted from the database periodically as well.<br><br></li>
								<li><i><b>ncane.com</b></i> is growing in leaps and bounds since its inception on 3 February 2006 as
									a way to make long and / or difficult to remember URLs much shorter (and permanent).<br><br></li>
								<li>The <i><b>ncane.com</b></i> family now includes the following URLs: <b>ncane.com</b>, <b>ncane.co.za</b>,
									<b>ncane.net</b>, <b>kleinurl.com</b>, <b>kleinurl.co.za</b>, <b>kleinurl.net</b>, <b>minurl.co.za</b>,
									<b>minurl.net</b> and <b>adres.co.za</b>.<br><br></li>
								<li><i><b>ncane.com</b></i> generates short random alphanumeric URLs using a proprietary algorithm,
									or you can choose your own (Premium service only).<br><br></li>
								<li><i><b>ncane.com</b></i> checks for addresses that have already been added to the database and
									displays the already-created URL.<br><br></li>
								<li><i><b>ncane.com</b></i> lets you email your link to a friend, including a brief description. For
									security reasons, and to prevent spam, you cannot email the same link to the same email address
									more than once.<br><br></li>
								<li><i><b>ncane.com</b></i> remembers your name and email address, so that you don't have to type it
									in every time you want to send a link by email. This can also be turned off.<br><br></li>
								<li><i><b>ncane.com</b></i> allows URL creation for adult-oriented sites, and provides a warning page
									before displaying the target URL (Premium service only). The free service is checked periodically
									for adult sites and tagged accordingly.<br><br></li>
								<li><i><b>ncane.com</b></i> reserves the right to expire any sites deemed inappropriate, and where
									applicable in the case of illegal sites, will report the creator of the link to their Service
									Provider.<br><br></li>
								<li>Links with a 0 hit-count and created more than six months in the past will be recycled.<br><br></li>
								<li><i><b>ncane.com</b></i> shows a list of the ten most clicked links.<br><br></li>
								<!-- <li><i><b>ncane.com</b></i> is in a BETA TESTING PHASE. If you find any problems, please feel free to
									write to us on <a href="mailto:info@ncane.com"><i>info@ncane.com</i></a> with details.</li> -->
							</ul>
							
							</div>

							<?php
echo URLCounter();
require_once ("footer.php"); ?>
