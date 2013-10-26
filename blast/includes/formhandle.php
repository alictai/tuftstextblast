<?php

function ajax_switch() {
	
	if (!isSet($_GET['f'])) { return; }
	
	$action = $_GET['f'];
	switch($action) {
		case 'createList': createList(); break;
		case 'editList': editList(); break;
		case 'deleteList': deleteList(); break;
		
		case 'addContactToList': addContactToList(); break;
		case 'removeContactFromList': removeContactFromList(); break;
		
		case 'createMember': createMember(); break;
		case 'editMember': editMember(); break;
		case 'deleteMember': deleteMember(); break;
		
		case 'sendMessage': sendMessage(); break;
	
	}
	
}

function createList() {
	global $list;
	
	$org_id = intval($_COOKIE['org_id']);
	$name = $_GET['name'];
	$list->create($name, $org_id);
	
}

function editList() {
	global $list;
	
	$id = intval($_GET['list_id']);
	$org_id = intval($_COOKIE['org_id']);
	$name = $_GET['name'];
	$list->create($id, $name, $org_id);
	
}

function deleteList() {
	global $list;
	
	$id = intval($_GET['list_id']);
	$list->delete($id);
	
}

function addContactToList() {
	global $list;
	
	$list_id = intval($_GET['list_id']);
	$member_id = intval($_GET['member_id']);
	$list->add_member_to($list_id, $member_id);
	
}

function removeContactFromList() {
	global $list;
	
	$list_id = intval($_GET['list_id']);
	$member_id = intval($_GET['member_id']);
	$list->remove_member_from($list_id, $member_id);
	
}


function createMember() {
	global $member;
	
	$org_id = intval($_COOKIE['org_id']);
	$name = $_GET['name'];
	$phone = $_GET['phone'];		// this needs to be checked for proper input
	$member->create($name, $phone, $org_id);
	
}

function editMember() {
	global $member;
	
	$org_id = intval($_COOKIE['org_id']);
	$id = intval($_GET['list_id']);
	$name = $_GET['name'];
	$phone = $_GET['phone'];		// this needs to be checked for proper input
	$member->create($id, $name, $phone, $org_id);
	
}

function deleteMember() {
	global $member;
	
	$id = intval($_GET['member_id']);
	$member->delete($id);
	
}


function sendMessage() {
	global $messages;
	
	$message = $_GET['message'];
	$list_id = intval($_GET['list_id']);
	
	$messages->send_message($message, $list_id);
	
}



?>
