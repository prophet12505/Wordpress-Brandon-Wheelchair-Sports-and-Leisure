jQuery(document).ready(function($) {

	/**
	 *	Process request to dismiss our admin notice
	 */
	$('#endurance-admin-notice-postsnum .notice-dismiss').click(function() {

		//* Data to make available via the $_POST variable
		data = {
			action: 'endurance_admin_notice_postsnum',
			endurance_admin_notice_nonce: endurance_admin_notice_postsnum.endurance_admin_notice_nonce
		};

		//* Process the AJAX POST request
		$.post( ajaxurl, data );

		return false;
	});
});