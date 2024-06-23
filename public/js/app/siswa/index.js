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
                data: "nama_profile",
                name: "nama_profile",
                searchable: true,
            },
            {
                data: "alamat_profile",
                name: "alamat_profile",
                searchable: true,
            },
            {
                data: "jeniskelamin_profile",
                name: "jeniskelamin_profile",
                searchable: true,
            },
            {
                data: "nomorhp_profile",
                name: "nomorhp_profile",
                searchable: true,
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
});
