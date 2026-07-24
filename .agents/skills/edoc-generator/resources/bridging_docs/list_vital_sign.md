---
name: code-snippet-list-vital-sign
description: This document provides the standard code snippets for integrating the Vital Sign Data List. AI agents MUST paste these code snippets exactly as provided, without modifying, truncating, or refactoring any existing logic.
---

# STEP 0 : Understanding and required information
1. Detailed information about the data bridging methods to be used
2. A detailed explanation of the related objects
3. Understand everything and proceed through all the steps

# STEP 1 : Insert this code into the `./output/config.json` file at the very end of the `external_link` object
```json
"vital_sign_data_list": {
		"source_type": "ws",
		"source": "[simrs]/e_doc_api/visitation/patient_vital_sign_list/<reg_number>",
		"data_usage": [
				"copy"
		]
}
```

# STEP 2 : Understand which objects will be used based on the prompt provided

# STEP 3 : Insert the code below into the `./output/json.js` file, at the very bottom of the `external_link` object
Important Note : Include everything; don't cut anything out or change anything.
```json
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
                "gcs":{
                    "e":7,  
                    "v":8,  
                    "m":9,
                    "total":24  
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
```

# STEP 4 :  Search for this comment `=== [BRIDGING_SORTING_HOOK] ===` in the file `./output/index.html`, and insert the code below on the next line
```js
// Mengurutkan list vital sign berdasarkan waktu kunjungan terbaru paling atas
if (data.external_link?.vital_sign_data_list && Array.isArray(data.external_link.vital_sign_data_list)) {
    data.external_link.vital_sign_data_list.sort((a, b) => {
        const getLatestVisit = (item) => {
            if (!Array.isArray(item.layanan) || item.layanan?.length === 0) {
                return 0; // fallback: paling lama
            }

            const times = item.layanan
                .map(x => new Date(x.waktu_visitasi).getTime())
                .filter(t => !isNaN(t));

            return times?.length ? Math.max(...times) : 0;
        };

        const latestA = getLatestVisit(a);
        const latestB = getLatestVisit(b);

        return latestB - latestA; // terbaru di atas
    });
}
```

# STEP 5 : Find this comment `=== [METHOD_HOOK] ===` in the file `./output/index.html`, and insert the code below on the line following that comment
Important Note : Adjust the objects used in this function based on the object information provided in the prompt that was understood in Step 2.
```js
setVitalSign: function (vital_data, layanan, collapse_id) {
		// menggunakan id collapse untuk expand data yang sudah terpilih di modal
		if (collapse_id) {
        $('#' + collapse_id).collapse('show');
    }
    
    // menampilkan gcs sesuai jenis layanan
		const gcsFix = vital_data.jenis_layanan === "IGD" ? vital_data?.assesmen_igd : layanan?.gcs;
		
    // Sesuaikan data dibawah ini
    this.vital_sign.tinggi_badan = parseFloat(vital_data?.tinggi_badan) || 0.0;
    this.vital_sign.berat_badan = parseFloat(vital_data?.berat_badan) || 0.0;
    this.vital_sign.buta_warna = vital_data?.buta_warna || "";
    this.vital_sign.keadaan_umum = vital_data?.assesmen_igd?.disability_keadaan_umum || "";
    this.vital_sign.skala_nyeri = parseFloat(vital_data?.assesmen_igd?.skala_nyeri) || 0.0;
    this.vital_sign.kesadaran = vital_data?.assesmen_igd?.disability_kesadaran || "";
    this.vital_sign.alergi = vital_data?.alergi || "";
    this.vital_sign.tensi_sistole = parseFloat(layanan?.tensi?.sistole) || 0.0;
    this.vital_sign.tensi_diastole = parseFloat(layanan?.tensi?.diastole) || 0.0;
    this.vital_sign.nadi = parseFloat(layanan?.nadi) || 0.0;
    this.vital_sign.suhu = parseFloat(layanan?.suhu) || 0.0;
    this.vital_sign.nafas = parseFloat(layanan?.nafas) || 0.0;
    this.vital_sign.anamnesis = layanan?.anamnesis || "";
    this.vital_sign.riwayat_penyakit_keluarga = layanan?.riwayat_penyakit_keluarga || "";
    this.vital_sign.anamnesis_lalu = layanan?.anamnesis_lalu || "";
    this.vital_sign.keluhan_utama = layanan?.keluhan_utama || "";
    this.vital_sign.keluhan_utama_perawat = layanan?.keluhan_utama_perawat|| "";
    this.vital_sign.pemeriksaan_fisik = layanan?.pemeriksaan_fisik || "";
    this.vital_sign.pemeriksaan_penunjang = layanan?.pemeriksaan_penunjang || "";
    this.vital_sign.plan = layanan?.plan || "";
    this.vital_sign.spo2 = layanan?.spo2 || "";
    
    // GCS Baru
    this.vital_sign.gcs_e = parseFloat(gcsFix?.gcs_e ?? gcsFix?.e) || 0.0;
    this.vital_sign.gcs_v = parseFloat(gcsFix?.gcs_v ?? gcsFix?.v) || 0.0;
    this.vital_sign.gcs_m = parseFloat(gcsFix?.gcs_m ?? gcsFix?.m) || 0.0;
    this.vital_sign.gcs_total = parseFloat(gcsFix?.gcs_total ?? gcsFix?.total) || this.vital_sign.gcs_e + this.vital_sign.gcs_v + this.vital_sign.gcs_m;
    
    // GCS Lama
    // this.vital_sign.gcs_e = vital_data?.assesmen_igd?.gcs_e || "";
    // this.vital_sign.gcs_v = vital_data?.assesmen_igd?.gcs_v || "";
    // this.vital_sign.gcs_m = vital_data?.assesmen_igd?.gcs_m || "";
    
    // tutup modal setelah pilih data
    $('#patient_vital_sign_modal').modal('hide');
},
```


