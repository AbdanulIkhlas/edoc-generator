const data = {
    "sample": {
        "pasien": {
            "nama": "Garga",
            "no_rm": "876754",
            "tanggal_lahir": "2000-08-08",
            "tanggal_lahir_indo": "8 Agustus 2000",
            "kelamin": "Laki-laki"
        },
        "ttd_data": {
            "tanggal": "2025-08-08",
            "tanggal_indo": "08 Agustus 2025",
            "jam": "11:25",
            "pasien": "",
            "pasien_stroke": "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAALQAAABkCAYAAAAv8xodAAAAAXNSR0IArs4c6QAACI1JREFUeF7tnTfINkUQx/+fOWshhkIwFqIIitqZEKy0EkXERlFBBFsVC1EsrD8QBEVtTZ2dAUNnRjFgQhExIIpiwvz+P29hXO5uL+xemPs/8PI+cHe7NzO/m2d2dnZvF/SRBhxpYJcjWSSKNAABLQhcaUBAuzKnhBHQYsCVBgS0K3NKGAEtBlxpQEC7MqeEEdBiwJUGBLQrc0oYAS0GXGlAQLsyp4QR0GLAlQYEtCtzShgBLQZcaUBAuzKnhBHQYsCVBgS0K3NKGAEtBlxpQEC7MqeEEdC+GfgJwMEAfgZwiG9R/5NOQPu28j9GvE3YehNC+ma2Ubp9APwhoDdqfYdiXw/gAQHt0LIbFelXAAcI6I1a36HYNn7ezHhJMXRZko8C8EmVaQg9vQLg3A7dvlyd0+XcuuYEdAcl65R2DdQBHF8RgA7ANTmV1PGULQR0SkM63qqBJpiZAz4RwDfR1SlgU8dT5hDQKQ3p+P800BfgWH0pYFPHU+YQ0CkN6fgeDXDG7RYA99RMTDV547YYVyFHRrA0KOyuzADy3QD2ri77G8CxNeFEl1ZTHjh1PNWHPHRKQxs73jbA+xPAnQB2A2C9xJBPCtjU8bY+zwLwGoDfTC56E85rE0IOoK0J5hwgh9tJAZs63ibWvQBu3YGZ/2+rTtyErTchZA+gY5D7xMQ9ugH7+ToB2higwyzhmQDeENB9TLP+c8dmK4ZoIJR18toSg0L7MIx5MIbINus1W/bQrEb7DsChkQVKeWXbTZeyzjEgCuhZH6t5OrfVaFNALKAnsPPWPHRdeHEDgAcn0PVUQNsMx4E72Zgxnn5itYzvbktA14UYTGsdFhXCj9dquoWSIYfNcNwuoNPGWOsZIcRgBuD4gZMhuWQvCTTDp4MAMMPxpoDOZbJltFPnlecIMWJtlAI6hBt2UaxCjmWwmOUu4mVIc4UYVhibg86dtovDDbYvoLOgNG8j8eBvCV45aMTmoHMD/QsADgRDuCGg5+UwS++E+SkA51StLcErN2U4cgJ9QrU65ncA+5sO5aGzYDV9I3G8zJUhl848+KvTQtcquL4gXgHgMQBPA7hEQE8PYO4e55wo6SNLKaDr4meFHH0ss6BzGWZ8VpVKLilejlUUb/6SM+R4BsDFAOipn5CHXhCdPW/FDgCXFi/HothcOAdvOYHmLkl8YBhLfyqge1K0gNPDCpK7KkNOXY/RVwWE7ccqC8FfkbCrUY5qO+v54/b6xuJ95VrU+Wue+qY3DqN5psJOWuAA0Bo7eGdmIfgw8n8uD209P2cJ7UdAL+qRq78Z65HuGLkUaipx/wKwF4AQ46dAC8dTG9PEnj8utEr1M5X8k/SzVg8dPBIXqYYFq7kVFk+AsP2h+yzb2cH9qmKoFGhdpsd5T7HntzuO8niqn9x6m7W9tQIdlhiVzGjE6bVgqL46s/nxrjUWXbbCDYtz6fU5wGzShYCe9RFLd26NHbxd+qr+Z8QgDAWjqcqvrb0uW+HaB46Ldxk7x95ZHrq/3Se/om0AlPNmcgHd9GvSBnSXrXAt0I8CuKpB+KEPYk5dTtZW35/PyW6spaMpwo06zzYUjHBd/GvS1l5qNjEOSW4CcL+AXt87VuoGVyUesnhVdpdtB+L7iCv++uSHU0DHIcmpOx76fQG9PqCneqtTACoM4ob0ax+KuuzIUA9tp/m7DFSH/rKUcBTF21xbyBGMc3ThSZTQz2kA3q7yxzRG136tR2+6JgbNPjR8FZv9BDux3S/N/QjoBkUVf3IydTCVtwmTIPa2u+agbajRdk3ToJPXEGjm2JmS44dA2/SfPZa6r6l0lsnE45pZq4cufd/WE/apEYlhrtvoPFjMgtYUo9tzhi7yFdDjnpGiVy/VOEMKpYIs+5odnGJva0OsoeWxS9VZEVBKe7rcN71U4wwplAqyhMq7uu0V4mxHn/LYrmsXc9to1vYEdB71B/D6FEqFa8IeznVT13GmpC2EiSVJZVnySL6wVgT0eIMMyVGz19j7lpzGHy/lSlpYK9Bd02elzdA1o1F3H6nJk9L37rL9tQE9ZIKjhOFybIxugU6l3obIwLJarjG8GsA1UZltqsZ6SH+LuGZtQHeZsCit2Bww8x5zPJwnV5vK8G2z3Absgo714QK6NCU92g8gMCsQLzfq0cygU68FcF9Vf9wnPz2oM3PRcQBYr3E6AM5e8jshTi1uYFnpI9V+Hc8B4ISR68/aPDSNQQ/JVc0sar8OwMOFLWQhDl2V3sG0LVyw4hLYl3Y21HkVAL0u36fyUWF9LLr5NQJNhRKyh3be9FTSS9sHx4J8c6GHKEB8OYArARxhyKFnJbTv7Bx7t6oveQ/A54uma4abWyvQVFWpSZbYI/OhyQXxkdXe1NyfOv5jGBFqNyjf9zvhxeMAngTw7BbChRz8ewA6V4agziOPiZPjAduFNVVysQ03F/PmgNi2sWagc8yE1cWqQzwy4T27yjhw11NmHA6vMRZDBxbicwxQ9/dtbgNvrb01A21TX7nsZj3yMQAI6inVH79z6pl7L9vQoKnvHwC8Xg3W+J+vKt70gC2XkdraWTvQOaC2P/NfALixiplZf9z1Q8/7orINXdVV7jwPQI/VDmsomFVgcdD5pjEW0b8F4MOd2bYPAHxcfaeX/Wpsp7q+jAa2CnRbnveF6r2F3Bqgbp+LMpZQq1k0sCWg2yBm2LG72gqAHlmflWrAM9CU7QwAF1U1DpdFU8VKka0UWu+Dwib5OEg7LzooiB1CbEXy7KGfrzw0Y2J+5x8HeXEdsnMTb0s8z0Bvy5KSdo8GBLRAcKUBAe3KnBJGQIsBVxoQ0K7MKWEEtBhwpQEB7cqcEkZAiwFXGhDQrswpYQS0GHClAQHtypwSRkCLAVcaENCuzClhBLQYcKUBAe3KnBJGQIsBVxoQ0K7MKWH+BSFd7nQpgxWyAAAAAElFTkSuQmCC",
            "dokter": "dr. Amilia Frayanty, Sp.P",
            "dokter_stroke": "http://12.12.1.112:1201/743_68a2dbea8e6aa.jpeg"
        },
        "image_canvas": {
            "canvas1": {
                "stroke": "",
                "image_base64": "",
                "is_changed": false
            }
        },
        "vital_sign": {
            "tinggi_badan": 0.0,
            "berat_badan": 0.0,
            "buta_warna": "",
            "keadaan_umum": "",
            "alergi": "",
            "gcs_e": "",
            "gcs_v": "",
            "gcs_m": "",
            "skala_nyeri": 0.0,
            "kesadaran": "",
            "tensi_sistole": 0.0,
            "tensi_diastole": 0.0,
            "nadi": 0.0,
            "suhu": 0.0,
            "nafas": 0.0,
            "anamnesis": "",
            "riwayat_penyakit_keluarga": "",
            "anamnesis_lalu": "",
            "keluhan_utama": "",
            "pemeriksaan_fisik": "",
            "pemeriksaan_penunjang": "",
            "plan": "",
            "spo2": ""
        },
        "penjelasan_tindakan": "weghweg wehgiw ehigwe hgiw weghweg ",
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
                        "disability_keadaan_umum": "Baik",
                        "gcs_e": "4",
                        "gcs_v": "6",
                        "gcs_m": "5",
                        "skala_nyeri": 0,
                        "wajah": 1,
                        "kaki": 0,
                        "aktivitas": 0,
                        "menangis": 1,
                        "bersuara": 0,
                        "disability_kesadaran": "Compos Mentis",
                        "refleks_cahaya": "\/",
                        "pulang_pukul": "0000-00-00 00:00:00",
                        "pulang_gcs_e": "4",
                        "pulang_gcs_v": "6",
                        "pulang_gcs_m": "5",
                        "pulang_nadi": 0,
                        "pulang_nafas": 0,
                        "pulang_tensi": {
                            "sistole": 0,
                            "diastole": 0
                        },
                        "pulang_suhu": 0,
                        "pulang_spo2": 0,
                        "transportasi_pulang": "",
                        "pendidikan_pasien": "",
                        "spo2": 92
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
                    "tinggi_badan": "165",
                    "berat_badan": "76",
                    "buta_warna": "",
                    "instansi_perujuk": "Pribadi",
                    "layanan": [
                        {
                            "id_layanan_pendaftaran": 154,
                            "dokter": "Reizkiana Feva K.D. dr.Hj., Sp.A",
                            "id_dokter": "000177",
                            "jenis_layanan": "Rawat Inap",
                            "jenis_igd": "Umum",
                            "waktu_visitasi": "2025-03-01 09:24:55",
                            "tensi": {
                                "sistole": 110,
                                "diastole": 70
                            },
                            "nadi": 88,
                            "suhu": 38.2,
                            "nafas": 22,
                            "anamnesis": "Pasien anak laki-laki 6 tahun dengan keluhan demam sejak 2 hari disertai batuk pilek. Tidak ada riwayat alergi obat.",
                            "riwayat_penyakit_keluarga": "Ibu dengan riwayat asma.",
                            "anamnesis_lalu": "Tidak ada riwayat penyakit kronis. Imunisasi lengkap.",
                            "keluhan_utama": "Demam tinggi disertai batuk pilek.",
                            "pemeriksaan_fisik": "Hasilnya nihil",
                            "pemeriksaan_penunjang": "Hitung darah lengkap: Leukosit 11.000 /µL (sedikit meningkat). Rapid test influenza: negatif.",
                            "diagnosis": "Infeksi Saluran Pernapasan Atas (ISPA)",
                            "plan": "Observasi suhu, terapi simptomatik dengan Paracetamol 250 mg/8 jam bila demam, cairan cukup, edukasi orang tua.",
                            "spo2": "96%",
                            "id_pendaftaran": 4521,
                            "tinggi_badan": 115,
                            "berat_badan": 22
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
                            "id_layanan_pendaftaran": 1652,
                            "dokter": "Reizkiana Feva K.D. dr.Hj.,SpA",
                            "id_dokter": "000177",
                            "jenis_layanan": "Rawat Inap",
                            "jenis_igd": "Umum",
                            "waktu_visitasi": "2022-03-01 09:24:55",
                            "tensi": {
                                "sistole": 0,
                                "diastole": 0
                            },
                            "nadi": 120,
                            "suhu": 36,
                            "nafas": 30,
                            "anamnesis": "undefined",
                            "riwayat_penyakit_keluarga": "",
                            "anamnesis_lalu": "",
                            "keluhan_utama": "BATUK DISERTAI DEMAM",
                            "pemeriksaan_fisik": "undefined",
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
            "kelamin": ""
        },
        "ttd_data": {
            "tanggal": "",
            "tanggal_indo": "",
            "jam": "",
            "pasien": "",
            "pasien_stroke": "",
            "dokter": "",
            "dokter_stroke": ""
        },
        "image_canvas": {
            "canvas1": {
                "stroke": "",
                "image_base64": "",
                "is_changed": false
            }
        },
        "vital_sign": {
            "tinggi_badan": 0.0,
            "berat_badan": 0.0,
            "buta_warna": "",
            "keadaan_umum": "",
            "alergi": "",
            "gcs_e": "",
            "gcs_v": "",
            "gcs_m": "",
            "skala_nyeri": 0.0,
            "kesadaran": "",
            "tensi_sistole": 0.0,
            "tensi_diastole": 0.0,
            "nadi": 0.0,
            "suhu": 0.0,
            "nafas": 0.0,
            "anamnesis": "",
            "riwayat_penyakit_keluarga": "",
            "anamnesis_lalu": "",
            "keluhan_utama": "",
            "pemeriksaan_fisik": "",
            "pemeriksaan_penunjang": "",
            "plan": "",
            "spo2": ""
        },
        "penjelasan_tindakan": ""
    }
}