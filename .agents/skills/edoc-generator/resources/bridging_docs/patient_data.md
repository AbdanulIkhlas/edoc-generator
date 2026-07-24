---
name: bridging-patient-data
description: This document contains standard code snippet for integrating Patient Data Bridging. AI agents MUST paste these code snippets exactly as provided, without cutting or altering the existing logic.
---

# Bridging Module: Patient Data

This document contains standard (_code snippets_) for integrating Patient Data Bridging. AI agents MUST paste these code snippets exactly as provided, without cutting or altering the existing logic.

## 1. Config Block (Inject to `output/config.json` -> `external_link`)

Check whether the relevant key already exists in the `external_link` section of `config.json`.
If it **does't exist**, add the following block:
```json
"px_data": {
    "source_type": "ws",
    "source": "[simrs]/e_doc_api/patient/get/<patient_id>/full",
    "data_usage": [
        "copy",
        "embeded"
    ]
}
```

## 2. Sample Data Block (Inject to output/json.js)

### A. Form Properties (Inject to sample & default)
If this object's property does not yet exist in `data.sample` and `data.default`, add it:

Check `./output/json.js`. If this is a new bridging and the target JSON object does not exist in the `sample`, add the following structure (adjust fields based on needs):

```json
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
    "umur": "35"
}
```

If the JSON object already exists, there is no need to add it. (Inform the agent whether the JSON object is already present).

### B. External Link Dummy Payload (Inject to sample.external_link)

Check `sample.external_link` to see if the key already exists. If it doesn\'t exist, add the following block in its entirety without any modifications:
```json
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
}
```

## 3. JS Functions & Vue Methods `(Inject to output/index.html -> <script>)`

### In `init_doc_add` and `init_doc_edit`

At the end of `function init_doc_add(data)`, add this code at the comment `// === [BRIDGING_INIT_ADD_HOOK] ===`:

```js
bridgingPatientData(data);
```

_(No changes needed for `init_doc_edit` unless specifically required)_

### G. Global Functions (Inject to `index.html` <script>)

Add the following global bridging function below the `init_doc_edit(data)` function at this comment `// === [BRIDGING_FUNCTION_HOOK] ===`::
```js
function bridgingPatientData(data) {
  const ext_patient = data.external_link.px_data;

  // Adjust mapped objects according to the document's needs
  data.pasien.nama = ext_patient.nama || "";
  data.pasien.no_rm = ext_patient.no_rm || "";
  data.pasien.alamat = ext_patient.alamat || "";
  data.pasien.tempat_lahir = ext_patient.tempat_lahir || "";
  data.pasien.pekerjaan = ext_patient.pekerjaan || "";
  data.pasien.agama = ext_patient.agama || "";
  data.pasien.pendidikan = ext_patient.pendidikan || "";
  data.pasien.tanggal_lahir = ext_patient.tanggal_lahir || "";
  data.pasien.tanggal_lahir_indo = dateParse(
    new Date(ext_patient.tanggal_lahir || ""),
  ); // Indonesian date format
  data.pasien.kelamin = showKelamin(ext_patient.kelamin);
  data.pasien.umur = getAge(ext_patient.tanggal_lahir).toString() || "";
  data.pasien.ttd_stroke = getUrlHandler() + `patient/${ext_patient.no_rm}.png`;
}
```

(Adjust the object mapping properties based on what is actually needed for the document.)


# IMPORTANT RULES FOR AGENT

1. Verbatim Code Injections: DO NOT reduce, refactor, or truncate any JavaScript/HTML code snippets above.
2. Context Checking: ALWAYS check whether objects already exist before injecting to prevent duplicate function errors.
3. Data Mapping Adaptation: Adjust JSON property mappings ONLY if user explicitly requests a different property container name.
