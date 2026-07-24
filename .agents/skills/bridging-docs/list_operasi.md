---
name: bridging-list-operasi
description: This document contains standard code snippet for integrating List Operasi Bridging. AI agents MUST paste these code snippets exactly as provided, without cutting or altering the existing logic.
---

# Bridging Module: List Operasi

This document contains standard (_code snippets_) for integrating List Operasi Bridging. AI agents MUST paste these code snippets exactly as provided, without cutting or altering the existing logic.

## 1. Config Block (Inject to `output/config.json` -> `external_link`)

Check whether the relevant key already exists in the `external_link` section of `config.json`.
If it **doesn't exist**, add the following block:
```json
"operation_data" : {
    "source_type": "ws",
    "source" : "[simrs]/e_doc_api/visitation/operation/<reg_number>",
    "data_usage" : ["copy"]
}
```

## 2. Sample Data Block (Inject to output/json.js)

### A. Form Properties (Inject to sample & default)
If this object's property does not yet exist in `data.sample` and `data.default`, add it:

Check `./output/json.js`. If this is a new bridging and the target JSON object does not exist in the `sample`, add the following structure (adjust fields based on needs):

```json
"operasi_freetext" : "",
"operasi_group" : "",
"operasi_list" : []
```

If the JSON object already exists, there is no need to add it. (Inform the agent whether the JSON object is already present).

### B. External Link Dummy Payload (Inject to sample.external_link)

Check `sample.external_link` to see if the key already exists. If it doesn\'t exist, add the following block in its entirety without any modifications:
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

## 3. JS Functions & Vue Methods `(Inject to output/index.html -> <script>)`

### A. Autocomplete Config Function

Add this at the comment `// === [CONFIG_AUTOCOMPLETE_HOOK] ===` alongside other autocomplete configs:
```js
function configOperasi(data) {
  return {
    element: "#operasi_auto",
    url: "/api/emr/autocomplete?source_name=tindakan",
    query_params: {
      kelas: "",
      jenis_tindakan: "",
      jenis: "Pelayanan Pembedahan",
      id_penjamin: "",
    },
    markup_template: function (repo) {
      return `<b>${repo.layanan}<b>`;
    },
    selection_template: function (repo) {
      var res = "";
      if (repo.layanan != undefined) {
        TINDAKAN_TMP = [{ nama_layanan: repo.layanan }];
        res = repo.layanan;
      }
      return res;
    },
  };
}
```

### In `init_doc` (Before Vue initialization)

Inside `init_doc` and before `var app = new Vue({`, add this code at the comment `// === [SETUPINDEXEXPAND_HOOK] ===`:

```js
setupIndexExpand(data, "index_expand_operasi", "operation_data", "operasi");
```

### In Vue `methods`

Find the `methods` section and add these properties:

**In `init`:**

```js
autocomplete(configOperasi(data));
```

### E. Vue Method saveDoc Hook inside methods: `{ saveDoc: function() { ... } }`

Add this at the beginning of the saveDoc function, at this comment `// === [SAVE_ACTION_HOOK] ===`
```js
this.operasi_group = combineActions(this.operasi_freetext, this.operasi_list);
```

### F. Vue Methods Additions (Inject to `methods: { ... }` )

Add the following methods at the end of the `methods` section in this comment `// === [METHOD_HOOK] ===`
```js
saveOperation: function () {
    this.operasi_freetext = "";
    let no = 1;
    this.external_link.operation_data.forEach((x, i) => {
        x.operasi.forEach((v, j) => {
            if (this.index_expand_operasi[i][j].selected) {
                const operasi = this.external_link.operation_data[i].operasi[j];
                this.operasi_freetext += `${no}. ${operasi.nama_layanan}\n`;
                no++;
            }
        });
    });
    this.operasi_freetext = this.operasi_freetext.trim();
    $("#hasilOperasiModal").modal("toggle");
},
add_operasi: function(){
    this.operasi_list.push(...TINDAKAN_TMP)
},
del_operasi: function(i){
    if(i > -1){
        this.operasi_list.splice(i, 1);
    }
},
```

### In `init_doc_add` and `init_doc_edit`

At the end of both `function init_doc_add(data)` and `function init_doc_edit(data)`, add this code at the comment `// === [BRIDGING_INIT_ADD_HOOK] ===` and `// === [BRIDGING_INIT_EDIT_HOOK] ===`:

```js
bridgingOperasi(data);
```

### G. Global Functions (Inject to `index.html` <script>)

Add the following global bridging function below the `init_doc_edit(data)` function at this comment `// === [BRIDGING_FUNCTION_HOOK] ===`:
```js
function bridgingOperasi(data) {
  if (data.external_link.operation_data.length === 1) {
    let hasil_operasi = "";
    data.external_link.operation_data.forEach((v, i) => {
      v.operasi.forEach((x, j) => {
        hasil_operasi += `${j + 1}. ${x.nama_layanan}\n`;
      });
    });

    if (!data.operasi_freetext.trim() && hasil_operasi.trim()) {
      data.operasi_freetext = hasil_operasi.trim();
    }
  }
}
```

