$(document).ready(function() {

	/* Admin */
	$('#new-form-button').button({
		icons: {
			primary: 'ui-icon-plusthick'
		}
	}).click(function() {
		$('#dialog-newform').dialog({
			buttons: {
				'Save': function() {
					$.ajax({
						type: 'post',
						dataType: 'json',
						url: '/buildhealth/api/service.php',
						data: {
							op: 'add_view',
							name: encodeURIComponent($('#newform-name').val()),
							access: 0
						},
						success: function(data) {
							if (data.res === 'OK') {
								window.location.href = 'newform.php?id=' + parseInt(data.formid, 10) + '&name=' + encodeURIComponent(data.name);
							} else {
								console.log(data);
							}
						},
						error: function() {
							alert('FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF');
						}
					});
				}
			}
		});
	});

	$('#save-field-button').button().click(function() {
		$.ajax({
			url: '/buildhealth/api/service.php',
			dataType: 'json',
			type: 'post',
			data: {
				op: 'add_field',
				form_id: $('#field-creation-container').data('form_id'),
				name: $('input[name="label"]').val(),
				type: $('select[name="type"]').val(),
				value: $('input[name="value"]').val(),
				priority: $('input[name="priority"]').val(),
				access: 0
			},
			success: function() {
				console.log(data);
			},
			error: function() {
				alert('FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF');
			}
		});
	});

	$('#save-form-button').button();
});