# STEP 6 : Find this comment `=== [BRIDGING_INIT_ADD_HOOK] ===` in the file `./output/index.html`, and insert the code below on the line following that comment
```js
{
    label: "Bridging List Vital Sign",
    functionName: bridgingVitalSign,
    parameters: [data]
},
```

# STEP 7 : Find this comment `=== [BRIDGING_INIT_EDIT_HOOK] ===` in the file `./output/index.html`, and insert the code below on the line following that comment
```js
{
    label: "Bridging List Vital Sign [EDIT]",
    functionName: bridgingVitalSign,
    parameters: [data]
},
```

# STEP 8 : Find this comment `=== [BRIDGING_FUNCTION_HOOK] ===` in the file `./output/index.html`, and insert the code below on the line following that comment
Important Note : Adjust the objects that are called and used here, based on your understanding from Steps 2 and 5
```js
function bridgingVitalSign(data) {
    if (data.external_link?.vital_sign_data_list?.length) {
		    // Mengambil nilai dari visitasi terbaru
        const vital_data = data.external_link.vital_sign_data_list[0];
        const layanan = data.external_link.vital_sign_data_list[0].layanan[0];
        
        // Mengambil gcs sesuai jenis layanan
        const gcsFix = vital_data.jenis_layanan === "IGD" ? vital_data?.assesmen_igd : layanan?.gcs;
        
        // auto expand di modal untuk data yang udah ke bridging
        setTimeout(() => {
            const collapseId = 'collapse_' + vital_data.id_layanan_pendaftaran + '_0';
            $('#' + collapseId).collapse('show');
        }, 500);

        // Sesuaikan data dibawah ini
        assignIfEmpty(data, {
            "vital_sign.tinggi_badan": parseFloat(vital_data?.tinggi_badan) || 0.0,
            "vital_sign.berat_badan": parseFloat(vital_data?.berat_badan) || 0.0,
            "vital_sign.buta_warna": vital_data?.buta_warna || "",
            "vital_sign.keadaan_umum": vital_data?.assesmen_igd?.disability_keadaan_umum || "",
            "vital_sign.skala_nyeri": parseFloat(vital_data?.assesmen_igd?.skala_nyeri) || 0.0,
            "vital_sign.kesadaran": vital_data?.assesmen_igd?.disability_kesadaran || "",
            "vital_sign.alergi": vital_data?.alergi || "",

            "vital_sign.tensi_sistole": parseFloat(layanan?.tensi?.sistole) || 0.0,
            "vital_sign.tensi_diastole": parseFloat(layanan?.tensi?.diastole) || 0.0,
            "vital_sign.nadi": parseFloat(layanan?.nadi) || 0.0,
            "vital_sign.suhu": parseFloat(layanan?.suhu) || 0.0,
            "vital_sign.nafas": parseFloat(layanan?.nafas) || 0.0,
            "vital_sign.anamnesis": layanan?.anamnesis || "",
            "vital_sign.riwayat_penyakit_keluarga": layanan?.riwayat_penyakit_keluarga || "",
            "vital_sign.anamnesis_lalu": layanan?.anamnesis_lalu || "",
            "vital_sign.keluhan_utama": layanan?.keluhan_utama || "",
            "vital_sign.keluhan_utama_perawat": layanan?.keluhan_utama_perawat|| "",
            "vital_sign.pemeriksaan_fisik": layanan?.pemeriksaan_fisik || "",
            "vital_sign.pemeriksaan_penunjang": layanan?.pemeriksaan_penunjang || "",
            "vital_sign.plan": layanan?.plan || "",
            "vital_sign.spo2": layanan?.spo2 || "",
            
            "vital_sign.gcs_e": parseFloat(gcsFix?.gcs_e ?? gcsFix?.e) || 0.0,
            "vital_sign.gcs_v": parseFloat(gcsFix?.gcs_v ?? gcsFix?.v) || 0.0,
            "vital_sign.gcs_m": parseFloat(gcsFix?.gcs_m ?? gcsFix?.m) || 0.0,
            "vital_sign.gcs_total": parseFloat(gcsFix?.gcs_total ?? gcsFix?.total) || parseFloat(gcsFix?.gcs_e ?? gcsFix?.e) + parseFloat(gcsFix?.gcs_v ?? gcsFix?.v) + parseFloat(gcsFix?.gcs_m ?? gcsFix?.m),
            
            // "vital_sign.gcs_e": vital_data?.assesmen_igd?.gcs_e || "",
            // "vital_sign.gcs_v": vital_data?.assesmen_igd?.gcs_v || "",
            // "vital_sign.gcs_m": vital_data?.assesmen_igd?.gcs_m || "",
        });
    }
}
```


