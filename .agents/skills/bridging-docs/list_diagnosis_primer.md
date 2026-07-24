---
name: code-snippet-bridging-list-diagnosis-primer
description: This document contains standard code snippet for integrating List Diagnosis Primer Bridging. AI agents MUST paste these code snippets exactly as provided, without cutting or altering the existing logic.
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
"diagnosa_primer_freetext": ""
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

# STEP 4 : Find this comment `=== [SETUPINDEXEXPAND_HOOK] ===` in the file `./output/index.html`, and insert the code below on the line following that comment
```js
// DIAGNOSA PRIMER
setupIndexExpand(data, "index_expand_diagnosa_primer", "diagnosa_list");
```

# STEP 5 : Find this comment `=== [COMPUTED_HOOK] ===` in the file `./output/index.html`, and insert the code below on the line following that comment
Important Note : If this function is already present in `computed` vue method, then there is no need to add it.
```js
countDiagnosa() {
    return (type) => {
        return this.external_link?.diagnosa_list?.reduce((count, diagnosa) => {
            const hasType = diagnosa.layanan.some(item => item.primer === type);
            return count + (hasType ? 1 : 0);
        }, 0);
    }
}
```

# STEP 6 : Find this comment `=== [BRIDGING_HOOK] ===` in the file `./output/index.html`, and insert the code below on the line following that comment
```js
this.bridgingListDiagnosis("Primer");
```

# STEP 7 : Find this comment `=== [METHOD_HOOK] ===` in the file `./output/index.html`, and insert the code below on the line following that comment
```js
// DIAGNOSA PRIMER
saveDiagPrimer: function(){
    this.diagnosa_primer_freetext = "";
    let no = 1;

    this.index_expand_diagnosa_primer.forEach((v,i) => {
        v.forEach((x,j) => {
            if(x.selected){
                const diag = this.external_link.diagnosa_list[i].layanan[j];
                if(diag.primer === "Primer"){
                    this.diagnosa_primer_freetext += `${no}. ${diag.icd_x} - ${diag.nama_sebab_sakit} ${diag.deskripsi ? "- " + diag.deskripsi : ""}\n`;
                    no++;
                }
            }
        })
    })

    $('#hasilDiagPrimerModal').modal('toggle');
},
```

# STEP 8 : Find this comment `=== [METHOD_HOOK] ===` in the file `./output/index.html`, and insert the code below on the line following that comment
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

# STEP 9 : Find this comment `=== [BRIDGING_MODALS_HOOK] ===` in the file `./output/index.html`, and insert the code below on the line following that comment
Important Note : Include everything; don't cut anything out or change anything.
```html
<!--START DIAGNOSA PRIMER MODAL-->
<div
  class="modal fade"
  id="hasilDiagPrimerModal"
  tabindex="-1"
  role="dialog"
  aria-labelledby="hasilDiagUtamaModalTitle"
  aria-hidden="true"
>
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Hasil Diagnosa Primer</h5>
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
              v-for="(DiagPrimerItem, j) in jenisLayanan.layanan"
              :key="j"
              class="mb-1 mx-2"
              v-if="DiagPrimerItem.primer === 'Primer'"
            >
              <div
                class="col-12 row justify-content-between px-3 rounded border-bottom font-weight-bold"
                :class="{'bg-primary':index_expand_diagnosa_primer[i][j].expand, 'bg-light': !index_expand_diagnosa_primer[i][j].expand }"
              >
                <a
                  class="nav-link col"
                  :class="{'text-white':index_expand_diagnosa_primer[i][j].expand}"
                  href="javascript:;"
                  data-toggle="collapse"
                  role="button"
                  :aria-expanded="index_expand_diagnosa_primer[i][j].expand"
                  @click.prevent="navCollapse(i, j, 'index_expand_diagnosa_primer')"
                >
                  <span class="nav-link-text"
                    >{{DiagPrimerItem.icd_x}} -
                    {{DiagPrimerItem.nama_sebab_sakit}} -
                    {{DiagPrimerItem.deskripsi}}</span
                  >
                </a>
                <div class="nav-link">
                  <div class="custom-control custom-checkbox">
                    <input
                      type="checkbox"
                      class="custom-control-input"
                      :id="'customCheckDiagPrimer'+i+j"
                      @change="checkAllBridgingList('index_expand_diagnosa_primer', true, 'Primer')"
                      v-model="index_expand_diagnosa_primer[i][j].selected"
                    />
                    <label
                      class="custom-control-label"
                      :for="'customCheckDiagPrimer'+i+j"
                    ></label>
                  </div>
                </div>
              </div>
              <div
                v-if="DiagPrimerItem.icd_x"
                class="col-12 border rounded row collapse"
                :class="{ show : index_expand_diagnosa_primer[i][j].expand }"
              >
                <p class="nav-link mb-0">
                  Hasil:
                  <span v-html="DiagPrimerItem.icd_x"></span>
                  <br />
                  {{DiagPrimerItem.icd_x}} - {{DiagPrimerItem.nama_sebab_sakit}}
                  - {{DiagPrimerItem.deskripsi}}
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
                id="checkAllButtonDiagnosisPrimer"
                type="checkbox"
                @change="checkAllBridgingList('index_expand_diagnosa_primer', false, 'Primer')"
                v-model="index_expand_diagnosa_primer_check_all"
              />
            </div>
          </div>
          <label
            for="checkAllButtonDiagnosisPrimer"
            class="form-check-label font-weight-bold rounded-right"
            style="padding: 0.375rem 0.75rem; border: 1px solid #ced4da; display: flex; align-items: center; font-size: 16px"
          >
            Pilih semua
          </label>
        </div>
        <button
          type="button"
          class="btn btn-primary mb-0"
          @click="saveDiagPrimer"
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
<!--END DIAGNOSA PRIMER MODAL-->
```

# STEP 10 : Add the modal button and textarea code below to the location specified in the prompt.
```html
<!--FORM DIAGNOSA PRIMER-->
<div class="row">
  <div class="col-md-12 row mt-1">
    <label for="text_diag_primer" class="col-md-12 col-form-label pb-0">
      <span class="pt-2"><b>DIAGNOSIS PRIMER</b></span>
      <button
        type="button"
        title="Diagnosa Primer"
        data-toggle="modal"
        data-target="#hasilDiagPrimerModal"
        class="btn btn-info btn-sm"
        v-if="countDiagnosa('Primer') > 1"
      >
        Hasil Diagnosa Primer
      </button>
    </label>
  </div>
  <div class="col-md-12 mt-2">
    <div class="row">
      <div class="col-md-12">
        <textarea
          type="text"
          id="text_diag_primer"
          class="form-control"
          v-model="diagnosa_primer_freetext"
        ></textarea>
      </div>
    </div>
  </div>
</div>
```

# IMPORTANT NOTES OVERALL:
1. All code snippets above must be entered in full without any changes. Additionally, all code must remain identical and must not be altered or omitted when inserted into the `.output/index.html` file.
2. Work through and understand each step carefully, so that if this skill is called upon again, you can use it consistently don’t leave anything out.
