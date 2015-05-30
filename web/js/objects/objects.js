$(function(){
	$(document).on('click', '.showModalObjects', function(e){
		e.preventDefault(e);
		if ($('#modal').data('bs.modal').isShown) {
			$('#modal').find('#modalContentObjects')
				.load($(this).attr('value'));
			document.getElementById('modalHeader').innerHTML = '<h4>' + $(this).attr('title') + '</h4>';
		} else {
			$('#modal').modal('show')
				.find('#modalContentObjects')
				.load($(this).attr('value'));
			document.getElementById('modalHeader').innerHTML = '<h4>' + $(this).attr('title') + '</h4>';
		}
	});

	var gField;

	$('body').on('click', '.grid-trash', function (e) {
		e.preventDefault(e);
		$('#modal-delete').modal('show');
		gField = $(this);
	});

	$('body').on('click', '#btn-modal-delete', function (e) {
		$.ajax({
			url: gField.attr('value'),
			type: 'post',
			success: function(data) {
				$('#modal-delete').modal('hide')
				$.pjax.reload({container:'#container-objects'});
			}
		});
		return false;
	});

	$('body').on('click', '.add_photo_button', function() {
		$('#object-icon').click();
	});
});