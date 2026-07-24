---
name: bridging-list-action-patient-v-2
description: This document contains standard code snippet for integrating List Action Patient V-2 Bridging. AI agents MUST paste these code snippets exactly as provided, without cutting or altering the existing logic.
---

# Bridging Module: List Action Patient V-2

This document contains standard (_code snippets_) for integrating List Action Patient V-2 Bridging. AI agents MUST paste these code snippets exactly as provided, without cutting or altering the existing logic.

## 1. Config Block (Inject to `output/config.json` -> `external_link`)

Check whether the relevant key already exists in the `external_link` section of `config.json`.
If it **doesn\'t exist**, add the following block:
```json
"tindakan_data_list": {
    "source_type": "ws",
    "source": "[simrs]/e_doc_api/visitation/action_patient_list/<reg_number>",
    "data_usage": ["copy"]
}
```

## 2. Sample Data Block (Inject to output/json.js)

### A. Form Properties (Inject to sample & default)
If this object\'s property does not yet exist in `data.sample` and `data.default`, add it:

Check `./output/json.js`. If this is a new bridging and the target JSON object does not exist in the `sample`, add the following structure (adjust fields based on needs):

```json
"tindakan_group": "",
"tindakan_freetext": "",
"tindakan_list": [
		{
		    "nama_layanan": "Poliklinik Bedah, ",
		    "icd_9_code": "89.08",
		    "icd_9_name": "Other consultation"
		}
]
```

If the JSON object already exists, there is no need to add it. (Inform the agent whether the JSON object is already present).

### B. External Link Dummy Payload (Inject to sample.external_link)

Check `sample.external_link` to see if the key already exists. If it doesn\'t exist, add the following block in its entirety without any modifications:
```json
"tindakan_data_list": [
    {
        "no_register": "2410310418",
        "id_pasien": "181592",
        "id_pendaftaran": 847836,
        "id_layanan_pendaftaran": 932859,
        "jenis": "IGD",
        "tanggal": "2024-10-31",
        "jam": "16:45:40",
        "layanan": [
            {
                "id_tarif_tindakan": 996747,
                "nama_layanan": "Mengambil Darah Vena",
                "qty": 1
            },
            {
                "id_tarif_tindakan": 996748,
                "nama_layanan": "Suntik Oleh Perawat",
                "qty": 1
            },
            {
                "id_tarif_tindakan": 996749,
                "nama_layanan": "Observasi Medis IGD",
                "qty": 1
            },
            {
                "id_tarif_tindakan": 996750,
                "nama_layanan": "Tindakan Pasang Infus/Aff Infus",
                "qty": 1
            },
            {
                "id_tarif_tindakan": 996751,
                "nama_layanan": "Monitor Per Hari",
                "qty": 1
            },
            {
                "id_tarif_tindakan": 996752,
                "nama_layanan": "Pasang Monitor",
                "qty": 1
            },
            {
                "id_tarif_tindakan": 996755,
                "nama_layanan": "Pasang / Aff Cateter / DC",
                "qty": 1
            },
            {
                "id_tarif_tindakan": 996757,
                "nama_layanan": "Syiringe Pump Per Hari",
                "qty": 1
            }
        ]
    },
    {
        "no_register": "2410310418",
        "id_pasien": "181592",
        "id_pendaftaran": 847836,
        "id_layanan_pendaftaran": 933022,
        "jenis": "Rawat Inap",
        "tanggal": "2024-10-31",
        "jam": "22:15:53",
        "layanan": [
            {
                "id_tarif_tindakan": 997252,
                "nama_layanan": "Suntik Oleh Perawat",
                "qty": 1
            },
            {
                "id_tarif_tindakan": 997253,
                "nama_layanan": "Pasang Monitor",
                "qty": 1
            },
            {
                "id_tarif_tindakan": 997254,
                "nama_layanan": "Infus Pump Per Hari",
                "qty": 1
            },
            {
                "id_tarif_tindakan": 997255,
                "nama_layanan": "Syiringe Pump Per Hari",
                "qty": 1
            }
        ]
    }
]
```

## 3. JS Functions & Vue Methods `(Inject to output/index.html -> <script>)`

### A. Autocomplete Config Function

