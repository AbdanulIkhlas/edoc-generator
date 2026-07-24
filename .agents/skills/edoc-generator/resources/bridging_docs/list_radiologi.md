---
name: code-snippet-bridging-list-radiologi
description: This document contains standard code snippet for integrating List Radiologi Bridging. AI agents MUST paste these code snippets exactly as provided, without cutting or altering the existing logic.
---

# STEP 0 : Understanding and required information
1. Detailed information about the data bridging methods to be used
2. A detailed explanation of the related objects
3. Understand everything and proceed through all the steps

# STEP 1 : Insert this code into the `./output/config.json` file at the very end of the `external_link` object
```json
"radiologi_list_data": {
    "source_type": "ws",
    "source": "[simrs]/e_doc_api/visitation/radiologi_list/<reg_number>",
    "data_usage": [
        "copy"
    ]
}
```

# STEP 2 : Add this object to the end of `sample` and `default` in the `./output/json` file
```json
"radiologi_freetext": ""
```

If the JSON object already exists, there is no need to add it. (Inform the agent whether the JSON object is already present).

# STEP 3 : Insert the code below into the `./output/json.js` file, at the very bottom of the `external_link` object
Important Note : Include everything; don't cut anything out or change anything.
```json
"radiologi_list_data": [
  {
    "no_register": "2506260457",
    "id_pasien": "360150",
    "id_pendaftaran": 967013,
    "id_layanan_pendaftaran": 1061690,
    "id_radiologi": 38917,
    "jenis": "IGD",
    "tanggal": "2025-06-26",
    "jam": "12:10:32",
    "status_expertise": "ACCEPTED",
    "final": "FINAL",
    "layanan": [
      {
        "id_detail_radiologi": 39669,
        "hasil": "Foto Wrist joint kanan PA/Lateral:&nbsp;\u003Cdiv\u003EAlignment baik\n\u003C/div\u003E\u003Cdiv\u003ETrabekulasi tulang normal\n\u003C/div\u003E\u003Cdiv\u003ECelah dan permukaan sendi dalam batas normal\n\u003C/div\u003E\u003Cdiv\u003ETak tampak kalsifikasi abnormal\n\u003C/div\u003E\u003Cdiv\u003ETak tampak erosi/destruksi tulang\n\u003C/div\u003E\u003Cdiv\u003ETampak soft tissue swelling minimal di regio wrist kanan sisi volar\n\u003C/div\u003E\u003Cdiv\u003EPergeseran sendi (-)\u003C/div\u003E",
        "kesan": " \n\u003Cdiv\u003E- Tak tampak fraktur maupun dislokasi\u003C/div\u003E\u003Cdiv\u003E- Soft tissue swelling minimal di regio wrist kanan sisi volar\u003C/div\u003E",
        "anjuran": "",
        "status_expertise": "ACCEPTED",
        "final": "FINAL",
        "nama_layanan": "Wrist Joint"
      }
    ]
  },
  {
    "no_register": "2506260457",
    "id_pasien": "360150",
    "id_pendaftaran": 967013,
    "id_layanan_pendaftaran": 1061690,
    "id_radiologi": 38920,
    "jenis": "IGD",
    "tanggal": "2025-06-26",
    "jam": "12:42:31",
    "status_expertise": "ACCEPTED",
    "final": "FINAL",
    "layanan": [
      {
        "id_detail_radiologi": 39672,
        "hasil": "Foto Toraks PA (asimetris):&nbsp;\u003Cdiv\u003ECor : Ukuran dan bentuk normal, CTR &lt;0,5\n\u003C/div\u003E\u003Cdiv\u003EPulmo : Tak tampak infiltrat&nbsp;di kedua lapang pulmo, corakan bronkovaskuler normal \n\u003C/div\u003E\u003Cdiv\u003ESinus costophrenicus kanan kiri tajam\n\u003C/div\u003E\u003Cdiv\u003EHemidiaphragma kanan kiri normal\n\u003C/div\u003E\u003Cdiv\u003ETrakhea di tengah\n\u003C/div\u003E\u003Cdiv\u003ESistema tulang baik\u003C/div\u003E",
        "kesan": " \n\u003Cdiv\u003E- Tak tampak fraktur maupun dislokasi\u003C/div\u003E\u003Cdiv\u003E- Cor tak tampak kelainan\n\u003C/div\u003E\u003Cdiv\u003E- Tak tampak gambaran pneumonia maupun proses spesifik\u003C/div\u003E",
        "anjuran": "",
        "status_expertise": "ACCEPTED",
        "final": "FINAL",
        "nama_layanan": "Thorax PA / AP"
      }
    ]
  }
]
```

# STEP 4 : Find this comment `=== [SETUPINDEXEXPAND_HOOK] ===` in the file `./output/index.html`, and insert the code below on the line following that comment
```js
setupIndexExpand(data, "index_expand_rad", "radiologi_list_data");
```

# STEP 5 : Find this comment `=== [METHOD_HOOK] ===` in the file `./output/index.html`, and insert the code below on the line following that comment
```js
saveRad: function () {
    this.radiologi_freetext = "";
    let number = 1;
    this.index_expand_rad.map((v, i) => {
        v.map((x, j) => {
            if (x.selected == true) {
                const rad = this.external_link.radiologi_list_data[i].layanan[j]
                const rasult = `${number}. ${rad.nama_layanan}\n Hasil : ${rad.hasil.replace(/<\/?[^>]+(>|$)/g, "")}\n\n`;
                this.radiologi_freetext += rasult.trim();
                number++
            }
        })
    })
    $('#hasilRadiologiModal').modal('toggle');
},
```

