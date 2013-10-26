<?php

class MemberList {
	
	public function create($name, $org_id) {
		global $db;
		
		$db->insert('lists', array(
			'name' => $name,
			'organization_id' => $org_id
		));
		
	}
	
	public function edit($id, $name, $org_id) {
		global $db;
		
		$db->update('lists', array(
			'name' => $name,
			'organization_id' => $org_id
		), " id='{$id}'");
		
	}
	
	public function delete($id) {
		global $db;
		
		$db->delete('listlink', "list_id='{$id}'");
		$db->delete('lists', "id='{$id}'");
		
	}
	
	public function add_member_to($list_id, $member_id) {
		global $member;
		$member->add_to_list($list_id, $member_id);
	}
	
	public function remove_member_from($list_id, $member_id) {
		global $member;
		$member->remove_from_list($list_id, $member_id);
	}
	
	public function get_lists($org_id) {
		global $db;
		return $db->select("SELECT id,name FROM lists WHERE organization_id='{$org_id}';");
	}
	
	public function get_members_of_list($list_id) {
		// this sql statement might not work
		global $db;
		return $db->select("SELECT members.id,members.name FROM members WHERE listlink.list_id='{list_id}' LEFT OUTER JOIN listlink ON (listlink.member_id = member.id);");
	}
	
}

$lists = new MemberList();

?>
