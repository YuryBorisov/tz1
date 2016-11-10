$(document).ready(function () {

    function ajaxRequest(url, type, data, func){
        $.ajax({
            url: url,
            type: type,
            data: data,
            success: function(data){
                func(data);
            }
        });
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on('submit', 'form', function(e){
        e.preventDefault();
        var data = $(this).serialize();
        var er = $('.message-error ul');
        var result = $('.result');
        ajaxRequest('/calc', 'post', data, function (data) {
            if(data.response.status == 'success'){
                er.html('');
                result.html('Результат: '+data.response.data.result);
            }else{
                result.html('');
                error(er, data.response.message);
            }
        });
    });

    function error(element, message) {
        element.html('<li>'+message+'</li>');
    }

});