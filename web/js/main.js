$(function () {
    $('.add_photo_button').click(function ()
    {
        $(this).parent().children('.add_photo_input').trigger('click');
        return false;
    });

    $('#usersTable').dataTable({
        "bPaginate": true,
        "bLengthChange": true,
        "bFilter": true,
        "bSort": true,
        "bInfo": true,
        "bAutoWidth": false,
        "displayStart": 10,
        "columns": [
            null,
            null,
            null,
            { "orderable": false }
        ],
        "language": {
            "emptyTable": $('#dt-empty').val(),
            "info": $('#dt-info').val(),
            "zeroRecords": $('#dt-zeroRecords').val(),
            "lengthMenu": $('#dt-lengthMenu').val(),
            "infoFiltered": $('#dt-infoFiltered').val(),
            "infoEmpty": $('#dt-infoEmpty').val(),
            "search": $('#dt-search').val() + ': ',
            "paginate": {
                "first": "<<",
                "last": ">>",
                "next": ">",
                "previous": "<"
            }
        }
    });
});
