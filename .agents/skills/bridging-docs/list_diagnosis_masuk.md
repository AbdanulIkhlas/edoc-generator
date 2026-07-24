---
name: code-snippet-bridging-list-diagnosis-masuk
description: This document contains standard code snippet for integrating List Diagnosis Masuk Bridging. AI agents MUST paste these code snippets exactly as provided, without cutting or altering the existing logic.
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
"diagnosa_masuk_group" : "",
"diagnosa_masuk_freetext": "",
"diagnosa_masuk_autocomplete": []
```

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
// DIAGNOSA MASUK / KERJA / UTAMA
function configDiagnosaMasuk(data) {
  return {
    element: "#icdx_auto_masuk",
    url: "/api/emr/autocomplete?source_name=diagnosa",
    markup_template: function (repo) {
      return `<b>${repo.icd_x}</b> | ${repo.deskripsi}`;
    },
    selection_template: function (repo) {
      var res = "";
      if (repo.icd_x != undefined) {
        DIAGNOSA_MASUK_TMP = [
          { icd_x: repo.icd_x, nama_sebab_sakit: repo.deskripsi },
        ];
        res = repo.icd_x + " - " + repo.deskripsi;
      }
      return res;
    },
  };
}
```

# STEP 5 : Find this comment `=== [SETUPINDEXEXPAND_HOOK] ===` in the file `./output/index.html`, and insert the code below on the line following that comment
```js
setupIndexExpand(data, "index_expand_diagnosa_masuk", "diagnosa_list");
```

# STEP 6 : Find this comment `=== [OTHER_VARIABLE_BRIDGING_HOOK] ===` in the file `./output/index.html`, and insert the code below on the line following that comment
```js
data.backup_diagnosa_masuk = [];
data.backup_diagnosa_masuk_check_all = false;
data.is_saving_diag_masuk = false;
```

# STEP 7 : Find this comment `=== [MOUNTED_HOOK] ===` in the file `./output/index.html`, and insert the code below on the line following that comment
```js
 $('#hasilDiagMasukModal').on('hidden.bs.modal', () => {
    if (!this.is_saving_diag_masuk && this.backup_diagnosa_masuk.length > 0) {
        this.index_expand_diagnosa_masuk = JSON.parse(JSON.stringify(this.backup_diagnosa_masuk));
        this.index_expand_diagnosa_masuk_check_all = this.backup_diagnosa_masuk_check_all;
    }
    this.is_saving_diag_masuk = false;
});
```

# STEP 8 : Find this comment `=== [AUTOCOMPLETE_HOOK] ===` in the file `./output/index.html`, and insert the code below on the line following that comment
```js
autocomplete(configDiagnosaMasuk(data));
```

# STEP 9 : Find this comment `=== [BRIDGING_HOOK] ===` in the file `./output/index.html`, and insert the code below on the line following that comment
```js
this.bridgingListDiagnosis();
```

# STEP 10 : Find this comment `=== [SAVE_ACTION_HOOK] ===` in the file `./output/index.html`, and insert the code below on the line following that comment
```js
this.diagnosa_masuk_group = combineDiagnoses(this.diagnosa_masuk_freetext, this.diagnosa_masuk_autocomplete);
```

# STEP 11 : Find this comment `=== [METHOD_HOOK] ===` in the file `./output/index.html`, and insert the code below on the line following that comment
```javascript
backupDiagMasukData: function () {
    this.backup_diagnosa_masuk = JSON.parse(JSON.stringify(this.index_expand_diagnosa_masuk));
    this.backup_diagnosa_masuk_check_all = this.index_expand_diagnosa_masuk_check_all;
    this.is_saving_diag_masuk = false;
},
saveDiagMasuk: function(){
    this.is_saving_diag_masuk = true;
    this.diagnosa_masuk_freetext = "";
    let no = 1;

    this.index_expand_diagnosa_masuk.forEach((v,i) => {
        v.forEach((x,j) => {
            if(x.selected){
                const diag = this.external_link.diagnosa_list[i].layanan[j];
                this.diagnosa_masuk_freetext += `${no}. ${diag.icd_x} - ${diag.nama_sebab_sakit} ${diag.deskripsi ? "- " + diag.deskripsi : ""}\n`;
                no++;
            }
        })
    })

    $('#hasilDiagMasukModal').modal('hide');
},
add_diagnosa_masuk: function () {
    this.diagnosa_masuk_autocomplete.push(...DIAGNOSA_MASUK_TMP)
},
del_diagnosa_masuk: function (i) {
    if (i > -1) this.diagnosa_masuk_autocomplete.splice(i, 1);
},
```

