$(document).ready(function($) {
    $('#image').change(function() {
        const file = this.files[0];
        const fileType = file['type'];
        const validImageTypes = ['image/gif', 'image/jpeg', 'image/png'];
        if (validImageTypes.includes(fileType)) {
            $('#show-video').addClass('d-none');
        } else {
            $('#show-img').css('display', 'none');
        }
    })
});
