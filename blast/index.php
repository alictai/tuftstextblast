<?php

error_reporting(E_ALL);

define('ABSPATH', dirname(__FILE__).'\\');
define('SITEPATH', 'http://localhost/Projects/Tufts/TextBlast/tuftstextblast/blast');

// Include Everything
include('includes/connect.php');

include('includes/admin.class.php');
include('includes/db.class.php');
include('includes/display.class.php');
include('includes/list.class.php');
include('includes/member.class.php');
include('includes/page.class.php');
include('includes/pageaction.php');

include('includes/formhandle.php');
include('includes/scheduled.php');
include('includes/textback.php');

//include('includes/twillio/package.php');

// Page Subclasses
foreach(glob(ABSPATH."Includes/Pages/*.php") as $file) {
	require($file);
}


// Do Something Else if AJAX
if (defined('AJAX_MODE') && AJAX_MODE) { 
	ajax_switch();
	die();
}


$page = PageAction::SetAction();
PageAction::CheckAuthorization();

$page->init();

include('theme/header.php');
$page->content();
include('theme/footer.php');

?>