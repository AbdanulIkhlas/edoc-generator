---
name: code-snippet-bridging-list-fisioterapi
description: This document contains standard code snippet for integrating List Fisioterapi Bridging. AI agents MUST paste these code snippets exactly as provided, without cutting or altering the existing logic.
---

# STEP 0 : Understanding and required information
1. Detailed information about the data bridging methods to be used
2. A detailed explanation of the related objects
3. Understand everything and proceed through all the steps

# STEP 1 : Insert this code into the `./output/config.json` file at the very end of the `external_link` object
```json
"fisioterapi_list_data": {
    "source_type": "ws",
    "source": "[simrs]/e_doc_api/visitation/fisioterapi_list/<reg_number>",
    "data_usage": [
        "copy"
    ]
}
```

# STEP 2 : Add this object to the end of `sample` and `default` in the `./output/json` file
```json
"fisioterapi_freetext": ""
```

# STEP 3 : Insert the code below into the `./output/json.js` file, at the very bottom of the `external_link` object
Important Note : Include everything; don't cut anything out or change anything.
```json
"fisioterapi_list_data": [
    {
        "no_register": "2410250300",
        "id_pasien": "349295",
        "id_pendaftaran": 844838,
        "id_layanan_pendaftaran": 929819,
        "id_fisioterapi": 31335,
        "jenis": "Rawat Inap",
        "tanggal": "2024-10-30",
        "jam": "17:46:59",
        "layanan": [
            {
                "id_detail_fisioterapi": 57287,
                "hasil": "<p>lemah tangan sisi kanan </p>",
                "nama_layanan": "Electricalis Stimulation (ES) / Faradisa"
            }
        ]
    },
    {
        "no_register": "2410250300",
        "id_pasien": "349295",
        "id_pendaftaran": 844838,
        "id_layanan_pendaftaran": 932471,
        "id_fisioterapi": 31370,
        "jenis": "Rawat Inap",
        "tanggal": "2024-10-31",
        "jam": "12:35:52",
        "layanan": [
            {
                "id_detail_fisioterapi": 57352,
                "hasil": "lemah tangan kiri",
                "nama_layanan": "Electricalis Stimulation (ES) / Faradisa"
            },
            {
                "id_detail_fisioterapi": 57353,
                "hasil": "lemah tangan kiri",
                "nama_layanan": "Exercise Intensif (> 60 menit) Fisioterapi"
            }
        ]
    }
]
```

# STEP 4 : Find this comment `=== [SETUPINDEXEXPAND_HOOK] ===` in the file `./output/index.html`, and insert the code below on the line following that comment
```js
setupIndexExpand(data, "index_expand_fis", "fisioterapi_list_data");
```

# STEP 5 : Find this comment `=== [METHOD_HOOK] ===` in the file `./output/index.html`, and insert the code below on the line following that comment
```js
saveFis: function () {
    this.fisioterapi_freetext = "";
    this.index_expand_fis.map((v, i) => {
        v.map((x, j) => {
            if (x.selected == true) {
                const fis = this.external_link.fisioterapi_list_data[i].layanan[j]
                const value = `- ${fis.nama_layanan}, Hasil : ` + ` ${fis.hasil.replace(/<\/?[^>]+(>|$)/g, "")}\n`;
                this.fisioterapi_freetext += value;
            }
        })
    })
    $('#hasilFisModal').modal('toggle');
},
```

# STEP 6 : Find this comment `=== [BRIDGING_INIT_ADD_HOOK] ===` in the file `./output/index.html`, and insert the code below on the line following that comment
```js
{
    label: "Bridging List Fisioterapi",
    functionName: bridgingListFisioterapi,
    parameters: [data]
},
```

# STEP 7 : Find this comment `=== [BRIDGING_INIT_EDIT_HOOK] ===` in the file `./output/index.html`, and insert the code below on the line following that comment
```js
{
    label: "Bridging List Fisioterapi [EDIT]",
    functionName: bridgingListFisioterapi,
    parameters: [data]
},
```

