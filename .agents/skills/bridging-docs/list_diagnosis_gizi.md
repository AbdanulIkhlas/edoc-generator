---
name: code-snippet-bridging-list-diagnosis-gizi
description: This document contains standard code snippet for integrating List Diagnosis Gizi Bridging. AI agents MUST paste these code snippets exactly as provided, without cutting or altering the existing logic.
---

# STEP 0 : Understanding and required information
1. Detailed information about the data bridging methods to be used
2. A detailed explanation of the related objects
3. Understand everything and proceed through all the steps

# STEP 1 : Insert this code into the `./output/config.json` file at the very end of the `external_link` object
```json
"diet_data": {
    "source_type": "ws",
    "source": "[simrs]/e_doc_api/visitation/diet/<reg_number>",
    "data_usage": ["copy"]
}
```

# STEP 2 : Add this object to the end of `sample` and `default` in the `./output/json` file
```json
"diagnosa_gizi_group": "",
"diagnosa_gizi_freetext": "",
"diagnosa_gizi_list_autocomplete": []
```

# STEP 3 : Insert the code below into the `./output/json.js` file, at the very bottom of the `external_link` object
Important Note : Include everything; don't cut anything out or change anything
```json
"diet_data": [
  {
      "no_register": "2507190489",
      "id_pasien": "301754",
      "id_pendaftaran": 979254,
      "id_layanan_pendaftaran": 1075145,
      "diet": [
          {
              "id_lp_diet": 24673,
              "nama_makanan_pokok": "ML",
              "ket_diet": "",
              "waktu_pemberian": "Siang",
              "jam_pemberian": "14:00"
          },
          {
              "id_lp_diet": 24673,
              "nama_makanan_pokok": "ML",
              "ket_diet": "",
              "waktu_pemberian": "Sore",
              "jam_pemberian": "19:00"
          }
      ],
      "diagnosa_gizi": [
          {
              "id_diet_diagnosa_gizi": 70,
              "nama_diet_diagnosa_gizi": "Perilaku dan Kepercayaan yang Tidak Mendukung Terkait dengan Makanan dan Zat Gizi (Gunakan dengan Hati-hati)",
              "kode_nama": "NB.1.2 - Perilaku dan Kepercayaan yang Tidak Mendukung Terkait dengan Makanan dan Zat Gizi (Gunakan dengan Hati-hati)",
              "deskripsi_diet_diagnosa_gizi": "testingggg"
          },
          {
              "id_diet_diagnosa_gizi": 13,
              "nama_diet_diagnosa_gizi": "Kurang dalam mengontrol diri",
              "kode_nama": "NB.1.4 - Kurang dalam mengontrol diri",
              "deskripsi_diet_diagnosa_gizi": "testing 1"
          },
          {
              "id_diet_diagnosa_gizi": 77,
              "nama_diet_diagnosa_gizi": "Asupan Makanan yang Tidak Aman",
              "kode_nama": "NB.3.1 - Asupan Makanan yang Tidak Aman",
              "deskripsi_diet_diagnosa_gizi": "testing 2"
          },
          {
              "id_diet_diagnosa_gizi": 3,
              "nama_diet_diagnosa_gizi": "Kekurangan intake oral",
              "kode_nama": "NI.2.1 - Kekurangan intake oral",
              "deskripsi_diet_diagnosa_gizi": "Asupan oral inadekuat berkaitan dengan nafsu makan kurang baik ditandai dengan intake makan 50%."
          },
          {
              "id_diet_diagnosa_gizi": 4,
              "nama_diet_diagnosa_gizi": "Peningkatan kebutuhan zat gizi tertentu",
              "kode_nama": "NI.5.1 - Peningkatan kebutuhan zat gizi tertentu",
              "deskripsi_diet_diagnosa_gizi": "Peningkatan kebutuhan energi dan protein berkaitan dengan adanya penyakit infeksi ditandai dengan kadar trombosit di bawah normal"
          }
      ]
  }
],
```

# STEP 4 : Find this comment `=== [CONFIG_AUTOCOMPLETE_HOOK] ===` in the file `./output/index.html`, and insert the code below on the line following that comment
```js
function configDiagnosaGizi(data) {
  return {
    element: "#diagnosa_gizi_auto",
    url: "/api/emr/autocomplete?source_name=diet",
    markup_template: function (repo) {
      return `<b>${repo.icd_x}</b> | ${repo.deskripsi}`;
    },
    selection_template: function (repo) {
      var res = "";
      if (repo.icd_x != undefined) {
        DIAGNOSA_GIZI_TMP = [
          {
            kode_nama: repo.kode_nama,
            deskripsi_diet_diagnosa_gizi: repo.deskripsi_diet_diagnosa_gizi,
          },
        ];
        res = repo.kode_nama + " - " + repo.deskripsi_diet_diagnosa_gizi;
      }
      return res;
    },
  };
}
```

