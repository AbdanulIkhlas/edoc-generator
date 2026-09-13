<?php
// EMR Data
$params = json_decode($argv[1]);

$base_url = $argv[2]; // Base_url
$title = "Odontogram";
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
        font: 11pt times new roman;
        size: f4;
        padding-bottom: 10px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    td {
        vertical-align: top;
        padding: 2px;
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
        width: 70px;
        height: auto;
    }

    .ttd-img {
        width: 150px;
        height: 80px;
        object-fit: contain;
    }

    .pagebreak {
        min-height: 1px;
        page-break-before: always;
    }

    .pagebreak-avoid {
        page-break-inside: avoid;
    }

    .main-outer-table {
        width: 100%;
        page-break-inside: auto;
    }
</style>

<body>
    <!-- KOP SURAT -->
    <div style="padding-bottom: 15px;">
        <table style="width: 100%;">
            <tr>
                <td width="15%" style="vertical-align: middle; text-align: center;">
                    <img style="width: 75px;" src="<?= $base_url; ?>/images/rs/LogoRS.png">
                </td>
                <td width="40%" style="vertical-align: middle; padding-left: 5px;">
                    <div style="font-size: 13pt; font-weight: bold; line-height: 1.2;">
                        <?= $static_label->hospital_name ?? 'RS Farmagitechs'; ?>
                    </div>
                    <div style="font-size: 12pt; font-weight: bold; line-height: 1.2;">
                        <?= $static_label->hospital_city ?? 'Yogyakarta'; ?>
                    </div>
                    <div style="font-size: 9.5pt; line-height: 1.2; margin-top: 3px;">
                        <?= $static_label->hospital_address ?? 'Jl. Magelang Km.12, Sleman, Daerah Istimewa Yogyakarta'; ?>
                    </div>
                    <div style="font-size: 10pt; font-weight: bold; line-height: 1.2; margin-top: 2px;">
                        <?= $static_label->hospital_regency ?? $static_label->hospital_city ?? 'Sleman'; ?>
                    </div>
                </td>
                <td width="45%" style="vertical-align: middle;">
                    <div style="border: 1px solid black; padding: 6px 10px; font-size: 10.5pt;">
                        <table style="width: 100%;">
                            <tr>
                                <td style="width: 36%;">No RM</td>
                                <td style="width: 2%;">:</td>
                                <td><?= $params->pasien->no_rm ?? ''; ?></td>
                            </tr>
                            <tr>
                                <td>Nama Pasien</td>
                                <td>:</td>
                                <td><?= $params->pasien->nama ?? ''; ?><?= !empty($params->pasien->kelamin) ? ' (' . (strtoupper($params->pasien->kelamin)[0] ?? '') . ')' : ''; ?></td>
                            </tr>
                            <tr>
                                <td>Tanggal Lahir</td>
                                <td>:</td>
                                <td><?= !empty($params->pasien->tanggal_lahir) ? tgl_indo($params->pasien->tanggal_lahir) : ($params->pasien->tanggal_lahir_indo ?? ''); ?></td>
                            </tr>
                            <tr>
                                <td>NIK</td>
                                <td>:</td>
                                <td><?= $params->pasien->nik ?? $params->external_link->px_data->no_identitas ?? ''; ?></td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
        </table>
    </div>

    <!-- TITLE -->
    <div style="text-align: center; font-weight: bold; font-size: 14pt; margin: 10px 0 15px 0;">
        ODONTOGRAM
    </div>

    <!-- KETERANGAN ODONTOGRAM -->
    <table border="0" style="width: 100%; margin-top: 10px;">
        <tr>
            <td style="font-weight: bold;">Keterangan :</td>
        </tr>
    </table>
    <table class="table-bordered" style="width: 100%;">
        <tr>
            <td align="center">
                <img
                    src="<?= $base_url; ?>/images/keterangan_odontogram_1.png"
                    style="width:100%; height:auto; object-fit:contain;">
            </td>
        </tr>
        <tr>
            <td align="center">
                <img
                    src="<?= $base_url; ?>/images/keterangan_odontogram_2.png"
                    style="width:100%; height:auto; object-fit:contain;">
            </td>
        </tr>
        <tr>
            <td align="center">
                <img
                    src="<?= $base_url; ?>/images/keterangan_odontogram_3.png"
                    style="width:100%; height:auto; object-fit:contain;">
            </td>
        </tr>
    </table>

    <br />

    <!-- ODONTOGRAM RESULT STROKE -->
    <table class="table-border-no-top-bottom">
        <tr>
            <td style="padding:10px">

                <hr />
                <?php if (!empty($params->odontogram_stroke)) : ?>
                    <img
                        src="<?= $params->odontogram_stroke ?? "" ?>"
                        style="width:100%; height:auto; object-fit:contain; padding-left:10px">
                <?php endif; ?>
                <div style="padding:4px;">
                    <b>Keterangan :</b><br>
                    <p><?= nl2br(htmlspecialchars($params->odontogram_keterangan_freetext ?? '')) ?></p>
                </div>
            </td>
        </tr>
    </table>


</body>

</html>