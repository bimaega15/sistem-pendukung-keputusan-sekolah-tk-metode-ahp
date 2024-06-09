var body = $('body');
var baseurl = $('.baseurl').data('value');
var datatable;

$(document).ready(function(){
    function initDatatable() {
        datatable = basicDatatable({
            tableId: $("#dataTable"),
            ajaxUrl: `${baseurl}/Admin/dataTables`,
            columns: [
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
            url: `${baseurl}/Admin/create`,
            modalId: 'modalNormal',
            title: 'Form Admin',
            type: 'get'
        })
    })

    body.on('click','.btn-edit', function(e) {
        e.preventDefault();
        showModal({
            url: $(this).attr('href'),
            modalId: 'modalNormal',
            title: 'Form Admin',
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
