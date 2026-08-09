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

</body>

</html>