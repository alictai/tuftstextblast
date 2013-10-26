<?php

register_page_type('login', 'LoginPage');

class LoginPage extends Page {
	
	public $login_required = false;
	
	public function __construct() {
		parent::__construct('Tufts Text Alerts -- Login', 'home');
	}


	public function content() {
		global $db;
?>

this is the login page


<?php
	}
	
}

?>

