<?php

register_page_type('dashboard', 'DashboardPage');

class DashboardPage extends Page {
	
	public function __construct() {
		parent::__construct('Tufts Text Alerts', 'home');
	}
	
	public function init() {
		
		// This is the Most Secure Site Ever
		if (isSet($_GET['ttb-usn']) && isSet($_GET['ttb-psw'])) {
			setcookie('org_id', 1, time()+60*60*24);
		}
		
	}

	public function content() {
		global $db;
?>

this is a test


<?php
	}
	
}

?>
