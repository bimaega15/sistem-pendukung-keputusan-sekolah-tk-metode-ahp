var body = $('body');
var baseurl = $('.baseurl').data('value');
var datatable;

$(document).ready(function(){
    function initDatatable() {
        datatable = basicDatatable({
            tableId: $("#dataTable"),
            ajaxUrl: `${baseurl}/Kriteria/dataTables`,
            columns: [
                {
                    data: null,
                    orderable: false,
                    searchable: false,
                    className: "text-center",
                },
                {
                    data: "kode_kriteria",
                    name: "kode_kriteria",
                    searchable: true,
                },
                {
                    data: "nama_kriteria",
                    name: "nama_kriteria",
                    searchable: true,
                },
                {
                    data: "keterangan_kriteria",
                    name: "keterangan_kriteria",
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

    body.on('click','.btn-add', function(e) {
        e.preventDefault();
        showModal({
            url: `${baseurl}/Kriteria/create`,
            modalId: 'modalNormal',
            title: 'Form Kriteria',
            type: 'get'
        })
    })

    body.on('click','.btn-edit', function(e) {
        e.preventDefault();
        showModal({
            url: $(this).attr('href'),
            modalId: 'modalNormal',
            title: 'Form Kriteria',
            type: 'get'
        })
    })

    body.on('click','.btn-delete', function(e) {
        e.preventDefault();
        basicDeleteConfirmDatatable({
            urlDelete: $(this).attr('href'),
        })
    })
})
