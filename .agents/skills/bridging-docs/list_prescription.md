---
name: code-snippet-bridging-list-prescription
description: This document contains standard code snippet for integrating List Prescription Bridging. AI agents MUST paste these code snippets exactly as provided, without cutting or altering the existing logic.
---

# STEP 0 : Understanding and required information
1. Detailed information about the data bridging methods to be used
2. A detailed explanation of the related objects
3. Understand everything and proceed through all the steps

# STEP 1 : Insert this code into the `./output/config.json` file at the very end of the `external_link` object
```json
"prescription_data_list": {
    "source_type": "ws",
    "source": "[simrs]/e_doc_api/visitation/prescription_list/<reg_number>",
    "data_usage": [
        "copy"
    ]
}
```

# STEP 2 : Add this object to the end of `sample` and `default` in the `./output/json` file
```json
"resep_freetext": ""
```

# STEP 3 : Insert the code below into the `./output/json.js` file, at the very bottom of the `external_link` object
Important Note : Include everything; don't cut anything out or change anything.
```json
"prescription_data_list": [
  {
      "no_register": "2502140133",
      "id_pasien": "040540",
      "id_pendaftaran": 69568,
      "id_layanan_pendaftaran": 82235,
      "id_resep": 44718,
      "id_resep_tebus": "18252",
      "status_obat_pulang": "",
      "status_approval": "Disetujui",
      "waktu_resep": "2025-11-08 09:19:00",
      "waktu_resep_approval": "2025-11-08 09:44:55",
      "telaah_resep": null,
      "telaah_obat": null,
      "status_farmasi": "Disetujui",
      "order_resep": [
          {
              "r_no": 1,
              "nama_pendek": "Paracetamol 500 mg Tablet",
              "nama_obat": "Paracetamol 500 mg Tablet 500 mg Tablet \u003Ci\u003EPT. Kimia Farma\u003C/i\u003E",
              "qty": 1,
              "nama_satuan": "Tablet",
              "kekuatan": 500,
              "nama_kekuatan": "mg",
              "aturan_pakai": "-",
              "ket_aturan_pakai": "-",
              "timing": "Sesudah",
              "admintime": "",
              "kronis": "0",
              "id_kategori": "1",
              "nama_kategori_barang": "Obat",
              "high_alert": "Tidak"
          }
      ],
      "resep": [
          {
              "id_penjualan": 18397,
              "r_no": 1,
              "nama_pendek": "Paracetamol 500 mg Tablet",
              "nama_obat": "Paracetamol 500 mg Tablet 500 mg Tablet \u003Ci\u003EPT. Kimia Farma\u003C/i\u003E",
              "qty": 15,
              "nama_satuan": "Tablet",
              "kekuatan": 500,
              "nama_kekuatan": "mg",
              "aturan_pakai": "3dd1tab",
              "ket_aturan_pakai": "3 x sehari 1 Tablet",
              "timing": "Sesudah",
              "admintime": "Pagi: 06.00, Siang: 14.00, Malam: 22.00",
              "kronis": "0",
              "id_kategori": "1",
              "nama_kategori_barang": "Obat",
              "high_alert": "Tidak"
          },
          {
              "id_penjualan": 18397,
              "r_no": 1,
              "nama_pendek": "Paracetamol 500 mg Tablet",
              "nama_obat": "Paracetamol 500 mg Tablet 500 mg Tablet \u003Ci\u003EPT. Kimia Farma\u003C/i\u003E",
              "qty": 15,
              "nama_satuan": "Tablet",
              "kekuatan": 500,
              "nama_kekuatan": "mg",
              "aturan_pakai": "3dd1tab",
              "ket_aturan_pakai": "3 x sehari 1 Tablet",
              "timing": "Sesudah",
              "admintime": "Pagi: 06.00, Siang: 14.00, Malam: 22.00",
              "kronis": "0",
              "id_kategori": "1",
              "nama_kategori_barang": "Obat",
              "high_alert": "Tidak"
          }
      ]
  },
  {
      "no_register": "2502140133",
      "id_pasien": "040540",
      "id_pendaftaran": 69568,
      "id_layanan_pendaftaran": 82235,
      "id_resep": 44984,
      "id_resep_tebus": "",
      "status_obat_pulang": "",
      "status_approval": "Disetujui",
      "waktu_resep": "2025-11-08 21:59:00",
      "waktu_resep_approval": "2025-11-08 22:05:18",
      "telaah_resep": null,
      "telaah_obat": null,
      "status_farmasi": "Menunggu Konfirmasi",
      "order_resep": [
          {
              "r_no": 1,
              "nama_pendek": "Paracetamol 500 mg Tablet",
              "nama_obat": "Paracetamol 500 mg Tablet 500 mg Tablet \u003Ci\u003EPT. Kimia Farma\u003C/i\u003E",
              "qty": 1,
              "nama_satuan": "Tablet",
              "kekuatan": 500,
              "nama_kekuatan": "mg",
              "aturan_pakai": "3dd1/2tab",
              "ket_aturan_pakai": "3 x sehari 1/2 tablet",
              "timing": "Sesudah",
              "admintime": "Pagi: 06.00, Siang: 14.00, Malam: 22.00",
              "kronis": "0",
              "id_kategori": "1",
              "nama_kategori_barang": "Obat",
              "high_alert": "Tidak"
          }
      ],
      "resep": []
  }
]
```

