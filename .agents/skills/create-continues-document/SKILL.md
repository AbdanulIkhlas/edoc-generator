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
let DOC_ID_DUMMY = 60;
```

### 2. Inisialisasi Variabel

cari komentar `=== [OTHER_VARIABLE_BRIDGING_HOOK] ===` dalam function `function init_doc(doc_id, data, operation)`
dan tambahkan kode dibawah ini dibawah komen tersebut

```javascript
// ---- template ---
data.doc_id = doc_id ? doc_id : DOC_ID_DUMMY; // ngecek id dummy atau id rill
data.doc_status = "ACTIVE"; // Akan diupdate dari API jika sudah pernah dibuat
data.list_data = null; // variabel untuk menyimpan data tabel dari database
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

### 3. Tambahkan ke `mounted`

Pada instance `var app = new Vue({`, cari bagian `mounted: function () {` dan tambahkan pemanggilan inisialisasi dokumen berkelanjutan (tambahkan jika bagian `mounted` belum ada):

```javascript
this.getStaticJson(operation);
this.loadPage(1);

// Scroll event listener for scroll-to-top button
window.addEventListener("scroll", () => {
  this.showScrollTop = window.scrollY > 300;
});
```

### 4. Tambahkan ke `watch`

Tambahkan observer (watch) untuk memantau perubahan pada `static_json` agar muncul warning belum tersimpan:

```javascript
watch: {
    static_json: {
        handler: function (dataFormSaatIni) {
            if (!this.original_static_json) return;

            const dataSekarangString = JSON.stringify(dataFormSaatIni);
            const dataAsliString = JSON.stringify(this.original_static_json);
            this.isDirty = dataSekarangString !== dataAsliString;

            clearTimeout(this.unsavedTimer);
            this.showUnsavedWarning = false;

            if (this.isDirty) {
                this.unsavedTimer = setTimeout(() => {
                    this.showUnsavedWarning = true;
                }, 3000);
            }
        },
        deep: true,
    },
},
```

### 5. Tambahkan ke `computed`

Tambahkan state komputasi untuk mempermudah perhitungan Pagination:

```javascript
computed: {
    pages() {
        const numShown = 5;
        const pages = [];
        let start = Math.max(1, this.pagination.page - Math.floor(numShown / 2));
        let end = Math.min(this.totalPages, start + numShown - 1);

        if (end - start + 1 < numShown) {
            start = Math.max(1, end - numShown + 1);
        }

        for (let i = start; i <= end; i++) {
            pages.push(i);
        }
        return pages;
    },
    totalPages() {
        return Math.ceil(this.pagination.total / this.pagination.limit);
    },
    paginationInfo() {
        const start = (this.pagination.page - 1) * this.pagination.limit + 1;
        const end = Math.min(this.pagination.page * this.pagination.limit, this.pagination.total);
        return `Menampilkan ${start} - ${end} dari ${this.pagination.total} data`;
    },
},
```

### 6. Tambahkan ke `methods` (API Handlers Berkelanjutan)

Tambahkan method berikut ke dalam properti `methods:` pada instance Vue. Method ini menangani pengambilan, penyimpanan, dan sinkronisasi data utama (static_json) serta pagination data list (list_data).

