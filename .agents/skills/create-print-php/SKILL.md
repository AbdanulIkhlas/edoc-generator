---
name: create-print-php
description: Memperbarui file output/print.php dengan menambahkan layout HTML untuk kebutuhan print/PDF berdasarkan template dokumen tanpa mengubah struktur, fungsi, maupun style yang sudah tersedia.
---

# PRINT PHP GENERATOR

Skill ini bertugas **memperbarui** file `output/print.php` agar menghasilkan tampilan cetak (Print/PDF) yang semirip mungkin dengan template dokumen.

Skill ini **BUKAN** generator file dari awal.

File `output/print.php` **SUDAH ADA** dan hanya boleh diperbarui dengan cara menambahkan isi body dokumen tanpa mengubah struktur aplikasi yang telah tersedia.

---

# TUJUAN

Menghasilkan layout print yang:

- menyerupai template PDF semaksimal mungkin
- siap digunakan oleh DOMPDF
- menggunakan HTML Table sebagai layout utama
- menggunakan binding data PHP (`$params`)
- mempertahankan seluruh struktur file yang sudah ada

---

# SUMBER ANALISIS

Sebelum melakukan perubahan, AI WAJIB menganalisis seluruh sumber berikut.

## 1. Template PDF

```
input/template.pdf
```

---

## 2. Gambar (Opsional)

Apabila tersedia:

```
input/image-1.png
input/image-2.png
input/image-3.png
...
```

Gunakan gambar sebagai referensi utama karena biasanya memiliki kualitas visual lebih baik dibanding hasil render PDF.

---

## 3. Contoh Implementasi

Di dalam folder

```
example/
```

telah tersedia beberapa contoh implementasi.

AI WAJIB menjadikannya referensi untuk:

- struktur HTML
- layout tabel
- styling
- pola binding data
- konsistensi tampilan
- penggunaan class

---

# FILE YANG DIPERBARUI

```
output/print.php
```

---

# PRINSIP UTAMA

Skill ini bersifat **NON-DESTRUCTIVE**.

Artinya AI hanya boleh MENAMBAHKAN.

AI tidak boleh MEROMBAK.

---

# YANG BOLEH DILAKUKAN

- menambahkan HTML
- menambahkan table
- menambahkan class CSS baru
- menambahkan inline style
- menambahkan helper function
- menambahkan variable PHP baru apabila diperlukan

---

# YANG DILARANG

AI TIDAK BOLEH:

- menghapus HTML existing
- mengubah struktur file
- menghapus function
- mengubah function existing
- menghapus variable
- mengubah variable existing
- menghapus class CSS
- mengubah class CSS existing
- mengganti struktur aplikasi
- mengganti library
- menghapus konfigurasi DOMPDF

Seluruh kode existing harus tetap dipertahankan.

---

# FOKUS PERUBAHAN

Perubahan hanya difokuskan pada BODY dokumen.

Header, konfigurasi, helper, dan struktur file yang sudah tersedia tidak boleh diubah.

---

# TARGET LAYOUT

Layout hasil generate harus semirip mungkin dengan:

```
input/template.pdf
```

Hal yang harus diikuti:

- posisi komponen
- urutan section
- ukuran tabel
- pembagian kolom
- alignment
- spacing
- border
- grouping data

Gunakan HTML Table sebagai dasar layout.

JANGAN menggunakan Flexbox maupun CSS Grid sebagai layout utama.

---

# LAYOUT UTAMA

Seluruh isi dokumen WAJIB dibangun menggunakan HTML Table.

Nested table diperbolehkan apabila diperlukan.

---

# BORDER

Gunakan class yang sudah tersedia apabila memungkinkan.

Contoh:

```
table-bordered
table-borderless
```

Apabila membutuhkan border khusus, AI boleh membuat class CSS baru atau menggunakan inline style.

---

# HEADER / KOP DOKUMEN

Apabila template memiliki kop rumah sakit, gunakan template berikut secara utuh.

```html
<table style="width: 100%;">
    <tr style="padding-bottom: 5px; padding-top: 5px;">
        <td width="15%" style="vertical-align: middle; text-align: center;">
            <img style="width: 70px" src="<?= $base_url; ?>/images/rs/LogoRS.png">
        </td>
        <td width="40%" style="vertical-align: middle;">
            <h4 style="margin: 0; font-size: 14pt;"><?php echo $static_label->hospital_name; ?></h4>
            <div style="font-size: 10pt; line-height: 1.3; margin-top: 5px;">
                <?php echo !empty($static_label->hospital_address) ? $static_label->hospital_address . "<br>" : ""; ?>
                <?php echo !empty($static_label->hospital_phone) ? "Telp. " . $static_label->hospital_phone . "<br>" : ""; ?>
                <?php echo !empty($static_label->hospital_email) ? "Email: " . $static_label->hospital_email : ""; ?>
            </div>
        </td>
        <td class="borderr" width="45%" style="vertical-align: middle; padding: 10px; font-size:12pt">
            <table style="width:100%;">
                ...
            </table>
        </td>
    </tr>
</table>
```

