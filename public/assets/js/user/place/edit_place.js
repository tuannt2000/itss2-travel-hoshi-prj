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

    $('.tag-label').click(function() {
        $(this).toggleClass('active');
        setValueTag()
    })

    setValueTag()
});

function setValueTag () {
    let val = '';
    $(".tag-label.active").each(function(index) {
        val += $(this).attr('data-value')
        if (index != $(".tag-label.active").length - 1) {
            val += ','
        }
    });
    
    $('#tag').val(val);
}
