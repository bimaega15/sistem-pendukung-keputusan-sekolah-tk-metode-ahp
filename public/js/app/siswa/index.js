var body = $('body');
var baseurl = $('.baseurl').data('value');
var userRole = $('.user_role').data('value'); // Pastikan variabel ini ada di HTML
var datatable;

$(document).ready(function(){
    function initDatatable() {
        var columns = [
            {
                data: null,
                orderable: false,
                searchable: false,
                className: "text-center",
            },
            {
                data: "checkbox_item",
                name: "checkbox_item",
                searchable: false,
                orderable: false,
            },
            {
                data: "nama_profile",
                name: "nama_profile",
                searchable: false,
                orderable: false,
            },
            {
                data: "alamat_profile",
                name: "alamat_profile",
                searchable: false,
                orderable: false,
            },
            {
                data: "jeniskelamin_profile",
                name: "jeniskelamin_profile",
                searchable: false,
                orderable: false,
            },
            {
                data: "nomorhp_profile",
                name: "nomorhp_profile",
                searchable: false,
                orderable: false,
            }
        ];

        // Tambahkan kolom action jika bukan guru
        if (userRole !== 'Guru') {
            columns.push({
                data: "action",
                name: "action",
                searchable: true,
            });
        }

        datatable = basicDatatable({
            tableId: $("#dataTable"),
            ajaxUrl: `${baseurl}/Siswa/dataTables`,
            columns: columns,
            dataAjaxUrl: {},
        });
    }
    initDatatable();

    // Hanya tambahkan event listener untuk tombol jika bukan guru
    if (userRole !== 'Guru') {
        body.on('click','.btn-add', function(e) {
            e.preventDefault();
            showModal({
                url: `${baseurl}/Siswa/create`,
                modalId: 'modalNormal',
                title: 'Form Siswa',
                type: 'get'
            });
        });

        body.on('click','.btn-edit', function(e) {
            e.preventDefault();
            showModal({
                url: $(this).attr('href'),
                modalId: 'modalNormal',
                title: 'Form Siswa',
                type: 'get'
            });
        });

        body.on('click','.btn-delete', function(e) {
            e.preventDefault();
            basicDeleteConfirmDatatable({
                urlDelete: $(this).attr('href'),
            });
        });
    } else {
        // Sembunyikan tombol aksi jika userRole adalah guru
        $('.btn-add').hide();
        $('.btn-edit').hide();
        $('.btn-delete').hide();
    }

    const saveDataItems = (saveData, saveDataNotChecked) => {
        $.ajax({
            url: `${baseurl}/Siswa/saveData`,
            type: 'post',
            dataType: 'json',
            data: {
                data: saveData, 
                dataNotChecked: saveDataNotChecked
            },
            success: function(response){
                $('#dataTable').DataTable().destroy();
                initDatatable();
                // Swal.fire({
                //     title: 'Successfully',
                //     text: response.message,
                //     icon: "success",
                //     confirmButtonText: "OK",
                // });
            }
        
        })
    }
    body.on('click','.checkbox-all', function(e) {
        if($(this).is(':checked')){
            $('.checkbox-item').prop('checked', true);
        } else {
            $('.checkbox-item').prop('checked', false);
        }

        let saveData = [];
        let saveDataNotChecked = [];
        const getCheckbox = $('.checkbox-item');
        getCheckbox.each(function(){
            if($(this).is(':checked')){
                saveData.push($(this).val());
            }
            saveDataNotChecked.push($(this).val());
        });

        saveDataItems(saveData, saveDataNotChecked);
    });

    body.on('click','.checkbox-item', function(e) {
        const getCheckbox = $('.checkbox-item').length;
        const getCheckboxChecked = $('.checkbox-item:checked').length;
        if(getCheckbox === getCheckboxChecked){
            $('.checkbox-all').prop('checked', true);
        } else {
            $('.checkbox-all').prop('checked', false);
        }


        let saveData = [];
        let saveDataNotChecked = [];
        const getCheckboxValue = $('.checkbox-item');
        getCheckboxValue.each(function(){
            if($(this).is(':checked')){
                saveData.push($(this).val());
            }
            saveDataNotChecked.push($(this).val());
        });

        saveDataItems(saveData, saveDataNotChecked);
    });
});
