$(document).ready(function() {
	
	$('a.contact-detail-link').click(function() {
		
		$('#contact_info').html($(this).parent().find('.contact-detail-display').html());
		
	});
	
});

function removeContactFromList(list_id, member_id) {
	
	/*$.ajax({
		url: 'ajax.php',
		type: 'GET',
		data: 'f=removeContactFromList&list_id='+list_id+'&member_id='+member_id,
		function() {
			$()
		}
	})*/
	
}