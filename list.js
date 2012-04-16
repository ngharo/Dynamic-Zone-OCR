$(document).ready(function() {
	var loading = $('#newform-loading');
	var saveForm = function(upload_id, template_id, callback) {
		$.ajax({
			url: '/buildhealth/api/service.php',
			type: 'post',
			dataType: 'json',
			data: {
				op: 'save_form',
				upload_id: upload_id,
				template_id: template_id
			},
			success: callback
		});
	};

	var uploader = new qq.FileUploader({
		// pass the dom node (ex. $(selector)[0] for jQuery users)
		element: document.getElementById('file-uploader'),
		// path to server-side upload script
		action: 'upload.php',
		allowedExtensions: ['jpg', 'jpeg'],
		onComplete: function(id, fileName, responseJSON) {
			var upload_id = responseJSON.uuid;
			console.log(id, fileName, responseJSON);

			$('.upload-step').hide();

			loading.show();
			// fetch list -- populate select
			$.ajax({
				url: '/buildhealth/api/service.php',
				type: 'post',
				dataType: 'json',
				data: {
					op: 'get_templates',
				},
				success: function(templates) {
					var select = $('<select />');
					var options = '<option value="null">-- Choose a Template --</option>';

					for (var i = 0; i < templates.length; i++) {
						options += '<option value="' + templates[i].template_id + '">' + templates[i].template_id + '</option>';
					}

					$('#select-template-button').button().click(function() {
						$('.upload-step').hide();
						loading.show();

						var template_id = $('#template-select-list').find('select').val();

						saveForm(upload_id, template_id, function() {
							window.location.href = 'template.php?id=' + template_id + '&upload_id=' + upload_id;
						});
					});

					select.html(options).change(function() {
						$('#select-template-button').button('option', 'disabled', $(this).val() === 'null');
						// set selection
					}).appendTo('#template-select-list');

					$('#new-template-button').button().click(function() {
						window.location.href = 'template.php?upload_id=' + upload_id;
					});

					loading.hide();
					$('#upload-step2').fadeIn('slow');
				}
			});
		},
	});

	$('#new-form-button').button().click(function() {
		$('#newform-dialog').dialog({
			modal: true,
			width: 600,
			height: 400
		});
	});

	$.ajax({
		url: '/buildhealth/api/service.php',
		type: 'post',
		dataType: 'json',
		data: {
			op: 'get_templates'
		},
		success: function(templates) {
			var html = 'Forms <br /><hr />';
			for(var i = 0; i<templates.length; i++) {
				html += '<a href="template.php?id=' + templates[i].template_id + '&upload_id=' + templates[i].upload_id + '">' +
					templates[i].template_id + '</a><br />';
			}

			$('#list-container').html(html);
		}
	});

});