# STEP 12 : Find this comment `=== [METHOD_HOOK] ===` in the file `./output/index.html`, and insert the code below on the line following that comment
Important Note : Before adding it, first check whether this method already exists. If it doesn't, add it; if it does, don't add it to avoid duplication.
```javascript
bridgingListDiagnosis(tipe = null) {
    if (!tipe) {
        if (data.external_link.diagnosa_list.length === 1) {
            let hasilDiagnosa = "";
            let counter = 1;

            data.external_link.diagnosa_list[0].layanan.forEach((v) => {
                hasilDiagnosa += `${counter}. ${v.icd_x} - ${v.nama_sebab_sakit} ${v.deskripsi ? "- " + v.deskripsi : ""}\n`;
                counter++;
            });
            data.diagnosa_masuk_freetext = hasilDiagnosa;
        }
    } else {
        const total = this.countDiagnosa(tipe);
        if (total >= 1) {
            let hasilDiagnosa = "";
            let counter = 1;

            data.external_link.diagnosa_list.forEach(diagnosa => {
                diagnosa.layanan.forEach((v) => {
                    if (v.primer === tipe) {
                        hasilDiagnosa += `${counter}. ${v.icd_x} - ${v.nama_sebab_sakit} ${v.deskripsi ? "- " + v.deskripsi : ""}\n`;
                        counter++;
                    }
                });
            });

            if (tipe === "Primer") {
                data.diagnosa_primer_freetext = hasilDiagnosa;
            } else {
                data.diagnosa_sekunder_freetext = hasilDiagnosa;
            }
        }
    }
},
```


# STEP 13 : Find this comment `=== [BRIDGING_MODALS_HOOK] ===` in the file `./output/index.html`, and insert the code below on the line following that comment
Important Note : Include everything; don't cut anything out or change anything.
```html
<!--START DIAGNOSA MASUK MODAL-->
<div
  class="modal fade"
  id="hasilDiagMasukModal"
  tabindex="-1"
  role="dialog"
  aria-labelledby="hasilDiagUtamaModalTitle"
  aria-hidden="true"
>
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Hasil Diagnosa Masuk</h5>
        <button
          type="button"
          class="close"
          data-dismiss="modal"
          aria-label="Close"
        >
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div>
          <!--Looping Jenis kunjungan-->
          <div
            class="mb-3"
            v-for="(jenisLayanan, i) in external_link.diagnosa_list"
            :key="i"
          >
            <h6>
              <u
                >{{jenisLayanan.jenis}} {{jenisLayanan.tanggal}}
                {{jenisLayanan.jam}}</u
              >
            </h6>
            <!--Looping nama layanan Lab-->
            <div
              v-for="(DiagMasukItem, j) in jenisLayanan.layanan"
              :key="j"
              class="mb-1 mx-2"
            >
              <div
                class="col-12 row justify-content-between px-3 rounded border-bottom font-weight-bold"
                :class="{'bg-primary':index_expand_diagnosa_masuk[i][j].expand, 'bg-light': !index_expand_diagnosa_masuk[i][j].expand }"
              >
                <a
                  class="nav-link col"
                  :class="{'text-white':index_expand_diagnosa_masuk[i][j].expand}"
                  href="javascript:;"
                  data-toggle="collapse"
                  role="button"
                  :aria-expanded="index_expand_diagnosa_masuk[i][j].expand"
                  @click.prevent="navCollapse(i, j, 'index_expand_diagnosa_masuk')"
                >
                  <span class="nav-link-text"
                    >{{DiagMasukItem.icd_x}} -
                    {{DiagMasukItem.nama_sebab_sakit}} -
                    {{DiagMasukItem.deskripsi}}</span
                  >
                </a>
                <div class="nav-link">
                  <div class="custom-control custom-checkbox">
                    <input
                      type="checkbox"
                      class="custom-control-input"
                      :id="'customCheckDiagMasuk'+i+j"
                      @change="checkAllBridgingList('index_expand_diagnosa_masuk', true)"
                      v-model="index_expand_diagnosa_masuk[i][j].selected"
                    />
                    <label
                      class="custom-control-label"
                      :for="'customCheckDiagMasuk'+i+j"
                    ></label>
                  </div>
                </div>
              </div>
              <div
                v-if="DiagMasukItem.icd_x"
                class="col-12 border rounded row collapse"
                :class="{ show : index_expand_diagnosa_masuk[i][j].expand }"
              >
                <p class="nav-link mb-0">
                  Hasil:
                  <span v-html="DiagMasukItem.icd_x"></span>
                  <br />
                  {{DiagMasukItem.icd_x}} - {{DiagMasukItem.nama_sebab_sakit}} -
                  {{DiagMasukItem.deskripsi}}
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <div
          class="input-group mb-0"
          style="display: flex; flex-wrap: nowrap; align-items: stretch; width: fit-content; height: 38px"
        >
          <div class="input-group-prepend">
            <div class="input-group-text">
              <input
                id="checkAllButtonDiagnosisMasuk"
                type="checkbox"
                @change="checkAllBridgingList('index_expand_diagnosa_masuk')"
                v-model="index_expand_diagnosa_masuk_check_all"
              />
            </div>
          </div>
          <label
            for="checkAllButtonDiagnosisMasuk"
            class="form-check-label font-weight-bold rounded-right"
            style="padding: 0.375rem 0.75rem; border: 1px solid #ced4da; display: flex; align-items: center; font-size: 16px"
          >
            Pilih semua
          </label>
        </div>
        <button
          type="button"
          class="btn btn-primary mb-0"
          @click="saveDiagMasuk"
        >
          Simpan
        </button>
        <button
          type="button"
          class="btn btn-secondary mb-0"
          data-dismiss="modal"
        >
          Tutup
        </button>
      </div>
    </div>
  </div>
</div>
<!--END DIAGNOSA MASUK MODAL-->
```

