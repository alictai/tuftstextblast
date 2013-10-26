<?php

register_page_type('dashboard', 'DashboardPage');

class DashboardPage extends Page {
	
	public function __construct() {
		parent::__construct('Tufts Text Alerts', 'home');
	}
	
	public function init() {
		
		// This is the Most Secure Site Ever
		//if (isSet($_GET['ttb-usn']) && isSet($_GET['ttb-psw'])) {
		setcookie('org_id', 1, time()+60*60*24);
		//}
			
		sleep(1);
		
	}

	public function content() {
		global $db;
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
					<h3 class="yellow">SENT MESSAGES</h3>
					<div id="sent_messages"></div>
					<ul>
						<li class="message">
							<p class="title">Message</p>
							<p class="body">Polaroid Schlitz VHS narwhal PBR, blog Pitchfork XOXO pickled brunch High Life. Ethnic food truck squid flexitarian cray Tonx, Marfa narwhal Odd Future gentrify </p>
						</li>
						<li class="message">
							<p class="title">Message</p>
							<p class="body">typewriter ugh irony. Brunch leggings pug Echo Park, Vice 8-bit paleo Bushwick chia food truck. Sustainable Tumblr Truffaut, narwhal Cosby sweater bicycle food truck.</p>
						</li>
						<li class="message">
							<p class="title">Message</p>
							<p class="body">sweater bicycle rights sartorial master cleanse. Tote bag ugh cliche Bushwick mlkshk, YOLO 3 wolf moon flannel jean shorts synth tofu fixie Pitchfork viral</p>
						</li>
						<li class="message">
							<p class="title">Message</p>
							<p class="body">sweater bicycle rights sartorial master cleanse. Tote bag ugh cliche Bushwick mlkshk, YOLO 3 wolf moon flannel jean shorts synth tofu fixie Pitchfork viral</p>
						</li>
						<li class="message">
							<p class="title">Message</p>
							<p class="body">sweater bicycle rights sartorial master cleanse. Tote bag ugh cliche Bushwick mlkshk, YOLO 3 wolf moon flannel jean shorts synth tofu fixie Pitchfork viral</p>
						</li>
					</ul>
					<!-- COLUMN 1 END [CENTER] -->
				</div>
				<div class="col2">
					<!-- COLUMN 2 START [LEFT] -->
					<h3 class="blue">NEW MESSAGE</h3>
					<form id="msg_form">
						List: 
							<select form="msg_form">
								<option value="all">All</option>
								<option value="list1">List1</option>
							</select>
						<br/>
						Content: <br/>
						<textarea name="content" form="msg_form" cols="39" rows="20" placeholder="Enter your message here"></textarea><br/>
						<input type="submit" value="Send" id="msg_form_submit">
						<div id="msg_form_result">Messages Sent!</div>
					</form>
					<h3 class="green">ADMIN</h3>
					<h3 class="green edit"><a href="manage_acct.html">Manage Account</a></h3>
					<h3 class="green edit"><a href="change_pw.html">Change Password</a></h3>
					<h3 class="green edit"><a href="logout.html">Logout</a></h3>
					<!-- COLUMN 2 END [LEFT] -->
				</div>
				<div class="col3">
					<!-- COLUMN 3 START [RIGHT] -->
					<h3 class="red">SCHEDULED MESSAGES</h3>
					<div id="scheduled_messages"></div>
					<ul>
						<li class="sch_msg">
							<p class="schedule">To Send: 8/1/2013 @ 2:00pm</p>
							<p class="schedule">Message: Buffy TONIGHT at 5pm on T2 Big Screen West!</p>
						</li>
						<li class="sch_msg">
							<p class="schedule">To Send: 8/7/2013 @ 3:00pm</p>
							<p class="schedule">Message: Dr. Horrible's Sing-Along Blog TOMMORROW at 6pm on T2 Big Screen West!</p>
						</li>
						<li class="sch_msg">
							<p class="schedule">To Send: 8/8/2013 @ 3:00pm</p>
							<p class="schedule">Message: Dr. Horrible's Sing-Along Blog TONIGHT at 6pm on T2 Big Screen West!</p>
						</li>
						<li class="sch_msg">
							<p class="schedule">To Send: 8/15/2013 @ 2:00pm</p>
							<p class="schedule">Message: Buffy TONIGHT at 5pm on T2 Big Screen West!</p>
						</li>
					</ul>
					<h3 class="edit dark_red"><a href="edit_sched_msg.html">Add/Edit</a></h3>

					<h3 class="green">EDIT</h3>
					<h3 class="green edit"><a href="edit_contacts.html">Contacts</a></h3>
					<h3 class="green edit"><a href="edit_list.html">Lists</a></h3>
					<!-- COLUMN 3 END [RIGHT] -->
				</div>
			</div>
		</div>
	</div>


<?php
	}
	
}

?>
