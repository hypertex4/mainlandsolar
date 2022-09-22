$(document).on('click', '.page-link', function(e){
    e.preventDefault();
    var page_number = $(this).data('page-number');
    var current_query;
    if( $(this).data('query') ) {
        current_query = '?' + $(this).data('query');
    } else {
        current_query = '';
    }
    $.get('filter_resources.php' + current_query, {'page-number' : page_number}, function(data){
        $('#all-resources').html(data);
    });
});

$(document).ready(function () {
    $(".product_action_filter").on('click','.product_check',function (e) {
        var per_page = get_filter_text_input('page');

        $.get('filter_resources.php', {per_page}, function(data){
            $('#all-resources').html(data);
        });
    });

    function get_filter_text_input(text_id) {return $('.'+text_id).val();}
});


