var body = $('body');
var baseurl = $('.baseurl').data('value');
var datatable;

$(document).ready(function () {
    function initDatatable() {
        datatable = basicDatatable({
            tableId: $("#dataTable"),
            ajaxUrl: `${baseurl}/MataPelajaran/dataTables`,
            columns: [
                {
                    data: null,
                    orderable: false,
                    searchable: false,
                    className: "text-center",
                },
                {
                    data: "nama_matapelajaran",
                    name: "nama_matapelajaran",
                    searchable: true,
                },
                {
                    data: "action",
                    name: "action",
                    searchable: true,
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
            url: `${baseurl}/MataPelajaran/create`,
            modalId: 'modalNormal',
            title: 'Form Mata Pelajaran',
            type: 'get'
        })
    })

    body.on('click', '.btn-edit', function (e) {
        e.preventDefault();
        showModal({
            url: $(this).attr('href'),
            modalId: 'modalNormal',
            title: 'Form Mata Pelajaran',
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
