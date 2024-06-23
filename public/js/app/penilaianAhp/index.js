var body = $('body');
var baseurl = $('.baseurl').data('value');
var initialData = [];
var dataAhp = [];
var proses_ahp = [];
var loadData = () => {
    $.ajax({
        url: `${baseurl}/PenilaianAhp/initialData`,
        type: 'get',
        dataType: 'json',
        success: function (data) {
            initialData = data;
        }
    })
}

var resultDataAhp = () => {
    $.ajax({
        url: `${baseurl}/PenilaianAhp/resultDataAhp`,
        type: 'get',
        dataType: 'json',
        success: function (data) {
            dataAhp = data;
        }
    })
}

var loadDataAhp = () => {
    const tabKriteriaActive = $('.tab-kriteria.active');
    const tipe = tabKriteriaActive.data('tipe');
    const kriteria_id = tabKriteriaActive.data('kriteria_id');

    const id = tabKriteriaActive.attr('id');
    var data_matriks = $(`.tab-content-section[data-tipe="${tipe}"][data-kriteria_id="${kriteria_id}"][data-id="${id}"] .data_matriks`);

    const tipeAhp = tipe === 'alternatif' ? 'ahp_alternatif' : 'ahp_kriteria';
    const dataAhpResult = dataAhp[tipeAhp];
    if (dataAhpResult !== undefined) {
        if (dataAhpResult.hasOwnProperty(kriteria_id)) {
            const dataAhpKriteria = dataAhpResult[kriteria_id];
            const matriks_perbandingan_original = dataAhpKriteria['matriks_perbandingan_original'];
            $.each(data_matriks, function (value, index) {
                const alternatif_id1 = $(this).data('alternatif_id1');
                const alternatif_id2 = $(this).data('alternatif_id2');
                const valueMatriks = matriks_perbandingan_original[alternatif_id1][alternatif_id2];
                $(this).data('value', valueMatriks);

                const hasInversMatriks = $(this).hasClass('invers_matrix');
                if (hasInversMatriks) {
                    $(this).text(valueMatriks);
                }

                const hasFormControll = $(this).hasClass('form-control');
                if (hasFormControll) {
                    $(this).find(`option[value="${valueMatriks}"]`).prop('selected', true);
                }
            })
        }
    }
}

$(function () {
    $('[data-toggle="tooltip"]').tooltip()
})

