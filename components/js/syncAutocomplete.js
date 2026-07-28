$('#dpjp_auto').on('select2:select', function (e) {
    const selected = e.params.data;

    if (selected) {
        data.ttd_data.dokter = selected.nama;
        setTimeout(() => {
            data.ttd_data.dokter_stroke = generatorQr(data.ttd_data.dokter);
        }, 1000);
    }
});

$('#dokter_auto1').on('select2:select', function (e) {
    const selected = e.params.data;

    if (selected) {
        data.dpjp = selected.nama;
    }
});