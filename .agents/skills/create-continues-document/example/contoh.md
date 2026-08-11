# Template Dokumen Berkelanjutan

Owner: Tontowi Prasetyo
Tags: berkelanjutan, dokumen, dokumen berkelanjutan, edoc, fix format, template

# **OVERVIEW**

Dokumen berkelanjutan ini adalah dokumen yang terintegrasi langsung dengan database, tidak ada button save karena ke-save otomatis dan tidak berpengaruh/mempengaruhi data sample, jadi data sample bisa di isi external link saja.

Dokumentasi ini hanya akan menyediakan beberapa hal/method/function/contoh yang bisa di ikuti untuk mempermudah dalam mengerjakan dokumen berkelanjutan

**Referensi Dokumen Berkelanjutan : 
1. Local 5050 → RS53_RM14.1b ~ ASSESMEN LANJUTAN RAWAT JALAN (Berkelanjutan)
2. Local 5003 → CPPT_WONOGIRI ~ Catatan Perkembangan Pasien Terintegrasi (CPPT)
3. Local 5003 → ODONTO ~ Odontogram**

---

# DATA SAMPLE (contoh)

```jsx
{
    "sample": {
        "pasien": {
            "nama": "",
            "no_rm": "",
            "kelamin": "",
            "tanggal_lahir": "",
            "tanggal_lahir_indo": ""
        },
        "data_list": [],
        "data_list_sorted":[],
        "external_link": {},
        "user_session_data": {
            "user_id": 1,
            "fullname": "dr. Agus Nurohman Sp.PD FINASIM.",
            "username": "fgadmin",
            "group_name": "gizi"
        }
    },
    "default": {
        "pasien": {
            "nama": "",
            "no_rm": "",
            "kelamin": "",
            "tanggal_lahir": "",
            "tanggal_lahir_indo": ""
        },
        "data_list": [],
        "data_list_sorted":[]
    }
}
```

# SCRIPT

```jsx
// Variabel global
let DOC_ID_DUMMY = 9;
```

