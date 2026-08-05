<?php
// EMR Data
$params = json_decode($argv[1]);

$base_url = $argv[2]; // Base_url
$title = "Penjelasan Tindakan Kedokteran";
$static_label = json_decode($argv[3]);
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
</style>

<body>
    <table class="table-borderless">
        <tr>
            <!--start kop-->
            <td width="55%">
                <table class="table-borderless">
                    <tr>
                        <td width="20%"><img id="logo" style="width:100%;" src="<?= $base_url; ?>/images/rs/LogoRS.png"></td>
                        <td width="60%" align="center">
                            <h1 class="text-center" style="margin: 0; font-size: 20pt; font-weight: bold ;"><?php echo $static_label->hospital_name; ?></h1>
                            <p style="font-size:12pt"><?php echo $static_label->hospital_address; ?></p>
                            <!--<p style="font-size:12pt"><?php echo $static_label->hospital_phone; ?></p>-->
                        </td>
                        <td width="20%"><img id="logo" style="width:100%;" src="<?= $base_url; ?>/images/rs/paripurna-kars.png"></td>
                    </tr>
                </table>
            </td>
            <!--end kop-->

            <!--start data pasien-->
            <!-- no rm, nama pasien, jenis kelamin, tanggallahir,alamat, -->
            <td width="45%" valign="top">
                <table class="table-borderless" style="border-collapse: separate; border-spacing: 0;">
                    <tr>
                        <td style="border:2px solid black; border-radius:6px; padding:5px">
                            <table class="table-borderless">
                                <tr>
                                    <td>No. RM</td>
                                    <td width="1%">:</td>
                                    <td><?= $params->pasien->no_rm ?? '' ?></td>
                                </tr>
                                <tr>
                                    <td colspan="3" style="height:4px"></td>
                                </tr>
                                <tr>
                                    <td valign="top">Nama</td>
                                    <td width="1%" valign="top">:</td>
                                    <td valign="top"><?= $params->pasien->nama ?? '' ?></td>
                                </tr>
                                <tr>
                                    <td colspan="3" style="height:4px"></td>
                                </tr>
                                <tr>
                                    <td>Jenis Kelamin</td>
                                    <td width="1%">:</td>
                                    <td><?= $params->pasien->kelamin ?? '' ?></td>
                                </tr>
                                <tr>
                                    <td colspan="3" style="height:4px"></td>
                                </tr>
                                <tr>
                                    <td>Tgl. Lahir</td>
                                    <td width="1%">:</td>
                                    <td><?= $params->pasien->tanggal_lahir_indo ?? '' ?></td>
                                </tr>
                                <tr>
                                    <td colspan="3" style="height:4px"></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
            <!--end data pasien-->
        </tr>
    </table>
    
    <table class="table-borderless">
        <tr>
            <td align="center" style="font-size:20pt; padding-top:20px"><b>PENJELASAN TINDAKAN KEDOKTERAN</b></td>
        </tr>
    </table>
    
    <!--START ISI-->
    <table class="table-bordered">
        <tr>
            <td style="padding:20px">
                <table class="table-borderless">
                    <tr>
                        <td style="text-align:justify; font-size:16pt">
                            <b>Isi </b>: Diagnosa penyakit, perjalanan penyakit, alternatif tindakan/terapi, pilihan tindakan dengan pertimbangannya, tujuan tindakan, komplikasi tindakan yang mungkin dan tatacara penanganannya
                        </td>
                    </tr>
                    <tr>
                        <td style="border-top:3px solid black; height:0px"></td>
                    </tr>
                </table>
                <table class="table-borderless">
                    <!--<tr>-->
                    <!--    <?php-->
                    <!--    $content = trim($params->penjelasan_tindakan);-->
                    <!--    if (empty($content)) {-->
                    <!--        $content = str_repeat('<br>', 30); -->
                    <!--    }else{-->
                    <!--        $spasi = str_repeat('<br>', 4); -->
                    <!--    }-->
                    <!--    ?>-->
                    <!--    <td style="padding-top:10px; padding-bottom:30px; text-align:justify">-->
                    <!--        <?= $content ?>-->
                    <!--        <?= $spasi ?>-->
                    <!--    </td>-->
                    <!--</tr>-->
                    
                    <tr>
                        <td>
                            <div style="text-align:justify; line-height:1.5; page-break-inside:auto; min-height:400px;">
                                <?= !empty($params->penjelasan_tindakan) 
                                       ? nl2br($params->penjelasan_tindakan) 
                                       : str_repeat('<br>', 25) ?>
                            </div>

                        </td>
                    </tr>
                    <tr>
                        <td style="height:10px"></td>
                    </tr>
                </table>
                <table class="table-borderless">
                    <tr>
                        <td width="60%" style="padding-right:30px">
                            <div class="flex-container">
                                <span>Tanggal &nbsp;&nbsp;&nbsp; :</span>
                                <div class="flex-dotted">
                                    <span style="padding-left:3px"><?= $params->ttd_data->tanggal_indo ?? '' ?></span>
                                </div>
                            </div>
                        </td>
                        <td width="40%">
                            <div class="flex-container">
                                <span>Jam &nbsp;&nbsp;&nbsp; :</span>
                                <div class="flex-dotted">
                                    <span style="padding-left:3px"><?= $params->ttd_data->jam ?? '' ?></span>
                                </div>
                                <span>WIB</span>
                            </div>
                        </td>
                    </tr>
                </table>
                <!--TTD-->
                <table class="table-borderless">
                    <tr>
                        <td width="50%" align="center">
                            <p><b>Dokter</b></p>
                            <p><b>Penanggung Jawab Tindakan</b></p>
                            <img src="<?= $params->ttd_data->dokter_stroke ?? '' ?>" style="height: 100px; width: auto; display: block; margin: 10px auto;">
                            <div class="flex-container">
                                <div>(</div>
                                <div class="flex-dotted" style="text-align:center; min-height:27px">
                                    <p style=" margin-top: 5px; width:100%; text-align:center;"><?= $params->ttd_data->dokter ?? '' ?></p>
                                </div>
                                <div>)</div>
                            </div>
                            <span style="font-size:11pt"><i>diisi nama lengkap beserta gelar</i></span>
                        </td>
                        <td width="50%" align="center">
                            <p><b>Mengetahui / Menyetujui</b></p>
                            <p><b>Pasien / Wali</b></p>
                            <img src="<?= $params->ttd_data->pasien_stroke ?? '' ?>" style="height: 100px; width: auto; display: block; margin: 10px auto;">
                            <div class="flex-container">
                                <div>(</div>
                                <div class="flex-dotted" style="text-align:center; min-height:27px">
                                    <p style=" margin-top: 5px; width:100%; text-align:center; "><?= $params->ttd_data->pasien ?? '' ?></p>
                                </div>
                                <div>)</div>
                            </div>
                            <span style="font-size:11pt"><i>diisi nama lengkap beserta gelar</i></span>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <!--END ISI-->
    <table class="table-borderless">
        <tr>
            <td align="right" style="padding-top:12px;"><b>RMK 10 / Rev.0 / 2022</b></td>
        </tr>
    </table>
</body>

</html>












