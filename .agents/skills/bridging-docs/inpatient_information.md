---
name: bridging-inpatient-information
description: This document contains standard code snippet for integrating Inpatient Information Bridging. AI agents MUST paste these code snippets exactly as provided, without cutting or altering the existing logic.
---

# Bridging Inpatient Information

IMPORTANT:

- Identify which JSON objects need to be bridged based on the requested fields.
- Inform the user where the autocomplete element will be placed.

This is the prompt template for bridging inpatient information.
First, determine the relevant inpatient information objects to bridge based on the provided JSON structure. The relevant JSON structure will be highlighted in the prompt (e.g., via `ctrl+l` in the agent) within the `./output/json.js` file.

## 1. Update config.json

Check `./output/config.json`. If the following code does not exist under the `external_link` section, add it:

```json
"inpatient_information": {
    "source_type": "ws",
    "source": "[simrs]/e_doc_api/visitation/inpatient_information/<reg_number>",
    "data_usage": [
        "copy"
    ]
}
```

## 2. Update json.js

Check `./output/json.js`. If this is a new bridging and the target JSON object does not exist in the `sample`, add the following structure (adjust fields based on needs):

```json
"pasien": {
    "ruang": "Kelas",
    "bangsal": "bangsal",
    "kelas": "10 MIPA 2"
}
```

If the JSON object already exists, there is no need to add it. (Inform the agent whether the JSON object is already present).

Next, check `./output/json.js` under `sample.external_link`. If `inpatient_information` doesn't exist, add the following (do not truncate, paste everything):

```json
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
}
```

## 3. Update index.html (Scripts)

### Outside Vue Initialization

Before `function init_doc(doc_id, data, operation)`, add the autocomplete configuration function:

```js
function configRuang(data) {
  return {
    element: "#ruang_auto",
    url: "/api/emr/autocomplete?source_name=ruang_kelas",
    markup_template: function (repo) {
      return `<b>${repo.nama_bangsal}</b> - Ruang ${repo.nama_ruang}  <small>(${repo.nama_kelas})</small>`;
    },
    selection_template: function (repo) {
      // Write string format for autocomplete label
      var data_test = {
        nama_bangsal: repo.nama_bangsal || data.pasien.bangsal,
        nama_ruang: repo.nama_ruang || data.pasien.ruang,
        nama_kelas: repo.nama_kelas || data.pasien.kelas,
      };

      data.pasien.bangsal = data_test.nama_bangsal;
      data.pasien.ruang = data_test.nama_ruang;
      data.pasien.kelas = data_test.nama_kelas;

      return `${data_test.nama_bangsal} - Ruang ${data_test.nama_ruang} - ${data_test.nama_kelas}`;
    },
  };
}
```

### In Vue `methods` `init`

Find the `init` method within the Vue instance `methods`. Add the initialization call for the autocomplete:

```js
autocomplete(configRuang(data));
```

### In `init_doc_add` and `init_doc_edit`

At the end of `function init_doc_add(data)`, add:

```js
bridgingInpatientInformation(data);
```

At the end of `function init_doc_edit(data)`, add:

```js
bridgingInpatientInformation(data, "edit");
```

### Global Functions

Below the `init_doc_edit(data)` function (or look for `// function global`), add the following global bridging function:

```js
function bridgingInpatientInformation(data, operation = "add") {
  if (operation === "edit") {
    // Bridging ruangan
    setSelect2($("#ruang_auto"), data.pasien.ruang, data.pasien.ruang);
  } else {
    // Bridging ruangan
    const ruang = data.external_link.inpatient_information.no_ruang || "";
    data.pasien.ruang = data.external_link.inpatient_information.no_ruang || "";
    data.pasien.bangsal =
      data.external_link.inpatient_information.nama_bangsal || "";
    data.pasien.kelas =
      data.external_link.inpatient_information.nama_kelas || "";
    setSelect2($("#ruang_auto"), ruang, ruang);

    // Bridging waktu masuk
    data.pasien.tanggal_masuk = dateTimeParse(
      data.external_link.inpatient_information.waktu_masuk,
    ).date;
    data.pasien.tanggal_masuk_indo = dateTimeParse(
      data.external_link.inpatient_information.waktu_masuk,
    ).dateWithMonthName;
    data.pasien.jam_masuk = dateTimeParse(
      data.external_link.inpatient_information.waktu_masuk,
    ).time;
  }
}
```

(Adjust the object mapping properties based on what is actually needed for the document.)

## 4. Update index.html (HTML Forms)

Inside the `<form id="formadd">` tag, place the following element in the appropriate section:

```html
<select
  class="form-control"
  id="ruang_auto"
  name="ruang_tmp"
  style="width: 100%;"
></select>
```
