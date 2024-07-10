var body = $('body');
var baseurl = $('.baseurl').data('value');
var siswa_id = $('.siswa_id').data('value');
var nama_roles = $('.nama_roles').data('value');
var datatable;

const allowColumn = [
    { 
        data: null, render: function (data, type, row, meta) {
            return meta.row + 1;
        }
    },
    {
        data: "nama_matapelajaran",
        name: "nama_matapelajaran",
        searchable: true,
    },
    {
        data: "value_nilai",
        name: "value_nilai",
        searchable: true,
    },
    {
        data: "keterangan_nilai",
        name: "keterangan_nilai",
        searchable: true,
    }
];
function initDatatable(mataPelajaranId = null) {
    $.ajax({
        url: `${baseurl}/PenilaianSiswa/dataTables`,
        type: "get",
        dataType: "json",
        data: {
            siswa_id,
            matapelajaran_id: mataPelajaranId,
        },
        success: function (result) {
            const { data } = result;
            $('#dataTable').DataTable().destroy();
            datatable = $('#dataTable').DataTable({
                data: data,
                columns: allowColumn,
            });
        }
    })
}

$(document).ready(function () {

    if (nama_roles !== 'Orang Tua') {
        allowColumn.push({
            data: "action",
            name: "action",
            searchable: true,
        });
    }

   
    initDatatable();

    select2Server({
        selector: '.select2Server',
        parent: '.content_penilaian_siswa',
        routing: `${baseurl}/MataPelajaran/select2`,
    })

    body.on('click', '.btn-add', function (e) {
        e.preventDefault();

        showModal({
            url: $(this).data('url'),
            modalId: 'modalLg',
            title: 'Form Nilai Siswa',
            type: 'get'
        })
    })
    // $('#modalLg').on('hidden.bs.modal', function () {
    //     // Inisialisasi kembali select2 di halaman indeks
    //     select2Server({
    //     selector: '.select2Server',
    //     parent: '.content_penilaian_siswa',
    //     routing: `${baseurl}/MataPelajaran/select2`,
    // })
    // });
    

    body.on('click', '.btn-edit', function (e) {
        e.preventDefault();
        showModal({
            url: $(this).attr('href'),
            modalId: 'modalLg',
            title: 'Form Nilai Siswa',
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

    body.on('change', 'select[name="nama_matapelajaran"]', function () {
        const value = $(this).val();
        $('#dataTable').DataTable().destroy();
        initDatatable(value);
    })

    
})
