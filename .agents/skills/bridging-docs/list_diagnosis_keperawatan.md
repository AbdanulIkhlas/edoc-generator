---
name: code-snippet-bridging-list-diagnosis-keperawatan
description: This document contains standard code snippet for integrating List Diagnosis Keperawatan Bridging. AI agents MUST paste these code snippets exactly as provided, without cutting or altering the existing logic.
---

# STEP 0 : Understanding and required information
1. Detailed information about the data bridging methods to be used
2. A detailed explanation of the related objects
3. Understand everything and proceed through all the steps

# STEP 1 : Insert this code into the `./output/config.json` file at the very end of the `external_link` object
```json
"diagnosa_keperawatan_list": {
    "source_type": "ws",
    "source": "[simrs]/e_doc_api/visitation/diagnosa_keperawatan/<reg_number>",
    "data_usage": [
        "copy"
    ]
}
```

# STEP 2 : Add this object to the end of `sample` and `default` in the `./output/json` file
```json
"diagnosa_keperawatan_list": [],
"diagnosa_keperawatan_freetext": "",
"diagnosa_keperawatan_gabungan": ""
```

# STEP 3 : Insert the code below into the `./output/json.js` file, at the very bottom of the `external_link` object
Important Note : Include everything; don't cut anything out or change anything
```json
"diagnosa_keperawatan_list": [
  {
      "id": "79748",
      "id_pendaftaran": "64121",
      "jenis": "IGD",
      "bangsal": "IGD UTAMA",
      "kelas": "-",
      "no_ruang": "1",
      "nomor_bed": "3",
      "klinik": "Gawat Darurat Umum",
      "jenis_igd": "Umum",
      "data": [
          {
              "id": "974",
              "id_diagnosa_keperawatan_lama": null,
              "id_layanan_pendaftaran": "79748",
              "waktu": "2025-10-13 12:45:20",
              "id_nakes": "0",
              "id_sebab_sakit_keperawatan": "2",
              "deskripsi": "Pasien datang dengan sesak napas dan tampak gelisah. Diberikan oksigen 3 L/menit melalui nasal kanul, dilakukan posisi semi fowler untuk memudahkan pernapasan.",
              "primer": "1",
              "id_user": "1",
              "nama_user": "fgadmin",
              "nama_nakes": "Perawat IGD",
              "code": "D.0001",
              "diagnosa": "D.0001 | Pola Napas Tidak Efektif.",
              "diagnosa_keperawatan_lama": []
          }
      ]
  },
  {
      "id": "79750",
      "id_pendaftaran": "64121",
      "jenis": "Rawat Inap",
      "bangsal": "RENGGALI ATAS",
      "kelas": "III",
      "no_ruang": "18",
      "nomor_bed": "2",
      "klinik": null,
      "jenis_igd": "Umum",
      "data": [
          {
              "id": "975",
              "id_diagnosa_keperawatan_lama": null,
              "id_layanan_pendaftaran": "79750",
              "waktu": "2025-10-16 15:00:00",
              "id_nakes": "0",
              "id_sebab_sakit_keperawatan": "1",
              "deskripsi": "Pasien mengalami batuk produktif sejak 3 hari, sekret kental dan sulit dikeluarkan. Diberikan edukasi teknik batuk efektif dan hidrasi cukup.",
              "primer": "1",
              "id_user": "1",
              "nama_user": "fgadmin",
              "nama_nakes": "Perawat Bangsal",
              "code": "D.0010",
              "diagnosa": "D.0010 | Bersihan Jalan Napas Tidak Efektif.",
              "diagnosa_keperawatan_lama": []
          },
          {
              "id": "976",
              "id_diagnosa_keperawatan_lama": null,
              "id_layanan_pendaftaran": "79750",
              "waktu": "2025-10-14 13:00:00",
              "id_nakes": "0",
              "id_sebab_sakit_keperawatan": "3",
              "deskripsi": "Pasien tampak lemah dan sering berbaring. Diberikan latihan mobilisasi pasif dan edukasi keluarga untuk membantu perubahan posisi tiap 2 jam.",
              "primer": "0",
              "id_user": "1",
              "nama_user": "fgadmin",
              "nama_nakes": "Perawat Bangsal",
              "code": "D.0002",
              "diagnosa": "D.0002 | Intoleransi Aktivitas.",
              "diagnosa_keperawatan_lama": []
          },
          {
              "id": "977",
              "id_diagnosa_keperawatan_lama": null,
              "id_layanan_pendaftaran": "79750",
              "waktu": "2025-10-15 14:00:00",
              "id_nakes": "0",
              "id_sebab_sakit_keperawatan": "4",
              "deskripsi": "Pasien mengeluh sulit tidur di malam hari karena batuk dan ketidaknyamanan. Diberikan edukasi relaksasi pernapasan dan posisi nyaman.",
              "primer": "0",
              "id_user": "1",
              "nama_user": "fgadmin",
              "nama_nakes": "Perawat Bangsal",
              "code": "D.0008",
              "diagnosa": "D.0008 | Gangguan Pola Tidur.",
              "diagnosa_keperawatan_lama": []
          }
      ]
  }
]
```

