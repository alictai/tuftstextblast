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

	<br/><br/><br/><br/><br/><br/><br/>
	<h1 id="login_header">Tufts Text Blast</h1>
	<h4>Fall Hackthon 2013</h4>
	<br/>
	<div id="login_form">
		<form>
			Username: <input type="text" name="firstname">
			&nbsp;&nbsp;|&nbsp;&nbsp;
			Password: <input type="password" name="lastname"><br/><br/>
			<!--<input type="submit" value="Login">-->
			<p id="fake_login"><a href="?p=dashboard">Login</a></p>
		</form>
	</div>


<?php
	}
	
}

?>

