---
name: create-continues-document
description: Memperbarui file `output/index.html` dan `output/print.php` menjadi dokumen berkelanjutan yang merupakan dokumen yang terintegrasi langsung dengan database, tidak ada button save karena ke-save otomatis dan tidak berpengaruh/mempengaruhi data sample atau `output/json.html`
---

# Langkah Langkah Pengerjaan


## Analisis Data Json, Form Html dan Print PHP
Analisis terlebih dahulu file `output/json.js`, `output/index.html`, dan `output/print.php`.
Data yang akan digunakan pada `output/json.js` adalah data pada objek `sample` saja tapi selain `external_link`.
Contoh :
isi asli file `output/json.js` misal seperti ini 
```json
const data = {
    "sample": {
        "pasien": {
            "nama": "Garga",
            "no_rm": "876754",
            "tanggal_lahir": "2000-08-08",
            "tanggal_lahir_indo": "8 Agustus 2000",
            "kelamin": "Laki-laki",
            "alamat": "Sleman",
            "tempat_lahir": "Bandung",
            "pekerjaan": "Influencer",
            "pendidikan": "Diplomat",
            "agama": "Islam",
            "umur": "35",
            "ruang": "Kelas",
            "bangsal": "bangsal",
            "kelas": "10 MIPA 2",
            "tanggal_masuk": "2000-08-08",
            "tanggal_masuk_indo": "8 Agustus 2000",
            "jam_masuk": "20:00"
        },
        "ttd_data": {
            "kota": "",
            "tanggal_rujukan_peserta": "",
            "tanggal_rujukan_balik": "",
            "jam_rujukan_peserta": "",
            "jam_rujukan_balik": "",
            "perawat": "Sunarni",
            "perawat_stroke": "",
            "dokter": "dr. Sunarno",
            "dokter_stroke": "",
            "dokter_rumah_sakit": "dr. Budiman",
            "dokter_rumah_sakit_stroke": ""
        },
        "rujukan": {
            "no_rujukan": "RJ-001",
            "kode_rs": "KRS-123",
            "rumah_sakit": "RS Yasyfin Darussalam Gontor",
            "kabupaten_kota": "Ponorogo",
            "kepada_yth": "dr. Andi",
            "rsu": "RSUD Dr. Harjono",
            "no_kartu_bpjs": "000123456789",
            "status": "Utama",
            "diagnosa_group": "",
            "diagnosa_freetext": "Demam Berdarah Dengue",
            "diagnosa_list_autocomplete": [],
            "telah_diberikan": "Paracetamol"
        },
        "rujukan_balik": {
            "no_rujukan": "RJB-001",
            "kode_rs": "KRS-123",
            "rumah_sakit": "RSUD Dr. Harjono",
            "diagnosa_group": "",
            "diagnosa_freetext": "Demam Berdarah Dengue",
            "diagnosa_list_autocomplete": [],
            "terapi": "Perawatan Intensif",
            "pengobatan_dengan_obat": true,
            "pengobatan_dengan_obat_text": "Amoxicillin",
            "perlu_rawat_inap": false,
            "kontrol_kembali": true,
            "kontrol_kembali_tanggal": "2026-08-01",
            "konsultasi_selesai": false,
            "lain_lain": false,
            "lain_lain_text": ""
        },
        "external_link": {
            "patient_info_data": {
                "no_register": "2001080007",
                "id_pasien": "00000092",
                "id_pendaftaran": 1823,
                "id_layanan_pendaftaran": 2080,
                "waktu_daftar": "2020-01-08 10:28:09",
                "waktu_keluar": "2020-01-08 18:15:41",
                "jenis": "Poliklinik",
                "tindak_lanjut": "Pulang",
                "kondisi_keluar": "Hidup",
                "nama_pjwb": "",
                "telp_pjwb": "",
                "alamat_pjwb": "",
                "nama_pjwb_finansial": "",
                "telp_pjwb_finansial": "",
                "alamat_pjwb_finansial": "",
                "nama_ayah": "Abdullah",
                "nama_ibu": "Aminah",
                "nama_pasangan": "Khaleed",
                "cara_bayar": "Tunai",
                "nama_penjamin": "",
                "klinik": "Umum",
                "nopolish": "",
                "no_sep": "0144R0010923V000645",
                "no_rujukan": "111502020923Y000193",
                "bpjs_information": [
                    {
                        "id_bpjs_surat_kontrol": 485,
                        "waktu_terbit": "2022-06-29 08:24:14",
                        "tanggal_kontrol": "2022-07-13",
                        "jenis": "Kontrol",
                        "nomor_surat": "0144R0010622K001044",
                        "dipakai": 1
                    },
                    {
                        "id_bpjs_surat_kontrol": 958,
                        "waktu_terbit": "2022-07-13 07:43:20",
                        "tanggal_kontrol": "2022-07-27",
                        "jenis": "Kontrol",
                        "nomor_surat": "0144R0010722K000456",
                        "dipakai": 1
                    },
                    {
                        "id_bpjs_surat_kontrol": 1435,
                        "waktu_terbit": "2022-07-27 08:26:58",
                        "tanggal_kontrol": "2022-08-10",
                        "jenis": "Kontrol",
                        "nomor_surat": "0144R0010722K000969",
                        "dipakai": 1
                    }
                ],
                "sep_information": {
                    "noSep": "0144R0010923V000645",
                    "tglSep": "2023-09-12",
                    "jnsPelayanan": "Rawat Jalan",
                    "kelasRawat": "Kelas 3",
                    "diagnosa": "Malignant neoplasm of sigmoid colon",
                    "noRujukan": "111502020923Y000193",
                    "poli": "BEDAH",
                    "poliEksekutif": "0",
                    "catatan": "MINTA RUJUKAN",
                    "penjamin": null,
                    "peserta": {
                        "noKartu": "0000535133755",
                        "nama": "WARTI",
                        "tglLahir": "1980-12-23",
                        "noMr": "00031424",
                        "kelamin": "P",
                        "jnsPeserta": "PBI (APBN)",
                        "hakKelas": "Kelas 3",
                        "asuransi": null
                    },
                    "klsRawat": {
                        "klsRawatHak": "3",
                        "klsRawatNaik": null,
                        "pembiayaan": null,
                        "penanggungJawab": null
                    },
                    "informasi": null,
                    "kdStatusKecelakaan": "0",
                    "nmstatusKecelakaan": "Bukan Kecelakaan",
                    "dpjp": {
                        "kdDPJP": "9571",
                        "nmDPJP": "DR  WAHYU PRIYATNO Sp.B"
                    },
                    "kontrol": {
                        "noSurat": null,
                        "kdDokter": null,
                        "nmDokter": null
                    },
                    "lokasiKejadian": {
                        "tglKejadian": null,
                        "kdProp": null,
                        "kdKab": null,
                        "kdKec": null,
                        "ketKejadian": null,
                        "lokasi": null
                    },
                    "cob": "0",
                    "katarak": "0",
                    "tujuanKunj": {
                        "kode": "0",
                        "nama": "Normal"
                    },
                    "flagProcedure": {
                        "kode": "0",
                        "nama": "Prosedur tidak berkelanjutan"
                    },
                    "kdPenunjang": {
                        "kode": "0",
                        "nama": ""
                    },
                    "assestmenPel": {
                        "kode": "0",
                        "nama": ""
                    },
                    "eSEP": "True"
                },
                "rujukan_information": {
                    "asalFaskes": "1",
                    "rujukan": {
                        "noKunjungan": "111502020923Y000193",
                        "tglKunjungan": "2023-09-09",
                        "provPerujuk": {
                            "kode": "11150202",
                            "nama": "Purwareja Klampok 2"
                        },
                        "peserta": {
                            "noKartu": "0000535133755",
                            "nik": "3304026312800003",
                            "nama": "WARTI",
                            "pisa": "3",
                            "sex": "P",
                            "mr": {
                                "noMR": "00031424",
                                "noTelepon": "088220061023"
                            },
                            "tglLahir": "1980-12-23",
                            "tglCetakKartu": "2015-10-30",
                            "tglTAT": "2080-12-01",
                            "tglTMT": "2013-01-01",
                            "statusPeserta": {
                                "kode": "0",
                                "keterangan": "AKTIF"
                            },
                            "provUmum": {
                                "kdProvider": "11150202",
                                "nmProvider": "Purwareja Klampok 2"
                            },
                            "jenisPeserta": {
                                "kode": "21",
                                "keterangan": "PBI (APBN)"
                            },
                            "hakKelas": {
                                "kode": "3",
                                "keterangan": "KELAS III"
                            },
                            "umur": {
                                "umurSekarang": "42 tahun ,9 bulan ,11 hari",
                                "umurSaatPelayanan": "42 tahun ,9 bulan ,14 hari"
                            },
                            "informasi": {
                                "dinsos": null,
                                "prolanisPRB": null,
                                "noSKTM": null,
                                "eSEP": null
                            },
                            "cob": {
                                "noAsuransi": null,
                                "nmAsuransi": null,
                                "tglTMT": null,
                                "tglTAT": null
                            }
                        },
                        "diagnosa": {
                            "kode": "C18.7",
                            "nama": "Malignant neoplasm of sigmoid colon"
                        },
                        "keluhan": "MINTA RUJUKAN",
                        "poliRujukan": {
                            "kode": "BED",
                            "nama": "BEDAH"
                        },
                        "pelayanan": {
                            "kode": "2",
                            "nama": "Rawat Jalan"
                        }
                    }
                }
            },
            "px_data": {
                "no_rm": "00000001",
                "nama": "HANA AMIRA NN",
                "kelamin": "P",
                "tanggal_lahir": "1985-10-24",
                "alamat": "Jln. Magelang, Pantai Timur",
                "tempat_lahir": "Kuningan",
                "pekerjaan": "Wiraswasta",
                "agama": "Islam",
                "pendidikan": "SMA",
                "status_perkawinan": "Belum Kawin",
                "no_identitas": "1234",
                "kelurahan": "14 ILIR",
                "kecamatan": "ILIR TIMUR",
                "kabupaten": "Palembang",
                "provinsi": "SUMATERA SELATAN",
                "telp": "085647387654",
                "email": "hana@gmail.com",
                "nama_ibu": "Ani",
                "nama_ayah": "Budi",
                "gol_darah": "A"
            },
            "inpatient_information": {
                "no_register": "2305010009",
                "id_pasien": "000151",
                "id_pendaftaran": 323,
                "id_layanan_pendaftaran": 396,
                "id_bangsal": 22,
                "nama_bangsal": "Yudhistira (Neurologi)",
                "id_kelas": 1,
                "nama_kelas": "III",
                "no_ruang": "1",
                "nomor_bed": "12",
                "titipan": "Tidak",
                "id_bangsal_titipan": 0,
                "nama_bangsal_titipan": "",
                "id_kelas_titipan": 0,
                "nama_kelas_titipan": "",
                "waktu_masuk": "2023-05-01 20:41:38",
                "waktu_keluar": "2023-05-01 20:43:46"
            },
            "dokter_dpjp_data": {
                "no_register": "2212120001",
                "id_pasien": "00000006",
                "id_pendaftaran": 11,
                "id_layanan_pendaftaran": 16,
                "id_dokter_dpjp": 37,
                "nama_dokter_dpjp": "dr. Subarjo Wibowo",
                "id_spesialis": 2,
                "nama_spesialis": "Umum",
                "id_profesi": 1,
                "nama_profesi": "Dokter",
                "ttd_image": "000002_682b2a74c336d.png"
            },
            "diagnosa_list_rujukan": [
                {
                    "no_register": "2202230010",
                    "id_pasien": "00206957",
                    "id_pendaftaran": 10,
                    "id_layanan_pendaftaran": 1652,
                    "jenis": "Rawat Inap",
                    "tanggal": "2022-03-01",
                    "jam": "09:27:15",
                    "layanan": [
                        {
                            "id_diagnosa": 823,
                            "id_dokter": 177,
                            "nama_dokter": "Reizkiana Feva K.D. dr.Hj.,SpA                    ",
                            "id_spesialis": 1,
                            "nama_spesialis": "Anak",
                            "id_profesi": 2,
                            "nama_profesi": "Dokter Spesialis",
                            "id_sebab_sakit": 3504,
                            "kode_sebab_sakit": "J180",
                            "nama_sebab_sakit": "Bronchopneumonia, unspecified",
                            "icd_x": "J18.0",
                            "deskripsi": "",
                            "kasus": "Baru",
                            "post": "Diagnosa Sementara",
                            "primer": "Primer"
                        },
                        {
                            "id_diagnosa": 826,
                            "id_dokter": 177,
                            "nama_dokter": "Reizkiana Feva K.D. dr.Hj.,SpA                    ",
                            "id_spesialis": 1,
                            "nama_spesialis": "Anak",
                            "id_profesi": 2,
                            "nama_profesi": "Dokter Spesialis",
                            "id_sebab_sakit": 3504,
                            "kode_sebab_sakit": "J180",
                            "nama_sebab_sakit": "Bronchopneumonia, unspecified",
                            "icd_x": "J18.0",
                            "deskripsi": "BP",
                            "kasus": "Baru",
                            "post": "Diagnosa Akhir",
                            "primer": "Primer"
                        }
                    ]
                },
                {
                    "no_register": "2202230010",
                    "id_pasien": "00206957",
                    "id_pendaftaran": 10,
                    "id_layanan_pendaftaran": 1652,
                    "jenis": "Rawat Inap",
                    "tanggal": "2022-03-01",
                    "jam": "09:27:15",
                    "layanan": [
                        {
                            "id_diagnosa": 823,
                            "id_dokter": 177,
                            "nama_dokter": "Reizkiana Feva K.D. dr.Hj.,SpA                    ",
                            "id_spesialis": 1,
                            "nama_spesialis": "Anak",
                            "id_profesi": 2,
                            "nama_profesi": "Dokter Spesialis",
                            "id_sebab_sakit": 3504,
                            "kode_sebab_sakit": "J180",
                            "nama_sebab_sakit": "Bronchopneumonia, unspecified",
                            "icd_x": "J18.0",
                            "deskripsi": "",
                            "kasus": "Baru",
                            "post": "Diagnosa Sementara",
                            "primer": "Primer"
                        },
                        {
                            "id_diagnosa": 826,
                            "id_dokter": 177,
                            "nama_dokter": "Reizkiana Feva K.D. dr.Hj.,SpA                    ",
                            "id_spesialis": 1,
                            "nama_spesialis": "Anak",
                            "id_profesi": 2,
                            "nama_profesi": "Dokter Spesialis",
                            "id_sebab_sakit": 3504,
                            "kode_sebab_sakit": "J180",
                            "nama_sebab_sakit": "Bronchopneumonia, unspecified",
                            "icd_x": "J18.0",
                            "deskripsi": "BP",
                            "kasus": "Baru",
                            "post": "Diagnosa Akhir",
                            "primer": "Primer"
                        }
                    ]
                }
            ],
            "diagnosa_list_rujukan_balik": [
                {
                    "no_register": "2202230010",
                    "id_pasien": "00206957",
                    "id_pendaftaran": 10,
                    "id_layanan_pendaftaran": 1652,
                    "jenis": "Rawat Inap",
                    "tanggal": "2022-03-01",
                    "jam": "09:27:15",
                    "layanan": [
                        {
                            "id_diagnosa": 823,
                            "id_dokter": 177,
                            "nama_dokter": "Reizkiana Feva K.D. dr.Hj.,SpA                    ",
                            "id_spesialis": 1,
                            "nama_spesialis": "Anak",
                            "id_profesi": 2,
                            "nama_profesi": "Dokter Spesialis",
                            "id_sebab_sakit": 3504,
                            "kode_sebab_sakit": "J180",
                            "nama_sebab_sakit": "Bronchopneumonia, unspecified",
                            "icd_x": "J18.0",
                            "deskripsi": "",
                            "kasus": "Baru",
                            "post": "Diagnosa Sementara",
                            "primer": "Primer"
                        },
                        {
                            "id_diagnosa": 826,
                            "id_dokter": 177,
                            "nama_dokter": "Reizkiana Feva K.D. dr.Hj.,SpA                    ",
                            "id_spesialis": 1,
                            "nama_spesialis": "Anak",
                            "id_profesi": 2,
                            "nama_profesi": "Dokter Spesialis",
                            "id_sebab_sakit": 3504,
                            "kode_sebab_sakit": "J180",
                            "nama_sebab_sakit": "Bronchopneumonia, unspecified",
                            "icd_x": "J18.0",
                            "deskripsi": "BP",
                            "kasus": "Baru",
                            "post": "Diagnosa Akhir",
                            "primer": "Primer"
                        }
                    ]
                }
            ]
        }
    },
    "default": {
        "pasien": {
            "nama": "",
            "no_rm": "",
            "tanggal_lahir": "",
            "tanggal_lahir_indo": "",
            "kelamin": "",
            "alamat": "",
            "tempat_lahir": "",
            "pekerjaan": "",
            "pendidikan": "",
            "agama": "",
            "umur": "",
            "ruang": "",
            "bangsal": "",
            "kelas": "",
            "tanggal_masuk": "",
            "tanggal_masuk_indo": "",
            "jam_masuk": ""
        },
        "ttd_data": {
            "kota": "",
            "tanggal_rujukan_peserta": "",
            "tanggal_rujukan_balik": "",
            "jam_rujukan_peserta": "",
            "jam_rujukan_balik": "",
            "perawat": "",
            "perawat_stroke": "",
            "dokter": "",
            "dokter_stroke": ""
        },
        "rujukan": {
            "no_rujukan": "",
            "kode_rs": "",
            "rumah_sakit": "RS Yasyfin Darussalam Gontor",
            "kabupaten_kota": "Ponorogo",
            "kepada_yth": "",
            "rsu": "",
            "no_kartu_bpjs": "",
            "status": "",
            "diagnosa_group": "",
            "diagnosa_freetext": "",
            "diagnosa_list_autocomplete": [],
            "telah_diberikan": ""
        },
        "rujukan_balik": {
            "no_rujukan": "",
            "kode_rs": "",
            "rumah_sakit": "",
            "diagnosa_group": "",
            "diagnosa_freetext": "",
            "diagnosa_list_autocomplete": [],
            "terapi": "",
            "pengobatan_dengan_obat": false,
            "pengobatan_dengan_obat_text": "",
            "perlu_rawat_inap": false,
            "kontrol_kembali": false,
            "kontrol_kembali_tanggal": "",
            "konsultasi_selesai": false,
            "lain_lain": false,
            "lain_lain_text": ""
        }
    }
}
```

