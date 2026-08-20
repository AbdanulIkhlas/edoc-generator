<?php
// EMR Data
$params = json_decode($argv[1]);

$base_url = $argv[2]; // Base_url
$title = "ASESMEN AWAL MEDIS GIGI DAN MULUT GAWAT DARURAT";
$static_label = json_decode($argv[3]);

// Ambil data coretan jika ada
// $image_canvas = $params->image_canvas ?? null;
// $canvas1_image = isset($image_canvas->canvas1->image_base64) ? $image_canvas->canvas1->image_base64 : null;
// $canvas2_image = isset($image_canvas->canvas2->image_base64) ? $image_canvas->canvas2->image_base64 : null;
// $canvas3_image = isset($image_canvas->canvas3->image_base64) ? $image_canvas->canvas3->image_base64 : null;
// $canvas4_image = isset($image_canvas->canvas4->image_base64) ? $image_canvas->canvas4->image_base64 : null;


// pilihan Pemeriksaan Gigi dan Mulut
function pilihanCoret($selected, $value)
{
    if ($selected === $value) {
        return $value; // jika dipilih → normal
    } else {
        return '<span style="text-decoration: line-through;">' . $value . '</span>'; // jika tidak → coret
    }
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
        font: 14pt times new roman;
        size: f4;
        padding-bottom: 10px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
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

    .table-kop,
    .table-judul

    /*.table-time,*/
    /*.section-satu,*/
    /*.section-dua*/
        {
        border: 1px solid #000;
    }

    .hospital-name,
    .hospital-agen {
        font-size: 20px;
    }

    .hospital-address,
    .hospital-info {
        font-size: 12px;
    }

    .border-right {
        border-right: 1px solid #000;
    }

    .table-data {
        font-size: 16px;
        padding-top: 6px;
        padding-left: 5px;
        padding-right: 5px;
        border: 1px solid #000;
    }

    .poin {
        margin-top: 5px;
        margin-left: 12px;
        margin-right: 12px;
    }

    .poin-fisik-table {
        width: 90%;
        margin-top: 0px;
        margin-left: 35px;
    }
</style>

<body>
    <table class="table-kop">
        <tr>
            <td class="w10" style="vertical-align: middle;">
                <img style="width: 100%;padding: 5px;" src="<?= "$base_url/images/rs/LogoRS.png" ?>">
            </td>
            <td align="center" class="border-right">
                <div class="hospital-agen">
                    <b><?php echo $static_label->hospital_agency ?></b>
                </div>
                <div class="hospital-name">
                    <b><?php echo $static_label->hospital_name; ?></b>
                </div>
                <div class="hospital-address">
                    <?php echo $static_label->hospital_address; ?>
                </div>
                <div class="hospital-info">
                    <p>e-mail : <?php echo $static_label->hospital_email; ?></p>
                </div>
            </td>
            <td class="w40" style="padding: 10px;">
                <table style="font-size: 16px;">
                    <tr>
                        <td width="35%" valign="top">No.RM</td>
                        <td width="3%" valign="top">:</td>
                        <td width="62%" valign="top"><?= $params->pasien->no_rm ?></td>
                    </tr>
                    <tr>
                        <td valign="top">Nama</td>
                        <td valign="top">:</td>
                        <td valign="top"><?= $params->pasien->nama ?></td>
                    </tr>
                    <tr>
                        <td valign="top">Tgl. Lahir</td>
                        <td valign="top">:</td>
                        <td valign="top"><?= $params->pasien->tanggal_lahir_indo ?></td>
                    </tr>
                    <tr>
                        <td valign="top">Jenis Kelamin</td>
                        <td valign="top">:</td>
                        <td valign="top"><?= $params->pasien->kelamin ?></td>
                    </tr>
                    <tr>
                        <td valign="top">Alamat</td>
                        <td valign="top">:</td>
                        <td valign="top"><?= $params->pasien->alamat ?></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <table class="table-judul" style="background-color: #909090;">
        <tr>
            <th style="padding: 8px;">ASESMEN AWAL MEDIS GIGI DAN MULUT GAWAT DARURAT</th>
        </tr>
    </table>


    <div class="table-data" style="border-top: 0px;">
        <table class="table-time">
            <tr>
                <td width="50%" valign="top">Tanggal : <?= $params->pasien->tanggal_masuk_indo ?></td>
                <td width="50%" valign="top">Jam : <?= $params->pasien->jam_masuk ?></td>
            </tr>
        </table>
    </div>

    <div class="table-data" style="border-top: 0px;">
        <table border="0">
            <tr>
                <td width="15%" valign="top">Sumber data</td>
                <td width="2%" valign="top">:</td>
                <td width="20%" valign="top">
                    <span>
                        <input type="checkbox"
                            <?= $params->sumber_data->sumber === 'Autoanamnesis' ? 'checked' : '' ?>>
                        Autoanamnesis
                    </span>
                </td>
                <td width="63%" valign="top">
                    <span>
                        <input type="checkbox"
                            <?= $params->sumber_data->sumber === 'Alloanamnesis' ? 'checked' : '' ?>>
                        Alloanamnesis
                    </span>
                    <span>, dengan : <?= $params->sumber_data->dengan ?></span>
                    <span>, hubungan dengan pasien : <?= $params->sumber_data->hubungan ?></span>
                </td>
            </tr>
            <tr>
                <td valign="top">Riwayat Alergi</td>
                <td valign="top">:</td>
                <td valign="top">
                    <span>
                        <input type="checkbox"
                            <?= $params->riwayat_alergi->riwayat === 'Tidak' ? 'checked' : '' ?>>
                        Tidak
                    </span>
                </td>
                <td valign="top">
                    <span>
                        <input type="checkbox"
                            <?= $params->riwayat_alergi->riwayat === 'Ya' ? 'checked' : '' ?>>
                        Ya
                    </span>
                    <span>, Sebutkan : <?= $params->riwayat_alergi->riwayat_text ?></span>
                </td>
            </tr>
            <tr>
                <td valign="top">Hamil</td>
                <td valign="top">:</td>
                <td valign="top">
                    <span>
                        <input type="checkbox"
                            <?= $params->hamil->hamil === 'Tidak' ? 'checked' : '' ?>>
                        Tidak
                    </span>
                </td>
                <td valign="top">
                    <span>
                        <input type="checkbox"
                            <?= $params->hamil->hamil === 'Ya' ? 'checked' : '' ?>>
                        Ya
                    </span>
                    <span>, Umur kehamilan : <?= $params->hamil->umur ?> Minggu</span>
                    <span>, G : <?= $params->hamil->g ?></span>
                    <span>, P : <?= $params->hamil->p ?></span>
                    <span>, A : <?= $params->hamil->a ?></span>
                </td>
            </tr>
        </table>
    </div>

    <div class="table-data" style="border-top: 0px;">
        <!-- Nomor 1-5 -->
        <table border="0">
            <tr>
                <td width="32%" valign="top" class="lable-bold">
                    <b>1. KELUHAN UTAMA</b>
                </td>
                <td width="2%" valign="top">:</td>
                <td width="66%" valign="top">
                    <?= $params->vital_sign->keluhan_utama ?>
                </td>
            </tr>

            <tr>
                <td valign="top" class="lable-bold">
                    <b>2. RIWAYAT PENYAKIT SEKARANG</b>
                </td>
                <td valign="top">:</td>
                <td valign="top">
                    <?= $params->vital_sign->anamnesis ?>
                </td>
            </tr>



            <tr>
                <td valign="top" class="lable-bold">
                    <b>3. RIWAYAT PENYAKIT DAHULU</b>
                </td>
                <td valign="top">:</td>
                <td valign="top">
                    <?= $params->vital_sign->anamnesis_lalu ?>
                </td>
            </tr>

            <tr>
                <td valign="top" class="lable-bold">
                    <b>4. RIWAYAT PENGGUNAAN OBAT</b>
                </td>
                <td valign="top">:</td>
                <td valign="top">
                    <?php
                    $check_resep_obat = false;
                    $index_resep_obat = 1;

                    // 1. Tampilkan dari resep_freetext jika ada
                    if (!empty($params->resep_freetext) && trim($params->resep_freetext) !== '') {

                        // Pecah berdasarkan baris baru
                        $items = explode("\n", $params->resep_freetext);

                        foreach ($items as $item) {
                            $trimmed_item = trim($item);

                            if ($trimmed_item !== '') {

                                // Bersihkan nomor urut lama jika ada
                                $cleaned_item = preg_replace('/^\d+\.\s*/', '', $trimmed_item);

                                echo '<div style="margin-bottom:1px;">'
                                    . $index_resep_obat++ . '. '
                                    . htmlspecialchars($cleaned_item, ENT_QUOTES, 'UTF-8')
                                    . '</div>';
                            }
                        }

                        $check_resep_obat = true;
                    }

                    // Jika tidak ada data resep & obat
                    if (!$check_resep_obat) {
                        echo '-';
                    }
                    ?>
                </td>
            </tr>
        </table>

        <!--Nomor 6-->
        <div class="lable-bold"><b>5. PEMERIKSAAN FISIK</b></div>
        <table class="poin">
            <tr>
                <td valign="top" width="3%"><b>A.</b></td>
                <td valign="top" width="15%"><b>Keadaan Umum</b></td>
                <td valign="top" width="2%">:</td>
                <td valign="top" width="80%">
                    <span style="margin-right: 10px;">
                        <input type="checkbox"
                            <?= $params->vital_sign->keadaan_umum === 'Baik' ? 'checked' : '' ?>>
                        Baik
                    </span>
                    <span style="margin-right: 10px;">
                        <input type="checkbox"
                            <?= $params->vital_sign->keadaan_umum === 'Sedang' ? 'checked' : '' ?>>
                        Sedang
                    </span>
                    <span>
                        <input type="checkbox"
                            <?= $params->vital_sign->keadaan_umum === 'Lemah' ? 'checked' : '' ?>>
                        Lemah
                    </span>
                </td>
            </tr>
            <tr>
                <td valign="top"></td>
                <td valign="top">Kesadaran</td>
                <td valign="top">:</td>
                <td valign="top">
                    GCS : E <?= $params->vital_sign->gcs_e ?> V <?= $params->vital_sign->gcs_v ?> M <?= $params->vital_sign->gcs_m ?>
                    <br />
                    <span style="margin-right: 10px;">
                        <input type="checkbox"
                            <?= $params->kesadaran === 'Composmentis' ? 'checked' : '' ?>>
                        Composmentis
                    </span>
                    <span style="margin-right: 10px;">
                        <input type="checkbox"
                            <?= $params->kesadaran === 'Somnolen' ? 'checked' : '' ?>>
                        Somnolen
                    </span>
                    <span style="margin-right: 10px;">
                        <input type="checkbox"
                            <?= $params->kesadaran === 'Soporo Komatus' ? 'checked' : '' ?>>
                        Soporo Komatus
                    </span>
                    <span style="margin-right: 10px;">
                        <input type="checkbox"
                            <?= $params->kesadaran === 'Koma' ? 'checked' : '' ?>>
                        Koma
                    </span>
                </td>
            </tr>
            <tr>
                <td valign="top"></td>
                <td valign="top">Tanda Vital</td>
                <td valign="top">:</td>
                <td valign="top">
                    <span style="margin-right: 10px">
                        TD : <?= $params->vital_sign->tensi_sistole ?>/<?= $params->vital_sign->tensi_diastole ?> mmHg;
                    </span>
                    <span style="margin-right: 10px">
                        N : <?= $params->vital_sign->nadi ?> x/m;
                    </span>
                    <span style="margin-right: 10px">
                        T : <?= $params->vital_sign->suhu ?> °C;
                    </span>
                    <span style="margin-right: 10px">
                        RR : <?= $params->vital_sign->nafas ?> x/m;
                    </span>
                    <span style="margin-right: 10px">
                        SpO2 : <?= $params->vital_sign->spo2 ?> %;
                    </span>
                </td>
            </tr>
        </table>

        <table class="poin">
            <tr>
                <td valign="top" width="3%"><b>B.</b></td>
                <td valign="top" width="15%"><b>Status General</b></td>
                <td valign="top" width="2%">:</td>
                <td valign="top" width="80%"></td>
            </tr>
        </table>
        <table class="poin-fisik-table table-bordered">
            <tr>
                <td width="50%" valign="top">
                    <table border="0" class="table-borderless">
                        <tr>
                            <td valign="top" width="5%">1)</td>
                            <td valign="top" width="23%">Kepala</td>
                            <td valign="top" width="2%">:</td>
                            <td valign="top" width="70%">
                                <span>
                                    <input type="checkbox"
                                        <?= $params->status_general->kepala === 'dbn' ? 'checked' : '' ?>>
                                    dbn;
                                </span>
                                &nbsp;
                                <span>
                                    <input type="checkbox"
                                        <?= $params->status_general->kepala === 'Tidak' ? 'checked' : '' ?>>
                                    <?= $params->status_general->kepala_text ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td valign="top"></td>
                            <td valign="top">Mata</td>
                            <td valign="top">:</td>
                            <td valign="top">
                                <span>
                                    <input type="checkbox"
                                        <?= $params->status_general->mata === 'dbn' ? 'checked' : '' ?>>
                                    dbn;
                                </span>
                                &nbsp;
                                <span>
                                    <input type="checkbox"
                                        <?= $params->status_general->mata === 'Tidak' ? 'checked' : '' ?>>
                                    <?= $params->status_general->mata_text ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td valign="top"></td>
                            <td valign="top">Telinga</td>
                            <td valign="top">:</td>
                            <td valign="top">
                                <span>
                                    <input type="checkbox"
                                        <?= $params->status_general->telinga === 'dbn' ? 'checked' : '' ?>>
                                    dbn;
                                </span>
                                &nbsp;
                                <span>
                                    <input type="checkbox"
                                        <?= $params->status_general->telinga === 'Tidak' ? 'checked' : '' ?>>
                                    <?= $params->status_general->telinga_text ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td valign="top"></td>
                            <td valign="top">Hidung</td>
                            <td valign="top">:</td>
                            <td valign="top">
                                <span>
                                    <input type="checkbox"
                                        <?= $params->status_general->hidung === 'dbn' ? 'checked' : '' ?>>
                                    dbn;
                                </span>
                                &nbsp;
                                <span>
                                    <input type="checkbox"
                                        <?= $params->status_general->hidung === 'Tidak' ? 'checked' : '' ?>>
                                    <?= $params->status_general->hidung_text ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td valign="top"></td>
                            <td valign="top">Mulut</td>
                            <td valign="top">:</td>
                            <td valign="top">
                                <span>
                                    <input type="checkbox"
                                        <?= $params->status_general->mulut === 'dbn' ? 'checked' : '' ?>>
                                    dbn;
                                </span>
                                &nbsp;
                                <span>
                                    <input type="checkbox"
                                        <?= $params->status_general->mulut === 'Tidak' ? 'checked' : '' ?>>
                                    <?= $params->status_general->mulut_text ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td valign="top"></td>
                            <td valign="top">Gigi</td>
                            <td valign="top">:</td>
                            <td valign="top">
                                <span>
                                    <input type="checkbox"
                                        <?= $params->status_general->gigi === 'dbn' ? 'checked' : '' ?>>
                                    dbn;
                                </span>
                                &nbsp;
                                <span>
                                    <input type="checkbox"
                                        <?= $params->status_general->gigi === 'Tidak' ? 'checked' : '' ?>>
                                    <?= $params->status_general->gigi_text ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td valign="top">2)</td>
                            <td valign="top">Leher</td>
                            <td valign="top">:</td>
                            <td valign="top">
                                <span>
                                    <input type="checkbox"
                                        <?= $params->status_general->leher === 'dbn' ? 'checked' : '' ?>>
                                    dbn;
                                </span>
                                &nbsp;
                                <span>
                                    <input type="checkbox"
                                        <?= $params->status_general->leher === 'Tidak' ? 'checked' : '' ?>>
                                    <?= $params->status_general->leher_text ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td valign="top">3)</td>
                            <td valign="top">Thorax</td>
                            <td valign="top">:</td>
                            <td valign="top">
                                <span>
                                    <input type="checkbox"
                                        <?= $params->status_general->thorax === 'dbn' ? 'checked' : '' ?>>
                                    dbn;
                                </span>
                                &nbsp;
                                <span>
                                    <input type="checkbox"
                                        <?= $params->status_general->thorax === 'Tidak' ? 'checked' : '' ?>>
                                    <?= $params->status_general->thorax_text ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td valign="top"></td>
                            <td valign="top">Jantung</td>
                            <td valign="top">:</td>
                            <td valign="top">
                                <span>
                                    <input type="checkbox"
                                        <?= $params->status_general->jantung === 'dbn' ? 'checked' : '' ?>>
                                    dbn;
                                </span>
                                &nbsp;
                                <span>
                                    <input type="checkbox"
                                        <?= $params->status_general->jantung === 'Tidak' ? 'checked' : '' ?>>
                                    <?= $params->status_general->jantung_text ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td valign="top"></td>
                            <td valign="top">Paru</td>
                            <td valign="top">:</td>
                            <td valign="top">
                                <span>
                                    <input type="checkbox"
                                        <?= $params->status_general->paru === 'dbn' ? 'checked' : '' ?>>
                                    dbn;
                                </span>
                                &nbsp;
                                <span>
                                    <input type="checkbox"
                                        <?= $params->status_general->paru === 'Tidak' ? 'checked' : '' ?>>
                                    <?= $params->status_general->paru_text ?>
                                </span>
                            </td>
                        </tr>
                    </table>
                </td>
                <td width="50%" valign="top">
                    <table border="0" class="table-borderless">
                        <tr>
                            <td valign="top" width="5%">4)</td>
                            <td valign="top" width="30%">Abdomen</td>
                            <td valign="top" width="2%">:</td>
                            <td valign="top" width="64%">
                                <span>
                                    <input type="checkbox"
                                        <?= $params->status_general->abdomen === 'dbn' ? 'checked' : '' ?>>
                                    dbn;
                                </span>
                                &nbsp;
                                <span>
                                    <input type="checkbox"
                                        <?= $params->status_general->abdomen === 'Tidak' ? 'checked' : '' ?>>
                                    <?= $params->status_general->abdomen_text ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td valign="top"></td>
                            <td valign="top">Hepar</td>
                            <td valign="top">:</td>
                            <td valign="top">
                                <span>
                                    <input type="checkbox"
                                        <?= $params->status_general->hepar === 'dbn' ? 'checked' : '' ?>>
                                    dbn;
                                </span>
                                &nbsp;
                                <span>
                                    <input type="checkbox"
                                        <?= $params->status_general->hepar === 'Tidak' ? 'checked' : '' ?>>
                                    <?= $params->status_general->hepar_text ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td valign="top"></td>
                            <td valign="top">Lien</td>
                            <td valign="top">:</td>
                            <td valign="top">
                                <span>
                                    <input type="checkbox"
                                        <?= $params->status_general->lien === 'dbn' ? 'checked' : '' ?>>
                                    dbn;
                                </span>
                                &nbsp;
                                <span>
                                    <input type="checkbox"
                                        <?= $params->status_general->lien === 'Tidak' ? 'checked' : '' ?>>
                                    <?= $params->status_general->lien_text ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td valign="top"></td>
                            <td valign="top">Ginjal</td>
                            <td valign="top">:</td>
                            <td valign="top">
                                <span>
                                    <input type="checkbox"
                                        <?= $params->status_general->ginjal === 'dbn' ? 'checked' : '' ?>>
                                    dbn;
                                </span>
                                &nbsp;
                                <span>
                                    <input type="checkbox"
                                        <?= $params->status_general->ginjal === 'Tidak' ? 'checked' : '' ?>>
                                    <?= $params->status_general->ginjal_text ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td valign="top"></td>
                            <td valign="top">Genitalia</td>
                            <td valign="top">:</td>
                            <td valign="top">
                                <span>
                                    <input type="checkbox"
                                        <?= $params->status_general->genitalia === 'dbn' ? 'checked' : '' ?>>
                                    dbn;
                                </span>
                                &nbsp;
                                <span>
                                    <input type="checkbox"
                                        <?= $params->status_general->genitalia === 'Tidak' ? 'checked' : '' ?>>
                                    <?= $params->status_general->genitalia_text ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td valign="top">5)</td>
                            <td valign="top">Extremitas atas</td>
                            <td valign="top">:</td>
                            <td valign="top">
                                <span>
                                    <input type="checkbox"
                                        <?= $params->status_general->atas === 'dbn' ? 'checked' : '' ?>>
                                    dbn;
                                </span>
                                &nbsp;
                                <span>
                                    <input type="checkbox"
                                        <?= $params->status_general->atas === 'Tidak' ? 'checked' : '' ?>>
                                    <?= $params->status_general->atas_text ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td valign="top"></td>
                            <td valign="top">Extremitas bawah</td>
                            <td valign="top">:</td>
                            <td valign="top">
                                <span>
                                    <input type="checkbox"
                                        <?= $params->status_general->bawah === 'dbn' ? 'checked' : '' ?>>
                                    dbn;
                                </span>
                                &nbsp;
                                <span>
                                    <input type="checkbox"
                                        <?= $params->status_general->bawah === 'Tidak' ? 'checked' : '' ?>>
                                    <?= $params->status_general->bawah_text ?>
                                </span>
                            </td>
                        </tr>
                    </table>
                    <table border="0" class="table-borderless">
                        <tr>
                            <td width="50%" align="center">
                                <span>Akral Hangat</span>
                                <br />
                                <div style="width: 100px; height: 50px; margin: 0 auto; 
                                            background-image: url('<?= $base_url; ?>/images/OD.png'); 
                                            background-size: 100px 50px; 
                                            background-repeat: no-repeat; 
                                            background-position: center top;">

                                    <?php if (!empty($params->image_canvas->canvas1->stroke)): ?>
                                        <img src="<?= $params->image_canvas->canvas1->stroke ?>"
                                            style="width: 100px; height: 50px; display: block; margin: 0; padding: 0;">
                                    <?php endif; ?>
                                </div>
                            </td>
                            <td width="50%" align="center">
                                <span>Oedema</span>
                                <br />
                                <div style="width: 100px; height: 50px; margin: 0 auto; 
                                            background-image: url('<?= $base_url; ?>/images/OD.png'); 
                                            background-size: 100px 50px; 
                                            background-repeat: no-repeat; 
                                            background-position: center top;">

                                    <?php if (!empty($params->image_canvas->canvas2->stroke)): ?>
                                        <img src="<?= $params->image_canvas->canvas2->stroke ?>"
                                            style="width: 100px; height: 50px; display: block; margin: 0; padding: 0;">
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <br />

        <table class="poin">
            <tr>
                <td valign="top" width="3%"><b>C.</b></td>
                <td valign="top" width="97%"><b>Pemeriksaan Gigi dan Mulut :</b></td>
            </tr>
        </table>
        <table class="poin-fisik-table" style="border: 1px solid #000;page-break-inside: avoid;break-inside: avoid;">
            <tr>
                <td valign="top" width="3%">1)</td>
                <td valign="top" width="11%">Ekstra Oral</td>
                <td valign="top" width="2%">:</td>
                <td valign="top" width="15%"></td>
                <td valign="top" width="69%"></td>
            </tr>
            <tr>
                <td valign="top" colspan="5">
                    <div style="width: 500px; height: 150px; margin: 0 auto; 
                                background-image: url('<?= $base_url; ?>/images/wajah.png'); 
                                background-size: 500px 150px; 
                                background-repeat: no-repeat; 
                                background-position: center top;">

                        <?php if (!empty($params->image_canvas->canvas3->stroke)): ?>
                            <img src="<?= $params->image_canvas->canvas3->stroke ?>"
                                style="width: 500px; height: 150px; display: block; margin: 0; padding: 0;">
                        <?php endif; ?>
                    </div>
                </td>
            </tr>
            <tr>
                <td valign="top"></td>
                <td valign="top">Wajah</td>
                <td valign="top">:</td>
                <td valign="top">
                    <span>
                        <input type="checkbox"
                            <?= $params->ekstra->wajah === 'Simetris' ? 'checked' : '' ?>>
                        Simetris
                    </span>
                </td>
                <td valign="top">
                    <span>
                        <input type="checkbox"
                            <?= $params->ekstra->wajah === 'Asimetris' ? 'checked' : '' ?>>
                        Asimetris
                    </span>
                </td>
            </tr>
            <tr>
                <td valign="top"></td>
                <td valign="top">Bibir</td>
                <td valign="top">:</td>
                <td valign="top">
                    <span>
                        <input type="checkbox"
                            <?= $params->ekstra->bibir === 'dbn' ? 'checked' : '' ?>>
                        dbn;
                    </span>
                </td>
                <td valign="top">
                    <span>
                        <input type="checkbox"
                            <?= $params->ekstra->bibir === 'Tidak' ? 'checked' : '' ?>>
                        <?= $params->ekstra->bibir_text ?>
                    </span>
                </td>
            </tr>
            <tr>
                <td valign="top"></td>
                <td valign="top">KGB</td>
                <td valign="top">:</td>
                <td valign="top">
                    <span>
                        <input type="checkbox"
                            <?= $params->ekstra->kgb === 'dbn' ? 'checked' : '' ?>>
                        dbn;
                    </span>
                </td>
                <td valign="top">
                    <span>
                        <input type="checkbox"
                            <?= $params->ekstra->kgb === 'Tidak' ? 'checked' : '' ?>>
                        <?= $params->ekstra->kgb_text ?>
                    </span>
                </td>
            </tr>
            <tr>
                <td valign="top"></td>
                <td valign="top">Saliva Glands</td>
                <td valign="top">:</td>
                <td valign="top">
                    <span>
                        <input type="checkbox"
                            <?= $params->ekstra->salvia === 'dbn' ? 'checked' : '' ?>>
                        dbn;
                    </span>
                </td>
                <td valign="top">
                    <span>
                        <input type="checkbox"
                            <?= $params->ekstra->salvia === 'Tidak' ? 'checked' : '' ?>>
                        <?= $params->ekstra->salvia_text ?>
                    </span>
                </td>
            </tr>
        </table>

        <br />

        <table class="poin">
            <tr>
                <td valign="top" width="3%"><b>D.</b></td>
                <td valign="top" width="97%"><b>Pemeriksaan Gigi dan Mulut :</b></td>
            </tr>
        </table>
        <table class="poin-fisik-table" style="border: 1px solid #000;">
            <tr>
                <td valign="top" width="3%">2)</td>
                <td valign="top" width="11%">Intra Oral</td>
                <td valign="top" width="2%">:</td>
                <td valign="top" width="84%"></td>
            </tr>
            <tr>

                <td valign="top" colspan="4">
                    <img
                        src="<?= $base_url; ?>/images/keterangan_odontogram_1.png"
                        style="width:100%; height:auto; object-fit:contain;">
                </td>
            </tr>
            <tr>

                <td valign="top" colspan="4">
                    <img
                        src="<?= $base_url; ?>/images/keterangan_odontogram_3.png"
                        style="width:100%; height:auto; object-fit:contain;">
                    <img
                        src="<?= $base_url; ?>/images/keterangan_odontogram_2.png"
                        style="width:100%; height:auto; object-fit:contain;">
                    <hr />
                    <?php if (!empty($params->odontogram_stroke)) : ?>
                        <img
                            src="<?= $params->odontogram_stroke ?? "" ?>"
                            style="width:100%; height:auto; object-fit:contain; padding-left:10px">
                    <?php endif; ?>
                </td>
            </tr>
            <tr>
                <td valign="top" colspan="4">
                    <b>Keterangan :</b>
                    <br />
                    <p><?= nl2br(htmlspecialchars($params->odontogram_keterangan_freetext ?? '')) ?></p>
                </td>
            </tr>
            <tr>
                <td valign="top"></td>
                <td valign="top">Oklusi</td>
                <td valign="top">:</td>
                <td valign="top">
                    <?= pilihanCoret($params->oklusi ?? '', 'Normal bite') ?> /
                    <?= pilihanCoret($params->oklusi ?? '', 'Cross bite') ?> /
                    <?= pilihanCoret($params->oklusi ?? '', 'Steep bite') ?>
                </td>
            </tr>
            <tr>
                <td valign="top"></td>
                <td valign="top">Torus Palatinus</td>
                <td valign="top">:</td>
                <td valign="top">
                    <?= pilihanCoret($params->palatinus ?? '', 'Tidak Ada') ?> /
                    <?= pilihanCoret($params->palatinus ?? '', 'Kecil') ?> /
                    <?= pilihanCoret($params->palatinus ?? '', 'Sedang') ?> /
                    <?= pilihanCoret($params->palatinus ?? '', 'Besar') ?> /
                    <?= pilihanCoret($params->palatinus ?? '', 'Multiple') ?>
                </td>
            </tr>
            <tr>
                <td valign="top"></td>
                <td valign="top">Torus Mandibula</td>
                <td valign="top">:</td>
                <td valign="top">
                    <?= pilihanCoret($params->mandibula ?? '', 'Tidak Ada') ?> /
                    <?= pilihanCoret($params->mandibula ?? '', 'Kecil') ?> /
                    <?= pilihanCoret($params->mandibula ?? '', 'Sedang') ?> /
                    <?= pilihanCoret($params->mandibula ?? '', 'Besar') ?> /
                    <?= pilihanCoret($params->mandibula ?? '', 'Multiple') ?>
                </td>
            </tr>
            <tr>
                <td valign="top"></td>
                <td valign="top">Palatum</td>
                <td valign="top">:</td>
                <td valign="top">
                    <?= pilihanCoret($params->palatum ?? '', 'Dalam') ?> /
                    <?= pilihanCoret($params->palatum ?? '', 'Sedang') ?> /
                    <?= pilihanCoret($params->palatum ?? '', 'Rendah') ?>
                </td>
            </tr>
            <tr>
                <td valign="top"></td>
                <td valign="top">Diastema</td>
                <td valign="top">:</td>
                <td valign="top">
                    <?= pilihanCoret($params->diastema ?? '', 'Tidak ada') ?> /
                    <?= pilihanCoret($params->diastema ?? '', 'Ada') ?>
                    <?= $params->diastema === 'Ada' ? ' : ' . $params->diastema_text : '' ?>
                </td>
            </tr>
            <tr>
                <td valign="top"></td>
                <td valign="top">Gigi Anomali</td>
                <td valign="top">:</td>
                <td valign="top">
                    <?= pilihanCoret($params->gigi_anomali ?? '', 'Tidak ada') ?> /
                    <?= pilihanCoret($params->gigi_anomali ?? '', 'Ada') ?>
                    <?= $params->gigi_anomali === 'Ada' ? ' : ' . $params->gigi_anomali_text : '' ?>
                </td>
            </tr>
            <tr>
                <td valign="top"></td>
                <td valign="top">Lain-lain</td>
                <td valign="top">:</td>
                <td valign="top">
                    <?= $params->lain_lain ?>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <table border="0">
                        <tr>
                            <td width="50%" valign="top">
                                <div style="width: 400px; height: 250px; margin: 0 auto; 
                                            background-image: url('<?= $base_url; ?>/images/mulut.jpeg'); 
                                            background-size: 400px 250px; 
                                            background-repeat: no-repeat; 
                                            background-position: center top;">

                                    <?php if (!empty($params->image_canvas->canvas4->stroke)): ?>
                                        <img src="<?= $params->image_canvas->canvas4->stroke ?>"
                                            style="width: 400px; height: 250px; display: block; margin: 0; padding: 0;">
                                    <?php endif; ?>
                                </div>
                            </td>
                            <td width="50%" valign="top">
                                <span>Deskripsi lesi / kelainan yang ditemukan:</span>
                                <br />
                                <?= $params->deskripsi_lesi ?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <br />

        <!--Nomor 7-->
        <div class="lable-bold"><b>6. HASIL PEMERIKSAAN PENUNJANG :</b></div>
        <table class="poin">
            <tr>
                <td valign="top" width="3%">a)</td>
                <td valign="top" width="15%">Laboratorium</td>
                <td valign="top" width="2%">:</td>
                <td valign="top" width="80%">
                    <?php if (!empty($params->laboratorium_freetext)): ?>
                        <div>
                            <?php
                            $labText = $params->laboratorium_freetext;
                            $labLines = explode("\n", $labText);

                            // Format khusus untuk data laboratorium
                            foreach ($labLines as $line) {
                                $trimmedLine = trim($line);
                                if (!empty($trimmedLine)) {
                                    // Tampilkan judul pemeriksaan tanpa penomoran
                                    // Hanya beri penomoran untuk item hasil laboratorium
                                    if (preg_match('/^\d+\./', $trimmedLine)) {
                                        // Ini adalah item hasil laboratorium (sudah ada penomoran)
                                        echo htmlspecialchars($trimmedLine) . "<br>";
                                    } else {
                                        // Ini adalah judul pemeriksaan (tidak ada penomoran)
                                        echo '<strong>' . htmlspecialchars($trimmedLine) . '</strong><br>';
                                    }
                                }
                            }
                            ?>
                        </div>
                    <?php else: ?>
                        <p></p>
                    <?php endif; ?>
                </td>
            </tr>
            <tr>
                <td valign="top">b)</td>
                <td valign="top">Radiologi</td>
                <td valign="top">:</td>
                <td valign="top">
                    <?php if (!empty($params->radiologi_freetext)): ?>
                        <div>
                            <?php
                            $radText = $params->radiologi_freetext;
                            $radLines = explode("\n", $radText);

                            // Format khusus untuk data radiologi
                            foreach ($radLines as $line) {
                                $trimmedLine = trim($line);
                                if (!empty($trimmedLine)) {
                                    // Jika baris diawali dengan "Hasil :", ini adalah lanjutan dari judul
                                    if (strpos($trimmedLine, 'Hasil :') === 0) {
                                        echo htmlspecialchars($trimmedLine) . "<br><br>";
                                    } else {
                                        // Ini adalah judul pemeriksaan
                                        echo '<strong>' . htmlspecialchars($trimmedLine) . '</strong><br>';
                                    }
                                }
                            }
                            ?>
                        </div>
                    <?php else: ?>
                        <p></p>
                    <?php endif; ?>
                </td>
            </tr>
            <tr>
                <td valign="top">d)</td>
                <td valign="top">EKG</td>
                <td valign="top">:</td>
                <td valign="top">
                    <?= $params->pemeriksaan_ekg ?>
                </td>
            </tr>
            <tr>
                <td valign="top">e)</td>
                <td valign="top">Lain-lain</td>
                <td valign="top">:</td>
                <td valign="top">
                    <?= $params->pemeriksaan_lain ?>
                </td>
            </tr>
        </table>

        <!--Nomor 8-->
        <div class="lable-bold"><b>7. DIAGNOSIS :</b></div>
        <table class="poin">
            <tr>
                <td valign="top" width="15%">Diagnosis Kerja</td>
                <td valign="top" width="2%">:</td>
                <td valign="top" width="83%">
                    <?php
                    $check_diagnosa = false;
                    $index = 1;

                    // Tampilkan dari diagnosa_freetext jika ada
                    if (!empty($params->diagnosa_masuk_freetext)) {
                        // Pecah berdasarkan baris baru
                        $items = explode("\n", $params->diagnosa_masuk_freetext);
                        foreach ($items as $item) {
                            if (trim($item) !== '') {
                                echo '<div style="margin-bottom:1px;">' . trim($item) . '</div>';
                                $index++;
                            }
                        }
                        $check_diagnosa = true;
                    }

                    // Tampilkan dari diagnosa_list_autocomplete jika ada
                    if (!empty($params->diagnosa_masuk_autocomplete) && is_array($params->diagnosa_masuk_autocomplete)) {
                        foreach ($params->diagnosa_masuk_autocomplete as $item) {
                            $diag_text = $item->icd_x . ' - ' . $item->nama_sebab_sakit;
                            if (!empty($item->deskripsi)) {
                                $diag_text .= ' - ' . $item->deskripsi;
                            }
                            echo '<div style="margin-bottom:1px;">' . $index++ . '. ' . $diag_text . '</div>';
                        }
                        $check_diagnosa = true;
                    }

                    // Jika tidak ada data diagnosa
                    if (!$check_diagnosa) {
                        echo '-';
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <td valign="top">Diagnosis Banding</td>
                <td valign="top">:</td>
                <td valign="top">
                    <?php
                    $check_diagnosa = false;
                    $index = 1;

                    // Tampilkan dari diagnosa_freetext jika ada
                    if (!empty($params->diagnosa_banding_freetext)) {
                        // Pecah berdasarkan baris baru
                        $items = explode("\n", $params->diagnosa_banding_freetext);
                        foreach ($items as $item) {
                            if (trim($item) !== '') {
                                echo '<div style="margin-bottom:1px;">' . trim($item) . '</div>';
                                $index++;
                            }
                        }
                        $check_diagnosa = true;
                    }

                    // Tampilkan dari diagnosa_list_autocomplete jika ada
                    if (!empty($params->diagnosa_banding_autocomplete) && is_array($params->diagnosa_banding_autocomplete)) {
                        foreach ($params->diagnosa_banding_autocomplete as $item) {
                            $diag_text = $item->icd_x . ' - ' . $item->nama_sebab_sakit;
                            if (!empty($item->deskripsi)) {
                                $diag_text .= ' - ' . $item->deskripsi;
                            }
                            echo '<div style="margin-bottom:1px;">' . $index++ . '. ' . $diag_text . '</div>';
                        }
                        $check_diagnosa = true;
                    }

                    // Jika tidak ada data diagnosa
                    if (!$check_diagnosa) {
                        echo '-';
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <td valign="top">Diagnosis Tambahan / Sekunder</td>
                <td valign="top">:</td>
                <td valign="top">
                    <?php
                    $check_diagnosa = false;
                    $index = 1;

                    // Tampilkan dari diagnosa_freetext jika ada
                    if (!empty($params->diagnosa_freetext)) {
                        // Pecah berdasarkan baris baru
                        $items = explode("\n", $params->diagnosa_freetext);
                        foreach ($items as $item) {
                            if (trim($item) !== '') {
                                echo '<div style="margin-bottom:1px;">' . trim($item) . '</div>';
                                $index++;
                            }
                        }
                        $check_diagnosa = true;
                    }

                    // Tampilkan dari diagnosa_list_autocomplete jika ada
                    if (!empty($params->diagnosa_list_autocomplete) && is_array($params->diagnosa_list_autocomplete)) {
                        foreach ($params->diagnosa_list_autocomplete as $item) {
                            $diag_text = $item->icd_x . ' - ' . $item->nama_sebab_sakit;
                            if (!empty($item->deskripsi)) {
                                $diag_text .= ' - ' . $item->deskripsi;
                            }
                            echo '<div style="margin-bottom:1px;">' . $index++ . '. ' . $diag_text . '</div>';
                        }
                        $check_diagnosa = true;
                    }

                    // Jika tidak ada data diagnosa
                    if (!$check_diagnosa) {
                        echo '-';
                    }
                    ?>
                </td>
            </tr>
        </table>

        <div class="lable-bold"><b>8. MASALAH MEDIS :</b></div>
        <table class="poin">
            <tr>
                <td width="100%">
                    <?= $params->masalah_medis ?>
                </td>
            </tr>
        </table>

        <div class="lable-bold"><b>9. MASALAH KEPERAWATAN :</b></div>
        <table class="poin">
            <tr>
                <td width="100%">
                    <?= $params->masalah_rawat ?>
                </td>
            </tr>
        </table>

        <div class="lable-bold"><b>10. SASARAN / TARGET TERAPI :</b></div>
        <table class="poin">
            <tr>
                <td width="100%">
                    <?= $params->target_terapi ?>
                </td>
            </tr>
        </table>

        <div class="lable-bold"><b>11. RENCANA ASUHAN / TERAPI / STANDING ORDER :</b></div>
        <table class="poin">
            <tr>
                <td width="100%">
                    <?php echo nl2br($params->tindakan_group ?? ""); ?>
                </td>
            </tr>
        </table>

        <div class="lable-bold"><b>12. RENCANA PEMULANGAN DAN TINDAK LANJUT PERAWATAN PASIEN :</b></div>
        <table class="poin-fisik-table table-bordered">
            <tr>
                <td width="33.33%" valign="top">
                    <span>
                        <input type="checkbox"
                            <?= $params->rencana_pulang->rajal === 'Rawat Jalan' ? 'checked' : '' ?>>
                        Rawat Jalan
                    </span>
                    <br />
                    <span>
                        <input type="checkbox"
                            <?= $params->rencana_pulang->aps === 'APS' ? 'checked' : '' ?>>
                        APS
                    </span>
                    <br />
                    <span>
                        <input type="checkbox"
                            <?= $params->rencana_pulang->observasi === 'Observasi' ? 'checked' : '' ?>>
                        Observasi
                    </span>
                    <br />
                    <span>
                        <input type="checkbox"
                            <?= $params->rencana_pulang->ranap === 'Rawat Inap' ? 'checked' : '' ?>>
                        Rawat Inap
                    </span>
                    <br />
                    <span>
                        <input type="checkbox"
                            <?= $params->rencana_pulang->dokter_dpjp === 'DPJP Rawat Inap' ? 'checked' : '' ?>>
                        DPJP Rawat Inap : <?= $params->rencana_pulang->nama_dpjp ?>
                    </span>
                    <br /><br />
                    <span>Rujuk ke :</span>
                    <br />
                    <span>
                        <input type="checkbox"
                            <?= $params->rencana_pulang->rujuk_ke === 'Dokter Spesialis' ? 'checked' : '' ?>>
                        Dokter Spesialis : <?= $params->rencana_pulang->dokter_spesialis_text ?>
                    </span>
                    <br />
                    <span>
                        <input type="checkbox"
                            <?= $params->rencana_pulang->rujuk_ke === 'RS' ? 'checked' : '' ?>>
                        RS : <?= $params->rencana_pulang->rs_text ?>
                    </span>
                    <br />
                    <span>
                        <input type="checkbox"
                            <?= $params->rencana_pulang->rujuk_ke === 'Puskesmas' ? 'checked' : '' ?>>
                        Puskesmas : <?= $params->rencana_pulang->puskesmas_text ?>
                    </span>
                    <br />
                    <span>
                        <input type="checkbox"
                            <?= $params->rencana_pulang->ranap === 'Dokter Keluarga' ? 'checked' : '' ?>>
                        Dokter Keluarga
                    </span>
                    <br />
                    <span>
                        <input type="checkbox"
                            <?= $params->rencana_pulang->ranap === 'Homecare' ? 'checked' : '' ?>>
                        Homecare
                    </span>
                </td>
                <td width="33.33%" valign="top">
                    <span>
                        Keluar RS jam: <?= $params->pasien->jam_keluar ?> WIB
                    </span>
                    <br />
                    <span>
                        Ruang : <?= $params->pasien->bangsal ?> - Ruang <?= $params->pasien->ruang ?> - <?= $params->pasien->kelas ?>
                    </span>
                    <br /><br />
                    <span>Atas Dasar :</span>
                    <br />
                    <span>
                        <input type="checkbox"
                            <?= $params->rencana_pulang->atas_dasar === 'Kamar Penuh' ? 'checked' : '' ?>>
                        Kamar Penuh
                    </span>
                    <br />
                    <span>
                        <input type="checkbox"
                            <?= $params->rencana_pulang->atas_dasar === 'Perlu Fasilitas dan SDM' ? 'checked' : '' ?>>
                        Perlu Fasilitas dan SDM
                    </span>
                    <br />
                    <span>
                        <input type="checkbox"
                            <?= $params->rencana_pulang->atas_dasar === 'Permintaan Pasien / Keluarga' ? 'checked' : '' ?>>
                        Permintaan Pasien / Keluarga
                    </span>
                </td>
                <td width="33.33%" valign="top">
                    <span>Indikasi :</span>
                    <br />
                    <span><?= $params->rencana_pulang->indikasi ?></span>
                    <br /><br />
                    <span>Dintar Oleh :</span>
                    <br />
                    <span>
                        <input type="checkbox"
                            <?= $params->rencana_pulang->diantar === 'Ambulance RS' ? 'checked' : '' ?>>
                        Ambulance RS
                    </span>
                    <br />
                    <span>
                        <input type="checkbox"
                            <?= $params->rencana_pulang->diantar === 'Ambulance lain' ? 'checked' : '' ?>>
                        Ambulance lain
                    </span>
                    <br />
                    <span>
                        <input type="checkbox"
                            <?= $params->rencana_pulang->diantar === 'Kendaraan Umum' ? 'checked' : '' ?>>
                        Kendaraan Umum
                    </span>
                    <br />
                    <span>
                        <input type="checkbox"
                            <?= $params->rencana_pulang->diantar === 'Kendaraan Pribadi' ? 'checked' : '' ?>>
                        Kendaraan Pribadi
                    </span>
                </td>
            </tr>
        </table>

        <br />

        <div class="lable-bold"><b>13. KONDISI SAAT KELUAR IGD :</b></div>
        <table class="poin-fisik-table" style="border: 1px solid #000;">
            <tr>
                <td width="15%" valign="top">Keadaan umum</td>
                <td width="2%" valign="top">:</td>
                <td width="83%" valign="top"></td>
            </tr>
            <tr>
                <td valign="top">GCS</td>
                <td valign="top">:</td>
                <td valign="top">
                    E <?= $params->vital_sign_pulang->gcs_e ?> V <?= $params->vital_sign_pulang->gcs_v ?> M <?= $params->vital_sign_pulang->gcs_m ?>
                </td>
            </tr>
            <tr>
                <td valign="top">Tanda Vital</td>
                <td valign="top">:</td>
                <td valign="top">
                    <span style="margin-right: 10px">
                        TD : <?= $params->vital_sign_pulang->tensi_sistole ?>/<?= $params->vital_sign_pulang->tensi_diastole ?> mmHg;
                    </span>
                    <span style="margin-right: 10px">
                        N : <?= $params->vital_sign_pulang->nadi ?> x/m;
                    </span>
                    <span style="margin-right: 10px">
                        T : <?= $params->vital_sign_pulang->suhu ?> °C;
                    </span>
                    <span style="margin-right: 10px">
                        RR : <?= $params->vital_sign_pulang->nafas ?> x/m;
                    </span>
                    <span style="margin-right: 10px">
                        SpO2 : <?= $params->vital_sign_pulang->spo2 ?> %;
                    </span>
                </td>
            </tr>
            <tr>
                <td valign="top">Kondisi saat ini</td>
                <td valign="top">:</td>
                <td valign="top">
                    <?= $params->vital_sign_pulang->kondisi ?>
                </td>
            </tr>
            <tr>
                <td valign="top">Instruksi Pulang</td>
                <td valign="top">:</td>
                <td valign="top">
                    <?= $params->vital_sign_pulang->instruksi ?>
                </td>
            </tr>
        </table>

        <br />

        <div class="lable-bold"><b>14. EDUKASI PASIEN ( Edukasi awal, disampaikan tentang dignosis, rencana dan tujuan terapi ) : :</b></div>
        <table class="poin-fisik-table" style="border: 1px solid #000;">
            <tr>
                <td width="100%">
                    <span>
                        Materi Edukasi :
                        <?= pilihanCoret($params->edukasi->edukasi ?? '', 'Sesuai instruksi pulang') ?> / <?= pilihanCoret($params->edukasi->edukasi ?? '', 'Lainnya') ?>
                        <?= ($params->edukasi->edukasi ?? '') === 'Lainnya' ? '* ' . ($params->edukasi->edukasi_text ?? '') : ''
                        ?>
                    </span>
                    <br /><br />
                    <span>Edukasi Awal, disampaikan Kepada :</span>
                    <br />
                    <span>
                        <input type="checkbox"
                            <?= $params->edukasi->edukasi_awal === 'Pasien' ? 'checked' : '' ?>>
                        Pasien
                    </span>
                    <br />
                    <span>
                        <input type="checkbox"
                            <?= $params->edukasi->edukasi_awal === 'Keluarga Pasien' ? 'checked' : '' ?>>
                        Keluarga Pasien, nama : <?= $params->edukasi->nama ?>, Hubungan dengan pasien : <?= $params->edukasi->hubungan ?>
                    </span>
                    <br />
                    <span>
                        <input type="checkbox"
                            <?= $params->edukasi->edukasi_awal === 'Tidak dapat' ? 'checked' : '' ?>>
                        Tidak dapat memberi edukasi kepada pasien atau keluarga : <?= $params->edukasi->tidak_dapat_text ?>
                    </span>
                </td>
            </tr>
        </table>

        <table style="margin-top: 50px;">
            <tr>
                <td class="w50"></td>
                <td class="w50" align="center" style="padding-top: 20px;" align="end">
                    <?php echo $static_label->hospital_city ?>, <?= $params->ttd_data->tanggal_indo ?> Jam : <?= $params->ttd_data->jam ?> WIB
                </td>
            </tr>
        </table>
        <table style="page-break-inside: avoid;break-inside: avoid;margin-bottom: 30px;">
            <tr>
                <td class="w50" align="center">
                    <label>Dokter</label>
                    <img src="<?= $params->ttd_data->dokter_stroke ?>" class="tanda-tangan" style="display: block;margin-top: 10px">
                    <p style="margin-top: 10px">
                        <?= $params->ttd_data->dokter ?>
                    </p>
                </td>
                <td class="w50" align="center">
                    <label>Pasien / Penerima Penjelasan</label>
                    <img src="<?= $params->ttd_data->pasien_stroke ?>" class="tanda-tangan" style="display: block;margin-top: 10px">
                    <p style="margin-top: 10px">
                        <?= $params->ttd_data->pasien ?>
                    </p>
                </td>
            </tr>
        </table>
    </div>

    <table border="0" style="font-size: 10px; margin-top: 20px;">
        <tr>
            <td align="start">
                <b>*Coret yang tidak perlu</b>
                <br />
                Beri tanda (  ) pada kotak (  ) sesuai pilihan
            </td>
            <td align="end" valign="bottom">
                <b>Revisi 1/VI/2020</b>
            </td>
        </tr>
    </table>

</body>

</html>