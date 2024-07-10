var body = $('body');
var baseurl = $('.baseurl').data('value');
var datatable;

function initDatatable() {
    $.ajax({
        url: `${baseurl}/MataPelajaran/dataTables`,
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
                    { data: 'nama_matapelajaran' },
                    { data: "action" }
                ]
            });

        }
    })
}
$(document).ready(function () {
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
            dataFunction: initDatatable
        })
    })
})
