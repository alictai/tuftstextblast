<?php

register_page_type('contacts', 'ContactsPage');

class ContactsPage extends Page {
	
	public function __construct() {
		parent::__construct('Edit Contacts - Tufts Text Alerts', 'contacts');
	}
	
	public function init() {
		
		
	}

	public function content() {
		global $db; global $members; global $lists;
?>

<div id="header">
	<h1>Tufts Text Blast</h1>
	<h4>Fall Hackthon 2013</h4>
</div>
<div class="colmask threecol">
	<div class="colmid">
			<div class="colleft">
				<div class="col1">
					<!-- COLUMN 1 START [CENTER]-->
					<h3 class="yellow">CONTACTS</h3>
					<div id="contacts">
						
						<ul>

<?php

foreach($members->get_members(ORG_ID) as $mem) {
	echo '<li>';
		echo '<a href="#" class="contact-detail-link">'.$mem->name.'</a>';
		echo '<div class="contact-detail-display">';
			echo '<p><strong>'.$mem->name.'</strong><br />';
			echo $mem->phone.'</p>';
			
			echo '<p>Lists:</p><ul>';
			foreach($members->get_list_of_member($mem->id) as $list) {
				echo '<li>'.$list->name.' <a href="Javascript:removeContactFromList('.$list->id.', '.$mem->id.');" class="remove-link">Remove</a></li>';
			}
			if ($db->get_last_result()->num_rows == 0) {
				echo '<li>No lists.</li>';
			}
			echo '</ul>';
			
			echo '<select><option></option>';

foreach($lists->get_lists(ORG_ID) as $list) {
	echo '<option value="'.$list->id.'">'.$list->name.'</option>';
}

			echo '</select>';
						

			
		echo '</div>';
	echo '</li>';
}

?>
							
						</ul>
												
					</div>
					<!-- COLUMN 1 END [CENTER] -->
				</div>
				<div class="col2">
					<!-- COLUMN 2 START [LEFT] -->
					<h3 class="blue"><a href="?p=dashboard">< BACK</a></h3>
					<!-- COLUMN 2 END [LEFT] -->
				</div>
				<div class="col3">
					<!-- COLUMN 3 START [RIGHT] -->
					<h3 class="red">CONTACT INFO</h3>
					<div id="contact_info">
						
					</div>
					<!-- COLUMN 3 END [RIGHT] -->
				</div>
			</div>
		</div>
	</div>


<?php
	}
	
}

?>