# STEP 14 : Add the modal button and textarea code below to the location specified in the prompt.
```html
<!--FORM DIAGNOSA MASUK / KERJA / UTAMA-->
<div class="row">
  <div class="col-md-12 row mt-1">
    <label for="text_diag_masuk" class="col-md-12 col-form-label pb-0">
      <span class="pt-2"><b>DIAGNOSIS MASUK</b></span>
      <button
        type="button"
        title="Diagnosa Masuk"
        data-toggle="modal"
        data-target="#hasilDiagMasukModal"
        class="btn btn-info btn-sm"
        v-if="external_link?.diagnosa_list?.length > 1"
        @click="backupDiagMasukData"
      >
        Hasil Diagnosa Masuk
      </button>
    </label>
  </div>
  <div class="col-md-12 mt-2">
    <div class="row">
      <div class="col-md-12">
        <textarea
          type="text"
          id="text_diag_masuk"
          class="form-control"
          v-model="diagnosa_masuk_freetext"
        ></textarea>
      </div>
    </div>
    <div class="row">
      <div class="col-md-9">
        <select
          id="icdx_auto_masuk"
          class="form-control"
          style="width:100%;"
        ></select>
      </div>
      <div class="col-md-3">
        <p class="text-left" style="margin-top: 3px">
          <button
            type="button"
            @click="add_diagnosa_masuk()"
            class="btn btn-sm btn-success w-100"
          >
            <i class="fa fa-plus"></i> Tambah Diagnosa Masuk</button
          >&ensp;
        </p>
      </div>
    </div>
  </div>
  <div class="col-md-12 mt-2">
    <div
      class="row"
      v-for="(item, key) in diagnosa_masuk_autocomplete"
      :key="key"
    >
      <div class="col-sm-1 text-left mt-2">{{ key + 1 }}</div>
      <div class="col-sm-10 mt-2">
        {{ item.icd_x }} - {{ item.nama_sebab_sakit }} | {{ item.deskripsi }}
      </div>
      <div class="col-sm-1 mt-2 text-end">
        <button
          type="button"
          @click="del_diagnosa_masuk(key)"
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
