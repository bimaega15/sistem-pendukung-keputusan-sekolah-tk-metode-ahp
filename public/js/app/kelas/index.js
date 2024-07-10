var body = $('body');
var baseurl = $('.baseurl').data('value');
var namaRoles = $('.namaRoles').data('value');
var datatable;
var allowedData = ['Admin'];

$(document).ready(function () {
    function initDatatable() {
        $.ajax({
            url: `${baseurl}/Kelas/dataTables`,
            type: "get",
            dataType: "json",
            success: function (result) {
                const { data } = result;
                $('#dataTable').DataTable().destroy();

                let columnData = [
                    {
                        data: null, render: function (data, type, row, meta) {
                            return meta.row + 1;
                        }
                    },
                    {
                        data: "nama_kelas",
                    },
                    {
                        data: "nama_profile",
                    },
                    {
                        data: "jumlah_siswa",
                    },
                ];
                if (allowedData.includes(namaRoles)) {
                    columnData = [
                            ...columnData, {
                            data: "action",
                        },
                    ]
                }
                datatable = $('#dataTable').DataTable({
                    data: data,
                    columns: columnData,
                });

            }
        })
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
