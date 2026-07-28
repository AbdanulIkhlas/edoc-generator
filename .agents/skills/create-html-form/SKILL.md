---
name: create-html-form
description: Memperbarui file output/index.html dengan menambahkan struktur HTML form berdasarkan template PDF, gambar formulir, output/json.js, dan instruksi tambahan tanpa mengubah struktur aplikasi yang sudah ada.
---

# HTML FORM UPDATER

Skill ini bertugas **memperbarui** file `output/index.html` dengan menambahkan kerangka (skeleton) HTML form berdasarkan hasil analisis template dokumen.

Skill ini **BUKAN** generator HTML dari nol.

File `output/index.html` **SUDAH ADA** dan hanya boleh diperbarui dengan cara **menambahkan** elemen yang belum ada.

---

# TUJUAN

Menghasilkan struktur HTML form yang sesuai dengan template formulir sehingga siap digunakan sebagai editor eDoc.

Skill ini hanya berfokus pada:

- struktur HTML
- binding data Vue (`v-model`)
- layout form
- pembagian section
- navigasi section

Skill ini **TIDAK** bertugas:

- mempercantik tampilan
- membuat validasi
- mengubah logika JavaScript
- mengubah CSS
- mengubah struktur aplikasi

---

# SUMBER ANALISIS

Sebelum melakukan perubahan, AI WAJIB menganalisis seluruh sumber berikut.

## 1. Template PDF

```
input/template.pdf
```

---

## 2. Gambar Form (Opsional)

Apabila terdapat gambar

```
input/image-1.png
input/image-2.png
input/image-3.png
...
```

maka gambar menjadi referensi utama untuk menentukan layout karena biasanya memiliki kualitas visual lebih baik dibanding PDF.

---

## 3. Data JSON

```
output/json.js
```

Gunakan struktur data yang sudah tersedia sebagai dasar binding seluruh field.

AI tidak boleh membuat nama field baru apabila field tersebut sudah tersedia pada `output/json.js`.

---

## 4. Instruksi Tambahan

Selain PDF dan gambar, AI WAJIB memperhatikan seluruh instruksi tambahan yang diberikan pada prompt, misalnya:

- field tertentu berupa dropdown
- jumlah tanda tangan
- field wajib
- field readonly
- field hidden
- komponen khusus
- layout tertentu

Instruksi tambahan selalu memiliki prioritas tertinggi.

---

## 5. Folder Referensi

Di dalam folder

```
example/
```

telah tersedia beberapa contoh implementasi.

AI WAJIB menjadikan file-file tersebut sebagai referensi mengenai:

- struktur HTML
- layout section
- pola binding Vue
- penggunaan komponen
- konsistensi tampilan

Gunakan referensi tersebut untuk menjaga konsistensi antar eDoc.

---

# FILE YANG DIPERBARUI

```
output/index.html
```

---

# PRINSIP UTAMA

Skill ini bersifat **NON-DESTRUCTIVE**.

Artinya:

AI hanya boleh MENAMBAHKAN.

AI tidak boleh MEROMBAK.

---

# YANG BOLEH DILAKUKAN

- menambahkan section baru
- menambahkan field baru
- menambahkan komponen baru
- menambahkan function baru apabila memang diperlukan
- menambahkan computed
- menambahkan watcher
- menambahkan style baru apabila memang diperlukan

---

# YANG DILARANG

AI TIDAK BOLEH:

- menghapus HTML yang sudah ada
- mengubah struktur HTML yang sudah ada
- memindahkan posisi komponen existing
- menghapus script
- mengubah script
- menghapus method
- mengubah method
- menghapus function
- mengubah function
- menghapus computed
- mengubah computed
- menghapus watcher
- mengubah watcher
- menghapus CSS
- mengubah CSS
- mengganti library
- mengganti Bootstrap
- mengganti Vue
- mengubah struktur aplikasi
- tidak perlu membuat kop

Seluruh kode existing harus tetap utuh.

---

# FOKUS PERUBAHAN

Perubahan hanya difokuskan pada bagian BODY FORM.

AI cukup membuat kerangka HTML berdasarkan template.

Belum perlu membuat logika kompleks.

---

# STRUKTUR SECTION

Setiap section WAJIB menggunakan Card sesuai standar aplikasi.

Contoh:

```
Card

Header

Body

Footer (jika diperlukan)
```

Jangan membuat section tanpa Card.

template card bisa menggunakan ini : (bisa dilihat pada `resource/ui_component.md`)

```html
<!-- Start Card [Section Name] -->
<div class="card patient-card shadow-sm mt-5" id="card-[section-id]">
  <div class="card-header bg-light">
    <h5 class="mb-0 text-dark">[Section Title]</h5>
  </div>
  <div class="card-body">
    <div class="row">
      <div class="col-md-12">
        <!-- Place input/form elements here -->
      </div>
    </div>
  </div>
</div>
<!-- End Card [Section Name] -->
```

