<?php
// Ambil Key dari Argumen (bukan data JSON)
$redisKey = $argv[1];
$base_url = $argv[2]; // Base_url

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

$title = "Surat Rujuk Peserta dan Rujuk Balik";

$entries = isset($params->entry) ? $params->entry : [];
$static = isset($params->static_json->static_json) ? $params->static_json->static_json : null;

if ($static) {
    // Override params for continuous document because data is in static payload
    $params = $static;
}
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

<body style="font-size: 12pt;">
    <!-- === [EMR_DATA_DISPLAY_HOOK] === -->
    <!-- AI will insert the main HTML structure and data binding here -->
    <table style="width: 100%; border: 1px solid black; margin-bottom: 20px; page-break-inside: auto;" class="table-borderless">
        <tr>
            <td style="vertical-align: top; padding: 10px;">
                <table style="width: 100%;">
                    <tr style="padding-bottom: 5px; padding-top: 5px;">
                        <td width="20%" style="vertical-align: middle; text-align: center;">
                            <img style="width: 100px" src="<?= $base_url; ?>/images/rs/LogoRS.png">
                        </td>
                        <td width="80%" style="vertical-align: middle; text-align: center;">
                            <h4 style="margin: 0; font-size: 14pt; font-weight: bold;"><?php echo $static_label->hospital_name ?? "RS Yasyfin Darussalam Gontor"; ?></h4>
                            <div style="font-size: 12pt; line-height: 1.3; margin-top: 5px;">
                                <?php echo !empty($static_label->hospital_address) ? $static_label->hospital_address . "<br>" : "Jl. Dukuh Gontor II, Desa Gontor, Kec. Mlarak<br>Kab. Ponorogo, Jawa Timur 63472<br>"; ?>
                                <?php echo !empty($static_label->hospital_email) ? "Email: " . $static_label->hospital_email . "<br>" : "Email: rsyasyfin@gontor.ac.id<br>"; ?>
                                <?php echo !empty($static_label->hospital_phone) ? "Telp. " . $static_label->hospital_phone . " Fax. 0352 3597038" : "Telp. 0352 3591202 Fax. 0352 3597038"; ?>
                            </div>
                        </td>
                    </tr>
                </table>

                <h4 style="text-align: center; margin-top: 10px; margin-bottom: 10px; font-size: 14pt; font-weight: bold;">SURAT RUJUKAN PESERTA</h4>

                <table style="width: 100%; border: 1px solid black; margin-bottom: 10px;" class="table-borderless">
                    <tr>
                        <td style="width: 20%; padding: 5px; vertical-align: top;">No.Rujukan</td>
                        <td style="width: 2%; padding: 5px; vertical-align: top;">:</td>
                        <td style="padding: 5px; vertical-align: top;"></td>
                        <td style="width: 15%; padding: 5px; vertical-align: top;"></td>
                        <td style="width: 20%; padding: 5px; vertical-align: top;"></td>
                    </tr>
                    <tr>
                        <td style="padding: 5px; vertical-align: top;">Rumah Sakit</td>
                        <td style="padding: 5px; vertical-align: top;">:</td>
                        <td style="padding: 5px; vertical-align: top; font-weight: bold;"><?php echo $params->rujukan->rumah_sakit ?? ""; ?></td>
                        <td style="padding: 5px; vertical-align: top;">Kode RS :</td>
                        <td style="padding: 5px; vertical-align: top;"></td>
                    </tr>
                    <tr>
                        <td style="padding: 5px; vertical-align: top;">Kabupaten/ Kota</td>
                        <td style="padding: 5px; vertical-align: top;">:</td>
                        <td style="padding: 5px; vertical-align: top; font-weight: bold;"><?php echo $params->rujukan->kabupaten_kota ?? ""; ?></td>
                        <td style="padding: 5px; vertical-align: top;"></td>
                        <td style="padding: 5px; vertical-align: top;"></td>
                    </tr>
                </table>

                <table style="width: 100%; margin-bottom: 10px;">
                    <tr>
                        <td style="width: 20%; padding-bottom: 5px; vertical-align: top;">Kepada Yth.</td>
                        <td style="width: 2%; padding-bottom: 5px; vertical-align: top;">:</td>
                        <td style="padding-bottom: 5px; vertical-align: top;"></td>
                    </tr>
                    <tr>
                        <td style="padding-bottom: 5px; vertical-align: top;">RSU</td>
                        <td style="padding-bottom: 5px; vertical-align: top;">:</td>
                        <td style="padding-bottom: 5px; vertical-align: top;"><?php echo $params->rujukan->rsu ?? ""; ?></td>
                    </tr>
                </table>

                <div style="margin-bottom: 10px; font-size: 12pt;">
                    Mohon pemeriksaan dan penanganan lebih lanjut penderita :
                </div>

                <table style="width: 100%; margin-bottom: 10px;">
                    <tr>
                        <td style="width: 20%; padding-bottom: 5px; vertical-align: top;">Nama</td>
                        <td style="width: 2%; padding-bottom: 5px; vertical-align: top;">:</td>
                        <td style="width: 35%; padding-bottom: 5px; vertical-align: top;"><?php echo $params->pasien->nama ?? ""; ?></td>
                        <td style="width: 10%; padding-left: 10px; padding-bottom: 5px; vertical-align: top;">Umur</td>
                        <td style="width: 2%; padding-bottom: 5px; vertical-align: top;">:</td>
                        <td style="padding-bottom: 5px; vertical-align: top; text-align: center;"><?php echo $params->pasien->umur ?? ""; ?></td>
                        <td style="width: 10%; padding-left: 10px; padding-bottom: 5px; vertical-align: top;">Tahun</td>
                    </tr>
                    <tr>
                        <td style="padding-bottom: 5px; vertical-align: top;">No.Kartu BPJS</td>
                        <td style="padding-bottom: 5px; vertical-align: top;">:</td>
                        <td style="padding-bottom: 5px; vertical-align: top;"><?php echo $params->rujukan->no_kartu_bpjs ?? ""; ?></td>
                        <td style="padding-left: 10px; padding-bottom: 5px; vertical-align: top;">Status</td>
                        <td style="padding-bottom: 5px; vertical-align: top;">:</td>
                        <td colspan="2" style="padding-bottom: 5px; vertical-align: top;">
                            <?php
                            $status = $params->rujukan->status ?? "";
                            $is_utama = $status == "Utama";
                            $is_tanggungan = $status == "Tanggungan";
                            $kelamin = $params->pasien->kelamin ?? "";
                            $is_l = in_array(strtolower($kelamin), ['l', 'laki-laki']);
                            $is_p = in_array(strtolower($kelamin), ['p', 'perempuan']);
                            ?>
                            <span style="border: 1px solid black; padding: 0 5px; margin-right: 5px; margin-bottom: 10px; display: inline-block; width: 10px; text-align:center;"><?= ($is_utama || $is_tanggungan) ? "✓" : "&nbsp;"; ?></span><span style="<?= $is_utama ? 'border: 1px solid black; border-radius: 50%; padding: 2px 4px;' : 'padding: 2px 4px;' ?>">Utama</span>/<span style="<?= $is_tanggungan ? 'border: 1px solid black; border-radius: 50%; padding: 2px 4px;' : 'padding: 2px 4px;' ?>">Tanggungan</span>
                            <br />
                            <span style="border: 1px solid black; padding: 0 5px;  margin-right: 5px; display: inline-block; width: 10px; text-align:center;"><?= ($is_l || $is_p) ? "✓" : "&nbsp;"; ?></span><span style="<?= $is_l ? 'border: 1px solid black; border-radius: 50%; padding: 2px 4px;' : 'padding: 2px 4px;' ?>">L</span>/<span style="<?= $is_p ? 'border: 1px solid black; border-radius: 50%; padding: 2px 4px;' : 'padding: 2px 4px;' ?>">P</span>
                        </td>
                    </tr>
                </table>

                <table style="width: 100%; margin-bottom: 10px;">
                    <tr>
                        <td style="width: 20%; padding-bottom: 5px; vertical-align: top;">Diagnosa</td>
                        <td style="width: 2%; padding-bottom: 5px; vertical-align: top;">:</td>
                        <td style="padding-bottom: 5px; vertical-align: top;">
                            <?php echo nl2br($params->rujukan->diagnosa_group ?? ""); ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-bottom: 5px; padding-top: 10px; vertical-align: top;">Telah diberikan</td>
                        <td style="padding-bottom: 5px; padding-top: 10px; vertical-align: top;">:</td>
                        <td style="padding-bottom: 5px; padding-top: 10px; vertical-align: top;">
                            <?php echo nl2br($params->rujukan->telah_diberikan ?? ""); ?>
                        </td>
                    </tr>
                </table>

                <div style="margin-bottom: 20px; font-size: 12pt;">
                    Demikian atas bantuanya, diucapkan terima kasih.
                </div>

                <table style="width: 100%;">
                    <tr>
                        <td style="width: 40%; vertical-align: top;"></td>
                        <td style="width: 60%; text-align: center; vertical-align: top;">
                            <table style="width: 100%;">
                                <tr>
                                    <td style="width: 30%; text-align: right; padding-right: 5px; vertical-align: top;"><?php echo $static_label->hospital_city ?? ""; ?>, </td>
                                    <td style="width: 70%; text-align: left; vertical-align: top; padding-left: 5px;">
                                        <?= isset($params->ttd_data->tanggal_rujukan_peserta) && !empty($params->ttd_data->tanggal_rujukan_peserta) ? tgl_indo($params->ttd_data->tanggal_rujukan_peserta) : "" ?>,
                                        <?= isset($params->ttd_data->jam_rujukan_peserta) && !empty($params->ttd_data->jam_rujukan_peserta) ? ' Jam ' . tgl_indo($params->ttd_data->jam_rujukan_peserta) . ' WIB' : "" ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="text-align: center; padding-top: 5px; vertical-align: top;">Salam Sejawat</td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="text-align: center; height: 80px; vertical-align: middle;">
                                        <?php if (!empty($params->ttd_data->perawat_stroke)): ?>
                                            <img src="<?php echo $params->ttd_data->perawat_stroke; ?>" style="height:80px; width:auto; display:block; margin:0 auto;">
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="text-align: center; vertical-align: top;">
                                        ( <?php echo $params->ttd_data->perawat ?? "...................................."; ?> )
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <table style="width: 100%; border: 1px solid black; margin-bottom: 20px; page-break-inside: auto;" class="table-borderless">
        <tr>
            <td style="vertical-align: top; padding: 10px;">
                <table style="width: 100%;">
                    <tr style="padding-bottom: 5px; padding-top: 5px;">
                        <td width="20%" style="vertical-align: middle; text-align: center;">
                            <img style="width: 100px" src="<?= $base_url; ?>/images/rs/LogoRS.png">
                        </td>
                        <td width="80%" style="vertical-align: middle; text-align: center;">
                            <h4 style="margin: 0; font-size: 14pt; font-weight: bold;"><?php echo $static_label->hospital_name ?? "RS Yasyfin Darussalam Gontor"; ?></h4>
                            <div style="font-size: 12pt; line-height: 1.3; margin-top: 5px;">
                                <?php echo !empty($static_label->hospital_address) ? $static_label->hospital_address . "<br>" : "Jl. Dukuh Gontor II, Desa Gontor, Kec. Mlarak<br>Kab. Ponorogo, Jawa Timur 63472<br>"; ?>
                                <?php echo !empty($static_label->hospital_email) ? "Email: " . $static_label->hospital_email . "<br>" : "Email: rsyasyfin@gontor.ac.id<br>"; ?>
                                <?php echo !empty($static_label->hospital_phone) ? "Telp. " . $static_label->hospital_phone . " Fax. 0352 3597038" : "Telp. 0352 3591202 Fax. 0352 3597038"; ?>
                            </div>
                        </td>
                    </tr>
                </table>

                <h4 style="text-align: center; margin-top: 10px; margin-bottom: 10px; font-size: 14pt; font-weight: bold;">SURAT RUJUKAN BALIK</h4>

                <table style="width: 100%; border: 1px solid black; margin-bottom: 10px;" class="table-borderless">
                    <tr>
                        <td style="width: 20%; padding: 5px; vertical-align: top;">No.Rujukan</td>
                        <td style="width: 2%; padding: 5px; vertical-align: top;">:</td>
                        <td style="padding: 5px; vertical-align: top;"><?php echo $params->rujukan_balik->no_rujukan ?? ""; ?></td>
                        <td style="width: 15%; padding: 5px; vertical-align: top;"></td>
                        <td style="width: 20%; padding: 5px; vertical-align: top;"></td>
                    </tr>
                    <tr>
                        <td style="padding: 5px; vertical-align: top;">Rumah Sakit</td>
                        <td style="padding: 5px; vertical-align: top;">:</td>
                        <td style="padding: 5px; vertical-align: top;"><?php echo $params->rujukan_balik->rumah_sakit ?? ""; ?></td>
                        <td style="padding: 5px; vertical-align: top;">Kode RS :</td>
                        <td style="padding: 5px; vertical-align: top;"><?php echo $params->rujukan_balik->kode_rs ?? ""; ?></td>
                    </tr>
                </table>

                <div style="margin-bottom: 10px; font-size: 12pt;">
                    Teman Sejawat Yth.<br>
                    Mohon Kontrol selanjutnya penderita :
                </div>

                <table style="width: 100%; margin-bottom: 10px;">
                    <tr>
                        <td style="width: 20%; padding-bottom: 5px; vertical-align: top;">Nama</td>
                        <td style="width: 2%; padding-bottom: 5px; vertical-align: top;">:</td>
                        <td style="padding-bottom: 5px; vertical-align: top;"><?php echo $params->pasien->nama ?? ""; ?></td>
                    </tr>
                    <tr>
                        <td style="padding-bottom: 5px; vertical-align: top;">Diagnosa</td>
                        <td style="padding-bottom: 5px; vertical-align: top;">:</td>
                        <td style="padding-bottom: 5px; vertical-align: top;">
                            <?php echo nl2br($params->rujukan_balik->diagnosa_group ?? ""); ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-bottom: 5px; padding-top: 10px; vertical-align: top;">Terapi</td>
                        <td style="padding-bottom: 5px; padding-top: 10px; vertical-align: top;">:</td>
                        <td style="padding-bottom: 5px; padding-top: 10px; vertical-align: top;">
                            <?php echo nl2br($params->rujukan_balik->terapi ?? ""); ?>
                        </td>
                    </tr>
                </table>

                <div style="margin-bottom: 10px; font-size: 12pt;">
                    Tindak lanjut yang dianjurkan
                </div>

                <table style="width: 100%; margin-bottom: 20px;">
                    <tr>
                        <td style="width: 5%; text-align: right; padding-right: 10px; padding-bottom: 10px; vertical-align: top;">
                            <span style="border: 1px solid black; padding: 0 5px; display: inline-block; width: 10px; text-align:center;"><?= ($params->rujukan_balik->pengobatan_dengan_obat ?? false) ? "✓" : "&nbsp;"; ?></span>
                        </td>
                        <td style="width: 45%; padding-bottom: 10px; vertical-align: top;">
                            Pengobatan dengan obat-obatan :<br>
                            <span style="display: inline-block; width: 90%; min-height: 20px;"><?= $params->rujukan_balik->pengobatan_dengan_obat_text ?? ""; ?></span>
                        </td>
                        <td style="width: 5%; text-align: right; padding-right: 10px; padding-bottom: 10px; vertical-align: top;">
                            <span style="border: 1px solid black; padding: 0 5px; display: inline-block; width: 10px; text-align:center;"><?= ($params->rujukan_balik->perlu_rawat_inap ?? false) ? "✓" : "&nbsp;"; ?></span>
                        </td>
                        <td style="width: 45%; padding-bottom: 10px; vertical-align: top;">
                            Perlu rawat inap
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 5%; text-align: right; padding-right: 10px; padding-bottom: 10px; vertical-align: top;">
                            <span style="border: 1px solid black; padding: 0 5px; display: inline-block; width: 10px; text-align:center;"><?= ($params->rujukan_balik->kontrol_kembali ?? false) ? "✓" : "&nbsp;"; ?></span>
                        </td>
                        <td style="width: 45%; padding-bottom: 10px; vertical-align: top;">
                            Kontrol kembali RS tanggal :<br>
                            <span style="display: inline-block; width: 90%; min-height: 20px;">
                                <?= !empty($params->rujukan_balik->kontrol_kembali_tanggal) ? tgl_indo($params->rujukan_balik->kontrol_kembali_tanggal) : ""; ?>
                            </span>
                        </td>
                        <td style="width: 5%; text-align: right; padding-right: 10px; padding-bottom: 10px; vertical-align: top;">
                            <span style="border: 1px solid black; padding: 0 5px; display: inline-block; width: 10px; text-align:center;"><?= ($params->rujukan_balik->konsultasi_selesai ?? false) ? "✓" : "&nbsp;"; ?></span>
                        </td>
                        <td style="width: 45%; padding-bottom: 10px; vertical-align: top;">
                            Konsultasi Selesai
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 5%; text-align: right; padding-right: 10px; padding-bottom: 10px; vertical-align: top;">
                            <span style="border: 1px solid black; padding: 0 5px; display: inline-block; width: 10px; text-align:center;"><?= ($params->rujukan_balik->lain_lain ?? false) ? "✓" : "&nbsp;"; ?></span>
                        </td>
                        <td style="width: 45%; padding-bottom: 10px; vertical-align: top;">
                            Lain - lain :<br>
                            <span style="display: inline-block; width: 90%; min-height: 20px;"><?= $params->rujukan_balik->lain_lain_text ?? ""; ?></span>
                        </td>
                        <td></td>
                        <td></td>
                    </tr>
                </table>

                <table style="width: 100%;">
                    <tr>
                        <td style="width: 40%; vertical-align: top;"></td>
                        <td style="width: 60%; text-align: center; vertical-align: top;">
                            <table style="width: 100%;">
                                <tr>
                                    <td style="width: 30%; text-align: right; padding-right: 5px; vertical-align: top;"><?php echo $static_label->hospital_city ?? ""; ?>, </td>
                                    <td style="width: 70%; text-align: left; vertical-align: top; padding-left: 5px;">
                                        <?= isset($params->ttd_data->tanggal_rujukan_balik) && !empty($params->ttd_data->tanggal_rujukan_balik) ? tgl_indo($params->ttd_data->tanggal_rujukan_balik) : "" ?>,
                                        <?= isset($params->ttd_data->jam_rujukan_balik) && !empty($params->ttd_data->jam_rujukan_balik) ? ' Jam ' . tgl_indo($params->ttd_data->jam_rujukan_balik) . ' WIB' : "" ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="text-align: center; padding-top: 5px; vertical-align: top;">Dokter Rumah Sakit</td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="text-align: center; height: 80px; vertical-align: middle;">
                                        <?php if (!empty($params->ttd_data->dokter_stroke)): ?>
                                            <img src="<?php echo $params->ttd_data->dokter_stroke; ?>" style="height:80px; width:auto; display:block; margin:0 auto;">
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="text-align: center; vertical-align: top;">
                                        ( <?php echo $params->ttd_data->dokter ?? "...................................."; ?> )
                                    </td>
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