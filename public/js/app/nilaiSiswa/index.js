var body = $('body');
var baseurl = $('.baseurl').data('value');
var userKelas = $('.userKelas').data('value');
var datatable;

$(document).ready(function () {
    function initDatatable() {
        $.ajax({
            url: `${baseurl}/Nilai/dataTables`,
            type: "get",
            dataType: "json",
            data: {
                userKelas: JSON.stringify(userKelas),
            },
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
                        { data: 'nama_profile' },
                        { data: 'alamat_profile' },
                        { data: 'jeniskelamin_profile' },
                        { data: 'nomorhp_profile' },
                        { data: 'action' }
                    ]
                });

            }
        })
    }
    initDatatable();
})
