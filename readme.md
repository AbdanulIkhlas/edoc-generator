# EDOC GENERATOR

**EDOC GENERATOR** adalah flow pengerjaan EDOC dengan memanfaatkan skill untuk memanfaatkan Agentic AI agar pengerjaan bisa lebih cepat dan efisien.

---

## 🎯 Overview

Pembuatan dokumen elektronik ini membutuhkan file-file core berikut:
1. Konfigurasi Bridging API SIMRS (`config.json`)
2. Inisialisasi Data Default & Sample (`json.js`)
3. Skema Validasi Data (`schema.json`)
4. Antarmuka Form Input Interaktif berbasis Vue 2 (`index.html`)
5. Layout Dokumen Print/PDF berbasis PHP (`print.php`)

Dengan menggunakan sistem AI Agent, pembuatan dokumen-dokumen ini dapat dilakukan secara bertahap menggunakan *skill* spesifik yang sudah disediakan.

---

## 🔄 Alur Kerja (Workflow) Pembuatan eDoc

Berikut adalah langkah-langkah sistematis (Step-by-Step) untuk menjalankan AI Agent dalam membuat eDoc:

```mermaid
flowchart TD
    Start[Mulai Pembuatan eDoc] --> Step1[1. Persiapan Folder Input]
    Step1 -->|Copy folder templates| Step2[2. Pembuatan JSON & Schema]
    Step2 -->|create-json-and-schema| Step3[3. Pembuatan Form HTML]
    Step3 -->|create-html-form| Step4[4. Pembuatan Print PHP]
    Step4 -->|create-print-php| Step5[5. Integrasi Bridging]
    Step5 -->|Panggil bridging| Step6[6. Review & Penyesuaian]
    Step6 --> Finish[Selesai]
```

### Penjelasan Langkah-Langkah:

1. **Persiapan Folder Input**
   - Copy semua file yang ada di dalam folder `templates` ke dalam folder `output`. File-file ini akan menjadi dasar dari form HTML dan print PHP yang akan kita buat.

2. **Pembuatan File JSON dan Schema**
   - Berikan prompt kepada AI Agent:
     > "Jalankan `create-json-and-schema`"
   - Agent akan membaca dokumen referensi dan menghasilkan atau memperbarui file `output/json.js` dan `output/schema.json`.

3. **Pembuatan Form HTML**
   - Berikan prompt kepada AI Agent:
     > "Jalankan `create-html-form`"
   - **Tips:** Tambahkan informasi spesifik jika diperlukan. Contoh: *"Jalankan `create-html-form`, pada bagian pilihan agama tolong gunakan komponen dropdown, dan pada bagian keluhan gunakan textarea."*

4. **Penyesuaian Form Html**
   - Copy semua hasil dari `create-html-form` dan paste ke file `actual-file/index.html` pada bagian dalam komentar `CONTAINER CODE`, dan copy kembali ke `output/index.html` 
   (agar bisa di run di local dan liat preview-nya)

5. **Pembuatan Print PHP**
   - Berikan prompt kepada AI Agent:
     > "Jalankan `create-print-php`"
   - Agent akan memperbarui file `output/print.php` dengan layout cetak HTML/PHP yang presisi sesuai dengan referensi dokumen tanpa merusak struktur boilerplate.

6. **Integrasi Bridging SIMRS**
   - Panggil bridging satu per satu sesuai dengan kebutuhan dokumen.
   - Referensi bridging dapat dilihat pada file dokumentasi di dalam folder `.agents/skills/bridging-docs`.
   - Ikuti contoh prompting (cara memanggil) yang ada pada file `ztemplate/bridging_anything.md`.

7. **Review & Penyesuaian**
   - Periksa hasil dari file HTML dan PHP yang di-generate.
   - Perbaiki bagian yang kurang sesuai dengan layout asli atau jika ada fungsionalitas/style yang terlewat agar sesuai dengan UI yang diharapkan.

---

## 📁 Struktur Direktori

```text
edoc-generator/
├── .agents/skills/                   # Daftar Skill AI Agent
│   └── bridging-docs/                # Dokumentasi dan Snippet Bridging SIMRS
│   ├── create-continues-document/    # Skill untuk membuat dokumen berkelanjutan
│   ├── create-html-form/             # Skill untuk generate UI Form Vue 2
│   ├── create-json-and-schema/       # Skill untuk generate JSON & Schema
│   ├── create-print-php/             # Skill untuk generate Layout Print
├── actual-file/                      # Folder template form untuk run dilocal
├── components/                       # Folder komponen yang biasa digunakan
├── history-documents/                # History dokumen apa saja yang pernah dibuat, bisa jadi referensi
├── images/                           # Gambar yang dibutuhkan di index.html (jika butuh gambar)
├── input/                            # Tempat template dokumen yang akan dikerjakan
└── output/                           # Hasil generasi file dari AI Agent
    ├── config.json
    ├── json.js
    ├── schema.json
    ├── index.html
    └── print.php
├── templates/                        # File boilerplate/template dasar (index.html, print.php, dll)
├── ztemplate-promts/                 # Referensi prompt dan guideline (contoh: bridging_anything.md)
```

---

## 📌 Aturan Penting

- **Gunakan Skill yang Tersedia:** Selalu panggil agent menggunakan nama skill yang telah didefinisikan untuk memastikan proses berjalan sesuai standar dan menghasilkan output yang konsisten.
- **Isolasi Output:** Pastikan semua file hasil pekerjaan selalu tersimpan di dalam folder `output/`.