# STEP 4 : Find this comment `=== [CONFIG_AUTOCOMPLETE_HOOK] ===` in the file `./output/index.html`, and insert the code below on the line following that comment
```js
function configDiagnosaKeperawatan(data) {
  return {
    element: "#diagnosa_keperawatan_auto",
    url: "/api/emr/autocomplete?source_name=diagnosa_keperawatan",
    markup_template: function (repo) {
      return `<b>${repo.code}</b> - ${repo.nama}`;
    },
    selection_template: function (repo) {
      var res = "";
      if (repo.code != undefined) {
        DIAGNOSA_KEPERAWATAN_TMP = [{ code: repo.code, nama: repo.nama }];
        res = repo.code + " - " + repo.nama;
      }

      return res;
    },
  };
}
```

# STEP 5 : Find this comment `=== [OTHER_VARIABLE_BRIDGING_HOOK] ===` in the file `./output/index.html`, and insert the code below on the line following that comment
```js
// Memastikan list diagnosa keperawatan ada dan berbentuk array
if (Array.isArray(data.external_link?.diagnosa_keperawatan_list)) {
  // Sort isi 'data' di dalam setiap item diagnosa_keperawatan_list
  data.external_link.diagnosa_keperawatan_list.forEach((item) => {
    if (Array.isArray(item.data)) {
      item.data.sort((a, b) => {
        const dateA = new Date(a?.waktu || 0);
        const dateB = new Date(b?.waktu || 0);
        return dateA - dateB; // urut terlama dulu
      });
    }
  });

  // Sort antar item di diagnosa_keperawatan_list
  data.external_link.diagnosa_keperawatan_list.sort((a, b) => {
    const dateA = new Date(a?.data?.[0]?.waktu || 0);
    const dateB = new Date(b?.data?.[0]?.waktu || 0);
    return dateA - dateB; // urut terlama dulu
  });
}
```

# STEP 6 : Find this comment `=== [SETUPINDEXEXPAND_HOOK] ===` in the file `./output/index.html`, and insert the code below on the line following that comment
```javascript
setupIndexExpand(data, "index_expand_diagnosa_keperawatan", "diagnosa_keperawatan_list", "data");
```

# STEP 7 : Find this comment `=== [AUTOCOMPLETE_HOOK] ===` in the file `./output/index.html`, and insert the code below on the line following that comment
```js
autocomplete(configDiagnosaKeperawatan(data));
```

# STEP 8 : Find this comment `=== [SAVE_ACTION_HOOK] ===` in the file `./output/index.html`, and insert the code below on the line following that comment
```js
this.diagnosa_keperawatan_gabungan = combineDiagnoses(this.diagnosa_keperawatan_freetext, this.diagnosa_keperawatan_list, true );
```

