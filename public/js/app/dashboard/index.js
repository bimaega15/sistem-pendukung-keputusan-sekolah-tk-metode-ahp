var baseurl = $('.baseurl').data('value');

$(document).ready(function(){
    function initDatatable() {
        datatable = basicDatatable({
            tableId: $("#dataTable"),
            ajaxUrl: `${baseurl}/Siswa/dataTables`,
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
            ],
            dataAjaxUrl: {
            },
        });
    }
    initDatatable();
})