<?php
// EMR Data
$params = json_decode($argv[1] ?? '{}');

$base_url = $argv[2] ?? ''; // Base_url
$title = "PENGKAJIAN AWAL MEDIS RAWAT INAP BEDAH";
$static_label = json_decode($argv[3] ?? '{}');

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

function render_checkbox($checked = false)
{
    $is_checked = ($checked === true || $checked === 'true' || $checked === 1 || $checked === '1' || $checked === 'Ya');
    $val = $is_checked ? 'V' : '&nbsp;';
    return '<span style="display: inline-block; width: 12px; height: 12px; border: 1px solid black; text-align: center; line-height: 11px; font-size: 8pt; font-weight: bold; vertical-align: middle; margin-right: 2px;">' . $val . '</span>';
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
        font-family: Arial, Helvetica, sans-serif;
        font-size: 9pt;
        line-height: 1.3;
        padding: 5px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    .table-bordered {
        border: 1px solid black;
        border-collapse: collapse;
    }

    .table-bordered th,
    .table-bordered td {
        border: 1px solid black;
        border-collapse: collapse;
        padding: 4px 6px;
        vertical-align: top;
    }

    .table-borderless,
    .table-borderless th,
    .table-borderless td {
        border: none;
        border-collapse: collapse;
        padding: 2px 4px;
        vertical-align: top;
    }

    .bg-gray {
        background-color: #E3E3E3;
    }

    .text-center {
        text-align: center;
    }

    .text-right {
        text-align: right;
    }

    .text-left {
        text-align: left;
    }

    .font-bold {
        font-weight: bold;
    }

    .tanda-tangan {
        width: 100px;
        height: 60px;
        object-fit: contain;
    }

    .pagebreak-avoid {
        page-break-inside: avoid;
    }
</style>

<body>
    <!-- KOP / HEADER -->
    <div style="padding-bottom: 15px;">
        <table style="width: 100%;">
            <tr>
                <td width="15%" style="vertical-align: middle; text-align: center;">
                    <img style="width: 75px;" src="<?= $base_url; ?>/images/rs/LogoRS.png" onerror="this.src='/images/rs/LogoRS.png';">
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
                    <div style="border: 1px solid black; padding: 6px 10px; font-size: 9pt;">
                        <table style="width: 100%;">
                            <tr>
                                <td style="width: 32%; vertical-align: top;">No. RM</td>
                                <td style="width: 3%; vertical-align: top;">:</td>
                                <td style="vertical-align: top;"><?= $params->pasien->no_rm ?? $params->external_link->px_data->no_rm ?? ''; ?></td>
                            </tr>
                            <tr>
                                <td style="vertical-align: top;">Nama</td>
                                <td style="vertical-align: top;">:</td>
                                <td style="vertical-align: top;"><?= $params->pasien->nama_pasien ?? $params->pasien->nama ?? $params->external_link->px_data->nama ?? ''; ?><?= !empty($params->pasien->kelamin ?? $params->external_link->px_data->kelamin) ? ' (' . (strtoupper($params->pasien->kelamin ?? $params->external_link->px_data->kelamin)[0] ?? '') . ')' : ''; ?></td>
                            </tr>
                            <tr>
                                <td style="vertical-align: top;">Tgl Lahir</td>
                                <td style="vertical-align: top;">:</td>
                                <td style="vertical-align: top;"><?= !empty($params->pasien->tgl_lahir_indo) ? $params->pasien->tgl_lahir_indo : (!empty($params->pasien->tgl_lahir) ? tgl_indo($params->pasien->tgl_lahir) : (!empty($params->pasien->tanggal_lahir) ? tgl_indo($params->pasien->tanggal_lahir) : ($params->pasien->tanggal_lahir_indo ?? ($params->external_link->px_data->tanggal_lahir ? tgl_indo($params->external_link->px_data->tanggal_lahir) : '')))); ?></td>
                            </tr>
                            <tr>
                                <td style="vertical-align: top;">NIK</td>
                                <td style="vertical-align: top;">:</td>
                                <td style="vertical-align: top;"><?= $params->pasien->nik ?? $params->external_link->px_data->no_identitas ?? ''; ?></td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
        </table>
    </div>

    <!-- TITLE -->
    <div style="text-align: center; font-weight: bold; font-size: 11pt; margin-bottom: 10px; letter-spacing: 0.5px;">
        PENGKAJIAN AWAL MEDIS RAWAT INAP BEDAH
    </div>

    <!-- MAIN FORM TABLES -->
    <table class="table-bordered" style="width: 100%;">
        <!-- STAF BEDAH: DOKTER OPERATOR, ASISTEN, PERAWAT -->
        <tr>
            <td class="bg-gray text-center font-bold" style="width: 32%;">Dokter Operator</td>
            <td class="bg-gray text-center font-bold" style="width: 36%;">Nama Asisten Bedah</td>
            <td class="bg-gray text-center font-bold" style="width: 32%;">Nama Perawat</td>
        </tr>
        <tr>
            <td style="height: 50px;">
                <?= $params->staf->dokter_operator ?? ''; ?>
            </td>
            <td>
                1. <?= $params->staf->asisten_bedah_1 ?? ''; ?>
                <?= !empty($params->staf->asisten_bedah_2) ? '<br>2. ' . $params->staf->asisten_bedah_2 : ''; ?>
            </td>
            <td>
                <div>Perawat Instrumen &nbsp;: <?= $params->staf->perawat_instrumen ?? ''; ?></div>
                <div style="margin-top: 10px;">Perawat Sirkuler &nbsp;&nbsp;&nbsp;: <?= $params->staf->perawat_sirkuler ?? ''; ?></div>
            </td>
        </tr>
        <!-- STAF ANESTESI -->
        <tr>
            <td class="bg-gray text-center font-bold" colspan="1">Dokter Anestesi</td>
            <td class="bg-gray text-center font-bold" colspan="2">Nama Asisten Anestesi</td>
        </tr>
        <tr>
            <td style="height: 22px;">
                <?= $params->staf->dokter_anestesi ?? ''; ?>
            </td>
            <td colspan="2">
                <?= $params->staf->asisten_anestesi ?? ''; ?>
            </td>
        </tr>
        <!-- JARINGAN & PEMERIKSAAN -->
        <tr>
            <td colspan="2" style="height: 45px;">
                <div class="font-bold">Jaringan yang di eksisi / incisi :</div>
                <div style="margin-top: 3px;"><?= nl2br($params->keterangan->jaringan_eksisi ?? ''); ?></div>
            </td>
            <td>
                <div class="font-bold">Dikirim untuk pemeriksaan :</div>
                <table class="table-borderless" style="width: 100%; margin-top: 2px;">
                    <tr>
                        <td style="padding: 1px 0; width: 55%;">1. Patologi</td>
                        <td style="padding: 1px 0;">
                            <?= render_checkbox(($params->keterangan->dikirim_pato ?? '') === 'Ya'); ?> Ya &nbsp;
                            <?= render_checkbox(($params->keterangan->dikirim_pato ?? '') === 'Tidak'); ?> Tidak
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 1px 0;">2. Laboratorium Klinik</td>
                        <td style="padding: 1px 0;">
                            <?= render_checkbox(($params->keterangan->dikirim_lab ?? '') === 'Ya'); ?> Ya &nbsp;
                            <?= render_checkbox(($params->keterangan->dikirim_lab ?? '') === 'Tidak'); ?> Tidak
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <!-- WAKTU PEMBEDAHAN -->
        <tr>
            <td class="bg-gray text-center font-bold" style="width: 33%;">
                Tanggal<br>Pembedahan
            </td>
            <td class="bg-gray text-center font-bold" style="width: 34%;">
                Pembedahan<br>mulai
            </td>
            <td class="bg-gray text-center font-bold" style="width: 33%;">
                Pembedahan<br>Selesai
            </td>
        </tr>
        <tr>
            <td class="text-center" style="height: 22px;">
                <?= !empty($params->waktu->tgl_bedah_indo) ? $params->waktu->tgl_bedah_indo : (!empty($params->waktu->tgl_bedah) ? tgl_indo($params->waktu->tgl_bedah) : ''); ?>
            </td>
            <td class="text-center">
                <?= !empty($params->waktu->mulai_operasi) ? $params->waktu->mulai_operasi . ' WIB' : ''; ?>
            </td>
            <td class="text-center">
                <?= !empty($params->waktu->selesai_operasi) ? $params->waktu->selesai_operasi . ' WIB' : ''; ?>
            </td>
        </tr>
        <!-- DIAGNOSA PRA BEDAH -->
        <tr>
            <td class="bg-gray font-bold" style="vertical-align: middle;">
                Diagnosa Pra Bedah
            </td>
            <td colspan="2">
                <?= nl2br($params->laporan->diagnosa_pra_bedah_gabungan ?? $params->laporan->diagnosa_pra_isian ?? ''); ?>
            </td>
        </tr>
        <!-- DIAGNOSA PASCA BEDAH -->
        <tr>
            <td class="bg-gray font-bold" style="vertical-align: middle;">
                Diagnosa Pasca Bedah
            </td>
            <td colspan="2">
                <?= nl2br($params->laporan->diagnosa_pasca_bedah_gabungan ?? $params->laporan->diagnosa_pasca_isian ?? ''); ?>
            </td>
        </tr>
    </table>

    <!-- TABLE 3 KOLOM: TINDAKAN, KUALIFIKASI & SEDASI, MACAM OPERASI -->
    <table class="table-bordered" style="width: 100%; border-top: none;">
        <tr>
            <td style="width: 48%; border-top: none;">
                <div class="font-bold" style="margin-bottom: 4px;">Nama / Macam Operasi / Tindakan Pembedahan :</div>
                <div><?= nl2br($params->laporan->tindakan_gabungan ?? $params->laporan->tindakan_pembedahan_isian ?? ''); ?></div>
            </td>
            <td style="width: 25%; border-top: none; padding: 4px;">
                <div class="font-bold" style="margin-bottom: 3px;">Kualifikasi operasi :</div>
                <div style="line-height: 1.5;">
                    <?= render_checkbox($params->laporan->kualifikasi_1->bersih ?? false); ?> Bersih<br>
                    <?= render_checkbox($params->laporan->kualifikasi_1->bersih_tercemar ?? false); ?> Bersih tercemar<br>
                    <?= render_checkbox($params->laporan->kualifikasi_1->tercemar ?? false); ?> Tercemar<br>
                    <?= render_checkbox(($params->laporan->kualifikasi_1->kotor ?? false) || ($params->laporan->kualifikasi_1->infeksius ?? false)); ?> Infeksius
                </div>
                <div style="border-top: 1px solid black; margin: 5px -4px 5px -4px;"></div>
                <div class="font-bold" style="margin-bottom: 3px;">Jenis Sedasi :</div>
                <div style="line-height: 1.5;">
                    <?= render_checkbox($params->laporan->jenis_sedasi->ringan ?? false); ?> Ringan<br>
                    <?= render_checkbox($params->laporan->jenis_sedasi->moderat ?? false); ?> Moderat<br>
                    <?= render_checkbox($params->laporan->jenis_sedasi->dalam ?? false); ?> Dalam
                </div>
            </td>
            <td style="width: 27%; border-top: none; padding: 4px;">
                <div class="font-bold" style="margin-bottom: 3px;">Macam operasi :</div>
                <div style="line-height: 1.5;">
                    <?= render_checkbox($params->laporan->kualifikasi_2->emergency ?? false); ?> Emergency<br>
                    <?= render_checkbox($params->laporan->kualifikasi_2->elektif ?? false); ?> Elektif<br>
                    <?= render_checkbox(($params->laporan->kualifikasi_2->poliklinik ?? false) || ($params->laporan->kualifikasi_2->khusus ?? false)); ?> Khusus<br>
                    <?= render_checkbox($params->laporan->kualifikasi_2->besar ?? false); ?> Besar<br>
                    <?= render_checkbox($params->laporan->kualifikasi_2->sedang ?? false); ?> Sedang<br>
                    <?= render_checkbox($params->laporan->kualifikasi_2->kecil ?? false); ?> Kecil<br>
                    <?= render_checkbox($params->laporan->kualifikasi_2->canggih ?? false); ?> Canggih<br>
                    <?= render_checkbox($params->laporan->kualifikasi_2->lain ?? false); ?> Lainnya<br>
                    <div style="margin-top: 2px; padding-left: 2px;"><?= $params->laporan->kualifikasi_2->lain_isi ?? ''; ?></div>
                </div>
            </td>
        </tr>
    </table>

    <!-- PERDARAHAN, KOMPLIKASI, IMPLAN -->
    <table class="table-bordered" style="width: 100%; border-top: none;">
        <tr>
            <td class="bg-gray text-center font-bold" style="width: 20%; border-top: none;">Jumlah perdarahan</td>
            <td class="bg-gray text-center font-bold" style="width: 52%; border-top: none;">Komplikasi selama operasi</td>
            <td style="width: 28%; border-top: none;">
                <span class="font-bold">Implan :</span> <?= $params->laporan->implan ?? ''; ?>
            </td>
        </tr>
        <tr>
            <td style="height: 20px;">
                <?= !empty($params->laporan->pendarahan) ? $params->laporan->pendarahan . ' cc' : ''; ?>
            </td>
            <td>
                <?= $params->laporan->komplikasi ?? ''; ?>
            </td>
            <td>
                <span class="font-bold">Kode Produk :</span> <?= $params->laporan->kode ?? ''; ?>
            </td>
        </tr>
        <!-- JENIS ANESTESI -->
        <tr>
            <td colspan="3" class="text-center font-bold" style="padding: 3px; font-size: 9.5pt;">
                Jenis Anestesi
            </td>
        </tr>
        <tr>
            <td colspan="3" style="padding: 4px 10px;">
                <table class="table-borderless" style="width: 100%;">
                    <tr>
                        <td style="width: 50%; padding: 0;">
                            <span class="font-bold">GA :</span> &nbsp;&nbsp;
                            <?= render_checkbox($params->laporan->jenis_anestesi->GA->ETT ?? false); ?> ETT &nbsp;&nbsp;&nbsp;&nbsp;
                            <?= render_checkbox($params->laporan->jenis_anestesi->GA->LMA ?? false); ?> LMA &nbsp;&nbsp;&nbsp;&nbsp;
                            <?= render_checkbox($params->laporan->jenis_anestesi->GA->FIMA ?? false); ?> FIMA
                        </td>
                        <td style="width: 50%; padding: 0;">
                            <span class="font-bold">Regional :</span> &nbsp;&nbsp;
                            <?= render_checkbox($params->laporan->jenis_anestesi->Regional->Spinal ?? false); ?> Spinal &nbsp;&nbsp;&nbsp;&nbsp;
                            <?= render_checkbox($params->laporan->jenis_anestesi->Regional->Epidurasi ?? false); ?> Epidurasi &nbsp;&nbsp;&nbsp;&nbsp;
                            <?= render_checkbox($params->laporan->jenis_anestesi->Regional->CSE ?? false); ?> CSE
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <!-- LAPORAN OPERASI -->
        <tr>
            <td colspan="3" style="padding: 6px;">
                <div class="font-bold" style="margin-bottom: 4px;">LAPORAN OPERASI : (jika perlu dapat dilanjutkan di halaman sebaliknya)</div>
                <div style="min-height: 40px; line-height: 1.4;"><?= nl2br($params->laporan_operasi ?? ''); ?></div>
            </td>
        </tr>
        <!-- INSTRUKSI PASCA OPERASI -->
        <tr>
            <td colspan="3" style="padding: 6px;">
                <div class="font-bold" style="margin-bottom: 4px;">Instruksi pasca operasi :</div>
                <div style="min-height: 35px; line-height: 1.4;"><?= nl2br($params->laporan_pasca ?? ''); ?></div>
            </td>
        </tr>
    </table>

    <!-- TANDA TANGAN -->
    <div class="pagebreak-avoid" style="margin-top: 15px;">
        <table style="width: 100%;">
            <tr>
                <td style="width: 55%;"></td>
                <td style="width: 45%; text-align: center;">
                    <div><?= $static_label->hospital_city ?? 'Yogyakarta'; ?>, <?= !empty($params->tgl) ? tgl_indo($params->tgl) : (!empty($params->tgl_indo) ? $params->tgl_indo : ''); ?></div>
                    <div style="margin-top: 2px;">Tanda tangan Dokter Operator</div>
                    <div style="height: 60px; margin: 5px 0;">
                        <?php if (!empty($params->ttd_dokter_stroke) && (strpos($params->ttd_dokter_stroke, 'http') === 0 || strpos($params->ttd_dokter_stroke, 'data:image') === 0)): ?>
                            <img src="<?= $params->ttd_dokter_stroke; ?>" class="tanda-tangan">
                        <?php else: ?>
                            <div style="height: 60px;"></div>
                        <?php endif; ?>
                    </div>
                    <div style="font-weight: bold;"><?= $params->ttd_dokter ?? $params->staf->dokter_operator ?? ''; ?></div>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>