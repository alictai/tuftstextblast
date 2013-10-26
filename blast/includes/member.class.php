<?php

class Member {
	
	public function create($name, $phone, $org_id) {
		global $db;
		
		$db->insert('members', array(
			'name' => $name,
			'phone' => $phone,
			'organization_id' => $org_id
		));
		
	}
	
	public function edit($id, $name, $phone, $org_id) {
		global $db;
		
		$db->update('members', array(
			'name' => $name,
			'phone' => $phone,
			'organization_id' => $org_id
		), "id='{$id}'");
		
	}
	
	public function delete($id) {
		global $db;
		
		$db->delete('listlink', "member_id='{$id}'");
		$db->delete('members', "id='{$id}'");
		
	}
	
	// Phone Number Must Be Stored as +1xxxxxxxxxx
	public function add_to_list($list_id, $member_id) {
		global $db;
		$db->insert('listlink', array(
			'list_id'=>$list_id,
			'member_id' => $member_id
		));
	}
	
	public function remove_from_list($list_id, $member_id) {
		global $db;
		$db->delete('listlink', "member_id='{$member_id}' AND list_id='{$list_id}'");
	}
	
	public function get_members($org_id) {
		global $db;
		return $db->select("SELECT id,name,phone FROM members WHERE organization_id='{$org_id}';");
	}
	
	public function get_list_of_member($member_id) {
		global $db;
		return $db->select("SELECT listlink.id,lists.name FROM lists LEFT OUTER JOIN listlink ON (listlink.list_id = lists.id) WHERE listlink.member_id='{$member_id}';");
	}
	
	
}

$members = new Member();

?>