```javascript
handleScroll: function () {
    this.showScrollTop = window.scrollY > 300;
},
scrollToTop: function () {
    window.scrollTo({ top: 0, behavior: "smooth" });
},
getStaticJson: async function (operation) {
    if (operation === "add") {
        let isSuccess = false;

        const payload = {
            patient_document_id: this.doc_id,
            emr_data: {
                static: this.external_link,
            },
        };

        await apiHelper({
            method: "PUT",
            url: `/api/patient_document_item/update-static`,
            requestData: payload,
            notifyOnError: true,
            renderSuccess: (response) => {
                isSuccess = true;
            },
        });

        if (!isSuccess) return;
    }

    await apiHelper({
        url: `/api/patient_document/get_static/${this.doc_id}`,
        notifyOnError: true,
        renderSuccess: (response) => {
            this.static_json = response.data.static_json;
            // Sinkronisasi manual px_data agar jika kosong bisa diganti
            if (!this.static_json.px_data) {
                this.static_json.px_data = {
                    nama: data.pasien.nama,
                    no_rm: data.pasien.no_rm,
                    kelamin: data.pasien.kelamin,
                    tanggal_lahir: data.pasien.tanggal_lahir,
                    tanggal_lahir_indo: data.pasien.tanggal_lahir_indo
                };
            }
            this.original_static_json = JSON.parse(JSON.stringify(this.static_json));
            this.isDirty = false;
            this.showUnsavedWarning = false;
        },
    });

    if (operation === "edit") {
        // jika ada yang ingin di proses ketika edit dokumen
        // contoh jika ada tanda tangan
        // setSelect2($("#dokter_auto1"), this.ttd_data.dokter, this.ttd_data.dokter);
        // setSelect2($("#nakes_auto1"), this.ttd_data.perawat, this.ttd_data.perawat);
    }
},
stopPatientDocument: async function () {
    await apiHelper({
        url: `/api/patient_document/stop/${this.doc_id}`,
        notifyOnError: true,
        notifyOnSuccess: true,
        confirm: {
            title: "Yakin ingin menyelesaikan dokumen Ini?",
            confirmText: "Ya, selesaikan!",
            icon: "warning",
            confirmButtonColor: "#dc3545",
            cancelButtonColor: "#6c757d",
        },
        renderSuccess: (result) => {
            this.doc_status = "CLOSED";
        },
    });
},
startPatientDocument: async function () {
    await apiHelper({
        url: `/api/patient_document/start/${this.doc_id}`,
        notifyOnError: true,
        notifyOnSuccess: true,
        confirm: {
            title: "Yakin ingin melanjutkan dokumen Ini?",
            icon: "warning",
            confirmButtonColor: "#28a745",
            cancelButtonColor: "#6c757d",
        },
        renderSuccess: (result) => {
            this.doc_status = "ACTIVE";
        },
    });
},
loadPage: async function (page) {
    if (page < 1 || (page > this.totalPages && this.totalPages > 0)) return;
    this.list_data = null;
    let apiUrl = `/api/patient_document_item/list?patient_document_id=${this.doc_id}&p=${page}`;
    if (this.filterStartDate) apiUrl += `&start_date=${this.filterStartDate}`;
    if (this.filterEndDate) apiUrl += `&end_date=${this.filterEndDate}`;
    apiUrl += `&sort_order=${this.sortOrder}`;

    await apiHelper({
        url: apiUrl,
        notifyOnError: true,
        renderSuccess: (response) => {
            this.$set(this, "list_data", response.data);
            this.pagination.page = response.page;
            this.pagination.limit = response.limit;
            this.pagination.total = response.total;
        },
    });
},
saveStaticJson: async function () {
    if (this.unsavedTimer) {
        clearTimeout(this.unsavedTimer);
        this.unsavedTimer = null;
        this.showUnsavedWarning = false;
    }

    const payload = {
        patient_document_id: this.doc_id,
        emr_data: {
            static: this.static_json,
        },
    };

    await apiHelper({
        url: `/api/patient_document_item/update-static`,
        method: "PUT",
        requestData: payload,
        notifyOnError: true,
        notifyOnSuccess: true,
        renderSuccess: (response) => {
            this.original_static_json = JSON.parse(JSON.stringify(this.static_json));
            this.isDirty = false;
        },
    });
},
async saveEntryItemHandler() {
    const payload = {
        patient_document_id: this.doc_id,
        entry_data: this.cppt_tmp,
    };

    await apiHelper({
        url: `/api/patient_document_item/add`,
        method: "POST",
        notifyOnError: true,
        notifyOnSuccess: true,
        requestData: payload,
        renderSuccess: (response) => {
            this.loadPage(this.pagination.page);
        },
    });
},
async editDataHandler() {
    if (!this.edit_id) {
        console.warn("edit ID tidak ditemukan");
        return;
    }

    this.pendingScrollAfterEdit = this.edit_id;

    const payload = {
        emr_data: {
            entry: this.cppt_edit,
        },
    };

    await apiHelper({
        url: `/api/patient_document_item/update-entry/${this.edit_id}`,
        method: "PUT",
        requestData: payload,
        notifyOnError: true,
        notifyOnSuccess: true,
        renderSuccess: (response) => {
            $("#modal_edit").modal("hide");
            this.loadPage(this.pagination.page);
        },
    });
},
async hapusItem(id) {
    await apiHelper({
        url: `/api/patient_document_item/delete/${id}`,
        method: "DELETE",
        notifyOnError: true,
        notifyOnSuccess: true,
        confirm: {
            title: "Yakin ingin menghapus data ini?",
            icon: "warning",
        },
        renderSuccess: (response) => {
            this.loadPage(this.pagination.page);
        },
    });
},
applyFilter: function () {
    if (this.filterStartDate && this.filterEndDate) {
        if (this.filterEndDate < this.filterStartDate) {
            console.error("Filter error: Tanggal selesai tidak boleh sebelum tanggal mulai.");

            showNotification({
                variant: "info",
                message: "Tanggal Selesai tidak boleh lebih awal dari Tanggal Mulai.",
                position: "top-right",
                autoClose: true,
                duration: 3000,
            });

            return;
        }
    }

    this.loadPage(1);
    $("#filterModal").modal("hide");
},
clearFilter: function () {
    console.log("Membersihkan filter...");
    // Reset nilai filter
    this.filterStartDate = null;
    this.filterEndDate = null;

    this.loadPage(1);
    $("#filterModal").modal("hide");
},
```

