---
name: inject-grafik-pertumbuhan
description: This document provides the standard code snippets for integrating dynamic Growth Charts (Grafik Pertumbuhan) using Chart.js. AI agents MUST paste these code snippets and adjust the variable names appropriately according to the user's specific chart requirements.
---
<!-- abaikan ini!!!! : 
contoh dokumen : RS34_RMK46
PEMERIKSAAN NEONATUS di local/datuberu -->

# Inject Growth Chart (Grafik Pertumbuhan)

This sub-skill is responsible for updating `output/index.html` and `output/json.js`. It integrates an interactive Scatter chart using Chart.js that allows users to input coordinates (e.g., week and measurement), renders the points dynamically against standard reference lines, and saves the chart as a base64 image.

---

# Execution Protocol

## Step 1: Inject Chart.js Dependencies into `output/index.html`

Ensure that the Chart.js and annotation plugin scripts are included in the `<head>` tag of `output/index.html`. Add them if they do not exist.

```html
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-annotation"></script>
```

---

## Step 2: Inject Data Structure into `output/json.js`

Add the data array and base64 string properties to both the `sample` data and `default` data versions inside `output/json.js`.

*Note: Replace `grafik_nama_chart` with the appropriate context name (e.g., `grafik_pertumbuhan`, `grafik_berat_badan`).*

```json
        "grafik_nama_chart_data": [],
        "grafik_nama_chart_base64": "",
```

---

## Step 3: Inject the HTML Layout into `output/index.html`

Insert the following layout block where the chart should be displayed. It includes the canvas, input forms, action buttons, and an interactive data table.

*Note: Adjust IDs, `v-model` bindings, method names, and labels appropriately.*

```html
    <!-- Start Card Grafik -->
    <div class="card patient-card shadow-sm mt-5" id="id-card-grafik">
        <div class="card-header bg-light">
            <h5 class="mb-0 text-dark">Judul Grafik</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <canvas id="idCanvasChart" style="width: 100%; max-width: 800px; margin-bottom: 20px;"></canvas>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 form-group">
                    <label><b>Sumbu X (cth: Minggu)</b></label>
                    <div class="input-group">
                        <input type="number" class="form-control"
                            v-model.number="objek_penyimpan.nilai_x" />
                        <div class="input-group-prepend"><span class="input-group-text">Satuan X</span></div>
                    </div>
                </div>
                <div class="col-md-3 form-group">
                    <label><b>Sumbu Y (cth: Ukuran)</b></label>
                    <div class="input-group">
                        <input type="number" class="form-control"
                            v-model.number="objek_penyimpan.nilai_y" />
                        <div class="input-group-prepend"><span class="input-group-text">Satuan Y</span></div>
                    </div>
                </div>
                <div class="col-md-12 mt-2">
                    <button class="btn btn-primary" type="button" @click="tambahGrafikNamaChart">Tambah ke Grafik</button>
                    <button class="btn btn-danger ml-2" type="button" @click="resetGrafikNamaChart" v-if="grafik_nama_chart_data.length > 0">Reset Grafik</button>
                </div>

                <!-- tampilkan data sumbu x dan sumbu y nya di bawah ini dalam bentuk tabel dan bisa di edit serta hapus -->
                <div class="col-md-12 mt-3" v-if="grafik_nama_chart_data.length > 0">
                    <table class="table table-bordered table-sm text-center">
                        <thead class="bg-light">
                            <tr>
                                <th>Sumbu X</th>
                                <th>Sumbu Y</th>
                                <th style="width: 150px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item, index) in grafik_nama_chart_data" :key="index">
                                <td>
                                    <input type="number" class="form-control form-control-sm text-center"
                                        min=0 v-model.number="item.x" @change="renderGrafikNamaChart" />
                                </td>
                                <td>
                                    <input type="number" class="form-control form-control-sm text-center"
                                        min=0 v-model.number="item.y" @change="renderGrafikNamaChart" />
                                </td>
                                <td>
                                    <button class="btn btn-danger btn-sm" type="button"
                                        @click="hapusGrafikNamaChart(index)">
                                        <i class="fa fa-trash"></i> Hapus
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- End Card Grafik -->
```

---

## Step 4: Inject Vue Methods into `output/index.html`

Insert the rendering and interaction logic inside the `methods: { ... }` block of the Vue instance. 

*Note: Replace all occurrences of `NamaChart`, `grafik_nama_chart_data`, and reference lines (`ds90`, `ds50`, `ds10`) according to the specific chart's requirements.*