$(document).ready(function () {
    loadData();
    resultDataAhp();
    loadDataAhp();

    body.on('change', 'select[name="select_matrix"]', function (e) {
        const tabKriteriaActive = $('.tab-kriteria.active');
        const tipe = tabKriteriaActive.data('tipe');
        const kriteria_id = tabKriteriaActive.data('kriteria_id');
        const id = tabKriteriaActive.attr('id');

        let row = $(this).data('row');
        let column = $(this).data('column');
        let value = $(this).val();
        let valueInvers = '';
        const { matriks } = initialData.data_statis;

        const checkSearch = String(value).search('/');
        if (checkSearch == 1) {
            valueInvers = String(value).substring(2, 3);
        } else {
            valueInvers = `1/${value}`;
        }

        if (value == '') {
            valueInvers = 0;
        }

        const dataMatriks = $(`.tab-content-section[data-tipe="${tipe}"][data-kriteria_id="${kriteria_id}"][data-id="${id}"] .invers_matrix[data-row="${column}"][data-column="${row}"]`);

        $(this).data('value', value);
        dataMatriks.text(valueInvers);
        dataMatriks.data('value', valueInvers);
    })

    body.on('click', '.tab-kriteria', function (e) {
        e.preventDefault();

        const tabKriteriaActive = $(this);
        const tipe = tabKriteriaActive.data('tipe');
        const kriteriaId = tabKriteriaActive.data('kriteria_id');
        const tabId = tabKriteriaActive.attr('id');

        const dataMatriks = $(`.tab-content-section[data-tipe="${tipe}"][data-kriteria_id="${kriteriaId}"][data-id="${tabId}"] .data_matriks`);

        const tipeAhp = tipe === 'alternatif' ? 'ahp_alternatif' : 'ahp_kriteria';
        const dataAhpResult = dataAhp[tipeAhp];

        const updateDataMatriks = (matriks, matriks_perbandingan_original) => {
            $.each(matriks, function (index, data) {
                const alternatif_id1 = $(this).data('alternatif_id1');
                const alternatif_id2 = $(this).data('alternatif_id2');

                if (matriks_perbandingan_original.hasOwnProperty(alternatif_id1) && matriks_perbandingan_original[alternatif_id1].hasOwnProperty(alternatif_id2)) {
                    const valueMatriks = matriks_perbandingan_original[alternatif_id1][alternatif_id2];

                    $(this).data('value', valueMatriks);

                    if ($(this).hasClass('invers_matrix')) {
                        $(this).text(valueMatriks);
                    }

                    if ($(this).hasClass('form-control')) {
                        $(this).find(`option[value="${valueMatriks}"]`).prop('selected', true);
                    }
                } else {
                    $(this).data('value', '');

                    if ($(this).hasClass('invers_matrix')) {
                        $(this).text('');
                    }

                    if ($(this).hasClass('form-control')) {
                        $(this).find('option').prop('selected', false);
                    }
                }
            });

        }

        if (dataAhpResult) {
            if (dataAhpResult.hasOwnProperty(kriteriaId)) {
                const matriks_perbandingan_original = dataAhpResult[kriteriaId]['matriks_perbandingan_original'];
                updateDataMatriks(dataMatriks, matriks_perbandingan_original);
            } else {
                dataMatriks.each(function () {
                    const valueMatriks = $(this).data('value');

                    if ($(this).hasClass('invers_matrix')) {
                        $(this).text(valueMatriks);
                    }
                });
            }
        } else {
            dataMatriks.each(function () {
                const valueMatriks = $(this).data('value');

                if ($(this).hasClass('invers_matrix')) {
                    $(this).text(valueMatriks);
                }
            });
        }

    })

    body.on('click', '.btn-hitung', function (e) {
        e.preventDefault();
        const tabKriteriaActive = $('.tab-kriteria.active');
        const tipe = tabKriteriaActive.data('tipe');
        const kriteria_id = tabKriteriaActive.data('kriteria_id');
        const id = tabKriteriaActive.attr('id');
        var data_matriks = $(`.tab-content-section[data-tipe="${tipe}"][data-kriteria_id="${kriteria_id}"][data-id="${id}"] .data_matriks`);

        // validate data
        let error = false;
        $.each(data_matriks, function (value, index) {
            var value = $(this).data('value');
            if (value == '') {
                error = true;
            }
        })
        if (error) {
            return Swal.fire({
                title: 'Failed',
                text: 'Pastikan semua nilai diisi',
                icon: "error",
                confirmButtonText: "OK",
            });
        }

        let perbandingan = {};
        let perbandinganOriginal = {};
        $.each(data_matriks, function (index, value) {
            var kriteria_id1 = $(this).data('kriteria_id1');
            var kriteria_id2 = $(this).data('kriteria_id2');
            if (tipe === 'alternatif') {
                kriteria_id1 = $(this).data('alternatif_id1');
                kriteria_id2 = $(this).data('alternatif_id2');
            }
            var nilai = $(this).data('value');

            if (!(kriteria_id1 in perbandingan)) {
                perbandingan[kriteria_id1] = [];
            }
            if (!(kriteria_id1 in perbandinganOriginal)) {
                perbandinganOriginal[kriteria_id1] = [];
            }

            perbandinganOriginal[kriteria_id1].push({
                [kriteria_id2]: String(nilai),
            })

            if (String(nilai).indexOf('/') !== -1) {
                const pecahan = nilai.split('/');
                nilai = parseFloat(pecahan[0]) / parseFloat(pecahan[1]);
            }

            perbandingan[kriteria_id1].push({
                [kriteria_id2]: parseFloat(nilai),
            })
        });

        function mergeObjects(data) {
            const result = {};
            Object.keys(data).forEach(key => {
                result[key] = {};

                data[key].forEach(obj => {
                    Object.entries(obj).forEach(([innerKey, value]) => {
                        result[key][innerKey] = value;
                    });
                });
            });

            return result;
        }
        // Gabungkan data
        const mergedData = mergeObjects(perbandingan);
        const mergedDataOriginal = mergeObjects(perbandinganOriginal);

        let pasingData = {
            matrix: mergedData,
            matrix_original: mergedDataOriginal,
            is_kriteria: 1,
            kriteria_id: kriteria_id,
            tipe: tipe,
        };
        if (tipe === 'alternatif') {
            pasingData = {
                ...pasingData,
                is_kriteria: 0,
            };
        }
        $.ajax({
            url: `${baseurl}/PenilaianAhp/prosesAhp`,
            type: 'post',
            beforeSend: function () {
                $(".btn-hitung").attr("disabled", true);
                $(".btn-hitung").html(disableButton);
            },
            data: pasingData,
            dataType: 'json',
            success: function (data) {
                showModal({
                    url: `${baseurl}/PenilaianAhp/resultAhp`,
                    modalId: 'modalXl',
                    title: 'Form Hasil Perhitungan',
                    type: 'get',
                    data: {
                        tipe: data.tipe,
                        kriteria_id: data.kriteria_id,
                    }
                })
                resultDataAhp();
            },
            complete: function () {
                $(".btn-hitung").attr("disabled", false);
                $(".btn-hitung").html(`<i class="fas fa-calculator"></i> Proses AHP`);
            }
        })
    })

    const showError = (message) => {
        return Swal.fire({
            title: 'Failed',
            text: message,
            icon: 'error',
            confirmButtonText: 'OK',
        });
    }

    const validationBeforeCount = () => {
        const tabKriteriaActive = $('.tab-kriteria.active');
        const tipe = tabKriteriaActive.data('tipe');
        const kriteriaId = tabKriteriaActive.data('kriteria_id');

        const tipeAhp = (tipe === 'alternatif') ? 'ahp_alternatif' : 'ahp_kriteria';
        const dataAhpResult = dataAhp[tipeAhp];
        let output = '';
        if (tipeAhp === 'ahp_alternatif') {
            if (!dataAhpResult || dataAhpResult.length === 0) {
                output = 'Pastikan anda sudah mengisi matriks perbandingan';
            }
        } else {
            if (dataAhpResult === undefined) {
                output = 'Pastikan anda sudah mengisi matriks perbandingan';
            }
        }

        if (tipeAhp === 'ahp_alternatif') {
            if (typeof dataAhpResult[kriteriaId] === 'undefined') {
                output = 'Pastikan anda sudah mengisi matriks perbandingan';
            }
        } else {
            if (dataAhpResult === undefined) {
                output = 'Pastikan anda sudah mengisi matriks perbandingan';
            }
        }
        return output;
    }

    body.on('click', '.btn-hasil-perhitungan', function (e) {
        e.preventDefault();
        const checkValidations = validationBeforeCount();
        if (checkValidations !== '') {
            return showError(checkValidations);
        }

        const tabKriteriaActive = $('.tab-kriteria.active');
        if (tabKriteriaActive.length == 0) {
            return Swal.fire({
                title: 'Failed',
                text: 'Silahkan pilih kriteria terlebih dahulu',
                icon: 'error',
                confirmButtonText: 'OK',
            });
        }
        const tipe = tabKriteriaActive.data('tipe');
        const kriteriaId = tabKriteriaActive.data('kriteria_id');

        showModal({
            url: `${baseurl}/PenilaianAhp/resultAhp`,
            modalId: 'modalXl',
            title: 'Form Hasil Perhitungan',
            type: 'get',
            data: {
                tipe,
                kriteria_id: kriteriaId,
            },
        });
    })

    body.on('click', '.btn-print-hasil', function (e) {
        e.preventDefault();
        const checkValidations = validationBeforeCount();
        if (checkValidations !== '') {
            return showError(checkValidations);
        }

        const tabKriteriaActive = $('.tab-kriteria.active');
        const tipe = tabKriteriaActive.data('tipe');
        const kriteriaId = tabKriteriaActive.data('kriteria_id');

        window.open(`${baseurl}/PenilaianAhp/resultAhpPdf?tipe=${tipe}&kriteria_id=${kriteriaId}`, '_blank');
    })

    const validationHasilAkhir = () => {
        const tipeAlternatif = 'ahp_alternatif';
        const tipeKriteria = 'ahp_kriteria';
        const dataAhpResultAlternatif = dataAhp[tipeAlternatif];
        const dataAhpResultKriteria = dataAhp[tipeKriteria];
        const dataKriteria = dataAhp['kriteria'];
        const lengthDataAhpResultAlternatif = Object.keys(dataAhpResultAlternatif).map(item => item);

        let errorMessage = '';
        if (!dataAhpResultAlternatif || lengthDataAhpResultAlternatif.length === 0) {
            errorMessage = 'Pastikan anda sudah mengisi matriks perbandingan';
        }

        if (dataAhpResultKriteria === undefined) {
            errorMessage = 'Pastikan anda sudah mengisi matriks perbandingan';
        }

        if (dataAhpResultKriteria.cr > 0.1) {
            errorMessage = 'Matriks perbandingan kriteria belum konsisten';
        }

        if (dataKriteria.length !== lengthDataAhpResultAlternatif.length) {
            errorMessage = 'Pastikan matriks perbandingan alternatif sudah mengisi form matriks perbandingan';
        }

        let error = false;
        let message = '';
        Object.keys(dataAhpResultAlternatif).map(kriteriaId => {
            const getKriteria = dataKriteria.find(item => item.id === kriteriaId);
            const dataAhp = dataAhpResultAlternatif[kriteriaId];
            if (dataAhp.cr > 0.1) {
                error = true;
                message += `Matriks perbandingan alternatif ${getKriteria.nama_kriteria} belum konsisten \n `;
            }
        })
        if (error) {
            errorMessage = message;
        }

        return errorMessage;
    }

    body.on('click', '.tab-result-kriteria', function (e) {
        e.preventDefault();

        const getValidationHasilAkhir = validationHasilAkhir();
        if (getValidationHasilAkhir !== '') {
            return showError(getValidationHasilAkhir);
        }

        showModal({
            url: `${baseurl}/PenilaianAhp/lastResultAhp`,
            modalId: 'modalXl',
            title: 'Form Hasil Akhir',
            type: 'get',
        });
    })

    body.on('click', '.tab-result-kriteria-print', function (e) {
        e.preventDefault();
        const getValidationHasilAkhir = validationHasilAkhir();
        if (getValidationHasilAkhir !== '') {
            return showError(getValidationHasilAkhir);
        }
        window.open(`${baseurl}/PenilaianAhp/lastResultAhpPdf`, '_blank');
    })
})
