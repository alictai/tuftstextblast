<?php

class Messages {
	
	private $Tw_AccountSid = "AC54866d5fd21cf7a6368f1b259d6e041e";
	private $Tw_AuthToken = "88a40d6396d768629bfe7f4d6f64b627";
	
	private $Twillio;
	
	public function __construct() {
		
		//$this->Twillio = new Services_Twilio($this->Tw_AccountSid, $this->Tw_AuthToken);
		
	}
	
	public function get_messages($organization_id) {
		global $db;
		$db->select("SELECT message FROM messages WHERE organization_id = '{$organization_id}';");
	}
	
	public function get_scheduled_messages($list_id) {
		//THIS WILL NOT EXIST 
	}
	
	public function send_message($message, $list_id, $org_id) {
		global $db;

		$from_r = $db->select("SELECT phone FROM organizations where org_id = '{$org_id}';");
		$from = $from_r['phone'];

		$members = $db->select("SELECT members.phone,members.phone_email FROM members WHERE listlink.list_id = {$list_id} LEFT OUTER JOIN listlink ON (listlink.member_id = member.id);");
		foreach($members as $member) {
			//$client->account->messages->sendMessage($from, $member['phone'], $message);
			//mail($member->email, , $message)
		}
		$this->store_message($message);
	}
	
	public function store_message($message, $org_id, $list_id) {
		global $db;

		$db->insert('messages',array(
			'message' => $message,
			'list_id' => $list_id,
			'organization_id' => $org_id
			));
	}
	
	public function schedule_message($message) {
		//NOT YET!
	}
	
}

$messages = new Messages();

?>
