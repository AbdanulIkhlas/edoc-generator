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
        vertical-align: top;
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
    <div class="main-outer-table" style="page-break-inside: auto; margin-bottom: 20px;">
        <table style="width: 100%;" class="table-borderless">
            <tr style="padding-bottom: 5px; padding-top: 5px;">
                <td width="15%" style="vertical-align: middle; text-align: center;">
                    <img style="width: 70px" src="<?= $base_url; ?>/images/rs/LogoRS.png">
                </td>
                <td width="40%" style="vertical-align: middle;">
                    <h4 style="margin: 0; font-size: 14pt;"><?php echo $static_label->hospital_name ?? ""; ?></h4>
                    <div style="font-size: 10pt; line-height: 1.3; margin-top: 5px;">
                        <?php echo !empty($static_label->hospital_address) ? $static_label->hospital_address . "<br>" : ""; ?>
                        <?php echo !empty($static_label->hospital_phone) ? "Telp. " . $static_label->hospital_phone . "<br>" : ""; ?>
                        <?php echo !empty($static_label->hospital_email) ? "Email: " . $static_label->hospital_email : ""; ?>
                    </div>
                </td>
                <td width="45%" style="vertical-align: middle; padding: 10px; font-size:12pt">
                    <table class="table-bordered" style="width:100%;">
                        <tr>
                            <td width="30%">No RM</td>
                            <td width="5%">:</td>
                            <td><?php echo $params->pasien->no_rm ?? ""; ?></td>
                        </tr>
                        <tr>
                            <td>Nama Pasien</td>
                            <td>:</td>
                            <td><?php echo $params->pasien->nama ?? ""; ?></td>
                        </tr>
                        <tr>
                            <td>Tanggal Lahir</td>
                            <td>:</td>
                            <td><?php echo tgl_indo($params->pasien->tanggal_lahir ?? ""); ?></td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>:</td>
                            <td><?php echo $params->pasien->alamat ?? ""; ?></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <div style="text-align: center; margin-top: 20px; margin-bottom: 20px;">
            <h4 style="font-size: 14pt; font-weight: bold;">PROTOKOL TERAPI<br>RENCANA TINDAKAN REHABILITASI MEDIK</h4>
        </div>

        <table class="table-bordered" style="width: 100%; margin-bottom: 10px;">
            <tr>
                <td style="vertical-align: top;">
                    <table class="table-borderless" style="width: 100%;">
                        <tr>
                            <td width="20%" style="vertical-align: top;">Diagnosa Medis</td>
                            <td width="2%" style="vertical-align: top;">:</td>
                            <td style="vertical-align: top;"><?php echo nl2br($params->diagnosa_freetext ?? ""); ?></td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top;">Fungsional</td>
                            <td style="vertical-align: top;">:</td>
                            <td style="vertical-align: top;"><?php echo $params->fungsional ?? ""; ?></td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top;">Program Tindakan</td>
                            <td style="vertical-align: top;">:</td>
                            <td style="vertical-align: top;">
                                <?php
                                if (!empty($params->program_tindakan)) {
                                    foreach ($params->program_tindakan as $idx => $tindakan) {
                                        echo ($idx + 1) . ". " . $tindakan . "<br>";
                                    }
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top;" colspan="3">
                                <table class="table-borderless">
                                    <tr>
                                        <td width="50%"></td>
                                        <td width="50%" align="center">
                                            <p>Dokter Yang Merawat</p>
                                            <br>
                                            <?php if (!empty($params->ttd_data->dokter_stroke)) { ?>
                                                <img src="<?php echo $params->ttd_data->dokter_stroke; ?>" style="height:100px;width:auto;display:block;">
                                            <?php } else { ?>
                                                <br><br><br><br>
                                            <?php } ?>
                                            ( <?php echo $params->ttd_data->dokter ?? "..................................."; ?> )
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <div style="text-align: right; font-weight: bold; margin-bottom: 5px;">
            Wajib dibawa setiap pasien kontrol
        </div>

        <?php
        $riwayat_terapi = $params->riwayat_terapi ?? [];
        $chunks = array_chunk($riwayat_terapi, 3);

        foreach ($chunks as $chunk) {
            // Calculate max rows and num columns for this chunk
            $max_rows = 0;
            $num_cols = count($chunk);
            
            foreach ($chunk as $item) {
                if (isset($item->tindakan_list) && is_array($item->tindakan_list)) {
                    $count = count($item->tindakan_list);
                    if ($count > $max_rows) {
                        $max_rows = $count;
                    }
                }
            }

            // Render table for this chunk
        ?>
            <table class="table-bordered" style="width: 100%; margin-bottom: 20px; page-break-inside: auto;">
                <tr>
                    <?php
                    // Render headers for up to $num_cols columns
                    for ($i = 0; $i < $num_cols; $i++) {
                        $tanggal = isset($chunk[$i]->tanggal) ? tgl_indo($chunk[$i]->tanggal) : " ";
                    ?>
                        <td colspan="3" style="text-align: left; vertical-align: top;">Tgl : <?php echo $tanggal; ?></td>
                    <?php } ?>
                </tr>
                <tr>
                    <?php for ($i = 0; $i < $num_cols; $i++) { ?>
                        <td rowspan="2" style="text-align: center; vertical-align: top; width: 13%;">Tindakan</td>
                        <td colspan="2" style="text-align: center; vertical-align: top;">Tanda tangan</td>
                    <?php } ?>
                </tr>
                <tr>
                    <?php for ($i = 0; $i < $num_cols; $i++) { ?>
                        <td style="text-align: center; vertical-align: top; width: 10%;">Petugas</td>
                        <td style="text-align: center; vertical-align: top; width: 10%;">Pasien</td>
                    <?php } ?>
                </tr>

                <?php for ($row = 0; $row < $max_rows; $row++) { ?>
                    <tr>
                        <?php
                        for ($col = 0; $col < $num_cols; $col++) {
                            $tindakan_text = "";
                            $petugas_stroke = "";
                            $pasien_stroke = "";

                            if (isset($chunk[$col]->tindakan_list[$row])) {
                                $tindakan_item = $chunk[$col]->tindakan_list[$row];
                                $tindakan_text = $tindakan_item->tindakan ?? "";
                                $petugas_stroke = $tindakan_item->ttd_petugas_stroke ?? "";
                                $pasien_stroke = $tindakan_item->ttd_pasien_stroke ?? "";
                            }
                        ?>
                            <td style="vertical-align: top; height: 30px;"><?php echo $tindakan_text; ?></td>
                            <td style="vertical-align: top; text-align: center;">
                                <?php if (!empty($petugas_stroke)) { ?>
                                    <img src="<?php echo $petugas_stroke; ?>" style="height:40px;width:auto;display:inline-block;">
                                <?php } ?>
                            </td>
                            <td style="vertical-align: top; text-align: center;">
                                <?php if (!empty($pasien_stroke)) { ?>
                                    <img src="<?php echo $pasien_stroke; ?>" style="height:40px;width:auto;display:inline-block;">
                                <?php } ?>
                            </td>
                        <?php } ?>
                    </tr>
                <?php } ?>
            </table>
        <?php } ?>

        <div style="margin-top: 10px; font-size: 11pt;">
            Keterangan:<br>
            <table class="table-borderless" style="width: 100%;">
                <tr>
                    <td style="width: 2%; vertical-align: top;">1.</td>
                    <td style="vertical-align: top;">Protokol terapi asli harus selalu dibawa oleh pasien setiap kali akan di terapi di Rehabilitasi Medik</td>
                </tr>
                <tr>
                    <td style="vertical-align: top;">2.</td>
                    <td style="vertical-align: top;">Serahkan lembar protokol ini pada petugas pada waktu mendaftar</td>
                </tr>
                <tr>
                    <td style="vertical-align: top;">3.</td>
                    <td style="vertical-align: top;">Pelaksanaan terapi sesuai dengan program tindakan yang telah dintentukan oleh dokter yang merawat</td>
                </tr>
            </table>
        </div>
    </div>
</body>

</html>