<?php
// EMR Data
$params = json_decode($argv[1]);
$base_url = $argv[2]; // Base_url
$title = "PELAYANAN BINA ROHANI";
$static_label = json_decode($argv[3]);

$pasien = $params->pasien ?? null;
$ttd_data = $params->ttd_data ?? null;
$bina_rohani = $params->bina_rohani ?? null;
$catatan = $params->catatan ?? '';

if (empty($bina_rohani) || !is_array($bina_rohani)) {
    $bina_rohani = [];
    for ($i = 0; $i < 7; $i++) {
        $bina_rohani[] = (object) [
            'tanggal' => '',
            'tanggal_indo' => '',
            'jam' => '',
            'tindakan_detail' => '',
            'nama_pasien_keluarga' => '',
            'pasien_stroke' => '',
            'nama_petugas' => '',
            'petugas_stroke' => ''
        ];
    }
} else {
    // Cast elements to object for easier property access
    $bina_rohani = array_map(function ($item) {
        return (object)$item;
    }, $bina_rohani);
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
        font: 10pt "Times New Roman", Times, serif;
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
        max-width: 65px;
        max-height: 65px;
        object-fit: contain;
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
</style>

<body>
    <!-- Kop Surat / Header -->
    <table class="header-table" style="width: 100%; border-collapse: collapse; margin-bottom: 25px;">
        <tr>
            <!-- Logo Section -->
            <td style="width: 12%; text-align: center; vertical-align: middle;">
                <img src="<?= $base_url ?>/images/rs/LogoRS.png" class="img-logo" alt="Logo" onerror="this.style.display='none';">
            </td>
            <td style="width: 45%; text-align: left; vertical-align: middle; padding-left: 10px;">
                <div style="font-weight: bold; font-size: 13pt; line-height: 1.2; text-transform: uppercase;">
                    <?= htmlspecialchars($static_label->hospital_name ?? 'RS YASYFIN DARUSSALAM GONTOR') ?>
                </div>
                <div style="font-size: 9pt;"><?= htmlspecialchars($static_label->hospital_address ?? 'Jl. Dukuh Gontor II Mlarak 63472 Ponorogo - Jawa Timur') ?></div>
                <div style="font-size: 9pt;">
                    <?= !empty($static_label->hospital_phone) ? "Telp. " . htmlspecialchars($static_label->hospital_phone) : 'Telp. ( 0352 ) 3597038' ?>
                    <?= !empty($static_label->hospital_email) ? " Email: " . htmlspecialchars($static_label->hospital_email) : ' Email: rsyasyfin@gontor.ac.id' ?>
                </div>
            </td>
            <!-- Patient Info Section -->
            <td style="width: 43%; vertical-align: top;">
                <div style="border: 1px solid black; padding: 4px; font-size: 10pt; line-height: 1.2;">
                    <table class="table-borderless" style="width: 100%;">
                        <tr>
                            <td style="width: 30%;">No RM</td>
                            <td style="width: 3%;">:</td>
                            <td style="width: 67%;"><?= htmlspecialchars($pasien->no_rm ?? '') ?></td>
                        </tr>
                        <tr>
                            <td>Nama Pasien</td>
                            <td>:</td>
                            <td><?= htmlspecialchars($pasien->nama ?? '') ?></td>
                        </tr>
                        <tr>
                            <td>Tanggal Lahir</td>
                            <td>:</td>
                            <td><?= htmlspecialchars($pasien->tanggal_lahir_indo ?? '') ?></td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top;">Alamat</td>
                            <td style="vertical-align: top;">:</td>
                            <td style="vertical-align: top; white-space: normal; word-break: break-all;"><?= htmlspecialchars($pasien->alamat ?? '') ?></td>
                        </tr>
                    </table>
                </div>
            </td>
        </tr>
    </table>

    <div style="text-align: center; margin-block: 15px; font-weight: bold; font-size: 12pt; text-transform: uppercase; margin-bottom: 25px;">
        PELAYANAN BINA ROHANI
    </div>

    <!-- Tabel FBR -->
    <table class="table-bordered" style="width: 100%; border: 1px solid black; font-size: 9.5pt; border-collapse: collapse;">
        <thead>
            <tr style="background-color: #f8f9fa;">
                <th style="width: 15%; font-weight: bold; text-align: center; padding: 6px; border: 1px solid black; vertical-align: middle;">Tgl/bln/Th<br>Jam</th>
                <th style="width: 15%; font-weight: bold; text-align: center; padding: 6px; border: 1px solid black; vertical-align: middle;">Masalah Rohani</th>
                <th style="width: 35%; font-weight: bold; text-align: center; padding: 6px; border: 1px solid black; vertical-align: middle;">Tindakan</th>
                <th style="width: 17%; font-weight: bold; text-align: center; padding: 6px; border: 1px solid black; vertical-align: middle;">Nama dan Tandatangan Pasien / Keluarga</th>
                <th style="width: 18%; font-weight: bold; text-align: center; padding: 6px; border: 1px solid black; vertical-align: middle;">Nama dan Tandatangan Petugas</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($bina_rohani as $index => $row): ?>
                <tr>
                    <!-- Column 1: Tanggal & Jam -->
                    <td style="text-align: center; vertical-align: middle; padding: 6px; border: 1px solid black;">
                        <?php if (!empty($row->tanggal_indo)): ?>
                            <?= htmlspecialchars($row->tanggal_indo) ?>
                        <?php endif; ?>
                        <?php if (!empty($row->jam)): ?>
                            <br><?= htmlspecialchars($row->jam) ?>
                        <?php endif; ?>
                    </td>
                    <!-- Column 2: Masalah Rohani -->
                    <td style="padding: 6px; vertical-align: top; border: 1px solid black;">
                        <?php if ($index === 0): ?>
                            Pasien Baru (anak, dewasa melahirkan)
                        <?php elseif ($index === 1): ?>
                            Pre op & post
                        <?php elseif ($index === 2): ?>
                            Psycosomatis
                        <?php elseif ($index === 3): ?>
                            Pasien Terminal
                        <?php elseif ($index === 4): ?>
                            Pasien IWR
                        <?php elseif ($index === 5): ?>
                            Pemulasaran jenazah
                        <?php elseif ($index === 6): ?>
                            Pasien non muslim
                        <?php endif; ?>
                    </td>
                    <!-- Column 3: Tindakan -->
                    <td style="padding: 6px; vertical-align: top; border: 1px solid black;">
                        <?php if ($index === 0): ?>
                            Menyampaikan ke pasien & keluarga untuk<br>
                            a. Bersabar<br>
                            b. Tawakal<br>
                            c. Ikhlas<br>
                            d. Menunjukkan arah kiblat<br>
                            e. Tayamum<br>
                            f. Sholat<br>
                            g. Do'a bersama-sama<br>
                            h. <?= htmlspecialchars($row->tindakan_detail ?? '') ?>
                        <?php elseif ($index === 1): ?>
                            Menyampaikan ke pasien & keluarga untuk :<br>
                            a. Bersabar<br>
                            b. Tawakal<br>
                            c. Ikhlas<br>
                            d. Do'a sebelum Operasi<br>
                            e. <?= htmlspecialchars($row->tindakan_detail ?? '') ?>
                        <?php elseif ($index === 2): ?>
                            Menyampaikan ke pasien & keluarga untuk :<br>
                            a. Bersabar<br>
                            b. Tawakal<br>
                            c. Ikhlas<br>
                            d. Doa bersama - sama<br>
                            e. <?= htmlspecialchars($row->tindakan_detail ?? '') ?>
                        <?php elseif ($index === 3): ?>
                            Menyampaikan ke pasien & Keluarga untuk:<br>
                            a. Bersabar<br>
                            b. Tawakal<br>
                            c. Ikhlas<br>
                            d. Do'a bersama - sama<br>
                            e. <?= htmlspecialchars($row->tindakan_detail ?? '') ?>
                        <?php elseif ($index === 4): ?>
                            Memotivasi pasien untuk :<br>
                            a. Bersabar<br>
                            b. Tawakal<br>
                            c. Ikhlas<br>
                            d. Talqina & di do'akan<br>
                            e. <?= htmlspecialchars($row->tindakan_detail ?? '') ?>
                        <?php elseif ($index === 5): ?>
                            a. Menghubungi Tim<br>
                            b. Menyiapkan tempat<br>
                            c. Memandikan, mengkafani, menyolatkan<br>
                            d. Menyerahkan jenazah ke keluarga<br>
                            e. <?= htmlspecialchars($row->tindakan_detail ?? '') ?>
                        <?php elseif ($index === 6): ?>
                            Menyampaikan ke pasien & keluarga untuk :<br>
                            a. Bersabar<br>
                            b. Ikhlas<br>
                            c. Berdo'a menurut agama dan keyakinan<br>
                            d. <?= htmlspecialchars($row->tindakan_detail ?? '') ?>
                        <?php endif; ?>
                    </td>
                    <!-- Column 4: Pasien / Keluarga Signature -->
                    <td style="padding: 0; border: 1px solid black; vertical-align: bottom; width: 17%;">
                        <table style="width: 100%; border: none; border-collapse: collapse; margin: 0; padding: 0; height: 75px;">
                            <tr>
                                <td style="border: none; text-align: center; vertical-align: bottom; height: 50px; padding: 2px;">
                                    <?php if (!empty($row->pasien_stroke)): ?>
                                        <img src="<?= htmlspecialchars($row->pasien_stroke) ?>" style="max-height: 100px; width: auto; object-fit: contain; vertical-align: bottom;" />
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <td style="border: none; text-align: center; vertical-align: top; height: 25px; padding: 2px; font-weight: normal; font-size: 9pt;">
                                    <?= htmlspecialchars($row->nama_pasien_keluarga ?? '') ?>
                                </td>
                            </tr>
                        </table>
                    </td>
                    <!-- Column 5: Petugas Signature -->
                    <td style="padding: 0; border: 1px solid black; vertical-align: bottom; width: 18%;">
                        <table style="width: 100%; border: none; border-collapse: collapse; margin: 0; padding: 0; height: 75px;">
                            <tr>
                                <td style="border: none; text-align: center; vertical-align: bottom; height: 50px; padding: 2px;">
                                    <?php if (!empty($row->petugas_stroke)): ?>
                                        <img src="<?= htmlspecialchars($row->petugas_stroke) ?>" style="max-height: 45px; max-width: 100px; object-fit: contain; vertical-align: bottom;" />
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <td style="border: none; text-align: center; vertical-align: top; height: 25px; padding: 2px; font-weight: normal; font-size: 9pt;">
                                    <?= htmlspecialchars($row->nama_petugas ?? '') ?>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Catatan -->
    <?php if (!empty($catatan)): ?>
        <div style="margin-top: 20px; font-size: 10pt; border: 1px solid black; padding: 10px;">
            <strong>Catatan :</strong><br>
            <?= nl2br(htmlspecialchars($catatan)) ?>
        </div>
    <?php endif; ?>
</body>

</html>