<?php
// EMR Data
$params = json_decode($argv[1]);

$base_url = $argv[2]; // Base_url
$title = 'Ringkasan Masuk Keluar';
$static_label = json_decode($argv[3]);

// Fungsi untuk menampilkan hubungan dengan lingkaran
function displayHubungan($selected, $options, $lainnya = '')
{
    $out = '';
    $first = true;

    foreach ($options as $opt) {
        if (!$first) {
            $out .= ' / ';
        }
        // bungkus setiap opsi dalam span agar width & font konsisten
        if ($selected === $opt) {
            $out .= "<span class='hubungan-item circle'>$opt</span>";
        } else {
            $out .= "<span class='hubungan-item'>$opt</span>";
        }
        $first = false;
    }

    // lainnya
    if ($selected === 'Lainnya' && !empty($lainnya)) {
        $out .= " / <span class='hubungan-item circle'>$lainnya</span>";
    } elseif (!in_array($selected, $options) && !empty($selected)) {
        $out .= " / <span class='hubungan-item circle'>$selected</span>";
    }

    return $out;
}

// tampilkan angka rawat inap dengan lingkaran tanpa tanda /
function displayInapKe($selected, $options, $lainnya = '')
{
    $out = '';

    foreach ($options as $opt) {
        // bungkus tiap angka
        if ($selected === $opt) {
            $out .= "<span class='hubungan-item circle'>$opt</span>";
        } else {
            $out .= "<span class='hubungan-item'>$opt</span>";
        }
        // tambahkan spasi antar angka, bukan slash
        $out .= ' ';
    }

    // jika pilih lainnya
    if ($selected === 'Lainnya' && !empty($lainnya)) {
        $out .= "<span class='hubungan-item circle'>$lainnya</span>";
    } elseif (!in_array($selected, $options) && !empty($selected)) {
        $out .= "<span class='hubungan-item circle'>$selected</span>";
    }

    return trim($out);
}

// Fungsi untuk mengekstrak kode ICD dari teks
function extractIcdCodes($text)
{
    $codes = [];
    $lines = explode("\n", $text);

    foreach ($lines as $line) {
        $line = trim($line);
        if (preg_match('/^(\d+)\.\s*([A-Z][0-9]{2}(?:\.[0-9])?)/', $line, $matches)) {
            $codes[] = $matches[2]; // Kode ICD
        }
    }

    return $codes;
}
// Diagnosa utama
$diagnosa_utama_codes = [];
if (!empty($params->diagnosa_masuk_freetext)) {
    $diagnosa_utama_codes = array_merge($diagnosa_utama_codes, extractIcdCodes($params->diagnosa_masuk_freetext));
}
if (!empty($params->diagnosa_masuk_autocomplete)) {
    foreach ($params->diagnosa_masuk_autocomplete as $item) {
        if (!empty($item->icd_x)) {
            $diagnosa_utama_codes[] = $item->icd_x;
        }
    }
}

// Diagnosa sekunder
$diagnosa_sekunder_codes = [];
if (!empty($params->diagnosa_sekunder_freetext)) {
    $diagnosa_sekunder_codes = array_merge($diagnosa_sekunder_codes, extractIcdCodes($params->diagnosa_sekunder_freetext));
}
if (!empty($params->diagnosa_sekunder_autocomplete)) {
    foreach ($params->diagnosa_sekunder_autocomplete as $item) {
        if (!empty($item->icd_x)) {
            $diagnosa_sekunder_codes[] = $item->icd_x;
        }
    }
}

