<?php
// EMR Data
$params = json_decode($argv[1]);
$base_url = $argv[2]; // Base_url
$title = "ASSESMEN AWAL MEDIS RAWAT JALAN";
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
    function render_image_canvas($bg_url, $stroke_base64, $width = 380, $height = 250)
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

// Helpers for parameters
$no_rm = $params->pasien->no_rm ?? '';
$nama_pasien = $params->pasien->nama ?? '';
$tanggal_lahir = $params->pasien->tanggal_lahir_indo ?? (!empty($params->pasien->tanggal_lahir) ? tgl_indo($params->pasien->tanggal_lahir) : '');
$alamat = $params->pasien->alamat ?? '';

$keluhan_utama = $params->anamnesis->keluhan_utama ?? '';
$riwayat_penyakit = $params->anamnesis->riwayat_penyakit ?? '';

$keadaan_umum = $params->pemeriksaan_fisik->keadaan_umum ?? '';

$vs = $params->pemeriksaan_fisik->vital_sign ?? null;
$td = $vs->td ?? (
    (!empty($vs->tensi_sistole) || !empty($vs->tensi_diastole))
    ? ($vs->tensi_sistole ?? '-') . '/' . ($vs->tensi_diastole ?? '-')
    : '-'
);
$nadi = $vs->nadi ?? '-';
$suhu = $vs->suhu ?? '-';
$rr = $vs->rr ?? '-';
$tb = $vs->tb ?? '-';
$bb = $vs->bb ?? '-';
$spo2 = $vs->spo2 ?? '-';

$kesadaran = $params->pemeriksaan_fisik->kesadaran ?? '';
$kepala = $params->pemeriksaan_fisik->kepala ?? '';
$thorax = $params->pemeriksaan_fisik->thorax ?? '';
$abdomen = $params->pemeriksaan_fisik->abdomen ?? '';
$ekstremitas = $params->pemeriksaan_fisik->ekstremitas ?? '';

$catatan_status_lokalis = $params->status_lokalis->catatan ?? '';
$stroke_canvas = $params->image_canvas->canvas1->stroke ?? '';

$laboratorium = !empty($params->laboratorium_freetext) ? $params->laboratorium_freetext : ($params->pemeriksaan_penunjang->laboratorium ?? '');
$radiologi = !empty($params->radiologi_freetext) ? $params->radiologi_freetext : ($params->pemeriksaan_penunjang->radiologi ?? '');
$penunjang_lain = $params->pemeriksaan_penunjang->penunjang_lain ?? '';

$diagnosis_awal = !empty($params->diagnosa_masuk_group) ? $params->diagnosa_masuk_group : ($params->diagnosis->diagnosis_awal ?? '');
$icd10 = $params->diagnosis->icd10 ?? '';

$penegakan_diagnosis = $params->rencana->penegakan_diagnosis ?? '';
$terapi = !empty($params->resep_freetext) ? $params->resep_freetext : ($params->rencana->terapi ?? '');
$diet = $params->rencana->diet ?? '';
$edukasi = $params->rencana->edukasi ?? '';

$tindak_lanjut = $params->rencana->tindak_lanjut ?? '';
$tindak_lanjut_pulang = $params->rencana->tindak_lanjut_pulang ?? '';

$rencana_asuhan_medis = $params->rencana->rencana_asuhan_medis ?? '';
$rencana_asuhan_medis_lainnya = $params->rencana->rencana_asuhan_medis_lainnya ?? '';

$dirujuk_ke = $params->rencana->dirujuk_ke ?? '';
$dirujuk_ke_lainnya = $params->rencana->dirujuk_ke_lainnya ?? '';

$transportasi_pulang = $params->rencana->transportasi_pulang ?? '';
$transportasi_pulang_lainnya = $params->rencana->transportasi_pulang_lainnya ?? '';

