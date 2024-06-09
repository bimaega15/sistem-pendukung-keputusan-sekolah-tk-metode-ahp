var body = $('body');
var baseurl = $('.baseurl').data('value');
var loadForm = () => {
    $.ajax({
        url: `${baseurl}/Profile/output`,
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
    body.on('click','.btn-edit', function(e) {
        e.preventDefault();
        showModal({
            url: $(this).data('url'),
            modalId: 'modalLg',
            title: 'Form Edit Profile',
            type: 'get'
        })
    })
})