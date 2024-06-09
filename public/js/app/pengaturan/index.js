var body = $('body');
var baseurl = $('.baseurl').data('value');
var loadForm = () => {
    $.ajax({
        url: `${baseurl}/Pengaturan/create`,
        type: 'get',
        dataType: 'text',
        beforeSend: function(){
            $('#load_output_form').removeClass('d-none');
        },
        success: function(data){
            $('.output_form').html(data);
        },
        complete: function(){
            $('#load_output_form').addClass('d-none');
        }
    })
}

$(document).ready(function(){
    loadForm();
})