# STEP 8 : Find this comment `=== [BRIDGING_FUNCTION_HOOK] ===` in the file `./output/index.html`, and insert the code below on the line following that comment
```js
function bridgingListFisioterapi(data) {
  if (data.external_link.fisioterapi_list_data.length === 1) {
    let hasil_fisioterapi = "";
    data.external_link.fisioterapi_list_data[0].layanan.map((v, i) => {
      hasil_fisioterapi += `${i + 1}. ${v.nama_layanan}, Hasil : ${v.hasil.replace(/<\/?[^>]+(>|$)/g, "")}\n`;
    });

    data.fisioterapi_freetext = hasil_fisioterapi;
  }
}
```

# STEP 9 : Find this comment `=== [BRIDGING_MODALS_HOOK] ===` in the file `./output/index.html`, and insert the code below on the line following that comment
Important Note : Include everything; don't cut anything out or change anything.
```html
<!-- START FIS MODAL -->
<div
  class="modal fade"
  id="hasilFisModal"
  tabindex="-1"
  role="dialog"
  aria-labelledby="hasilFisioterapiModalTitle"
  aria-hidden="true"
>
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Hasil Fisioterapi</h5>
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
            v-for="(jenisLayanan,i) in external_link.fisioterapi_list_data"
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
              v-for="(fisItem,j) in jenisLayanan.layanan"
              :key="j"
              class="mb-1 mx-2"
            >
              <div
                class="col-12 row justify-content-between px-3 rounded border-bottom font-weight-bold"
                :class="{'bg-primary':index_expand_fis[i][j].expand, 'bg-light': !index_expand_fis[i][j].expand }"
              >
                <a
                  class="nav-link col"
                  :class="{'text-white':index_expand_fis[i][j].expand}"
                  href="javascript:;"
                  data-toggle="collapse"
                  role="button"
                  :aria-expanded="index_expand_fis[i][j].expand"
                  @click.prevent="navCollapse(i, j, 'index_expand_fis')"
                >
                  <span class="nav-link-text">{{fisItem.nama_layanan}}</span>
                </a>
                <div class="nav-link">
                  <div class="custom-control custom-checkbox">
                    <input
                      type="checkbox"
                      class="custom-control-input"
                      :id="'customCheckFis'+i+j"
                      @change="checkAllBridgingList('index_expand_fis', true)"
                      v-model="index_expand_fis[i][j].selected"
                    />
                    <label
                      class="custom-control-label"
                      :for="'customCheckFis'+i+j"
                    ></label>
                  </div>
                </div>
              </div>
              <div
                class="col-12 border rounded row collapse"
                :class="{ show : index_expand_fis[i][j].expand }"
              >
                <p class="nav-link mb-0">
                  Hasil:
                  <span v-html="fisItem.hasil"></span>
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
                id="checkAllButtonFisioterapi"
                type="checkbox"
                @change="checkAllBridgingList('index_expand_fis')"
                v-model="index_expand_fis_check_all"
              />
            </div>
          </div>
          <label
            for="checkAllButtonFisioterapi"
            class="form-check-label font-weight-bold rounded-right"
            style="padding: 0.375rem 0.75rem; border: 1px solid #ced4da; display: flex; align-items: center; font-size: 16px"
          >
            Pilih semua
          </label>
        </div>
        <button type="button" class="btn btn-primary mb-0" @click="saveFis">
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
<!-- END FIS MODAL -->
```

# STEP 10 : Add the modal button and textarea code below to the location specified in the prompt.
```html
<div>
  <label for="aspek_medis_diagnosa_medis" class="">
    Fisioterapi
    <button
      v-if="external_link?.fisioterapi_list_data?.length > 1"
      type="button"
      title="Fisioterapi"
      data-toggle="modal"
      data-target="#hasilFisModal"
      class="btn btn-info btn-sm"
    >
      Pilih Hasil Fisioterapi
    </button>
  </label>
  <textarea
    class="form-control"
    id="exampleFormControlTextarea1"
    rows="3"
    v-model="fisioterapi_freetext"
  ></textarea>
</div>
```

# IMPORTANT NOTES OVERALL:
1. All code snippets above must be entered in full without any changes. Additionally, all code must remain identical and must not be altered or omitted when inserted into the `.output/index.html` file.
2. Work through and understand each step carefully, so that if this skill is called upon again, you can use it consistently don’t leave anything out.
