const data = {
    "sample": {
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
            "tanggal": "",
            "tanggal_indo": "",
            "jam": "",
            "perawat": "",
            "perawat_stroke": "",
            "dokter": "",
            "dokter_stroke": "",
            "dokter_jaga": "",
            "dokter_jaga_stroke": "",
            "dokter_pj": "",
            "dokter_pj_stroke": ""
        },
        "tanggal_datang": "",
        "tanggal_datang_indo": "",
        "waktu_pemeriksaan": "",
        "status_kawin": "",
        "suku_bangsa": "",
        "penerjemah": {
            "bahasa": "",
            "bahasa_apa": ""
        },
        "kendala_komunikasi": "",
        "alat_bantu": "",
        "rujukan": {
            "rujukan_dari": "",
            "rujukan_dari_lainnya": ""
        },
        "status_pembiayaan": "",
        "keluarga": {
            "hubungan_pasien": {
                "hubungan": "",
                "hubungan_lainnya": ""
            },
            "nama": "",
            "pekerjaan": "",
            "alamat": "",
            "no_hp": ""
        },
        "pembayaran": {
            "hubungan": "",
            "nama": "",
            "pekerjaan": "",
            "alamat": "",
            "no_hp": ""
        },
        "rawat_inap": {
            "inap_ke": "",
            "inap_ke_lainnya": "",
            "rawat_terakhir_tanggal": "",
            "rawat_terakhir_tanggal_indo": ""
        },
        "masuk_tanggal": "",
        "masuk_tanggal_indo": "",
        "waktu_masuk": "",
        "keluar_tanggal": "",
        "keluar_tanggal_indo": "",
        "waktu_keluar": "",
        "lama_rawat": "",
        "ruang_rawat": {
            "bangsal": "",
            "ruang": "",
            "kelas": ""
        },
        "pelayanan": {
            "prioritas": "",
            "jenis": "",
            "staf": ""
        },
        "izin_keluar_rs": "",
        "diagnosa_banding_group": "",
        "diagnosa_banding_freetext": "",
        "diagnosa_banding_autocomplete": [
            {
                "icd_x": "",
                "nama_sebab_sakit": ""
            }
        ],
        "diagnosa_masuk_group": "",
        "diagnosa_masuk_freetext": "",
        "diagnosa_masuk_autocomplete": [
            {
                "icd_x": "",
                "nama_sebab_sakit": ""
            }
        ],
        "diagnosa_sekunder_group": "",
        "diagnosa_sekunder_freetext": "",
        "diagnosa_sekunder_autocomplete": [
            {
                "icd_x": "",
                "nama_sebab_sakit": ""
            }
        ],
        "komplikasi": "",
        "penyebab_ruda": "",
        "morfologi": "",
        "catatan": "",
        "infeksi": "",
        "penyebab_infeksi": "",
        "riwayat_imunisasi_text": "",
        "riwayat_imunisasi": "",
        "keadaan_keluar": "",
        "tindakan_group": "",
        "tindakan_freetext": "",
        "tindakan_list": [],
        "external_link": {
            "tindakan_data_list": [
                {
                    "no_register": "2511080003",
                    "id_pasien": "00007659",
                    "id_pendaftaran": 145126,
                    "id_layanan_pendaftaran": 158740,
                    "jenis": "IGD",
                    "tanggal": "2025-11-08",
                    "jam": "06:06:05",
                    "layanan": [
                        {
                            "id_tarif_tindakan": 655606,
                            "nama_layanan": "Tindakan Perawatan IGD",
                            "code_icd_9": "",
                            "description_icd_9": "",
                            "qty": 1
                        },
                        {
                            "id_tarif_tindakan": 655617,
                            "nama_layanan": "Tindakan Pasang Infus / Aff Infus",
                            "code_icd_9": "99.18",
                            "description_icd_9": "Injection or infusion of electrolytes",
                            "qty": 1
                        },
                        {
                            "id_tarif_tindakan": 655618,
                            "nama_layanan": "Observasi 2 s/d 4 jam",
                            "code_icd_9": "",
                            "description_icd_9": "",
                            "qty": 1
                        }
                    ]
                },
                {
                    "no_register": "2511080003",
                    "id_pasien": "00007659",
                    "id_pendaftaran": 145126,
                    "id_layanan_pendaftaran": 158761,
                    "jenis": "Rawat Inap",
                    "tanggal": "2025-11-08",
                    "jam": "09:03:22",
                    "layanan": [
                        {
                            "id_tarif_tindakan": 655694,
                            "nama_layanan": "Tindakan Perawat (VT, Injeksi, dll)",
                            "code_icd_9": "",
                            "description_icd_9": "",
                            "qty": 1
                        },
                        {
                            "id_tarif_tindakan": 655695,
                            "nama_layanan": "Jasa Keperawatan",
                            "code_icd_9": "",
                            "description_icd_9": "",
                            "qty": 1
                        }
                    ]
                },
                {
                    "no_register": "2511080003",
                    "id_pasien": "00007659",
                    "id_pendaftaran": 145126,
                    "id_layanan_pendaftaran": 158774,
                    "jenis": "Rawat Inap",
                    "tanggal": "2025-11-08",
                    "jam": "12:05:55",
                    "layanan": [
                        {
                            "id_tarif_tindakan": 655726,
                            "nama_layanan": "Rujuk RO-Thorax AP Rawat Inap - RSMB",
                            "code_icd_9": "",
                            "description_icd_9": "",
                            "qty": 1
                        },
                        {
                            "id_tarif_tindakan": 655917,
                            "nama_layanan": "Makan Persaji",
                            "code_icd_9": "",
                            "description_icd_9": "",
                            "qty": 2
                        },
                        {
                            "id_tarif_tindakan": 655918,
                            "nama_layanan": "Makan Persaji",
                            "code_icd_9": "",
                            "description_icd_9": "",
                            "qty": 2
                        },
                        {
                            "id_tarif_tindakan": 655961,
                            "nama_layanan": "Tindakan Perawat (VT, Injeksi, dll)",
                            "code_icd_9": "",
                            "description_icd_9": "",
                            "qty": 1
                        },
                        {
                            "id_tarif_tindakan": 655962,
                            "nama_layanan": "Jasa Keperawatan",
                            "code_icd_9": "",
                            "description_icd_9": "",
                            "qty": 1
                        },
                        {
                            "id_tarif_tindakan": 656036,
                            "nama_layanan": "Makan Persaji",
                            "code_icd_9": "",
                            "description_icd_9": "",
                            "qty": 1
                        },
                        {
                            "id_tarif_tindakan": 656272,
                            "nama_layanan": "Tindakan Perawat (VT, Injeksi, dll)",
                            "code_icd_9": "",
                            "description_icd_9": "",
                            "qty": 1
                        },
                        {
                            "id_tarif_tindakan": 656273,
                            "nama_layanan": "Jasa Keperawatan",
                            "code_icd_9": "",
                            "description_icd_9": "",
                            "qty": 1
                        },
                        {
                            "id_tarif_tindakan": 656327,
                            "nama_layanan": "Makan Persaji",
                            "code_icd_9": "",
                            "description_icd_9": "",
                            "qty": 2
                        },
                        {
                            "id_tarif_tindakan": 656489,
                            "nama_layanan": "Makan Persaji",
                            "code_icd_9": "",
                            "description_icd_9": "",
                            "qty": 1
                        },
                        {
                            "id_tarif_tindakan": 656527,
                            "nama_layanan": "Dressing Infus Ringan",
                            "code_icd_9": "",
                            "description_icd_9": "",
                            "qty": 1
                        },
                        {
                            "id_tarif_tindakan": 656605,
                            "nama_layanan": "Nebulizer/Inhalasi Dewasa /Anak",
                            "code_icd_9": "93.94",
                            "description_icd_9": "Respiratory medication administered by nebulizer",
                            "qty": 1
                        },
                        {
                            "id_tarif_tindakan": 656606,
                            "nama_layanan": "Nebulizer/Inhalasi Dewasa /Anak",
                            "code_icd_9": "93.94",
                            "description_icd_9": "Respiratory medication administered by nebulizer",
                            "qty": 1
                        },
                        {
                            "id_tarif_tindakan": 656709,
                            "nama_layanan": "Tindakan Perawat (VT, Injeksi, dll)",
                            "code_icd_9": "",
                            "description_icd_9": "",
                            "qty": 1
                        },
                        {
                            "id_tarif_tindakan": 656710,
                            "nama_layanan": "Jasa Keperawatan",
                            "code_icd_9": "",
                            "description_icd_9": "",
                            "qty": 1
                        },
                        {
                            "id_tarif_tindakan": 656741,
                            "nama_layanan": "Makan Persaji",
                            "code_icd_9": "",
                            "description_icd_9": "",
                            "qty": 2
                        },
                        {
                            "id_tarif_tindakan": 656759,
                            "nama_layanan": "Nebulizer/Inhalasi Dewasa /Anak",
                            "code_icd_9": "93.94",
                            "description_icd_9": "Respiratory medication administered by nebulizer",
                            "qty": 1
                        },
                        {
                            "id_tarif_tindakan": 656823,
                            "nama_layanan": "Makan Persaji",
                            "code_icd_9": "",
                            "description_icd_9": "",
                            "qty": 1
                        }
                    ]
                }
            ],
            "px_data": {
                "no_rm": "",
                "nama": "",
                "kelamin": "",
                "tanggal_lahir": "",
                "alamat": "",
                "tempat_lahir": "",
                "pekerjaan": "",
                "agama": "",
                "pendidikan": "",
                "status_perkawinan": "",
                "no_identitas": "",
                "kelurahan": "",
                "kecamatan": "",
                "kabupaten": "",
                "provinsi": "",
                "telp": "",
                "email": "",
                "nama_ibu": "",
                "nama_ayah": "",
                "gol_darah": ""
            },
            "inpatient_information": {
                "no_register": "",
                "id_pasien": "",
                "id_pendaftaran": "",
                "id_layanan_pendaftaran": "",
                "id_bangsal": "",
                "nama_bangsal": "",
                "id_kelas": "",
                "nama_kelas": "",
                "no_ruang": "",
                "nomor_bed": "",
                "titipan": "",
                "id_bangsal_titipan": "",
                "nama_bangsal_titipan": "",
                "id_kelas_titipan": "",
                "nama_kelas_titipan": "",
                "waktu_masuk": "",
                "waktu_keluar": ""
            },
            "dokter_dpjp_data": {
                "no_register": "",
                "id_pasien": "",
                "id_pendaftaran": "",
                "id_layanan_pendaftaran": "",
                "id_dokter_dpjp": "",
                "nama_dokter_dpjp": "",
                "id_spesialis": "",
                "nama_spesialis": "",
                "id_profesi": "",
                "nama_profesi": "",
                "ttd_image": ""
            },
            "diagnosa_list": [
                {
                    "no_register": "",
                    "id_pasien": "",
                    "id_pendaftaran": "",
                    "id_layanan_pendaftaran": "",
                    "jenis": "",
                    "tanggal": "",
                    "jam": "",
                    "layanan": [
                        {
                            "id_diagnosa": "",
                            "id_dokter": "",
                            "nama_dokter": "",
                            "id_spesialis": "",
                            "nama_spesialis": "",
                            "id_profesi": "",
                            "nama_profesi": "",
                            "id_sebab_sakit": "",
                            "kode_sebab_sakit": "",
                            "nama_sebab_sakit": "",
                            "icd_x": "",
                            "deskripsi": "",
                            "kasus": "",
                            "post": "",
                            "primer": ""
                        }
                    ]
                }
            ],
            "tindakan_data": [
                {
                    "no_register": "",
                    "id_pasien": "",
                    "id_pendaftaran": "",
                    "id_layanan_pendaftaran": "",
                    "nama_layanan": "",
                    "qty": ""
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
            "tanggal": "",
            "tanggal_indo": "",
            "jam": "",
            "perawat": "",
            "perawat_stroke": "",
            "dokter": "",
            "dokter_stroke": "",
            "dokter_jaga": "",
            "dokter_jaga_stroke": "",
            "dokter_pj": "",
            "dokter_pj_stroke": ""
        },
        "tanggal_datang": "",
        "tanggal_datang_indo": "",
        "waktu_pemeriksaan": "",
        "status_kawin": "",
        "suku_bangsa": "",
        "penerjemah": {
            "bahasa": "",
            "bahasa_apa": ""
        },
        "kendala_komunikasi": "",
        "alat_bantu": ""
    },
    "rujukan": {
        "rujukan_dari": "",
        "rujukan_dari_lainnya": ""
    },
    "status_pembiayaan": "",
    "keluarga": {
        "hubungan_pasien": {
            "hubungan": "",
            "hubungan_lainnya": ""
        },
        "nama": "",
        "pekerjaan": "",
        "alamat": "",
        "no_hp": ""
    },
    "pembayaran": {
        "hubungan": "",
        "nama": "",
        "pekerjaan": "",
        "alamat": "",
        "no_hp": ""
    },
    "rawat_inap": {
        "inap_ke": "",
        "inap_ke_lainnya": "",
        "rawat_terakhir_tanggal": "",
        "rawat_terakhir_tanggal_indo": ""
    },
    "masuk_tanggal": "",
    "masuk_tanggal_indo": "",
    "waktu_masuk": "",
    "keluar_tanggal": "",
    "keluar_tanggal_indo": "",
    "waktu_keluar": "",
    "lama_rawat": "",
    "ruang_rawat": {
        "bangsal": "",
        "ruang": "",
        "kelas": ""
    },
    "pelayanan": {
        "prioritas": "",
        "jenis": "",
        "staf": ""
    },
    "izin_keluar_rs": "",
    "diagnosa_banding_group": "",
    "diagnosa_banding_freetext": "",
    "diagnosa_banding_autocomplete": [],
    "diagnosa_masuk_group": "",
    "diagnosa_masuk_freetext": "",
    "diagnosa_masuk_autocomplete": [],
    "diagnosa_sekunder_group": "",
    "diagnosa_sekunder_freetext": "",
    "diagnosa_sekunder_autocomplete": [],
    "komplikasi": "",
    "penyebab_ruda": "",
    "morfologi": "",
    "catatan": "",
    "tindakan_group": "",
    "tindakan_freetext": "",
    "tindakan_list": [],
    "infeksi": "",
    "penyebab_infeksi": "",
    "riwayat_imunisasi_text": "",
    "riwayat_imunisasi": "",
    "keadaan_keluar": ""
}