# STEP 5 : Find this comment `=== [SETUPINDEXEXPAND_HOOK] ===` in the file `./output/index.html`, and insert the code below on the line following that comment
```js
setupIndexExpand(data, "index_expand_diagnosa_gizi", "diet_data", "diagnosa_gizi");
```

# STEP 6 : Find this comment `=== [AUTOCOMPLETE_HOOK] ===` in the file `./output/index.html`, and insert the code below on the line following that comment
```js
autocomplete(configDiagnosaGizi(data));
```

# STEP 7 : Find this comment `=== [SAVE_ACTION_HOOK] ===` in the file `./output/index.html`, and insert the code below on the line following that comment
```js
this.diagnosa_gizi_group = combineDiagnoses(this.diagnosa_gizi_freetext, this.diagnosa_gizi_list_autocomplete);
```

# STEP 8 : Find this comment `=== [METHOD_HOOK] ===` in the file `./output/index.html`, and insert the code below on the line following that comment
```js
saveDiagUtamaGizi: function () {
    this.diagnosa_gizi_freetext = "";
    let no = 1;

    this.index_expand_diagnosa_gizi.forEach((v, i) => {
        v.forEach((x, j) => {
            if (x.selected) {
                const diag = this.external_link.diet_data[i].diagnosa_gizi[j];
                this.diagnosa_gizi_freetext += `${no}. ${diag.kode_nama} - ${diag.deskripsi_diet_diagnosa_gizi}\n`;
                no++;
            }
        })
    })

    $('#hasilDiagUtamaGiziModal').modal('toggle');
},
addDiagnosaGizi: function () {
    this.diagnosa_gizi_list_autocomplete.push(...DIAGNOSA_GIZI_TMP)
},
delDiagnosaGizi: function (i) {
    if (i > -1) this.diagnosa_gizi_list_autocomplete.splice(i, 1);
},
```

# STEP 9 : Find this comment `=== [BRIDGING_INIT_ADD_HOOK] ===` in the file `./output/index.html`, and insert the code below on the line following that comment
```js
{
    label: "Bridging List Diagnosa Gizi",
    functionName: bridgingListDiagnosisGizi,
    parameters: [data]
},
```

# STEP 10 : Find this comment `=== [BRIDGING_INIT_EDIT_HOOK] ===` in the file `./output/index.html`, and insert the code below on the line following that comment
```js
{
    label: "Bridging List Diagnosa Gizi [EDIT]",
    functionName: bridgingListDiagnosisGizi,
    parameters: [data]
},
```

# STEP 11 : Find this comment `=== [BRIDGING_FUNCTION_HOOK] ===` in the file `./output/index.html`, and insert the code below on the line following that comment
```js
function bridgingListDiagnosisGizi(data) {
  if (
    Array.isArray(data.external_link.diet_data) &&
    data.external_link.diet_data.length === 1
  ) {
    let hasilDiagnosa = "";
    const dietEntry = data.external_link.diet_data[0];

    if (
      Array.isArray(dietEntry.diagnosa_gizi) &&
      dietEntry.diagnosa_gizi.length > 0
    ) {
      dietEntry.diagnosa_gizi.forEach((v, i) => {
        hasilDiagnosa += `${i + 1}. ${v.kode_nama} - ${v.deskripsi_diet_diagnosa_gizi}\n`;
      });

      if (!data.diagnosa_gizi_freetext.trim() && hasilDiagnosa.trim()) {
        data.diagnosa_gizi_freetext = hasilDiagnosa;
      }
    }
  }
}
```