data yang akan digunakan untuk dokumen berkelanjutan ini adalah sebagai berikut.
```json
"pasien": {
    "~nama": "Garga",
    "no_rm": "876754",
    "tanggal_lahir": "2000-08-08",
    "tanggal_lahir_indo": "8 Agustus 2000",
    "kelamin": "Laki-laki",
    "alamat": "Sleman",
    "tempat_lahir": "Bandung",
    "pekerjaan": "Influencer",
    "pendidikan": "Diplomat",
    "agama": "Islam",
    "umur": "35",
    "ruang": "Kelas",
    "bangsal": "bangsal",
    "kelas": "10 MIPA 2",
    "tanggal_masuk": "2000-08-08",
    "tanggal_masuk_indo": "8 Agustus 2000",
    "jam_masuk": "20:00"
},
"ttd_data": {
    "kota": "",
    "tanggal_rujukan_peserta": "",
    "tanggal_rujukan_balik": "",
    "jam_rujukan_peserta": "",
    "jam_rujukan_balik": "",
    "perawat": "Sunarni",
    "perawat_stroke": "",
    "dokter": "dr. Sunarno",
    "dokter_stroke": "",
    "dokter_rumah_sakit": "dr. Budiman",
    "dokter_rumah_sakit_stroke": ""
},
"rujukan": {
    "no_rujukan": "RJ-001",
    "kode_rs": "KRS-123",
    "rumah_sakit": "RS Yasyfin Darussalam Gontor",
    "kabupaten_kota": "Ponorogo",
    "kepada_yth": "dr. Andi",
    "rsu": "RSUD Dr. Harjono",
    "no_kartu_bpjs": "000123456789",
    "status": "Utama",
    "diagnosa_group": "",
    "diagnosa_freetext": "Demam Berdarah Dengue",
    "diagnosa_list_autocomplete": [],
    "telah_diberikan": "Paracetamol"
},
"rujukan_balik": {
    "no_rujukan": "RJB-001",
    "kode_rs": "KRS-123",
    "rumah_sakit": "RSUD Dr. Harjono",
    "diagnosa_group": "",
    "diagnosa_freetext": "Demam Berdarah Dengue",
    "diagnosa_list_autocomplete": [],
    "terapi": "Perawatan Intensif",
    "pengobatan_dengan_obat": true,
    "pengobatan_dengan_obat_text": "Amoxicillin",
    "perlu_rawat_inap": false,
    "kontrol_kembali": true,
    "kontrol_kembali_tanggal": "2026-08-01",
    "konsultasi_selesai": false,
    "lain_lain": false,
    "lain_lain_text": ""
},
```

