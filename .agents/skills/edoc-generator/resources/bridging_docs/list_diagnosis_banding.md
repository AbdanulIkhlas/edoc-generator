---
name: code-snippet-bridging-list-diagnosis-banding
description: This document contains standard code snippet for integrating List Diagnosis Banding Bridging. AI agents MUST paste these code snippets exactly as provided, without cutting or altering the existing logic.
---

# STEP 0 : Understanding and required information
1. Detailed information about the data bridging methods to be used
2. A detailed explanation of the related objects
3. Understand everything and proceed through all the steps

# STEP 1 : Insert this code into the `./output/config.json` file at the very end of the `external_link` object
Important Note : If this configuration is already present in `external_link`, then there is no need to add it.
```json
"diagnosa_list": {
    "source_type": "ws",
    "source": "[simrs]/e_doc_api/visitation/diagnosa_list/<reg_number>",
    "data_usage": [
        "copy"
    ]
}
```

# STEP 2 : Add this object to the end of `sample` and `default` in the `./output/json` file
```json
"diagnosa_banding_group" : "",
"diagnosa_banding_freetext": "",
"diagnosa_banding_autocomplete": []
```

If the JSON object already exists, there is no need to add it. (Inform the agent whether the JSON object is already present).

# STEP 3 : Insert the code below into the `./output/json.js` file, at the very bottom of the `external_link` object
Important Note : Include everything; don't cut anything out or change anything and If this configuration is already present in `external_link`, then there is no need to add it.
```json
"diagnosa_list": [
	{
      "no_register": "2202230010",
      "id_pasien": "00206957",
      "id_pendaftaran": 10,
      "id_layanan_pendaftaran": 1652,
      "jenis": "Rawat Inap",
      "tanggal": "2022-03-01",
      "jam": "09:27:15",
      "layanan": [{
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
      }]
  },
  {
      "no_register": "2202230010",
      "id_pasien": "00206957",
      "id_pendaftaran": 10,
      "id_layanan_pendaftaran": 1652,
      "jenis": "Rawat Inap",
      "tanggal": "2022-03-01",
      "jam": "09:27:15",
      "layanan": [{
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
      }]
  }
],
```

# STEP 4 : Find this comment `=== [CONFIG_AUTOCOMPLETE_HOOK] ===` in the file `./output/index.html`, and insert the code below on the line following that comment
```js
// DIAGNOSA BANDING / SEMENTARA
function configDiagnosaBanding(data) {
  return {
    element: "#icdx_auto_banding",
    url: "/api/emr/autocomplete?source_name=diagnosa",
    markup_template: function (repo) {
      return `<b>${repo.icd_x}</b> | ${repo.deskripsi}`;
    },
    selection_template: function (repo) {
      var res = "";
      if (repo.icd_x != undefined) {
        DIAGNOSA_BANDING_TMP = [
          { icd_x: repo.icd_x, nama_sebab_sakit: repo.deskripsi },
        ];
        res = repo.icd_x + " - " + repo.deskripsi;
      }

      return res;
    },
  };
}
```

# STEP 5 : Find this comment `=== [AUTOCOMPLETE_HOOK] ===` in the file `./output/index.html`, and insert the code below on the line following that comment
```js
autocomplete(configDiagnosaBanding(data));
```

# STEP 6 : Find this comment `=== [SAVE_ACTION_HOOK] ===` in the file `./output/index.html`, and insert the code below on the line following that comment
```js
this.diagnosa_banding_group = combineDiagnoses(this.diagnosa_banding_freetext, this.diagnosa_banding_autocomplete );
```

# STEP 7 : Find this comment `=== [METHOD_HOOK] ===` in the file `./output/index.html`, and insert the code below on the line following that comment
```js
add_diagnosa_banding: function () {
    this.diagnosa_banding_autocomplete.push(...DIAGNOSA_BANDING_TMP)
},
del_diagnosa_banding: function (i) {
    if (i > -1) this.diagnosa_banding_autocomplete.splice(i, 1);
}
```

# STEP 8 : Find this comment `=== [BRIDGING_MODALS_HOOK] ===` in the file `./output/index.html`, and insert the code below on the line following that comment
Important Note : Include everything; don't cut anything out or change anything.
```html
<!--FORM DIAGNOSA BANDING / SEMENTARA-->
<div class="row">
  <div class="col-md-12 row mt-1">
    <label for="text_diag_banding" class="col-md-12 col-form-label pb-0">
      <span class="pt-2"><b>DIAGNOSIS BANDING</b></span>
    </label>
  </div>
  <div class="col-md-12 mt-2">
    <div class="row">
      <div class="col-md-12">
        <textarea
          type="text"
          id="text_diag_banding"
          class="form-control"
          v-model="diagnosa_banding_freetext"
        ></textarea>
      </div>
    </div>
    <div class="row">
      <div class="col-md-9">
        <select
          id="icdx_auto_banding"
          class="form-control"
          style="width:100%;"
        ></select>
      </div>
      <div class="col-md-3">
        <p class="text-left" style="margin-top: 3px">
          <button
            type="button"
            @click="add_diagnosa_banding()"
            class="btn btn-sm btn-success w-100"
          >
            <i class="fa fa-plus"></i> Tambah Diagnosa Banding</button
          >&ensp;
        </p>
      </div>
    </div>
  </div>
  <div class="col-md-12 mt-2">
    <div
      class="row"
      v-for="(item, key) in diagnosa_banding_autocomplete"
      :key="key"
    >
      <div class="col-sm-1 text-left mt-2">{{ key + 1 }}</div>
      <div class="col-sm-10 mt-2">
        {{ item.icd_x }} - {{ item.nama_sebab_sakit }} | {{ item.deskripsi }}
      </div>
      <div class="col-sm-1 mt-2 text-end">
        <button
          type="button"
          @click="del_diagnosa_banding(key)"
          class="btn btn-sm btn-danger"
        >
          <i class="fa fa-trash"></i>
        </button>
      </div>
    </div>
  </div>
</div>
```

# IMPORTANT NOTES OVERALL:
1. All code snippets above must be entered in full without any changes. Additionally, all code must remain identical and must not be altered or omitted when inserted into the `.output/index.html` file.
2. Work through and understand each step carefully, so that if this skill is called upon again, you can use it consistently don’t leave anything out.
