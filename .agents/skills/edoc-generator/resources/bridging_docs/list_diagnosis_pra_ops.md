---
name: code-snippet-bridging-list-diagnosis-pra-ops
description: This document contains standard code snippet for integrating List Diagnosis Pra Ops Bridging. AI agents MUST paste these code snippets exactly as provided, without cutting or altering the existing logic.
---

# STEP 0 : Understanding and required information
1. Detailed information about the data bridging methods to be used
2. A detailed explanation of the related objects
3. Understand everything and proceed through all the steps

# STEP 1 : Insert this code into the `./output/config.json` file at the very end of the `external_link` object
```json
"operation_data" : {
    "source_type": "ws",
    "source" : "[simrs]/e_doc_api/visitation/operation/<reg_number>",
    "data_usage" : ["copy"]
}
```

# STEP 2 : Add this object to the end of `sample` and `default` in the `./output/json` file
```json
"diagnosa_pra_ops_freetext" : "",
"diagnosa_pra_ops_group" : "",
"diagnosa_pra_ops_list" : []
```

# STEP 3 : Insert the code below into the `./output/json.js` file, at the very bottom of the `external_link` object
Important Note : Include everything; don't cut anything out or change anything
```json
"operation_data" : [
    {
      "no_register":"2210030030",
      "id_pasien":"00010155",
      "id_pendaftaran":5759,
      "id_layanan_pendaftaran":5824,
      "no_registrasi_operasi":"00000002",
      "id_kamar_operasi":2,
      "mulai_operasi":"2022-10-03 17:15:00",
      "selesai_operasi":"2022-10-03 17:40:00",
      "status":"Confirmed",
      "deskripsi_pra_ops":"gigi terpendam",
      "deskripsi_pasca_ops":"post odontectomy. jahitan (+), bleeding (-)",
      "nama_kamar_operasi":"Kamar Operasi Minor",
      "operasi":[
        {
          "id_bobot_operasi":12,
          "nama_layanan":"Pencabuatan Kelas Emergency",
          "nama_bobot_operasi":"OPERASI SEDANG 2"
        }
      ],
      "diagnosa_pra_ops":[
        {
          "id_sebab_sakit":3684,
          "kode_sebab_sakit":"K010",
          "nama_sebab_sakit":"Embedded teeth",
          "icd_x":"K01.0"
        },
        {
          "id_sebab_sakit":3684,
          "kode_sebab_sakit":"K010",
          "nama_sebab_sakit":"Embedded teeth",
          "icd_x":"K01.0"
        }
      ],
      "diagnosa_pasca_ops":[
        {
          "id_sebab_sakit":32568,
          "kode_sebab_sakit":"Z489",
          "nama_sebab_sakit":"Surgical follow-up care, unspecified",
          "icd_x":"Z48.9"
        }
      ]
    },
    {
      "no_register":"2210030030",
      "id_pasien":"00010155",
      "id_pendaftaran":5759,
      "id_layanan_pendaftaran":5824,
      "no_registrasi_operasi":"00000002",
      "id_kamar_operasi":2,
      "mulai_operasi":"2022-10-03 17:15:00",
      "selesai_operasi":"2022-10-03 17:40:00",
      "status":"Confirmed",
      "deskripsi_pra_ops":"gigi terpendam",
      "deskripsi_pasca_ops":"post odontectomy. jahitan (+), bleeding (-)",
      "nama_kamar_operasi":"Kamar Operasi Minor",
      "operasi":[
        {
          "id_bobot_operasi":12,
          "nama_layanan":"Pencabuatan Kelas Emergency",
          "nama_bobot_operasi":"OPERASI SEDANG 2"
        }
      ],
      "diagnosa_pra_ops":[
        {
          "id_sebab_sakit":3684,
          "kode_sebab_sakit":"K010",
          "nama_sebab_sakit":"Embedded teeth",
          "icd_x":"K01.0"
        },
        {
          "id_sebab_sakit":3684,
          "kode_sebab_sakit":"K010",
          "nama_sebab_sakit":"Embedded teeth",
          "icd_x":"K01.0"
        }
      ],
      "diagnosa_pasca_ops":[
        {
          "id_sebab_sakit":32568,
          "kode_sebab_sakit":"Z489",
          "nama_sebab_sakit":"Surgical follow-up care, unspecified",
          "icd_x":"Z48.9"
        }
      ]
    }
],
```

