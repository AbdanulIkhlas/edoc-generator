---
name: bridging-patient-info-data
description: This document contains standard code snippet for integrating Patient Info Data Bridging. AI agents MUST paste these code snippets exactly as provided, without cutting or altering the existing logic.
---

# Bridging Module: Patient Info Data

This document contains standard (_code snippets_) for integrating Patient Info Data Bridging. AI agents MUST paste these code snippets exactly as provided, without cutting or altering the existing logic.

## 1. Config Block (Inject to `output/config.json` -> `external_link`)

Check whether the relevant key already exists in the `external_link` section of `config.json`.
If it **doesn't exist**, add the following block:
```json
"patient_info_data": {
    "source_type": "ws",
    "source": "[simrs]/e_doc_api/visitation/patient_information/<reg_number>",
    "data_usage": [
        "copy"
    ]
}
```

## 2. Sample Data Block (Inject to output/json.js)

### A. Form Properties (Inject to sample & default)
If this object's property does not yet exist in `data.sample` and `data.default`, add it:

Check `./output/json.js` under `sample.external_link`. If `patient_info_data` doesn't exist, add the following (do not truncate, paste everything):

```json
"patient_info_data": {
	"no_register":"2001080007",
  "id_pasien":"00000092",
  "id_pendaftaran":1823,
  "id_layanan_pendaftaran":2080,
  "waktu_daftar":"2020-01-08 10:28:09",
  "waktu_keluar":"2020-01-08 18:15:41",
  "jenis":"Poliklinik",
  "tindak_lanjut":"Pulang",
  "kondisi_keluar":"Hidup",
  "nama_pjwb":"",
  "telp_pjwb":"",
  "alamat_pjwb":"",
  "nama_pjwb_finansial":"",
  "telp_pjwb_finansial":"",
  "alamat_pjwb_finansial":"",
  "nama_ayah":"Abdullah",
  "nama_ibu":"Aminah",
  "nama_pasangan":"Khaleed",
  "cara_bayar":"Tunai",
  "nama_penjamin":"",
  "klinik":"Umum",
  "nopolish":"",
  "no_sep":"0144R0010923V000645",
  "no_rujukan":"111502020923Y000193",
  "bpjs_information":[
    {
      "id_bpjs_surat_kontrol":485,
      "waktu_terbit":"2022-06-29 08:24:14",
      "tanggal_kontrol":"2022-07-13",
      "jenis":"Kontrol",
      "nomor_surat":"0144R0010622K001044",
      "dipakai":1
    },
    {
      "id_bpjs_surat_kontrol":958,
      "waktu_terbit":"2022-07-13 07:43:20",
      "tanggal_kontrol":"2022-07-27",
      "jenis":"Kontrol",
      "nomor_surat":"0144R0010722K000456",
      "dipakai":1
    },
    {
      "id_bpjs_surat_kontrol":1435,
      "waktu_terbit":"2022-07-27 08:26:58",
      "tanggal_kontrol":"2022-08-10",
      "jenis":"Kontrol",
      "nomor_surat":"0144R0010722K000969",
      "dipakai":1
    }
  ],
  "sep_information":{
    "noSep":"0144R0010923V000645",
    "tglSep":"2023-09-12",
    "jnsPelayanan":"Rawat Jalan",
    "kelasRawat":"Kelas 3",
    "diagnosa":"Malignant neoplasm of sigmoid colon",
    "noRujukan":"111502020923Y000193",
    "poli":"BEDAH",
    "poliEksekutif":"0",
    "catatan":"MINTA RUJUKAN",
    "penjamin":null,
    "peserta":{
      "noKartu":"0000535133755",
      "nama":"WARTI",
      "tglLahir":"1980-12-23",
      "noMr":"00031424",
      "kelamin":"P",
      "jnsPeserta":"PBI (APBN)",
      "hakKelas":"Kelas 3",
      "asuransi":null
    },
    "klsRawat":{
      "klsRawatHak":"3",
      "klsRawatNaik":null,
      "pembiayaan":null,
      "penanggungJawab":null
    },
    "informasi":null,
    "kdStatusKecelakaan":"0",
    "nmstatusKecelakaan":"Bukan Kecelakaan",
    "dpjp":{
      "kdDPJP":"9571",
      "nmDPJP":"DR  WAHYU PRIYATNO Sp.B"
    },
    "kontrol":{
      "noSurat":null,
      "kdDokter":null,
      "nmDokter":null
    },
    "lokasiKejadian":{
      "tglKejadian":null,
      "kdProp":null,
      "kdKab":null,
      "kdKec":null,
      "ketKejadian":null,
      "lokasi":null
    },
    "cob":"0",
    "katarak":"0",
    "tujuanKunj":{
      "kode":"0",
      "nama":"Normal"
    },
    "flagProcedure":{
      "kode":"0",
      "nama":"Prosedur tidak berkelanjutan"
    },
    "kdPenunjang":{
      "kode":"0",
      "nama":""
    },
    "assestmenPel":{
      "kode":"0",
      "nama":""
    },
    "eSEP":"True"
  },
  "rujukan_information":{
    "asalFaskes":"1",
    "rujukan":{
      "noKunjungan":"111502020923Y000193",
      "tglKunjungan":"2023-09-09",
      "provPerujuk":{
        "kode":"11150202",
        "nama":"Purwareja Klampok 2"
      },
      "peserta":{
        "noKartu":"0000535133755",
        "nik":"3304026312800003",
        "nama":"WARTI",
        "pisa":"3",
        "sex":"P",
        "mr":{
          "noMR":"00031424",
          "noTelepon":"088220061023"
        },
        "tglLahir":"1980-12-23",
        "tglCetakKartu":"2015-10-30",
        "tglTAT":"2080-12-01",
        "tglTMT":"2013-01-01",
        "statusPeserta":{
          "kode":"0",
          "keterangan":"AKTIF"
        },
        "provUmum":{
          "kdProvider":"11150202",
          "nmProvider":"Purwareja Klampok 2"
        },
        "jenisPeserta":{
          "kode":"21",
          "keterangan":"PBI (APBN)"
        },
        "hakKelas":{
          "kode":"3",
          "keterangan":"KELAS III"
        },
        "umur":{
          "umurSekarang":"42 tahun ,9 bulan ,11 hari",
          "umurSaatPelayanan":"42 tahun ,9 bulan ,14 hari"
        },
        "informasi":{
          "dinsos":null,
          "prolanisPRB":null,
          "noSKTM":null,
          "eSEP":null
        },
        "cob":{
          "noAsuransi":null,
          "nmAsuransi":null,
          "tglTMT":null,
          "tglTAT":null
        }
      },
      "diagnosa":{
        "kode":"C18.7",
        "nama":"Malignant neoplasm of sigmoid colon"
      },
      "keluhan":"MINTA RUJUKAN",
      "poliRujukan":{
        "kode":"BED",
        "nama":"BEDAH"
      },
      "pelayanan":{
        "kode":"2",
        "nama":"Rawat Jalan"
      }
    }
  }
}
```

