watch: {
    "hubungan_pasien.value": function(val) {
        if (val === "Pasien_sendiri") {
            const ext_px_data = data.external_link.px_data
            data.nama = ext_px_data.nama
            data.kelamin = ext_px_data.kelamin
            data.nik = ext_px_data.no_identitas
            data.telp = ext_px_data.telp
            data.dirawat.no_rm = ext_px_data.no_rm
            data.alamat = ext_px_data.alamat
            data.tgl_lahir = ext_px_data.tanggal_lahir || "";
            data.tgl_lahir_indo = dateParse(new Date(ext_px_data.tanggal_lahir || ""))
            data.bukti_diri = ext_px_data.no_identitas
        } else {
            data.nama = ext_px_data.nama
            data.kelamin = ext_px_data.kelamin
            data.nik = ext_px_data.no_identitas
            data.telp = ext_px_data.telp
            data.dirawat.no_rm = ext_px_data.no_rm
            data.alamat = ext_px_data.alamat
            data.tgl_lahir = ext_px_data.tanggal_lahir || "";
            data.tgl_lahir_indo = dateParse(new Date(ext_px_data.tanggal_lahir || ""))
            data.bukti_diri = ext_px_data.no_identitas
        }
    }
}, 