function init_doc(doc_id, data, operation) {

```jsx
// ---- template ---
        data.doc_id = doc_id ? doc_id : DOC_ID_DUMMY; // ngecek id dummy atau id rill
        data.doc_status = "ACTIVE"; // Akan diupdate dari API jika sudah pernah dibuat
        data.list_data = null;   // variabel untuk menyimpan data tabel dari database
        data.isDirty = false; // variabel checking untuk mengecek ada perubahan pada data pasien atau tidak
        data.unsavedTimer = null; 
        data.showUnsavedWarning = false;
        data.showScrollTop = false;

        data.pagination = { limit: 10, page: 1, total: 0 };
        data.mode = "add";
        data.edit_id = null;
        data.filterStartDate = "";
        data.filterEndDate = "";
        data.sortOrder = "DESC";

        // Simpan referensi ke data json murni
        data.original_static_json = null;
        data.static_json = null;
        // ---- template ---
```

 var app = new Vue({

      el: "#formadd",
      data: data,

```jsx
mounted: function () {
    this.init();
    this.getStaticJson(operation);
    this.loadPage(1);

    // Scroll event listener for scroll-to-top button
    window.addEventListener("scroll", () => {
        this.showScrollTop = window.scrollY > 300;
    });

    // UNTUK CPPT DAN SEJENISNYA
    // this.handleEditModalScrollListener();
    // this.sortDataList();
},
```

```jsx
watch: {
    static_json: {
        handler: function (dataFormSaatIni) {
            if (!this.original_static_json) return;

            const dataSekarangString = JSON.stringify(dataFormSaatIni);
            const dataAsliString = JSON.stringify(this.original_static_json);
            this.isDirty = dataSekarangString !== dataAsliString;

            // Reset timer dan sembunyikan notifikasi (jika pengguna lanjut mengetik)
            clearTimeout(this.unsavedTimer);
            this.showUnsavedWarning = false;

            // Jika data kotor (dirty), mulai timer 3 detik
            if (this.isDirty) {
                this.unsavedTimer = setTimeout(() => {
                    this.showUnsavedWarning = true;
                }, 3000);
            }
        },
        deep: true,
    },
}
```

```jsx
computed: {
    // START PAGINATION
    pages() {
        const numShown = 5;
        const pages = [];
        let start = Math.max(1, this.pagination.page - Math.floor(numShown / 2));
        let end = Math.min(this.totalPages, start + numShown - 1);

        if (end - start + 1 < numShown) {
            start = Math.max(1, end - numShown + 1);
        }

        for (let i = start; i <= end; i++) {
            pages.push(i);
        }
        return pages;
    },
    totalPages() {
        return Math.ceil(this.pagination.total / this.pagination.limit);
    },
    paginationInfo() {
        const start = (this.pagination.page - 1) * this.pagination.limit + 1;
        const end = Math.min(this.pagination.page * this.pagination.limit, this.pagination.total);
        return `Menampilkan ${start} - ${end} dari ${this.pagination.total} data`;
    },
    // END PAGINATION
},
```

methods: {

```jsx
// ----- API Handlers (Berkelanjutan) -----
handleScroll: function () {
    this.showScrollTop = window.scrollY > 300;
},
scrollToTop: function () {
    window.scrollTo({ top: 0, behavior: "smooth" });
},
getStaticJson: async function (operation) {
    if (operation === "add") {
        let isSuccess = false;

        const payload = {
            patient_document_id: this.doc_id,
            emr_data: {
                static: this.external_link,
            },
        };

        await apiHelper({
            method: "PUT",
            url: `/api/patient_document_item/update-static`,
            requestData: payload,
            notifyOnError: true,
            renderSuccess: (response) => {
                isSuccess = true;
            },
        });

        if (!isSuccess) return;
    }

    await apiHelper({
        url: `/api/patient_document/get_static/${this.doc_id}`,
        notifyOnError: true,
        renderSuccess: (response) => {
            this.static_json = response.data.static_json;
            // Sinkronisasi manual px_data agar jika kosong bisa diganti
            if (!this.static_json.px_data) {
                this.static_json.px_data = {
                    nama: data.pasien.nama,
                    no_rm: data.pasien.no_rm,
                    kelamin: data.pasien.kelamin,
                    tanggal_lahir: data.pasien.tanggal_lahir,
                    tanggal_lahir_indo: data.pasien.tanggal_lahir_indo
                };
            }
            this.original_static_json = JSON.parse(JSON.stringify(this.static_json));
            this.isDirty = false;
            this.showUnsavedWarning = false;
        },
    });
},
stopPatientDocument: async function () {
    await apiHelper({
        url: `/api/patient_document/stop/${this.doc_id}`,
        notifyOnError: true,
        notifyOnSuccess: true,
        confirm: {
            title: "Yakin ingin menyelesaikan dokumen Ini?",
            confirmText: "Ya, selesaikan!",
            icon: "warning",
            confirmButtonColor: "#dc3545",
            cancelButtonColor: "#6c757d",
        },
        renderSuccess: (result) => {
            this.doc_status = "CLOSED";
        },
    });
},
startPatientDocument: async function () {
    await apiHelper({
        url: `/api/patient_document/start/${this.doc_id}`,
        notifyOnError: true,
        notifyOnSuccess: true,
        confirm: {
            title: "Yakin ingin melanjutkan dokumen Ini?",
            icon: "warning",
            confirmButtonColor: "#28a745",
            cancelButtonColor: "#6c757d",
        },
        renderSuccess: (result) => {
            this.doc_status = "ACTIVE";
        },
    });
},
loadPage: async function (page) {
    if (page < 1 || (page > this.totalPages && this.totalPages > 0)) return;
    this.list_data = null;
    let apiUrl = `/api/patient_document_item/list?patient_document_id=${this.doc_id}&p=${page}`;
    if (this.filterStartDate) apiUrl += `&start_date=${this.filterStartDate}`;
    if (this.filterEndDate) apiUrl += `&end_date=${this.filterEndDate}`;
    apiUrl += `&sort_order=${this.sortOrder}`;

    await apiHelper({
        url: apiUrl,
        notifyOnError: true,
        renderSuccess: (response) => {
            // Maps data array to original legacy format to prevent breaking ui/ux
            // The new list_data needs to populate data_list for legacy views to still work.
            this.$set(this, "list_data", response.data);
            console.log("LIST DATA DARI DATABASE : ", data.list_data)

            // sorting by tanggal 
            // this.data_list = this.list_data
            // this.sortDataList();
            // console.log("temp list data : ", data.list_data)
            // console.log("data list sorted : ", data.data_list_sorted)

            // this.data_list = response.data.map(item => item.emr_data.entry);
            this.pagination.page = response.page;
            this.pagination.limit = response.limit;
            this.pagination.total = response.total;
        },
    });
},
saveStaticJson: async function () {
    if (this.unsavedTimer) {
        clearTimeout(this.unsavedTimer);
        this.unsavedTimer = null;
        this.showUnsavedWarning = false;
    }

    const payload = {
        patient_document_id: this.doc_id,
        emr_data: {
            static: this.static_json,
        },
    };

    await apiHelper({
        url: `/api/patient_document_item/update-static`,
        method: "PUT",
        requestData: payload,
        notifyOnError: true,
        notifyOnSuccess: true,
        renderSuccess: (response) => {
            this.original_static_json = JSON.parse(JSON.stringify(this.static_json));
            this.isDirty = false;
        },
    });
},
async saveEntryItemHandler() {
    const payload = {
        patient_document_id: this.doc_id,
        entry_data: this.cppt_tmp,
    };

    await apiHelper({
        url: `/api/patient_document_item/add`,
        method: "POST",
        notifyOnError: true,
        notifyOnSuccess: true,
        requestData: payload,
        renderSuccess: (response) => {
            this.loadPage(this.pagination.page);
        },
    });
},
async editDataHandler() {
    if (!this.edit_id) {
        console.warn("edit ID tidak ditemukan");
        return;
    }

    this.pendingScrollAfterEdit = this.edit_id;

    const payload = {
        emr_data: {
            entry: this.cppt_edit,
        },
    };

    await apiHelper({
        url: `/api/patient_document_item/update-entry/${this.edit_id}`,
        method: "PUT",
        requestData: payload,
        notifyOnError: true,
        notifyOnSuccess: true,
        renderSuccess: (response) => {
            $("#modal_edit").modal("hide");
            this.loadPage(this.pagination.page);
        },
    });
},
async hapusItem(id) {
    await apiHelper({
        url: `/api/patient_document_item/delete/${id}`,
        method: "DELETE",
        notifyOnError: true,
        notifyOnSuccess: true,
        confirm: {
            title: "Yakin ingin menghapus data ini?",
            icon: "warning",
        },
        renderSuccess: (response) => {
            this.loadPage(this.pagination.page);
        },
    });
},
applyFilter: function () {
    if (this.filterStartDate && this.filterEndDate) {
        if (this.filterEndDate < this.filterStartDate) {
            console.error("Filter error: Tanggal selesai tidak boleh sebelum tanggal mulai.");

            showNotification({
                variant: "info",
                message: "Tanggal Selesai tidak boleh lebih awal dari Tanggal Mulai.",
                position: "top-right",
                autoClose: true,
                duration: 3000,
            });

            return;
        }
    }

    this.loadPage(1);
    $("#filterModal").modal("hide");
},
clearFilter: function () {
    console.log("Membersihkan filter...");
    // Reset nilai filter
    this.filterStartDate = null;
    this.filterEndDate = null;

    this.loadPage(1);
    $("#filterModal").modal("hide");
},
// INI KHUSUS UNTUK CPPT, TAPI BISA DI IMPLEMENTASIKAN JUGA KE YANG LAIN KETIKA INGIN DI SORTING
// sortDataList: function () {
//     // Sort data_list by tanggal_cppt + jam_cppt descending (newest first)
//     console.log("kepanggil ga?")
//     console.log("data list pada sorted : ", this.data_list)
//     console.log("tanggal : ", this.data_list[0]?.entry_data.tanggal_cppt)
//     var sorted = this.data_list.slice().sort(function (a, b) {
//         var dateTimeA = (a?.entry_data?.tanggal_cppt || '') + ' ' + (a?.entry_data?.jam_cppt || '00:00');
//         var dateTimeB = (b?.entry_data?.tanggal_cppt || '') + ' ' + (b?.entry_data?.jam_cppt || '00:00');
//         // Descending: newest first
//         if (dateTimeA > dateTimeB) return -1;
//         if (dateTimeA < dateTimeB) return 1;
//         return 0;
//     });
//     this.$set(this, 'data_list_sorted', sorted);
// },
// handleEditModalScrollListener: function () {
//     var vm = this;
//     $("#modal_edit").on("hidden.bs.modal", function () {
//         if (vm.pendingScrollAfterEdit) {
//             var editedId = vm.pendingScrollAfterEdit;
//             vm.pendingScrollAfterEdit = null;

//             // Tunggu sebentar untuk memastikan DOM dan list_data up to date setelah API loadPage
//             setTimeout(function () {
//                 vm.$nextTick(function () {
//                     var targetIndex = -1;
//                     for (var idx = 0; idx < vm.data_list_sorted.length; idx++) {
//                         if (vm.data_list_sorted[idx].patient_document_item_id === editedId) {
//                             targetIndex = idx;
//                             break;
//                         }
//                     }

//                     if (targetIndex !== -1) {
//                         var targetId = "cppt-entry-" + targetIndex;
//                         var element = document.getElementById(targetId);

//                         if (element) {
//                             // Smooth scroll ke elemen
//                             element.scrollIntoView({
//                                 behavior: "smooth",
//                                 block: "center",
//                             });

//                             // Tambahkan highlight animation
//                             element.classList.add("cppt-row-highlight");

//                             // Hapus class highlight setelah animasi selesai
//                             setTimeout(function () {
//                                 element.classList.remove("cppt-row-highlight");
//                             }, 2600);
//                         }
//                     }
//                 });
//             }, 500); // 500ms tunggu respon loadPage
//         }
//     });
// },
// ----- end API Handlers (Berkelanjutan) -----
```

}

}

# STYLE

```css
/*  ----- start style dokumen berkelanjutan ----------*/
.patient-card {
    border: 1px solid #dee2e6;
    margin-top: 15px;
    border-radius: 8px;
}

.patient-card .data-label {
    font-weight: 600;
    color: #6c757d;
    margin-bottom: 2px;
    font-size: 0.9rem;
}

.patient-card .data-value {
    font-size: 1.05rem;
    color: #212529;
    width: 100%;
    border: 1px solid #ced4da;
    padding: 5px;
    border-radius: 4px;
    background-color: #f8f9fa;
}

.pagination-info {
    text-align: center;
    margin-top: 1rem;
    margin-bottom: 0.5rem;
    /* Memberi jarak ke tombol paginasi */
    color: #6c757d;
    /* Warna abu-abu standar Bootstrap */
    font-size: 0.9rem;
}

.loading-state,
.empty-state {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 150px;
    color: #6b7280;
    /* Abu-abu */
    font-style: italic;
}

.unsaved-notification-bar {
    position: fixed;
    bottom: 20px;
    left: 50%;
    transform: translateX(-50%);
    z-index: 1050;
    background-color: #333;
    color: white;
    padding: 12px 20px;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 20px;
}

.unsaved-notification-bar .fa-warning {
    color: #ffc107;
    margin-right: 8px;
}

.btn-scroll-top {
    position: fixed;
    bottom: 30px;
    right: 30px;
    z-index: 1040;
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background-color: #007bff;
    color: white;
    border: none;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
    cursor: pointer;
    opacity: 0;
    visibility: hidden;
    transform: translateY(20px);
    transition: all 0.3s ease-in-out;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 1.2rem;
}

.btn-scroll-top:hover {
    background-color: #0056b3;
    transform: translateY(-5px);
}

.btn-scroll-top.show {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
}

/* Animasi highlight untuk row yang baru diedit (untuk cppt) */
@keyframes cppt-highlight-fade {
    0% {
        background-color: #fff9c4;
        box-shadow: 0 0 12px 4px rgba(255, 213, 0, 0.35);
    }

    60% {
        background-color: #fff9c4;
        box-shadow: 0 0 8px 2px rgba(255, 213, 0, 0.2);
    }

    100% {
        background-color: transparent;
        box-shadow: none;
    }
}

.cppt-row-highlight td {
    animation: cppt-highlight-fade 2.5s ease-out forwards;
}

```

# FORM HTML

<form id="formadd" class="form-label-left input_mask p-3">

```html
	<!-- Floating Action -->
  <div v-if="showUnsavedWarning" class="unsaved-notification-bar">
      <span>
          <i class="fa fa-warning"></i>
          Ada perubahan yang belum disimpan!
      </span>

      <button type="button" v-on:click="saveStaticJson" class="btn btn-primary btn-sm">
          <i class="fa fa-save"></i>
          Perbarui Sekarang
      </button>
  </div>
 <!-- Floating Action -->
```

```html
<!-- Pasien Info Data -->
<div class="card patient-card shadow-sm mb-3">
    <div class="card-header bg-light">
        <h5 class="mb-0 text-dark">Data Identitas Pasien</h5>
    </div>
    <div class="card-body">
        <div class="row" v-if="static_json">
            <div class="col-md-6 border-right">
                <div class="mb-3">
                    <p class="data-label">Nama</p>
                    <input id="pasien_nama" type="text" class="data-value"
                        v-model="static_json.px_data.nama" />
                </div>
                <div class="mb-3">
                    <p class="data-label">Kelamin</p>
                    <input id="pasien_kelamin" type="text" class="data-value"
                        :value="showKelamin(static_json.px_data.kelamin)" disabled />
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <p class="data-label">No RM</p>
                    <input id="pasien_no_rm" type="text" class="data-value"
                        v-model="static_json.px_data.no_rm" />
                </div>
                <div class="mb-3">
                    <p class="data-label">Tanggal Lahir</p>
                    <input id="pasien_tanggal_lahir_indo" type="date" class="data-value"
                        v-model="static_json.px_data.tanggal_lahir"
                        @change="onChDateDynamic($event, 'static_json.px_data.tanggal_lahir_indo')" />
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer text-muted">
        <button type="button" v-on:click="saveStaticJson" class="btn btn-primary">
            <i class="fa fa-refresh"></i>
            Perbarui
        </button>
        <button v-if="doc_status === 'ACTIVE'" type="button" v-on:click="stopPatientDocument"
            class="btn btn-danger">
            <i class="fa fa-lock" aria-hidden="true"></i>
            Selesaikan Dokumen
        </button>
        <button v-else-if="doc_status === 'CLOSED'" type="button" v-on:click="startPatientDocument"
            class="btn btn-success">
            <i class="fa fa-unlock" aria-hidden="true"></i>
            Lanjutkan Dokumen
        </button>
    </div>
</div>
<!-- Pasien Info Data -->
```

Card Header yang ada filter dan refresh button

```html
<div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="mb-0 text-dark">Daftar Riwayat</h5>
    <div>
        <button type="button" class="btn btn-outline-secondary" data-toggle="modal"
            data-target="#filterModal">
            <i class="fa fa-filter" aria-hidden="true"></i>
        </button>
        <button type="button" class="btn btn-outline-secondary"
            @click="typeof loadPage === 'function' ? loadPage(1) : (typeof getStaticJson === 'function' ? getStaticJson() : null)">
            <i class="fa fa-refresh" aria-hidden="true"></i>
        </button>
    </div>
</div>
```

</form>

# PHP PRINT

pada php ini, semua data tabel yang di tambahkan ke database (payload) pada object entry data yang contohnya bisa diliat dibawah ini, disimpan dalam variabel $entries dan data pasien disimpan dalam variabel  $static

contoh data yang ditambahkan ke database : 

```php
const payload = {
    patient_document_id: this.doc_id,
    entry_data: this.cppt_tmp,
};
```

*Template Opening PHP*

```php
<?php
// Ambil Key dari Argumen (bukan data JSON)
$redisKey = $argv[1];
$serverAddress = $argv[2];

// Koneksi ke Redis
$redis = new Redis();
try {
    $redis->connect('localhost', 6379);
} catch (Exception $e) {
    die("Gagal koneksi ke Redis: " . $e->getMessage());
}

// Ambil Data JSON dari Redis
$jsonString = $redis->get($redisKey);
$staticJsonString = $redis->get($redisKey . "_static");

if (!$jsonString) {
    die("Dokumen ini tidak memiliki preview.");
}

// Decode JSON
$params = json_decode($jsonString);
$static_label = json_decode($staticJsonString);

$title = "ASSESMEN MEDIS LANJUTAN RAWAT JALAN";

$entries = isset($params->entry) ? $params->entry : [];
$static = isset($params->static_json->static_json) ? $params->static_json->static_json : null;
```

# CONTOH IMPLEMENTASI

*Contoh Pada KOP dan data pasien*

```php
<!-- HEADER ATAS (Informasi Rumah Sakit & Pasien) -->
<table width="100%" class="table-bordered">
    <tr>
        <td style="width: 60%; vertical-align: middle">
            <table class="mini-table table-borderless">
                <tr>
                    <td width="25%" style="vertical-align: middle">
                        <center><img style="width: 80%;" src="<?= $serverAddress ?>/images/rs/LogoRS.png"></center>
                    </td>
                    <td style="vertical-align: middle">
                        <h3 class="text-center" style="margin: 0"><?php echo $static_label->hospital_name; ?></h3>
                        <!--<h3 class="text-center" style="margin: 0"><?php echo $static_label->hospital_name2; ?></h3>-->
                        <center><?php echo $static_label->hospital_address; ?> </center>
                        <center>Tlp. <?php echo $static_label->hospital_phone; ?></center>
                        <center>Email. <?php echo $static_label->hospital_email; ?></center>
                    </td>
                </tr>
            </table>
        </td>
        <td style="vertical-align: middle">
            <table class="mini-table table-borderless">
                <tr>
                    <td style="width: 31%;">No. RM</td>
                    <td width="1%">:</td>
                    <td>
                        <?= htmlspecialchars($static->px_data->no_rm ?? '-') ?>
                    </td>
                </tr>
                <tr>
                    <td class="text-top">Nama</td>
                    <td>:</td>
                    <td>
                        <?= htmlspecialchars($static->px_data->nama ?? '-') ?>
                    </td>
                </tr>
                <tr>
                    <td>Tgl Lahir</td>
                    <td>:</td>
                    <td>
                        <?= htmlspecialchars(tgl_indo($static->px_data->tanggal_lahir ?? '-')) ?>
                    </td>
                </tr>
                <tr>
                    <td>Jenis Kelamin</td>
                    <td>:</td>
                    <td>
                        <?= htmlspecialchars(cekJenisKelamin($static->px_data->kelamin ?? '')) ?>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
```

*Contoh pada data entry lain*

```php
<?php foreach ($entries as $row): ?>
    <?php $v = is_object($row) && isset($row->entry_data) ? $row->entry_data : $row; ?>
    <tr <?= $v->profesi === 'Dokter' ? 'style="background-color: #f0fdfc;"' : '' ?>>
        <!-- Kolom 1: Waktu & Lokasi -->
        <td style="font-size: 9pt;">
            <b><?= $v->tanggal_cppt_indo ?></b><br>
            <?= $v->jam_cppt ?> WIB<br>
            <small>
                <?= $v->klinik ? "Klinik: {$v->klinik}" : "" ?>
                <?= $v->igd ? "IGD: {$v->igd}" : "" ?>
                <?php if ($v->bangsal || $v->ruang || $v->kelas): ?>
                    <br>Unit: <?= $v->bangsal ?> <?= $v->ruang ? "({$v->ruang})" : "" ?>
                <?php endif; ?>
            </small>
        </td>

        <!-- Kolom 2: Profesi -->
        <td class="text-center">
            <b><?= $v->profesi ?></b>
        </td>
     </tr>
<?php endforeach; ?>
```