# STEP 4 : Find this comment `=== [SETUPINDEXEXPAND_HOOK] ===` in the file `./output/index.html`, and insert the code below on the line following that comment
```js
setupIndexExpandResep(data);
```

# STEP 5 : Find this comment `=== [METHOD_HOOK] ===` in the file `./output/index.html`, and insert the code below on the line following that comment
```js
navResepCollapse: function (index, index2, type) {
    this.index_expand_resep = this.index_expand_resep.map((item, i) => {
        return {
            order: item.order.map((subItem, j) => {
                if (i === index && j === index2 && type === "order") {
                    subItem.expand = !subItem.expand;
                } else {
                    subItem.expand = false;
                }
                return subItem;
            }),
            resep: item.resep.map((subItem, k) => {
                if (i === index && k === index2 && type === "resep") {
                    subItem.expand = !subItem.expand;
                } else {
                    subItem.expand = false;
                }
                return subItem;
            }),
        };
    });
},
saveResep: function () {
    let tmp = "";
    let no = 1;

    this.index_expand_resep.map((v, i) => {
        v.order.map((x, j) => {
            if (x.selected == true) {
                const item = this.external_link.prescription_data_list[i].order_resep[j];
                tmp += `${no}. ${item.nama_pendek} (${item.qty} ${item.nama_satuan})`;
                tmp += `, Aturan: ${item.ket_aturan_pakai || item.aturan_pakai || "-"}`;
                tmp += `, Waktu: ${item.admintime || "-"}`;
                tmp += `, Ket: ${item.timing || "-"}\n`;
                no++;
            }
        });

        v.resep.map((y, k) => {
            if (y.selected == true) {
                const item = this.external_link.prescription_data_list[i].resep[k];
                tmp += `${no}. ${item.nama_pendek} (${item.qty} ${item.nama_satuan})`;
                tmp += `, Aturan: ${item.ket_aturan_pakai || item.aturan_pakai || "-"}`;
                tmp += `, Waktu: ${item.admintime || "-"}`;
                tmp += `, Ket: ${item.timing || "-"}\n`;
                no++;
            }
        });
    });

    this.resep_freetext = tmp.trim();
}
```

# STEP 6 : Find this comment `=== [BRIDGING_INIT_ADD_HOOK] ===` in the file `./output/index.html`, and insert the code below on the line following that comment
```js
{
    label: "Bridging List Resep",
    functionName: bridgingResep,
    parameters: [data]
},
```

# STEP 7 : Find this comment `=== [BRIDGING_INIT_EDIT_HOOK] ===` in the file `./output/index.html`, and insert the code below on the line following that comment
```js
{
    label: "Bridging List Resep [EDIT]",
    functionName: bridgingResep,
    parameters: [data]
},
```

