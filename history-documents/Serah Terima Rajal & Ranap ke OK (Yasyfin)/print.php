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
    <!-- AI will insert the main HTML structure and data binding here -->
    <table style="width: 100%;">
        <tr style="padding-bottom: 5px; padding-top: 5px;">
            <td valign="top" width="15%" style="vertical-align: middle; text-align: center;">
                <img style="width: 70px" src="<?= $base_url; ?>/images/rs/LogoRS.png">
            </td>
            <td valign="top" width="40%" style="vertical-align: middle;">
                <h4 style="margin: 0; font-size: 14pt;"><?php echo $static_label->hospital_name ?? ""; ?></h4>
                <div style="font-size: 10pt; line-height: 1.3; margin-top: 5px;">
                    <?php echo !empty($static_label->hospital_address) ? $static_label->hospital_address . "<br>" : ""; ?>
                    <?php echo !empty($static_label->hospital_phone) ? "Telp. " . $static_label->hospital_phone . "<br>" : ""; ?>
                    <?php echo !empty($static_label->hospital_email) ? "Email: " . $static_label->hospital_email : ""; ?>
                </div>
            </td>
            <td valign="top" class="table-bordered" width="45%" style="vertical-align: middle; padding: 10px; font-size:12pt">
                <table style="width:100%;" class="table-borderless">
                    <tr>
                        <td valign="top" width="30%">No RM</td>
                        <td valign="top" width="2%">:</td>
                        <td valign="top"><?php echo $params->pasien->no_rm ?? ""; ?></td>
                    </tr>
                    <tr>
                        <td valign="top">Nama Pasien</td>
                        <td valign="top">:</td>
                        <td valign="top"><?php echo $params->pasien->nama ?? ""; ?></td>
                    </tr>
                    <tr>
                        <td valign="top">Tanggal Lahir</td>
                        <td valign="top">:</td>
                        <td valign="top"><?php echo tgl_indo($params->pasien->tanggal_lahir ?? ""); ?></td>
                    </tr>
                    <tr>
                        <td valign="top">Alamat</td>
                        <td valign="top">:</td>
                        <td valign="top"><?php echo $params->pasien->alamat ?? ""; ?></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <br>

    <table class="table-bordered main-outer-table" style="width: 100%; page-break-inside: auto; margin-top: 5px;">
        <!-- Judul -->
        <tr>
            <td valign="top" colspan="6" style="text-align: center; font-weight: bold; font-size: 14pt; padding: 10px;">
                CEKLIST SERAH TERIMA PASIEN <br>
                DARI RAJAL / RANAP KE KAMAR OPERASI
            </td>
        </tr>
        <!-- Info Operasi -->
        <tr>
            <td valign="top" colspan="3">
                <table class="table-borderless">
                    <tr>
                        <td valign="top" width="30%">Hari / Tanggal</td>
                        <td valign="top" width="2%">:</td>
                        <td valign="top"><?php echo tgl_indo($params->informasi_operasi->tanggal ?? ""); ?></td>
                    </tr>
                </table>
            </td>
            <td valign="top" colspan="3">
                <table class="table-borderless">
                    <tr>
                        <td valign="top" width="30%">Jam</td>
                        <td valign="top" width="2%">:</td>
                        <td valign="top"><?php echo $params->informasi_operasi->jam ?? ""; ?></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td valign="top" colspan="3">
                <table class="table-borderless">
                    <tr>
                        <td valign="top" width="30%">Dr. Operator</td>
                        <td valign="top" width="2%">:</td>
                        <td valign="top"><?php echo $params->informasi_operasi->dokter_operator ?? ""; ?></td>
                    </tr>
                </table>
            </td>
            <td valign="top" colspan="3">
                <table class="table-borderless">
                    <tr>
                        <td valign="top" width="30%">Dr. Operator I</td>
                        <td valign="top" width="2%">:</td>
                        <td valign="top"><?php echo $params->informasi_operasi->dokter_operator_1 ?? ""; ?></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td valign="top" colspan="3">
                <table class="table-borderless">
                    <tr>
                        <td valign="top" width="30%">Dr. Anestesi</td>
                        <td valign="top" width="2%">:</td>
                        <td valign="top"><?php echo $params->informasi_operasi->dokter_anestesi ?? ""; ?></td>
                    </tr>
                </table>
            </td>
            <td valign="top" colspan="3">
                <table class="table-borderless">
                    <tr>
                        <td valign="top" width="30%">Dr. Pendamping</td>
                        <td valign="top" width="2%">:</td>
                        <td valign="top"><?php echo $params->informasi_operasi->dokter_pendamping ?? ""; ?></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td valign="top" colspan="6">
                <table class="table-borderless">
                    <tr>
                        <td valign="top" width="15%">Tindakan</td>
                        <td valign="top" width="2%">:</td>
                        <td valign="top"><?php echo $params->informasi_operasi->tindakan ?? ""; ?></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td valign="top" colspan="6">
                <table class="table-borderless">
                    <tr>
                        <td valign="top" width="15%">Lokasi</td>
                        <td valign="top" width="2%">:</td>
                        <td valign="top"><?php echo $params->informasi_operasi->lokasi_tindakan ?? ""; ?></td>
                    </tr>
                </table>
            </td>
        </tr>

        <!-- Bagian A. PERSIAPAN MENJELANG OPERASI -->
        <tr>
            <td valign="top" colspan="6" style="font-weight: bold; padding: 5px;">A. PERSIAPAN MENJELANG OPERASI</td>
        </tr>
        <tr style="font-weight: bold; text-align: center;">
            <td valign="top" width="40%">Persiapan Menjelang Operasi</td>
            <td valign="top" width="5%">RI / RJ</td>
            <td valign="top" width="5%">OK</td>
            <td valign="top" width="40%">Persiapan Menjelang Operasi</td>
            <td valign="top" width="5%">RI / RJ</td>
            <td valign="top" width="5%">OK</td>
        </tr>
        <tr>
            <td valign="top">1. Infus............. <?php echo $params->persiapan_menjelang_operasi->infus->tts_mnt ?? ""; ?> tts/mnt</td>
            <td valign="top" style="text-align: center;"><?php echo !empty($params->persiapan_menjelang_operasi->infus->ri_rj) ? "V" : ""; ?></td>
            <td valign="top" style="text-align: center;"><?php echo !empty($params->persiapan_menjelang_operasi->infus->ok) ? "V" : ""; ?></td>

            <td valign="top">11. Saat mengantar ke OK</td>
            <td valign="top" style="background-color: #f0f0f0;"></td>
            <td valign="top" style="background-color: #f0f0f0;"></td>
        </tr>
        <tr>
            <td valign="top">2. Pasang DC</td>
            <td valign="top" style="text-align: center;"><?php echo !empty($params->persiapan_menjelang_operasi->pasang_dc->ri_rj) ? "V" : ""; ?></td>
            <td valign="top" style="text-align: center;"><?php echo !empty($params->persiapan_menjelang_operasi->pasang_dc->ok) ? "V" : ""; ?></td>

            <td valign="top" style="padding-left: 15px;">a. Status Pasien</td>
            <td valign="top" style="text-align: center;"><?php echo !empty($params->persiapan_menjelang_operasi->status_pasien->ri_rj) ? "V" : ""; ?></td>
            <td valign="top" style="text-align: center;"><?php echo !empty($params->persiapan_menjelang_operasi->status_pasien->ok) ? "V" : ""; ?></td>
        </tr>
        <tr>
            <td valign="top">3. Kosongkan VU/Kantong Urin</td>
            <td valign="top" style="text-align: center;"><?php echo !empty($params->persiapan_menjelang_operasi->kosongkan_vu->ri_rj) ? "V" : ""; ?></td>
            <td valign="top" style="text-align: center;"><?php echo !empty($params->persiapan_menjelang_operasi->kosongkan_vu->ok) ? "V" : ""; ?></td>

            <td valign="top" style="padding-left: 15px;">b. EKG</td>
            <td valign="top" style="text-align: center;"><?php echo !empty($params->persiapan_menjelang_operasi->ekg->ri_rj) ? "V" : ""; ?></td>
            <td valign="top" style="text-align: center;"><?php echo !empty($params->persiapan_menjelang_operasi->ekg->ok) ? "V" : ""; ?></td>
        </tr>
        <tr>
            <td valign="top">4. Cukur............. <?php echo $params->persiapan_menjelang_operasi->cukur->detail ?? ""; ?></td>
            <td valign="top" style="text-align: center;"><?php echo !empty($params->persiapan_menjelang_operasi->cukur->ri_rj) ? "V" : ""; ?></td>
            <td valign="top" style="text-align: center;"><?php echo !empty($params->persiapan_menjelang_operasi->cukur->ok) ? "V" : ""; ?></td>

            <td valign="top" style="padding-left: 15px;">c. RO, USG, CT Scan</td>
            <td valign="top" style="text-align: center;"><?php echo !empty($params->persiapan_menjelang_operasi->ro_usg_ctscan->ri_rj) ? "V" : ""; ?></td>
            <td valign="top" style="text-align: center;"><?php echo !empty($params->persiapan_menjelang_operasi->ro_usg_ctscan->ok) ? "V" : ""; ?></td>
        </tr>
        <tr>
            <td valign="top">5. Lavement pukul............. <?php echo $params->persiapan_menjelang_operasi->lavement->pukul ?? ""; ?></td>
            <td valign="top" style="text-align: center;"><?php echo !empty($params->persiapan_menjelang_operasi->lavement->ri_rj) ? "V" : ""; ?></td>
            <td valign="top" style="text-align: center;"><?php echo !empty($params->persiapan_menjelang_operasi->lavement->ok) ? "V" : ""; ?></td>

            <td valign="top" style="padding-left: 15px;">d. Lembar Konsultasi</td>
            <td valign="top" style="text-align: center;"><?php echo !empty($params->persiapan_menjelang_operasi->lembar_konsultasi->ri_rj) ? "V" : ""; ?></td>
            <td valign="top" style="text-align: center;"><?php echo !empty($params->persiapan_menjelang_operasi->lembar_konsultasi->ok) ? "V" : ""; ?></td>
        </tr>
        <tr>
            <td valign="top">6. Puasa............. <?php echo $params->persiapan_menjelang_operasi->puasa->jam_sebelum_op ?? ""; ?> jam sebelum OP</td>
            <td valign="top" style="text-align: center;"><?php echo !empty($params->persiapan_menjelang_operasi->puasa->ri_rj) ? "V" : ""; ?></td>
            <td valign="top" style="text-align: center;"><?php echo !empty($params->persiapan_menjelang_operasi->puasa->ok) ? "V" : ""; ?></td>

            <td valign="top" style="padding-left: 15px;">e. Informed Consent Bedah</td>
            <td valign="top" style="text-align: center;"><?php echo !empty($params->persiapan_menjelang_operasi->informed_consent_bedah->ri_rj) ? "V" : ""; ?></td>
            <td valign="top" style="text-align: center;"><?php echo !empty($params->persiapan_menjelang_operasi->informed_consent_bedah->ok) ? "V" : ""; ?></td>
        </tr>
        <tr>
            <td valign="top">7. Pakai Baju Operasi</td>
            <td valign="top" style="text-align: center;"><?php echo !empty($params->persiapan_menjelang_operasi->pakai_baju_operasi->ri_rj) ? "V" : ""; ?></td>
            <td valign="top" style="text-align: center;"><?php echo !empty($params->persiapan_menjelang_operasi->pakai_baju_operasi->ok) ? "V" : ""; ?></td>

            <td valign="top" style="padding-left: 15px;">f. Informed Consent Anestesi</td>
            <td valign="top" style="text-align: center;"><?php echo !empty($params->persiapan_menjelang_operasi->informed_consent_anestesi->ri_rj) ? "V" : ""; ?></td>
            <td valign="top" style="text-align: center;"><?php echo !empty($params->persiapan_menjelang_operasi->informed_consent_anestesi->ok) ? "V" : ""; ?></td>
        </tr>
        <tr>
            <td valign="top">8. Potong Kuku</td>
            <td valign="top" style="text-align: center;"><?php echo !empty($params->persiapan_menjelang_operasi->potong_kuku->ri_rj) ? "V" : ""; ?></td>
            <td valign="top" style="text-align: center;"><?php echo !empty($params->persiapan_menjelang_operasi->potong_kuku->ok) ? "V" : ""; ?></td>

            <td valign="top" style="padding-left: 15px;">g. Darah transfusi............. <?php echo $params->persiapan_menjelang_operasi->darah_transfusi->colf ?? ""; ?> Colf jenis............. <?php echo $params->persiapan_menjelang_operasi->darah_transfusi->jenis ?? ""; ?></td>
            <td valign="top" style="text-align: center;"><?php echo !empty($params->persiapan_menjelang_operasi->darah_transfusi->ri_rj) ? "V" : ""; ?></td>
            <td valign="top" style="text-align: center;"><?php echo !empty($params->persiapan_menjelang_operasi->darah_transfusi->ok) ? "V" : ""; ?></td>
        </tr>
        <tr>
            <td valign="top">9. Lepas dan Simpan dengan baik</td>
            <td valign="top" style="background-color: #f0f0f0;"></td>
            <td valign="top" style="background-color: #f0f0f0;"></td>

            <td valign="top" style="padding-left: 15px;">h. Obat............. <?php echo $params->persiapan_menjelang_operasi->obat->detail ?? ""; ?></td>
            <td valign="top" style="text-align: center;"><?php echo !empty($params->persiapan_menjelang_operasi->obat->ri_rj) ? "V" : ""; ?></td>
            <td valign="top" style="text-align: center;"><?php echo !empty($params->persiapan_menjelang_operasi->obat->ok) ? "V" : ""; ?></td>
        </tr>
        <tr>
            <td valign="top" style="padding-left: 15px;">a. Gigi Palsu</td>
            <td valign="top" style="text-align: center;"><?php echo !empty($params->persiapan_menjelang_operasi->lepas_gigi_palsu->ri_rj) ? "V" : ""; ?></td>
            <td valign="top" style="text-align: center;"><?php echo !empty($params->persiapan_menjelang_operasi->lepas_gigi_palsu->ok) ? "V" : ""; ?></td>

            <td valign="top">12. Persediaan darah transfusi</td>
            <td valign="top" style="background-color: #f0f0f0;"></td>
            <td valign="top" style="background-color: #f0f0f0;"></td>
        </tr>
        <tr>
            <td valign="top" style="padding-left: 15px;">b. Lensa kontak / kaca mata</td>
            <td valign="top" style="text-align: center;"><?php echo !empty($params->persiapan_menjelang_operasi->lepas_lensa_kontak->ri_rj) ? "V" : ""; ?></td>
            <td valign="top" style="text-align: center;"><?php echo !empty($params->persiapan_menjelang_operasi->lepas_lensa_kontak->ok) ? "V" : ""; ?></td>

            <td valign="top" style="padding-left: 15px;">a. Donor............. <?php echo $params->persiapan_menjelang_operasi->donor->orang ?? ""; ?> orang</td>
            <td valign="top" style="text-align: center;"><?php echo !empty($params->persiapan_menjelang_operasi->donor->ri_rj) ? "V" : ""; ?></td>
            <td valign="top" style="text-align: center;"><?php echo !empty($params->persiapan_menjelang_operasi->donor->ok) ? "V" : ""; ?></td>
        </tr>
        <tr>
            <td valign="top" style="padding-left: 15px;">c. Perhiasan............. <?php echo $params->persiapan_menjelang_operasi->lepas_perhiasan->detail ?? ""; ?></td>
            <td valign="top" style="text-align: center;"><?php echo !empty($params->persiapan_menjelang_operasi->lepas_perhiasan->ri_rj) ? "V" : ""; ?></td>
            <td valign="top" style="text-align: center;"><?php echo !empty($params->persiapan_menjelang_operasi->lepas_perhiasan->ok) ? "V" : ""; ?></td>

            <td valign="top" style="padding-left: 15px;">b. PMI............. <?php echo $params->persiapan_menjelang_operasi->pmi->colf ?? ""; ?> Colf Jenis............. <?php echo $params->persiapan_menjelang_operasi->pmi->jenis ?? ""; ?></td>
            <td valign="top" style="text-align: center;"><?php echo !empty($params->persiapan_menjelang_operasi->pmi->ri_rj) ? "V" : ""; ?></td>
            <td valign="top" style="text-align: center;"><?php echo !empty($params->persiapan_menjelang_operasi->pmi->ok) ? "V" : ""; ?></td>
        </tr>
        <tr>
            <td valign="top">10. Hapus Make-Up/ Cta Kuku</td>
            <td valign="top" style="text-align: center;"><?php echo !empty($params->persiapan_menjelang_operasi->hapus_makeup->ri_rj) ? "V" : ""; ?></td>
            <td valign="top" style="text-align: center;"><?php echo !empty($params->persiapan_menjelang_operasi->hapus_makeup->ok) ? "V" : ""; ?></td>

            <td valign="top" style="padding-left: 15px;">c. Penyimpanan............. <?php echo $params->persiapan_menjelang_operasi->penyimpanan->detail ?? ""; ?></td>
            <td valign="top" style="text-align: center;"><?php echo !empty($params->persiapan_menjelang_operasi->penyimpanan->ri_rj) ? "V" : ""; ?></td>
            <td valign="top" style="text-align: center;"><?php echo !empty($params->persiapan_menjelang_operasi->penyimpanan->ok) ? "V" : ""; ?></td>
        </tr>

        <!-- Bagian PENANDAAN LOKASI OPERASI -->
        <tr>
            <td valign="top" colspan="3" style="font-weight: bold;">PENANDAAN LOKASI OPERASI</td>
            <td valign="top" colspan="3" style="text-align: center;">
                <table class="table-borderless" style="margin: 0 auto; width: auto;">
                    <tr>
                        <td valign="top" style="padding-right: 20px;">
                            <input type="checkbox" <?php echo !empty($params->penandaan_lokasi_operasi->ya) ? "checked='checked'" : ""; ?>> Ya
                        </td>
                        <td valign="top">
                            <input type="checkbox" <?php echo !empty($params->penandaan_lokasi_operasi->tidak_diperlukan) ? "checked='checked'" : ""; ?>> Tidak diperlukan
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <!-- Bagian B. ANAMNESIS -->
        <tr>
            <td valign="top" colspan="6" style="font-weight: bold; padding: 5px;">B. ANAMNESIS</td>
        </tr>
        <tr>
            <td valign="top" colspan="6">
                <table class="table-borderless" style="width: 100%;">
                    <tr>
                        <td valign="top" width="30%">1. Riwayat penyakit dahulu</td>
                        <td valign="top" width="25%">
                            <input type="checkbox" <?php echo !empty($params->anamnesis->riwayat_penyakit_dahulu->penyakit_jantung) ? "checked='checked'" : ""; ?>> Penyakit Jantung<br>
                            <input type="checkbox" <?php echo !empty($params->anamnesis->riwayat_penyakit_dahulu->hipertensi) ? "checked='checked'" : ""; ?>> Hipertensi
                        </td>
                        <td valign="top" width="20%">
                            <input type="checkbox" <?php echo !empty($params->anamnesis->riwayat_penyakit_dahulu->asma) ? "checked='checked'" : ""; ?>> Asma<br>
                            <input type="checkbox" <?php echo !empty($params->anamnesis->riwayat_penyakit_dahulu->ppok) ? "checked='checked'" : ""; ?>> PPOK
                        </td>
                        <td valign="top" width="25%">
                            <input type="checkbox" <?php echo !empty($params->anamnesis->riwayat_penyakit_dahulu->penyakit_ginjal) ? "checked='checked'" : ""; ?>> Penyakit Ginjal<br>
                            <input type="checkbox" <?php echo !empty($params->anamnesis->riwayat_penyakit_dahulu->penyakit_hati) ? "checked='checked'" : ""; ?>> Penyakit hati
                        </td>
                    </tr>
                    <tr>
                        <td valign="top"></td>
                        <td valign="top">
                            <input type="checkbox" <?php echo !empty($params->anamnesis->riwayat_penyakit_dahulu->alergi_obat) ? "checked='checked'" : ""; ?>> Alergi Obat<br>
                            <input type="checkbox" <?php echo !empty($params->anamnesis->riwayat_penyakit_dahulu->alergi_makanan) ? "checked='checked'" : ""; ?>> Alergi Makanan
                        </td>
                        <td valign="top" colspan="2"></td>
                    </tr>
                </table>

                <div style="margin-top: 10px;">
                    2. Riwayat Pengobatan <br>
                    <?php echo nl2br($params->resep_freetext ?? ""); ?>
                </div>

                <table class="table-borderless" style="width: 100%; margin-top: 10px;">
                    <tr>
                        <td valign="top" width="30%">3. Riwayat Operasi Terdahulu : </td>
                        <td valign="top" width="25%">
                            <input type="checkbox" <?php echo ($params->anamnesis->riwayat_operasi_terdahulu == 'Pernah') ? "checked='checked'" : ""; ?>> Pernah
                        </td>
                        <td valign="top" width="45%">
                            <input type="checkbox" <?php echo ($params->anamnesis->riwayat_operasi_terdahulu == 'Tidak Pernah') ? "checked='checked'" : ""; ?>> Tidak Pernah
                        </td>
                    </tr>
                    <tr>
                        <td valign="top">&nbsp;&nbsp;&nbsp;&nbsp;Jika pernah</td>
                        <td valign="top">
                            <input type="checkbox" <?php echo ($params->anamnesis->komplikasi == 'Ada Komplikasi') ? "checked='checked'" : ""; ?>> Ada Kompilkasi
                        </td>
                        <td valign="top">
                            <input type="checkbox" <?php echo ($params->anamnesis->komplikasi == 'Tidak Ada Komplikasi') ? "checked='checked'" : ""; ?>> Tidak Ada Komplikasi
                        </td>
                    </tr>
                </table>

                <table class="table-borderless" style="width: 100%; margin-top: 10px;">
                    <tr>
                        <td valign="top" colspan="3">4. Riwayat Penggunaan bahan tertentu</td>
                    </tr>
                    <tr>
                        <td valign="top" width="40%">
                            &nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" <?php echo !empty($params->anamnesis->riwayat_penggunaan_bahan->obat_penenang) ? "checked='checked'" : ""; ?>> Obat penenang / Narkotika
                        </td>
                        <td valign="top" width="20%">
                            <input type="checkbox" <?php echo !empty($params->anamnesis->riwayat_penggunaan_bahan->merokok) ? "checked='checked'" : ""; ?>> Merokok
                        </td>
                        <td valign="top" width="40%">
                            <input type="checkbox" <?php echo !empty($params->anamnesis->riwayat_penggunaan_bahan->alkohol) ? "checked='checked'" : ""; ?>> Alkohol
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <!-- Bagian C. PEMERIKSAAN FISIK -->
        <tr>
            <td valign="top" colspan="6" style="font-weight: bold; padding: 5px;">C. PEMERIKSAAN FISIK</td>
        </tr>
        <tr>
            <td valign="top" colspan="6">
                <table class="table-borderless" style="width: 100%;">
                    <tr>
                        <td valign="top" width="15%">Tek. Darah</td>
                        <td valign="top" width="2%">:</td>
                        <td valign="top" width="20%"><?php echo $params->pemeriksaan_fisik->tensi_sistole ?? ""; ?> / <?php echo $params->pemeriksaan_fisik->tensi_diastole ?? ""; ?> mmHg</td>
                        <td valign="top" width="15%">Frek. Nafas</td>
                        <td valign="top" width="2%">:</td>
                        <td valign="top" width="20%"><?php echo $params->pemeriksaan_fisik->frek_nafas ?? ""; ?> x/mnt</td>
                        <td valign="top" width="10%">BB</td>
                        <td valign="top" width="2%">:</td>
                        <td valign="top" width="14%"><?php echo $params->pemeriksaan_fisik->bb ?? ""; ?> Kg</td>
                    </tr>
                    <tr>
                        <td valign="top">Frek. Nadi</td>
                        <td valign="top">:</td>
                        <td valign="top"><?php echo $params->pemeriksaan_fisik->frek_nadi ?? ""; ?> x/mnt</td>
                        <td valign="top">Suhu</td>
                        <td valign="top">:</td>
                        <td valign="top"><?php echo $params->pemeriksaan_fisik->suhu ?? ""; ?> &deg;C</td>
                        <td valign="top">TB</td>
                        <td valign="top">:</td>
                        <td valign="top"><?php echo $params->pemeriksaan_fisik->tb ?? ""; ?> cm</td>
                    </tr>
                </table>
            </td>
        </tr>

        <!-- Bagian D. PEMERIKSAAN PENUNJANG -->
        <tr>
            <td valign="top" colspan="6" style="font-weight: bold; padding: 5px;">D. PEMERIKSAAN PENUNJANG</td>
        </tr>
        <tr>
            <td valign="top" colspan="6">
                <table class="table-borderless" style="width: 100%;">
                    <tr>
                        <td valign="top" width="20%">Laboratorium</td>
                        <td valign="top" width="20%">Hb. <?php echo $params->pemeriksaan_penunjang->hb ?? ""; ?></td>
                        <td valign="top" width="20%">Al : <?php echo $params->pemeriksaan_penunjang->al ?? ""; ?></td>
                        <td valign="top" width="20%">AT : <?php echo $params->pemeriksaan_penunjang->at ?? ""; ?></td>
                        <td valign="top" width="20%">GOL : <?php echo $params->pemeriksaan_penunjang->gol ?? ""; ?></td>
                    </tr>
                    <tr>
                        <td valign="top"></td>
                        <td valign="top">PT. <?php echo $params->pemeriksaan_penunjang->pt ?? ""; ?></td>
                        <td valign="top">APPT : <?php echo $params->pemeriksaan_penunjang->appt ?? ""; ?></td>
                        <td valign="top">GDS : <?php echo $params->pemeriksaan_penunjang->gds ?? ""; ?></td>
                        <td valign="top">HbsAG : <?php echo $params->pemeriksaan_penunjang->hbsag ?? ""; ?></td>
                    </tr>
                </table>
            </td>
        </tr>

        <!-- Bagian E. CATATAN -->
        <tr>
            <td valign="top" colspan="6" style="font-weight: bold; padding: 5px;">E. CATATAN</td>
        </tr>
        <tr>
            <td valign="top" colspan="6" style="padding: 10px; min-height: 50px;">
                <?php echo nl2br($params->catatan ?? ""); ?>
            </td>
        </tr>

        <!-- Tanda Tangan -->
        <tr>
            <td valign="top" colspan="3" style="text-align: center; padding: 10px;">
                Perawat Pengantar di OK
                <br><br>
                <?php if (!empty($params->ttd_data->perawat_pengantar)) { ?>
                    <img src="<?php echo $params->ttd_data->perawat_pengantar; ?>" class="tanda-tangan">
                <?php } else { ?>
                    <br><br><br><br>
                <?php } ?>
                <br>
                (..................................................)
            </td>
            <td valign="top" colspan="3" style="text-align: center; padding: 10px;">
                Perawat Penerima di OK
                <br><br>
                <?php if (!empty($params->ttd_data->perawat_penerima)) { ?>
                    <img src="<?php echo $params->ttd_data->perawat_penerima; ?>" class="tanda-tangan">
                <?php } else { ?>
                    <br><br><br><br>
                <?php } ?>
                <br>
                (..................................................)
            </td>
        </tr>
    </table>
</body>

</html>