## 3. JS Functions & Vue Methods `(Inject to output/index.html -> <script>)`

### A. Autocomplete Config Function

Add this at the comment `// === [CONFIG_AUTOCOMPLETE_HOOK] ===` alongside other autocomplete configs:
```js
function configKlinik(data) {
  return {
    element: "#klinik_auto",
    url: "/api/emr/autocomplete?source_name=klinik",
    query_params: {
      ikw: "",
      filterActive: "",
    },
    markup_template: function (repo) {
      return `<b>${repo.nama}</b>`;
    },
    selection_template: function (repo) {
      // Write string format for autocomplete label
      var res = "";
      if (repo.id != "") {
        // Map to the correct JSON path
        res = repo.nama || data.pasien.klinik;
        data.pasien.klinik = res;
      }

      return res;
    },
  };
}
```

### In Vue `methods` `init`

Find the `init` method within the Vue instance `methods`. Add the initialization call for the autocomplete:
add this code at the comment `// === [AUTOCOMPLETE_HOOK] ===`

```js
autocomplete(configKlinik(data));
```

### In `init_doc_add` and `init_doc_edit`

At the end of `function init_doc_add(data)`, add this code at the comment `// === [BRIDGING_INIT_ADD_HOOK] ===`:

```js
bridgingPatientInfoData(data);
```

At the end of `function init_doc_edit(data)`, add this code at the comment `// === [BRIDGING_INIT_EDIT_HOOK] ===`:

```js
bridgingPatientInfoData(data, "edit");
```

### G. Global Functions (Inject to `index.html` <script>)

Add the following global bridging function below the `init_doc_edit(data)` function at this comment `// === [BRIDGING_FUNCTION_HOOK] ===`:
```js
function bridgingPatientInfoData(data, operation = 'add') {
  const ext_patient_info_data = data.external_link.patient_info_data;

	if (operation === 'add') {
		// Klinik
		if (ext_patient_info_data?.jenis === 'Poliklinik') {
			// Adjust mapped objects according to the document's needs
	    data.<sesuaikan_objek> = ext_patient_info_data?.klinik || "";
	    // Display in the select / autocomplete component
	    setSelect2($('#klinik_auto'), ext_patient_info_data.klinik, ext_patient_info_data.klinik);
	  }

		// Adjust mapped objects according to the document's needs
		data.<sesuaikan_objek> = ext_patient_info_data.cara_bayar || "";
		data.<sesuaikan_objek> = ext_patient_info_data.nama_penjamin || "";
		data.<sesuaikan_objek> = ext_patient_info_data.kondisi_keluar || "";
		data.<sesuaikan_objek> = ext_patient_info_data.nama_pasangan || "";
		data.<sesuaikan_objek> = ext_patient_info_data.no_sep || "";

		data.<sesuaikan_objek> = dateTimeParse(ext_patient_info_data.waktu_daftar).date || "";
		data.<sesuaikan_objek> = dateTimeParse(ext_patient_info_data.waktu_daftar).time || "";
		data.<sesuaikan_objek> = dateTimeParse(ext_patient_info_data.waktu_daftar).dateWithMonthName || "";

		data.<sesuaikan_objek> = dateTimeParse(ext_patient_info_data.waktu_keluar).date || "";
		data.<sesuaikan_objek> = dateTimeParse(ext_patient_info_data.waktu_keluar).time || "";
		data.<sesuaikan_objek> = dateTimeParse(ext_patient_info_data.waktu_keluar).dateWithMonthName || "";
	}	else if (operation === 'edit') {
		setSelect2($('#klinik_auto'), data.pasien.klinik, data.pasien.klinik);
	}
}
```

(Adjust the object mapping properties based on what is actually needed for the document.)

## 4. HTML Elements & Modals `(Inject to output/index.html -> <form id="formadd">)`

### A. Form Section Component (New Bridging Section)

If this is a new form section, use the following full HTML block:

Inside the `<form id="formadd">` tag, place the following element in the appropriate section:

```html
<select
  class=""
  id="klinik_auto"
  name="klinik_auto"
  style="width: 100%"
></select>
```


# IMPORTANT RULES FOR AGENT

1. Verbatim Code Injections: DO NOT reduce, refactor, or truncate any JavaScript/HTML code snippets above.
2. Context Checking: ALWAYS check whether objects already exist before injecting to prevent duplicate function errors.
3. Data Mapping Adaptation: Adjust JSON property mappings ONLY if user explicitly requests a different property container name.
