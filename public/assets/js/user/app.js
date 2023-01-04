$(document).ready(function() {
    $('#edit').click(function() {
        $('#profile-info').addClass('d-none');
        $('#profile-edit').removeClass('d-none');
    })

    $('[data-toggle="tooltip"]').tooltip()
});