## 4. HTML Elements & Modals `(Inject to output/index.html -> <form id="formadd">)`

### A. Form Section Component (New Bridging Section)

If this is a new form section, use the following full HTML block:

Inside the `<form id="formadd">` tag, place the following elements in the appropriate section.
First, add the modal (preferably at the bottom ) at this comment `// === [BRIDGING_FUNCTION_HOOK] ===`::

```html
<!--START OPERATION MODAL-->
<div
  class="modal fade"
  id="hasilOperasiModal"
  tabindex="-1"
  role="dialog"
  aria-labelledby="hasilOperasiModalTitle"
  aria-hidden="true"
>
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Hasil Operasi</h5>
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
            v-for="(jenisLayanan,i) in external_link.operation_data"
            :key="i"
          >
            <h6 v-if="jenisLayanan.operasi.length > 0">
              <u
                >{{jenisLayanan.mulai_operasi}} -
                {{jenisLayanan.selesai_operasi}}</u
              >
            </h6>
            <div
              v-for="(OperationItem,j) in jenisLayanan.operasi"
              :key="j"
              class="mb-1 mx-2"
            >
              <div
                class="col-12 row justify-content-between px-3 rounded border-bottom font-weight-bold"
                :class="{'bg-primary':index_expand_operasi[i][j].expand, 'bg-light': !index_expand_operasi[i][j].expand }"
              >
                <label
                  style="cursor: pointer"
                  :for="'customCheckOperasi'+i+j"
                  class="nav-link col mb-0"
                  :class="{'text-white':index_expand_operasi[i][j].expand}"
                  @click="navCollapse(i, j, 'index_expand_operasi')"
                >
                  {{ OperationItem.nama_layanan }}
                </label>
                <div class="nav-link">
                  <div class="custom-control custom-checkbox">
                    <input
                      type="checkbox"
                      @change="checkAllBridgingList('index_expand_operasi', true)"
                      class="custom-control-input"
                      :id="'customCheckOperasi'+i+j"
                      v-model="index_expand_operasi[i][j].selected"
                    />
                    <label
                      class="custom-control-label"
                      :for="'customCheckOperasi'+i+j"
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
                id="checkAllButtonOperasi"
                type="checkbox"
                @change="checkAllBridgingList('index_expand_operasi')"
                v-model="index_expand_operasi_check_all"
              />
            </div>
          </div>
          <label
            for="checkAllButtonOperasi"
            class="form-check-label font-weight-bold rounded-right"
            style="padding: 0.375rem 0.75rem; border: 1px solid #ced4da; display: flex; align-items: center; font-size: 16px"
          >
            Pilih semua
          </label>
        </div>
        <button type="button" class="btn btn-primary" @click="saveOperation">
          Simpan
        </button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">
          Tutup
        </button>
      </div>
    </div>
  </div>
</div>
<!--END OPERATION MODAL-->
```

Then add the main interface in the form section:

```html
<!-- Operasi -->
<div class="row">
  <div class="col-md-12 mb-2">
    <label for="operasi_freetext" class="mb-0">
      Operasi
      <button
        v-if="external_link?.operation_data?.length > 1 &&
                      external_link?.operation_data?.some(op => op.operasi && op.operasi.length > 0)"
        type="button"
        title="Operation"
        data-toggle="modal"
        data-target="#hasilOperasiModal"
        class="btn btn-info btn-sm"
      >
        Hasil Operasi
      </button>
    </label>
    <textarea
      type="text"
      style="white-space: pre-wrap"
      class="form-control"
      v-model="operasi_freetext"
      id="operasi_freetext"
      rows="4"
    ></textarea>
  </div>
  <div class="col-md-12">
    <div class="row mb-2 justify-content-center">
      <div class="col-md-8 pr-0">
        <select
          class="form-control"
          id="operasi_auto"
          name="operasi_tmp"
          style="width: 100%"
        ></select>
      </div>
      <div class="col-md-4 text-right">
        <button
          type="button"
          style="width: 100%; height: 100%"
          @click="add_operasi()"
          class="btn btn-sm btn-success"
        >
          <i class="fa fa-plus"></i>
          Tambah Operasi
        </button>
      </div>
    </div>
  </div>
  <div class="col-md-12" v-for="(item, key) in operasi_list" :key="key">
    <div class="row mb-2">
      <div class="col-md-10">
        <div>{{key+1}}. <span v-html="item.nama_layanan"></span></div>
      </div>
      <div class="col-md-2 text-right">
        <button
          type="button"
          @click="del_operasi(key)"
          class="btn btn-sm btn-danger"
        >
          <i class="fa fa-trash"></i>
        </button>
      </div>
    </div>
  </div>
</div>
<!-- Operasi -->
```

# IMPORTANT RULES FOR AGENT

1. Verbatim Code Injections: DO NOT reduce, refactor, or truncate any JavaScript/HTML code snippets above.
2. Context Checking: ALWAYS check whether objects already exist before injecting to prevent duplicate function errors.
3. Data Mapping Adaptation: Adjust JSON property mappings ONLY if user explicitly requests a different property container name.
