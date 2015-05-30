$(function () {
    var gField;

    $('body').on('click', '.grid-trash', function (e) {
        $('#modal-delete').modal('show');
        gField = $(this);
    });

    $('body').on('click', '#btn-modal-delete', function (e) {
        if(gField) {
            var href = gField.attr('value');
            $.get(href, function () {
                var pjax_id = gField.closest('#pjax-operations-table').attr('id');
                $.pjax.reload('#' + pjax_id);
                $('#modal-delete').modal('hide');
                gField = null;
            });
        }
        return false;
    });
});