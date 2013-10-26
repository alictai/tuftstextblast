<?php

register_page_type('home', 'HomePage');

class HomePage extends Page {
	
	public $login_required = false;
	
	public function __construct() {
		parent::__construct('Tufts Text Alerts', 'home');
	}


	public function content() {
		global $db;
?>

this is a test


<?php
	}
	
}

?>