# STEP 12 : Find this comment `=== [BRIDGING_MODALS_HOOK] ===` in the file `./output/index.html`, and insert the code below on the line following that comment
Important Note : Include everything; don't cut anything out or change anything.
```html
<!--START DIAGNOSA GIZI MODAL-->
<div
  class="modal fade"
  id="hasilDiagUtamaGiziModal"
  tabindex="-1"
  role="dialog"
  aria-labelledby="hasilDiagUtamaGiziModalTitle"
  aria-hidden="true"
>
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Hasil Diagnosa Gizi</h5>
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
          <div
            class="mb-3"
            v-for="(visitData, i) in external_link.diet_data"
            :key="i"
          >
            <div
              v-for="(dietItem, j) in visitData.diagnosa_gizi"
              :key="j"
              class="mb-1 mx-2 pl-4"
            >
              <div
                class="col-12 row justify-content-between px-3 rounded border-bottom font-weight-bold"
                :class="{'bg-primary':index_expand_diagnosa_gizi[i][j].expand, 'bg-light': !index_expand_diagnosa_gizi[i][j].expand }"
              >
                <a
                  class="nav-link col"
                  :class="{'text-white':index_expand_diagnosa_gizi[i][j].expand}"
                  href="javascript:;"
                  data-toggle="collapse"
                  role="button"
                  :aria-expanded="index_expand_diagnosa_gizi[i][j].expand"
                  @click.prevent="navCollapse(i, j, 'index_expand_diagnosa_gizi')"
                >
                  <span class="nav-link-text">{{dietItem.kode_nama}}</span>
                </a>
                <div class="nav-link">
                  <div class="custom-control custom-checkbox">
                    <input
                      type="checkbox"
                      class="custom-control-input"
                      :id="'customCheckDiagGizi'+i+j"
                      @change="checkAllBridgingList('index_expand_diagnosa_gizi', true, null, 'diet_data', 'diagnosa_gizi')"
                      v-model="index_expand_diagnosa_gizi[i][j].selected"
                    />
                    <label
                      class="custom-control-label"
                      :for="'customCheckDiagGizi'+i+j"
                    ></label>
                  </div>
                </div>
              </div>
              <div
                class="col-12 border rounded row collapse"
                :class="{ show : index_expand_diagnosa_gizi[i][j].expand }"
              >
                <p class="nav-link mb-0">
                  {{dietItem.deskripsi_diet_diagnosa_gizi}}
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
                id="checkAllButtonDiagnosisGizi"
                type="checkbox"
                @change="checkAllBridgingList('index_expand_diagnosa_gizi', false, null, 'diet_data', 'diagnosa_gizi')"
                v-model="index_expand_diagnosa_gizi_check_all"
              />
            </div>
          </div>
          <label
            for="checkAllButtonDiagnosisGizi"
            class="form-check-label font-weight-bold rounded-right"
            style="padding: 0.375rem 0.75rem; border: 1px solid #ced4da; display: flex; align-items: center; font-size: 16px"
          >
            Pilih semua
          </label>
        </div>
        <button
          type="button"
          class="btn btn-primary mb-0"
          @click="saveDiagUtamaGizi"
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
<!--END DIAGNOSA GIZI MODAL-->
```

# STEP 13 : Add the modal button and textarea code below to the location specified in the prompt.
```html
<div class="row">
  <div class="col-md-12">
    <label for="diagnosa_gizi_freetext" class="col-form-label">
      <b>Diagnosis Gizi</b>
      <button
        v-if="
                    Array.isArray(external_link?.diet_data) &&
                    external_link.diet_data.length > 0 &&
                    Array.isArray(external_link.diet_data[0].diagnosa_gizi) &&
                    external_link.diet_data[0].diagnosa_gizi.length > 1
                "
        type="button"
        title="Riwayat diagnosa gizi"
        data-toggle="modal"
        data-target="#hasilDiagUtamaGiziModal"
        class="btn btn-info btn-sm"
      >
        Pilih Diagnosis Gizi
      </button>
    </label>
  </div>
  <div class="col-md-12">
    <textarea
      type="text"
      style="white-space: pre-wrap"
      class="form-control"
      v-model="diagnosa_gizi_freetext"
      id="diagnosa_gizi_freetext"
    ></textarea>
    <div class="row">
      <div class="col-md-12">
        <div class="row mb-2 justify-content-center">
          <div class="col-md-8 pr-0">
            <select
              class="form-control"
              id="diagnosa_gizi_auto"
              name="diagnosa_gizi_tmp"
              style="width: 100%"
            ></select>
          </div>
          <div class="col-md-4 text-right">
            <button
              type="button"
              style="width: 100%; height: 100%"
              @click="addDiagnosaGizi()"
              class="btn btn-sm btn-success"
            >
              <i class="fa fa-plus"></i>
              Tambah Data
            </button>
          </div>
        </div>
      </div>
      <div
        class="col-md-12"
        v-for="(item, key) in diagnosa_gizi_list_autocomplete"
        :key="key"
      >
        <div class="row mb-2">
          <div class="col-md-10">
            <div class="">
              {{key+1}}. {{item.kode_nama}} -
              {{item.deskripsi_diet_diagnosa_gizi}}
            </div>
          </div>
          <div class="col-md-2 text-right">
            <button
              type="button"
              @click="delDiagnosaGizi(key)"
              class="btn btn-sm btn-danger"
            >
              <i class="fa fa-trash"></i>
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
```

# IMPORTANT NOTES OVERALL:
1. All code snippets above must be entered in full without any changes. Additionally, all code must remain identical and must not be altered or omitted when inserted into the `.output/index.html` file.
2. Work through and understand each step carefully, so that if this skill is called upon again, you can use it consistently don’t leave anything out.