## Ikuti Step by Step Snippet ini
Ini merupakan code snippet yang bisa di tempel ke form html nya

### 1. Tambahkan Variabel Dummy
tambahkan code dibawah ini pada atas function `function init_doc(doc_id, data, operation)`
```javascript
let DOC_ID_DUMMY =  60;
```

### 2. Inisialisasi Variabel
cari komentar `=== [OTHER_VARIABLE_BRIDGING_HOOK] ===` dalam function `function init_doc(doc_id, data, operation)`
dan tambahkan kode dibawah ini dibawah komen tersebut
```javascript
// ---- template ---
data.doc_id = doc_id ? doc_id : DOC_ID_DUMMY; // ngecek id dummy atau id rill
data.doc_status = "ACTIVE"; // Akan diupdate dari API jika sudah pernah dibuat
data.list_data = null;   // variabel untuk menyimpan data tabel dari database
data.isDirty = false; // variabel checking untuk mengecek ada perubahan pada data pasien atau tidak
data.unsavedTimer = null; 
data.showUnsavedWarning = false;
data.showScrollTop = false;

data.pagination = { limit: 10, page: 1, total: 0 };
data.mode = "add";
data.edit_id = null;
data.filterStartDate = "";
data.filterEndDate = "";
data.sortOrder = "DESC";

// Simpan referensi ke data json murni
data.original_static_json = null;
data.static_json = null;
// ---- template ---
```