```javascript
                renderGrafikNamaChart: function() {
                    if (this.namaChartInstance) {
                        this.namaChartInstance.destroy();
                    }
                    const canvasEl = document.getElementById('idCanvasChart');
                    if (!canvasEl) return;
                    const ctx = canvasEl.getContext('2d');
                    
                    const dataPoints = this.grafik_nama_chart_data.map(item => ({
                        x: item.x, // Sesuaikan dengan key di json
                        y: item.y  // Sesuaikan dengan key di json
                    }));

                    // Sesuaikan garis referensi sesuai kebutuhan
                    const ds90 = [{x: 24, y: 100}, {x: 45, y: 200}];
                    const ds50 = [{x: 24, y: 50}, {x: 45, y: 150}];
                    const ds10 = [{x: 24, y: 10}, {x: 45, y: 100}];

                    this.namaChartInstance = new Chart(ctx, {
                        type: 'scatter',
                        data: {
                            datasets: [
                                {
                                    label: 'Data Pasien',
                                    data: dataPoints,
                                    borderColor: 'green',
                                    backgroundColor: 'green',
                                    showLine: true,
                                    pointRadius: 5
                                },
                                {
                                    label: '90%',
                                    data: ds90,
                                    borderColor: 'black',
                                    borderWidth: 2,
                                    showLine: true,
                                    pointRadius: 0
                                },
                                {
                                    label: '50%',
                                    data: ds50,
                                    borderColor: 'black',
                                    borderWidth: 3,
                                    borderDash: [5, 5],
                                    showLine: true,
                                    pointRadius: 0
                                },
                                {
                                    label: '10%',
                                    data: ds10,
                                    borderColor: 'black',
                                    borderWidth: 4,
                                    showLine: true,
                                    pointRadius: 0
                                }
                            ]
                        },
                        options: {
                            animation: false,
                            scales: {
                                x: {
                                    type: 'linear',
                                    position: 'bottom',
                                    title: { display: true, text: 'Label Sumbu X' },
                                    min: 24, // Sesuaikan
                                    ticks: { stepSize: 1 }
                                },
                                y: {
                                    title: { display: true, text: 'Label Sumbu Y' },
                                    min: 0, // Sesuaikan
                                    ticks: { stepSize: 10 }
                                }
                            }
                            // Tambahkan plugin annotations di sini jika dibutuhkan (opsional)
                        }
                    });
                },
                tambahGrafikNamaChart: function() {
                    const x_val = parseFloat(this.objek_penyimpan.nilai_x);
                    const y_val = parseFloat(this.objek_penyimpan.nilai_y);
                    if (x_val && y_val) {
                        this.grafik_nama_chart_data.push({ x: x_val, y: y_val }); // Sesuaikan nama key object
                        // Urutkan berdasarkan sumbu X agar garisnya menyambung dengan benar
                        this.grafik_nama_chart_data.sort((a, b) => a.x - b.x); // Sesuaikan nama key object
                        this.renderGrafikNamaChart();
                    } else {
                        Swal.fire('Perhatian', 'Input Sumbu X dan Y harus diisi!', 'warning');
                    }
                },
                resetGrafikNamaChart: function() {
                    this.grafik_nama_chart_data = [];
                    this.renderGrafikNamaChart();
                },
                hapusGrafikNamaChart: function(index) {
                    Swal.fire({
                        title: "Apa anda yakin?",
                        text: "Data yang dihapus tidak dapat dikembalikan!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "red",
                        cancelButtonColor: "grey",
                        confirmButtonText: "Ya, hapus!"
                    }).then((result) => {
                        if (result.isConfirmed || result.value) {
                            if (index > -1) {
                                this.grafik_nama_chart_data.splice(index, 1);
                                this.renderGrafikNamaChart();
                            }
                            Swal.fire({
                                icon: "success",
                                title: "Berhasil menghapus data",
                                showConfirmButton: false,
                                timer: 1000
                            });
                        }
                    });
                },
```

---

## Step 5: Inject Rendering Hook on Load

To ensure the chart renders automatically when the document loads or edits are opened, call the render method inside `setupSignature` within the `$nextTick` block:

```javascript
                    this.$nextTick(() => {
                        // ... kode canvas ttd lainnya ...
                        this.renderGrafikNamaChart();
                    });
```

---

## Step 6: Inject Base64 Saving Hook into `saveDoc`

To ensure the chart can be printed on the PDF side, capture the canvas output as a base64 string during the save process. 
Locate the `saveDoc: function () { ... }` block and add the following hook before the JSON data assembly:

```javascript
const getChartBase64 = (canvasId) => {
    const canvas = document.getElementById(canvasId);
    if (!canvas) return "";
    // compress ukuran agar base64 tidak terlalu panjang (menghindari error argument list too long)
    const maxWidth = 500;
    let scale = 1;
    if (canvas.width > maxWidth) {
        scale = maxWidth / canvas.width;
    }
    const tempCanvas = document.createElement('canvas');
    tempCanvas.width = canvas.width * scale;
    tempCanvas.height = canvas.height * scale;
    const ctx = tempCanvas.getContext('2d');
    ctx.fillStyle = '#ffffff';
    ctx.fillRect(0, 0, tempCanvas.width, tempCanvas.height);
    ctx.drawImage(canvas, 0, 0, tempCanvas.width, tempCanvas.height);
    return tempCanvas.toDataURL('image/jpeg', 0.4);
};

this.grafik_nama_chart_base64 = getChartBase64('idCanvasChart');
```

---

# IMPORTANT RULES FOR THE AI AGENT

1. **Adapt Variable Names:** The placeholders like `NamaChart`, `grafik_nama_chart_data`, and `idCanvasChart` MUST be intelligently renamed to match the user's specific context (e.g. `Pertumbuhan`, `grafik_berat_badan_data`, `beratBadanChart`).
2. **Chart Configuration:** Adjust the `min`, `max`, `stepSize`, and reference dataset arrays (`ds90`, `ds50`, `ds10`) exactly as required by the medical chart or the user's prompt.
3. **Data Source Integration:** Verify whether `v-model.number` variables are appropriately pointing to the existing variables inside `data()` or if new ones must be created.