$tanggal_ttd = !empty($params->ttd_data->tanggal_indo) ? $params->ttd_data->tanggal_indo : (!empty($params->ttd_data->tanggal) ? tgl_indo($params->ttd_data->tanggal) : '');
$jam_ttd = $params->ttd_data->jam ?? '';
$dokter_nama = $params->ttd_data->dokter ?? '';
$dokter_stroke = $params->ttd_data->dokter_stroke ?? '';
$kota = $static_label->hospital_city ?? 'Ponorogo';
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
            color: #000;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            page-break-inside: auto;
        }

        tr {
            page-break-inside: auto;
            page-break-after: auto;
        }

        td,
        th {
            vertical-align: top;
            padding: 4px 6px;
            font-size: 11pt;
            font-weight: normal;
            page-break-inside: auto;
        }

        .main-outer-table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #000;
            page-break-inside: auto;
        }

        .main-outer-table>tbody>tr>td {
            border-bottom: 1px solid #000;
            padding: 6px;
            vertical-align: top;
        }

        .main-outer-table>tbody>tr:last-child>td {
            border-bottom: none;
        }

        .tbl-inner {
            width: 100%;
            border-collapse: collapse;
        }

        .tbl-inner td,
        .tbl-inner th {
            border: 1px solid #000;
            padding: 4px 6px;
            vertical-align: top;
        }

        .tbl-borderless,
        .tbl-borderless td,
        .tbl-borderless th {
            border: none !important;
            padding: 2px 4px;
            vertical-align: top;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
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

        .checkbox-box {
            display: inline-block;
            width: 11px;
            height: 11px;
            border: 1px solid #000;
            text-align: center;
            line-height: 11px;
            font-size: 8pt;
            font-weight: normal;
            vertical-align: middle;
            margin-right: 3px;
        }

        .radio-box {
            display: inline-block;
            width: 10px;
            height: 10px;
            border: 1px solid #000;
            border-radius: 50%;
            text-align: center;
            line-height: 10px;
            font-size: 10pt;
            font-weight: normal;
            vertical-align: middle;
            margin-right: 3px;
        }

        .rm-header {
            float: right;
            font-size: 12pt;
            font-weight: normal;
            margin-bottom: 4px;
        }

        .circle-text {
            border: 1px solid #000;
            border-radius: 12px;
            padding: 1px 6px;
            display: inline-block;
            line-height: 1.1;
        }
    </style>
</head>

<body>
    <div style="padding: 10px;">
        <div class="rm-header">RM 04</div>
        <div style="clear: both;"></div>

        <!-- Kop RS Header & Patient Box -->
        <table class="tbl-borderless" style="width: 100%; margin-bottom: 10px;">
            <tr>
                <td valign="top" width="12%" style="text-align: center;">
                    <img style="width: 65px;" src="<?= $base_url; ?>/images/rs/LogoRS.png" onerror="this.src='/images/blank.png';">
                </td>
                <td valign="top" width="48%">
                    <h4 style="margin: 0; font-size: 13pt; font-weight: normal;"><?= $static_label->hospital_name ?? 'RS YASYFIN DARUSSALAM GONTOR'; ?></h4>
                    <div style="font-size: 9pt; line-height: 1.3; margin-top: 3px;">
                        <?= !empty($static_label->hospital_address) ? $static_label->hospital_address . "<br>" : "Jl. Dukuh Gontor II Mlarak 63472<br>Ponorogo – Jawa Timur<br>"; ?>
                        <?= !empty($static_label->hospital_phone) ? "Telp. " . $static_label->hospital_phone . "<br>" : "Telp. ( 0352 ) 3597202<br>"; ?>
                        <?= !empty($static_label->hospital_email) ? "Email: " . $static_label->hospital_email : "Email: rsyasyfin@gontor.ac.id"; ?>
                    </div>
                </td>
                <td valign="top" width="40%" style="border: 1px solid #000 !important; padding: 6px;">
                    <table class="tbl-borderless" style="width: 100%;">
                        <tr>
                            <td valign="top" width="38%">No RM</td>
                            <td valign="top" width="2%">:</td>
                            <td valign="top"><?= htmlspecialchars($no_rm); ?></td>
                        </tr>
                        <tr>
                            <td valign="top">Nama Pasien</td>
                            <td valign="top">:</td>
                            <td valign="top"><?= htmlspecialchars($nama_pasien); ?></td>
                        </tr>
                        <tr>
                            <td valign="top">Tanggal Lahir</td>
                            <td valign="top">:</td>
                            <td valign="top"><?= htmlspecialchars($tanggal_lahir); ?></td>
                        </tr>
                        <tr>
                            <td valign="top">Alamat</td>
                            <td valign="top">:</td>
                            <td valign="top"><?= htmlspecialchars($alamat); ?></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <!-- Document Title Banner (BOLD) -->
        <table class="tbl-borderless" style="width: 100%; margin-bottom: 8px;">
            <tr>
                <td valign="top" class="text-center" style="padding: 4px;">
                    <b style="font-size: 14pt;"><?= $title; ?></b>
                </td>
            </tr>
        </table>

        <!-- Main Outer Box Container (Fluid Page-Break Table) -->
        <table class="main-outer-table">
            <!-- A. ANAMNESIS (BOLD) -->
            <tr>
                <td valign="top">
                    <div style="margin-bottom: 4px;"><b>PENGKAJIAN DOKTER</b></div>
                    <div style="margin-bottom: 4px;"><b>A. ANAMNESIS</b></div>
                    <table class="tbl-borderless" style="width: 100%;">
                        <tr>
                            <td valign="top" width="18%">1. Keluhan Utama</td>
                            <td valign="top" width="2%">:</td>
                            <td valign="top"><?= nl2br(htmlspecialchars($keluhan_utama)); ?></td>
                        </tr>
                        <tr>
                            <td valign="top">2. Riwayat Penyakit</td>
                            <td valign="top">:</td>
                            <td valign="top"><?= nl2br(htmlspecialchars($riwayat_penyakit)); ?></td>
                        </tr>
                    </table>
                </td>
            </tr>

            <!-- B. PEMERIKSAAN FISIK (BOLD) -->
            <tr>
                <td valign="top" style="padding: 0;">
                    <div style="padding: 6px 6px 4px 6px;"><b>B. PEMERIKSAAN FISIK</b></div>
                    <table class="tbl-inner" style="width: 100%; border-left: none; border-right: none; border-bottom: none;">
                        <tr>
                            <td valign="top" width="4%" class="text-center">1</td>
                            <td valign="top" width="20%">Keadaan Umum</td>
                            <td valign="top">
                                <span class="checkbox-box"><?= $keadaan_umum == 'Sehat' ? 'V' : '' ?></span> Sehat &nbsp;&nbsp;&nbsp;&nbsp;
                                <span class="checkbox-box"><?= $keadaan_umum == 'Sakit Ringan' ? 'V' : '' ?></span> Sakit Ringan &nbsp;&nbsp;&nbsp;&nbsp;
                                <span class="checkbox-box"><?= $keadaan_umum == 'Sakit Sedang' ? 'V' : '' ?></span> Sakit Sedang &nbsp;&nbsp;&nbsp;&nbsp;
                                <span class="checkbox-box"><?= $keadaan_umum == 'Sakit Berat' ? 'V' : '' ?></span> Sakit Berat
                            </td>
                        </tr>
                        <tr>
                            <td valign="top" class="text-center">2</td>
                            <td valign="top">Vital Sign</td>
                            <td valign="top">
                                <table class="table-borderless">
                                    <tr>
                                        <td>TD : <?= htmlspecialchars($td); ?> mmHg</td>
                                        <td>N : <?= htmlspecialchars($nadi); ?> x/mnt</td>
                                        <td>S : <?= htmlspecialchars($suhu); ?> °C</td>
                                        <td>TD : <?= htmlspecialchars($td); ?> mmHg</td>
                                    </tr>
                                    <tr>
                                        <td>RR : <?= htmlspecialchars($rr); ?> x/mnt</td>
                                        <td>TB : <?= htmlspecialchars($tb); ?> cm</td>
                                        <td>BB : <?= htmlspecialchars($bb); ?> kg</td>
                                        <td>SpO2 : <?= htmlspecialchars($spo2); ?></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td valign="top" class="text-center">3</td>
                            <td valign="top">Kesadaran</td>
                            <td valign="top">
                                <span class="checkbox-box"><?= $kesadaran == 'CM' ? 'V' : '' ?></span> CM &nbsp;&nbsp;&nbsp;&nbsp;
                                <span class="checkbox-box"><?= $kesadaran == 'Apatis' ? 'V' : '' ?></span> Apatis &nbsp;&nbsp;&nbsp;&nbsp;
                                <span class="checkbox-box"><?= $kesadaran == 'Somnolen' ? 'V' : '' ?></span> Somnolen &nbsp;&nbsp;&nbsp;&nbsp;
                                <span class="checkbox-box"><?= $kesadaran == 'Sopor' ? 'V' : '' ?></span> Sopor &nbsp;&nbsp;&nbsp;&nbsp;
                                <span class="checkbox-box"><?= $kesadaran == 'Koma' ? 'V' : '' ?></span> Koma
                            </td>
                        </tr>
                        <tr>
                            <td valign="top" class="text-center">4</td>
                            <td valign="top">Kepala</td>
                            <td valign="top"><?= htmlspecialchars($kepala); ?></td>
                        </tr>
                        <tr>
                            <td valign="top" class="text-center">5</td>
                            <td valign="top">Thorax</td>
                            <td valign="top"><?= htmlspecialchars($thorax); ?></td>
                        </tr>
                        <tr>
                            <td valign="top" class="text-center">6</td>
                            <td valign="top">Abdomen</td>
                            <td valign="top"><?= htmlspecialchars($abdomen); ?></td>
                        </tr>
                        <tr>
                            <td valign="top" class="text-center">7</td>
                            <td valign="top">Ekstremitas</td>
                            <td valign="top"><?= htmlspecialchars($ekstremitas); ?></td>
                        </tr>
                    </table>
                </td>
            </tr>

            <!-- STATUS LOKALIS -->
            <tr>
                <td valign="top" style="padding: 0;">
                    <div style="padding: 6px 6px 4px 6px;">STATUS LOKALIS</div>
                    <table class="tbl-inner" style="width: 100%; border-left: none; border-right: none; border-bottom: none;">
                        <tr>
                            <td valign="top" width="50%" class="text-center">
                                <?= render_image_canvas(
                                    $base_url . '/images/image-tubuh.png',
                                    $stroke_canvas,
                                    350,
                                    230
                                ) ?>
                            </td>
                            <td valign="top" width="50%">
                                <?= nl2br(htmlspecialchars($catatan_status_lokalis)); ?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <!-- C. HASIL PEMERIKSAAN PENUNJANG (BOLD) -->
            <tr>
                <td valign="top">
                    <div style="margin-bottom: 4px;"><b>C. HASIL PEMERIKSAAN PENUNJANG</b></div>
                    <table class="tbl-borderless" style="width: 100%;">
                        <tr>
                            <td valign="top" width="22%">1. Laboratorium</td>
                            <td valign="top" width="2%">:</td>
                            <td valign="top"><?= nl2br(htmlspecialchars($laboratorium)); ?></td>
                        </tr>
                        <tr>
                            <td valign="top">2. Radiologi</td>
                            <td valign="top">:</td>
                            <td valign="top"><?= nl2br(htmlspecialchars($radiologi)); ?></td>
                        </tr>
                        <tr>
                            <td valign="top">3. Penunjang Lain</td>
                            <td valign="top">:</td>
                            <td valign="top"><?= nl2br(htmlspecialchars($penunjang_lain)); ?></td>
                        </tr>
                    </table>
                </td>
            </tr>

            <!-- D. DIAGNOSIS / ASSESMENT (BOLD) -->
            <tr>
                <td valign="top">
                    <div style="margin-bottom: 4px;"><b>D. DIAGNOSIS / ASSESMENT</b></div>
                    <table class="tbl-borderless" style="width: 100%;">
                        <tr>
                            <td valign="top" width="22%">1. Diagnosis Awal</td>
                            <td valign="top" width="2%">:</td>
                            <td valign="top" width="48%"><?= nl2br(htmlspecialchars($diagnosis_awal)); ?></td>
                            <td valign="top" width="12%">ICD -10 :</td>
                            <td valign="top" width="16%"><?= htmlspecialchars($icd10); ?></td>
                        </tr>
                    </table>
                </td>
            </tr>

            <!-- E. RENCANA (BOLD) -->
            <tr>
                <td valign="top">
                    <div style="margin-bottom: 4px;"><b>E. RENCANA</b></div>
                    <table class="tbl-borderless" style="width: 100%;">
                        <tr>
                            <td valign="top" width="22%">1. Penegakan Diagnosis</td>
                            <td valign="top" width="2%">:</td>
                            <td valign="top"><?= nl2br(htmlspecialchars($penegakan_diagnosis)); ?></td>
                        </tr>
                        <tr>
                            <td valign="top">2. Terapi</td>
                            <td valign="top">:</td>
                            <td valign="top"><?= nl2br(htmlspecialchars($terapi)); ?></td>
                        </tr>
                        <tr>
                            <td valign="top">3. Diet</td>
                            <td valign="top">:</td>
                            <td valign="top"><?= nl2br(htmlspecialchars($diet)); ?></td>
                        </tr>
                        <tr>
                            <td valign="top">4. Edukasi</td>
                            <td valign="top">:</td>
                            <td valign="top"><?= nl2br(htmlspecialchars($edukasi)); ?></td>
                        </tr>
                    </table>
                </td>
            </tr>

            <!-- TINDAK LANJUT & RENCANA ASUHAN MEDIS -->
            <tr>
                <td valign="top">
                    <table class="tbl-borderless" style="width: 100%;">
                        <tr>
                            <td valign="top" width="22%">Tindak lanjut</td>
                            <td valign="top" width="2%">:</td>
                            <td valign="top">
                                <span class="checkbox-box"><?= $tindak_lanjut == 'MRS' ? 'V' : '' ?></span> MRS &nbsp;&nbsp;&nbsp;&nbsp;
                                <?php
                                $ijin_dokter_text = ($tindak_lanjut == 'PULANG / KRS' && $tindak_lanjut_pulang == 'Ijin Dokter')
                                    ? '<span class="circle-text">Ijin Dokter</span>'
                                    : 'Ijin Dokter';
                                $menolak_text = ($tindak_lanjut == 'PULANG / KRS' && $tindak_lanjut_pulang == 'Menolak')
                                    ? '<span class="circle-text">Menolak</span>'
                                    : 'Menolak';
                                ?>
                                <span class="checkbox-box"><?= $tindak_lanjut == 'PULANG / KRS' ? 'V' : '' ?></span> PULANG / KRS : <?= $ijin_dokter_text ?>, <?= $menolak_text ?>
                            </td>
                        </tr>
                        <tr>
                            <td valign="top">Rencana Asuhan Medis</td>
                            <td valign="top">:</td>
                            <td valign="top">
                                <?php
                                $opt_rawat_inap = ($rencana_asuhan_medis == 'Menolak Rawat Inap') ? '<span class="circle-text">Menolak Rawat Inap</span>' : 'Menolak Rawat Inap';
                                $opt_rujuk = ($rencana_asuhan_medis == 'Menolak Rujuk') ? '<span class="circle-text">Menolak Rujuk</span>' : 'Menolak Rujuk';

                                if ($rencana_asuhan_medis == 'Lainnya') {
                                    $opt_lainnya = '<span class="circle-text">' . htmlspecialchars(!empty($rencana_asuhan_medis_lainnya) ? $rencana_asuhan_medis_lainnya : 'Lainnya') . '</span>';
                                } else {
                                    $opt_lainnya = !empty($rencana_asuhan_medis_lainnya) ? htmlspecialchars($rencana_asuhan_medis_lainnya) : '...................................................';
                                }

                                $opt_menghentikan = ($rencana_asuhan_medis == 'Menghentikan Pengobatan') ? '<span class="circle-text">Menghentikan Pengobatan</span>' : 'Menghentikan Pengobatan';
                                $opt_lari = ($rencana_asuhan_medis == 'Lari') ? '<span class="circle-text">Lari</span>' : 'Lari';
                                ?>
                                <?= $opt_rawat_inap ?> / <?= $opt_rujuk ?> / <?= $opt_lainnya ?>, <?= $opt_menghentikan ?>, <?= $opt_lari ?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <!-- DIRUJUK KE -->
            <tr>
                <td valign="top">
                    <table class="tbl-borderless" style="width: 100%;">
                        <tr>
                            <td valign="top" width="22%">Dirujuk ke</td>
                            <td valign="top" width="2%">:</td>
                            <td valign="top">
                                <span class="checkbox-box"><?= $dirujuk_ke == 'Ahli Gizi Klinik' ? 'V' : '' ?></span> Ahli Gizi Klinik &nbsp;&nbsp;&nbsp;&nbsp;
                                <span class="checkbox-box"><?= $dirujuk_ke == 'Rehabilitasi Medik' ? 'V' : '' ?></span> Rehabilitasi Medik
                            </td>
                        </tr>
                        <tr>
                            <td valign="top"></td>
                            <td valign="top">:</td>
                            <td valign="top">
                                <span class="checkbox-box"><?= $dirujuk_ke == 'Klinik Spesialis' ? 'V' : '' ?></span> Klinik Spesialis &nbsp;&nbsp;&nbsp;&nbsp;
                                <span class="checkbox-box"><?= $dirujuk_ke == 'Lainnya' ? 'V' : '' ?></span> Lainnya : <?= htmlspecialchars($dirujuk_ke_lainnya); ?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <!-- TRANSPORTASI PULANG BOX ROW -->
            <tr>
                <td valign="top" style="padding: 0;">
                    <table class="tbl-inner" style="width: 100%; border: none;">
                        <tr>
                            <td valign="top" width="25%">
                                <span class="radio-box"><?= (!empty($transportasi_pulang) && $transportasi_pulang != 'Ambulance' && $transportasi_pulang != 'Kendaraan Pribadi') ? '•' : '' ?></span> Transportasi Pulang
                            </td>
                            <td valign="top" width="25%">
                                <span class="radio-box"><?= $transportasi_pulang == 'Ambulance' ? '•' : '' ?></span> Ambulance
                            </td>
                            <td valign="top" width="25%">
                                <span class="radio-box"><?= $transportasi_pulang == 'Kendaraan Pribadi' ? '•' : '' ?></span> Kendaraan Pribadi
                            </td>
                            <td valign="top" width="25%">
                                <span class="radio-box"><?= ($transportasi_pulang == 'Lainnya' || (!empty($transportasi_pulang_lainnya))) ? '•' : '' ?></span> <?= !empty($transportasi_pulang_lainnya) ? htmlspecialchars($transportasi_pulang_lainnya) : '................' ?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <!-- SIGNATURE BLOCK ROW -->
            <tr>
                <td valign="top" style="border-bottom: none; padding-top: 15px; padding-bottom: 15px;">
                    <table class="tbl-borderless" style="width: 100%;">
                        <tr>
                            <td valign="top" width="55%"></td>
                            <td valign="top" width="45%" class="text-center">
                                <?= htmlspecialchars($kota); ?>, <?= !empty($tanggal_ttd) ? htmlspecialchars($tanggal_ttd) . ', ' : '.............................'; ?> &nbsp;&nbsp; Jam <?= !empty($jam_ttd) ? htmlspecialchars($jam_ttd) . ' WIB' : '...............'; ?><br>
                                Dokter<br>
                                <div style="height: 75px; margin: 5px 0; text-align: center;">
                                    <?php if (!empty($dokter_stroke)): ?>
                                        <img src="<?= $dokter_stroke; ?>" style="max-height: 70px; max-width: 170px;" onerror="this.style.display='none';">
                                    <?php endif; ?>
                                </div>
                                ( <?= htmlspecialchars(!empty($dokter_nama) ? $dokter_nama : '........................................'); ?> )<br>
                                Tanda Tangan&Nama Terang
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>