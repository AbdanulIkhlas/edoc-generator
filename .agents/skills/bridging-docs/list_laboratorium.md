---
name: code-snippet-bridging-list-laboratorium
description: This document contains standard code snippet for integrating List Laboratorium Bridging. AI agents MUST paste these code snippets exactly as provided, without cutting or altering the existing logic.
---

# STEP 0 : Understanding and required information
1. Detailed information about the data bridging methods to be used
2. A detailed explanation of the related objects
3. Understand everything and proceed through all the steps

# STEP 1 : Insert this code into the `./output/config.json` file at the very end of the `external_link` object
```json
"laboratorium_data_list": {
    "source_type": "ws",
    "source": "[simrs]/e_doc_api/visitation/laboratorium_list/<reg_number>",
    "data_usage": [
        "copy"
    ]
}
```

# STEP 2 : Add this object to the end of `sample` and `default` in the `./output/json` file
```json
"laboratorium_freetext": ""
```

# STEP 3 : Insert the code below into the `./output/json.js` file, at the very bottom of the `external_link` object
Important Note : Include everything; don't cut anything out or change anything.
```json
"laboratorium_data_list": [
  {
    "no_register": "2202230010",
    "id_pasien": "00206957",
    "id_pendaftaran": 10,
    "id_layanan_pendaftaran": 154,
    "id_laboratorium": 486,
    "jenis": "Rawat Inap",
    "tanggal": "2022-02-26",
    "jam": "00:34:07",
    "layanan": [
      {
        "id_detail_laboratorium": 2399,
        "nama_layanan": "Hematologi rutin",
        "hasil_laboratorium": [
          {
            "item_laboratorium": "AFP",
            "id_item_laboratorium": "3",
            "hasil": "120",
            "abnormal": "Tidak",
            "catatan": "testinggggggg",
            "nama_satuan": "",
            "nilai_normal": ""
          },
          {
            "item_laboratorium": "AFP",
            "id_item_laboratorium": "3",
            "hasil": "120",
            "abnormal": "Tidak",
            "catatan": "testinggggggg",
            "nama_satuan": "",
            "nilai_normal": ""
          }
        ]
      },
      {
        "id_detail_laboratorium": 2399,
        "nama_layanan": "Hematologi rutin",
        "hasil_laboratorium": []
      }
    ]
  },
  {
    "no_register": "2202230010",
    "id_pasien": "00206957",
    "id_pendaftaran": 10,
    "id_layanan_pendaftaran": 154,
    "id_laboratorium": 486,
    "jenis": "Rawat Inap",
    "tanggal": "2022-02-26",
    "jam": "00:34:07",
    "layanan": [
      {
        "id_detail_laboratorium": 2399,
        "nama_layanan": "Hematologi rutin",
        "hasil_laboratorium": [
          {
            "item_laboratorium": "AFP",
            "id_item_laboratorium": "3",
            "hasil": "120",
            "abnormal": "Tidak",
            "catatan": "testinggggggg",
            "nama_satuan": "",
            "nilai_normal": ""
          },
          {
            "item_laboratorium": "AFP",
            "id_item_laboratorium": "3",
            "hasil": "120",
            "abnormal": "Tidak",
            "catatan": "testinggggggg",
            "nama_satuan": "",
            "nilai_normal": ""
          }
        ]
      },
      {
        "id_detail_laboratorium": 2399,
        "nama_layanan": "Hematologi rutin",
        "hasil_laboratorium": []
      }
    ]
  }
]
```

# STEP 4 : Find this comment `=== [SETUPINDEXEXPAND_HOOK] ===` in the file `./output/index.html`, and insert the code below on the line following that comment
```js
setupIndexExpand(data, "index_expand_lab", "laboratorium_data_list");
```

# STEP 5 : Find this comment `=== [METHOD_HOOK] ===` in the file `./output/index.html`, and insert the code below on the line following that comment
```js
saveLab: function () {
    const selectedData = [];

    this.index_expand_lab.forEach((v, i) => {
        v.forEach((x, j) => {
            if (x.selected == true) {
                const labData = this.external_link.laboratorium_data_list[i].layanan[j];
                const selectedDataHasil = [];

                if (labData.hasil_laboratorium && labData.hasil_laboratorium.length) {
                    labData.hasil_laboratorium.forEach((hasil, k) => {
                        const cleanedNilaiNormal = String(hasil.nilai_normal || "")
                            .replace(/<\/?[^>]+(>|$)/g, "")
                            .replace(/<|>/g, "")
                            .trim();

                        const hasilLaboratoriumFormatted1 = `${k + 1}. ${hasil.item_laboratorium}, Hasil: ${hasil.hasil} ${
                            hasil.abnormal === "Ya" ? "*" : ""
                        } (${cleanedNilaiNormal})`;
                        selectedDataHasil.push(hasilLaboratoriumFormatted1);
                    });
                } else {
                    selectedDataHasil.push("Data hasil laboratorium tidak ada.");
                }
                const formattedData = `- ${labData.nama_layanan}, Hasil Laboratorium :\n` + selectedDataHasil.join("\n");
                selectedData.push(formattedData);
            }
        });
    });

    this.laboratorium_freetext = selectedData.join("\n\n");
    $("#hasilLaboratoriumModal").modal("toggle");
},
```


# STEP 6 : Find this comment `=== [BRIDGING_INIT_ADD_HOOK] ===` in the file `./output/index.html`, and insert the code below on the line following that comment
```js
{
    label: "Bridging List Laboratorium",
    functionName: bridgingListLaboratorium,
    parameters: [data]
},
```

# STEP 7 : Find this comment `=== [BRIDGING_INIT_EDIT_HOOK] ===` in the file `./output/index.html`, and insert the code below on the line following that comment
```js
{
    label: "Bridging List Laboratorium [EDIT]",
    functionName: bridgingListLaboratorium,
    parameters: [data]
},
```

