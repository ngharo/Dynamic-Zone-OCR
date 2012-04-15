window.mousedown = false;
window.in_canvas = false;

$(document).ready(function() {
	var scan = $('#scan-img');
	var previewDia = $('#mapzone-dialog');

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
		diaContainer.width(c.w + 25);
		diaContainer.height(c.h + 75);
		if (show) preview.show();
	};

	var map = function(coords) {
		$.extend(coords, {
			name: $('#mapName').val(),
			img: $('#scan-img').attr('src')
		});

		$.ajax({
			url: 'crop.php',
			data: coords,
			type: 'post',
			success: function() {
				alert('k');
			}
		});
	};

	scan.Jcrop({
		onSelect: function(c) {

			$('#mapzone-dialog').dialog({
				buttons: {
					'Save Mapping': function() {
						map(c);
					}
				},
				open: function() {
					showPreview(c, true);
				},
			});
		},
		onChange: function(c) {
			showPreview(c);
		}
	});

});

