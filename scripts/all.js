$(document).ready(function() {

	/* Admin */
	$('#new-form-button').button({
		icons: {
			primary: 'ui-icon-plusthick'
		}
	}).click(function() {
		window.location.href = 'newform.php';
	});

	$('#save-field-button').button().click(function() {
		// call save api
	});
});