# STEP 8 : Find this comment `=== [BRIDGING_FUNCTION_HOOK] ===` in the file `./output/index.html`, and insert the code below on the line following that comment
```js
function bridgingResep(data) {
  if (data?.external_link?.prescription_data_list?.length === 1) {
    if (
      !data.external_link.prescription_data_list ||
      !Array.isArray(data.external_link.prescription_data_list)
    ) {
      data.resep_freetext = "";
      return;
    }

    const resepRs = data.external_link.prescription_data_list.filter(
      (item) => !item.status_obat_pulang || item.status_obat_pulang === "Tidak",
    );

    if (
      resepRs.length > 0 &&
      Array.isArray(resepRs[0].resep) &&
      resepRs[0].resep.length > 0
    ) {
      data.resep_freetext =
        resepRs
          .reverse()[0]
          .order_resep.map(
            (order) =>
              `${order.nama_pendek} ${order.kekuatan} ${order.nama_kekuatan} ${order.nama_satuan} ${order.aturan_pakai} (${order.qty})`,
          )
          .join(" ")
          .replace(/<\/?[^>]+(>|$)/g, "") || "";
    } else {
      data.resep_freetext = "";
    }

    const telaahResep =
      resepRs.length > 0 && Array.isArray(resepRs[0].telaah_resep)
        ? resepRs[0].telaah_resep
        : [];
  }
}

function setupIndexExpandResep(data) {
  if (typeof data.index_expand_resep === "undefined")
    data.index_expand_resep = [];

  const indexExpandTmp = data.external_link.prescription_data_list.map(
    (v, i) => {
      return {
        order: v.order_resep.map((x, j) => ({
          expand: false,
          selected: false,
        })),
        resep: v.resep.map((x, j) => ({ expand: false, selected: false })),
      };
    },
  );

  for (let i = 0; i < indexExpandTmp.length; i++) {
    if (
      data.index_expand_resep[i] === undefined ||
      data.index_expand_resep[i].length === 0
    ) {
      data.index_expand_resep[i] = indexExpandTmp[i];
    } else {
      // Lakukan iterasi untuk data order
      if (
        data.index_expand_resep[i].order === undefined ||
        data.index_expand_resep[i].order.length === 0
      ) {
        data.index_expand_resep[i].order = indexExpandTmp[i].order;
      } else {
        for (let j = 0; j < indexExpandTmp[i].order.length; j++) {
          if (data.index_expand_resep[i].order[j] === undefined) {
            data.index_expand_resep[i].order[j] = indexExpandTmp[i].order[j];
          }
        }
      }

      // Lakukan iterasi untuk data resep
      if (
        data.index_expand_resep[i].resep === undefined ||
        data.index_expand_resep[i].resep.length === 0
      ) {
        data.index_expand_resep[i].resep = indexExpandTmp[i].resep;
      } else {
        for (let k = 0; k < indexExpandTmp[i].resep.length; k++) {
          if (data.index_expand_resep[i].resep[k] === undefined) {
            data.index_expand_resep[i].resep[k] = indexExpandTmp[i].resep[k];
          }
        }
      }
    }
  }
}
```

