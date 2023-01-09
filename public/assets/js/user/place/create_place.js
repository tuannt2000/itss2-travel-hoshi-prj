$(document).ready(function($) {
    $('#choose-image').click(function() {
        $('#image').click()
    })

    let files;
    $('#image').change(function() {
        files = this.files;
        const file = this.files[0];
        const fileType = file['type'];
        const validImageTypes = ['image/gif', 'image/jpeg', 'image/png'];
        if (validImageTypes.includes(fileType)) {
            showImage(file)
            $('#show-img').css('display', 'block');
        } else {
            showVideo(file)
            $('#show-video').removeClass('d-none');
        }

        $('#remove-image').removeClass('hide')
        $('#choose-image').addClass('hide')
        $('#load-images').removeClass('hide')
    })

    $('#remove-image').click(function() {
        $('#image').val('')
        // set src img
        $('#show-img').css('display', 'none');
        $('#show-img').attr('src', '');
        
        // set src video
        $('#show-video').addClass('d-none');
        $('#show-video').attr('src', '');

        $('#choose-image').removeClass('hide')
        $('#load-images').addClass('hide')
        $(this).addClass('hide')
    })

    let index = 0;
    $('.next-btn').click(function() {
        if (index == files.length - 1) {
            index = 0;
        } else {
            index++;
        }
        const file = files[index]

        showImage(file)
    })

    $('.prev-btn').click(function() {
        if (index == 0) {
            index = files.length - 1;
        } else {
            index--;
        }
        const file = files[index]

        showImage(file)
    })
});

function showImage (file) {
    if (file){
        let reader = new FileReader();
        reader.onload = function(event){
            $('#show-img').attr('src', event.target.result);
        }
        reader.readAsDataURL(file);
    }
}

function showVideo (file) {
    if (file){
        var video = $('#show-video');
        console.log(video);
        video[0].src = URL.createObjectURL(file);
    }
}