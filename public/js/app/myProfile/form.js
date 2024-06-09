var body = $('body');
var formSubmit = document.getElementById("form-submit");
var validate = $("#form-submit").validate({
    rules: {
        username_users: "required",
        email_users: {
            required: true,
            email: true
        },
        nama_profile: "required",
        jeniskelamin_profile: "required",
    },
    messages: {
        username_users: "Masukan username anda",
        email_users: {
            required: "Masukan email anda",
            email: "Email anda tidak valid"
        },
        nama_profile: "Masukan nama anda",
        jeniskelamin_profile: "Masukan jenis kelamin anda",
    }
});
var loadRender = () => {
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
formSubmit.addEventListener("submit", function (event) {
    event.preventDefault();
    submitData();
});

function submitData() {
        if(validate.valid()){
            const formData = {};
            let is_new_password = 1;
            formData.username_users = $('input[name="username_users"]').val();
            formData.email_users = $('input[name="email_users"]').val();
            formData.is_new_password = is_new_password;
            formData.password_users = $('input[name="password_users"]').val();
            formData.jeniskelamin_profile = $('input[name="jeniskelamin_profile"]:checked').val();
            formData.nomorhp_profile = $('input[name="nomorhp_profile"]').val();
            formData.nama_profile = $('input[name="nama_profile"]').val();
            formData.alamat_profile = $('textarea[name="alamat_profile"]').val();

            if(formData.password_users == ''){
                formData.is_new_password = 0;
                formData.password_users = $('input[name="password_users_old"]').val();
            }
            
            $.ajax({
                type: "post",
                url: $("#form-submit").attr("action"),
                data: formData,
                dataType: "json",
                beforeSend: function () {
                    $("#btn-submit").attr("disabled", true);
                    $("#btn-submit").html(disableButton);
                },
                success: function (data) {
                    $('#modalLg').modal('hide');
                    Swal.fire({
                        title: 'Successfully',
                        text: data,
                        icon: "success",
                        confirmButtonText: "OK",
                    });
                    loadRender();
                },
                error: function (jqXHR, exception) {
                    $("#btn-submit").attr("disabled", false);
                    $("#btn-submit").html(enableButton);
                    Swal.fire({
                        title: 'Failed',
                        text: data,
                        icon: "error",
                        confirmButtonText: "OK",
                    });
                },
                complete: function () {
                    $("#btn-submit").attr("disabled", false);
                    $("#btn-submit").html(enableButton);
                },
            });
        }
    }
})