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
    <table style="width: 100%; border: 1px solid black; margin-bottom: 20px; page-break-inside: auto;" class="table-borderless">
        <tr>
            <td style="vertical-align: top; padding: 10px;">
                <table style="width: 100%;">
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
                        <td class="borderr" width="45%" style="vertical-align: top; font-size:11pt">
                            <table class="table-borderless" style="width:100%; border: 1px solid black; padding: 5px;">
                                <tr>
                                    <td style="width: 34%; padding: 3px 5px; vertical-align: top;">No RM</td>
                                    <td style="width: 2%; padding: 3px 0; vertical-align: top;">:</td>
                                    <td style="width: 68%; padding: 3px 5px; vertical-align: top;"><?php echo $params->pasien->no_rm ?? ""; ?></td>
                                </tr>
                                <tr>
                                    <td style="padding: 3px 5px; vertical-align: top;">Nama Pasien</td>
                                    <td style="padding: 3px 0; vertical-align: top;">:</td>
                                    <td style="padding: 3px 5px; vertical-align: top;"><?php echo $params->pasien->nama ?? ""; ?></td>
                                </tr>
                                <tr>
                                    <td style="padding: 3px 5px; vertical-align: top;">Tanggal Lahir</td>
                                    <td style="padding: 3px 0; vertical-align: top;">:</td>
                                    <td style="padding: 3px 5px; vertical-align: top;"><?php echo !empty($params->pasien->tanggal_lahir) ? tgl_indo($params->pasien->tanggal_lahir) : ""; ?></td>
                                </tr>
                                <tr>
                                    <td style="padding: 3px 5px; vertical-align: top;">Alamat</td>
                                    <td style="padding: 3px 0; vertical-align: top;">:</td>
                                    <td style="padding: 3px 5px; vertical-align: top;"><?php echo $params->pasien->alamat ?? ""; ?></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>

                <table style="width: 100%; margin-top: 20px;">
                    <tr>
                        <td style="text-align: center; vertical-align: top;">
                            <h4 style="margin: 0; font-size: 14pt;"><b>LEMBAR KUASA</b></h4>
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top; padding-top: 10px;">
                            Lembar kuasa ini harus ditanda tangani oleh pasien sendiri atau wali ( keluarga terdekat/kawan/Induk Semang/ dan lain sebagainya ) bagi pasien yang :
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top; padding-top: 5px; padding-left: 20px;">
                            <table style="width: 100%;" class="table-borderless">
                                <tr>
                                    <td style="width: 2%; vertical-align: top;">-</td>
                                    <td style="vertical-align: top;">Secara fisik/mental dinyatakan tidak sanggup untuk mengisi</td>
                                </tr>
                                <tr>
                                    <td style="vertical-align: top;">-</td>
                                    <td style="vertical-align: top;">Pasien dibawah umur</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>

                <table style="width: 100%; margin-top: 20px;">
                    <tr>
                        <td style="text-align: center; vertical-align: top;">
                            <h4 style="margin: 0; font-size: 14pt;"><b>PERSETUJUAN RAWAT INAP</b></h4>
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top; padding-top: 10px;">
                            Kami yang bertanda tangan dibawah ini :
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top;">
                            <table style="width: 100%; margin-left: 20px;" class="table-borderless">
                                <tr>
                                    <td style="width: 10%; padding: 3px 0; vertical-align: top;">Nama</td>
                                    <td style="width: 2%; padding: 3px 0; vertical-align: top;">:</td>
                                    <td style="width: 88%; padding: 3px 0; vertical-align: top; border-bottom: 1px dotted black;">
                                        <?php echo $params->penanggung_jawab->nama ?? ""; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 3px 0; vertical-align: top;">Umur</td>
                                    <td style="padding: 3px 0; vertical-align: top;">:</td>
                                    <td style="padding: 3px 0; vertical-align: top; border-bottom: 1px dotted black;">
                                        <?php echo !empty($params->penanggung_jawab->umur) ? $params->penanggung_jawab->umur . " Tahun" : ""; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 3px 0; vertical-align: top;">Alamat</td>
                                    <td style="padding: 3px 0; vertical-align: top;">:</td>
                                    <td style="padding: 3px 0; vertical-align: top; border-bottom: 1px dotted black;">
                                        <?php echo $params->penanggung_jawab->alamat ?? ""; ?>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top; padding-top: 10px;">
                            <?php $hubungan = !empty($params->penanggung_jawab->hubungan_dengan_pasien) ? $params->penanggung_jawab->hubungan_dengan_pasien : '........................'; ?>
                            Atas nama ( <?= $hubungan; ?> ) dari pasien :
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top;">
                            <table style="width: 100%; margin-left: 20px;" class="table-borderless">
                                <tr>
                                    <td style="width: 10%; padding: 3px 0; vertical-align: top;">Nama</td>
                                    <td style="width: 2%; padding: 3px 0; vertical-align: top;">:</td>
                                    <td style="width: 88%; padding: 3px 0; vertical-align: top; border-bottom: 1px dotted black;">
                                        <?php echo $params->pasien->nama ?? ""; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 3px 0; vertical-align: top;">Umur</td>
                                    <td style="padding: 3px 0; vertical-align: top;">:</td>
                                    <td style="padding: 3px 0; vertical-align: top; border-bottom: 1px dotted black;">
                                        <?php echo !empty($params->pasien->umur) ? $params->pasien->umur . " Tahun" : ""; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 3px 0; vertical-align: top;">Alamat</td>
                                    <td style="padding: 3px 0; vertical-align: top;">:</td>
                                    <td style="padding: 3px 0; vertical-align: top; border-bottom: 1px dotted black;">
                                        <?php echo $params->pasien->alamat ?? ""; ?>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top; padding-top: 10px;">
                            Menyatakan :
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top; padding-left: 20px;">
                            <table style="width: 100%;" class="table-borderless">
                                <tr>
                                    <td style="width: 3%; vertical-align: top;">1.</td>
                                    <td style="vertical-align: top; text-align: justify;">
                                        Bersedia untuk rawat inap di <?php echo $static_label->hospital_name ?? "RS Yasyfin Darusallam Gontor"; ?> dan mengijinkan dokter manapun yang ditunjuk untuk melakukan cara pengobatan atau tindakan ( medis dan perawatan ) yang dianggap perlu.
                                    </td>
                                </tr>
                                <tr>
                                    <td style="vertical-align: top; padding-top: 5px;">2.</td>
                                    <td style="vertical-align: top; padding-top: 5px;">
                                        Untuk perawatan kami memilih
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td style="vertical-align: top;">
                                        <?php $kls = $params->perawatan->pilihan_kelas ?? ""; ?>
                                        <span style="font-size: 14pt;"><?= $kls === "Superior" ? '&#9745;' : '&#9744;' ?></span> Superior &nbsp;&nbsp;
                                        <span style="font-size: 14pt;"><?= $kls === "VIP (Standart)" ? '&#9745;' : '&#9744;' ?></span> VIP (Standart) &nbsp;&nbsp;
                                        <span style="font-size: 14pt;"><?= $kls === "Kelas I" ? '&#9745;' : '&#9744;' ?></span> Kelas I &nbsp;&nbsp;
                                        <span style="font-size: 14pt;"><?= $kls === "Kelas II" ? '&#9745;' : '&#9744;' ?></span> Kelas II &nbsp;&nbsp;
                                        <span style="font-size: 14pt;"><?= $kls === "Kelas III" ? '&#9745;' : '&#9744;' ?></span> Kelas III &nbsp;&nbsp;
                                        <span style="font-size: 14pt;"><?= $kls === "Lainnya" ? '&#9745;' : '&#9744;' ?></span> <?php echo $kls === "Lainnya" ? ($params->perawatan->pilihan_kelas_lainnya ?? "..............") : ".............."; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="vertical-align: top; padding-top: 5px;">3.</td>
                                    <td style="vertical-align: top; padding-top: 5px; text-align: justify;">
                                        Untuk itu saya bersedia menanggung semua biaya yang timbul dan bersedia mentaati semua peraturan yang berkaitan dengan tata Laksana pembayaran
                                    </td>
                                </tr>
                                <tr>
                                    <td style="vertical-align: top; padding-top: 5px;">4.</td>
                                    <td style="vertical-align: top; padding-top: 5px; text-align: justify;">
                                        Bersedia mentaati / memenuhi segala peraturan yang berlaku di <?php echo $static_label->hospital_name ?? "RS Yasyfin Darusallam Gontor"; ?> dan bila melanggar saya bersedia menerima sanksi.
                                    </td>
                                </tr>
                                <tr>
                                    <td style="vertical-align: top; padding-top: 5px;">5.</td>
                                    <td style="vertical-align: top; padding-top: 5px;">
                                        Cara Pembayaran
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td style="vertical-align: top;">
                                        <?php $byr = $params->pembayaran->cara_pembayaran ?? ""; ?>
                                        <table style="width: 100%;" class="table-borderless">
                                            <tr>
                                                <td style="width: 50%; vertical-align: top;">
                                                    a. <span style="font-size: 14pt;"><?= $byr === "BPJS" ? '&#9745;' : '&#9744;' ?></span> BPJS
                                                </td>
                                                <td style="width: 50%; vertical-align: top;">
                                                    d. <span style="font-size: 14pt;"><?= $byr === "Jasa Raharja" ? '&#9745;' : '&#9744;' ?></span> Jasa Raharja
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="vertical-align: top; padding-top: 5px;">
                                                    b. <span style="font-size: 14pt;"><?= $byr === "Umum" ? '&#9745;' : '&#9744;' ?></span> Umum
                                                </td>
                                                <td style="vertical-align: top; padding-top: 5px;">
                                                    e. <span style="font-size: 14pt;"><?= $byr === "Perusahaan" ? '&#9745;' : '&#9744;' ?></span> Perusahaan
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="vertical-align: top; padding-top: 5px;">
                                                    c. <span style="font-size: 14pt;"><?= $byr === "Asuransi lain" ? '&#9745;' : '&#9744;' ?></span> Asuransi lain <?php echo $byr === "Asuransi lain" ? ($params->pembayaran->detail_asuransi_lain ?? "................") : "................"; ?>
                                                </td>
                                                <td style="vertical-align: top; padding-top: 5px;">
                                                    f. <span style="font-size: 14pt;"><?= $byr === "Lain lain" ? '&#9745;' : '&#9744;' ?></span> Lain lain <?php echo $byr === "Lain lain" ? ($params->pembayaran->detail_lain_lain ?? "................") : "................"; ?>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>

                <table style="width: 100%; margin-top: 20px;">
                    <tr>
                        <td style="width: 50%; vertical-align: top;"></td>
                        <td style="width: 50%; text-align: center; vertical-align: top;">
                            <?php echo $static_label->hospital_city ?? ""; ?>,
                            <?= !empty($params->ttd_data->tanggal) ? tgl_indo($params->ttd_data->tanggal) : ".............................." ?>
                            <?= !empty($params->ttd_data->jam) ? ", Jam " . $params->ttd_data->jam . " WIB" : ".............................." ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: center; vertical-align: top; padding-top: 10px;">Saksi</td>
                        <td style="text-align: center; vertical-align: top; padding-top: 10px;">Yang Menyatakan</td>
                    </tr>
                    <tr>
                        <td style="text-align: center; height: 100px; vertical-align: middle;">
                            <?php if (!empty($params->ttd_data->perawat_stroke)): ?>
                                <img src="<?php echo $params->ttd_data->perawat_stroke; ?>" style="height:100px; width:auto; display:block; margin:0 auto;">
                            <?php endif; ?>
                        </td>
                        <td style="text-align: center; height: 100px; vertical-align: middle;">
                            <?php if (!empty($params->ttd_data->yang_menyatakan_stroke)): ?>
                                <img src="<?php echo $params->ttd_data->yang_menyatakan_stroke; ?>" style="height:100px; width:auto; display:block; margin:0 auto;">
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: center; vertical-align: top;">
                            ( <?php echo !empty($params->ttd_data->perawat) ? $params->ttd_data->perawat : ".............................."; ?> )<br>
                            Nama Jelas
                        </td>
                        <td style="text-align: center; vertical-align: top;">
                            ( <?php echo !empty($params->ttd_data->yang_menyatakan) ? $params->ttd_data->yang_menyatakan : ".............................."; ?> )<br>
                            Nama Jelas
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

</html>