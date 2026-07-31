const data = {
    "sample": {
        "pasien": {
            "nama": "Garga",
            "no_rm": "876754",
            "tanggal_lahir": "2000-08-08",
            "alamat": "Sleman"
        },
        "ttd_data": {
            "kota": "Labuhanhaji",
            "tanggal": "2000-08-08",
            "jam": "20:00",
            "perawat_pengantar": "Siti",
            "perawat_pengantar_stroke": "",
            "perawat_penerima": "Budi",
            "perawat_penerima_stroke": ""
        },
        "informasi_operasi": {
            "tanggal": "2023-10-10",
            "jam": "10:00",
            "dokter_operator": "Dr. A",
            "dokter_operator_1": "Dr. B",
            "dokter_anestesi": "Dr. C",
            "dokter_pendamping": "Dr. D",
            "tindakan": "Operasi Apendisitis",
            "lokasi_tindakan": "Ruang OK 1"
        },
        "persiapan_menjelang_operasi": {
            "infus": {
                "ri_rj": true,
                "ok": true,
                "tts_mnt": "20"
            },
            "pasang_dc": {
                "ri_rj": true,
                "ok": true
            },
            "kosongkan_vu": {
                "ri_rj": true,
                "ok": false
            },
            "cukur": {
                "ri_rj": true,
                "ok": true,
                "detail": "ketiak"
            },
            "lavement": {
                "ri_rj": true,
                "ok": false,
                "pukul": "08:00"
            },
            "puasa": {
                "ri_rj": true,
                "ok": true,
                "jam_sebelum_op": "8"
            },
            "pakai_baju_operasi": {
                "ri_rj": true,
                "ok": true
            },
            "potong_kuku": {
                "ri_rj": true,
                "ok": true
            },
            "lepas_gigi_palsu": {
                "ri_rj": false,
                "ok": false
            },
            "lepas_lensa_kontak": {
                "ri_rj": false,
                "ok": false
            },
            "lepas_perhiasan": {
                "ri_rj": true,
                "ok": true,
                "detail": "Cincin"
            },
            "hapus_makeup": {
                "ri_rj": true,
                "ok": true
            },
            "status_pasien": {
                "ri_rj": true,
                "ok": true
            },
            "ekg": {
                "ri_rj": true,
                "ok": true
            },
            "ro_usg_ctscan": {
                "ri_rj": true,
                "ok": false
            },
            "lembar_konsultasi": {
                "ri_rj": true,
                "ok": true
            },
            "informed_consent_bedah": {
                "ri_rj": true,
                "ok": true
            },
            "informed_consent_anestesi": {
                "ri_rj": true,
                "ok": true
            },
            "darah_transfusi": {
                "ri_rj": true,
                "ok": true,
                "colf": "2",
                "jenis": "PRC"
            },
            "obat": {
                "ri_rj": true,
                "ok": true,
                "detail": "Antibiotik"
            },
            "donor": {
                "ri_rj": true,
                "ok": false,
                "orang": "2"
            },
            "pmi": {
                "ri_rj": false,
                "ok": false,
                "colf": "",
                "jenis": ""
            },
            "penyimpanan": {
                "ri_rj": true,
                "ok": true,
                "detail": "Bank Darah"
            }
        },
        "penandaan_lokasi_operasi": {
            "ya": true,
            "tidak_diperlukan": false
        },
        "anamnesis": {
            "riwayat_penyakit_dahulu": {
                "alergi_obat": true,
                "alergi_makanan": false,
                "penyakit_jantung": false,
                "hipertensi": true,
                "asma": false,
                "ppok": false,
                "penyakit_ginjal": false,
                "penyakit_hati": false
            },
            "riwayat_pengobatan": "Amlodipin 5mg",
            "riwayat_operasi_terdahulu": "Pernah",
            "komplikasi": "Tidak Ada Komplikasi",
            "riwayat_penggunaan_bahan": {
                "obat_penenang": false,
                "merokok": true,
                "alkohol": false
            }
        },
        "pemeriksaan_fisik": {
            "tensi_sistole": 120.0,
            "tensi_diastole": 0.0,
            "frek_nadi": 0.0,
            "frek_nafas": 0.0,
            "suhu": 0.0,
            "bb": 0.0,
            "tb": 0.0
        },
        "pemeriksaan_penunjang": {
            "hb": "13",
            "pt": "12",
            "al": "8000",
            "appt": "30",
            "at": "250000",
            "gds": "110",
            "gol": "O",
            "hbsag": "Negatif"
        },
        "catatan": "Pasien tampak cemas",
        "resep_freetext": "",
        "external_link": {
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
            "prescription_data_list": [
                {
                    "no_register": "2502140133",
                    "id_pasien": "040540",
                    "id_pendaftaran": 69568,
                    "id_layanan_pendaftaran": 82235,
                    "id_resep": 44718,
                    "id_resep_tebus": "18252",
                    "status_obat_pulang": "",
                    "status_approval": "Disetujui",
                    "waktu_resep": "2025-11-08 09:19:00",
                    "waktu_resep_approval": "2025-11-08 09:44:55",
                    "telaah_resep": null,
                    "telaah_obat": null,
                    "status_farmasi": "Disetujui",
                    "order_resep": [
                        {
                            "r_no": 1,
                            "nama_pendek": "Paracetamol 500 mg Tablet",
                            "nama_obat": "Paracetamol 500 mg Tablet 500 mg Tablet \u003Ci\u003EPT. Kimia Farma\u003C/i\u003E",
                            "qty": 1,
                            "nama_satuan": "Tablet",
                            "kekuatan": 500,
                            "nama_kekuatan": "mg",
                            "aturan_pakai": "-",
                            "ket_aturan_pakai": "-",
                            "timing": "Sesudah",
                            "admintime": "",
                            "kronis": "0",
                            "id_kategori": "1",
                            "nama_kategori_barang": "Obat",
                            "high_alert": "Tidak"
                        }
                    ],
                    "resep": [
                        {
                            "id_penjualan": 18397,
                            "r_no": 1,
                            "nama_pendek": "Paracetamol 500 mg Tablet",
                            "nama_obat": "Paracetamol 500 mg Tablet 500 mg Tablet \u003Ci\u003EPT. Kimia Farma\u003C/i\u003E",
                            "qty": 15,
                            "nama_satuan": "Tablet",
                            "kekuatan": 500,
                            "nama_kekuatan": "mg",
                            "aturan_pakai": "3dd1tab",
                            "ket_aturan_pakai": "3 x sehari 1 Tablet",
                            "timing": "Sesudah",
                            "admintime": "Pagi: 06.00, Siang: 14.00, Malam: 22.00",
                            "kronis": "0",
                            "id_kategori": "1",
                            "nama_kategori_barang": "Obat",
                            "high_alert": "Tidak"
                        },
                        {
                            "id_penjualan": 18397,
                            "r_no": 1,
                            "nama_pendek": "Paracetamol 500 mg Tablet",
                            "nama_obat": "Paracetamol 500 mg Tablet 500 mg Tablet \u003Ci\u003EPT. Kimia Farma\u003C/i\u003E",
                            "qty": 15,
                            "nama_satuan": "Tablet",
                            "kekuatan": 500,
                            "nama_kekuatan": "mg",
                            "aturan_pakai": "3dd1tab",
                            "ket_aturan_pakai": "3 x sehari 1 Tablet",
                            "timing": "Sesudah",
                            "admintime": "Pagi: 06.00, Siang: 14.00, Malam: 22.00",
                            "kronis": "0",
                            "id_kategori": "1",
                            "nama_kategori_barang": "Obat",
                            "high_alert": "Tidak"
                        }
                    ]
                },
                {
                    "no_register": "2502140133",
                    "id_pasien": "040540",
                    "id_pendaftaran": 69568,
                    "id_layanan_pendaftaran": 82235,
                    "id_resep": 44984,
                    "id_resep_tebus": "",
                    "status_obat_pulang": "",
                    "status_approval": "Disetujui",
                    "waktu_resep": "2025-11-08 21:59:00",
                    "waktu_resep_approval": "2025-11-08 22:05:18",
                    "telaah_resep": null,
                    "telaah_obat": null,
                    "status_farmasi": "Menunggu Konfirmasi",
                    "order_resep": [
                        {
                            "r_no": 1,
                            "nama_pendek": "Paracetamol 500 mg Tablet",
                            "nama_obat": "Paracetamol 500 mg Tablet 500 mg Tablet \u003Ci\u003EPT. Kimia Farma\u003C/i\u003E",
                            "qty": 1,
                            "nama_satuan": "Tablet",
                            "kekuatan": 500,
                            "nama_kekuatan": "mg",
                            "aturan_pakai": "3dd1/2tab",
                            "ket_aturan_pakai": "3 x sehari 1/2 tablet",
                            "timing": "Sesudah",
                            "admintime": "Pagi: 06.00, Siang: 14.00, Malam: 22.00",
                            "kronis": "0",
                            "id_kategori": "1",
                            "nama_kategori_barang": "Obat",
                            "high_alert": "Tidak"
                        }
                    ],
                    "resep": []
                }
            ],
            "vital_sign_data_list": [
                {
                    "no_register": "2202230010",
                    "id_pasien": "00206957",
                    "id_pendaftaran": "10",
                    "id_layanan_pendaftaran": "11",
                    "jenis_layanan": "IGD",
                    "jenis_igd": "Umum",
                    "alergi": "asdf",
                    "nama": "M ZAIDAN AQMAL AN",
                    "tanggal_lahir": "2019-11-27",
                    "tinggi_badan": "",
                    "berat_badan": "123",
                    "buta_warna": "",
                    "instansi_perujuk": "Pribadi",
                    "layanan": [
                        {
                            "id_layanan_pendaftaran": 11,
                            "dokter": "dr. RM. Lasmana R. Dj.",
                            "id_dokter": "000184",
                            "jenis_layanan": "IGD",
                            "jenis_igd": "Umum",
                            "waktu_visitasi": "2022-02-23 10:28:21",
                            "tensi": {
                                "sistole": 0,
                                "diastole": 0
                            },
                            "nadi": 178,
                            "suhu": 38,
                            "nafas": 60,
                            "anamnesis": "demam sejak 5 hari sebelum masuk RS, keluhan disertai pusing cekot-cekot, mual+, muntah-, nyeri ulu hati+, badan linu+, lemas+, mimisan-, gusi berdarah-, batuk+",
                            "riwayat_penyakit_keluarga": "",
                            "anamnesis_lalu": "",
                            "keluhan_utama": "demam",
                            "keluhan_utama_perawat": "SAKIT BIASA AJA",
                            "pemeriksaan_fisik": "mata: ca-/-, si-/-\nmulut: faring hiperemis+\nthorax: sdv+/+, rh-/-, wh-/-\nabd: bu+, NT+ epigastrium\neks; ad-/-",
                            "pemeriksaan_penunjang": "",
                            "diagnosis": "",
                            "plan": "rawat inap\ninf RL 20tpm\ninj PCT 1gram\ninj ranitidin 1amp\ninj ondancetron 4mg",
                            "spo2": "92",
                            "id_pendaftaran": 0,
                            "tinggi_badan": 0,
                            "berat_badan": 0
                        }
                    ],
                    "assesmen_igd": {
                        "disability_keadaan_umum": "Tampak sakit berat, pasien tidak responsif terhadap panggilan",
                        "gcs_e": "3",
                        "gcs_v": "2",
                        "gcs_m": "1",
                        "skala_nyeri": 7,
                        "wajah": 2,
                        "kaki": 2,
                        "aktivitas": 1,
                        "menangis": 1,
                        "bersuara": 1,
                        "disability_kesadaran": "Somnolen",
                        "refleks_cahaya": "+/+",
                        "pulang_pukul": "14:30",
                        "pulang_gcs_e": "4",
                        "pulang_gcs_v": "4",
                        "pulang_gcs_m": "5",
                        "pulang_nadi": 88,
                        "pulang_nafas": 20,
                        "pulang_tensi": {
                            "sistole": 120,
                            "diastole": 80
                        },
                        "pulang_suhu": 36.8,
                        "pulang_spo2": 99,
                        "transportasi_pulang": "Kursi roda didampingi keluarga",
                        "pendidikan_pasien": "Edukasi tanda bahaya seperti penurunan kesadaran, muntah berulang, dan sesak napas",
                        "mke": "Cedera kepala ringan dengan penurunan kesadaran sementara",
                        "mke_assesment": "Pasien datang dengan riwayat trauma kepala. GCS awal 6, kondisi membaik setelah observasi dan terapi suportif.",
                        "mke_objective": "Tekanan darah 130/85 mmHg, nadi 92x/menit, RR 22x/menit, SpO2 98%. Pupil isokor dengan refleks cahaya positif.",
                        "mke_plan": "Observasi neurologis, pemberian analgesik, edukasi keluarga, kontrol ulang bila ada perburukan.",
                        "mke_subjective": "Keluarga mengatakan pasien sempat tidak sadar setelah terjatuh.",
                        "triase": "Kuning (Urgent)",
                        "data_tindakan_kolaboratif": [
                            {
                                "tindakan": "Pemasangan infus RL",
                                "pelaksana": "Perawat IGD",
                                "keterangan": "Untuk terapi cairan"
                            },
                            {
                                "tindakan": "CT Scan Kepala",
                                "pelaksana": "Dokter Spesialis Radiologi",
                                "keterangan": "Evaluasi kemungkinan perdarahan intrakranial"
                            }
                        ],
                        "spo2": 98
                    }
                },
                {
                    "no_register": "2202230010",
                    "id_pasien": "00206957",
                    "id_pendaftaran": "10",
                    "id_layanan_pendaftaran": "154",
                    "jenis_layanan": "Rawat Inap",
                    "jenis_igd": "Umum",
                    "alergi": "asdf",
                    "nama": "M ZAIDAN AQMAL AN",
                    "tanggal_lahir": "2019-11-27",
                    "tinggi_badan": "",
                    "berat_badan": "0",
                    "buta_warna": "",
                    "instansi_perujuk": "Pribadi",
                    "layanan": [
                        {
                            "id_layanan_pendaftaran": 154,
                            "dokter": "Reizkiana Feva K.D. dr.Hj.,SpA",
                            "id_dokter": "000177",
                            "jenis_layanan": "Rawat Inap",
                            "jenis_igd": "Umum",
                            "waktu_visitasi": "2022-03-01 09:24:55",
                            "tensi": {
                                "sistole": 0,
                                "diastole": 0
                            },
                            "gcs": {
                                "e": 7,
                                "v": 8,
                                "m": 9,
                                "total": 24
                            },
                            "nadi": 0,
                            "suhu": 0,
                            "nafas": 0,
                            "anamnesis": "",
                            "riwayat_penyakit_keluarga": "",
                            "anamnesis_lalu": "",
                            "keluhan_utama": "",
                            "keluhan_utama_perawat": "",
                            "pemeriksaan_fisik": "",
                            "pemeriksaan_penunjang": "",
                            "diagnosis": "",
                            "plan": "",
                            "spo2": "",
                            "id_pendaftaran": 0,
                            "tinggi_badan": 0,
                            "berat_badan": 0
                        }
                    ],
                    "assesmen_igd": []
                },
                {
                    "no_register": "2202230010",
                    "id_pasien": "00206957",
                    "id_pendaftaran": "10",
                    "id_layanan_pendaftaran": "1652",
                    "jenis_layanan": "Rawat Inap",
                    "jenis_igd": "Umum",
                    "alergi": "asdf",
                    "nama": "M ZAIDAN AQMAL AN",
                    "tanggal_lahir": "2019-11-27",
                    "tinggi_badan": "",
                    "berat_badan": "0",
                    "buta_warna": "",
                    "instansi_perujuk": "Pribadi",
                    "layanan": [
                        {
                            "id_layanan_pendaftaran": 154,
                            "dokter": "Reizkiana Feva K.D. dr.Hj., Sp.A",
                            "id_dokter": "000177",
                            "jenis_layanan": "Rawat Inap",
                            "jenis_igd": "Umum",
                            "waktu_visitasi": "2025-08-09 09:24:55",
                            "tensi": {
                                "sistole": 110,
                                "diastole": 70
                            },
                            "gcs": {
                                "e": 9,
                                "v": 10,
                                "m": 11,
                                "total": 30
                            },
                            "nadi": 88,
                            "suhu": 38.2,
                            "nafas": 22,
                            "anamnesis": "Pasien anak laki-laki 6 tahun dengan keluhan demam sejak 2 hari disertai batuk pilek. Tidak ada riwayat alergi obat.",
                            "riwayat_penyakit_keluarga": "Ibu dengan riwayat asma.",
                            "anamnesis_lalu": "Tidak ada riwayat penyakit kronis. Imunisasi lengkap.",
                            "keluhan_utama": "Demam tinggi disertai batuk pilek.",
                            "keluhan_utama_perawat": "SAKIT LUAR BIASA",
                            "pemeriksaan_fisik": "Kesadaran: Compos mentis\nTekanan darah: 110/70 mmHg\nNadi: 88 x/menit\nSuhu: 38.2°C\nRR: 22 x/menit\nSpO₂: 96%\nBB: 22 kg\nTB: 115 cm",
                            "pemeriksaan_penunjang": "Hitung darah lengkap: Leukosit 11.000 /µL (sedikit meningkat). Rapid test influenza: negatif.",
                            "diagnosis": "Infeksi Saluran Pernapasan Atas (ISPA)",
                            "plan": "Observasi suhu, terapi simptomatik dengan Paracetamol 250 mg/8 jam bila demam, cairan cukup, edukasi orang tua.",
                            "spo2": "96%",
                            "id_pendaftaran": 4521,
                            "tinggi_badan": 115,
                            "berat_badan": 22
                        }
                    ],
                    "assesmen_igd": [],
                    "alergi_list": [
                        {
                            "id_alergi_pasien": "34",
                            "id_snomed_allergy": null,
                            "id_pasien": "00007659",
                            "kategori_alergi": "medication",
                            "status_verifikasi": "confirmed",
                            "deskripsi": "testing 3",
                            "kode_kfa": "93021992",
                            "nama_kfa": "Ekstrak Phyllanthus niruri Herba 50 mg Kapsul (STIMUNO FORTE)",
                            "is_delete": "0",
                            "id_allergy_satusehat": null,
                            "display_indo": null,
                            "code_snomed": null,
                            "display_snomed": null,
                            "code_system_snomed": null,
                            "status_allergy": null,
                            "category": null
                        },
                        {
                            "id_alergi_pasien": "33",
                            "id_snomed_allergy": "3",
                            "id_pasien": "00007659",
                            "kategori_alergi": "environment",
                            "status_verifikasi": "confirmed",
                            "deskripsi": "testing 2",
                            "kode_kfa": "",
                            "nama_kfa": "",
                            "is_delete": "0",
                            "id_allergy_satusehat": null,
                            "display_indo": "Akasia",
                            "code_snomed": "43987000",
                            "display_snomed": "Acacia",
                            "code_system_snomed": "http://snomed.info/sct",
                            "status_allergy": "1",
                            "category": "environment"
                        },
                        {
                            "id_alergi_pasien": "32",
                            "id_snomed_allergy": "19",
                            "id_pasien": "00007659",
                            "kategori_alergi": "food",
                            "status_verifikasi": "confirmed",
                            "deskripsi": "testing",
                            "kode_kfa": "",
                            "nama_kfa": "",
                            "is_delete": "0",
                            "id_allergy_satusehat": null,
                            "display_indo": "Daging ayam",
                            "code_snomed": "226955001",
                            "display_snomed": "Chicken - meat",
                            "code_system_snomed": "http://snomed.info/sct",
                            "status_allergy": "1",
                            "category": "food"
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
            "alamat": ""
        },
        "ttd_data": {
            "kota": "",
            "tanggal": "",
            "jam": "",
            "perawat_pengantar": "",
            "perawat_pengantar_stroke": "",
            "perawat_penerima": "",
            "perawat_penerima_stroke": ""
        },
        "informasi_operasi": {
            "tanggal": "",
            "jam": "",
            "dokter_operator": "",
            "dokter_operator_1": "",
            "dokter_anestesi": "",
            "dokter_pendamping": "",
            "tindakan": "",
            "lokasi_tindakan": ""
        },
        "persiapan_menjelang_operasi": {
            "infus": {
                "ri_rj": false,
                "ok": false,
                "tts_mnt": ""
            },
            "pasang_dc": {
                "ri_rj": false,
                "ok": false
            },
            "kosongkan_vu": {
                "ri_rj": false,
                "ok": false
            },
            "cukur": {
                "ri_rj": false,
                "ok": false,
                "detail": ""
            },
            "lavement": {
                "ri_rj": false,
                "ok": false,
                "pukul": ""
            },
            "puasa": {
                "ri_rj": false,
                "ok": false,
                "jam_sebelum_op": ""
            },
            "pakai_baju_operasi": {
                "ri_rj": false,
                "ok": false
            },
            "potong_kuku": {
                "ri_rj": false,
                "ok": false
            },
            "lepas_gigi_palsu": {
                "ri_rj": false,
                "ok": false
            },
            "lepas_lensa_kontak": {
                "ri_rj": false,
                "ok": false
            },
            "lepas_perhiasan": {
                "ri_rj": false,
                "ok": false,
                "detail": ""
            },
            "hapus_makeup": {
                "ri_rj": false,
                "ok": false
            },
            "status_pasien": {
                "ri_rj": false,
                "ok": false
            },
            "ekg": {
                "ri_rj": false,
                "ok": false
            },
            "ro_usg_ctscan": {
                "ri_rj": false,
                "ok": false
            },
            "lembar_konsultasi": {
                "ri_rj": false,
                "ok": false
            },
            "informed_consent_bedah": {
                "ri_rj": false,
                "ok": false
            },
            "informed_consent_anestesi": {
                "ri_rj": false,
                "ok": false
            },
            "darah_transfusi": {
                "ri_rj": false,
                "ok": false,
                "colf": "",
                "jenis": ""
            },
            "obat": {
                "ri_rj": false,
                "ok": false,
                "detail": ""
            },
            "donor": {
                "ri_rj": false,
                "ok": false,
                "orang": ""
            },
            "pmi": {
                "ri_rj": false,
                "ok": false,
                "colf": "",
                "jenis": ""
            },
            "penyimpanan": {
                "ri_rj": false,
                "ok": false,
                "detail": ""
            }
        },
        "penandaan_lokasi_operasi": {
            "ya": false,
            "tidak_diperlukan": false
        },
        "anamnesis": {
            "riwayat_penyakit_dahulu": {
                "alergi_obat": false,
                "alergi_makanan": false,
                "penyakit_jantung": false,
                "hipertensi": false,
                "asma": false,
                "ppok": false,
                "penyakit_ginjal": false,
                "penyakit_hati": false
            },
            "riwayat_pengobatan": "",
            "riwayat_operasi_terdahulu": "",
            "komplikasi": "",
            "riwayat_penggunaan_bahan": {
                "obat_penenang": false,
                "merokok": false,
                "alkohol": false
            }
        },
        "pemeriksaan_fisik": {
            "tensi_sistole": 0.0,
            "tensi_diastole": 0.0,
            "frek_nadi": 0.0,
            "frek_nafas": 0.0,
            "suhu": 0.0,
            "bb": 0.0,
            "tb": 0.0
        },
        "pemeriksaan_penunjang": {
            "hb": "",
            "pt": "",
            "al": "",
            "appt": "",
            "at": "",
            "gds": "",
            "gol": "",
            "hbsag": ""
        },
        "catatan": "",
        "resep_freetext": ""
    }
}