# STEP 9 : Find this comment `=== [BRIDGING_MODALS_HOOK] ===` in the file `./output/index.html`, and insert the code below on the line following that comment
Important Note : Include everything; don't cut anything out or change anything.
```html
<!-- VITAL SIGN MODAL -->
<div style="overflow-y: scroll;" class="modal fade" id="patient_vital_sign_modal" tabindex="-1" role="dialog" aria-labelledby="patient_vital_sign_modalModalTitle" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 1080px;" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Vital Sign</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="tab-content border" style="border-color: #eeeeee; padding: 5px 5px 0px 5px">
                    <div class="accordion" id="accordionExample">
                        <div v-for="(vital_data,i) in external_link.vital_sign_data_list">
                            <div
                                class="card"
                                v-for="(layanan_data,j) in vital_data.layanan"
                                :key="vital_data.id_layanan_pendaftaran+'_'+j"
                                style="position: relative"
                            >
                                <div
                                    style="cursor: pointer"
                                    class="card-header"
                                    :id="'heading'+'_'+vital_data.id_layanan_pendaftaran+'_'+j"
                                    data-toggle="collapse"
                                    :data-target="'#collapse'+'_'+vital_data.id_layanan_pendaftaran+'_'+j"
                                    aria-expanded="false"
                                    :aria-controls="'collapseOne'+'_'+vital_data.id_layanan_pendaftaran+'_'+j"
                                >
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h2 class="p-0 m-0">{{layanan_data.jenis_layanan}}</h2>
                                            <span class="text-muted">{{layanan_data.waktu_visitasi ? layanan_data.waktu_visitasi : "-"}}</span>
                                        </div>
                                        <div>
                                            <button type="button" class="btn btn-primary btn-sm"
                                                @click.stop="setVitalSign(vital_data, layanan_data, 'collapse_'+vital_data.id_layanan_pendaftaran+'_'+j)">
                                                Pilih
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div
                                    :id="'collapse'+'_'+vital_data.id_layanan_pendaftaran+'_'+j"
                                    class="collapse"
                                    :aria-labelledby="'heading'+'_'+vital_data.id_layanan_pendaftaran+'_'+j"
                                    data-parent="#accordionExample"
                                >
                                    <div class="card-body px-2">
                                        <section class="d-flex">
                                            <div style="width: 50%" class="">
                                                <section class="d-flex align-items-start border-bottom">
                                                    <div style="width: 35%" class="d-flex justify-content-between">
                                                        <p class="d-block mb-0">Jenis kunjungan</p>
                                                        <p class="d-block mb-0">:</p>
                                                    </div>
                                                    <div style="width: 65%" class="d-flex text-left align-items-center pl-1">
                                                        <span>{{vital_data.jenis_igd}}</span>
                                                    </div>
                                                </section>
                                                <section class="d-flex align-items-start border-bottom">
                                                    <div style="width: 35%" class="d-flex justify-content-between">
                                                        <p class="d-block mb-0">Dokter</p>
                                                        <p class="d-block mb-0">:</p>
                                                    </div>
                                                    <div style="width: 65%" class="d-flex text-left align-items-center pl-1">
                                                        <span>{{layanan_data.dokter}}</span>
                                                    </div>
                                                </section>
                                                <section class="d-flex align-items-start border-bottom">
                                                    <div style="width: 35%" class="d-flex justify-content-between">
                                                        <p class="d-block mb-0">Keluhan Utama (Dokter)</p>
                                                        <p class="d-block mb-0">:</p>
                                                    </div>
                                                    <div style="width: 65%" class="d-flex text-left align-items-center pl-1">
                                                        <span>{{layanan_data.keluhan_utama}}</span>
                                                    </div>
                                                </section>
                                                <section class="d-flex align-items-start border-bottom">
                                                    <div style="width: 35%" class="d-flex justify-content-between">
                                                        <p class="d-block mb-0">Keluhan Utama (Perawat)</p>
                                                        <p class="d-block mb-0">:</p>
                                                    </div>
                                                    <div style="width: 65%" class="d-flex text-left align-items-center pl-1">
                                                        <span>{{layanan_data.keluhan_utama_perawat}}</span>
                                                    </div>
                                                </section>
                                                <section class="d-flex align-items-start border-bottom">
                                                    <div style="width: 35%" class="d-flex justify-content-between">
                                                        <p class="d-block mb-0">Anamnesis</p>
                                                        <p class="d-block mb-0">:</p>
                                                    </div>
                                                    <div style="width: 65%" class="d-flex text-left align-items-center pl-1">
                                                        <span>{{layanan_data.anamnesis}}</span>
                                                    </div>
                                                </section>
                                                <section class="d-flex align-items-start border-bottom">
                                                    <div style="width: 35%" class="d-flex justify-content-between">
                                                        <p class="d-block mb-0">Anamnesis Lalu</p>
                                                        <p class="d-block mb-0">:</p>
                                                    </div>
                                                    <div style="width: 65%" class="d-flex text-left align-items-center pl-1">
                                                        <span>{{layanan_data.anamnesis_lalu}}</span>
                                                    </div>
                                                </section>
                                                <section class="d-flex align-items-start border-bottom">
                                                    <div style="width: 35%" class="d-flex justify-content-between">
                                                        <p class="d-block mb-0">Penyakit Keluarga</p>
                                                        <p class="d-block mb-0">:</p>
                                                    </div>
                                                    <div style="width: 65%" class="d-flex text-left align-items-center pl-1">
                                                        <span>{{layanan_data.riwayat_penyakit_keluarga}}</span>
                                                    </div>
                                                </section>
                                                <section class="d-flex align-items-start border-bottom">
                                                    <div style="width: 35%" class="d-flex justify-content-between">
                                                        <p class="d-block mb-0">Plan</p>
                                                        <p class="d-block mb-0">:</p>
                                                    </div>
                                                    <div style="width: 65%" class="d-flex text-left align-items-center pl-1">
                                                        <span>{{layanan_data.plan}}</span>
                                                    </div>
                                                </section>
                                                <section class="d-flex align-items-start border-bottom">
                                                    <div style="width: 35%" class="d-flex justify-content-between">
                                                        <p class="d-block mb-0">Alergi</p>
                                                        <p class="d-block mb-0">:</p>
                                                    </div>
                                                    <div style="width: 65%" class="d-flex text-left align-items-center pl-1">
                                                        <span>{{vital_data.alergi}}</span>
                                                    </div>
                                                </section>
                                                <section class="d-flex align-items-start border-bottom">
                                                    <div style="width: 35%" class="d-flex justify-content-between">
                                                        <p class="d-block mb-0">Pemeriksaan Fisik</p>
                                                        <p class="d-block mb-0">:</p>
                                                    </div>
                                                    <div style="width: 65%" class="d-flex text-left align-items-center pl-1">
                                                        <span>{{layanan_data.pemeriksaan_fisik}}</span>
                                                    </div>
                                                </section>
                                            </div>
                                            <div style="width: 50%" class="">
                                                <section class="d-flex align-items-start border-bottom">
                                                    <div style="width: 30%" class="d-flex justify-content-between">
                                                        <p class="d-block mb-0">Tensi</p>
                                                        <p class="d-block mb-0">:</p>
                                                    </div>
                                                    <div style="width: 70%" class="d-flex text-left align-items-center pl-1">
                                                        <span>{{layanan_data.tensi.sistole}}</span>
                                                        <span>&nbsp;mm/Hg &nbsp;</span>
                                                        <span>&nbsp;/ &nbsp;</span>
                                                        <span>{{layanan_data.tensi.diastole}}</span>
                                                        <span>&nbsp;mm/Hg &nbsp;</span>
                                                    </div>
                                                </section>
                                                <section class="d-flex align-items-start border-bottom">
                                                    <div style="width: 30%" class="d-flex justify-content-between">
                                                        <p class="d-block mb-0">Nadi</p>
                                                        <p class="d-block mb-0">:</p>
                                                    </div>
                                                    <div style="width: 70%" class="d-flex text-left align-items-center pl-1">
                                                        <span>{{layanan_data.nadi}}</span>
                                                        <span>&nbsp;x/menit &nbsp;</span>
                                                    </div>
                                                </section>
                                                <section class="d-flex align-items-start border-bottom">
                                                    <div style="width: 30%" class="d-flex justify-content-between">
                                                        <p class="d-block mb-0">Suhu</p>
                                                        <p class="d-block mb-0">:</p>
                                                    </div>
                                                    <div style="width: 70%" class="d-flex text-left align-items-center pl-1">
                                                        <span>{{layanan_data.suhu}}</span>
                                                        <span>&nbsp;&deg;C &nbsp;</span>
                                                    </div>
                                                </section>
                                                <section class="d-flex align-items-start border-bottom">
                                                    <div style="width: 30%" class="d-flex justify-content-between">
                                                        <p class="d-block mb-0">Napas</p>
                                                        <p class="d-block mb-0">:</p>
                                                    </div>
                                                    <div style="width: 70%" class="d-flex text-left align-items-center pl-1">
                                                        <span>{{layanan_data.nafas}}</span>
                                                        <span>&nbsp;x/menit &nbsp;</span>
                                                    </div>
                                                </section>
                                                <section class="d-flex align-items-start border-bottom">
                                                    <div style="width: 30%" class="d-flex justify-content-between">
                                                        <p class="d-block mb-0">Berat Badan</p>
                                                        <p class="d-block mb-0">:</p>
                                                    </div>
                                                    <div style="width: 70%" class="d-flex text-left align-items-center pl-1">
                                                        <span>{{vital_data.berat_badan}}</span>
                                                        <span>&nbsp;Kg&nbsp;</span>
                                                    </div>
                                                </section>
                                                <section class="d-flex align-items-start border-bottom">
                                                    <div style="width: 30%" class="d-flex justify-content-between">
                                                        <p class="d-block mb-0">Tinggi Badan</p>
                                                        <p class="d-block mb-0">:</p>
                                                    </div>
                                                    <div style="width: 70%" class="d-flex text-left align-items-center pl-1">
                                                        <span>{{vital_data.tinggi_badan}}</span>
                                                        <span>&nbsp;Cm&nbsp;</span>
                                                    </div>
                                                </section>
                                                <section class="d-flex align-items-start border-bottom">
                                                    <div style="width: 30%" class="d-flex justify-content-between">
                                                        <p class="d-block mb-0">spo2</p>
                                                        <p class="d-block mb-0">:</p>
                                                    </div>
                                                    <div style="width: 70%" class="d-flex text-left align-items-center pl-1">
                                                        <span>{{layanan_data.spo2}}</span>
                                                        <span>&nbsp;%&nbsp;</span>
                                                    </div>
                                                </section>
                                                <section class="d-flex align-items-start border-bottom">
                                                    <div style="width: 30%" class="d-flex justify-content-between">
                                                        <p class="d-block mb-0">Kesadaran</p>
                                                        <p class="d-block mb-0">:</p>
                                                    </div>
                                                    <div style="width: 70%" class="d-flex text-left align-items-center pl-1">
                                                        <span>{{vital_data.assesmen_igd.disability_kesadaran}}</span>
                                                    </div>
                                                </section>
                                                <section class="d-flex align-items-start border-bottom">
                                                    <div style="width: 30%" class="d-flex justify-content-between">
                                                        <p class="d-block mb-0">Keadaan Umun</p>
                                                        <p class="d-block mb-0">:</p>
                                                    </div>
                                                    <div style="width: 70%" class="d-flex text-left align-items-center pl-1">
                                                        <span>{{vital_data.assesmen_igd.disability_keadaan_umum}}</span>
                                                    </div>
                                                </section>
                                                <section class="d-flex align-items-start border-bottom">
                                                    <div style="width: 30%" class="d-flex justify-content-between">
                                                        <p class="d-block mb-0">GCS E</p>
                                                        <p class="d-block mb-0">:</p>
                                                    </div>
                                                    <div style="width: 70%" class="d-flex text-left align-items-center pl-1">
                                                        <span v-if="vital_data.jenis_layanan === 'IGD'">
                                                          {{ vital_data.assesmen_igd.gcs_e }}
                                                        </span>
                                                        <span v-else>
                                                          {{ layanan_data?.gcs?.e }}
                                                        </span>
                                                    </div>
                                                </section>
                                                <section class="d-flex align-items-start border-bottom">
                                                    <div style="width: 30%" class="d-flex justify-content-between">
                                                        <p class="d-block mb-0">GCS V</p>
                                                        <p class="d-block mb-0">:</p>
                                                    </div>
                                                    <div style="width: 70%" class="d-flex text-left align-items-center pl-1">
                                                        <span v-if="vital_data.jenis_layanan === 'IGD'">
                                                          {{ vital_data.assesmen_igd.gcs_v }}
                                                        </span>
                                                        <span v-else>
                                                          {{ layanan_data?.gcs?.v }}
                                                        </span>
                                                    </div>
                                                </section>
                                                <section class="d-flex align-items-start border-bottom">
                                                    <div style="width: 30%" class="d-flex justify-content-between">
                                                        <p class="d-block mb-0">GCS M</p>
                                                        <p class="d-block mb-0">:</p>
                                                    </div>
                                                    <div style="width: 70%" class="d-flex text-left align-items-center pl-1">
                                                        <span v-if="vital_data.jenis_layanan === 'IGD'">
                                                          {{ vital_data.assesmen_igd.gcs_m }}
                                                        </span>
                                                        <span v-else>
                                                          {{ layanan_data?.gcs?.m }}
                                                        </span>
                                                    </div>
                                                </section>
                                                <section class="d-flex align-items-start border-bottom">
                                                    <div style="width: 30%" class="d-flex justify-content-between">
                                                        <p class="d-block mb-0">Pemeriksaan Penunjang</p>
                                                        <p class="d-block mb-0">:</p>
                                                    </div>
                                                    <div style="width: 70%" class="d-flex text-left align-items-center pl-1">
                                                        <span>{{layanan_data.pemeriksaan_penunjang}}</span>
                                                    </div>
                                                </section>
                                            </div>
                                        </section>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- VITAL SIGN MODAL -->
```

# STEP 10 : Add the modal button code below to the location specified in the prompt.
```html
<button
      v-if="external_link?.vital_sign_data_list && external_link.vital_sign_data_list.length > 0 
      && (external_link.vital_sign_data_list.length > 1 || external_link.vital_sign_data_list[0].layanan?.length > 1)"
      type="button" title="Vital sign" data-toggle="modal"
      data-target="#patient_vital_sign_modal" class="btn btn-info btn-sm">
      Hasil Vital Sign
</button>
```

# IMPORTANT NOTES OVERALL:
1. All code snippets above must be entered in full without any changes, except for a few object adjustments in STEP 2, STEP 5, and STEP 8. Additionally, all code must remain identical and must not be altered or omitted when inserted into the `.output/index.html` file.
2. Work through and understand each step carefully, so that if this skill is called upon again, you can use it consistently don’t leave anything out.

