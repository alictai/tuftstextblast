<?php

register_page_type('404', 'NotFoundPage');

class NotFoundPage extends Page {
	
	public $login_required = false;
	
	public function __construct() {
		parent::__construct('Page Not Found', '404');
	}


	public function content() {
		echo 'Page Not Found';
	}
	
}

?>