Add this at the comment `// === [CONFIG_AUTOCOMPLETE_HOOK] ===` alongside other autocomplete configs:
```js
function configTindakan(data) {
  return {
    element: "#tindakan_auto",
    url: "/api/emr/autocomplete?source_name=tindakan",
    query_params: {
      kelas: "",
      jenis_tindakan: "",
      jenis: "",
      id_penjamin: "",
    },
    markup_template: function (repo) {
      return `<b>${repo.layanan || ""}</b>`;
    },
    selection_template: function (repo) {
      if (repo && repo.layanan !== undefined) {
        TINDAKAN_TMP = {
          nama_layanan: repo.layanan || "",
          icd_9_code: repo.code_icd9 || "",
          icd_9_name: repo.description_icd9 || "",
        };
      } else {
        TINDAKAN_TMP = {
          nama_layanan: "",
          icd_9_code: "",
          icd_9_name: "",
        };
      }
      return repo.layanan || "";
    },
  };
}
```

### In `init_doc` (Before Vue initialization)

Inside `init_doc` and before `var app = new Vue({`, Add this at the comment `// === [SETUPINDEXEXPAND_HOOK] ===`:

```js
setupIndexExpand(data, "index_expand_tindakan", "tindakan_data_list");
```

### In Vue `methods`

Find the `methods` section and add these properties, Add this autocomplete call to `// === [AUTOCOMPLETE_HOOK] ===`:

**In `init`:**

```js
autocomplete(configTindakan(data));
```

### E. Vue Method saveDoc Hook inside methods: `{ saveDoc: function() { ... } }`

Add this at the beginning of the saveDoc function, at this comment `// === [SAVE_ACTION_HOOK] ===`


```js
this.tindakan_group = combineActions(
  this.tindakan_freetext,
  this.tindakan_list,
);
```

### F. Vue Methods Additions (Inject to `methods: { ... }` )

Add the following methods at the end of the `methods` section in this comment `// === [METHOD_HOOK] ===`
```js
saveTindakan: function () {
    this.tindakan_freetext = "";
    let no = 1;
    this.external_link.tindakan_data_list.forEach((x, i) => {
        x.layanan.forEach((v, j) => {
            if (this.index_expand_tindakan[i][j].selected) {
                const tindak = this.external_link.tindakan_data_list[i].layanan[j];
                this.tindakan_freetext += `${no}. ${tindak.id_tarif_tindakan} - ${tindak.nama_layanan}\n`;
                no++;
            }
        });
    });
    this.tindakan_freetext = this.tindakan_freetext.trim();
    $("#hasilTindakanModal").modal("toggle");
},
addTindakan: function (event) {
    this.tindakan_list.push(TINDAKAN_TMP);
},
deleteTindakan: function (i) {
    if (i > -1) this.tindakan_list.splice(i, 1);
}
```

### In `init_doc_add` and `init_doc_edit`

At the end of both `function init_doc_add(data)` and `function init_doc_edit(data)`, 
on `// === [BRIDGING_INIT_ADD_HOOK] ===` and `// === [BRIDGING_INIT_EDIT_HOOK] ===` add:

```js
bridgingTindakan(data);
```

### G. Bridging Functions (Inject to `index.html` <script>)

Add the following global bridging function below the `init_doc_edit(data)` function, add on this comment `// === [BRIDGING_FUNCTION_HOOK] ===`
```js
function bridgingTindakan(data) {
  if (data.external_link.tindakan_data_list.length === 1) {
    let hasil_tindakan = "";
    data.external_link.tindakan_data_list.forEach((v, i) => {
      v.layanan.forEach((x, j) => {
        hasil_tindakan += `${j + 1}. ${x.id_tarif_tindakan} - ${x.nama_layanan}\n`;
      });
    });

    if (!data.tindakan_freetext.trim() && hasil_tindakan.trim()) {
      data.tindakan_freetext = hasil_tindakan.trim();
    }
  }
}
```

## 4. HTML Elements & Modals `(Inject to output/index.html -> <form id="formadd">)`

### A. Form Section Component (New Bridging Section)

If this is a new form section, use the following full HTML block:

Inside the `<form id="formadd">` tag, place the following elements in the appropriate section.
First, add the modal (preferably at the bottom), add on this comment ` <!-- === [BRIDGING_MODALS_HOOK] === -->`:

