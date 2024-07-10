var baseurl = $('.baseurl').data('value');

function initDatatable() {
    $.ajax({
        url: `${baseurl}/Siswa/dataTables`,
        type: "get",
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
                    { data: 'nomorhp_profile' }
                ]
            });
            
        }
    })
}

$(document).ready(function(){
    initDatatable();
})