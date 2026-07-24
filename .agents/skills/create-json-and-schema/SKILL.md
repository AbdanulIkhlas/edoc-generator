---
name: create-json-and-schema
description: Membuat atau memperbarui file output/json.js dan output/schema.json berdasarkan template PDF atau gambar formulir secara konsisten tanpa menghilangkan struktur yang sudah ada.
---

# JSON DAN SCHEMA GENERATOR
Skill ini bertugas menganalisis template dokumen (PDF maupun gambar) kemudian menghasilkan atau memperbarui struktur data yang digunakan oleh eDoc.
File yang dihasilkan adalah:
- `output/json.js`
- `output/schema.json`

Skill ini **bersifat non-destructive**, artinya hanya menambahkan data yang belum ada dan tidak boleh menghapus maupun mengubah struktur yang sudah tersedia.

---

# TUJUAN
Menghasilkan struktur data yang konsisten antara:
- template dokumen
- data dummy (`sample`)
- data kosong (`default`)
- JSON Schema (`schema.json`)

---

# INPUT

## Template PDF
```
target/template.pdf
```

## Gambar (Opsional)
```
target/image-1.png
target/image-2.png
target/image-3.png
...
```

Apabila terdapat gambar, maka gambar digunakan sebagai referensi utama karena biasanya memiliki resolusi lebih baik dibanding hasil render PDF.
Apabila gambar tidak tersedia, gunakan PDF sebagai sumber analisis.

---

# OUTPUT
Wajib menghasilkan atau memperbarui:
```
output/json.js
output/schema.json
```

---

# ALUR KERJA

## Langkah 1
Analisa seluruh isi dokumen.
Identifikasi seluruh komponen seperti:
- label
- field input
- checkbox
- radio button
- textarea
- tabel
- section
- grup data
- informasi pasien
- informasi dokter
- tanda tangan
- tanggal
- waktu
- nomor
- pilihan Ya/Tidak
- daftar pilihan

---

## Langkah 2
Tentukan struktur objek yang paling logis berdasarkan hubungan antar field.
Contoh:
```
Pasien

- Nama
- NIK
- Umur
```

menjadi
```json
pasien: {
    nama: "",
    nik: "",
    umur: ""
}
```

Bukan
```json
pasien_nama
pasien_nik
pasien_umur
```

---

## Langkah 3
Perbarui file
```
output/json.js
```

dengan menambahkan objek yang belum tersedia.

---

## Langkah 4

Generate

```
output/schema.json
```

berdasarkan objek

```
data.sample
```

dengan mengabaikan objek

```
external_link
```

---

# ATURAN FILE output/json.js

File ini **SUDAH ADA**.

Skill ini **TIDAK BOLEH** membuat ulang seluruh isi file.

Skill hanya boleh:

- menambahkan field baru
- menambahkan objek baru
- menambahkan array baru

Skill **TIDAK BOLEH**

- menghapus field
- mengubah nama field
- memindahkan field
- mengubah struktur existing
- mengubah value dummy yang sudah ada

---

## Struktur Dasar

Di dalam file terdapat variabel

```javascript
const data = {
    sample: {

    },

    default: {

    }
}
```

---

## Objek sample

Merupakan data dummy.

Semua field hasil analisa wajib berada di dalam objek ini.

Gunakan contoh data yang realistis.

Contoh

```javascript
nama: "Budi Santoso"

umur: 30

tinggi_badan: 170

aktif: true
```

---

## Objek default

Objek ini merupakan pasangan dari objek `sample`.

Struktur harus IDENTIK.

Namun seluruh value menggunakan default value.

Contoh

```javascript
sample

nama: "Budi"

umur: 20

aktif: true

----------------

default

nama: ""

umur: 0

aktif: false
```

---

## external_link

Objek

```javascript
external_link
```

hanya ada pada

```
sample
```

JANGAN menambahkannya pada

```
default
```

---

# Default Value

|string|`""`|
|------|------|
|number|`0`|
|boolean|`false`|
|array|`[]`|
|object|`{}`|

---

# Penentuan Tipe Data

Gunakan aturan berikut.

|Jenis Field|Tipe|
|------------|----|
|Nama|string|
|Alamat|string|
|Nomor RM|string|
|NIK|string|
|Telepon|string|
|Tanggal|string|
|Jam|string|
|Diagnosis|string|
|Catatan|string|
|Checkbox|boolean|
|Radio Ya/Tidak|boolean|
|Jumlah|number|
|Usia|number|
|Berat Badan|number|
|Tinggi Badan|number|
|List Dinamis|array|
|Tabel Berulang|array object|

Apabila tipe tidak dapat dipastikan, gunakan

```
string
```

---

# Penamaan Field

Gunakan

- snake_case
- huruf kecil
- bahasa Indonesia

Contoh

```
nama_pasien

tanggal_lahir

riwayat_alergi
```

Jangan menggunakan

```
NamaPasien

Nama Pasien

namaPasien
```

---

# ATURAN ARRAY

Apabila terdapat data yang dapat muncul lebih dari satu kali, gunakan array.

Contoh

```
Riwayat Operasi

- Operasi A
- Operasi B
```

menjadi

```javascript
riwayat_operasi: [
    {
        nama_operasi: "",
        tanggal_operasi: ""
    }
]
```

---

# ATURAN OBJECT

Field yang masih berada dalam satu kelompok wajib dijadikan object.

Contoh

```
Dokter

Nama

SIP

Spesialis
```

menjadi

```javascript
dokter: {
    nama: "",
    sip: "",
    spesialis: ""
}
```

---

# ATURAN schema.json
Schema harus dihasilkan dari
```
data.sample
```

dengan ketentuan:
- mengabaikan objek `external_link`
- schema valid
- tidak menggunakan `required`
- seluruh tipe harus sesuai dengan tipe data pada `sample`
- menggunakan format JSON Schema Draft-07

---

# PENANGANAN FIELD YANG SUDAH ADA
Apabila field sudah terdapat pada
```
output/json.js
```

maka
- jangan dibuat ulang
- jangan diubah
- jangan dipindahkan
- jangan diganti nama

---

# PENANGANAN INFORMASI YANG TIDAK JELAS
Apabila tulisan pada PDF atau gambar tidak dapat dibaca dengan jelas:
- gunakan nama field yang paling mendekati konteks
- jangan membuat field yang tidak memiliki dasar
- jangan mengarang struktur baru

---

# CONTOH
sebagai contoh json.js dan schema, bisa lihat pada folder `example`

# VALIDASI
Sebelum selesai, pastikan:
- seluruh field pada template sudah terwakili
- tidak ada field duplikat
- struktur object logis
- struktur `sample` dan `default` identik
- `external_link` hanya ada pada `sample`
- seluruh default value sesuai tipe data
- schema valid
- schema sesuai dengan `sample`
- schema tidak memiliki `required`
- file JSON valid
- file JavaScript valid