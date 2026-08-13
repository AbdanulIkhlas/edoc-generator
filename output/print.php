<?php
// Ambil Key dari Argumen (bukan data JSON)
$redisKey = $argv[1];
$base_url = $argv[2]; // Base_url
$title = "LEMBAR KONSULTASI";

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

$static = isset($params->static_json->static_json) ? $params->static_json->static_json : null;
if ($static) {
    // Override params for continuous document because data is in static payload
    $params = $static;
}
// Fungsi untuk format tanggal Indonesia
function tanggal_indo($tanggal, $includeJam = true)
{
    if (empty($tanggal)) return '';

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

    $tgl = date('d', strtotime($tanggal));
    $bln = $bulan[(int) date('m', strtotime($tanggal))];
    $thn = date('Y', strtotime($tanggal));

    $tanggalFormatted = $tgl . ' ' . $bln . ' ' . $thn;

    if ($includeJam) {
        $jam = date('H:i', strtotime($tanggal));
        if ($jam !== '00:00') {
            $tanggalFormatted .= ', ' . $jam;
        }
    }

    return $tanggalFormatted;
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
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
            font-family: "Times New Roman", Times, serif;
            font-weight: normal;
        }

        body {
            font-size: 11pt;
            padding-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        .table-bordered,
        .table-bordered th,
        .table-bordered td {
            border: 1px solid black;
            padding: 4px;
        }

        .table-bordered th {
            text-align: center;
            vertical-align: middle;
            font-weight: bold;
        }

        .ttd-img-print {
            width: 130px;
            height: auto;
            margin: 5px 0;
        }

        .box-container {
            border: 1px solid black;
            width: 100%;
            margin-top: 10px;
        }

        .box-header {
            text-align: center;
            font-weight: bold;
            border-bottom: 1px solid black;
            padding: 4px;
        }

        .box-body {
            padding: 8px 10px;
            vertical-align: top;
            height: 350px;
            /* Menjaga kotak tetap panjang ke bawah */

            /* Tambahan agar teks panjang pasti turun ke bawah (tidak tembus ke samping) */
            white-space: normal;
            word-wrap: break-word;
            word-break: break-word;
        }
    </style>
</head>

<body>
    <table border="0" width="100%" style="border-collapse: collapse; margin-bottom: 10px;">
        <tr>
            <td style="width: 55%; vertical-align: middle; text-align: left;">
                <table border="0" style="border-collapse: collapse;">
                    <tr>
                        <td style="width: 80px; text-align: center; vertical-align: middle;">
                            <img src="<?= $base_url . '/images/rs/LogoRs.png' ?>" style="width:70px; height:auto;" />
                        </td>
                        <td style="vertical-align: middle; padding-left: 10px;">
                            <span style="font-weight: bold; font-size: 20px; line-height: 1.2;">
                                <?= isset($static_label->hospital_name) ? $static_label->hospital_name : '' ?><br>
                            </span>
                            <span style="font-size: 16px;">
                                <?= isset($static_label->hospital_address) ? $static_label->hospital_address : '' ?>
                            </span>
                            <span style="font-size: 16px;">
                                <br>Telp : <?= isset($static_label->hospital_phone) ? $static_label->hospital_phone : '' ?> <br>Email : <?= isset($static_label->hospital_email) ? $static_label->hospital_email : '' ?>
                            </span>
                        </td>
                    </tr>
                </table>
            </td>

            <td style="width: 45%; vertical-align: top;">
                <table style="border:1px solid black; border-collapse:collapse; width:100%; font-size:11pt;">
                    <tr>
                        <td style="padding:2px 4px; width:30%; vertical-align: top;">No RM</td>
                        <td style="padding:2px 4px; width:2%; vertical-align: top;">:</td>
                        <td style="padding:2px 4px; width:68%; vertical-align: top;">
                            <?= isset($params->pasien->no_rm) ? $params->pasien->no_rm : '' ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:2px 4px; vertical-align: top;">Nama Pasien</td>
                        <td style="padding:2px 4px; vertical-align: top;">:</td>
                        <td style="padding:2px 4px; vertical-align: top;"><?= isset($params->pasien->nama) ? $params->pasien->nama : '' ?></td>
                    </tr>
                    <tr>
                        <td style="padding:2px 4px; vertical-align: top;">Tanggal Lahir</td>
                        <td style="padding:2px 4px; vertical-align: top;">:</td>
                        <td style="padding:2px 4px; vertical-align: top;">
                            <?= isset($params->pasien->tanggal_lahir_indo) ? $params->pasien->tanggal_lahir_indo : '' ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:2px 4px; vertical-align: top;">Alamat</td>
                        <td style="padding:2px 4px; vertical-align: top;">:</td>
                        <td style="padding:2px 4px; vertical-align: top;">
                            <?= isset($params->pasien->alamat) ? $params->pasien->alamat : '' ?>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <div style="border-top: 2px solid black; margin-bottom: 15px;"></div>
    <div style="text-align: center; font-weight: bold; font-size: 12pt; margin-top: 15px; margin-bottom: 5px;">
        LEMBAR KONSULTASI
    </div>

    <table class="box-container" style="page-break-inside: avoid;">
        <tr>
            <td class="box-header">
                Permintaan Konsul Dokter<br>
                Tanda Tangan & Nama Terang Dokter DPJP
            </td>
        </tr>
        <tr>
            <td class="box-body">
                <div style="margin-bottom: 10px;">
                    Kepada Yth. Teman Sejawat<br>
                    Dokter (Konsulen) : <?= isset($params->form_data->kepada_konsulen) ? $params->form_data->kepada_konsulen : '' ?>
                </div>

                <div style="min-height: 120px;">
                    Konsul :<br>
                    <?= isset($params->form_data->konsul) && $params->form_data->konsul !== '' ? nl2br(htmlspecialchars($params->form_data->konsul)) : '' ?>
                </div>

                <table style="width: 100%; border: none; margin-top: 20px;">
                    <tr>
                        <td style="width: 60%;"></td>
                        <td style="width: 40%; text-align: center;">
                            <?= isset($static_label->hospital_city) ? $static_label->hospital_city : 'Kota' ?>,
                            <?= isset($params->ttd_data->tanggal_permintaan_indo) && $params->ttd_data->tanggal_permintaan_indo ? $params->ttd_data->tanggal_permintaan_indo : '' ?>
                            Jam: <?= isset($params->ttd_data->jam_permintaan) && $params->ttd_data->jam_permintaan ? $params->ttd_data->jam_permintaan : '' ?> WIB<br>
                            Dokter<br>

                            <?php if (!empty($params->ttd_data->dokter_dpjp_stroke)) : ?>
                                <img src="<?= $params->ttd_data->dokter_dpjp_stroke ?>" class="ttd-img-print" />
                            <?php else : ?>
                                <div style="height: 70px;"></div>
                            <?php endif; ?>
                            <br>
                            <?= isset($params->ttd_data->dokter_dpjp) && $params->ttd_data->dokter_dpjp ? htmlspecialchars($params->ttd_data->dokter_dpjp) : '' ?> <br>
                            <span style="font-size: 10pt;">Tanda Tangan & Nama Terang</span>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr>
            <td class="box-header" style="border-top: 1px solid black;">
                Jawaban Konsul<br>
                Tanda Tangan & Nama Terang Dokter Konsulen
            </td>
        </tr>
        <tr>
            <td class="box-body">
                <div style="margin-bottom: 10px;">
                    Kepada Yth. Teman Sejawat<br>
                    Dokter : <?= isset($params->form_data->kepada_dpjp) ? $params->form_data->kepada_dpjp : '' ?>
                </div>

                <div style="min-height: 120px;">
                    Saran :<br>
                    <?= isset($params->form_data->saran) && $params->form_data->saran !== '' ? nl2br(htmlspecialchars($params->form_data->saran)) : '' ?>
                </div>

                <table style="width: 100%; border: none; margin-top: 20px;">
                    <tr>
                        <td style="width: 60%;"></td>
                        <td style="width: 40%; text-align: center;">
                            <?= isset($static_label->hospital_city) ? $static_label->hospital_city : 'Kota' ?>,
                            <?= isset($params->ttd_data->tanggal_jawaban_indo) && $params->ttd_data->tanggal_jawaban_indo ? $params->ttd_data->tanggal_jawaban_indo : '' ?>
                            Jam: <?= isset($params->ttd_data->jam_jawaban) && $params->ttd_data->jam_jawaban ? $params->ttd_data->jam_jawaban : '' ?> WIB<br>
                            Dokter<br>

                            <?php if (!empty($params->ttd_data->dokter_konsulen_stroke)) : ?>
                                <img src="<?= $params->ttd_data->dokter_konsulen_stroke ?>" class="ttd-img-print" />
                            <?php else : ?>
                                <div style="height: 70px;"></div>
                            <?php endif; ?>
                            <br>
                            <?= isset($params->ttd_data->dokter_konsulen) && $params->ttd_data->dokter_konsulen ? htmlspecialchars($params->ttd_data->dokter_konsulen) : '' ?> <br>
                            <span style="font-size: 10pt;">Tanda Tangan & Nama Terang</span>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

</body>

</html>