var body = $('body');
var baseurl = $('.baseurl').data('value');
var kelasId = $('.kelas_id').data('value');
var datatable;

$(document).ready(function () {
    function initDatatable() {
        datatable = basicDatatable({
            tableId: $("#dataTable"),
            ajaxUrl: `${baseurl}/KelasSiswa/dataTables?kelas_id=${kelasId}`,
            columns: [
                {
                    data: null,
                    orderable: false,
                    // searchable: false,
                    className: "text-center",
                },
                {
                    data: "kode_profile",
                    name: "kode_profile",
                    // searchable: true,
                },
                {
                    data: "nama_profile",
                    name: "nama_profile",
                    // searchable: true,
                },
                {
                    data: "jeniskelamin_profile",
                    name: "jeniskelamin_profile",
                    // searchable: true,
                },
                {
                    data: "nomorhp_profile",
                    name: "nomorhp_profile",
                    // searchable: true,
                },
                {
                    data: "action",
                    name: "action",
                    // searchable: true,
                },
            ],
            dataAjaxUrl: {
            },
        });
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
