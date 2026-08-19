<?php
// EMR Data
$params = json_decode($argv[1]);

$base_url = $argv[2]; // Base_url
$title = "ASESMEN AWAL MEDIS GIGI UMUM DAN PENYAKIT DALAM";
$static_label = json_decode($argv[3]);
?>
<?php 
$diagnosa_kerja =buildDiagnosisList($params->diagnosa_masuk_freetext ?? '',
    $params->diagnosa_masuk_autocomplete ?? []);

$diagnosa_banding =buildDiagnosisList($params->diagnosa_banding_freetext ?? '',
    $params->diagnosa_banding_autocomplete ?? []);

$diagnosa_sekunder =buildDiagnosisList($params->diagnosa_sekunder_freetext ?? '',
    $params->diagnosa_sekunder_autocomplete ?? []);

function buildDiagnosisList($freetext, $autocomplete =[]) {
    $result =[];

    /* ===============================
                             * FREETEXT
                             * =============================== */
    if ( !empty($freetext)) {
        $lines =preg_split('/\r\n|\r|\n/', $freetext);

        foreach ($lines as $line) {
            // hapus nomor urut "1. xxx"
            $clean =preg_replace('/^\s*\d+\.\s*/', '', trim($line));

            if ($clean !=='') {
                $result[]=$clean;
            }
        }
    }

    /* ===============================
                             * AUTOCOMPLETE
                             * =============================== */
    if ( !empty($autocomplete) && is_iterable($autocomplete)) {
        foreach ($autocomplete as $item) {

            // support object maupun array
            $icd =is_object($item) ? ($item->icd_x ?? ''): ($item['icd_x'] ?? '');
            $nama =is_object($item) ? ($item->nama_sebab_sakit ?? ''): ($item['nama_sebab_sakit'] ?? '');

            if ($icd !=='' || $nama !=='') {
                $result[]=trim($icd . ' - ' . $nama, ' -');
            }
        }
    }

    return $result;
}

?>
<?php
$tindakan = buildTindakanList(
    $params->tindakan_freetext ?? '',
    $params->tindakan_list ?? []
);

function buildTindakanList($freetext, $list = []) {
    $result = [];

    /* ===== FREETEXT ===== */
    if (!empty($freetext)) {
        $lines = preg_split('/\r\n|\r|\n/', $freetext);

        foreach ($lines as $line) {
            $clean = preg_replace('/^\s*\d+\.\s*/', '', trim($line));
            $clean = cleanText($clean);

            if ($clean !== '') {
                $result[] = $clean;
            }
        }
    }

    /* ===== AUTOCOMPLETE ===== */
    if (!empty($list) && is_iterable($list)) {
        foreach ($list as $item) {
            if (!is_object($item)) continue;

            $code = cleanText($item->icd_9_code ?? '');
            $name = cleanText($item->icd_9_name ?? '');
            $layanan = cleanText($item->nama_layanan ?? '');

            // if (!empty($item->icd_9_name)) {
            //     $name = cleanText($item->icd_9_name);
            // } elseif (!empty($item->nama_layanan)) {
            //     $name = cleanText($item->nama_layanan);
            // }

            if ($layanan !== '' && $code !== '' && $name !== '') {
                $result[] = "$layanan | ICD 9 : $code - $name";
            } elseif ($layanan !== '') {
                $result[] = "$layanan | ICD 9 : -" ;
            }
        }
    }

    return $result;
}

function cleanText($text) {
    if ($text === null) return '';

    // 1. Hapus semua HTML tag
    $text = strip_tags($text);

    // 2. Decode HTML entities (&nbsp; dll)
    $text = html_entity_decode($text, ENT_QUOTES | ENT_HTML5, 'UTF-8');

    // 3. Normalisasi spasi
    $text = preg_replace('/\s+/', ' ', $text);

    return trim($text);
}