# STEP 4 : Find this comment `=== [CONFIG_AUTOCOMPLETE_HOOK] ===` in the file `./output/index.html`, and insert the code below on the line following that comment
```js
function configDiagnosaPraOps(data) {
  return {
    element: "#pra_ops_auto",
    url: "/api/emr/autocomplete?source_name=diagnosa",
    markup_template: function (repo) {
      return `<b>${repo.icd_x}</b> | ${repo.deskripsi}`;
    },
    selection_template: function (repo) {
      var res = "";
      if (repo.icd_x != undefined) {
        if (repo.icd_x == "Belum diketahui") {
          DIAGNOSA_TMP = [{ icd_x: "", nama_sebab_sakit: repo.deskripsi }];
          res = repo.icd_x + " - " + repo.deskripsi;
        } else {
          DIAGNOSA_TMP = [
            { icd_x: repo.icd_x, nama_sebab_sakit: repo.deskripsi },
          ];
          res = repo.icd_x + " - " + repo.deskripsi;
        }
      }
      return res;
    },
  };
}
```

# STEP 5 : Find this comment `=== [SETUPINDEXEXPAND_HOOK] ===` in the file `./output/index.html`, and insert the code below on the line following that comment
```js
setupIndexExpand( data, "index_expand_pra_ops", "operation_data", "diagnosa_pra_ops");
```

# STEP 6 : Find this comment `=== [AUTOCOMPLETE_HOOK] ===` in the file `./output/index.html`, and insert the code below on the line following that comment
```js
autocomplete(configDiagnosaPraOps(data));
```

# STEP 7 : Find this comment `=== [SAVE_ACTION_HOOK] ===` in the file `./output/index.html`, and insert the code below on the line following that comment
```js
this.diagnosa_pra_ops_group = combineDiagnoses(this.diagnosa_pra_ops_freetext, this.diagnosa_pra_ops_list);
```

# STEP 8 : Find this comment `=== [METHOD_HOOK] ===` in the file `./output/index.html`, and insert the code below on the line following that comment
```js
savePraOps: function () {
    this.diagnosa_pra_ops_freetext = "";
    let no = 1;
    this.external_link.operation_data.forEach((x, i) => {
        x.diagnosa_pra_ops.forEach((v, j) => {
            if (this.index_expand_pra_ops[i][j].selected) {
                const pra_ops = this.external_link.operation_data[i].diagnosa_pra_ops[j];
                this.diagnosa_pra_ops_freetext += `${no}. ${pra_ops.kode_sebab_sakit} - ${pra_ops.nama_sebab_sakit}\n`;
                no++;
            }
        });
    });
    this.diagnosa_pra_ops_freetext = this.diagnosa_pra_ops_freetext.trim();
    $("#hasilPraOpsModal").modal("toggle");
},
add_diagnosa_pra_ops: function(){
    this.diagnosa_pra_ops_list.push(...DIAGNOSA_TMP)
},
del_diagnosa_pra_ops: function(i){
    if(i > -1){
        this.diagnosa_pra_ops_list.splice(i,1);
    }
},
```

# STEP 9 : Find this comment `=== [BRIDGING_INIT_ADD_HOOK] ===` in the file `./output/index.html`, and insert the code below on the line following that comment
```js
{
    label: "Bridging List Diagnosa Pra Operasi",
    functionName: bridgingPraOps,
    parameters: [data]
},
```

# STEP 10 : Find this comment `=== [BRIDGING_INIT_EDIT_HOOK] ===` in the file `./output/index.html`, and insert the code below on the line following that comment
```js
{
    label: "Bridging List Diagnosa Pra Operasi [EDIT]",
    functionName: bridgingPraOps,
    parameters: [data]
},
```

# STEP 11 : Find this comment `=== [BRIDGING_FUNCTION_HOOK] ===` in the file `./output/index.html`, and insert the code below on the line following that comment
```js
function bridgingPraOps(data) {
  if (data.external_link.operation_data.length === 1) {
    let hasil_pra_ops = "";
    data.external_link.operation_data.forEach((v, i) => {
      v.diagnosa_pra_ops.forEach((x, j) => {
        hasil_pra_ops += `${j + 1}. ${x.kode_sebab_sakit} - ${x.nama_sebab_sakit}\n`;
      });
    });

    if (!data.diagnosa_pra_ops_freetext.trim() && hasil_pra_ops.trim()) {
      data.diagnosa_pra_ops_freetext = hasil_pra_ops.trim();
    }
  }
}
```