```html
<!--START TINDAKAN MODAL-->
<div
  class="modal fade"
  id="hasilTindakanModal"
  tabindex="-1"
  role="dialog"
  aria-labelledby="hasilTindakanModalTitle"
  aria-hidden="true"
>
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Hasil Tindakan</h5>
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
            v-for="(jenisLayanan,i) in external_link.tindakan_data_list"
            :key="i"
          >
            <h6>
              <u
                >{{jenisLayanan.jenis}} {{jenisLayanan.tanggal}}
                {{jenisLayanan.jam}}</u
              >
            </h6>
            <div
              v-for="(TindakanItem,j) in jenisLayanan.layanan"
              :key="j"
              class="mb-1 mx-2"
            >
              <div
                class="col-12 row justify-content-between px-3 rounded border-bottom font-weight-bold"
                :class="{'bg-primary':index_expand_tindakan[i][j].expand, 'bg-light': !index_expand_tindakan[i][j].expand }"
              >
                <label
                  style="cursor: pointer"
                  :for="'customCheckTindakan'+i+j"
                  class="nav-link col mb-0"
                  :class="{'text-white':index_expand_tindakan[i][j].expand}"
                  @click="navCollapse(i, j, 'index_expand_tindakan')"
                >
                  {{ TindakanItem.nama_layanan }}
                </label>
                <div class="nav-link">
                  <div class="custom-control custom-checkbox">
                    <input
                      type="checkbox"
                      @change="checkAllBridgingList('index_expand_tindakan', true)"
                      class="custom-control-input"
                      :id="'customCheckTindakan'+i+j"
                      v-model="index_expand_tindakan[i][j].selected"
                    />
                    <label
                      class="custom-control-label"
                      :for="'customCheckTindakan'+i+j"
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
                id="checkAllButtonTindakan"
                type="checkbox"
                @change="checkAllBridgingList('index_expand_tindakan')"
                v-model="index_expand_tindakan_check_all"
              />
            </div>
          </div>
          <label
            for="checkAllButtonTindakan"
            class="form-check-label font-weight-bold rounded-right"
            style="padding: 0.375rem 0.75rem; border: 1px solid #ced4da; display: flex; align-items: center; font-size: 16px"
          >
            Pilih semua
          </label>
        </div>
        <button type="button" class="btn btn-primary" @click="saveTindakan">
          Simpan
        </button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">
          Tutup
        </button>
      </div>
    </div>
  </div>
</div>
<!--END TINDAKAN MODAL-->
```

Then add the main interface in the form section:

```html
<!-- Start Tindakan -->
<div class="card patient-card shadow-sm mt-5" id="tindakan">
  <div class="card-header bg-light">
    <h5 class="mb-0 text-dark">
      Tindakan
      <button
        v-if="external_link?.tindakan_data_list?.length > 1"
        type="button"
        title="Tindakan"
        data-toggle="modal"
        data-target="#hasilTindakanModal"
        class="btn btn-info btn-sm"
      >
        Hasil tindakan
      </button>
    </h5>
  </div>
  <div class="card-body">
    <div class="row">
      <div class="col-md-12">
        <div>
          <div class="row">
            <div class="col-md-12">
              <textarea
                class="form-control"
                id="aspek_medis_tindakan_medis"
                rows="3"
                v-model="tindakan_freetext"
              ></textarea>
            </div>
          </div>
          <div class="row mt-1">
            <div class="col-md-12">
              <div class="row mb-2 justify-content-center">
                <div class="col-md-8 pr-0">
                  <select
                    class="form-control"
                    id="tindakan_auto"
                    name="tindakan_auto"
                    title="Tindakan"
                    style="width: 100%"
                  ></select>
                </div>
                <div class="col-md-4 text-right">
                  <button
                    type="button"
                    style="width: 100%; height: 100%"
                    @click="addTindakan()"
                    class="btn btn-sm btn-success"
                  >
                    <i class="fa fa-plus"></i>
                    Tambah Data
                  </button>
                  &ensp;
                </div>
              </div>
            </div>
            <!-- perulangan untuk list tindakan -->
            <div
              class="col-md-12"
              v-for="(item, key) in tindakan_list"
              :key="key"
            >
              <div class="row mb-2">
                <div class="col-md-10">
                  <div>
                    {{ key + 1 }}.
                    <span v-html="item.nama_layanan"></span>
                    <span v-if="item.nama_layanan === 'Belum diketahui'"
                      >Belum Di ketahui</span
                    >
                  </div>
                </div>
                <div class="col-md-2 text-right">
                  <button
                    type="button"
                    @click="deleteTindakan(key)"
                    class="btn btn-sm btn-danger"
                    title="Hapus3"
                  >
                    <i class="fa fa-trash"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End Tindakan -->
```


# IMPORTANT RULES FOR AGENT

1. Verbatim Code Injections: DO NOT reduce, refactor, or truncate any JavaScript/HTML code snippets above.
2. Context Checking: ALWAYS check whether objects already exist before injecting to prevent duplicate function errors.
3. Data Mapping Adaptation: Adjust JSON property mappings ONLY if user explicitly requests a different property container name.
