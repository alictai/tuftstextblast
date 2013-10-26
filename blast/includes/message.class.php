<?php

class Messages {
	
	private $Tw_AccountSid = "AC54866d5fd21cf7a6368f1b259d6e041e";
	private $Tw_AuthToken = "88a40d6396d768629bfe7f4d6f64b627";
	
	private $Twillio;
	
	public function __construct() {
		
		$this->Twillio = new Services_Twilio($this->Tw_AccountSid, $this->Tw_AuthToken);
		
	}
	
	public function get_messages($list_id) {
		
	}
	
	public function get_scheduled_messages($list_id) {
		
	}
	
	public function send_message($message, $list_id) {
		
	}
	
	public function store_message($message) {
		
	}
	
	public function schedule_message($message) {
		
	}
	
}

$messages = new Messages();

?>