// Tindakan
$tindakan_codes = [];
if (!empty($params->tindakan_list)) {
    foreach ($params->tindakan_list as $item) {
        if (!empty($item->icd_9_code)) {
            $tindakan_codes[] = $item->icd_9_code;
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
</head>
<style>
    body,
    h1,
    h2,
    h3,
    h4,
    h5,
    h6,
    p,
    ol,
    ul {
        margin: 0;
        padding: 0;
        font-weight: normal;
    }

    body {
        font: 12pt times new roman;
        size: f4;
        padding-bottom: 10px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th td {
        width: 30px;
    }

    td {
        height: 25px;
        box-sizing: border-box;
    }

    .table-bordered,
    .table-bordered th,
    .table-bordered td {
        border: 1px solid black;
        border-collapse: collapse;
        padding: .2em;
    }

    .table-borderless,
    .table-borderless th,
    .table-borderless td {
        border: none;
        border-collapse: collapse;
    }

    .img-logo {
        width: 250px;
        height: 70px;
    }

    .vertical-text {
        padding: 0;
        margin: 0;
        writing-mode: tb-rl;
        filter: flipv fliph;
        -webkit-transform: rotate(90deg);
        white-space: nowrap;
        text-orientation: mixed;
        font-weight: bold;
        text-align: center;
        vertical-align: middle;
    }

    .txt-vertical-1 {
        transform: translate(-40%, -50%) rotate(-90deg);
        -webkit-transform: translate(-40%, -50%) rotate(-90deg);
        position: absolute;
    }

    .txt-vertical-2 {
        transform: translate(-50%, -50%) rotate(-90deg);
        -webkit-transform: translate(-50%, -50%) rotate(-90deg);
        position: absolute;
    }

    .textbottomup {
        transform: rotate(180deg);
        writing-mode: vertical-rl;
        text-align: center;
    }

    .tanda-tangan {
        width: 100px;
        height: 100px;
    }

    .text {
        padding: 4px 0px;
    }

    .td-default {
        border: 1px solid black;
        padding: 0.5em 1em;
    }

    .td-borderless {
        border: 1px solid none;
        padding: 1em 1em;
    }

    .flex {
        display: table;
        width: 100%;
        box-sizing: border-box;
    }

    .flex-text-start {
        display: table-cell;
        text-align: right;
        text-wrap: nowrap;
        white-space: nowrap;
    }

    .flex-text-end {
        display: table-cell;
        text-align: left;
        text-wrap: nowrap;
        white-space: nowrap;
        white-space: nowrap;
    }

    .flex-text {
        display: table-cell;
        text-align: center;
        text-wrap: nowrap;
    }

    .flex-blank {
        display: table-cell;
        text-align: center;
    }

    .flex-dotted {
        display: table-cell;
        border-bottom: 2px dotted black;
        text-align: center;
    }

    .flex-solid {
        display: table-cell;
        border-bottom: 2px solid black;
        text-align: center;
    }

    .rectangle {
        display: inline-block;
        margin-right: 1em;
        border: 1px solid black;
        width: 11px;
        height: 11px;
    }

    .flex-container {
        padding: 0;
        margin: 0;
        width: 100%;
        list-style: none;
        -ms-box-orient: horizontal;
        -webkit-box-pack: left;
        display: -webkit-box;
        display: -moz-box;
        display: -ms-flexbox;
        display: -moz-flex;
        display: -webkit-flex;
        display: flex;
        flex-flow: row wrap;
        justify-content: space-between;
        align-items: stretch;
    }

    .flex-item {
        -webkit-flex-wrap: nowrap;
        flex-wrap: nowrap;
    }

    .flex-solid {
        display: -webkit-box;
        -webkit-box-pack: justify;
        flex: 1;
        -webkit-box-flex: 1;
        -webkit-flex: 1;
        border-bottom: 1px solid black;
    }

    .flex-dotted {
        display: -webkit-box;
        -webkit-box-pack: justify;
        flex: 1;
        -webkit-box-flex: 1;
        -webkit-flex: 1;
        border-bottom: 2px dotted black;
    }

    .flex-blank {
        display: -webkit-box;
        -webkit-box-pack: justify;
        flex: 1;
        -webkit-box-flex: 1;
        -webkit-flex: 1;
    }

    .w100 {
        width: 100%;
    }

    .w80 {
        width: 80%;
    }

    .w70 {
        width: 70%;
    }

    .w65 {
        width: 65%;
    }

    .w60 {
        width: 60%;
    }

    .w55 {
        width: 55%;
    }

    .w50 {
        width: 50%;
    }

    .w45 {
        width: 45%;
    }

    .w40 {
        width: 40%;
    }

    .w35 {
        width: 35%;
    }

    .w30 {
        width: 30%;
    }

    .w25 {
        width: 25%;
    }

    .w20 {
        width: 20%;
    }

    .w15 {
        width: 15%;
    }

    .w10 {
        width: 10%
    }

    .w5 {
        width: 5%
    }

    .w3 {
        width: 3%
    }

    .w1 {
        width: 1%
    }
    
    .pagebreak {
        min-height: 1px;
        page-break-before: always;
    }

    .hubungan-item {
        display: inline-block;
        text-align: center;
        font-family: "Times New Roman", serif;
        line-height: 1;
    }

    .circle {
        border: 2px solid black;
        border-radius: 50%;
        padding: 2px 4px;
        margin: 0 2px;
    }


    .table-kop {
        margin-top: 5px;
        margin-bottom: 10px;
        border-bottom: 3px solid black;
    }

    .tabel-info {
        margin-bottom: 10px;
    }
    .hospital-agen{
        font-size: 16px;
    }
    .hospital-name {
        font-size: 20px;
    }

    .hospital-address {
        font-size: 16px;
    }

    .table_data {
        margin-top: 0;
        border: 1px solid black;
        padding: 10px;
    }

    input[type=checkbox] {
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;

        width: 16px;
        height: 16px;
        border: 1px solid black;
        border-radius: 2px;
        display: inline-block;
        vertical-align: top; 
        cursor: pointer;
        margin-right: 5px;
    }

    input[type=checkbox]:checked::after {
        content: "✓";
        font-size: 20px;
        font-weight: bold;
        color: black;
        line-height: 1;
    }

    .border-left {
        border-left: 1px solid black;
    }

    .border-right {
        border-right: 1px solid black;
    }

    .border-top {
        border-bottom: 1px solid black
    }
    .border-bottom {
        border-bottom: 1px solid black
    }
</style>

<body>

    <!--KOP-->
    <table style="width:100%; border-collapse:collapse; border:1px solid black;">
        <tr>
            <!-- Logo -->
            <td style="width:120px; text-align:center;" align="center">
                <img src="<?= $base_url . '/images/rs/LogoRS.png' ?>" style="width:100px;" />
            </td>
            <td style="padding-top: 20px;" align="center" valign="top">
                <div class="hospital-agen">
                    <?php echo$static_label->hospital_agency ?>
                </div>
                <div class="hospital-name"><?= $static_label->hospital_name ?></div>
                <div class="hospital-address"><?= $static_label->hospital_address ?></div>
            </td>
            <td
                style="width:200px; heigth: 200px; text-align:center; vertical-align:middle; font-weight:bold; font-size:25px; border:1px solid black;">
                RM<br />01
            </td>
        </tr>
    </table>
    <!--KOP end-->
    
    <!--Table Info-->
    <table class="tabel-info table-bordered">
        <tr>
            <td align="center" width="50%">
                <h3>
                    <b>RINGKASAN MASUK KELUAR</b>
                </h3>
            </td>
            <td width="50%" style="padding: 10px">
                <table class="table-borderless">
                    <tr>
                        <td width="30%">Nama</td>
                        <td width="3%">:</td>
                        <td width="67%"><?= $params->pasien->nama ?></td>
                    </tr>
                    <tr>
                        <td>No. RM</td>
                        <td>:</td>
                        <td><?= $params->pasien->no_rm ?></td>
                    </tr>
                    <tr>
                        <td>Tgl Lahir/Umur</td>
                        <td>:</td>
                        <td>
                            <?= $params->pasien->tanggal_lahir_indo ?> / <?= $params->pasien->umur ?> Tahun
                        </td>
                    </tr>
                    <tr>
                        <td>Jenis Kelamin</td>
                        <td>:</td>
                        <td>
                            <?= $params->pasien->kelamin === 'Laki-laki' ? 'Laki-laki' : 'Perempuan' ?>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>


        <table class="table-bordered">
            <tr>
                <td width="50%">
                    Tanggal Kedatangan : <?= $params->tanggal_datang_indo ?>
                </td>
                <td width="50%">
                    Waktu Pemeriksaan: <?= $params->waktu_pemeriksaan ?>
                </td>
            </tr>
        </table>

        <table class="border-left border-right border-bottom">
            <!--Penididkan-->
            <tr>
                <td class="border-right" style="padding-left: 10px;" width="23%"><b>Pendidikan Pasien</b></td>
                <td style="padding-left: 10px;padding-right: 10px" width="77%"><?= $params->pasien->pendidikan ?></td>
            </tr>
            <!--Perkawinan-->
            <tr>
                <td class="border-right" style="padding-left: 10px;"><b>Status Perkawinan</b></td>
                <td style="padding-left: 10px;padding-right: 10px"><?= $params->status_kawin ?></td>
            </tr>
            <!--Pekerjaan-->
            <tr>
                <td class="border-right" style="padding-left: 10px;"><b>Status Pekerjaan</b></td>
                <td style="padding-left: 10px;padding-right: 10px;white-space: normal; word-break: break-word"><?= $params->pasien->pekerjaan ?></td>
            </tr>
            <!--Agama-->
            <tr>
                <td class="border-right" style="padding-left: 10px;"><b>Agama</b></td>
                <td style="padding-left: 10px;padding-right: 10px;"><?= $params->pasien->agama ?></td>
            </tr>
            <!--Suku-->
            <tr>
                <td class="border-right" style="padding-left: 10px;"><b>Suku Bangsa</b></td>
                <td style="padding-left: 10px;padding-right: 10px"><?= $params->suku_bangsa ?></td>
            </tr>
            <!--Penerjemah-->
            <tr>
                <td class="border-right" style="padding-left: 10px;"><b>Penerjemah</b></td>
                <td style="padding-right: 10px">
                    <div style="display: flex; flex-wrap: wrap;">
                        <label style="margin-left: 10px; margin-right: 19px;white-space: normal; word-break: break-word">
                            <input type="checkbox" <?= $params->penerjemah->bahasa === 'Tidak' ? 'checked' : '' ?>>
                            Tidak
                        </label>
                        <label>
                            <input type="checkbox" <?= $params->penerjemah->bahasa === 'Ya' ? 'checked' : '' ?>>
                            <span>Ya, Bahasa </span>
                            <span>
                                <?= $params->penerjemah->bahasa_apa ?>
                            </span>
                        </label>
                    </div>
                </td>
            </tr>
            <!--Kendala-->
            <tr>
                <td class="border-right" style="padding-left: 10px;"><b>Kendala komunikasi</b></td>
                <td style="padding-right: 10px; padding-left: 10px;">
                    <table class="table-borderless">
                        <tr>
                            <td width="33.34%">
                                <input type="checkbox" <?= $params->kendala_komunikasi === 'Pendengaran' ? 'checked' : '' ?>> Pendengaran
                            </td>
                            <td width="33.34%">
                                <input type="checkbox" <?= $params->kendala_komunikasi === 'Penglihatan' ? 'checked' : '' ?>> Penglihatan
                            </td>
                            <td width="33.34%">
                                <input type="checkbox" <?= $params->kendala_komunikasi === 'Bicara' ? 'checked' : '' ?>> Bicara
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <!--Alat Bantu-->
            <tr>
                <td class="border-right" style="padding-left: 10px;padding-right: 10px;"><b>Alat
                        Bantu</b></td>
                <td style="padding-right: 10px; padding-left: 10px;">
                    <table class="table-borderless">
                        <tr>
                            <td width="33.34%">
                                <input type="checkbox" <?= $params->alat_bantu === 'Kursi Roda' ? 'checked' : '' ?>> Kursi Roda
                            </td>
                            <td width="33.34%">
                                <input type="checkbox" <?= $params->alat_bantu === 'Brankar' ? 'checked' : '' ?>> Brankar
                            </td>
                            <td width="33.34%">
                                <input type="checkbox" <?= $params->alat_bantu === 'Kruk' ? 'checked' : '' ?>> Kruk
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <!--Rujukan-->
            <tr>
                <td class="border-right" style="align-text: top; padding-left: 10px;"><b>Rujukan Dari</b></td>
                <td style="padding-right: 10px; padding-left: 10px">
                    <table class="table-borderless">
                        <tr>
                            <td width="33.34%">
                                <input type="checkbox" <?= $params->rujukan->rujukan_dari === 'Klinik Dokter' ? 'checked' : '' ?>> Klinik Dokter
                            </td>
                            <td width="33.34%">
                                <input type="checkbox" <?= $params->rujukan->rujukan_dari === 'Puskesmas' ? 'checked' : '' ?>> Puskesmas
                            </td>
                            <td width="33.34%">
                                <input type="checkbox" <?= $params->rujukan->rujukan_dari === 'Rumah Sakit' ? 'checked' : '' ?>> Rumah Sakit
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <input type="checkbox" <?= $params->rujukan->rujukan_dari === 'Lainnya' ? 'checked' : '' ?>> Lainnya,
                                <span>
                                    <?= $params->rujukan->rujukan_dari_lainnya ?>
                                </span>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <!--Status Pembiayaan-->
            <tr>
                <td class="border-right" style="padding-left: 10px;" valign="top"><b>Status
                        Pembiayaan</b></td>
                <td style="padding-left: 10px;"><?= $params->status_pembiayaan ?></td>
            </tr>
        </table>

    <!--Keluarga & Pembayar-->
        <!--Keluarga Terdekat-->
        <table class="border-left border-right">
            <tr>
                <td style="padding-left: 10px;"><b>KELUARGA TERDEKAT :</b></td>
            </tr>
        </table>
        <table class="border-left border-right">
            <tr>
                <td width="8%;" style="padding-left: 10px;" valign="top">Nama</td>
                <td width="1%;" valign="top">:</td>
                <td width="20%;" valign="top" style="white-space: normal; word-break: break-word;">
                    <?= $params->keluarga->nama ?>
                </td>
                <td width="10%;" valign="top">Hubungan:</td>
                <td width="33%;" valign="top">
                    <?php
                    $options = ['Ayah', 'Ibu', 'Sdr Kandung'];
                    $selected = $params->keluarga->hubungan_pasien->hubungan;
                    $lainnya = $params->keluarga->hubungan_pasien->hubungan_lainnya;

                    echo displayHubungan($selected, $options, $lainnya);
                    ?>
                </td>
                <td width="12%;" valign="top"></td>
                <td width="16%;" valign="top">

                </td>
            </tr>
            <tr>
                <td style="padding-left: 10px;" valign="top">Pekerjaan</td>
                <td valign="top">:</td>
                <td valign="top" style="white-space: normal; word-break: break-word;">
                    <?= $params->keluarga->pekerjaan ?? "" ?>
                </td>
                <td valign="top">Alamat:</td>
                <td valign="top" style="white-space: normal; word-break: break-word;">
                    <?= $params->keluarga->alamat ?? "" ?>
                </td>
                <td valign="top">No. Telp/HP:</td>
                <td valign="top" style="white-space: normal; word-break: break-word;">
                    <?= $params->keluarga->no_hp ?? "" ?>
                </td>
            </tr>
        </table>

        <!--PJ Pembayaran-->
        <table class="border-left border-right">
            <tr>
                <td style="padding-left: 10px;"><b>PENANGGUNG JAWAB PEMBAYARAN :</b></td>
            </tr>
        </table>
        <table class="border-left border-right border-bottom">
            <tr>
                <td width="8%;" style="padding-left: 10px;" valign="top">Nama</td>
                <td width="1%;" valign="top">:</td>
                <td width="20%;" valign="top" style="white-space: normal; word-break: break-word;">
                    <?= $params->pembayaran->nama ?? "" ?>
                </td>
                <td width="10%;" valign="top">Hubungan:</td>
                <td width="33%;" valign="top"><?= $params->pembayaran->hubungan ?? "" ?></td>
                <td width="12%;" valign="top"></td>
                <td width="16%;" valign="top"></td>
            </tr>
            <tr>
                <td style="padding-left: 10px;" valign="top">Pekerjaan</td>
                <td valign="top">:</td>
                <td valign="top" style="white-space: normal; word-break: break-word;">
                    <?= $params->pembayaran->pekerjaan ?? "" ?>
                </td>
                <td valign="top">Alamat:</td>
                <td valign="top" style="white-space: normal; word-break: break-word;">
                    <?= $params->pembayaran->alamat ?? "" ?>
                </td>
                <td valign="top">No. Telp/HP:</td>
                <td valign="top" style="white-space: normal; word-break: break-word;">
                    <?= $params->pembayaran->no_hp ?? "" ?>
                </td>
            </tr>
        </table>
    <!--Keluarga & Pembayar END-->

    <!--Rawat Inap-->
    <table class="border-left border-right border-bottom">
        <thead>
            <tr>
                <td style="padding-left: 10px;padding: 10px;"   align="center" class="border-right border-bottom"><b>Riwayat Rawat Inap</b></td>
                <td style="padding: 10px;" class="border-right border-bottom" align="center"><b>Masuk RS</b></td>
                <td style="padding: 10px;" class="border-right border-bottom" align="center"><b>Keluar RS</b></td>
                <td style="padding: 10px;" class="border-right border-bottom" align="center"><b>Lama Rawat</b></td>
                <td style="padding: 10px;" class="border-right border-bottom" align="center"><b>Ruang Rawat</b></td>
                <td style="padding: 10px;" class="border-bottom" align="center"><b>Kelas Perawatan</b></td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="padding-left: 10px;" class="border-right" valign="top">
                    <div class="riwayat">
                        <div style="margin-bottom: 5px;">
                            <span>
                                Rawat inap ke :
                                <?php
                                $options = ['1', '2', '3', '4', '5', '6', '7'];
                                $selected = $params->rawat_inap->inap_ke;
                                $lainnya = $params->rawat_inap->inap_ke_lainnya;

                                echo displayInapKe($selected, $options, $lainnya);
                                ?>
                            </span>
                        </div>
                        <div style="margin-bottom: 5px;">
                            <span>
                                Dirawat terakhir tgl : <?= $params->rawat_inap->rawat_terakhir_tanggal_indo ?? "" ?>
                            </span>
                        </div>
                        <div>
                            <span>
                                Di Ruang : <?= $params->pasien->ruang ?? "" ?>
                            </span>
                        </div>
                    </div>
                </td>
                <td style="padding-left: 10px;" class="border-right" valign="top">
                    <div class="masuk">
                        <div style="margin-bottom: 5px;">
                            <span>Tanggal :</span>
                            <span style="display: block;">
                                <?= $params->masuk_tanggal_indo ?? "" ?>
                            </span>
                        </div>
                        <div>
                            <span>Waktu :</span>
                            <span style="display: block;" align="center">
                                <?= $params->waktu_masuk ?? "" ?>
                            </span>
                        </div>
                    </div>
                </td>
                <td style="padding-left: 10px;" class="border-right" valign="top">
                    <div class="keluar">
                        <div style="margin-bottom: 5px;">
                            <span>Tanggal :</span>
                            <span style="display: block;">
                                <?= $params->keluar_tanggal_indo ?? "" ?>
                            </span>
                        </div>
                        <div>
                            <span>Waktu :</span>
                            <span style="display: block;" align="center">
                                <?= $params->waktu_keluar ?? "" ?>
                            </span>
                        </div>
                    </div>
                </td>
                <td style="padding-left: 10px;" class="border-right" valign="top">
                    <?= $params->lama_rawat ?? "" ?>
                </td>
                <td style="padding-left: 10px;" class="border-right" valign="top" align="center">
                    <?= $params->ruang_rawat->ruang ?? "" ?>
                </td>
                <td style="padding-left: 10px;" valign="top" align="center">
                    <?= $params->ruang_rawat->kelas ?? "" ?>
                </td>
            </tr>
        </tbody>
    </table>
    <!--Rawat Inap END-->

    <!--Pelayanan-->
    <!--<table>-->
        <table class="border-right border-left">
            <tr>
                <td align="center">
                    <h4><b>PELAYANAN</b></h4>
                </td>
            </tr>
        </table>
        <table class="table-bordered">
            <thead>
                <tr>
                    <td width="40%" align="center"><b>Prioritas Pelayanan</b></td>
                    <td width="30%" align="center"><b>Jenis Pelayanan</b></td>
                    <td width="30%" align="center"><b>Staf Medis Fungsional</b></td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="padding-left: 10px;padding-right: 10px;">
                        <table class="table-borderless">
                            <tr>
                                <td>
                                    <input type="checkbox" <?= $params->pelayanan->prioritas === 'Promotif' ? 'checked' : '' ?>> Promotif
                                </td>
                                <td>
                                    <input type="checkbox" <?= $params->pelayanan->prioritas === 'Kuratif' ? 'checked' : '' ?>> Kuratif
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="checkbox" <?= $params->pelayanan->prioritas === 'Paliatif' ? 'checked' : '' ?>> Paliatif
                                </td>
                                <td>
                                    <input type="checkbox" <?= $params->pelayanan->prioritas === 'Preventif' ? 'checked' : '' ?>> Preventif
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input type="checkbox" <?= $params->pelayanan->prioritas === 'Rehabilitatif' ? 'checked' : '' ?>> Rehabilitatif
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td style="padding-left: 10px;padding-right: 10px;white-space: normal; word-break: break-word;"
                        valign="top">
                        <?= $params->pelayanan->jenis ?? "" ?>
                    </td>
                    <td style="padding-left: 10px;padding-right: 10px;white-space: normal; word-break: break-word;"
                        valign="top">
                        <?= $params->pelayanan->staf ?? "" ?>
                    </td>
                </tr>
            </tbody>
        </table>
    <!--</table>-->
    <!--Pelayanan END-->

    <!-- Diagnosis Sementara -->
        <table class="table-bordered">
            <tr>
                <td style="padding-left: 10px;padding-right: 10px;white-space: normal; word-break: break-word;"
                    width="60%" valign="top">
                    <span>
                        Diagnosis Sementara :
                    </span>
                    <div style="padding-top: 5px;padding-left: 15px;padding-right: 10px;">
                        <?php
                        // Gabungkan diagnosa dari freetext dan autocomplete
                        $diagnosa_banding = '';
                        $last_number = 0;

                        // Proses freetext jika ada
                        if (!empty($params->diagnosa_banding_freetext)) {
                            // Bersihkan baris kosong di freetext
                            $lines = array_filter(explode("\n", $params->diagnosa_banding_freetext), function ($line) {
                                return trim($line) !== '';
                            });

                            // Gabungkan kembali dengan newline
                            $diagnosa_banding = implode("\n", $lines);

                            // Ekstrak nomor terakhir dari freetext
                            foreach ($lines as $line) {
                                if (preg_match('/^(\d+)\./', trim($line), $matches)) {
                                    $current_number = (int) $matches[1];
                                    if ($current_number > $last_number) {
                                        $last_number = $current_number;
                                    }
                                }
                            }
                        }

                        // Proses autocomplete jika ada
                        if (!empty($params->diagnosa_banding_autocomplete)) {
                            // Jika sudah ada isi di freetext, tambahkan newline di awal untuk memisah
                            if (!empty($diagnosa_banding)) {
                                $diagnosa_banding .= "\n";
                            }

                            foreach ($params->diagnosa_banding_autocomplete as $item) {
                                $last_number++;
                                $diagnosa_banding .= $last_number . '. ' . $item->icd_x . ' - ' . $item->nama_sebab_sakit . (!empty($item->deskripsi) ? ' - ' . $item->deskripsi : '') . "\n";
                            }
                            // Hapus newline ekstra di akhir
                            $diagnosa_banding = trim($diagnosa_banding);
                        }

                        // Tampilkan hasil
                        echo nl2br($diagnosa_banding);
                        ?>
                    </div>
                </td>
                <td style="padding-left: 10px;padding-right: 10px;" width="40%" valign="top">
                    <label>Dokter Jaga/ DPJP :</label>
                    <div align="center">
                        <img src="<?= $params->ttd_data->dokter_jaga_stroke ?>" class="tanda-tangan"
                            style="display: block;margin-top: 10px">
                        <p style="margin-top: 10px">
                            <?= $params->ttd_data->dokter_jaga  ?? "" ?>
                        </p>
                    </div>
                </td>
            </tr>
        </table>
    <!--Diagnosis Sementara END-->

    <!--Keluar RS-->
        <table class="border-left border-right border-bottom">
            <tr>
                <td style="padding-left: 10px;padding-right: 10px;" width="30%" valign="top">
                    <b>Izin Keluar Rumah Sakit :</b>
                </td>
                <td class="border-right" valign="top">
                    <table class="table-borderless">
                        <tr>
                            <td>
                                <input type="checkbox" <?= $params->izin_keluar_rs === 'Atas Persetujuan' ? 'checked' : '' ?>> Atas Persetujuan
                            </td>
                            <td>
                                <input type="checkbox" <?= $params->izin_keluar_rs === 'Atas Permintaan Sendiri' ? 'checked' : '' ?>> Atas Permintaan Sendiri
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="checkbox" <?= $params->izin_keluar_rs === 'Pindah Rumah Sakit Lain' ? 'checked' : '' ?>> Pindah Rumah Sakit Lain
                            </td>
                            <td>
                                <input type="checkbox" <?= $params->izin_keluar_rs === 'Melarikan Diri' ? 'checked' : '' ?>> Melarikan Diri
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    <!--Keluar RS End-->

    <!--Diagnosis Utama -- Morfologi Neoplasma/ Patologi Anatomi-->
        <table class="border-left border-right">
            <tr class="border-bottom">
                <td class="border-right" style="padding-left: 10px;" width="23%" valign="top"><b>Diagnosis
                        Utama</b></td>
                <td class="border-right" style="white-space: normal; word-break: break-word;" width="65%"
                    valign="top">
                    <div style="padding-top: 5px;padding-left: 15px;padding-right: 10px;">
                        <?php
                        // Gabungkan diagnosa dari freetext dan autocomplete
                        $diagnosa_utama = '';
                        $last_number = 0;

                        // Proses freetext jika ada
                        if (!empty($params->diagnosa_masuk_freetext)) {
                            // Bersihkan baris kosong di freetext
                            $lines = array_filter(explode("\n", $params->diagnosa_masuk_freetext), function ($line) {
                                return trim($line) !== '';
                            });

                            // Gabungkan kembali dengan newline
                            $diagnosa_utama = implode("\n", $lines);

                            // Ekstrak nomor terakhir dari freetext
                            foreach ($lines as $line) {
                                if (preg_match('/^(\d+)\./', trim($line), $matches)) {
                                    $current_number = (int) $matches[1];
                                    if ($current_number > $last_number) {
                                        $last_number = $current_number;
                                    }
                                }
                            }
                        }

                        // Proses autocomplete jika ada
                        if (!empty($params->diagnosa_masuk_autocomplete)) {
                            // Jika sudah ada isi di freetext, tambahkan newline di awal untuk memisah
                            if (!empty($diagnosa_utama)) {
                                $diagnosa_utama .= "\n";
                            }

                            foreach ($params->diagnosa_masuk_autocomplete as $item) {
                                $last_number++;
                                $diagnosa_utama .= $last_number . '. ' . $item->icd_x . ' - ' . $item->nama_sebab_sakit . (!empty($item->deskripsi) ? ' - ' . $item->deskripsi : '') . "\n";
                            }
                            // Hapus newline ekstra di akhir
                            $diagnosa_utama = trim($diagnosa_utama);
                        }

                        // Tampilkan hasil
                        echo nl2br($diagnosa_utama);
                        ?>
                    </div>
                </td>
            </tr>
            <tr class="border-bottom">
                <td class="border-right" style="padding-left: 10px;" valign="top"><b>Diagnosis Sekunder</b></td>
                <td class="border-right" style="white-space: normal; word-break: break-word" valign="top">
                    <div style="padding-top: 5px;padding-left: 15px;padding-right: 10px;">
                        <?php
                        // Gabungkan diagnosa dari freetext dan autocomplete
                        $diagnosa_sekunder = '';
                        $last_number = 0;

                        // Proses freetext jika ada
                        if (!empty($params->diagnosa_sekunder_freetext)) {
                            // Bersihkan baris kosong di freetext
                            $lines = array_filter(explode("\n", $params->diagnosa_sekunder_freetext), function ($line) {
                                return trim($line) !== '';
                            });

                            // Gabungkan kembali dengan newline
                            $diagnosa_sekunder = implode("\n", $lines);

                            // Ekstrak nomor terakhir dari freetext
                            foreach ($lines as $line) {
                                if (preg_match('/^(\d+)\./', trim($line), $matches)) {
                                    $current_number = (int) $matches[1];
                                    if ($current_number > $last_number) {
                                        $last_number = $current_number;
                                    }
                                }
                            }
                        }

                        // Proses autocomplete jika ada
                        if (!empty($params->diagnosa_sekunder_autocomplete)) {
                            // Jika sudah ada isi di freetext, tambahkan newline di awal untuk memisah
                            if (!empty($diagnosa_sekunder)) {
                                $diagnosa_sekunder .= "\n";
                            }

                            foreach ($params->diagnosa_sekunder_autocomplete as $item) {
                                $last_number++;
                                $diagnosa_sekunder .= $last_number . '. ' . $item->icd_x . ' - ' . $item->nama_sebab_sakit . (!empty($item->deskripsi) ? ' - ' . $item->deskripsi : '') . "\n";
                            }
                            // Hapus newline ekstra di akhir
                            $diagnosa_sekunder = trim($diagnosa_sekunder);
                        }

                        // Tampilkan hasil
                        echo nl2br($diagnosa_sekunder);
                        ?>
                    </div>
                </td>
            </tr>
            <tr class="border-bottom">
                <td class="border-right" style="padding-left: 10px;" valign="top"><b>Komplikasi</b></td>
                <td class="border-right" style="white-space: normal; word-break: break-word;padding-left: 10px;"
                    valign="top">
                    <?= $params->komplikasi ?? "" ?>
                </td>
            </tr>
            <tr class="border-bottom">
                <td class="border-right" style="padding-left: 10px;" valign="top"><b>Penyebab Ruda Paksa/
                        Keracunan/ Kecelakaan</b></td>
                <td class="border-right" style="white-space: normal; word-break: break-word;padding-left: 10px;"
                    valign="top">
                    <?= $params->penyebab_ruda ?? "" ?>
                </td>
            </tr>
            <tr class="border-bottom">
                <td class="border-right" style="padding-left: 10px;" valign="top"><b>Operasi/ Tindakan</b></td>
                <td class="border-right" style="white-space: normal; word-break: break-word;" valign="top">
                    <div style="padding-top: 5px;padding-left: 15px;padding-right: 10px;">
                        <?php
                        echo nl2br($params->tindakan_group);
                        ?>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="border-right" style="padding-left: 10px;" valign="top"><b>Morfologi Neoplasma/ Patologi
                        Anatomi</b></td>
                <td class="border-right" style="white-space: normal; word-break: break-word;padding-left: 10px;"
                    valign="top">
                    <?= $params->morfologi ?? "" ?>
                </td>
            </tr>
        </table>
    <!--Diagnosis Utama -- Morfologi Neoplasma/ Patologi Anatomi END-->

    <!--CATATAn-->
    <table class="table-bordered">
        <tr>
            <td valign="top" style="white-space: normal; word-break: break-word;padding-left: 10px;">
                <span><b>Catatan :</b></span>
                <div>
                    <?= $params->catatan ?? "" ?>
                </div>
            </td>
        </tr>
    </table>

    <!--INFEKSi-->
    <table class="border-left border-right border-bottom">
        <tr>
            <td class="border-right" style="white-space: normal; word-break: break-word;padding-left: 10px;"
                width="50%" valign="top">
                <span><b>Infeksi Nosokomial :</b></span>
                <div>
                    <?= $params->infeksi ?? "" ?>
                </div>
            </td>
            <td style="white-space: normal; word-break: break-word;padding-left: 10px;" width="50%"
                valign="top">
                <span><b>Penyebab Infeksi Nosokomial :</b></span>
                <div>
                    <?= $params->penyebab_infeksi ?>
                </div>
            </td>
        </tr>
    </table>


    <!--Imunisasi-->
    <table class="border-left border-right">
        <tr>
            <td style="white-space: normal; word-break: break-word;padding-left: 10px;" width="35%"
                valign="top">
                <span><b>Riwayat Imunisasi :</b></span>
                <div>
                    <?= $params->riwayat_imunisasi_text ?>
                </div>
            </td>
            <td valign="top">
                <table class="table-borderless">
                    <tr>
                        <td width="33.34%">
                            <input type="checkbox" <?= $params->riwayat_imunisasi === 'BCG' ? 'checked' : '' ?>> BCG
                        </td>
                        <td width="33.34%">
                            <input type="checkbox" <?= $params->riwayat_imunisasi === 'Poliomielitis' ? 'checked' : '' ?>> Poliomielitis
                        </td>
                        <td width="33.34%">
                            <input type="checkbox" <?= $params->riwayat_imunisasi === 'Campak' ? 'checked' : '' ?>> Campak
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="checkbox" <?= $params->riwayat_imunisasi === 'DPT' ? 'checked' : '' ?>> DPT
                        </td>
                        <td>
                            <input type="checkbox" <?= $params->riwayat_imunisasi === 'Tetanus Toxoid' ? 'checked' : '' ?>> Tetanus Toxoid
                        </td>
                        <td>
                            <input type="checkbox" <?= $params->riwayat_imunisasi === 'Hepatitis B' ? 'checked' : '' ?>> Hepatitis B
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <!--Tanda Tangan-->
    <table class="table-bordered">
        <thead>
            <tr>
                <td align="center"><b>KEADAAN KELUAR</b></td>
                <td align="center"><b>Dokter Penanggung Jawab Pelayanan</b></td>
                <td align="center"><b>Tanda Tangan</b></td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td valign="top">
                    <div style="display: flex; flex-wrap: wrap;">
                        <div style="margin-right: 20px;">
                            <div>
                                <input type="checkbox" <?= $params->keadaan_keluar === 'Sembuh' ? 'checked' : '' ?>>
                                Sembuh
                            </div>
                            <div>
                                <input type="checkbox" <?= $params->keadaan_keluar === 'Membaik' ? 'checked' : '' ?>>
                                Membaik
                            </div>
                            <div>
                                <input type="checkbox"
                                    <?= $params->keadaan_keluar === 'Belum Sembuh' ? 'checked' : '' ?>>
                                Belum Sembuh
                            </div>
                        </div>
                        <div>
                            <div>
                                <input type="checkbox"
                                    <?= $params->keadaan_keluar === 'Mati sblm 48 jam' ? 'checked' : '' ?>>
                                Mati &lt; 48 jam
                            </div>
                            <div>
                                <input type="checkbox"
                                    <?= $params->keadaan_keluar === 'Mati stlh 48 jam' ? 'checked' : '' ?>>
                                Mati &gt; 48 jam
                            </div>
                        </div>
                    </div>
                </td>
                <td  align="center" style="padding: 8px;"><p><?= $params->ttd_data->dokter_pj ?></p></td>
                <td  align="center">
                    <img src="<?= $params->ttd_data->dokter_pj_stroke ?>" class="tanda-tangan"
                        style="display: block;">
                </td>
            </tr>
        </tbody>
    </table>
</body>

</html>