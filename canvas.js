window.cropCtx = false;

$(document).ready(function() {
	var scan = $('#scan-img');
	var previewDia = $('#mapzone-dialog');
	var previewTxt = $('#crop-preview-ocr');
	var name = $('#mapName');

	var showPreview = function(c, show) {
		var preview = $('#crop-preview');
		preview.css({
			'background-image': 'url(' + scan.attr('src') + ')',
			backgroundPosition: '-' + c.x + 'px ' + '-' + c.y + 'px',
			width: c.w,
			height: c.h,
			overflow: 'hidden'
		});

		var diaContainer = previewDia.closest('.ui-dialog');
		if (show) {
			preview.show();
		}
	};

	var ocr = function(coords) {
		$.extend(coords, {
			name: $('#mapName').val(),
			img: $('#scan-img').attr('src'),
			template_id: $('body').data('template_id'),
			coords: JSON.stringify(coords)
		});

		$.ajax({
			url: 'crop.php',
			data: coords,
			type: 'post',
			success: function(data) {
				previewTxt.html(data);
			}
		});
	};

	saveFragment = function(coords, fragment_id, fragment_name) {
		var successFn =  function(data) {
			$('#mapzone-dialog').dialog('close');
			$('.fragment-box').remove();
			getFragments($('body').data('template_id'));
		}

		if(fragment_id) {
			$.ajax({
				type: 'post',
				url: '/buildhealth/api/service.php',
				dataType: 'json',
				data: {
					name: fragment_name,
					fragment_id: fragment_id,
					coords: JSON.stringify(coords),
					op: 'update_fragment'
				},
				success: successFn
			});
		} else {	
			$.ajax({
				type: 'post',
				url: '/buildhealth/api/service.php',
				dataType: 'json',
				data: {
					name: $('#mapName').val(),
					img: $('#scan-img').attr('src'),
					template_id: $('body').data('template_id'),
					coords: JSON.stringify(coords),
					op: 'map'
				},
				success: successFn
			});
		}
	};

	getFragments = function(template_id) {
		$.ajax({
			url: '/buildhealth/api/service.php',
			dataType: 'json',
			type: 'post',
			data: {
				op: 'get_map',
				template_id: template_id
			},
			success: function(fragments) {
				drawFragmentBoxes(fragments);
			}
		});
	};

	drawFragmentBoxes = function(fragments) {
		for(var i = 0; i < fragments.length; i++) {
			var f = fragments[i];
			var _coords = JSON.parse(f.coords);
			$('<div/>', {
				class: 'fragment-box',
			})
			.html('<span class="fragment-box-label" style="line-height: ' + _coords.h + 'px;">' + f.name + '</span>')
			.data({
					 name: f.name,
					 id: f.fragment_id,
					 coords: _coords
			})
			.appendTo('body')
			.width(_coords.w)
			.height(_coords.h)
			.css({
				top: _coords.y,
				left: _coords.x,
			})
			.click(function() {
				var data = $(this).data();
				var c = data.coords;

				scan.Jcrop({setSelect: [c.x, c.y, c.x2, c.y2]});
				console.log(data);
				popFragmentDialog(c, data.id, data.name);
			})
			.fadeIn('slow')
		}
	};

	popFragmentDialog = function(coords, fragment_id, fragment_name) {
		$('#mapzone-dialog').dialog({
			width: 'auto',
			buttons: {
				'Save': function() {
					if(name.val().length === 0) {
						name.animate({
							backgroundColor: '#ff0000'
						}, 500, function() {
							name.animate({
								backgroundColor: '#ffffff'
							}, 500);
						});

						return false;
					}

					saveFragment(coords, fragment_id, name.val());
					$(this).data('fragment_id', '');
				},
				'Preview': function() {
					ocr(coords);
				},
				'Cancel': function() {
					$(this).dialog('close');
				}
			},
			open: function() {
				name.val(fragment_name);
			},
			close: function() {
				window.cropCtx.release();
			}
		}).data('fragment_id', fragment_id);

		showPreview(coords, true);
	};

	scan.Jcrop({
		onSelect: function(c) {
			popFragmentDialog(c, $('#mapzone-dialog').data('fragment_id'));
		},
		onChange: function(c) {
			showPreview(c);
			previewTxt.html('');
		}
	}, function() {
		window.cropCtx = this;
	});

	if(window.location.search.indexOf('?id=') !== -1) {
		getFragments($('body').data('template_id'));
	}
});