# STEP 9 : Find this comment `=== [BRIDGING_MODALS_HOOK] ===` in the file `./output/index.html`, and insert the code below on the line following that comment
Important Note : Include everything; don't cut anything out or change anything.
```html
<!-- START RESEP MODAL -->
<div
  class="modal fade"
  id="resepModal"
  tabindex="-1"
  role="dialog"
  aria-labelledby="resepModalModalTitle"
  aria-hidden="true"
>
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Resep</h5>
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
        <div
          class="tab-content border"
          style="border-color: #eeeeee; padding: 5px 5px 0px 5px"
        >
          <div class="accordion" id="accordionExampleResep">
            <div
              v-for="(resep_data, i) in external_link.prescription_data_list"
              :key="i"
            >
              <div
                class="card"
                :key="resep_data.id_resep+'_'+i"
                style="position: relative"
              >
                <div
                  style="cursor: pointer"
                  class="card-header"
                  :id="'heading'+'_'+resep_data.id_resep+'_'+i"
                  data-toggle="collapse"
                  :data-target="'#collapse'+'_'+resep_data.id_resep+'_'+i"
                  aria-expanded="false"
                  :aria-controls="'collapseOne'+'_'+resep_data.id_resep+'_'+i"
                >
                  <div
                    class="d-flex justify-content-between align-items-center"
                  >
                    <div>
                      <h2 class="p-0 m-0">
                        Resep {{i + 1}} |
                        <span
                          >{{ resep_data.waktu_resep ? new
                          Date(resep_data.waktu_resep.replace(' ',
                          'T')).toLocaleDateString('id-ID', {day: 'numeric',
                          month: 'long', year: 'numeric'}) : '-' }}</span
                        >
                      </h2>
                    </div>
                  </div>
                </div>
                <div
                  :id="'collapse'+'_'+resep_data.id_resep+'_'+i"
                  class="collapse"
                  :aria-labelledby="'heading'+'_'+resep_data.id_resep+'_'+i"
                  data-parent="#accordionExampleResep"
                >
                  <div class="card-body px-2 py-2">
                    <h6 class="px-2">
                      <u>
                        <b>Order Resep</b>
                      </u>
                    </h6>
                    <div
                      class="mb-3"
                      v-for="(item_order, j) in resep_data.order_resep"
                      :key="j"
                    >
                      <div
                        class="mx-2 row justify-content-between px-3 rounded border-bottom font-weight-bold"
                        :class="{'bg-primary':index_expand_resep[i].order[j].expand, 'bg-light': !index_expand_resep[i].order[j].expand }"
                      >
                        <a
                          class="nav-link col"
                          :class="{'text-white':index_expand_resep[i].order[j].expand}"
                          href="javascript:;"
                          @click.prevent="navResepCollapse(i, j, 'order')"
                          data-toggle="collapse"
                          role="button"
                          :aria-expanded="index_expand_resep[i].order[j].expand"
                        >
                          <span class="nav-link-text"
                            >{{ item_order.nama_pendek }}</span
                          >
                        </a>
                        <div class="nav-link">
                          <div class="custom-control custom-checkbox">
                            <input
                              type="checkbox"
                              class="custom-control-input"
                              :id="'customCheckOrderResep'+i+j"
                              v-model="index_expand_resep[i].order[j].selected"
                            />
                            <label
                              class="custom-control-label"
                              :for="'customCheckOrderResep'+i+j"
                            ></label>
                          </div>
                        </div>
                      </div>
                      <div
                        class="row mx-2 border rounded row collapse"
                        :class="{ show : index_expand_resep[i].order[j].expand }"
                      >
                        <p class="nav-link mb-0">{{ item_order.nama_obat }}</p>
                      </div>
                    </div>
                    <h6 class="px-2">
                      <u>
                        <b>Resep</b>
                      </u>
                    </h6>
                    <div
                      class="mb-3"
                      v-for="(item_order_resep, k) in resep_data.resep"
                      :key="k"
                    >
                      <div
                        class="mx-2 row justify-content-between px-3 rounded border-bottom font-weight-bold"
                        :class="{'bg-primary': index_expand_resep[i].resep[k].expand, 'bg-light': !index_expand_resep[i].resep[k].expand }"
                      >
                        <a
                          class="nav-link col"
                          :class="{'text-white': index_expand_resep[i].resep[k].expand}"
                          href="javascript:;"
                          @click.prevent="navResepCollapse(i, k, 'resep')"
                          data-toggle="collapse"
                          role="button"
                          :aria-expanded="index_expand_resep[i].resep[k].expand"
                        >
                          <span class="nav-link-text"
                            >{{ item_order_resep.nama_pendek }}</span
                          >
                        </a>
                        <div class="nav-link">
                          <div class="custom-control custom-checkbox">
                            <input
                              type="checkbox"
                              class="custom-control-input"
                              :id="'customCheckResep'+i+k"
                              v-model="index_expand_resep[i].resep[k].selected"
                            />
                            <label
                              class="custom-control-label"
                              :for="'customCheckResep'+i+k"
                            ></label>
                          </div>
                        </div>
                      </div>
                      <div
                        class="mx-2 row border rounded row collapse"
                        :class="{ show : index_expand_resep[i].resep[k].expand }"
                      >
                        <p class="nav-link mb-0">
                          {{ item_order_resep.nama_obat }}
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button
          type="button"
          class="btn btn-primary"
          data-dismiss="modal"
          @click="saveResep"
        >
          Simpan
        </button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">
          Tutup
        </button>
      </div>
    </div>
  </div>
</div>
<!-- END RESEP MODAL -->
```

# STEP 10 : Add the modal button and textarea code below to the location specified in the prompt.
```html
<div class="row mt-2">
  <div class="col-md-12">
    <div class="col-md-12">
      <label class="col-md-12 pl-0 col-form-label" for="">
        Pengobatan Yang Diberikan
        <button
          v-if="external_link?.prescription_data_list && external_link.prescription_data_list.length > 1"
          type="button"
          title="Resep"
          data-toggle="modal"
          data-target="#resepModal"
          class="btn btn-info btn-sm"
        >
          Pilih resep
        </button>
      </label>
    </div>
    <div class="col-md-12 pl-4">
      <textarea
        type="text"
        class="form-control"
        id=""
        v-model="resep_freetext"
      ></textarea>
    </div>
  </div>
</div>
```

# IMPORTANT NOTES OVERALL:
1. All code snippets above must be entered in full without any changes. Additionally, all code must remain identical and must not be altered or omitted when inserted into the `.output/index.html` file.
2. Work through and understand each step carefully, so that if this skill is called upon again, you can use it consistently don’t leave anything out.
