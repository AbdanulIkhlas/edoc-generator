<?php
// EMR Data
$params = json_decode($argv[1]);

$base_url = $argv[2]; // Base_url
$title = "Title";
$static_label = json_decode($argv[3]);

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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
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
    }

    .table-bordered,
    .table-bordered th,
    .table-bordered td {
        border: 1px solid black;
        border-collapse: collapse;
        padding: .2em;
    }

    .table-bordered-no-top {
        border: 1px solid black;
        border-top: none;
        border-collapse: collapse;
    }

    .table-border-outline {
        border: 1px solid black;
        border-collapse: collapse;
    }

    .table-bordered-no-bottom {
        border: 1px solid black;
        border-bottom: none;
        border-collapse: collapse;
    }

    .table-bordered-sides {
        border-left: 1px solid black;
        border-right: 1px solid black;
        border-top: none;
        border-bottom: none;
        border-collapse: collapse;
    }

    .table-bordered-no-top th,
    .table-bordered-no-top td,
    .table-border-outline th,
    .table-border-outline td,
    .table-bordered-no-bottom th,
    .table-bordered-no-bottom td,
    .table-bordered-sides th,
    .table-bordered-sides td {
        border: none;
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
        ;
        text-align: right;
        text-wrap: nowrap;
        white-space: nowrap;
    }

    .flex-text-end {
        display: table-cell;
        ;
        text-align: left;
        text-wrap: nowrap;
        white-space: nowrap;
        white-space: nowrap;
    }

    .flex-text {
        display: table-cell;
        ;
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

    .ttd-img {
        width: 200px;
        height: 120px;
        object-fit: contain;
        /* atau contain tergantung kebutuhan */
    }

    .circle {
        display: inline-block;
        border: 2px solid black;
        border-radius: 50%;
        text-align: center;
        font-weight: bold;
        padding: 5px;
    }

    .pagebreak {
        min-height: 1px;
        page-break-before: always;
    }

    /* BARIS INI AKAN MENCEGAH TABEL TERPOTONG */
    .pagebreak-avoid {
        page-break-inside: avoid;
    }

    /* === [NEW_STYLE_HOOK] === */
    /* AI will add additional styles here */
    .table-bordered-sides .table-bordered th,
    .table-bordered-sides .table-bordered td,
    .table-bordered-no-top .table-bordered th,
    .table-bordered-no-top .table-bordered td,
    .table-bordered-no-bottom .table-bordered th,
    .table-bordered-no-bottom .table-bordered td {
        border: 1px solid black;
    }
</style>

<body>
    <!-- === [EMR_DATA_DISPLAY_HOOK] === -->
    <table style="margin: 0; padding: 0;">
        <tr>
            <td>
                <table>
                    <tr>
                        <td><img src="<?= "$base_url/images/rs/logoRS.png" ?>" style="width: 120px;" alt=""></td>
                        <td align="center">
                            <span style="margin:0; font-size: 1.5rem;"><?= $static_label->hospital_agency ?></span>
                            <h4 style="margin:0; font-size: 1.5rem; text-transform: uppercase;">
                                <b><?= $static_label->hospital_name ?></b>
                            </h4>
                            <small><i><?= $static_label->hospital_address . ' Telp. ' . $static_label->hospital_phone ?></i></small>
                        </td>
                        <td><img src="<?= "$base_url/images/rs/paripurna-kars.png" ?>" style="width: 120px;" alt=""></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <hr style="border:1px solid black" />

    <table style="width:100%; margin-top: 10px;">
        <tr>
            <td valign="top" style="text-align: center; font-weight: bold; font-size: 14pt; padding: 10px;">
                ASESMEN AWAL MEDIS RAWAT INAP NEONATUS
            </td>
        </tr>
    </table>

    <table class="table-bordered-no-bottom" style="width: 100%; page-break-inside: auto;">
        <tr>
            <td valign="top">
                <!-- PASIEN INFO (tambahan jika perlu) -->
                <table class="table-borderless" style="width: 100%; margin-top: 10px; page-break-inside: auto;">
                    <tr>
                        <td valign="top" colspan="6">
                            <b>I. IDENTITAS PASIEN</b>
                        </td>
                    </tr>
                    <tr>
                        <td valign="top" width="20%">Nama</td>
                        <td valign="top" width="2%">:</td>
                        <td valign="top" width="28%"><?php echo $params->pasien->nama ?? ""; ?></td>
                        <td valign="top" width="20%">Alamat</td>
                        <td valign="top" width="2%">:</td>
                        <td valign="top" width="28%"><?php echo $params->pasien->alamat ?? ""; ?></td>
                    </tr>
                    <tr>
                        <td valign="top">Tempat / Tanggal</td>
                        <td valign="top">:</td>
                        <td valign="top">
                            <?php echo $params->pasien->tempat_lahir ?? ""; ?> /
                            <?php echo tgl_indo($params->pasien->tanggal_lahir) ?? ""; ?>
                        </td>
                        <td valign="top">No. Rekam Medik</td>
                        <td valign="top">:</td>
                        <td valign="top"><?php echo $params->pasien->no_rm ?? ""; ?></td>
                    </tr>
                    <tr>
                        <td valign="top">Jenis Kelamin</td>
                        <td valign="top">:</td>
                        <td valign="top">
                            <?php echo $params->pasien->kelamin ?? ""; ?>
                        </td>
                        <td valign="top">Cara Masuk Pasien</td>
                        <td valign="top">:</td>
                        <td valign="top"><?php echo $params->pasien->cara_masuk ?? ""; ?></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <table class="table-bordered-sides" style="width: 100%; page-break-inside: auto;">
        <tr>
            <td valign="top">
                <!-- PASIEN INFO (tambahan jika perlu) -->
                <table class="table-borderless" style="width: 100%; margin-top: 10px; page-break-inside: auto;">
                    <tr>
                        <td valign="top" colspan="6">
                            <b>II. PEMERIKSAAN PASIEN</b>
                        </td>
                    </tr>
                    <tr>
                        <td valign="top" colspan="6">
                            <p>A. SUBJEKTIF</p>
                        </td>
                    </tr>
                    <tr>
                        <td valign="top" style="text-align:justify">
                            <?php echo $params->keluhan_utama ?? ""; ?>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <table class="table-bordered-sides" style="width: 100%; page-break-inside: auto;">
        <tr>
            <td valign="top">
                <!-- PASIEN INFO (tambahan jika perlu) -->
                <table class="table-borderless" style="width: 100%; margin-top: 10px; page-break-inside: auto;">
                    <tr>
                        <td valign="top" colspan="6">
                            <b>B. OBJEKTIF</b>
                        </td>
                    </tr>
                    <tr>
                        <td valign="top" colspan="6">
                            <!-- TANDA VITAL & UKURAN PERTUMBUHAN -->
                            <table class="table-borderless" style="width:100%;">
                                <tr>
                                    <td valign="top" width="60%">
                                        <table class="table-borderless" style="width:100%;">
                                            <tr>
                                                <td valign="top" colspan="6">Tanda Vital</td>
                                            </tr>
                                            <tr>
                                                <td valign="top" width="10%">FJ</td>
                                                <td valign="top" width="2%">:</td>
                                                <td valign="top" width="28%"><?php echo $params->objektif->tanda_vital->fj ?? ""; ?> x/i</td>
                                                <td valign="top" width="10%">S</td>
                                                <td valign="top" width="2%">:</td>
                                                <td valign="top" width="48%"><?php echo $params->objektif->tanda_vital->suhu ?? ""; ?> °C</td>
                                            </tr>
                                            <tr>
                                                <td valign="top">FN</td>
                                                <td valign="top">:</td>
                                                <td valign="top"><?php echo $params->objektif->tanda_vital->fn ?? ""; ?> x/i</td>
                                                <td valign="top">CRT</td>
                                                <td valign="top">:</td>
                                                <td valign="top"><?php echo $params->objektif->tanda_vital->crt ?? ""; ?> Detik</td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td valign="top" width="40%">
                                        <table class="table-borderless" style="width:100%;">
                                            <tr>
                                                <td valign="top" colspan="3">Ukuran Pertumbuhan</td>
                                            </tr>
                                            <tr>
                                                <td valign="top" width="15%">BB</td>
                                                <td valign="top" width="5%">:</td>
                                                <td valign="top" width="80%"><?php echo $params->objektif->ukuran_pertumbuhan->bb ?? ""; ?> Gram</td>
                                            </tr>
                                            <tr>
                                                <td valign="top">PB</td>
                                                <td valign="top">:</td>
                                                <td valign="top"><?php echo $params->objektif->ukuran_pertumbuhan->pb ?? ""; ?> Cm</td>
                                            </tr>
                                            <tr>
                                                <td valign="top">LK</td>
                                                <td valign="top">:</td>
                                                <td valign="top"><?php echo $params->objektif->ukuran_pertumbuhan->lk ?? ""; ?> Cm</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>

                            <table class="table-borderless" style="width:100%; margin-top:5px;">
                                <tr>
                                    <td valign="top" width="15%">Asupan ASI / PASI</td>
                                    <td valign="top" width="2%">:</td>
                                    <td valign="top" width="83%"><?php echo $params->objektif->asupan ?? ""; ?></td>
                                </tr>
                                <tr>
                                    <td valign="top" colspan="3">Sistem Pernafasan</td>
                                </tr>
                            </table>

                            <table class="table-borderless" style="width:100%;">
                                <tr>
                                    <td valign="top" width="15%">Warna Kulit</td>
                                    <td valign="top" width="2%">:</td>
                                    <td valign="top" width="18%"><?php echo $params->objektif->sistem_pernafasan->warna_kulit ?? ""; ?></td>
                                    <td valign="top" width="23%">Pergerakan dinding pada</td>
                                    <td valign="top" width="2%">:</td>
                                    <td valign="top" width="40%" colspan="4"><?php echo $params->objektif->sistem_pernafasan->pergerakan_dinding_dada ?? ""; ?></td>
                                </tr>
                                <tr>
                                    <td valign="top">Reaksi</td>
                                    <td valign="top">:</td>
                                    <td valign="top">(<?php echo !empty($params->objektif->sistem_pernafasan->reaksi) ? $params->objektif->sistem_pernafasan->reaksi : "+/-"; ?>)</td>
                                    <td valign="top">Grunting</td>
                                    <td valign="top">:</td>
                                    <td valign="top" width="8%">(<?php echo !empty($params->objektif->sistem_pernafasan->grunting) ? $params->objektif->sistem_pernafasan->grunting : "+/-"; ?>)</td>
                                    <td valign="top" width="20%">Auskultasi bunyi nafas</td>
                                    <td valign="top" width="2%">:</td>
                                    <td valign="top" width="10%"><?php echo $params->objektif->sistem_pernafasan->auskultasi_bunyi_nafas ?? ""; ?></td>
                                </tr>
                                <tr>
                                    <td valign="top">Sianosis</td>
                                    <td valign="top">:</td>
                                    <td valign="top">(<?php echo !empty($params->objektif->sistem_pernafasan->sianosis) ? $params->objektif->sistem_pernafasan->sianosis : "+/-"; ?>)</td>
                                    <td valign="top">Apnea</td>
                                    <td valign="top">:</td>
                                    <td valign="top" colspan="4">(<?php echo !empty($params->objektif->sistem_pernafasan->apnea) ? $params->objektif->sistem_pernafasan->apnea : "+/-"; ?>)</td>
                                </tr>
                                <tr>
                                    <td valign="top">Skor Downe</td>
                                    <td valign="top">:</td>
                                    <td valign="top" colspan="7"><?php echo $params->objektif->skor_downe ?? ""; ?></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <table class="table-bordered-sides">
        <tr>
            <td>
                <?php $gawat = $params->pemeriksaan_gawat_napas; ?>
                <table class="table-bordered" style="width: 100%; page-break-inside: avoid; margin-top: 10px;">
                    <thead>
                        <tr style="background-color: #1a237e; color: white; text-align: center;">
                            <th style="padding: 5px;">Pemeriksaan</th>
                            <th style="padding: 5px;">Skor 0</th>
                            <th style="padding: 5px;">Skor 1</th>
                            <th style="padding: 5px;">Skor 2</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="font-weight: bold; padding: 5px;">Frekuensi Napas</td>
                            <td style="padding: 5px;"><?= (isset($gawat->frekuensi_napas) && $gawat->frekuensi_napas === 0) ? '&#9745;' : '&#9744;' ?> < 60 x/menit</td>
                            <td style="padding: 5px;"><?= (isset($gawat->frekuensi_napas) && $gawat->frekuensi_napas === 1) ? '&#9745;' : '&#9744;' ?> 60 &ndash; 80 x/menit</td>
                            <td style="padding: 5px;"><?= (isset($gawat->frekuensi_napas) && $gawat->frekuensi_napas === 2) ? '&#9745;' : '&#9744;' ?> > 80 x/menit</td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold; padding: 5px;">Retraksi</td>
                            <td style="padding: 5px;"><?= (isset($gawat->retraksi) && $gawat->retraksi === 0) ? '&#9745;' : '&#9744;' ?> Tidak ada</td>
                            <td style="padding: 5px;"><?= (isset($gawat->retraksi) && $gawat->retraksi === 1) ? '&#9745;' : '&#9744;' ?> Ringan</td>
                            <td style="padding: 5px;"><?= (isset($gawat->retraksi) && $gawat->retraksi === 2) ? '&#9745;' : '&#9744;' ?> Berat</td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold; padding: 5px;">Sianosis</td>
                            <td style="padding: 5px;"><?= (isset($gawat->sianosis_skor) && $gawat->sianosis_skor === 0) ? '&#9745;' : '&#9744;' ?> Tidak ada</td>
                            <td style="padding: 5px;"><?= (isset($gawat->sianosis_skor) && $gawat->sianosis_skor === 1) ? '&#9745;' : '&#9744;' ?> Hilang dengan O<sub>2</sub></td>
                            <td style="padding: 5px;"><?= (isset($gawat->sianosis_skor) && $gawat->sianosis_skor === 2) ? '&#9745;' : '&#9744;' ?> Menetap walau diberi O<sub>2</sub></td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold; padding: 5px;">Suara Napas</td>
                            <td style="padding: 5px;"><?= (isset($gawat->suara_napas) && $gawat->suara_napas === 0) ? '&#9745;' : '&#9744;' ?> Baik di kedua paru</td>
                            <td style="padding: 5px;"><?= (isset($gawat->suara_napas) && $gawat->suara_napas === 1) ? '&#9745;' : '&#9744;' ?> Menurun / Udara masuk kurang</td>
                            <td style="padding: 5px;"><?= (isset($gawat->suara_napas) && $gawat->suara_napas === 2) ? '&#9745;' : '&#9744;' ?> Tidak terdengar / Minimal</td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold; padding: 5px;">Merintih <i>(Grunting)</i></td>
                            <td style="padding: 5px;"><?= (isset($gawat->merintih) && $gawat->merintih === 0) ? '&#9745;' : '&#9744;' ?> Tidak ada</td>
                            <td style="padding: 5px;"><?= (isset($gawat->merintih) && $gawat->merintih === 1) ? '&#9745;' : '&#9744;' ?> Terdengar dengan stetoskop</td>
                            <td style="padding: 5px;"><?= (isset($gawat->merintih) && $gawat->merintih === 2) ? '&#9745;' : '&#9744;' ?> Terdengar tanpa stetoskop</td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold; padding: 5px; background-color: #fff3cd;">Total Skor</td>
                            <td colspan="3" style="padding: 5px; text-align: center;">
                                <?= isset($gawat->total_skor) ? $gawat->total_skor : 0 ?> - <?= isset($gawat->diagnosis) ? $gawat->diagnosis : '' ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold; padding: 5px;">Evaluasi</td>
                            <td colspan="3" style="padding: 5px;">
                                <div style="min-height: 40px; border: 1px solid #ccc; padding: 5px; border-radius: 4px;">
                                    <?= isset($gawat->evaluasi) ? nl2br($gawat->evaluasi) : '' ?>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </table>

    <table class="table-bordered-sides">
        <tr>
            <td>
                <table class="table-bordered" style="width: 100%; margin-top: 10px; text-align: center; page-break-inside: avoid;">
                    <thead>
                        <tr style="background-color: #1a237e; color: white;">
                            <th style="padding: 5px; width: 20%;">Total Skor</th>
                            <th style="padding: 5px; width: 30%;">Diagnosis / Kategori</th>
                            <th style="padding: 5px; width: 50%;">Rekomendasi Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="background-color: #d4edda; font-weight: bold; padding: 5px;">0 - 3</td>
                            <td style="font-weight: bold; padding: 5px;">Gawat Napas Ringan</td>
                            <td style="padding: 5px;"><?= !empty($gawat->rekomendasi_tindakan_ringan) ? $gawat->rekomendasi_tindakan_ringan : 'Terapi Oksigen Nasal Kanul / Headbox' ?></td>
                        </tr>
                        <tr>
                            <td style="background-color: #fff3cd; font-weight: bold; padding: 5px;">4 - 7</td>
                            <td style="font-weight: bold; padding: 5px;">Gawat Napas Sedang</td>
                            <td style="padding: 5px;"><?= !empty($gawat->rekomendasi_tindakan_sedang) ? $gawat->rekomendasi_tindakan_sedang : 'Terapi Oksigen CPAP' ?></td>
                        </tr>
                        <tr>
                            <td style="background-color: #f8d7da; font-weight: bold; padding: 5px;">8 - 10</td>
                            <td style="font-weight: bold; padding: 5px;">Gawat Napas Berat</td>
                            <td style="padding: 5px;"><?= !empty($gawat->rekomendasi_tindakan_berat) ? $gawat->rekomendasi_tindakan_berat : 'Perawatan NICU & Evaluasi Intubasi/Ventilator' ?></td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </table>

    <table class="table-bordered-no-top">
        <tr>
            <td>
                <!-- tabel untuk menampilkan data sistem  -->
                <?php
                $fisik = $params->pemeriksaan_fisik_lanjutan;
                function formatPlusMinus($val)
                {
                    if (trim($val) === '+' || trim($val) === '1' || strtolower(trim($val)) === 'ya') return '(+)';
                    if (trim($val) === '-' || trim($val) === '0' || strtolower(trim($val)) === 'tidak') return '(-)';
                    return '(+ / -)';
                }
                ?>
                <table class="table-borderless" style="width: 100%; margin-top: 10px; page-break-inside: auto;">
                    <tr>
                        <td valign="top" width="50%" style="padding-right: 10px;">
                            <!-- Kiri -->
                            <table class="table-borderless" style="width: 100%;">
                                <tr>
                                    <td colspan="3"><b>Sistem kardiovaskuler</b></td>
                                </tr>
                                <tr>
                                    <td width="35%">Auskultasi</td>
                                    <td width="2%">:</td>
                                    <td width="63%" style="border-bottom: 1px dotted black;"><?= $fisik->sistem_kardiovaskuler->auskultasi ?? "" ?></td>
                                </tr>
                                <tr>
                                    <td>Murmur</td>
                                    <td>:</td>
                                    <td style="border-bottom: 1px dotted black;"><?= $fisik->sistem_kardiovaskuler->murmur ?? "" ?></td>
                                </tr>
                                <tr>
                                    <td>TD (dengan monitor)</td>
                                    <td>:</td>
                                    <td>
                                        <span style="border-bottom: 1px dotted black; width: 50%; display: inline-block;">
                                            <?= ($fisik->sistem_kardiovaskuler->tensi_sistole ?? '') . '/' . ($fisik->sistem_kardiovaskuler->tensi_diastole ?? '') ?>
                                        </span> mmHg
                                    </td>
                                </tr>
                                <tr>
                                    <td>Denyut</td>
                                    <td>:</td>
                                    <td><?= formatPlusMinus($fisik->sistem_kardiovaskuler->denyut ?? "") ?></td>
                                </tr>

                                <tr>
                                    <td colspan="3" style="height: 10px;"></td>
                                </tr>

                                <tr>
                                    <td colspan="3"><b>Genital</b></td>
                                </tr>
                                <tr>
                                    <td>Laki-laki</td>
                                    <td>:</td>
                                    <td style="border-bottom: 1px dotted black;"><?= $fisik->genital->laki_laki ?? "" ?></td>
                                </tr>
                                <tr>
                                    <td>Wanita</td>
                                    <td>:</td>
                                    <td style="border-bottom: 1px dotted black;"><?= $fisik->genital->wanita ?? "" ?></td>
                                </tr>

                                <tr>
                                    <td colspan="3" style="height: 10px;"></td>
                                </tr>

                                <tr>
                                    <td colspan="3"><b>Sistem Saraf Pusat</b></td>
                                </tr>
                                <tr>
                                    <td>Aktifitas</td>
                                    <td>:</td>
                                    <td style="border-bottom: 1px dotted black;"><?= $fisik->sistem_saraf_pusat->aktifitas ?? "" ?></td>
                                </tr>
                                <tr>
                                    <td>Tingkat Kesadaran</td>
                                    <td>:</td>
                                    <td style="border-bottom: 1px dotted black;"><?= $fisik->sistem_saraf_pusat->tingkat_kesadaran ?? "" ?></td>
                                </tr>
                                <tr>
                                    <td>Tonus otot</td>
                                    <td>:</td>
                                    <td style="border-bottom: 1px dotted black;"><?= $fisik->sistem_saraf_pusat->tonus_otot ?? "" ?></td>
                                </tr>
                                <tr>
                                    <td>Ukuran pupil</td>
                                    <td>:</td>
                                    <td style="border-bottom: 1px dotted black;"><?= $fisik->sistem_saraf_pusat->ukuran_pupil ?? "" ?></td>
                                </tr>

                                <tr>
                                    <td colspan="3" style="height: 10px;"></td>
                                </tr>

                                <tr>
                                    <td colspan="3"><b>Pemeriksaan Lain</b></td>
                                </tr>
                                <tr>
                                    <td>Ekstremitas superior</td>
                                    <td>:</td>
                                    <td style="border-bottom: 1px dotted black;"><?= $fisik->pemeriksaan_lain->ekstremitas_superior ?? "" ?></td>
                                </tr>
                                <tr>
                                    <td>Ekstremitas Inferior</td>
                                    <td>:</td>
                                    <td style="border-bottom: 1px dotted black;"><?= $fisik->pemeriksaan_lain->ekstremitas_inferior ?? "" ?></td>
                                </tr>
                            </table>
                        </td>

                        <td valign="top" width="50%" style="padding-left: 10px;">
                            <!-- Kanan -->
                            <table class="table-borderless" style="width: 100%;">
                                <tr>
                                    <td colspan="3"><b>Sistem Gastrointestinal</b></td>
                                </tr>
                                <tr>
                                    <td width="40%">Dinding abdomen</td>
                                    <td width="2%">:</td>
                                    <td width="58%" style="border-bottom: 1px dotted black;"><?= $fisik->sistem_gastrointestinal->dinding_abdomen ?? "" ?></td>
                                </tr>
                                <tr>
                                    <td>Umbilikus</td>
                                    <td>:</td>
                                    <td style="border-bottom: 1px dotted black;"><?= $fisik->sistem_gastrointestinal->umbilikus ?? "" ?></td>
                                </tr>
                                <tr>
                                    <td>Palpasi</td>
                                    <td>:</td>
                                    <td style="border-bottom: 1px dotted black;"><?= $fisik->sistem_gastrointestinal->palpasi ?? "" ?></td>
                                </tr>
                                <tr>
                                    <td>Auskultasi bunyi usus</td>
                                    <td>:</td>
                                    <td style="border-bottom: 1px dotted black;"><?= $fisik->sistem_gastrointestinal->auskultasi_bunyi_usus ?? "" ?></td>
                                </tr>
                                <tr>
                                    <td>Lingkar abdomen</td>
                                    <td>:</td>
                                    <td><span style="border-bottom: 1px dotted black; width: 70%; display: inline-block;"><?= $fisik->sistem_gastrointestinal->lingkar_abdomen ?? "" ?></span> cm</td>
                                </tr>
                                <tr>
                                    <td>Residu lambung</td>
                                    <td>:</td>
                                    <td><span style="border-bottom: 1px dotted black; width: 70%; display: inline-block;"><?= $fisik->sistem_gastrointestinal->residu_lambung ?? "" ?></span> ml.</td>
                                </tr>
                                <tr>
                                    <td>Anus imperfekta</td>
                                    <td>:</td>
                                    <td><?= formatPlusMinus($fisik->sistem_gastrointestinal->anus_imperfekta ?? "") ?></td>
                                </tr>

                                <tr>
                                    <td colspan="3" style="height: 10px;"></td>
                                </tr>

                                <tr>
                                    <td>Reaksi terhadap cahaya</td>
                                    <td>:</td>
                                    <td><?= formatPlusMinus($fisik->sistem_saraf_pusat->reaksi_terhadap_cahaya ?? "") ?></td>
                                </tr>
                                <tr>
                                    <td>Fontanela</td>
                                    <td>:</td>
                                    <td style="border-bottom: 1px dotted black;"><?= $fisik->sistem_saraf_pusat->fontanela ?? "" ?></td>
                                </tr>
                                <tr>
                                    <td>Sutura</td>
                                    <td>:</td>
                                    <td style="border-bottom: 1px dotted black;"><?= $fisik->sistem_saraf_pusat->sutura ?? "" ?></td>
                                </tr>
                                <tr>
                                    <td>Kejang</td>
                                    <td>:</td>
                                    <td><?= formatPlusMinus($fisik->sistem_saraf_pusat->kejang ?? "") ?></td>
                                </tr>

                                <tr>
                                    <td colspan="3" style="height: 10px;"></td>
                                </tr>

                                <tr>
                                    <td>Panggul</td>
                                    <td>:</td>
                                    <td style="border-bottom: 1px dotted black;"><?= $fisik->pemeriksaan_lain->panggul ?? "" ?></td>
                                </tr>
                                <tr>
                                    <td>Tubuh dan tulang punggung</td>
                                    <td>:</td>
                                    <td style="border-bottom: 1px dotted black;"><?= $fisik->pemeriksaan_lain->tubuh_dan_tulang_punggung ?? "" ?></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="padding-top: 20px;">
                            <table class="table-borderless" style="width: 100%;">
                                <tr>
                                    <td><b>Kelainan Lain</b></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>


    <table class="table-bordered-no-bottom">
        <tr>
            <td>
                <!-- tabel Penilaian usia kehamilan (skor ballard) -->
                <?php
                $mf = $params->maturitas_fisik;
                function isSelMF($val, $check)
                {
                    return ($val == $check) ? 'style="font-weight: bold; background-color: #fff2cc; padding: 5px;"' : 'style="padding: 5px;"';
                }
                ?>
                <div style="font-size: 13px; margin-top: 15px; margin-bottom: 5px;">
                    Penilaian usia kehamilan (skor ballard)<br>
                    Maturitas Fisik
                </div>
                <table class="table-bordered" style="width: 100%; font-size: 11px; page-break-inside: auto; text-align: left;">
                    <thead>
                        <tr>
                            <th style="width: 12%; padding: 5px;"></th>
                            <th style="width: 12%; padding: 5px;">-1</th>
                            <th style="width: 12%; padding: 5px;">0</th>
                            <th style="width: 12%; padding: 5px;">1</th>
                            <th style="width: 12%; padding: 5px;">2</th>
                            <th style="width: 12%; padding: 5px;">3</th>
                            <th style="width: 12%; padding: 5px;">4</th>
                            <th style="width: 16%; padding: 5px;">5</th>
                        </tr>
                    </thead>
                    <tbody style="vertical-align: top;">
                        <tr>
                            <td style="padding: 5px;">Kulit</td>
                            <td <?= isSelMF($mf->kulit, '-1') ?>>Lengket-friable-Transparan</td>
                            <td <?= isSelMF($mf->kulit, '0') ?>>Gelatinus merah translusen</td>
                            <td <?= isSelMF($mf->kulit, '1') ?>>Merah halus tampak gambaran vena</td>
                            <td <?= isSelMF($mf->kulit, '2') ?>>Permukaan terkelupas dan/atau ruam tampak banyak vena</td>
                            <td <?= isSelMF($mf->kulit, '3') ?>>Pecah-pecah daerah gundul, vena sangat sedikit</td>
                            <td <?= isSelMF($mf->kulit, '4') ?>>Parchement terbelah dalam tak terlihat vena</td>
                            <td <?= isSelMF($mf->kulit, '5') ?>>Leathery cracked wrinkle</td>
                        </tr>
                        <tr>
                            <td style="padding: 5px;">Lanugo</td>
                            <td <?= isSelMF($mf->lanugo, '-1') ?>>Tidak ada</td>
                            <td <?= isSelMF($mf->lanugo, '0') ?>>Jarang</td>
                            <td <?= isSelMF($mf->lanugo, '1') ?>>Banyak</td>
                            <td <?= isSelMF($mf->lanugo, '2') ?>>Halus</td>
                            <td <?= isSelMF($mf->lanugo, '3') ?>>Daerah kebotakan</td>
                            <td <?= isSelMF($mf->lanugo, '4') ?>>Umumnya tanpa lanugo</td>
                            <td <?= isSelMF($mf->lanugo, '5') ?>>
                                <?php if ($mf->lanugo == '5'): ?>
                                    Lainnya:<br><?= nl2br(htmlspecialchars($mf->lanugo_keterangan ?? '')) ?>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 5px;">Permukaan plantar</td>
                            <td <?= isSelMF($mf->permukaan_plantar, '-1') ?>>Tumit -jari kaki 40-50 mm : -1 <40 mm : -2</td>
                            <td <?= isSelMF($mf->permukaan_plantar, '0') ?>>> 50 mm tanpa garis kaki</td>
                            <td <?= isSelMF($mf->permukaan_plantar, '1') ?>>Faint bercak kemerahan</td>
                            <td <?= isSelMF($mf->permukaan_plantar, '2') ?>>Garis kaki hanya di anterior</td>
                            <td <?= isSelMF($mf->permukaan_plantar, '3') ?>>Garis kaki sampai 2/3 anterior</td>
                            <td <?= isSelMF($mf->permukaan_plantar, '4') ?>>Garis kaki di seluruh telapak</td>
                            <td <?= isSelMF($mf->permukaan_plantar, '5') ?>>
                                <?php if ($mf->permukaan_plantar == '5'): ?>
                                    Lainnya:<br><?= nl2br(htmlspecialchars($mf->permukaan_plantar_keterangan ?? '')) ?>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 5px;">Payudara</td>
                            <td <?= isSelMF($mf->payudara, '-1') ?>>Imperceptible</td>
                            <td <?= isSelMF($mf->payudara, '0') ?>>Sedikit imperceptible</td>
                            <td <?= isSelMF($mf->payudara, '1') ?>>Areola rata, tanda bantalan</td>
                            <td <?= isSelMF($mf->payudara, '2') ?>>Areola agak menonjol, bantalan 1-2 mm</td>
                            <td <?= isSelMF($mf->payudara, '3') ?>>Areola menonjol bantalan 3-4 mm</td>
                            <td <?= isSelMF($mf->payudara, '4') ?>>Areola sangat menonjol bantalan 5-10 mm</td>
                            <td <?= isSelMF($mf->payudara, '5') ?>>
                                <?php if ($mf->payudara == '5'): ?>
                                    Lainnya:<br><?= nl2br(htmlspecialchars($mf->payudara_keterangan ?? '')) ?>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 5px;">Mata / Telinga</td>
                            <td <?= isSelMF($mf->mata_telinga, '-1') ?>>Kerapatan kelopak longgar: -1 Rapat: -2</td>
                            <td <?= isSelMF($mf->mata_telinga, '0') ?>>Kelopak terbuka daun telinga rata, tetap terlihat</td>
                            <td <?= isSelMF($mf->mata_telinga, '1') ?>>Sedikit melengkung, lunak, rekoil lambat</td>
                            <td <?= isSelMF($mf->mata_telinga, '2') ?>>Lengkung terbentuk baik lunak, tapi rekoil baik</td>
                            <td <?= isSelMF($mf->mata_telinga, '3') ?>>Bentuk dan kekerasan sudah baik, rekoil langsung</td>
                            <td <?= isSelMF($mf->mata_telinga, '4') ?>>Tulang rawan cukup tebal, daun telinga sudah kaku</td>
                            <td <?= isSelMF($mf->mata_telinga, '5') ?>>
                                <?php if ($mf->mata_telinga == '5'): ?>
                                    Lainnya:<br><?= nl2br(htmlspecialchars($mf->mata_telinga_keterangan ?? '')) ?>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 5px;">Genital (pria)</td>
                            <td <?= isSelMF($mf->genital_pria, '-1') ?>>Skrotum rata, halus</td>
                            <td <?= isSelMF($mf->genital_pria, '0') ?>>Skrotum kosong, guratan kulit halus</td>
                            <td <?= isSelMF($mf->genital_pria, '1') ?>>Testis di bagian atas kanal, guratan kulit jarang</td>
                            <td <?= isSelMF($mf->genital_pria, '2') ?>>Testis sudah turun, terlihat guratan cukup jelas</td>
                            <td <?= isSelMF($mf->genital_pria, '3') ?>>Testis jelas dalam skrotum, ruga cukup jelas</td>
                            <td <?= isSelMF($mf->genital_pria, '4') ?>>Testis sudah bergelayut, ruga cukup dalam</td>
                            <td <?= isSelMF($mf->genital_pria, '5') ?>>
                                <?php if ($mf->genital_pria == '5'): ?>
                                    Lainnya:<br><?= nl2br(htmlspecialchars($mf->genital_pria_keterangan ?? '')) ?>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 5px;">Genital (Wanita)</td>
                            <td <?= isSelMF($mf->genital_wanita, '-1') ?>>Klitoris menonjol labia rata</td>
                            <td <?= isSelMF($mf->genital_wanita, '0') ?>>Klitoris menonjol labia minor kecil</td>
                            <td <?= isSelMF($mf->genital_wanita, '1') ?>>Klitoris menonjol, labia mayor sama menonjol</td>
                            <td <?= isSelMF($mf->genital_wanita, '2') ?>>Labia minor dan mayor Sama menonjol</td>
                            <td <?= isSelMF($mf->genital_wanita, '3') ?>>Labia mayor besar, labia minor kecil</td>
                            <td <?= isSelMF($mf->genital_wanita, '4') ?>>Labia mayor menutup klitoris dan labia minor</td>
                            <td <?= isSelMF($mf->genital_wanita, '5') ?>>
                                <?php if ($mf->genital_wanita == '5'): ?>
                                    Lainnya:<br><?= nl2br(htmlspecialchars($mf->genital_wanita_keterangan ?? '')) ?>
                                <?php endif; ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </table>

    <table class="table-bordered-no-top">
        <tr>
            <td>
                <!-- tabel neuromoskular -->
                <div style="font-size: 13px; margin-top: 15px; margin-bottom: 5px;">
                    Maturitas Neuromuskular
                </div>
                <?php
                $mn = $params->maturitas_neuromuskular;
                function isSelMN($val, $check)
                {
                    if ($val === null || $val === '') return 'style="padding: 2px; text-align: center; vertical-align: middle;"';
                    return (intval($val) === $check) ? 'style=" background-color: #fff2cc; padding: 2px; text-align: center; vertical-align: middle;"' : 'style="padding: 2px; text-align: center; vertical-align: middle;"';
                }

                $tsb = $params->fix_total_skor_ballard ?? null;
                function isSelScore($val, $check)
                {
                    if ($val === null || $val === '') return false;
                    $val = (float)$val;
                    $scores = [-10, -5, 0, 5, 10, 15, 20, 25, 30, 35, 40, 45, 50];
                    $closest = -10;
                    foreach ($scores as $s) {
                        if (abs($val - $s) < abs($val - $closest)) {
                            $closest = $s;
                        }
                    }
                    return ($closest === $check);
                }
                ?>
                <table class="table-borderless" style="width: 100%; page-break-inside: auto;">
                    <tr>
                        <td valign="top" style="width: 75%; padding-right: 10px;">
                            <table class="table-bordered" style="width: 100%; font-size: 11px; text-align: center;">
                                <thead>
                                    <tr>
                                        <th style="width: 16%;"></th>
                                        <th style="width: 12%;">-1</th>
                                        <th style="width: 12%;">0</th>
                                        <th style="width: 12%;">1</th>
                                        <th style="width: 12%;">2</th>
                                        <th style="width: 12%;">3</th>
                                        <th style="width: 12%;">4</th>
                                        <th style="width: 12%;">5</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr style="page-break-inside: avoid;">
                                        <td style="text-align: left; padding: 5px;">Sikap tubuh</td>
                                        <td></td>
                                        <td <?= isSelMN($mn->postur, 0) ?>><img src=<?= "$base_url/images/RS49_AMB/posture_0.png" ?> style="width:100%; max-width:45px;"></td>
                                        <td <?= isSelMN($mn->postur, 1) ?>><img src=<?= "$base_url/images/RS49_AMB/posture_1.png" ?> style="width:100%; max-width:45px;"></td>
                                        <td <?= isSelMN($mn->postur, 2) ?>><img src=<?= "$base_url/images/RS49_AMB/posture_2.png" ?> style="width:100%; max-width:45px;"></td>
                                        <td <?= isSelMN($mn->postur, 3) ?>><img src=<?= "$base_url/images/RS49_AMB/posture_3.png" ?> style="width:100%; max-width:45px;"></td>
                                        <td <?= isSelMN($mn->postur, 4) ?>><img src=<?= "$base_url/images/RS49_AMB/posture_4.png" ?> style="width:100%; max-width:45px;"></td>
                                        <td></td>
                                    </tr>
                                    <tr style="page-break-inside: avoid;">
                                        <td style="text-align: left; padding: 5px;">Persegi Jendela<br>(Pergelangan Tangan)</td>
                                        <td <?= isSelMN($mn->square_window, -1) ?>><img src=<?= "$base_url/images/RS49_AMB/square_window_min1.png" ?> style="width:100%; max-width:45px;"></td>
                                        <td <?= isSelMN($mn->square_window, 0) ?>><img src=<?= "$base_url/images/RS49_AMB/square_window_0.png" ?> style="width:100%; max-width:45px;"></td>
                                        <td <?= isSelMN($mn->square_window, 1) ?>><img src=<?= "$base_url/images/RS49_AMB/square_window_1.png" ?> style="width:100%; max-width:45px;"></td>
                                        <td <?= isSelMN($mn->square_window, 2) ?>><img src=<?= "$base_url/images/RS49_AMB/square_window_2.png" ?> style="width:100%; max-width:45px;"></td>
                                        <td <?= isSelMN($mn->square_window, 3) ?>><img src=<?= "$base_url/images/RS49_AMB/square_window_3.png" ?> style="width:100%; max-width:45px;"></td>
                                        <td <?= isSelMN($mn->square_window, 4) ?>><img src=<?= "$base_url/images/RS49_AMB/square_window_4.png" ?> style="width:100%; max-width:45px;"></td>
                                        <td></td>
                                    </tr>
                                    <tr style="page-break-inside: avoid;">
                                        <td style="text-align: left; padding: 5px;">Rekoil Lengan</td>
                                        <td></td>
                                        <td <?= isSelMN($mn->arm_recoil, 0) ?>><img src=<?= "$base_url/images/RS49_AMB/arm_recoil_0.png" ?> style="width:100%; max-width:45px;"></td>
                                        <td <?= isSelMN($mn->arm_recoil, 1) ?>><img src=<?= "$base_url/images/RS49_AMB/arm_recoil_1.png" ?> style="width:100%; max-width:45px;"></td>
                                        <td <?= isSelMN($mn->arm_recoil, 2) ?>><img src=<?= "$base_url/images/RS49_AMB/arm_recoil_2.png" ?> style="width:100%; max-width:45px;"></td>
                                        <td <?= isSelMN($mn->arm_recoil, 3) ?>><img src=<?= "$base_url/images/RS49_AMB/arm_recoil_3.png" ?> style="width:100%; max-width:45px;"></td>
                                        <td <?= isSelMN($mn->arm_recoil, 4) ?>><img src=<?= "$base_url/images/RS49_AMB/arm_recoil_4.png" ?> style="width:100%; max-width:45px;"></td>
                                        <td></td>
                                    </tr>
                                    <tr style="page-break-inside: avoid;">
                                        <td style="text-align: left; padding: 5px;">Sudut propliteal</td>
                                        <td <?= isSelMN($mn->popliteal_angle, -1) ?>><img src=<?= "$base_url/images/RS49_AMB/popliteal_angle_min1.png" ?> style="width:100%; max-width:45px;"></td>
                                        <td <?= isSelMN($mn->popliteal_angle, 0) ?>><img src=<?= "$base_url/images/RS49_AMB/popliteal_angle_0.png" ?> style="width:100%; max-width:45px;"></td>
                                        <td <?= isSelMN($mn->popliteal_angle, 1) ?>><img src=<?= "$base_url/images/RS49_AMB/popliteal_angle_1.png" ?> style="width:100%; max-width:45px;"></td>
                                        <td <?= isSelMN($mn->popliteal_angle, 2) ?>><img src=<?= "$base_url/images/RS49_AMB/popliteal_angle_2.png" ?> style="width:100%; max-width:45px;"></td>
                                        <td <?= isSelMN($mn->popliteal_angle, 3) ?>><img src=<?= "$base_url/images/RS49_AMB/popliteal_angle_3.png" ?> style="width:100%; max-width:45px;"></td>
                                        <td <?= isSelMN($mn->popliteal_angle, 4) ?>><img src=<?= "$base_url/images/RS49_AMB/popliteal_angle_4.png" ?> style="width:100%; max-width:45px;"></td>
                                        <td <?= isSelMN($mn->popliteal_angle, 5) ?>><img src=<?= "$base_url/images/RS49_AMB/popliteal_angle_5.png" ?> style="width:100%; max-width:45px;"></td>
                                    </tr>
                                    <tr style="page-break-inside: avoid;">
                                        <td style="text-align: left; padding: 5px;">Tanda selempang</td>
                                        <td <?= isSelMN($mn->scarf_sign, -1) ?>><img src=<?= "$base_url/images/RS49_AMB/scarf_sign_min1.png" ?> style="width:100%; max-width:45px;"></td>
                                        <td <?= isSelMN($mn->scarf_sign, 0) ?>><img src=<?= "$base_url/images/RS49_AMB/scarf_sign_0.png" ?> style="width:100%; max-width:45px;"></td>
                                        <td <?= isSelMN($mn->scarf_sign, 1) ?>><img src=<?= "$base_url/images/RS49_AMB/scarf_sign_1.png" ?> style="width:100%; max-width:45px;"></td>
                                        <td <?= isSelMN($mn->scarf_sign, 2) ?>><img src=<?= "$base_url/images/RS49_AMB/scarf_sign_2.png" ?> style="width:100%; max-width:45px;"></td>
                                        <td <?= isSelMN($mn->scarf_sign, 3) ?>><img src=<?= "$base_url/images/RS49_AMB/scarf_sign_3.png" ?> style="width:100%; max-width:45px;"></td>
                                        <td <?= isSelMN($mn->scarf_sign, 4) ?>><img src=<?= "$base_url/images/RS49_AMB/scarf_sign_4.png" ?> style="width:100%; max-width:45px;"></td>
                                        <td></td>
                                    </tr>
                                    <tr style="page-break-inside: avoid;">
                                        <td style="text-align: left; padding: 5px;">Tumit Ke kuping</td>
                                        <td <?= isSelMN($mn->heel_to_ear, -1) ?>><img src=<?= "$base_url/images/RS49_AMB/heel_to_ear_min1.png" ?> style="width:100%; max-width:45px;"></td>
                                        <td <?= isSelMN($mn->heel_to_ear, 0) ?>><img src=<?= "$base_url/images/RS49_AMB/heel_to_ear_0.png" ?> style="width:100%; max-width:45px;"></td>
                                        <td <?= isSelMN($mn->heel_to_ear, 1) ?>><img src=<?= "$base_url/images/RS49_AMB/heel_to_ear_1.png" ?> style="width:100%; max-width:45px;"></td>
                                        <td <?= isSelMN($mn->heel_to_ear, 2) ?>><img src=<?= "$base_url/images/RS49_AMB/heel_to_ear_2.png" ?> style="width:100%; max-width:45px;"></td>
                                        <td <?= isSelMN($mn->heel_to_ear, 3) ?>><img src=<?= "$base_url/images/RS49_AMB/heel_to_ear_3.png" ?> style="width:100%; max-width:45px;"></td>
                                        <td <?= isSelMN($mn->heel_to_ear, 4) ?>><img src=<?= "$base_url/images/RS49_AMB/heel_to_ear_4.png" ?> style="width:100%; max-width:45px;"></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                        <td valign="top" style="width: 25%;">
                            <table class="table-bordered" style="width: 100%; font-size: 11px; text-align: center;">
                                <thead>
                                    <tr>
                                        <th colspan="2" style="padding: 5px;">Tingkat maturitas</th>
                                    </tr>
                                    <tr>
                                        <th style="width: 50%; padding: 5px;">Jumlah skor</th>
                                        <th style="width: 50%; padding: 5px;">Minggu</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $mat_scores = [
                                        -10 => 20,
                                        -5 => 22,
                                        0 => 24,
                                        5 => 26,
                                        10 => 28,
                                        15 => 30,
                                        20 => 32,
                                        25 => 34,
                                        30 => 36,
                                        35 => 38,
                                        40 => 40,
                                        45 => 42,
                                        50 => 44
                                    ];
                                    foreach ($mat_scores as $score => $minggu) {
                                        $sel = isSelScore($tsb, $score);
                                        if ($sel) {
                                            echo "<tr>";
                                            echo "<td style='background-color: #e0e0e0; font-weight: bold; border: 2px solid black; padding: 3px;'>$score</td>";
                                            echo "<td style='background-color: #e0e0e0; font-weight: bold; border: 2px solid black; padding: 3px;'>$minggu</td>";
                                            echo "</tr>";
                                        } else {
                                            echo "<tr><td style='padding: 3px;'>$score</td><td style='padding: 3px;'>$minggu</td></tr>";
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <table class="table-bordered-no-bottom">
        <tr>
            <td>
                <?php
                $g1 = $params->grafik_pertumbuhan_base64 ?? '';
                $g2 = $params->grafik_berat_badan_base64 ?? '';
                $g3 = $params->grafik_lingkar_kepala_base64 ?? '';

                function renderBase64Img($b64)
                {
                    if (!empty($b64)) {
                        $src = strpos($b64, 'data:image') === 0 ? $b64 : "data:image/png;base64," . $b64;
                        echo '<div style="text-align: center; margin-bottom: 20px; page-break-inside: avoid;">';
                        echo '<img src="' . htmlspecialchars($src) . '" style="max-width: 100%; height: auto;">';
                        echo '</div>';
                    }
                }

                renderBase64Img($g1);
                renderBase64Img($g2);
                renderBase64Img($g3);
                ?>
            </td>
        </tr>
    </table>

    <table class="table-bordered-sides">
        <tr>
            <td>
                <!-- tabel untuk menampilkan tabel pemerikksaan utama dan kedua  -->
                <?php $est = $params->data_estimasi_umur_lainnya ?? (object)[]; ?>
                <table class="table-bordered" style="width: 100%; font-size: 11px; text-align: left; page-break-inside: avoid; margin-bottom: 10px;">
                    <thead>
                        <tr>
                            <th style="width: 40%; padding: 5px;"></th>
                            <th style="width: 30%; padding: 5px;">Pemeriksaan Pertama</th>
                            <th style="width: 30%; padding: 5px;">Pemeriksaan Kedua</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="padding: 5px; font-weight: bold;">Kecil Masa Kehamilan (KMK)</td>
                            <td style="padding: 5px;"><?= htmlspecialchars($est->pemeriksaan_pertama->kmk ?? '') ?></td>
                            <td style="padding: 5px;"><?= htmlspecialchars($est->pemeriksaan_kedua->kmk ?? '') ?></td>
                        </tr>
                        <tr>
                            <td style="padding: 5px; font-weight: bold;">Sesuai Masa Kehamilan (SMK)</td>
                            <td style="padding: 5px;"><?= htmlspecialchars($est->pemeriksaan_pertama->smk ?? '') ?></td>
                            <td style="padding: 5px;"><?= htmlspecialchars($est->pemeriksaan_kedua->smk ?? '') ?></td>
                        </tr>
                        <tr>
                            <td style="padding: 5px; font-weight: bold;">Besar Masa Kehamilan (BMK)</td>
                            <td style="padding: 5px;"><?= htmlspecialchars($est->pemeriksaan_pertama->bmk ?? '') ?></td>
                            <td style="padding: 5px;"><?= htmlspecialchars($est->pemeriksaan_kedua->bmk ?? '') ?></td>
                        </tr>
                        <tr>
                            <td style="padding: 5px; font-weight: bold;">Umur Pemeriksaan</td>
                            <td style="padding: 5px; text-align: right;">
                                <?= htmlspecialchars($est->pemeriksaan_pertama->umur_pemeriksaan_jam ?? '') ?> Jam
                            </td>
                            <td style="padding: 5px; text-align: right;">
                                <?= htmlspecialchars($est->pemeriksaan_kedua->umur_pemeriksaan_jam ?? '') ?> Jam
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </table>

    <table class="table-bordered-no-top">
        <tr>
            <td>
                <!-- tabel untuk menampilkan data diagnosa group  -->
                <div style="font-size: 12px; font-weight: bold; margin-top: 10px; margin-bottom: 5px;">Diagnosa</div>
                <div style="font-size: 11px; margin-bottom: 15px; border: 1px solid black; padding: 10px; min-height: 40px; text-align: left;">
                    <?= nl2br(htmlspecialchars($params->diagnosa_group ?? '')) ?>
                </div>

                <!-- tabel untuk menampilkan data planning  -->
                <div style="font-size: 12px; font-weight: bold; margin-bottom: 5px;">Planning</div>
                <div style="font-size: 11px; margin-bottom: 15px; border: 1px solid black; padding: 10px; min-height: 40px; text-align: left;">
                    <?= nl2br(htmlspecialchars($params->planning ?? '')) ?>
                </div>
            </td>
        </tr>
    </table>





</body>

</html>