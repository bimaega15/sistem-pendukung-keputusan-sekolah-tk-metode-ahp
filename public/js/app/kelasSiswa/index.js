var body = $('body');
var baseurl = $('.baseurl').data('value');
var kelasId = $('.kelas_id').data('value');
var datatable;

$(document).ready(function () {
    function initDatatable() {
        $.ajax({
            url: `${baseurl}/KelasSiswa/dataTables?kelas_id=${kelasId}`,
            type: "get",
            dataType: "json",
            success: function (result) {
                const { data } = result;
                $('#dataTable').DataTable().destroy();

                datatable = $('#dataTable').DataTable({
                    data: data,
                    columns: [
                        { data: null, render: function (data, type, row, meta) {
                                return meta.row + 1;
                            }
                        },
                        { data: 'kode_profile' },
                        { data: 'nama_profile' },
                        { data: 'jeniskelamin_profile' },
                        { data: 'nomorhp_profile' },
                        { data: "action" }
                    ]
                });

            }
        })
    }
    initDatatable();

    body.on('click', '.btn-add', function (e) {
        e.preventDefault();
        showModal({
            url: `${baseurl}/KelasSiswa/create?kelas_id=${kelasId}`,
            modalId: 'modalLg',
            title: 'Form Kelas',
            type: 'get'
        })
    })

    body.on('click', '.btn-edit', function (e) {
        e.preventDefault();
        showModal({
            url: $(this).attr('href'),
            modalId: 'modalNormal',
            title: 'Form Kelas Siswa',
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
