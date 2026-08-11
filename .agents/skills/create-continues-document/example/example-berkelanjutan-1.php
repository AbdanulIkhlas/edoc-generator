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

$title = "ASSESMEN FISIOTERAPI";

$entries = isset($params->entry) ? $params->entry : [];
$static = isset($params->static_json->static_json) ? $params->static_json->static_json : null;


function tgl_indo($tanggal)
{
    if (empty($tanggal) || $tanggal == '-') return '-';
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
    $pecahkan = explode('-', date('Y-m-d', strtotime($tanggal)));
    return (int)$pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
}

function cekJenisKelamin($kode)
{
    $kode = strtoupper($kode ?? '');
    if ($kode === 'L') return "Laki-laki";
    elseif ($kode === 'P') return "Perempuan";
    else return "Tidak Diketahui";
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
        font: 11.5pt times new roman;
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

    .table-borderless,
    .table-borderless th,
    .table-borderless td {
        border: none;
        border-collapse: collapse;
    }

    .table-border-outline {
        border: 1px solid black;
        border-collapse: collapse;
        padding: .2em;
    }

    .table-no-border-bottom {
        border-top: 1px solid black;
        border-left: 1px solid black;
        border-right: 1px solid black;
        border-bottom: none;
        border-collapse: collapse;
        padding: .2em;
    }

    .table-container {
        border-top: none;
        border-left: 1px solid black;
        border-right: 1px solid black;
        border-bottom: none;
        border-collapse: collapse;
        padding: .2em;
    }


    .table-border-outline th,
    .table-border-outline td,
    .table-no-border-bottom th,
    .table-no-border-bottom td,
    .table-container th,
    .table-container td {
        border-collapse: collapse;
        padding: .2em;
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

    .flex-dotted-left {
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

    .flex-dotted-left {
        display: -webkit-box;
        -webkit-box-pack: left;
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

    .border-bottom>tbody>tr>td {
        border-bottom: solid black 1px
    }

    .align-top>tbody>tr>td {
        vertical-align: top;
    }
</style>

<body>
    <table class="table-borderless">
        <tr>
            <td class="50%" align="left"></td>
            <td class="50%" align="right"></td>
        </tr>
    </table>

    <!--START KOP DAN DATA PASIEN-->
    <table class="table-bordered">
        <tr>
            <td width="45%" style="padding:10px">
                <table class="table-borderless">
                    <tr>
                        <td width="15%" align="left"><img id="logo" style="width:100%;" src="<?= $serverAddress ?>/images/rs/LogoRS.png"></td>
                        <th width="85%" align="left" style="vertical-align: middle">
                            <h1 class="text-center" style="margin: 0; font-size: 18pt; font-weight: bold;"><?php echo $static_label->hospital_name; ?></h1>
                            <p style="margin: 0; font-size: 10pt;"><?php echo $static_label->hospital_address; ?></p>
                            <p style="margin: 0; font-size: 10pt;">Telp. <?php echo $static_label->hospital_phone; ?></p>
                        </th>
                    </tr>
                </table>
            </td>
            <td width="55%">
                <table class="table-borderless">
                    <tr>
                        <td width="30%">No. RM</td>
                        <td width="1%">:</td>
                        <td>
                            <div class="flex-container">
                                <div class="flex-dotted-left" style="width:100%">
                                    <p style="width:100%; text-align:left">
                                        <?= htmlspecialchars($static->px_data->no_rm ?? '-') ?>
                                    </p>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td style="height:8px"></td>
                    </tr>
                    <tr>
                        <td width="30%">Nama</td>
                        <td width="1%">:</td>
                        <td>
                            <div class="flex-container">
                                <div class="flex-dotted-left" style="width:100%">
                                    <p style="width:100%; text-align:left">
                                        <?= htmlspecialchars($static->px_data->nama ?? '-') ?>
                                    </p>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td style="height:8px"></td>
                    </tr>
                    <tr>
                        <td width="30%">Tgl lahir</td>
                        <td width="1%">:</td>
                        <td>
                            <div class="flex-container">
                                <div class="flex-dotted-left" style="width:100%">
                                    <p style="width:100%; text-align:left">
                                        <?= htmlspecialchars(tgl_indo($static->px_data->tanggal_lahir ?? '-')) ?>
                                    </p>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td style="height:8px"></td>
                    </tr>
                    <tr>
                        <td width="30%">Jenis Kelamin</td>
                        <td width="1%">:</td>
                        <td>
                            <div class="flex-container">
                                <div class="flex-dotted-left" style="width:100%">
                                    <p style="width:100%; text-align:left">
                                        <?= htmlspecialchars(cekJenisKelamin($static->px_data->kelamin ?? '')) ?>
                                    </p>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td width="30%">Tanggal Masuk</td>
                        <td width="1%">:</td>
                        <td>
                            <div class="flex-container">
                                <div class="flex-dotted-left" style="width:100%">
                                    <p style="width:100%; text-align:left">
                                        <?= nl2br(htmlspecialchars($static->data->tanggal_masuk_indo ?? '-')) ?>
                                    </p>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td width="30%">Jam Masuk</td>
                        <td width="1%">:</td>
                        <td>
                            <div class="flex-container">
                                <div class="flex-dotted-left" style="width:100%">
                                    <p style="width:100%; text-align:left">
                                        <?= nl2br(htmlspecialchars($static->data->jam_masuk ?? '-')) ?>
                                    </p>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <!--END KOP DAN DATA PASIEN-->

    <table class="table-borderless">
        <tr>
            <td style="font-size:14pt; background-color:black; color:white; text-align:center">
                <b>ASESMEN AWAL FISIOTERAPI</b>
            </td>
        </tr>
    </table>

    <!--START DATA MEDIS RS-->
    <table class="table-container">
        <tr>
            <td style="padding:20px; border-top:1px solid black">
                <table class="table-borderless">
                    <tr>
                        <td>1. Data medis RS</td>
                    </tr>
                    <tr>
                        <td style="padding-left:20px">
                            <table class="table-borderless">
                                <tr>
                                    <td valign="top" width="25%">a. Diagnosa medis</td>
                                    <td valign="top" width="1%">:</td>
                                    <td valign="top" colspan="3">
                                        <?= nl2br(htmlspecialchars($static->data->diagnosa_group ?? '-')) ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="25%">b. Penunjang diagnosa</td>
                                    <td width="1%">:</td>
                                    <td width="15%">
                                        <?php
                                        $rontgen = strtolower(trim($static->data->penunjang_diagnosa->rontgen));
                                        ?>
                                        <input type="checkbox" <?php echo ($rontgen) ? 'checked' : ''; ?> />
                                        <span style="margin-top: 8px;">Rontgen</span>
                                    </td>
                                    <td width="15%">
                                        <?php
                                        $lab = strtolower(trim($static->data->penunjang_diagnosa->lab));
                                        ?>
                                        <input type="checkbox" <?php echo ($lab) ? 'checked' : ''; ?> />
                                        <span style="margin-top: 8px;">Lab</span>
                                    </td>
                                    <td>
                                        <?php
                                        $ct_scan = strtolower(trim($static->data->penunjang_diagnosa->ct_scan));
                                        ?>
                                        <input type="checkbox" <?php echo ($ct_scan) ? 'checked' : ''; ?> />
                                        <span style="margin-top: 8px;">CT Scan</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="25%"></td>
                                    <td width="1%"></td>
                                    <td width="15%">
                                        <?php
                                        $mri = strtolower(trim($static->data->penunjang_diagnosa->mri));
                                        ?>
                                        <input type="checkbox" <?php echo ($mri) ? 'checked' : ''; ?> />
                                        <span style="margin-top: 8px;">MRI</span>
                                    </td>
                                    <td width="15%">
                                        <?php
                                        $enmg = strtolower(trim($static->data->penunjang_diagnosa->enmg));
                                        ?>
                                        <input type="checkbox" <?php echo ($enmg) ? 'checked' : ''; ?> />
                                        <span style="margin-top: 8px;">ENMG</span>
                                    </td>
                                    <td>
                                        <?php
                                        $eeg = strtolower(trim($static->data->penunjang_diagnosa->eeg));
                                        ?>
                                        <input type="checkbox" <?php echo ($eeg) ? 'checked' : ''; ?> />
                                        <span style="margin-top: 8px;">EEG</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td valign="top" width="25%" style="padding-left:10px">Resume</td>
                                    <td valign="top" width="1%">:</td>
                                    <td valign="top" width="15%" colspan="3">
                                        <?= $static->data->resume ?? '' ?>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <!--END DATA MEDIS RS-->

    <!--START ANEMNESIS-->
    <table class="table-container">
        <tr>
            <td style="padding:0px 20px">
                <table class="table-borderless">
                    <tr>
                        <td>2. Anamnesis</td>
                    </tr>
                    <tr>
                        <td style="padding-left:20px">
                            <table class="table-borderless">
                                <tr>
                                    <td valign="top" width="25%">a. Keluhan</td>
                                    <td valign="top" width="1%">:</td>
                                    <td valign="top">
                                        <div class="flex-container">
                                            <div class="flex-dotted-left" style="width:100%">
                                                <p style="width:100%; text-align:left;">
                                                    <?= $static->data->vital_sign->keluhan_utama ?? '' ?>
                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td valign="top" width="25%">b. Riwayat penyakit</td>
                                    <td valign="top" width="1%">:</td>
                                    <td valign="top">
                                        <?= $static->data->vital_sign->anamnesis ?? '' ?>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <!--END ANEMNESIS-->


    <!--START PEMERIKSAAN UMUM -->
    <table class="table-container">
        <tr>
            <td style="padding:0px 20px">
                <table class="table-borderless">
                    <tr>
                        <td>3. Pemeriksaan Umum</td>
                    </tr>
                    <tr>
                        <td style="padding-left:20px">
                            <table class="table-borderless">
                                <tr>
                                    <td valign="top" width="25%">a. Tensi</td>
                                    <td valign="top" width="1%">:</td>
                                    <td valign="top" colspan="2">
                                        <div class="flex-container">
                                            <div class="flex-dotted-left" style="width:100%">
                                                <p style="width:100%; text-align:left;">
                                                    <?= $static->data->vital_sign->tensi_sistole ?? '' ?> /
                                                    <?= $static->data->vital_sign->tensi_diastole ?? '' ?>
                                                </p>
                                            </div>
                                            <div>
                                                mmHg
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td valign="top" width="25%" style="padding-left:10px">Nadi</td>
                                    <td valign="top" width="1%">:</td>
                                    <td valign="top" colspan="2">
                                        <div class="flex-container">
                                            <div class="flex-dotted-left" style="width:100%">
                                                <p style="width:100%; text-align:left;">
                                                    <?= $static->data->vital_sign->nadi ?? '' ?>
                                                </p>
                                            </div>
                                            <div>
                                                x/menit
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td valign="top" width="25%" style="padding-left:10px">Suhu</td>
                                    <td valign="top" width="1%">:</td>
                                    <td valign="top" colspan="2">
                                        <div class="flex-container">
                                            <div class="flex-dotted-left" style="width:100%">
                                                <p style="width:100%; text-align:left;">
                                                    <?= $static->data->vital_sign->suhu ?? '' ?>
                                                </p>
                                            </div>
                                            <div>
                                                °C
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td valign="top" width="25%">b. Inspeksi </td>
                                    <td valign="top" width="1%"></td>
                                    <td valign="top" colspan="2">

                                    </td>
                                </tr>
                                <tr>
                                    <td valign="top" width="25%" style="padding-left:10px">
                                        - &nbsp;&nbsp; Statis
                                    </td>
                                    <td valign="top" width="1%">:</td>
                                    <td valign="top">
                                        <?php
                                        $oedem = strtolower(trim($static->data->inspeksi_statis->oedem));
                                        ?>
                                        <input type="checkbox" <?php echo ($oedem) ? 'checked' : ''; ?> />
                                        <span style="margin-top: 8px;">Oedem</span>
                                    </td>
                                    <td valign="top">
                                        <?php
                                        $kemerahan = strtolower(trim($static->data->inspeksi_statis->kemerahan));
                                        ?>
                                        <input type="checkbox" <?php echo ($kemerahan) ? 'checked' : ''; ?> />
                                        <span style="margin-top: 8px;">Kemerahan</span>
                                    </td>
                                    <td valign="top">
                                        <?php
                                        $deformitas = strtolower(trim($static->data->inspeksi_statis->deformitas));
                                        ?>
                                        <input type="checkbox" <?php echo ($deformitas) ? 'checked' : ''; ?> />
                                        <span style="margin-top: 8px;">Deformitas</span>
                                    </td>
                                    <td valign="top">
                                        <?php
                                        $atropi = strtolower(trim($static->data->inspeksi_statis->atropi));
                                        ?>
                                        <input type="checkbox" <?php echo ($atropi) ? 'checked' : ''; ?> />
                                        <span style="margin-top: 8px;">Atropi</span>
                                    </td>
                                    <td valign="top">
                                        <?php
                                        $kontraktur = strtolower(trim($static->data->inspeksi_statis->kontraktur));
                                        ?>
                                        <input type="checkbox" <?php echo ($kontraktur) ? 'checked' : ''; ?> />
                                        <span style="margin-top: 8px;">Kontraktur</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td valign="top" width="25%">

                                    </td>
                                    <td valign="top" width="1%"></td>
                                    <td valign="top" colspan="5">
                                        <div class="flex-container">
                                            <div style="padding-right:7px">
                                                di
                                            </div>
                                            <div class="flex-dotted-left" style="width:100%;">
                                                <p style="width:100%; text-align:left">
                                                    <?= $static->data->inspeksi_statis->di ?? '' ?>
                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td valign="top" width="25%" style="padding-left:10px">
                                        - &nbsp;&nbsp; Dinamis
                                    </td>
                                    <td valign="top" width="1%">:</td>
                                    <td colspan="2">Adanya perubahan dalam</td>
                                </tr>
                                <tr>
                                    <td valign="top" width="25%">
                                    </td>
                                    <td valign="top" width="1%"></td>
                                    <td valign="top">
                                        <?php
                                        $pola_jalan = strtolower(trim($static->data->inspeksi_dinamis->pola_jalan));
                                        ?>
                                        <input type="checkbox" <?php echo ($pola_jalan) ? 'checked' : ''; ?> />
                                        <span style="margin-top: 8px;">Pola jalan</span>
                                    </td>
                                    <td valign="top">
                                        <?php
                                        $sikap_tubuh = strtolower(trim($static->data->inspeksi_dinamis->sikap_tubuh));
                                        ?>
                                        <input type="checkbox" <?php echo ($sikap_tubuh) ? 'checked' : ''; ?> />
                                        <span style="margin-top: 8px;">Sikap tubuh</span>
                                    </td>
                                    <td valign="top" colspan="3">
                                        <?php
                                        $checkbox_pola_aktivitas_lain = strtolower(trim($static->data->inspeksi_dinamis->checkbox_pola_aktivitas_lain));
                                        ?>
                                        <div class="flex-container">
                                            <input type="checkbox" <?php echo ($checkbox_pola_aktivitas_lain) ? 'checked' : ''; ?> />
                                            <span style="margin-top: 8px; margin-right:7px">Pola aktifitas lain</span>
                                            <div class="flex-dotted-left" style="width:100%">
                                                <p style="width:100%; text-align:left">
                                                    <?= $static->data->inspeksi_dinamis->value_pola_aktivitas_lain ?? '' ?>
                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td valign="top" width="25%">c. Palpasi</td>
                                    <td valign="top" width="1%">:</td>
                                    <td valign="top" colspan="2">
                                        <?php
                                        $peningkatan_suhu_lokal = strtolower(trim($static->data->palpasi->peningkatan_suhu_lokal));
                                        ?>
                                        <input type="checkbox" <?php echo ($peningkatan_suhu_lokal) ? 'checked' : ''; ?> />
                                        <span style="margin-top: 8px;">Peningkatan Suhu Lokal</span>
                                    </td>
                                    <td valign="top">
                                        <?php
                                        $nyeri_tekan = strtolower(trim($static->data->palpasi->nyeri_tekan));
                                        ?>
                                        <input type="checkbox" <?php echo ($nyeri_tekan) ? 'checked' : ''; ?> />
                                        <span style="margin-top: 8px;">Nyeri Tekan</span>
                                    </td>
                                    <td valign="top">
                                        <?php
                                        $spame = strtolower(trim($static->data->palpasi->spame));
                                        ?>
                                        <input type="checkbox" <?php echo ($spame) ? 'checked' : ''; ?> />
                                        <span style="margin-top: 8px;">Spame</span>
                                    </td>
                                    <td valign="top">
                                        <?php
                                        $piting_oedem = strtolower(trim($static->data->palpasi->piting_oedem));
                                        ?>
                                        <input type="checkbox" <?php echo ($piting_oedem) ? 'checked' : ''; ?> />
                                        <span style="margin-top: 8px;">Piiting oedem</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td valign="top" width="25%">

                                    </td>
                                    <td valign="top" width="1%"></td>
                                    <td valign="top" colspan="5">
                                        <div class="flex-container">
                                            <div style="padding-right:7px">
                                                di
                                            </div>
                                            <div class="flex-dotted-left" style="width:100%;">
                                                <p style="width:100%; text-align:left">
                                                    <?= $static->data->palpasi->di ?? '' ?>
                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td valign="top" colspan="7">d. Pemeriksaan Gerak Dasar</td>
                                </tr>
                                <tr>
                                    <td valign="top" colspan="7">
                                        <?php
                                        if (empty($static->data->pemeriksaan_gerak_dasar)) {
                                        ?>
                                            <div class="flex-container">
                                                <div class="flex-dotted">
                                                    &nbsp;
                                                </div>
                                            </div>
                                        <?php
                                        } else {
                                            echo $static->data->pemeriksaan_gerak_dasar;
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="7" style="height:10px"></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <!--END PEMERIKSAAN UMUM -->

    <!--START KEMAMPUAN FUNGSIONAL -->
    <table class="table-container">
        <tr>
            <td style="padding:0px 20px">
                <table class="table-borderless">
                    <tr>
                        <td>4. Kemampuan Fungsional</td>
                    </tr>
                    <tr>
                        <td>
                            <?php
                            if (empty($static->data->kemampuan_fungsional)) {
                            ?>
                                <div class="flex-container">
                                    <div class="flex-dotted">
                                        &nbsp;
                                    </div>
                                </div>
                            <?php
                            } else {
                                echo $static->data->kemampuan_fungsional;
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="height:10px"></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <!--END KEMAMPUAN FUNGSIONAL-->

    <!--START DIAGNOSIS FISIOTERAPIS-->
    <table class="table-container">
        <tr>
            <td style="padding:0px 20px">
                <table class="table-borderless">
                    <tr>
                        <td>5. Diagnosis Fisioterapis</td>
                    </tr>
                    <tr>
                        <td>
                            <?php
                            if (empty($static->data->diagnosis_fisioterapis)) {
                            ?>
                                <div class="flex-container">
                                    <div class="flex-dotted">
                                        &nbsp;
                                    </div>
                                </div>
                            <?php
                            } else {
                                echo $static->data->diagnosis_fisioterapis;
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="height:10px"></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <!--END DIAGNOSIS FISIOTERAPIS-->

    <!--START PROGRAM FISIOTERAPIS-->
    <table class="table-container">
        <tr>
            <td style="padding:0px 20px">
                <table class="table-borderless">
                    <tr>
                        <td>6. Program Fisioterapis</td>
                    </tr>
                    <tr>
                        <td>
                            <?php
                            if (empty($static->data->program_fisioterapis)) {
                            ?>
                                <div class="flex-container">
                                    <div class="flex-dotted">
                                        &nbsp;
                                    </div>
                                </div>
                            <?php
                            } else {
                                echo $static->data->program_fisioterapis;
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="height:10px"></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <!--END PROGRAM FISIOTERAPIS-->


    <!--START EVALUASI DAN TINDAK LANJUT-->
    <table class="table-container">
        <tr>
            <td style="padding:0px 20px">
                <table class="table-borderless">
                    <tr>
                        <td>7. Evaluasi dan Tindak lanjut</td>
                    </tr>
                    <tr>
                        <td>
                            <?php
                            if (empty($static->data->evaluasi_dan_tindak_lanjut)) {
                            ?>
                                <div class="flex-container">
                                    <div class="flex-dotted">
                                        &nbsp;
                                    </div>
                                </div>
                            <?php
                            } else {
                                echo $static->data->evaluasi_dan_tindak_lanjut;
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="height:10px"></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <!--END EVALUASI DAN TINDAK LANJUT-->


    <!--START TTD -->
    <table class="table-container">
        <tr>
            <td style="padding:0px 20px; border-bottom:1px solid black; padding-bottom:10px">
                <table class="table-borderless">
                    <tr>
                        <td width="50%"></td>
                        <td width="50%" align="center">
                            <p>Fisioterapis</p>
                            <img src="<?= $static->data->ttd_data->dokter_stroke ?? '' ?>" style="height: 70px; width: auto; display: block; margin: 8px auto;">
                            <div class="flex-container">
                                <div>(</div>
                                <div class="flex-dotted" style="text-align:center">
                                    <p style=" margin-top: 5px; width:100%; text-align:center;"><?= $static->data->ttd_data->dokter ?? '' ?></p>
                                </div>
                                <div>)</div>
                            </div>
                        </td>
                    </tr>
                </table>
                <!--end ttd-->
            </td>
        </tr>
    </table>
    <!--END TTD -->

    <div class="pagebreak"></div>
    <!--un-comment jika di butuhkan-->
    <table class="table-borderless border-bottom">
        <tr>
            <td align="center">ASESMEN LANJUTAN FISIOTERAPI NEUROMUSKULER</td>
        </tr>
    </table>

    <table class="border-bottom">
        <?php foreach ($entries as $row): ?>
            <?php $v = is_object($row) && isset($row->entry_data) ? $row->entry_data : $row; ?>
            <tr>
                <td>
                    <table border="0" class="align-top">
                        <tr>
                            <td width="14%">Tanggal</td>
                            <td width="1%">:</td>
                            <td width="35%">
                                <?= $v->tanggal_indo ?>
                            </td>
                            <td width="50%">
                                Jam : <?= $v->jam ?> WIB
                            </td>

                        </tr>
                        <tr>
                            <td>Anamnesis</td>
                            <td>:</td>
                            <td colspan="2">
                                <?= $v->anamnesis ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Pemeriksaan</td>
                            <td>:</td>
                            <td colspan="2">
                                <?= $v->pemeriksaan ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Diagnosa</td>
                            <td>:</td>
                            <td colspan="2">
                                <?= nl2br(htmlspecialchars($v->diagnosa ?? '-')) ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Fisioterapi</td>
                            <td>:</td>
                            <td colspan="2">
                                <?= nl2br(htmlspecialchars($v->fisioterapi ?? '-')) ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Tindakan</td>
                            <td>:</td>
                            <td colspan="2">
                                <?= nl2br(htmlspecialchars($v->tindakan ?? '-')) ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Rencana</td>
                            <td>:</td>
                            <td colspan="2">
                                <?= $v->rencana ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3"></td>
                            <td align="center">
                                <img src="<?= $v->ttd_data->dokter_stroke ?? '' ?>" style="height: 70px; width: auto; display: block; margin: 8px auto;"> <br />
                                <?= $v->ttd_data->dokter ?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

</body>

</html>