# STEP 6 : Find this comment `=== [BRIDGING_INIT_ADD_HOOK] ===` in the file `./output/index.html`, and insert the code below on the line following that comment
```js
{
    label: "Bridging List Radiologi",
    functionName: bridgingListRadiologi,
    parameters: [data]
},
```

# STEP 7 : Find this comment `=== [BRIDGING_INIT_EDIT_HOOK] ===` in the file `./output/index.html`, and insert the code below on the line following that comment
```js
{
    label: "Bridging List Radiologi [EDIT]",
    functionName: bridgingListRadiologi,
    parameters: [data]
},
```

# STEP 8 : Find this comment `=== [BRIDGING_FUNCTION_HOOK] ===` in the file `./output/index.html`, and insert the code below on the line following that comment
```js
function bridgingListRadiologi(data) {
  if (data.external_link.radiologi_list_data.length === 1) {
    let hasil_rad = "";
    data.external_link.radiologi_list_data[0].layanan.map((v, i) => {
      hasil_rad += `${i + 1}. ${v.nama_layanan}, Hasil : ${v.hasil.replace(/<\/?[^>]+(>|$)/g, "")}\n`;
    });

    data.radiologi_freetext = hasil_rad;
  }
}
```

# STEP 9 : Find this comment `=== [BRIDGING_MODALS_HOOK] ===` in the file `./output/index.html`, and insert the code below on the line following that comment
Important Note : Include everything; don't cut anything out or change anything.
```html
<!--  START RADIOLOGI MODAL -->
<div
  class="modal fade"
  id="hasilRadiologiModal"
  tabindex="-1"
  role="dialog"
  aria-labelledby="hasilRadiologiModalTitle"
  aria-hidden="true"
>
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Hasil Radiologi</h5>
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
            v-for="(jenisLayanan, i) in external_link.radiologi_list_data"
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
              v-for="(radItem,j) in jenisLayanan.layanan"
              :key="j"
              class="mb-1 mx-2"
            >
              <div
                class="col-12 row justify-content-between px-3 rounded border-bottom font-weight-bold"
                :class="{'bg-primary':index_expand_rad[i][j].expand, 'bg-light': !index_expand_rad[i][j].expand }"
              >
                <a
                  class="nav-link col"
                  :class="{'text-white':index_expand_rad[i][j].expand}"
                  href="javascript:;"
                  data-toggle="collapse"
                  role="button"
                  :aria-expanded="index_expand_rad[i][j].expand"
                  @click.prevent="navCollapse(i, j, 'index_expand_rad')"
                >
                  <span class="nav-link-text">{{radItem.nama_layanan}}</span>
                </a>
                <div class="nav-link">
                  <div class="custom-control custom-checkbox">
                    <input
                      type="checkbox"
                      class="custom-control-input"
                      :id="'customCheckRad'+i+j"
                      @change="checkAllBridgingList('index_expand_rad', true)"
                      v-model="index_expand_rad[i][j].selected"
                    />
                    <label
                      class="custom-control-label"
                      :for="'customCheckRad'+i+j"
                    ></label>
                  </div>
                </div>
              </div>
              <div
                class="col-12 border rounded row collapse"
                :class="{ show : index_expand_rad[i][j].expand }"
              >
                <p class="nav-link mb-0">
                  Hasil:
                  <span v-html="radItem.hasil"></span>
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
                id="checkAllButtonRadiologi"
                type="checkbox"
                @change="checkAllBridgingList('index_expand_rad')"
                v-model="index_expand_rad_check_all"
              />
            </div>
          </div>
          <label
            for="checkAllButtonRadiologi"
            class="form-check-label font-weight-bold rounded-right"
            style="padding: 0.375rem 0.75rem; border: 1px solid #ced4da; display: flex; align-items: center; font-size: 16px"
          >
            Pilih semua
          </label>
        </div>
        <button type="button" class="btn btn-primary mb-0" @click="saveRad">
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
<!--  END RADIOLOGI MODAL -->
```


# STEP 10 : Add the modal button and textarea code below to the location specified in the prompt.
```html
<div>
  <label for="aspek_medis_diagnosa_medis" class="">
    Radiologi
    <button
      v-if="external_link?.radiologi_list_data?.length > 1"
      type="button"
      title="Radiologi"
      data-toggle="modal"
      data-target="#hasilRadiologiModal"
      class="btn btn-info btn-sm"
    >
      Pilih Hasil Radiologi
    </button>
  </label>
  <textarea
    class="form-control"
    id="exampleFormControlTextarea1"
    rows="3"
    v-model="radiologi_freetext"
  ></textarea>
</div>
```

# IMPORTANT NOTES OVERALL:
1. All code snippets above must be entered in full without any changes. Additionally, all code must remain identical and must not be altered or omitted when inserted into the `.output/index.html` file.
2. Work through and understand each step carefully, so that if this skill is called upon again, you can use it consistently don’t leave anything out.