# STEP 12 : Find this comment `=== [BRIDGING_MODALS_HOOK] ===` in the file `./output/index.html`, and insert the code below on the line following that comment
Important Note : Include everything; don't cut anything out or change anything.
```html
<!--START PRA OPS MODAL-->
<div
  class="modal fade"
  id="hasilPraOpsModal"
  tabindex="-1"
  role="dialog"
  aria-labelledby="hasilPraOpsModalTitle"
  aria-hidden="true"
>
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Hasil Diagnosa Pra Bedah</h5>
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
            v-for="(jenisLayanan, i) in external_link.operation_data"
            :key="i"
          >
            <h6 v-if="jenisLayanan.diagnosa_pra_ops.length > 0">
              <u
                >{{jenisLayanan.mulai_operasi}} -
                {{jenisLayanan.selesai_operasi}}</u
              >
            </h6>
            <div
              v-for="(OperationItem,j) in jenisLayanan.diagnosa_pra_ops"
              :key="j"
              class="mb-1 mx-2"
            >
              <div
                class="col-12 row justify-content-between px-3 rounded border-bottom font-weight-bold"
                :class="{'bg-primary':index_expand_pra_ops[i][j].expand, 'bg-light': !index_expand_pra_ops[i][j].expand }"
              >
                <label
                  style="cursor: pointer"
                  :for="'customCheckPraOps'+i+j"
                  class="nav-link col mb-0"
                  :class="{'text-white':index_expand_pra_ops[i][j].expand}"
                  @click="navCollapse(i, j, 'index_expand_pra_ops')"
                >
                  {{ OperationItem.kode_sebab_sakit }} - {{
                  OperationItem.nama_sebab_sakit }}
                </label>
                <div class="nav-link">
                  <div class="custom-control custom-checkbox">
                    <input
                      type="checkbox"
                      @change="checkAllBridgingList('index_expand_pra_ops', true)"
                      class="custom-control-input"
                      :id="'customCheckPraOps'+i+j"
                      v-model="index_expand_pra_ops[i][j].selected"
                    />
                    <label
                      class="custom-control-label"
                      :for="'customCheckPraOps'+i+j"
                    ></label>
                  </div>
                </div>
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
                id="checkAllButtonPraOps"
                type="checkbox"
                @change="checkAllBridgingList('index_expand_pra_ops')"
                v-model="index_expand_pra_ops_check_all"
              />
            </div>
          </div>
          <label
            for="checkAllButtonPraOps"
            class="form-check-label font-weight-bold rounded-right"
            style="padding: 0.375rem 0.75rem; border: 1px solid #ced4da; display: flex; align-items: center; font-size: 16px"
          >
            Pilih semua
          </label>
        </div>
        <button type="button" class="btn btn-primary" @click="savePraOps">
          Simpan
        </button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">
          Tutup
        </button>
      </div>
    </div>
  </div>
</div>
<!--END PRA OPS MODAL-->
```

# STEP 13 : Add the modal button and textarea code below to the location specified in the prompt.
```html
<!-- Diagnosa Pra Ops / Pra Bedah -->
<div class="row">
  <div class="col-md-12 mb-2">
    <label for="diagnosa_pra_ops" class="mb-0">
      Diagnosa Pra Bedah
      <button
        v-if="external_link?.operation_data?.length > 1 &&
                      external_link?.operation_data?.some(op => op.diagnosa_pra_ops && op.diagnosa_pra_ops.length > 0)"
        type="button"
        title="Pra Ops"
        data-toggle="modal"
        data-target="#hasilPraOpsModal"
        class="btn btn-info btn-sm"
      >
        Hasil Diagnosa Pra Bedah
      </button>
    </label>
    <textarea
      type="text"
      style="white-space: pre-wrap"
      class="form-control"
      v-model="diagnosa_pra_ops_freetext"
      id="diagnosa_pra_ops"
      rows="4"
    ></textarea>
  </div>
  <div class="col-md-12">
    <div class="row mb-2 justify-content-center">
      <div class="col-md-8 pr-0">
        <select
          class="form-control"
          id="pra_ops_auto"
          name="pra_ops_tmp"
          style="width: 100%"
        ></select>
      </div>
      <div class="col-md-4 text-right">
        <button
          type="button"
          style="width: 100%; height: 100%"
          @click="add_diagnosa_pra_ops()"
          class="btn btn-sm btn-success"
        >
          <i class="fa fa-plus"></i>
          Tambah Diagnosa
        </button>
      </div>
    </div>
  </div>
  <div
    class="col-md-12"
    v-for="(item, key) in diagnosa_pra_ops_list"
    :key="key"
  >
    <div class="row mb-2">
      <div class="col-md-10">
        <div class="">
          {{key+1}}. {{item.icd_x}} - {{item.nama_sebab_sakit}}
        </div>
      </div>
      <div class="col-md-2 text-right">
        <button
          type="button"
          @click="del_diagnosa_pra_ops(key)"
          class="btn btn-sm btn-danger"
        >
          <i class="fa fa-trash"></i>
        </button>
      </div>
    </div>
  </div>
</div>
<!-- Diagnosa Pra Ops / Pra Bedah -->
```

# IMPORTANT NOTES OVERALL:
1. All code snippets above must be entered in full without any changes. Additionally, all code must remain identical and must not be altered or omitted when inserted into the `.output/index.html` file.
2. Work through and understand each step carefully, so that if this skill is called upon again, you can use it consistently don’t leave anything out.
