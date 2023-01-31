$(window).on('hashchange', function() {
    if (window.location.hash) {
        var page = window.location.hash.replace('#', '');
        if (page == Number.NaN || page <= 0) {
            return false;
        } else{
            getData(page);
        }
    }
});

$(document).ready(function(){
    $('.alert').alert()

    $(document).on('click', '.pagination a',function(event) {
        event.preventDefault();
        $('li').removeClass('active');
        $(this).parent('li').addClass('active');

        var page=$(this).attr('href').split('page=')[1];

        handleSearch(page);
    });

    $('.user-place-search').submit(function(event) {
        event.preventDefault();

        handleSearch();
    });

});

function handleSearch(page = 1) {
    const address = $('.user-place-search #address').val();
    const month = $('.user-place-search #month').val();
    const price = $('.user-place-search #price').val();
    const tag = $('.user-place-search #tag').val();

    $.ajax({
        url: '?address=' + address + '&month=' + month +  '&price=' + price + '&tag=' + tag + '&page=' + page,
        type: "get",
        datatype: "html"
    }).done(function(data){
        $("#tag_container").empty().html(data);
    }).fail(function(jqXHR, ajaxOptions, thrownError){
        alert('No response from server');
    });
}
