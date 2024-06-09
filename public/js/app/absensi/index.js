var body = $('body');
var baseurl = $('.baseurl').data('value');
var userKelas = $('.userKelas').data('value');
var datatable;

$(document).ready(function () {
    function initDatatable() {
        datatable = basicDatatable({
            tableId: $("#dataTable"),
            ajaxUrl: `${baseurl}/Absensi/dataTables`,
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
                userKelas: JSON.stringify(userKelas),
            },
        });
    }
    initDatatable();
})
