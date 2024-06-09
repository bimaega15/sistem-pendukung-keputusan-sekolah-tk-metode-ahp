var body = $('body');
var baseurl = $('.baseurl').data('value');
var namaRoles = $('.namaRoles').data('value');
var datatable;
var allowedData = ['Admin'];

$(document).ready(function () {
    function initDatatable() {
        let columnData = [
            {
                data: null,
                orderable: false,
                searchable: false,
                className: "text-center",
            },
            {
                data: "tingkat_kelas",
                name: "tingkat_kelas",
                searchable: true,
            },
            {
                data: "nama_kelas",
                name: "nama_kelas",
                searchable: true,
            },
            {
                data: "nama_profile",
                name: "nama_profile",
                searchable: true,
            },
            {
                data: "jumlah_siswa",
                name: "jumlah_siswa",
                searchable: true,
            },
        ];
        if (allowedData.includes(namaRoles)) {
            columnData = [...columnData, {
                data: "action",
                name: "action",
                searchable: false,
            },]
        }
        datatable = basicDatatable({
            tableId: $("#dataTable"),
            ajaxUrl: `${baseurl}/Kelas/dataTables`,
            columns: columnData,
            dataAjaxUrl: {
            },
        });
    }
    initDatatable();

    body.on('click', '.btn-add', function (e) {
        e.preventDefault();
        showModal({
            url: `${baseurl}/Kelas/create`,
            modalId: 'modalNormal',
            title: 'Form Kelas',
            type: 'get'
        })
    })

    body.on('click', '.btn-edit', function (e) {
        e.preventDefault();
        showModal({
            url: $(this).attr('href'),
            modalId: 'modalNormal',
            title: 'Form Kelas',
            type: 'get'
        })
    })

    body.on('click', '.btn-delete', function (e) {
        e.preventDefault();
        basicDeleteConfirmDatatable({
            urlDelete: $(this).attr('href'),
        })
    })
})
