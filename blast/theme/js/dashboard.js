$(document).ready(function() {
	
	$('#msg_form').submit(function() {
		
		$('#msg_form textarea').val('');
		$('#msg_form_submit').val('...');
		
		$('#msg_form_result').delay(500).animate({ opacity:1 }, 500, function() {
			$('#msg_form_submit').val('Send');
			$('#msg_form_result').delay(3000).animate({ opacity:0 }, 500);
		});
		
		return false;
		
	});
	
});