### 7. Hapus/Sesuaikan Pemanggilan Save yang Lama

Karena dokumen berkelanjutan (continuous) memiliki sifat auto-save berdasarkan object state (`this.static_json`) atau penambahan item ke list (`saveEntryItemHandler`), maka hapus tombol-tombol _Save Form Utama_ yang bersifat statis yang biasanya ada di paling bawah form dan hapus logika form validasi _hardcoded_ jika mengganggu flow berkelanjutan. Bridging list dari API lain juga harus diarahkan untuk memasukkan data langsung ke dalam `this.static_json` agar menjadi reaktif.

> **Catatan Penting Pada Vue Methods (Bridging):** Saat melakukan set property reaktif, biasakan memanggil `this.$set(this.static_json, 'namaproperty', nilai)` lalu memanggil object collapse / modal secara bergantian dengan `setTimeout()` jika diperlukan render DOM, misalnya:
>
> ```javascript
> setTimeout(() => {
>   $("#collapse_id").collapse("show");
> }, 100);
> ```

> **Catatan Penting Z-Index Modal:** Jika ada modal tambahan yang dimunculkan untuk mengambil data bridging di atas Modal Form Utama, berikan CSS styling `z-index: 1060 !important;` ke modal anak untuk memastikan modal itu berada di atas backdrop standar.

### 8. Tambahkan HTML DOM Tambahan

Salin elemen pemberitahuan (_Floating Warning Unsaved_) di bagian atas/bawah `<form>`:

```html
<div v-if="showUnsavedWarning" class="unsaved-notification-bar">
  <span>
    <i class="fa fa-warning"></i>
    Ada perubahan yang belum disimpan!
  </span>
  <button
    type="button"
    v-on:click="saveStaticJson"
    class="btn btn-primary btn-sm"
  >
    <i class="fa fa-save"></i> Perbarui Sekarang
  </button>
</div>
```

**Informasi Identitas Pasien (contoh):**
Ganti bagian atas form HTML identitas lama dengan Card Info Pasien dan tambahkan `id="pasien-info"`. Di bagian bawah card ini (footer), letakkan tombol-tombol untuk memanajemen status dokumen (Perbarui, Selesaikan, Lanjutkan) yang memanggil fungsi `saveStaticJson`, `stopPatientDocument`, dan `startPatientDocument`:

