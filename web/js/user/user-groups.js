$(function(){
	$(document).on('click', '.showModalUserGroups', function(e){
		e.preventDefault(e);
		if ($('#modal').data('bs.modal').isShown) {
			$('#modal').find('#modalContent')
				.load($(this).attr('value'));
			document.getElementById('modalHeader').innerHTML = '<h4>' + $(this).attr('title') + '</h4>';
		} else {
			$('#modal').modal('show')
				.find('#modalContent')
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
				$.pjax.reload({container:'#container-group'});
			}
		});
		return false;
	});
});