# STEP 9 : Find this comment `=== [METHOD_HOOK] ===` in the file `./output/index.html`, and insert the code below on the line following that comment
```js
saveDiagKeperawatan: function () {
    this.diagnosa_keperawatan_freetext = ""
    let no = 1;

    this.index_expand_diagnosa_keperawatan.forEach((v, i) => {
        v.forEach((x, j) => {
            if (x.selected) {
                const diagnosaKeperawatan = this.external_link.diagnosa_keperawatan_list[i].data[j];
                const diagnosaText = diagnosaKeperawatan.diagnosa.replace('|', '-').trim();
                this.diagnosa_keperawatan_freetext += `${no}. ${diagnosaText}\n`;
                no++;
            }
        })
    })

    $('#hasilDiagKeperawatanModal').modal('toggle');
},
addDiagnosaKeperawatan: function () {
    this.diagnosa_keperawatan_list.push(...DIAGNOSA_KEPERAWATAN_TMP)
},
delDiagnosaKeperawatan: function (i) {
    if (i > -1) this.diagnosa_keperawatan_list.splice(i, 1);
},
```

# STEP 10 : Find this comment `=== [BRIDGING_INIT_ADD_HOOK] ===` in the file `./output/index.html`, and insert the code below on the line following that comment
```js
{
    label: "Bridging List Diagnosa Keperawatan",
    functionName: bridgingListDiagnosaKeperawatan,
    parameters: [data]
},
```

# STEP 11 : Find this comment `=== [BRIDGING_INIT_EDIT_HOOK] ===` in the file `./output/index.html`, and insert the code below on the line following that comment
```js
{
    label: "Bridging List Diagnosa Keperawatan [EDIT]",
    functionName: bridgingListDiagnosaKeperawatan,
    parameters: [data]
},
```

# STEP 12 : Find this comment `=== [BRIDGING_FUNCTION_HOOK] ===` in the file `./output/index.html`, and insert the code below on the line following that comment
```js
function bridgingListDiagnosaKeperawatan(data) {
  if (data.external_link.diagnosa_keperawatan_list.length === 1) {
    let hasilDiagnosaKeperawatan = "";
    data.external_link.diagnosa_keperawatan_list[0].data.forEach((v, i) => {
      const diagnosaText = v.diagnosa.replace("|", "-").trim();
      hasilDiagnosaKeperawatan += `${i + 1}. ${diagnosaText}\n`;
    });

    data.diagnosa_keperawatan_freetext = hasilDiagnosaKeperawatan;
  }
}
```