Gunakan template tersebut tanpa mengubah strukturnya.

---

# BINDING DATA

Seluruh data WAJIB menggunakan objek

```php
$params
```

Contoh

```php
<?php echo $params->pasien->nama ?? ""; ?>
```

Gunakan null coalescing (`?? ""`) apabila memungkinkan agar aman ketika data kosong.

---

# FORMAT TANGGAL

Selalu gunakan helper berikut.

```php
function tgl_indo($tanggal)
{
    if (empty($tanggal) || $tanggal === '0000-00-00') {
        return '';
    }

    $bulan = [
        1 => 'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    ];

    $timestamp = strtotime($tanggal);

    if ($timestamp === false) {
        return '';
    }

    $hari = date('j', $timestamp);   // tanpa leading zero
    $bulan_ke = date('n', $timestamp);
    $tahun = date('Y', $timestamp);

    return $hari . ' ' . $bulan[$bulan_ke] . ' ' . $tahun;
}
```

Kemudian panggil seperti berikut.

```php
<?= tgl_indo($params->pasien->tanggal_lahir) ?>
```

JANGAN menggunakan format tanggal lain.

---

# STATIC LABEL

Setiap informasi rumah sakit WAJIB menggunakan variable berikut.

```php
$hospital_name
$hospital_address
$hospital_phone
$hospital_email
$hospital_city
```

Jangan hardcode nama rumah sakit maupun kota.

---

# TEXTAREA

Seluruh field multiline WAJIB menggunakan

```php
<?php echo nl2br($params->catatan ?? ""); ?>
```

Gunakan `nl2br()` agar line break tetap tampil pada hasil print.

---

# TANDA TANGAN

Seluruh tanda tangan WAJIB menggunakan gambar dari objek

```php
$params->ttd_data
```

Contoh

```html
<img src="<?php echo $params->ttd_data->dokter_stroke; ?>"
     style="height:100px;width:auto;display:block;margin:10px auto;">
```

Gunakan field sesuai nama penandatangan.

---

# GAMBAR

Apabila template memiliki gambar tambahan,

gunakan path relatif.

Contoh

```html
<img src="../images/image-1.png">
```

AI tidak perlu membuat asset gambar.

---

# STYLE

Gunakan styling sesederhana mungkin.

Prioritas:

1. class CSS existing
2. class baru apabila diperlukan
3. inline style apabila styling hanya digunakan sekali

---

# PAGE BREAK

Seluruh section WAJIB dibungkus dalam master table.

Contoh

```
.main-outer-table
```

Gunakan

```css
page-break-inside: auto;
```

JANGAN menggunakan

```css
page-break-inside: avoid;
```

pada container utama.

Hal ini bertujuan agar apabila isi halaman melebihi Page 1, maka baris tabel akan mengalir secara alami ke halaman berikutnya tanpa menyisakan ruang kosong.

---

# KONSISTENSI LAYOUT

AI harus mempertahankan:

- alignment
- ukuran kolom
- posisi label
- posisi value
- ukuran font
- border
- padding
- margin

Semirip mungkin dengan template.

---

# RULES
1. semua td dari tabel menggunakan valign="top"
2. Wajib sama persis dengan layout dari template `input/template.pdf`
3. Buat yang rapi dan mengisi semua space kosong
4. Layouting menggunakan tabel dan styling menggunakan style yang sudah ada seperti `table-bordered` dan `table-borderless`
5. Gunakan  font size 12pt untuk body dan 14pt untuk title dan header
6. Jangan menggunakan Bold tambahan, sesuaikan dengan template pdf nya saja

---

# VALIDASI

Sebelum selesai, pastikan:

- struktur file existing tetap utuh
- tidak ada kode existing yang dihapus
- tidak ada function existing yang diubah
- seluruh layout menggunakan HTML Table
- layout menyerupai template PDF
- seluruh data menggunakan `$params`
- seluruh tanggal menggunakan `tgl_indo()`
- seluruh textarea menggunakan `nl2br()`
- seluruh informasi rumah sakit menggunakan `$static_label`
- seluruh tanda tangan menggunakan `$params->ttd_data`
- border menggunakan class existing apabila tersedia
- page break menggunakan `page-break-inside: auto`
- layout siap digunakan oleh DOMPDF
- referensi pada folder `example/` telah dijadikan acuan untuk menjaga konsistensi struktur dan tampilan