---

# NAVIGASI SECTION

Setiap kali AI menambahkan section baru, AI WAJIB menambahkan data navigasi ke:

```javascript
data.navSections = [
  {
    id: "...",
    title: "...",
  },
];
```

Contoh

```javascript
{
    id: "informasi-pasien",
    title: "Informasi Pasien"
}
```

Urutan `navSections` harus mengikuti urutan section pada halaman.

---

# BINDING DATA

Seluruh field WAJIB menggunakan binding Vue.

## String

```html
v-model="data.sample.nama"
```

---

## Number

Gunakan

```html
v-model.number=""
```

Contoh

```html
v-model.number="data.sample.umur"
```

---

## Boolean

Gunakan

```html
v-model=""
```

dengan checkbox standar.

---

# KOMPONEN

Gunakan komponen yang sudah tersedia.

JANGAN membuat komponen baru apabila komponen standar sudah tersedia.

---

## Checkbox

WAJIB menggunakan komponen checkbox standar yang terdapat pada

```
resource/ui_component.md
```

Tidak boleh membuat checkbox dengan struktur berbeda.

---

## Select

Gunakan komponen Select standar.

Option cukup menggunakan dummy terlebih dahulu apabila belum diketahui.

---

## Button

Gunakan Button standar sesuai referensi.

---

## Input

Gunakan Input standar.

---

## Textarea

Gunakan Textarea standar.

---

# GAMBAR

Apabila pada template terdapat gambar, logo, ilustrasi, maupun contoh hasil scan,

AI cukup membuat elemen gambar menggunakan path dummy.

Contoh

```html
<img src="../images/image-1.png" />
```

Gunakan penamaan sesuai file pada folder input.

Contoh

```
input/image-1.png
```

menjadi

```html
../images/image-1.png
```

AI tidak perlu mengubah ukuran maupun styling gambar secara detail.

---

# PENYESUAIAN LAYOUT

Layout harus mengikuti template.

Contoh:

- jumlah kolom
- urutan field
- posisi section
- grouping field
- posisi gambar
- posisi tabel

Namun tetap menggunakan komponen standar aplikasi.

---

# PENAMAAN FIELD

Seluruh binding harus mengikuti nama field pada

```
output/json.js
```

AI tidak boleh membuat nama field baru apabila field sudah tersedia.

---

# ATURAN KHUSUS

## 1. Input Tanggal
Untuk input tanggal, **TIDAK PERLU** lagi menambahkan attribute atau event seperti `onchange="tanggal_indo(...)"` karena sistem sudah tidak menggunakan format tanggal_indo pada form.

## 2. Pemeriksaan Fisik & Vital Sign (Tekanan Darah)
Jika di dalam dokumen (template) terdapat bagian Pemeriksaan Fisik atau Vital Sign yang menanyakan **Tekanan Darah (TD)**, maka AI **WAJIB** membuat **2 (dua)** field input yang terpisah untuk:
- Tensi Sistole
- Tensi Diastole

---

# SCRIPT

Bagian `<script>` merupakan bagian yang sangat penting.

AI WAJIB mempertahankan seluruh isi script.

AI tidak boleh:

- menghapus
- memindahkan
- merapikan
- mengubah urutan

Apabila membutuhkan function baru,

cukup tambahkan function baru tanpa mengubah function existing.

---

# STYLE

Bagian `<style>` juga harus dipertahankan.

AI tidak boleh menghapus maupun mengubah style existing.

Penambahan style baru diperbolehkan apabila benar-benar diperlukan.

---

# VALIDASI

Sebelum selesai, pastikan:

- seluruh struktur existing tetap utuh
- tidak ada HTML yang dihapus
- tidak ada script yang dihapus
- tidak ada CSS yang dihapus
- seluruh section menggunakan Card
- seluruh checkbox menggunakan komponen standar pada `resource/ui_component.md`
- seluruh select menggunakan komponen standar
- seluruh button menggunakan komponen standar
- seluruh input menggunakan komponen standar
- seluruh field telah menggunakan binding Vue
- seluruh field number menggunakan `v-model.number`
- seluruh section baru telah ditambahkan ke `data.navSections`
- urutan section sesuai template
- gambar menggunakan path `../images/image-x.png`
- struktur mengikuti template PDF/gambar
- seluruh binding sesuai dengan `output/json.js`
- tidak ada penggunaan `onchange="tanggal_indo(...)"` pada input tanggal
- field Tekanan Darah (TD) pada vital sign telah dipisah menjadi Tensi Sistole dan Tensi Diastole
- referensi pada folder `example/` telah dijadikan acuan untuk menjaga konsistensi struktur dan tampilan