# STEP 13 : Find this comment `=== [BRIDGING_MODALS_HOOK] ===` in the file `./output/index.html`, and insert the code below on the line following that comment
Important Note : Include everything; don't cut anything out or change anything.
```html
<!--START DIAGNOSA KEPERAWATAN MODAL-->
<div
  class="modal fade"
  id="hasilDiagKeperawatanModal"
  tabindex="-1"
  role="dialog"
  aria-labelledby="hasilDiagKeperawatanModalTitle"
  aria-hidden="true"
>
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Hasil Diagnosa Keperawatan</h5>
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
            v-for="(jenisLayanan, i) in external_link.diagnosa_keperawatan_list"
            :key="i"
          >
            <h5
              v-if="jenisLayanan?.data?.length"
              class="mt-0 mb-3 border-bottom pb-2"
            >
              <strong>{{ jenisLayanan.jenis }}</strong>
            </h5>

            <div
              v-for="(DiagKeperawatanItem, j) in jenisLayanan.data"
              :key="j"
              class="mb-2"
            >
              <div class="card shadow-sm mb-2">
                <div
                  class="card-header py-2 px-3 d-flex justify-content-between align-items-center"
                  @click.prevent="navCollapse(i, j, 'index_expand_diagnosa_keperawatan')"
                  style="cursor: pointer;"
                  :class="{'bg-primary text-white': index_expand_diagnosa_keperawatan[i][j].expand, 'bg-light': !index_expand_diagnosa_keperawatan[i][j].expand}"
                >
                  <div class="flex-grow-1">
                    <span class="font-weight-bold"
                      >{{ DiagKeperawatanItem.diagnosa }}</span
                    >
                    <small
                      class="d-block"
                      :class="{'text-white-50': index_expand_diagnosa_keperawatan[i][j].expand, 'text-muted': !index_expand_diagnosa_keperawatan[i][j].expand}"
                    >
                      {{ DiagKeperawatanItem.waktu ?
                      DiagKeperawatanItem.waktu.split(' ')[0] : '-'}} -
                      {{DiagKeperawatanItem.waktu ?
                      DiagKeperawatanItem.waktu.split(' ')[1].slice(0,5) + '
                      WIB' : '-' }}
                    </small>
                  </div>

                  <div class="custom-control custom-checkbox ml-3" @click.stop>
                    <input
                      type="checkbox"
                      class="custom-control-input"
                      :id="'customCheckDiagKeperawatan'+i+j"
                      @change="checkAllBridgingList('index_expand_diagnosa_keperawatan', true)"
                      v-model="index_expand_diagnosa_keperawatan[i][j].selected"
                    />
                    <label
                      class="custom-control-label"
                      :for="'customCheckDiagKeperawatan'+i+j"
                    ></label>
                  </div>
                </div>

                <div
                  class="collapse"
                  :class="{ 'show': index_expand_diagnosa_keperawatan[i][j].expand }"
                >
                  <div v-if="DiagKeperawatanItem.deskripsi" class="card-body">
                    <strong>Deskripsi:</strong>
                    <div
                      class="mt-1"
                      v-html="DiagKeperawatanItem.deskripsi"
                    ></div>
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
                id="checkAllButtonDiagnosaKeperawatan"
                type="checkbox"
                @change="checkAllBridgingList('index_expand_diagnosa_keperawatan')"
                v-model="index_expand_diagnosa_keperawatan_check_all"
              />
            </div>
          </div>
          <label
            for="checkAllButtonDiagnosaKeperawatan"
            class="form-check-label font-weight-bold rounded-right"
            style="padding: 0.375rem 0.75rem; border: 1px solid #ced4da; display: flex; align-items: center; font-size: 16px"
          >
            Pilih semua
          </label>
        </div>
        <button
          type="button"
          class="btn btn-primary mb-0"
          @click="saveDiagKeperawatan()"
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
<!--END DIAGNOSA KEPERAWATAN MODAL-->
```

# STEP 14 : Add the modal button and textarea code below to the location specified in the prompt.
```html
<div class="row">
  <div class="col-md-12 mb-2">
    <label for="diagnosa_keperawatan" class="mb-0">
      Diagnosa Keperawatan
      <button
        v-if="external_link?.diagnosa_keperawatan_list?.some(item => item?.data?.length > 0)"
        type="button"
        title="Riwayat diagnosa keperawatan"
        data-toggle="modal"
        data-target="#hasilDiagKeperawatanModal"
        class="btn btn-info btn-sm"
      >
        Pilih Hasil Diagnosa Keperawatan
      </button>
    </label>
    <textarea
      type="text"
      style="white-space: pre-wrap"
      class="form-control"
      v-model="diagnosa_keperawatan_freetext"
      id="diagnosa_keperawatan"
      rows="4"
    ></textarea>
  </div>
  <div class="col-md-12">
    <div class="row mb-2 justify-content-center">
      <div class="col-md-8 pr-0">
        <select
          class="form-control"
          id="diagnosa_keperawatan_auto"
          name="icdx_tmp"
          style="width: 100%"
        ></select>
      </div>
      <div class="col-md-4 text-right">
        <button
          type="button"
          style="width: 100%; height: 100%"
          @click="addDiagnosaKeperawatan()"
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
    v-for="(item, key) in diagnosa_keperawatan_list"
    :key="key"
  >
    <div class="row mb-2">
      <div class="col-md-10">
        <div class="">
          {{key+1}}.&nbsp;{{item.code}}&nbsp;-&nbsp;{{item.nama}}
        </div>
      </div>
      <div class="col-md-2 text-right">
        <button
          type="button"
          @click="delDiagnosaKeperawatan(key)"
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