```html
<div class="card patient-card shadow-sm mb-3" id="pasien-info">
  <div class="card-header bg-light">
    <h5 class="mb-0 text-dark">Data Identitas Pasien</h5>
  </div>
  <div class="card-body">
    <div class="row" v-if="static_json">
      <!-- Isi dengan kolom nama, no_rm, kelamin dll menggunakan v-model="static_json.px_data.nama" -->
    </div>
  </div>
  <div class="card-footer">
      <button type="button" v-on:click="saveStaticJson" class="btn btn-primary">
          <i class="fa fa-refresh"></i>
          Perbarui
      </button>
      <button v-if="doc_status === 'ACTIVE'" type="button" v-on:click="stopPatientDocument"
          class="btn btn-danger">
          <i class="fa fa-lock" aria-hidden="true"></i>
          Selesaikan Dokumen
      </button>
      <button v-else-if="doc_status === 'CLOSED'" type="button" v-on:click="startPatientDocument"
          class="btn btn-success">
          <i class="fa fa-unlock" aria-hidden="true"></i>
          Lanjutkan Dokumen
      </button>
  </div>
</div>
```

### 9. Tambahkan CSS Styles

Tambahkan CSS ini di dalam tag `<style>` untuk styling elemen _continuous doc_ seperti card pasien, pagination, dan floating action bar.

```css
.patient-card {
  border: 1px solid #dee2e6;
  margin-top: 15px;
  border-radius: 8px;
}
.patient-card .data-label {
  font-weight: 600;
  color: #6c757d;
  margin-bottom: 2px;
  font-size: 0.9rem;
}
.patient-card .data-value {
  font-size: 1.05rem;
  color: #212529;
  width: 100%;
  border: 1px solid #ced4da;
  padding: 5px;
  border-radius: 4px;
  background-color: #f8f9fa;
}
.unsaved-notification-bar {
  position: fixed;
  bottom: 20px;
  left: 50%;
  transform: translateX(-50%);
  z-index: 1050;
  background-color: #333;
  color: white;
  padding: 12px 20px;
  border-radius: 8px;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
  display: flex;
  justify-content: space-between;
  align-items: center;
  gap: 20px;
}
.unsaved-notification-bar .fa-warning {
  color: #ffc107;
  margin-right: 8px;
}
```

### 10. Konfigurasi `print.php` dengan Redis

Dokumen berkelanjutan menggunakan Redis untuk mencetak dokumen. File `output/print.php` harus diubah untuk mengambil data JSON yang telah disimpan dengan menggunakan kunci `_static` untuk form header (pasien) dan data `entry` untuk tabel dinamis.

```php
<?php
// Ambil Key dari Argumen
$redisKey = $argv[1];
$serverAddress = $argv[2];

// Koneksi ke Redis
$redis = new Redis();
try {
    $redis->connect('localhost', 6379);
} catch (Exception $e) {
    die("Gagal koneksi ke Redis: " . $e->getMessage());
}

$jsonString = $redis->get($redisKey);
$staticJsonString = $redis->get($redisKey . "_static");

if (!$jsonString) {
    die("Dokumen ini tidak memiliki preview.");
}

$params = json_decode($jsonString);
$static_label = json_decode($staticJsonString);

$title = "ASSESMEN MEDIS LANJUTAN"; // Ubah sesuai judul

$entries = isset($params->entry) ? $params->entry : [];
$static = isset($params->static_json->static_json) ? $params->static_json->static_json : null;
?>
```

Lalu di bagian cetak identitas, gunakan variabel `$static->px_data->nama` dan untuk _list record_, lakukan perulangan (looping):

```php
<?php foreach ($entries as $row): ?>
    <?php $v = is_object($row) && isset($row->entry_data) ? $row->entry_data : $row; ?>
    <!-- cetak variabel $v->nama_properti di dalam tabel -->
<?php endforeach; ?>
```

## Referensi Tambahan & Contoh Implementasi

Anda dapat melihat contoh konkrit *full implementation* dari dokumen berkelanjutan yang sudah berjalan dengan baik di direktori:
- **HTML Form / Vue**: `example/example-berkelanjutan-1.html` dan yang lainnya
- **PHP Print**: `example/example-berkelanjutan-1.php` dan yang lainnya

Gunakan file-file tersebut sebagai pedoman / contekan (*cheat sheet*) untuk membandingkan alur kodenya jika terdapat bagian yang kurang jelas pada snippet di atas.