?>
<?php
function tanggal_indo($tanggal) {
    if (empty($tanggal)) return '';

    $bulan = [
        1 => 'Januari', 'Februari', 'Maret', 'April',
        'Mei', 'Juni', 'Juli', 'Agustus',
        'September', 'Oktober', 'November', 'Desember'
    ];

    $pecah = explode('-', $tanggal);

    if (count($pecah) !== 3) return $tanggal;

    return ltrim($pecah[2], '0') . ' ' . $bulan[(int)$pecah[1]] . ' ' . $pecah[0];
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
        height: 15px;
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
        object-fit: contain; /* atau contain tergantung kebutuhan */
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
    .div-table {
        display: table;
        width: 100%;
        border-collapse: collapse;
    }
    
    .div-row {
        display: table-row;
    }
    
    .div-cell {
        display: table-cell;
        vertical-align: top;
        padding: 2px 4px;
    }
    
    /* Optional helper */
    .div-cell-center {
        vertical-align: middle;
    }
    
    .div-cell-bold {
        font-weight: bold;
    }
    
    .div-cell-colon {
        width: 10px;
        text-align: center;
    }

    .border {
        border: 1px solid gray;
    }
    .border-tb {
        border-top: 1px solid gray;
        border-bottom: 1px solid gray;
    }
    .border-t {
        border-top: 1px solid gray;
        padding-top:0.5rem;
    }
    .tb-full {
        width: 100%;
        height: auto;
        margin: 0 !important;
        padding: 0 !important;
        font-size: 1.2rem;
    }
    .tb-full-coop {
        width: 100%;
        height: auto;
        margin: 0 !important;
        padding: 0 !important;
        font-size: 1rem;
    }
    .text-center  {
        text-align: center;
    }
    .font-sm {
        font-size: 1rem;
    }
    .sebaris {
        display: table;
        white-space: nowrap;
    }
    
    .sebaris > * {
        display: table-cell;
        vertical-align: middle;
        padding-right: 6px;
    }
    .v-align {
        vertical-align: top;
    }
    .bold {
        font-weight: bold;
    }
</style>

<body>
    <table class="tb-full">
        <tr>
            <td style="text-align: end; font-size: 1.2rem;"><b>RM 02.1</b></td>
        </tr>
    </table>
    <div class="border">
        <table class="tb-full-coop">
            <tr>
                <td width="20%" style="padding-left: 1%;"><img src="<?php echo $base_url . '/images/rs/LogoRS.png'?>" width="80px" height="80px" /></td>
                <td width="70%" class="text-center">
                    <b>
                        <?php echo $static_label->hospital_agency; ?>
                    </b>
                    <br />
                    <b>
                        <?php echo $static_label->hospital_name; ?>
                    </b>
                    <br />
                    <span class="font-sm">
                        <?php echo $static_label->hospital_address; ?>
                    </span>
                    <br />
                    <span style="white-space: nowrap;" class="font-sm">
                        Email : <?php echo $static_label->hospital_email;?> Website : http://rsgmsoelastri.umsac.id/
                    </span>
    
                </td>
                <td width="10%" style="border-left: 1px solid gray; padding-left: 1%;padding-right: 0.5%;">
                    <!--<p  style="width: 250px; height: 100px; display: table-cell; text-align: center; vertical-align: middle;" class="border font-sm">Label Identitas Pasien</p>-->
                    <table class="tb-full-coop" style="width: 300px; height: 100px;">
                        <tr>
                            <td width="100px">No. RM</td>
                            <td width="2px">:</td>
                            <td><?php echo $params->pasien->no_rm; ?></td>
                        </tr>
                        <tr>
                            <td>Nama</td>
                            <td>:</td>
                            <td><?php echo $params->pasien->nama?></td>
                        </tr>
                        <tr>
                            <td>Tanggal Lahir</td>
                            <td>:</td>
                            <td><?php echo $params->pasien->tanggal_lahir_indo?></td>
                        </tr>
                        <tr>
                            <td>Umur</td>
                            <td>:</td>
                            <td><?php echo $params->pasien->umur?> Tahun</td>
                        </tr>
                        <tr>
                            <td>Kelamin</td>
                            <td>:</td>
                            <td><?php echo $params->pasien->kelamin?></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <table class="tb-full border-tb">
            <tr>
                <td class="text-center bold" style="background: rgba(0, 0, 0, 0.25); font-size: 1.2rem">ASESSMEN AWAL MEDIS UMUM</td>
            </tr>
        </table>
        <table class="tb-full">
            <tr>
                <td width="50%" style="padding-left: 1rem;">
                    <div class="sebaris">
                        <p>Tanggal</p>
                        <p>:</p>
                        <p><?php echo $params->datang->tanggal_indo; ?></p>
                    </div>
                </td>
                <td width="50%">
                    <div class="sebaris">
                        <p>Waktu</p>
                        <p>:</p>
                        <p><?php echo $params->datang->waktu; ?> WIB</p>
                    </div>
                </td>
            </tr>
        </table>
        <table class="tb-full border-t">
            <tr>
                <td width="100%" style="padding-left: 1rem;">
                    Sumber Data :
                    <?= $params->sumber_data->sumber->autoanam === 'Ya'? '☑' : '☐'  ?>Autoanamnesis
                    &nbsp;&nbsp;
                    <?= $params->sumber_data->sumber->alloanam === 'Ya'? '☑' : '☐'  ?>Alloanamnesis,
                    &nbsp;&nbsp;
                    Dengan : <?= empty($params->sumber_data->dengan) ? '.................' : $params->sumber_data->dengan ?>
                    Hubungan dengan pasien : <?= empty($params->sumber_data->hubungan) ? '.................' : $params->sumber_data->hubungan ?>
                </td>
            </tr>
            <tr>
                <td style="padding-left: 1rem;">
                    Riwayat Alergi : <?= empty($params->sumber_data->riwayat) ? '.................' : $params->sumber_data->riwayat ?>
                </td>
            </tr>
        </table>
        <table class="tb-full border-t">
            <tr>
                <td class="v-align" width="300px" style="font-weight: bold; padding-left: 0.5rem;">1. KELUHAN UTAMA</td>
                <td class="v-align" width="2px">:</td>
                <td class="v-align"><?= $params->data->vital_sign->keluhan_utama ?></td>
            </tr>
            <tr>
                <td class="v-align" style="font-weight: bold; padding-left: 0.5rem;">2. RIWAYAT PENYAKIT SEKARANG</td>
                <td class="v-align">:</td>
                <td class="v-align"><?= $params->data->vital_sign->anamnesis ?></td>
            </tr>
            <tr>
                <td class="v-align" style="font-weight: bold; padding-left: 0.5rem;">3. ALLOANAMNESA</td>
                <td class="v-align">:</td>
                <td class="v-align"><?= $params->data->alloanamnesia ?></td>
            </tr>
            <tr>
                <td class="v-align" style="font-weight: bold; padding-left: 0.5rem;">4. RIWAYAT PENYAKIT DAHULU</td>
                <td class="v-align">:</td>
                <td class="v-align"><?= $params->data->riwayat_dahulu ?></td>
            </tr>
            <tr>
                <td class="v-align" style="font-weight: bold; padding-left: 0.5rem;">5. RIWAYAT PENGGUNAAN OBAT</td>
                <td class="v-align">:</td>
                <td class="v-align"><?= $params->data->riwayat_obat ?></td>
            </tr>
        </table>
        <table class="tb-full">
            <tr>
                <td class="v-align" width="300px" style="font-weight: bold; padding-left: 0.5rem;">6. PEMERIKSAAN FISIK</td>
                <td class="v-align"></td>
                <td class="v-align"></td>
            </tr>
            <tr>
                <td style="padding-left: 1.5rem;">
                    <table class="tb-full">
                        <tr>
                            <td class="bold" width="180px">A. Keadaan Umum</td>
                            <td width="2px">:</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td  style="padding-left: 2rem;">Kesadaran</td>
                            <td>:</td>
                            <td><?php echo $params->data->fisik->kesadaran ?></td>
                        </tr>
                    </table>
                    <table class="tb-full">
                        <tr>
                            <td class="bold" width="180px">B. Status General</td>
                            <td width="2px">:</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td  style="padding-left: 2rem;">1) Kepala</td>
                            <td>:</td>
                            <td><?php echo $params->data->fisik->kepala ?></td>
                        </tr>
                        <tr>
                            <td  style="padding-left: 2rem;">2) Leher</td>
                            <td>:</td>
                            <td><?php echo $params->data->fisik->leher ?></td>
                        </tr>
                        <tr>
                            <td  style="padding-left: 2rem;">3) Thorax</td>
                            <td>:</td>
                            <td><?php echo $params->data->fisik->thorax ?></td>
                        </tr>
                        <tr>
                            <td  style="padding-left: 2rem;">4) Abdomen</td>
                            <td>:</td>
                            <td><?php echo $params->data->fisik->abdomen ?></td>
                        </tr>
                        <tr>
                            <td  style="padding-left: 2rem;">5) Genitalia</td>
                            <td>:</td>
                            <td><?php echo $params->data->fisik->genitalia ?></td>
                        </tr>
                        <tr>
                            <td  style="padding-left: 2rem;">6) Extremitas atas</td>
                            <td>:</td>
                            <td><?php echo $params->data->fisik->extremitas_atas ?></td>
                        </tr>
                        <tr>
                            <td  style="padding-left: 2rem;">7) Extremitas bawah</td>
                            <td>:</td>
                            <td><?php echo $params->data->fisik->extremitas_bawah ?></td>
                        </tr>
                    </table>
                    <table class="tb-full">
                        <tr>
                            <td class="bold" width="100%">C. Status Lokalis</td>
                        </tr>
                        <tr>
                            <td style="padding-left: 2rem;">
                                <table class="tb-full">
                                    <tr>
                                        <td style="border: 1px solid gray;" width="50%">
                                            <img src="<?= $params->image_canvas->canvas1->image_base64 ?>" width="300px" height="250px" />
                                        </td>
                                        <td style="border: 1px solid gray;" width="50%">
                                            <img src="<?= $params->image_canvas->canvas2->image_base64 ?>" width="300px" height="250px" />
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <table class="tb-full">
            <tr>
                <td class="v-aling" style="font-weight: bold; padding-left: 0.5rem;">7. HASIL PEMERIKSAAN PENUNJANG</td>
            </tr>
            <tr>
                <td style="padding-left: 1.5rem;">
                    <table class="tb-full">
                        <tr>
                            <td class="pl-1 v-align" width="120px">a. Laboratorium</td>
                            <td width="2px" class="v-align">:</td>
                            <td class="v-align">
                            <?php
                            $text = trim($params->laboratorium_freetext);
                            
                            // pecah per blok (double enter)
                            $blocks = preg_split("/\n\s*\n/", $text);
                            
                            foreach ($blocks as $block) {
                                $lines = array_filter(array_map('trim', explode("\n", $block)));
                            
                                if (empty($lines)) continue;
                            
                                // Judul (baris pertama diawali "-")
                                if (isset($lines[0]) && strpos($lines[0], '-') === 0) {
                                    echo "<div><b>" . ltrim($lines[0], '- ') . "</b></div>";
                                    array_shift($lines);
                                }
                            
                                // Cek apakah isinya bernomor
                                $isNumbered = isset($lines[0]) && preg_match('/^\d+\./', $lines[0]);
                            
                                if ($isNumbered) {
                                    echo "<ol style='margin:4px 0 8px 18px; padding-left: 15px'>";
                                    foreach ($lines as $line) {
                            
                                        // hapus nomor bawaan "1. "
                                        $cleanLine = preg_replace('/^\d+\.\s*/', '', $line);
                            
                                        echo "<li>" . htmlspecialchars($cleanLine) . "</li>";
                                    }
                                    echo "</ol>";
                                } else {
                                    foreach ($lines as $line) {
                                        echo "<div style='margin-left:12px'>" . htmlspecialchars($line) . "</div>";
                                    }
                                }
                            }
                            ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="pl-1 v-align" width="120px">b. Radiologi</td>
                            <td width="2px" class="v-align">:</td>
                            <td class="v-align">
                            <?php
                            $text = trim($params->radiologi_freetext ?? '');
                            
                            if ($text === '') {
                                echo '<i></i>';
                            } else {
                                $blocks = preg_split("/\n\s*\n/", $text);
                            
                                foreach ($blocks as $block) {
                                    $lines = array_filter(array_map('trim', explode("\n", $block)));
                            
                                    if (empty($lines)) continue;
                            
                                    if (isset($lines[0]) && strpos($lines[0], '-') === 0) {
                                        echo "<div><b>" . ltrim($lines[0], '- ') . "</b></div>";
                                        array_shift($lines);
                                    }
                            
                                    $isNumbered = isset($lines[0]) && preg_match('/^\d+\./', $lines[0]);
                            
                                    if ($isNumbered) {
                                        echo "<ol style='margin:4px 0 8px 18px; padding:0'>";
                                        foreach ($lines as $line) {
                                            $cleanLine = preg_replace('/^\d+\.\s*/', '', $line);
                                            echo "<li>" . htmlspecialchars($cleanLine) . "</li>";
                                        }
                                        echo "</ol>";
                                    } else {
                                        foreach ($lines as $line) {
                                            echo "<div style='margin-left:12px'>" . htmlspecialchars($line) . "</div>";
                                        }
                                    }
                                }
                            }
                            ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="pl-1 v-align" width="120px">c. EKG</td>
                            <td width="2px" class="v-align">:</td>
                            <td class="v-align"><?php echo $params->pemeriksaan->ekg ?></td>
                        </tr>
                        <tr>
                            <td class="pl-1 v-align" width="120px">d. Lain-lainnya</td>
                            <td width="2px" class="v-align">:</td>
                            <td class="v-align"><?php echo $params->pemeriksaan->lainnya ?></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <table class="tb-full">
            <tr>
                <td class="v-align" style="font-weight: bold; padding-left: 0.5rem;">8. DIAGNOSIST</td>
                <td class="v-align">:</td>
                <td class="v-align"></td>
            </tr>
        </table>
        <table class="tb-full">
            <tr>
                <td width="150px" class="v-align" style="padding-left:1.5rem;">Diagnosis Kerja</td>
                <td width="2px" class="v-align">:</td>
                <td class="pl-2 v-align">
                    <?php if (!empty($diagnosa_kerja)): ?>
                        <ol style="padding-left:20px; margin:0;">
                            <?php foreach ($diagnosa_kerja as $item): ?>
                                <li><?= htmlspecialchars($item) ?></li>
                            <?php endforeach; ?>
                        </ol>
                    <?php else: ?>
                        <span style="display:inline-block; min-height:20px;">&nbsp;</span>
                    <?php endif; ?>
                </td>
            </tr>
            <tr>
                <td class="v-align" style="padding-left:1.5rem;">Diagnosa Banding</td>
                <td class="v-align">:</td>
                <td class="pl-2 v-align">
                    <?php if (!empty($diagnosa_banding)): ?>
                        <ol style="padding-left:20px; margin:0;">
                            <?php foreach ($diagnosa_banding as $item): ?>
                                <li><?= htmlspecialchars($item) ?></li>
                            <?php endforeach; ?>
                        </ol>
                    <?php else: ?>
                        <span style="display:inline-block; min-height:20px;">&nbsp;</span>
                    <?php endif; ?>
                </td>
            </tr>
            <tr>
                <td class="v-align" style="padding-left:1.5rem;">Diagnosa Tambahan</td>
                <td class="v-align">:</td>
                <td class="pl-2 v-align">
                    <?php if (!empty($diagnosa_sekunder)): ?>
                        <ol style="padding-left:20px; margin:0;">
                            <?php foreach ($diagnosa_sekunder as $item): ?>
                                <li><?= htmlspecialchars($item) ?></li>
                            <?php endforeach; ?>
                        </ol>
                    <?php else: ?>
                        <span style="display:inline-block; min-height:20px;">&nbsp;</span>
                    <?php endif; ?>
                </td>
            </tr>
        </table>
        <table class="tb-full">
            <tr>
                <td class="v-align" style="font-weight: bold; padding-left: 0.5rem;"  width="300px">9. MASALAH MEDIS</td>
                <td class="v-align"  width="2px" >:</td>
                <td class="v-align"><?= $params->masalah_medis ?></td>
            </tr>
            <tr>
                <td class="v-align" style="font-weight: bold; padding-left: 0.5rem;">10. MASALAH KEPERAWATAN</td>
                <td class="v-align">:</td>
                <td class="v-align"><?= $params->masalah_keperawatan ?></td>
            </tr>
            <tr>
                <td class="v-align" style="font-weight: bold; padding-left: 0.5rem;">11. SASARAN</td>
                <td class="v-align">:</td>
                <td class="v-align"><?= $params->sasaran ?></td>
            </tr>
        </table>
        <table class="tb-full">
            <tr>
                <td class="v-align" style="font-weight: bold; padding-left: 0.5rem;">12. RENCANA ASUHAN / TERAPI / INSTRUKSI (standing order):</td>
            </tr>
            <tr>
                <td class="v-align" style="padding-left: 1.5rem;">
                    <table class="tb-full">
                        <tr>
                            <td style="padding-left: 1rem;">
                                <?php if (!empty($tindakan)): ?>
                                    <ol style="padding-left:20px; margin:0;">
                                        <?php foreach ($tindakan as $item): ?>
                                            <li><?= htmlspecialchars($item) ?></li>
                                        <?php endforeach; ?>
                                    </ol>
                                <?php else: ?>
                                    <span style="display:inline-block; min-height:20px;">&nbsp;</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <table class="tb-full">
            <tr>
                <td class="v-align bold" style="padding-left: 0.5rem;">13. RENCANA PEMULANGAN DAN TINDAK LANJUT PERAWATAN PASIEN</td>
            </tr>
        </table>
        <table class="tb-full">
            <tr>
                <td style="padding-left: 1.5rem; padding-right: 1rem;">
                    <table class="tb-full border">
                        <tr>
                            <td width="30%">
                                <?= $params->rencana->rajal === 'Ya'? '☑' : '☐'  ?>Rawat Jalan
                                <br />
                                <?= $params->rencana->ranap === 'Ya'? '☑' : '☐'  ?>Rawat Inap
                                <br />
                                <!--<?= $params->rencana->dokter_ranap === 'Ya'? '☑' : '☐'  ?>DPJP Rawat Inap :-->
                                <span style="margin-left: 1rem;">DPJP Rawat Inap :</span>
                                <br />
                                <div style="text-align:center; line-height:1.2;">
                                    <img
                                        src="<?= $params->rencana->dokter_ranap_stroke ?>"
                                        width="50"
                                        height="50"
                                        style="display:block; margin:4px auto;"
                                    />
                                
                                    <span style="display:block; margin-top:2px;">
                                        <?php echo $params->rencana->dokter_ranap ?>
                                    </span>
                                </div>
                                
                                <br />
                                <span>Rujuk ke:</span>
                                <br />
                                <?php
                                $isChecked = ($params->rencana->rujuk->dokter_check ?? '') === 'Ya';
                                ?>
                                
                                <?= $isChecked ? '☑' : '☐' ?> Dokter Spesialis
                                <?php if ($isChecked): ?>
                                    <?= htmlspecialchars($params->rencana->rujuk->dokter ?? '') ?>
                                <?php endif; ?>

                                <br />
                                <?= $params->rencana->rujuk->rs_check === 'Ya'? '☑' : '☐'  ?>RS
                                <?php echo $params->rencana->rujuk->rs; ?>
                                <br />
                                <?= $params->rencana->rujuk->puskesmas_check === 'Ya'? '☑' : '☐'  ?>Puskesmas
                                <?php echo $params->rencana->rujuk->puskesmas; ?>
                                <br />
                                <?= $params->rencana->rujuk->dokter_keluarga === 'Ya'? '☑' : '☐'  ?>Dokter Keluarga
                                <br />
                                <?= $params->rencana->rujuk->homecare === 'Ya'? '☑' : '☐'  ?>Homecare
                                <br />
                            </td>
                            <td width="25%" style="vertical-align: middle; border: 1px solid gray;">
                                <table class="tb-full" style="height:100%;">
                                    <tr>
                                        <td height="50px" style="vertical-align: middle;">
                                            Ruang :
                                            <?= $params->rencana->ruang->bangsal ?>
                                            <?= $params->rencana->ruang->ruang ?>
                                            <?= $params->rencana->ruang->kelas ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td height="50px" style="vertical-align: middle;">
                                            Kontrol Klinik / Homecare di :
                                            <br><?= $params->rencana->kontrol_klinik ?>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td width="25%" style="vertical-align: middle; border: 1px solid gray;">
                                <table class="tb-full" style="height:100%;">
                                    <tr>
                                        <td height="50px" style="vertical-align: middle;">
                                            Indikasi
                                            <br /><?= $params->rencana->indikasi?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td height="50px" style="vertical-align: middle;">
                                            Tanggal :
                                            <br><?= $params->rencana->tanggal_indo ?>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <table class="tb-full">
            <tr>
                <td class="v-aling bold" style="padding-left: 0.5rem;">14. EDUKASI PASIEN ( Edukasi awal, disampaikan tentang dignosis, rencana dan tujuan terapi ) :</td>
            </tr>
        </table>
        <table class="tb-full">
            <tr>
                <td style="padding-left: 1.5rem; padding-right: 1rem;">
                    <table class="tb-full border">
                        <tr>
                            <td class="v-align" style="height: 50px;">
                                Edukasi :
                                <?= $params->edukasi->edukasi ?? "" ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="v-align">
                                Edukasi Awal, disampaikan kepada :
                            </td>
                        </tr>
                        <tr>
                            <td class="v-align">
                                <?= $params->edukasi->target->target->pasien === 'Ya'? '☑' : '☐'  ?>Pasien
                            </td>
                        </tr>
                        <tr>
                            <td class="v-align">
                                <?= $params->edukasi->target->target->keluarga_pasien === 'Ya' ? '☑' : '☐' ?>
                                Keluarga Pasien, nama :
                                <span style="display:inline-block; width:100px;">
                                    <?= $params->edukasi->target->k_pasien_nama ?? '' ?>
                                </span>,
                                Hubungan dengan pasien :
                                <?= $params->edukasi->target->k_pasien_hubungan ?? "" ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="v-align">
                                <?= $params->edukasi->target->tidak_dapat === 'Ya'? '☑' : '☐'  ?>
                                Tidak dapat memberi edukasi kepada pasien atau keluarga, karena :
                                <?= $params->edukasi->target->karena ?? "" ?>
                            </td>
                        </tr>

                    </table>
                </td>
            </tr>
        </table>
        <table style="width:100%; margin-top:40px; border-collapse:collapse; font-size: 1.2rem;">
            <tr>
                <!-- KIRI -->
                <td width="50%" style="text-align:center; vertical-align:top;">
                    <div style="height:30px;">Dokter</div>
        
                    <div style="height:20px;"></div>
        
                    <div style="
                        height:120px;
                        width:120px;
                        margin:0 auto;
                        display:table;
                    ">
                        <?php if (!empty($params->ttd_data->dokter_stroke)): ?>
                            <img
                                src="<?= $params->ttd_data->dokter_stroke ?>"
                                width="100"
                                height="100"
                                style="display:block; margin:auto;"
                            >
                        <?php endif; ?>
                    </div>
        
                    <div style="height:22px; line-height:22px;">
                        <?php if (!empty($params->ttd_data->dokter)): ?>
                            <?= $params->ttd_data->dokter ?>
                        <?php else: ?>
                            (............................................................)
                        <?php endif; ?>
                    </div>
        
                    <div style="height:18px; font-size:16px;">
                        <?= empty($params->ttd_data->dokter)
                            ? 'Tanda Tangan dan Nama Terang'
                            : '&nbsp;' ?>
                    </div>
                </td>
        
                <!-- KANAN -->
                <td width="50%" style="text-align:center; vertical-align:top;">
                   <span> <?= $static_label->hospital_city ?>, <?= $params->ttd_data->tanggal_indo ?>, Jam : <?= $params->ttd_data->jam ?> </span>
                    <div style="height:30px;">Pasien / Penerima Penjelasan</div>
        
                    <div style="height:20px;"></div>
        
                    <div style="
                        height:120px;
                        width:120px;
                        margin:0 auto;
                        display:table;
                    ">
                        <?php if (!empty($params->ttd_data->pasien_stroke)): ?>
                            <img
                                src="<?= $params->ttd_data->pasien_stroke ?>"
                                width="100"
                                height="100"
                                style="display:block; margin:auto;"
                            >
                        <?php endif; ?>
                    </div>
        
                    <div style="height:22px; line-height:22px;">
                        <?php if (!empty($params->ttd_data->pasien)): ?>
                            <?= $params->ttd_data->pasien ?>
                        <?php else: ?>
                            (............................................................)
                        <?php endif; ?>
                    </div>
        
                    <div style="height:18px; font-size:16px;">
                        <?= empty($params->ttd_data->pasien)
                            ? 'Tanda Tangan dan Nama Terang'
                            : '&nbsp;' ?>
                    </div>
                </td>
            </tr>
        </table>
    </div>
    <div style="font-size: 1rem; font-family:Segoe UI, Arial, sans-serif;">
        <table style="width:100%; border-collapse:collapse;">
            <tr>
                <!-- KIRI -->
                <td style="width:70%; vertical-align:top; padding:2px 0;">
                    <table style="width:100%; border-collapse:collapse;">
                        <tr>
                            <td style="padding:2px 0;">
                                <i><b>*Coret yang tidak perlu</b></i>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding:2px 0;">
                                Beri tanda ( <span style="font-weight:bold;">✓</span> ) 
                                pada kotak ( <span style="font-weight:bold;">☐</span> ) 
                                sesuai pilihan
                            </td>
                        </tr>
                    </table>
                </td>
    
                <!-- KANAN -->
                <td style="width:30%; vertical-align:top; text-align:right; padding:2px 0; font-weight: bold;">
                    Revisi 0/VIII/2020
                </td>
            </tr>
        </table>
    </div>
</body>

</html>