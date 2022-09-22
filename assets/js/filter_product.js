$(document).on('click', '.page-link', function(e){
    e.preventDefault();
    var page_number = $(this).data('page-number');
    var current_query;
    if( $(this).data('query') ) {
        current_query = '?' + $(this).data('query');
    } else {
        current_query = '';
    }
    $.get('product/filter_products.php' + current_query, {'page-number' : page_number}, function(data){
        $('#all-products').html(data);
    });
});

$(document).ready(function () {
    $(".product_action_filter").on('click','.product_check',function (e) {
        // $('.loading-overlay').show();
        var search = get_filter_text_input('search');
        var sortBy = get_filter_text_radio('sortBy');
        var per_page = get_filter_text_input('page');

        $.get('product/filter_products.php', {search,sortBy,per_page}, function(data){
            $('#all-products').html(data);
        });
    });

    function get_filter_text_input(text_id) {return $('.'+text_id).val();}
    function get_filter_text_radio(text_id) {
        var filterData ='';
        $('.'+text_id+':checked').each(function() {filterData = $(this).val();});
        return filterData;
    }
});