# STEP 8 : Find this comment `=== [BRIDGING_FUNCTION_HOOK] ===` in the file `./output/index.html`, and insert the code below on the line following that comment
```js
function bridgingListLaboratorium(data) {
  if (data.external_link.laboratorium_data_list.length === 1) {
    let result_lab = "";
    const labData = data.external_link.laboratorium_data_list[0];

    if (labData.layanan.length) {
      labData.layanan.forEach((hasilLayanan, i, array) => {
        const isLast = i === array.length - 1;
        result_lab += `- ${hasilLayanan.nama_layanan}, `;

        if (hasilLayanan.hasil_laboratorium.length) {
          result_lab += `Hasil Laboratorium : \n`;
          hasilLayanan.hasil_laboratorium.forEach((hasil, k) => {
            const cleanedNilaiNormal = String(hasil.nilai_normal || "")
              .replace(/<\/?[^>]+(>|$)/g, "")
              .replace(/<|>/g, "")
              .trim();

            result_lab += `${k + 1}. ${hasil.item_laboratorium}, Hasil: ${hasil.hasil} ${hasil.abnormal === "Ya" ? "*" : ""} (${cleanedNilaiNormal})\n`;
          });
        } else {
          result_lab +=
            "Hasil Laboratorium : \nData hasil laboratorium tidak ada.";
        }

        result_lab += `${isLast ? "" : "\n"}`;
      });
    }

    if (!data.laboratorium_freetext.trim() && result_lab.trim()) {
      data.laboratorium_freetext = result_lab;
    }
  }
}
```

# STEP 9 : Find this comment `=== [BRIDGING_MODALS_HOOK] ===` in the file `./output/index.html`, and insert the code below on the line following that comment
```html
<!--  START LABORATORIUM MODAL -->
<div
  class="modal fade"
  id="hasilLaboratoriumModal"
  tabindex="-1"
  role="dialog"
  aria-labelledby="hasilLaboratoriumModalTitle"
  aria-hidden="true"
>
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Hasil Laboratorium</h5>
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
            v-for="(jenisLayanan, i) in external_link.laboratorium_data_list"
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
              v-for="(labItem,j) in jenisLayanan.layanan"
              :key="j"
              class="mb-1 mx-2"
            >
              <div
                class="col-12 row justify-content-between px-3 rounded border-bottom font-weight-bold"
                :class="{'bg-primary':index_expand_lab[i][j].expand, 'bg-light': !index_expand_lab[i][j].expand }"
              >
                <a
                  class="nav-link col"
                  :class="{'text-white':index_expand_lab[i][j].expand}"
                  href="javascript:;"
                  data-toggle="collapse"
                  role="button"
                  :aria-expanded="index_expand_lab[i][j].expand"
                  @click.prevent="navCollapse(i, j, 'index_expand_lab')"
                >
                  <span class="nav-link-text">{{labItem.nama_layanan}}</span>
                </a>
                <div class="nav-link">
                  <div class="custom-control custom-checkbox">
                    <input
                      type="checkbox"
                      class="custom-control-input"
                      :id="'customCheckLab'+i+j"
                      @change="checkAllBridgingList('index_expand_lab', true)"
                      v-model="index_expand_lab[i][j].selected"
                    />
                    <label
                      class="custom-control-label"
                      :for="'customCheckLab'+i+j"
                    ></label>
                  </div>
                </div>
              </div>
              <div
                class="col-12 border rounded row collapse"
                :class="{ show : index_expand_lab[i][j].expand }"
              >
                <ul class="nav nav-sm flex-column">
                  <li
                    v-for="(subItem, k) in labItem.hasil_laboratorium"
                    :key="k"
                    class="nav-item"
                  >
                    <span class="nav-link">
                      {{k+1}}. {{subItem.item_laboratorium}}, hasil:
                      {{subItem.hasil}} {{subItem.nama_satuan}}
                      {{subItem.abnormal == "Ya" ?"*":"" }}
                      <span v-html="subItem.nilai_normal"></span>
                    </span>
                  </li>
                </ul>
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
                id="checkAllButtonLaboratorium"
                type="checkbox"
                @change="checkAllBridgingList('index_expand_lab')"
                v-model="index_expand_lab_check_all"
              />
            </div>
          </div>
          <label
            for="checkAllButtonLaboratorium"
            class="form-check-label font-weight-bold rounded-right"
            style="padding: 0.375rem 0.75rem; border: 1px solid #ced4da; display: flex; align-items: center; font-size: 16px"
          >
            Pilih semua
          </label>
        </div>
        <button type="button" class="btn btn-primary mb-0" @click="saveLab">
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
<!--  END LABORATORIUM MODAL -->
```

# STEP 10 : Add the modal button and textarea code below to the location specified in the prompt.
```html
<div>
  <label for="hasil_laboratorium" class="">
    Laboratorium
    <button
      v-if="external_link?.laboratorium_data_list?.length > 1"
      type="button"
      title="Laboratorium"
      data-toggle="modal"
      data-target="#hasilLaboratoriumModal"
      class="btn btn-info btn-sm"
    >
      Pilih Hasil Laboratorium
    </button>
  </label>
  <textarea
    class="form-control"
    id="hasil_laboratorium"
    rows="3"
    v-model="laboratorium_freetext"
  ></textarea>
</div>
```

# IMPORTANT NOTES OVERALL:
1. All code snippets above must be entered in full without any changes. Additionally, all code must remain identical and must not be altered or omitted when inserted into the `.output/index.html` file.
2. Work through and understand each step carefully, so that if this skill is called upon again, you can use it consistently don’t leave anything out.
