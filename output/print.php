<?php
// EMR Data
$params = json_decode($argv[1]);
$base_url = $argv[2]; // Base_url
$title = "ASSESMEN AWAL MEDIS RAWAT JALAN ";
$static_label = json_decode($argv[3]);

if (!function_exists('tgl_indo')) {
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
        $hari = date('j', $timestamp);
        $bulan_ke = date('n', $timestamp);
        $tahun = date('Y', $timestamp);

        return $hari . ' ' . $bulan[$bulan_ke] . ' ' . $tahun;
    }
}

if (!function_exists('render_image_canvas')) {
    function render_image_canvas($bg_url, $stroke_base64, $width = 500, $height = 333)
    {
        ob_start();
?>
        <div style="width: <?= $width ?>px; height: <?= $height ?>px; margin: 0 auto; font-size: 0; line-height: 0;
                    background-image: url('<?= $bg_url ?>');
                    background-size: <?= $width ?>px <?= $height ?>px;
                    background-repeat: no-repeat;
                    background-position: center;">
            <?php if (!empty($stroke_base64)): ?>
                <img src="<?= $stroke_base64 ?>" style="width: <?= $width ?>px; height: <?= $height ?>px; display: block; margin: 0; padding: 0;">
            <?php endif; ?>
        </div>
<?php
        return ob_get_clean();
    }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title><?= $title; ?></title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 11pt;
            line-height: 1.3;
            margin: 0;
            padding: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td,
        th {
            vertical-align: top;
            padding: 4px;
        }

        .tbl-border,
        .tbl-border th,
        .tbl-border td {
            border: 1px solid black;
        }

        .table-bordered,
        .table-bordered th,
        .table-bordered td {
            border: 1px solid black;
        }

        .table-borderless,
        .table-borderless th,
        .table-borderless td {
            border: none;
            border-collapse: collapse;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .bold {
            font-weight: bold;
        }

        .mt-10 {
            margin-top: 10px;
        }

        .mt-20 {
            margin-top: 20px;
        }

        .checkbox-box {
            display: inline-block;
            width: 12px;
            height: 12px;
            border: 1px solid black;
            text-align: center;
            line-height: 12px;
            font-size: 10pt;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div style="padding: 10px;">
        <!-- Kop RS Header -->
        <table style="width: 100%;">
            <tr style="padding-bottom: 5px; padding-top: 5px;">
                <td width="15%" style="vertical-align: middle; text-align: center;">
                    <img style="width: 70px" src="<?= $base_url; ?>/images/rs/LogoRS.png" onerror="this.src='/images/blank.png';">
                </td>
                <td width="40%" style="vertical-align: middle;">
                    <h4 style="margin: 0; font-size: 14pt; font-weight: bold;"><?= $static_label->hospital_name ?? 'RUMAH SAKIT'; ?></h4>
                    <div style="font-size: 9pt; line-height: 1.3; margin-top: 5px;">
                        <?= !empty($static_label->hospital_address) ? $static_label->hospital_address . "<br>" : ""; ?>
                        <?= !empty($static_label->hospital_phone) ? "Telp. " . $static_label->hospital_phone . "<br>" : ""; ?>
                        <?= !empty($static_label->hospital_email) ? "Email: " . $static_label->hospital_email : ""; ?>
                    </div>
                </td>
                <td class="tbl-border" width="45%" style="vertical-align: middle; padding: 6px; font-size:10pt">
                    <table class="table-borderless" style="width: 100%;">
                        <tr>
                            <td valign="top" width="36%">No. RM</td>
                            <td valign="top" width="1%">:</td>
                            <td valign="top"><b><?= $params->pasien->no_rm ?? ''; ?></b></td>
                        </tr>
                        <tr>
                            <td valign="top">Nama Pasien</td>
                            <td valign="top">:</td>
                            <td valign="top"><b><?= $params->pasien->nama ?? ''; ?></b></td>
                        </tr>
                        <tr>
                            <td valign="top">Tanggal Lahir</td>
                            <td valign="top">:</td>
                            <td valign="top"><?= $params->pasien->tanggal_lahir_indo ?? tgl_indo($params->pasien->tanggal_lahir ?? ''); ?></td>
                        </tr>
                        <tr>
                            <td valign="top">Alamat</td>
                            <td valign="top">:</td>
                            <td valign="top"><?= $params->pasien->alamat ?? ''; ?></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <!-- Document Title Banner -->
        <table class="mt-10" style="width: 100%;">
            <tr>
                <td class="text-center" style="padding: 6px;">
                    <b style="font-size: 12pt;"><?= $title; ?></b>
                </td>
            </tr>
        </table>

        <!-- Section A: Anamnesis -->
        <table class="tbl-border mt-10">
            <tr>
                <td valign="top" style="background-color: #f5f5f5;" colspan="2">
                    <b>PENGKAJIAN DOKTER</b>
                </td>
            </tr>
            <tr>
                <td valign="top" style="background-color: #f5f5f5;" colspan="2">
                    <b>A. ANAMNESIS</b>
                </td>
            </tr>
            <tr>
                <td valign="top" width="25%"><b>1. Keluhan Utama</b></td>
                <td valign="top"><?= nl2br(htmlspecialchars($params->anamnesis->keluhan_utama ?? '')); ?></td>
            </tr>
            <tr>
                <td valign="top"><b>2. Riwayat Penyakit</b></td>
                <td valign="top"><?= nl2br(htmlspecialchars($params->anamnesis->riwayat_penyakit ?? '')); ?></td>
            </tr>
        </table>

        <!-- Section B: Pemeriksaan Fisik -->
        <table class="tbl-border mt-10">
            <tr>
                <td valign="top" style="background-color: #f5f5f5;" colspan="2"><b>B. PEMERIKSAAN FISIK</b></td>
            </tr>
            <tr>
                <td valign="top" width="25%"><b>1. Keadaan Umum</b></td>
                <td valign="top">
                    <?php $ku = $params->pemeriksaan_fisik->keadaan_umum ?? ''; ?>
                    <span class="checkbox-box"><?= $ku == 'Sehat' ? 'V' : '' ?></span> Sehat &nbsp;&nbsp;
                    <span class="checkbox-box"><?= $ku == 'Sakit Ringan' ? 'V' : '' ?></span> Sakit Ringan &nbsp;&nbsp;
                    <span class="checkbox-box"><?= $ku == 'Sakit Sedang' ? 'V' : '' ?></span> Sakit Sedang &nbsp;&nbsp;
                    <span class="checkbox-box"><?= $ku == 'Sakit Berat' ? 'V' : '' ?></span> Sakit Berat
                </td>
            </tr>
            <tr>
                <td valign="top"><b>2. Vital Sign</b></td>
                <td valign="top">
                    TD: <b><?= $params->pemeriksaan_fisik->vital_sign->td ?? '-'; ?></b> mmHg &nbsp;|&nbsp;
                    Nadi: <b><?= $params->pemeriksaan_fisik->vital_sign->nadi ?? '-'; ?></b> x/mnt &nbsp;|&nbsp;
                    Suhu: <b><?= $params->pemeriksaan_fisik->vital_sign->suhu ?? '-'; ?></b> °C &nbsp;|&nbsp;
                    RR: <b><?= $params->pemeriksaan_fisik->vital_sign->rr ?? '-'; ?></b> x/mnt &nbsp;|&nbsp;
                    SpO2: <b><?= $params->pemeriksaan_fisik->vital_sign->spo2 ?? '-'; ?></b> %<br>
                    TB: <b><?= $params->pemeriksaan_fisik->vital_sign->tb ?? '-'; ?></b> cm &nbsp;|&nbsp;
                    BB: <b><?= $params->pemeriksaan_fisik->vital_sign->bb ?? '-'; ?></b> kg
                </td>
            </tr>
            <tr>
                <td valign="top"><b>3. Kesadaran</b></td>
                <td valign="top">
                    <?php $kes = $params->pemeriksaan_fisik->kesadaran ?? ''; ?>
                    <span class="checkbox-box"><?= $kes == 'CM' ? 'V' : '' ?></span> CM &nbsp;&nbsp;
                    <span class="checkbox-box"><?= $kes == 'Apatis' ? 'V' : '' ?></span> Apatis &nbsp;&nbsp;
                    <span class="checkbox-box"><?= $kes == 'Somnolen' ? 'V' : '' ?></span> Somnolen &nbsp;&nbsp;
                    <span class="checkbox-box"><?= $kes == 'Sopor' ? 'V' : '' ?></span> Sopor &nbsp;&nbsp;
                    <span class="checkbox-box"><?= $kes == 'Koma' ? 'V' : '' ?></span> Koma
                </td>
            </tr>
            <tr>
                <td valign="top"><b>4. Kepala</b></td>
                <td valign="top"><?= htmlspecialchars($params->pemeriksaan_fisik->kepala ?? ''); ?></td>
            </tr>
            <tr>
                <td valign="top"><b>5. Thorax</b></td>
                <td valign="top"><?= htmlspecialchars($params->pemeriksaan_fisik->thorax ?? ''); ?></td>
            </tr>
            <tr>
                <td valign="top"><b>6. Abdomen</b></td>
                <td valign="top"><?= htmlspecialchars($params->pemeriksaan_fisik->abdomen ?? ''); ?></td>
            </tr>
            <tr>
                <td valign="top"><b>7. Ekstremitas</b></td>
                <td valign="top"><?= htmlspecialchars($params->pemeriksaan_fisik->ekstremitas ?? ''); ?></td>
            </tr>
        </table>

        <!-- Status Lokalis Overlay Component -->
        <table class="tbl-border mt-10">
            <tr>
                <td valign="top" style="background-color: #f5f5f5;" colspan="2"><b>STATUS LOKALIS</b></td>
            </tr>
            <tr>
                <td valign="top" width="65%" class="text-center" style="vertical-align: middle;">
                    <?= render_image_canvas(
                        $base_url . '/images/image-tubuh.png',
                        $params->image_canvas->canvas1->stroke ?? '',
                        400,
                        300
                    ) ?>
                </td>
                <td valign="top" width="35%">
                    <b>Catatan Status Lokalis:</b><br>
                    <?= nl2br(htmlspecialchars($params->status_lokalis->catatan ?? '')); ?>
                </td>
            </tr>
        </table>

        <!-- Section C: Hasil Pemeriksaan Penunjang -->
        <table class="tbl-border mt-10">
            <tr>
                <td valign="top" style="background-color: #f5f5f5;" colspan="2"><b>C. HASIL PEMERIKSAAN PENUNJANG</b></td>
            </tr>
            <tr>
                <td valign="top" width="25%"><b>1. Laboratorium</b></td>
                <td valign="top"><?= nl2br(htmlspecialchars($params->laboratorium_freetext ?? '')); ?></td>
            </tr>
            <tr>
                <td valign="top"><b>2. Radiologi</b></td>
                <td valign="top"><?= nl2br(htmlspecialchars($params->radiologi_freetext ?? '')); ?></td>
            </tr>
            <tr>
                <td valign="top"><b>3. Penunjang Lain</b></td>
                <td valign="top"><?= nl2br(htmlspecialchars($params->pemeriksaan_penunjang->penunjang_lain ?? '')); ?></td>
            </tr>
        </table>

        <!-- Section D: Diagnosis / Assessment -->
        <table class="tbl-border mt-10">
            <tr>
                <td valign="top" style="background-color: #f5f5f5;" colspan="2"><b>D. DIAGNOSIS / ASSESMENT</b></td>
            </tr>
            <tr>
                <td valign="top" width="25%"><b>1. Diagnosis Masuk</b></td>
                <td valign="top">
                    <?= nl2br(htmlspecialchars($params->diagnosa_masuk_group ?? '')); ?>
                </td>
            </tr>
        </table>

        <!-- Section E: Rencana & Tindak Lanjut -->
        <table class="tbl-border mt-10">
            <tr>
                <td valign="top" style="background-color: #f5f5f5;" colspan="2"><b>E. RENCANA</b></td>
            </tr>
            <tr>
                <td valign="top" width="25%"><b>1. Penegakan Diagnosis</b></td>
                <td valign="top"><?= nl2br(htmlspecialchars($params->rencana->penegakan_diagnosis ?? '')); ?></td>
            </tr>
            <tr>
                <td valign="top"><b>2. Terapi</b></td>
                <td valign="top"><?= nl2br(htmlspecialchars($params->resep_freetext ?? '')); ?></td>
            </tr>
            <tr>
                <td valign="top"><b>3. Diet</b></td>
                <td valign="top"><?= nl2br(htmlspecialchars($params->rencana->diet ?? '')); ?></td>
            </tr>
            <tr>
                <td valign="top"><b>4. Edukasi</b></td>
                <td valign="top"><?= nl2br(htmlspecialchars($params->rencana->edukasi ?? '')); ?></td>
            </tr>
            <tr>
                <td valign="top"><b>Tindak Lanjut</b></td>
                <td valign="top">
                    <?php $tl = $params->rencana->tindak_lanjut ?? ''; ?>
                    <span class="checkbox-box"><?= $tl == 'MRS' ? 'V' : '' ?></span> MRS &nbsp;&nbsp;&nbsp;&nbsp;
                    <span class="checkbox-box"><?= $tl == 'PULANG / KRS' ? 'V' : '' ?></span> PULANG / KRS
                    <?php if ($tl == 'PULANG / KRS' && !empty($params->rencana->tindak_lanjut_pulang)): ?>
                        (<b><?= htmlspecialchars($params->rencana->tindak_lanjut_pulang); ?></b>)
                    <?php endif; ?>
                </td>
            </tr>
            <tr>
                <td valign="top"><b>Rencana Asuhan Medis</b></td>
                <td valign="top">
                    <?= htmlspecialchars($params->rencana->rencana_asuhan_medis ?? ''); ?>
                    <?php if (($params->rencana->rencana_asuhan_medis ?? '') == 'Lainnya' && !empty($params->rencana->rencana_asuhan_medis_lainnya)): ?>
                        : <?= htmlspecialchars($params->rencana->rencana_asuhan_medis_lainnya); ?>
                    <?php endif; ?>
                </td>
            </tr>
            <tr>
                <td valign="top"><b>Dirujuk ke</b></td>
                <td valign="top">
                    <?php $rj = $params->rencana->dirujuk_ke ?? ''; ?>
                    <span class="checkbox-box"><?= $rj == 'Ahli Gizi Klinik' ? 'V' : '' ?></span> Ahli Gizi Klinik &nbsp;&nbsp;
                    <span class="checkbox-box"><?= $rj == 'Rehabilitasi Medik' ? 'V' : '' ?></span> Rehabilitasi Medik &nbsp;&nbsp;
                    <span class="checkbox-box"><?= $rj == 'Klinik Spesialis' ? 'V' : '' ?></span> Klinik Spesialis &nbsp;&nbsp;
                    <span class="checkbox-box"><?= $rj == 'Lainnya' ? 'V' : '' ?></span> Lainnya
                    <?php if ($rj == 'Lainnya' && !empty($params->rencana->dirujuk_ke_lainnya)): ?>
                        (<?= htmlspecialchars($params->rencana->dirujuk_ke_lainnya); ?>)
                    <?php endif; ?>
                </td>
            </tr>
            <tr>
                <td valign="top"><b>Transportasi Pulang</b></td>
                <td valign="top">
                    <?php $tp = $params->rencana->transportasi_pulang ?? ''; ?>
                    <span class="checkbox-box"><?= $tp == 'Ambulance' ? 'V' : '' ?></span> Ambulance &nbsp;&nbsp;
                    <span class="checkbox-box"><?= $tp == 'Kendaraan Pribadi' ? 'V' : '' ?></span> Kendaraan Pribadi &nbsp;&nbsp;
                    <span class="checkbox-box"><?= $tp == 'Lainnya' ? 'V' : '' ?></span> Lainnya
                    <?php if ($tp == 'Lainnya' && !empty($params->rencana->transportasi_pulang_lainnya)): ?>
                        (<?= htmlspecialchars($params->rencana->transportasi_pulang_lainnya); ?>)
                    <?php endif; ?>
                </td>
            </tr>
        </table>

        <!-- Signatures (TTD Block) -->
        <table class="mt-20" style="width: 100%;">
            <tr>
                <td valign="top" width="60%"></td>
                <td valign="top" width="40%" class="text-center">
                    <?= !empty($params->ttd_data->tanggal_indo) ? $static_label->hospital_city . ', ' . $params->ttd_data->tanggal_indo : (!empty($params->ttd_data->tanggal) ? $static_label->hospital_city . ', ' . tgl_indo($params->ttd_data->tanggal) : '') ?><br>
                    Dokter<br>
                    <div style="height: 90px; margin: 5px 0;">
                        <?php if (!empty($params->ttd_data->dokter_stroke)): ?>
                            <img src="<?= $params->ttd_data->dokter_stroke; ?>" style="max-height: 80px; max-width: 180px;" onerror="this.style.display='none';">
                        <?php endif; ?>
                    </div>
                    <b>( <?= htmlspecialchars($params->ttd_data->dokter ?? '........................................'); ?> )</b><br>
                    Tanda Tangan & Nama Terang
                </td>
            </tr>
        </table>
    </div>
</body>

</html>