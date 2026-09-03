const data = {
    "sample": {
        "indexExpandTindakanUtama": [],
        "ttd_data": {
            "kota": "Sleman",
            "tanggal": "2000-08-08",
            "tanggal_indo": "8 Agustus 2000",
            "jam": "20:00",
            "perawat": "Sunarni",
            "perawat_stroke": "",
            "dokter": "dr. Sunarno",
            "dokter_stroke": ""
        },
        "pasien": {
            "nama": "testing",
            "no_rm": "12345678",
            "tanggal_lahir": "1970-01-01",
            "tanggal_lahir_indo": "01 Januari 1970",
            "kelamin": "L",
            "kelas": "123",
            "nik":"7471928374644472"
        },
        "anamnesa": "testing",
        "pemeriksaan_fisik": {
            "ttv": {
                "tensi": {
                    "sistole": 120,
                    "diastole": 90
                },
                "nadi": 30,
                "nafas": 50,
                "suhu": 37,
                "bb": 78,
                "tb": 178
            },
            "keterangan": "Aman Terkendali"
        },
        "list_diagnosa": [{
            "icd_x": "ABC",
            "nama_sebab_sakit": "testing"
        }],
        "diagnosa_freetext": "testing",
        "tindakan": [
            {
                "nama_layanan": "Poliklinik Bedah, ",
                "icd_9_code": "89.08",
                "icd_9_name": "Other consultation"
            }
        ],
        "tindakan_freetext": "testing",
        "terapi": "testing",
        "ttd": {
            "tanggal_ttd_dokter": "2023-01-01",
            "tanggal_ttd_dokter_indo": "01 Januari 2023",
            "jam_ttd_dokter": "10:10",
            "dokter_ttd": "testing",
            "tanggal_ttd_perawat": "2023-01-01",
            "tanggal_ttd_perawat_indo": "01 Januari 2023",
            "jam_ttd_perawat": "10:10",
            "perawat_ttd": "testing"
        },
        "external_link": {
            "prescription_data": [
                {
                    "no_register": "2301180002",
                    "id_pasien": "00000093",
                    "id_pendaftaran": 167,
                    "id_layanan_pendaftaran": 200,
                    "id_resep": 69,
                    "status_obat_pulang": "Tidak",
                    "resep": [
                        {
                            "r_no": 1,
                            "nama_pendek": "AMBROXOL ( TESTING ) 30 mg Tablet",
                            "nama_obat": "AMBROXOL ( TESTING ) 30 mg Tablet <i>ABBOT INDONESIA, PT </i>",
                            "qty": 1,
                            "nama_satuan": "Tablet",
                            "kekuatan": 30,
                            "nama_kekuatan": "mg",
                            "aturan_pakai": "1dd0,2ml",
                            "ket_aturan_pakai": "1 x sehari 0,2 ml",
                            "timing": "Sesudah",
                            "admintime": "Pagi: 06.00"
                        },
                        {
                            "r_no": 2,
                            "nama_pendek": "AMLODIPIN ( TESTING ) 5 mg Tablet",
                            "nama_obat": "AMLODIPIN ( TESTING ) 5 mg Tablet <i>ABBOT INDONESIA, PT </i>",
                            "qty": 2,
                            "nama_satuan": "Tablet",
                            "kekuatan": 5,
                            "nama_kekuatan": "mg",
                            "aturan_pakai": "1dd2",
                            "ket_aturan_pakai": "1 x sehari 2 tablet",
                            "timing": "Sesudah",
                            "admintime": "Pagi: 06.00"
                        }
                    ]
                },
                {
                    "no_register": "2301180002",
                    "id_pasien": "00000093",
                    "id_pendaftaran": 167,
                    "id_layanan_pendaftaran": 200,
                    "id_resep": 74,
                    "status_obat_pulang": "",
                    "resep": [
                        {
                            "r_no": 1,
                            "nama_obat": "DEKOLGEN ( TESTING ) 100 mg Tablet <i>DEKOLGEN INDONESIA</i>",
                            "qty": 1,
                            "nama_satuan": "Tablet",
                            "kekuatan": 5,
                            "nama_kekuatan": "mg",
                            "aturan_pakai": "3dd1",
                            "ket_aturan_pakai": "3 x sehari 1 Tablet ",
                            "timing": "Sesudah",
                            "admintime": "Pagi: 06.00"
                        }
                    ]
                },
                {
                    "no_register": "2301180002",
                    "id_pasien": "00000093",
                    "id_pendaftaran": 167,
                    "id_layanan_pendaftaran": 200,
                    "id_resep": 78,
                    "status_obat_pulang": "Ya",
                    "resep": [
                        {
                            "r_no": 1,
                            "nama_obat": "AMLODIPIN ( TESTING ) 5 mg Tablet <i>ABBOT INDONESIA, PT </i>",
                            "qty": 1,
                            "nama_satuan": "Tablet",
                            "kekuatan": 5,
                            "nama_kekuatan": "mg",
                            "aturan_pakai": "1dd1",
                            "ket_aturan_pakai": "1 x sehari 1 Tablet ",
                            "timing": "Sesudah",
                            "admintime": "Pagi: 06.00"
                        }
                    ]
                }
            ],
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
            "vital_sign_data": {
                "no_register": "2303190004",
                "id_pasien": "00014882",
                "id_pendaftaran": 27070,
                "id_layanan_pendaftaran": 49976,
                "jenis_igd": "Umum",
                "alergi": "tidak ada",
                "tinggi_badan": 175,
                "berat_badan": 70,
                "buta_warna": "Tidak",
                "tensi":
                {
                    "sistole": 140,
                    "diastole": 77
                },
                "nadi": 98,
                "suhu": 36,
                "nafas": 24,
                "anamnesis": "sesak, pusing mata kunang2 sejak 1 jam smrs",
                "anamnesis_lalu": "mabok",
                "keluhan_utama": "sesak nafas, badan kaku2 linu2, nyeri ulu hati, pusing., mata berkunang2",
                "pemeriksaan_fisik": "k\/l dbn pulmo sdv +\/+",
                "plan": "pake nanya",
                "instansi_perujuk": "Pribadi",
                "assesmen_igd":
                {
                    "disability_keadaan_umum": "Baik",
                    "gcs_e": "4",
                    "gcs_v": "5",
                    "gcs_m": "6",
                    "disability_kesadaran": "Compos Mentis",
                    "refleks_cahaya": "\/",
                    "pulang_pukul": "",
                    "pulang_gcs_e": "",
                    "pulang_gcs_v": "",
                    "pulang_gcs_m": "",
                    "pulang_nadi": 0,
                    "pulang_nafas": 0,
                    "pulang_tensi":
                    {
                        "sistole": 0,
                        "diastole": 0
                    },
                    "pulang_suhu": 0,
                    "pulang_spo2": 0,
                    "transportasi_pulang": "",
                    "pendidikan_pasien": ""
                }
            },
            "px_data": {
                "no_rm": "RM0923812",
                "nama": "DUYUNG BIN PENYOT",
                "kelamin": "L",
                "tanggal_lahir": "1975-05-09",
                "alamat": "Jl. Hilang Di Telan Bumi",
                "tempat_lahir": "-",
                "agama": "",
                "status_perkawinan": "",
                "no_identitas": "",
                "kelurahan": "",
                "kecamatan": "",
                "kabupaten": "",
                "provinsi": "",
                "telp": "",
                "nama_ibu": "",
                "nama_ayah": ""
            },
            "patient_info_data": {
                "no_register": "2212070001",
                "id_pasien": "00000003",
                "id_pendaftaran": 10,
                "id_layanan_pendaftaran": 13,
                "waktu_daftar": "2022-12-07 09:55:17",
                "waktu_keluar": "2022-11-17 14:41:51",
                "jenis": "Poliklinik",
                "nama_pjwb": "",
                "telp_pjwb": "",
                "alamat_pjwb": "",
                "nama_ayah": "ANDI NUGROHO",
                "nama_ibu": "ANI PUTRI SETYAWATI",
                "nama_pjwb_finansial": "JOKO"
            },
            "diagnosa_data": [
                {
                    "no_register": "2212120001",
                    "id_pasien": "00000006",
                    "id_pendaftaran": 11,
                    "id_layanan_pendaftaran": 16,
                    "id_dokter": 37,
                    "nama_dokter": "dr. Efraim Petrick",
                    "id_spesialis": 2,
                    "nama_spesialis": "Umum",
                    "id_profesi": 1,
                    "nama_profesi": "Dokter",
                    "id_sebab_sakit": 20,
                    "kode_sebab_sakit": "A038",
                    "nama_sebab_sakit": "Other shigellosis",
                    "icd_x": "A03.8",
                    "deskripsi": "",
                    "kasus": "Baru",
                    "post": "Diagnosa Akhir",
                    "primer": "Primer"
                },
                {
                    "no_register": "2212120001",
                    "id_pasien": "00000006",
                    "id_pendaftaran": 11,
                    "id_layanan_pendaftaran": 16,
                    "id_dokter": 37,
                    "nama_dokter": "dr. Efraim Petrick",
                    "id_spesialis": 2,
                    "nama_spesialis": "Umum",
                    "id_profesi": 1,
                    "nama_profesi": "Dokter",
                    "id_sebab_sakit": 3,
                    "kode_sebab_sakit": "A000",
                    "nama_sebab_sakit": "Cholera due to Vibrio cholerae 01, biovar cholerae",
                    "icd_x": "A00.0",
                    "deskripsi": "",
                    "kasus": "Lama",
                    "post": "Diagnosa Akhir",
                    "primer": "Sekunder"
                }
            ],
            "dokter_dpjp_data": {
                "no_register": "2212120001",
                "id_pasien": "00000006",
                "id_pendaftaran": 11,
                "id_layanan_pendaftaran": 16,
                "id_dokter_dpjp": 37,
                "nama_dokter_dpjp": "dr. Efraim Petrick",
                "id_spesialis": 2,
                "nama_spesialis": "Umum",
                "id_profesi": 1,
                "nama_profesi": "Dokter"
            },
            "tindakan_data": [
                {
                    "no_register": "2504280022",
                    "id_pasien": "106560",
                    "id_pendaftaran": 152,
                    "id_layanan_pendaftaran": 437,
                    "jenis": "Rawat Inap",
                    "nama_layanan": "Jasa Perawatan",
                    "qty": 1,
                    "tanggal": "2025-04-28",
                    "jam": "16:15:15",
                    "user": "Isnan",
                    "icd_9_code": "",
                    "icd_9_name": ""
                },
                {
                    "no_register": "2504280022",
                    "id_pasien": "106560",
                    "id_pendaftaran": 152,
                    "id_layanan_pendaftaran": 437,
                    "jenis": "Rawat Inap",
                    "nama_layanan": "Askep",
                    "qty": 1,
                    "tanggal": "2025-04-28",
                    "jam": "18:46:13",
                    "user": "Isnan",
                    "icd_9_code": "",
                    "icd_9_name": ""
                },
                {
                    "no_register": "2504280022",
                    "id_pasien": "106560",
                    "id_pendaftaran": 152,
                    "id_layanan_pendaftaran": 437,
                    "jenis": "Rawat Inap",
                    "nama_layanan": "Pasang Infus (RI, D5, Asering)",
                    "qty": 1,
                    "tanggal": "2025-04-29",
                    "jam": "08:45:04",
                    "user": "Rohani",
                    "icd_9_code": "",
                    "icd_9_name": ""
                },
                {
                    "no_register": "2504280022",
                    "id_pasien": "106560",
                    "id_pendaftaran": 152,
                    "id_layanan_pendaftaran": 437,
                    "jenis": "Rawat Inap",
                    "nama_layanan": "Visite Dokter Spesialis",
                    "qty": 1,
                    "tanggal": "2025-04-29",
                    "jam": "08:45:35",
                    "user": "Rohani",
                    "icd_9_code": "",
                    "icd_9_name": ""
                }
            ]
        },
        "digital_signature": {
            "ttd_dokter": "",
            "ttd_perawat": ""
        }
    },
    "default": {
        "indexExpandTindakanUtama": [],
        "ttd_data": {
            "kota": "Sleman",
            "tanggal": "",
            "tanggal_indo": "",
            "jam": "",
            "perawat": "",
            "perawat_stroke": "",
            "dokter": "",
            "dokter_stroke": ""
        },
        "pasien": {
            "nama": "",
            "no_rm": "",
            "tanggal_lahir": "",
            "tanggal_lahir_indo": "",
            "kelamin": "",
            "kelas": "",
            "nik": ""
        },
        "anamnesa": "",
        "pemeriksaan_fisik": {
            "ttv": {
                "tensi": {
                    "sistole": 0,
                    "diastole": 0
                },
                "nadi": 0,
                "nafas": 0,
                "suhu": 0,
                "bb": 0,
                "tb": 0
            },
            "keterangan": ""
        },
        "list_diagnosa": [],
        "diagnosa_freetext": "",
        "tindakan": [],
        "tindakan_freetext": "",
        "terapi": "",
        "ttd": {
            "tanggal_ttd_dokter": "",
            "tanggal_ttd_dokter_indo": "",
            "jam_ttd_dokter": "",
            "dokter_ttd": "",
            "tanggal_ttd_perawat": "",
            "tanggal_ttd_perawat_indo": "",
            "jam_ttd_perawat": "",
            "perawat_ttd": ""
        }
    }
}