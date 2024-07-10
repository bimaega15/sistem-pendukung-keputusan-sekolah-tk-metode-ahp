var body = $('body');
var baseurl = $('.baseurl').data('value');
var userKelas = $('.userKelas').data('value');
var datatable;

$(document).ready(function () {
    datatable = $("#dataTable").DataTable();
    function initDatatable() {
        $.ajax({
            url: `${baseurl}/Absensi/dataTables`,
            type: "get",
            data: {
                userKelas: JSON.stringify(userKelas),
            },
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
