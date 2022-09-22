$(document).on('click', '.page-link', function(e){
    e.preventDefault();
    var page_number = $(this).data('page-number');
    var current_query;
    if( $(this).data('query') ) {
        current_query = '?' + $(this).data('query');
    } else {
        current_query = '';
    }
    $.get('inc/vendorReportInc.php' + current_query, {'page-number' : page_number}, function(data){
        $('#filtered_vendor_report').html(data);
    });
});

$(document).ready(function () {
    $(".product_action_filter").on('click','.filter_check',function (e) {
        var status = get_filter_text_radio('status');
        var _from = get_filter_text_input('_from');
        var _to = get_filter_text_input('_to');
        var per_page = get_filter_text_input('page');

        $(".form-control").css("border-color", '#ccc');
        var err1 = 0;var err2 = 0;
        if (_from ==='') { err1 = err1 + 1; }
        if (_to ==='') { err2 = err2 + 1; }

        if (err1 ===0 && err2 ===0) {
        }

        $.get('inc/vendorReportInc.php', {status,_from,_to,per_page}, function(data){
            $('#filtered_vendor_report').html(data);
        });
    });

    function get_filter_text_input(text_id) {return $('.'+text_id).val();}

    function get_filter_text_radio(text_id) {
        var filterData ='';
        $('.'+text_id+':checked').each(function() {filterData = $(this).val();});
        return filterData;
    }
});


