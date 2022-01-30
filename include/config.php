<?php

define("WEB_TITLE", "Fpe News Droid");
define("WEB_URL", "localhost");
define("WEB_TEL","+123456789");
define("WEB_EMAIL","support@fpenewsdroid.com");
define("WEB_ADDRESS","Federal Polytechnic Ede, Osun State");


require_once 'db.php';
require_once 'func.php';



$pageName = WEB_TITLE;
$web_url = WEB_URL;
$email_message = new message();
$sendMail = new emailMessage();
@$user_state = user_details('acct_state');




