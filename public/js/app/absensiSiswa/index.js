var body = $('body');
var baseurl = $('.baseurl').data('value');
var siswa_id = $('.siswa_id').data('value');
var datatable;
var roles= $("#cek_roles_login").data("role");

$(document).ready(function () {
    datatable = $("#dataTable").DataTable();
    function initDatatable() {
        $.ajax({
            url: `${baseurl}/AbsensiSiswa/dataTables?siswa_id=${siswa_id}`,
            type: "get",
            dataType: "json",
            success: function(result){
                const { data } = result;
                $('#dataTable').DataTable().destroy();
                
                datatable = $('#dataTable').DataTable({
                    data: data,
                    columns: [
                        { data: null, render: function ( data, type, row, meta ) {
                                return meta.row + 1;
                            }
                        },
                        { data: 'tanggal_absensi' },
                        { data: 'nama_absensi' },
                        { data: 'keterangan_absensi' },
                        roles !== 'Orang Tua' ? { data: "action" } : { data: "action", visible: false}
                    ]
                });
                
            }
        })
    }
    initDatatable();


    body.on('click', '.btn-add', function (e) {
        e.preventDefault();

        showModal({
            url: $(this).data('url'),
            modalId: 'modalLg',
            title: 'Form Absensi Siswa',
            type: 'get'
        })
    })

    body.on('click', '.btn-edit', function (e) {
        e.preventDefault();
        showModal({
            url: $(this).attr('href'),
            modalId: 'modalLg',
            title: 'Form Absensi Siswa',
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
