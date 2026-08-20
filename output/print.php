<?php
// EMR Data
$params = json_decode($argv[1]);

$base_url = $argv[2]; // Base_url
$title = "ASESMEN AWAL MEDIS GIGI UMUM IGD";
$static_label = json_decode($argv[3]);

?>
<?php
function showValue($value, $length = 4) {
    if (!empty($value)) {
        return $value;
    }
    // garis bawah untuk ditulis manual
    return str_repeat('.....', $length);
}
?>
<?php
function cb($val) {
    return (!empty($val) && $val) ? '☑' : '☐';
}

function textValue($val, $width = 120) {
    if (!empty($val)) {
        return '<span style="border-bottom:1px dotted black; min-width:'.$width.'px; display:inline-block;">'
            . htmlspecialchars($val) .
            '</span>';
    }
    return '<span class="dot-line"></span>';
}
?>
<?php
function buildDiagnosisList($freetext, $autocomplete = []) {
    $result = [];

    if (!empty($freetext)) {
        foreach (preg_split('/\r\n|\r|\n/', $freetext) as $line) {
            $clean = preg_replace('/^\s*\d+\.\s*/', '', trim($line));
            if ($clean !== '') $result[] = $clean;
        }
    }

    if (!empty($autocomplete) && is_iterable($autocomplete)) {
        foreach ($autocomplete as $item) {
            $icd  = is_object($item) ? ($item->icd_x ?? '') : ($item['icd_x'] ?? '');
            $nama = is_object($item) ? ($item->nama_sebab_sakit ?? '') : ($item['nama_sebab_sakit'] ?? '');
            if ($icd || $nama) $result[] = trim("$icd - $nama", ' -');
        }
    }

    return $result;
}

$params = json_decode($argv[1]);

$diagnosa_kerja = buildDiagnosisList(
    $params->diagnosa_masuk_freetext ?? '',
    $params->diagnosa_masuk_autocomplete ?? []
);

$diagnosa_banding = buildDiagnosisList(
    $params->diagnosa_banding_freetext ?? '',
    $params->diagnosa_banding_autocomplete ?? []
);

$diagnosa_sekunder = buildDiagnosisList(
    $params->diagnosa_sekunder_freetext ?? '',
    $params->diagnosa_sekunder_autocomplete ?? []
);

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

    /*td {*/
    /*    height: 25px;*/
    /*}*/

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
</style>
<style>
    .tb-full {
        width: 100%;
        margin: 0;
        padding: 0;
        font-size:1rem;
    }
    .tb-full tr, td, {
        line-height: 0.8rem;
    }
    .text-center {
        text-align: center;
    }
    .font-sm {
        font-size: 0.8rem;
    }
    .border {
        border:1px solid gray;
    }
    .pl-05 {
        padding-left: 0.5rem;
    }
    .pl-1 {
        padding-left: 1rem;
    }
    .pl-2 {
        padding-left: 2rem;
    }
    .pr-5 {
        padding-right: 2.5rem;
    }
    .border-y {
        border-top: 1px solid gray;
        border-bottom: 1px solid gray;
    }
    .v-align {
        vertical-align: top;
    }
    .data-label {
        font-weight: bold;
        font-size: 1rem;
        padding-left: 1rem;
    }
    .gcs-item {
      display: inline-block;
      margin-right: 10px;   /* jarak antar E V M */
    }
    
    .gcs-value {
      min-width: 18px;      /* jaga jarak walau kosong */
      display: inline-block;
      text-align: center;
      font-weight: 600;
    }
    .kesadaran-item {
      display: inline-block;
      margin-right: 16px; /* jarak antar opsi */
      white-space: nowrap;
    }
    
    .kesadaran-check {
      display: inline-block;
      width: 18px;       /* jaga posisi checkbox */
      text-align: center;
      margin-right: 2px;
    }
    
    .kesadaran-text {
      font-size: 14px;
    }
    .vital-inline {
      white-space: nowrap; /* paksa satu baris */
    }
    
    .vital-item {
      display: inline-block;
      margin-right: 14px; /* jarak antar parameter */
    }
    
    .vital-value {
      display: inline-block;
      min-width: 24px; /* biar gak nempel kalau kosong */
      text-align: center;
    }
    .akral-wrapper {
        display: flex;
        justify-content: space-between;
        align-items: center;
        width: 100%;
        flex-wrap: nowrap;   /* 🔥 penting */
    }
    
    .akral-item {
        width: 48%;
        text-align: center;
    }
    
    
    .akral-label {
        display: block;
        font-size: 13px;
        margin-bottom: 6px;
    }
    
    .akral-img {
        width: 50px;
        height: 50px;
        object-fit: contain;
        border: 1px solid #ccc;
    }

</style>
<style>
.status-table {
    width: 100%;
    border: 1px solid black;
    border-collapse: collapse;
    font-size: 0.9rem;
}

.status-table td {
    vertical-align: top;
    padding: 6px;
}

.status-item {
    white-space: nowrap;
    margin-bottom: 4px;
}

.checkbox {
    display: inline-block;
    width: 12px;
    height: 12px;
    border: 1px solid black;
}

.dot-line {
    display: inline-block;
    border-bottom: 1px dotted black;
    width: 120px;
    height: 12px;
    vertical-align: bottom;
}

.plus-box {
    display: inline-block;
    width: 18px;
    height: 18px;
    border: 1px solid black;
    position: relative;
}

.plus-box:before,
.plus-box:after {
    content: '';
    position: absolute;
    background: black;
}

.plus-box:before {
    top: 50%;
    left: 2px;
    right: 2px;
    height: 1px;
}

.plus-box:after {
    left: 50%;
    top: 2px;
    bottom: 2px;
    width: 1px;
}
.border-rf {
    border-left: 1px solid gray;
    border-right: 1px solid gray;
}
.ttd-title {
    height: 30px;
}

.ttd-space {
    height: 20px;
}

.ttd-line {
    height: 120px;           /* tinggi QR disamakan */
    width: 120px;
    margin: 0 auto;
    display: table;
}

.ttd-line img {
    display: block;
    margin: auto;
}

.ttd-label {
    height: 22px;            /* nama sejajar */
    line-height: 22px;
}

.ttd-sub-label {
    height: 18px;            /* teks bawah sejajar */
    font-size: 12px;
}

</style>

<body>
    <table class="tb-full">
        <tr>
            <td style="text-align: end; font-size: 0.8rem;"><b>RM. 04.2</b></td>
        </tr>
    </table>
    <div class="border">
        <table class="tb-full">
            <tr>
                <td width="20%" style="padding-left: 1%;"><img src="<?php echo $base_url . '/images/rs/LogoRS.png'?>" width="80px" height="80px" /></td>
                <td width="50%" class=" font-sm">
                    <b>
                        <?php echo $static_label->hospital_agency; ?>
                    </b>
                    <br />
                    <b>
                        <?php echo $static_label->hospital_name; ?>
                    </b>
                    <br />
                    <?php echo $static_label->hospital_address; ?>
                    <br />
                    Email : <?php echo $static_label->hospital_email;?> <br /> Website : http://rsgmsoelastri.umsac.id/
                </td>
                <td width="30%" style="border-left: 1px solid gray; padding-left: 1%;padding-right: 0.5%;">
                    <!--<p  style="width: 250px; height: 100px; display: table-cell; text-align: center; vertical-align: middle;" class="border font-sm">Label Identitas Pasien</p>-->
                    <table class="tb-full" style="width: 300px; height: 100px;">
                        <tr>
                            <td class="v-align" width="100px">No. RM</td>
                            <td class="v-align" width="2px">:</td>
                            <td class="v-align"><?php echo $params->pasien->no_rm; ?></td>
                        </tr>
                        <tr>
                            <td class="v-align">Nama</td>
                            <td class="v-align">:</td>
                            <td class="v-align"><?php echo $params->pasien->nama?></td>
                        </tr>
                        <tr>
                            <td class="v-align">Tanggal Lahir</td>
                            <td class="v-align">:</td>
                            <td class="v-align"><?php echo $params->pasien->tanggal_lahir_indo?></td>
                        </tr>
                        <tr>
                            <td class="v-align">Umur</td>
                            <td class="v-align">:</td>
                            <td class="v-align"><?php echo $params->pasien->umur?></td>
                        </tr>
                        <tr>
                            <td class="v-align">Kelamin</td>
                            <td class="v-align">:</td>
                            <td class="v-align"><?php echo $params->pasien->kelamin?></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <table class="tb-full">
            <tr>
                <td width="100%" class="text-center" 
                style="border-top: 1px solid gray; border-bottom: 1px solid gray; background-color: rgba(128, 128, 128, 0.25); font-size: 1rem;"><b>ASESMEN AWAL MEDIS PENYAKIT UMUM GAWAT DARURAT</b></td>
            </tr>
            <tr>
                <td width="100%" class="pl-1 border-y">
                    <table class="tb-full">
                        <tr>
                            <td width="20px">Tanggal</td>
                            <td>:</td>
                            <td width="300px"><?php echo $params->datang->tanggal_indo; ?></td>
                            <td width="20px">Waktu</td>
                            <td>:</td>
                            <td><?php echo $params->datang->waktu; ?> WIB</td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td class="pl-1 border-y">
                    <table class="tb-full">
                        <tr>
                            <td width="100%" style="font-size: 1rem;">
                                Sumber Data :
                                <?= $params->sumber->data === 'Autoanamnesis'? '☑' : '☐'  ?>Autoanamnesis
                                &nbsp;&nbsp;
                                <?= $params->sumber->data === 'Alloanamnesis'? '☑' : '☐'  ?>Alloanamnesis,
                                &nbsp;&nbsp;
                                Dengan : <?= empty($params->sumber->dengan) ? '.................' : $params->sumber->dengan ?>
                                Hubungan dengan pasien : <?= empty($params->sumber->hubungan) ? '.................' : $params->sumber->hubungan ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-size: 1rem;">
                                Riwayat Alergi :  <?= $params->sumber->riwayat === 'Tidak'? '☑' : '☐'  ?>Tidak
                                &nbsp;&nbsp; 
                                <?= $params->sumber->riwayat === 'Ya'? '☑' : '☐'  ?>Ya, Sebutkan
                                <?= empty($params->sumber->value_riwayat) ? '........................................................' : $params->sumber->value_riwayat ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-size: 1rem;">
                                Hamil : 
                                <?= $params->sumber->hamil === 'Tidak'? '☑' : '☐'  ?>Tidak
                                &nbsp;&nbsp; 
                                <?= $params->sumber->hamil === 'Ya'? '☑' : '☐'  ?>Ya,Umur
                                <?= showValue($params->sumber->value_hamil->umur, 8)?> minggu,
                                &nbsp;&nbsp; 
                                G:&nbsp;&nbsp; <?= showValue($params->sumber->value_hamil->g, 2)?>&nbsp;&nbsp; 
                                P:&nbsp;&nbsp; <?= showValue($params->sumber->value_hamil->p, 2)?>&nbsp;&nbsp; 
                                A:&nbsp;&nbsp; <?= showValue($params->sumber->value_hamil->a, 2)?>&nbsp;&nbsp; 
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <table class="tb-full">
            <tr>
                <td class="data-label v-align" width="300px">1. KELUHAN UTAMA</td>
                <td width="2px" class="v-align">:</td>
                <td class="v-align" height="50px"><?php echo $params->data->fisik->vital_sign->keluhan_utama?></td>
            </tr>
            <tr>
                <td class="v-align data-label">2. RIWAYAT PENYAKIT SEKARANG</td>
                <td class="v-align">:</td>
                <td class="v-align" height="50px"><?php echo $params->data->fisik->vital_sign->anamnesis?></td>
            </tr>
            <tr>
                <td class="v-align data-label">3. HASIL ALLOANAMNESA</td>
                <td class="v-align">:</td>
                <td class="v-align" height="50px"><?php echo $params->data->alloanamnesa?></td>
            </tr>
            <tr>
                <td class="v-align data-label">4. RIWAYAT PENYAKIT DAHULU</td>
                <td class="v-align">:</td>
                <td class="v-align" height="50px"><?php echo $params->data->riwayat_dulu?></td>
            </tr>
            <tr>
                <td class="v-align data-label">5. RIWAYAT PENGGUNAAN OBAT</td>
                <td class="v-align">:</td>
                <td class="v-align" height="50px"><?php echo $params->data->riwayat_obat?></td>
            </tr>
        </table>
        <table class="tb-full">
            <tr>
                <td class="data-label v-align">6. PEMERIKSAAN FISIK</td>
            </tr>
        </table>
        <table class="tb-full">
            <tr>
                <td class="v-align" style="padding-left: 2rem;">
                    <span style="font-weight: bold;">
                        A. Keadaan Umum : 
                    </span>
                    <span>
                        
                        <?= $params->data->fisik->vital_sign->keadaan_umum === 'Baik'? '☑' : '☐'  ?>Baik  
                        <?= $params->data->fisik->vital_sign->keadaan_umum === 'Sedang'? '☑' : '☐'  ?>Sedang 
                        <?= $params->data->fisik->vital_sign->keadaan_umum === 'Lemah'? '☑' : '☐'  ?>Lemah 
                    </span>
                </td>
            </tr>
        </table>
        <table class="tb-full">
            <tr>
                <td width="100px" class="v-align" style="padding-left: 3.3rem;">Kesadaran</td>
                <td width="2px" class="v-align">:</td>
                <td class="v-align">
                    <table class="tb-gcs">
                        <tr>
                            <td class="label">
                              GCS :
                              <span class="gcs-item">
                                E <span class="gcs-value"><?php echo $params->data->fisik->vital_sign->gcs_e ?? '-' ?></span>
                              </span>
                              <span class="gcs-item">
                                V <span class="gcs-value"><?php echo $params->data->fisik->vital_sign->gcs_v ?? '-' ?></span>
                              </span>
                              <span class="gcs-item">
                                M <span class="gcs-value"><?php echo $params->data->fisik->vital_sign->gcs_m ?? '-' ?></span>
                              </span>
                            </td>
                        </tr>
                        <tr>
                            <td class="label">
                              <span class="kesadaran-item">
                                <span class="kesadaran-check">
                                  <?= $params->data->fisik->vital_sign->kesadaran === 'Compos Mentis' ? '☑' : '☐' ?>
                                </span>
                                <span class="kesadaran-text">Composmentis</span>
                              </span>
                            
                              <span class="kesadaran-item">
                                <span class="kesadaran-check">
                                  <?= $params->data->fisik->vital_sign->kesadaran === 'Somnolen' ? '☑' : '☐' ?>
                                </span>
                                <span class="kesadaran-text">Somnolen</span>
                              </span>
                            
                              <span class="kesadaran-item">
                                <span class="kesadaran-check">
                                  <?= $params->data->fisik->vital_sign->kesadaran === 'Soporo Komatus' ? '☑' : '☐' ?>
                                </span>
                                <span class="kesadaran-text">Soporo Komatus</span>
                              </span>
                            
                              <span class="kesadaran-item">
                                <span class="kesadaran-check">
                                  <?= $params->data->fisik->vital_sign->kesadaran === 'Koma' ? '☑' : '☐' ?>
                                </span>
                                <span class="kesadaran-text">Koma</span>
                              </span>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td class="v-align" style="padding-left: 3.3rem;">Tanda Vital</td>
                <td class="v-align">:</td>
                <td class="v-align vital-inline">
                  <span class="vital-item">
                    TD : <span class="vital-value"><?= $params->data->fisik->vital_sign->tensi_sistole ?> / <?= $params->data->fisik->vital_sign->tensi_diastole ?> </span> mmHg
                  </span>
                
                  <span class="vital-item">
                    N : <span class="vital-value"><?= $params->data->fisik->vital_sign->nadi ?></span> x/m
                  </span>
                
                  <span class="vital-item">
                    T : <span class="vital-value"><?= $params->data->fisik->vital_sign->suhu ?></span> °C
                  </span>
                
                  <span class="vital-item">
                    RR : <span class="vital-value"><?= $params->data->fisik->vital_sign->nafas ?></span> x/m
                  </span>
                
                  <span class="vital-item">
                    SpO<sub>2</sub> : <span class="vital-value"><?= $params->data->fisik->vital_sign->spo2 ?></span> %
                  </span>
                </td>
            </tr>
        </table>
        <table class="tb-full">
            <tr>
                <td class="data-label" style="padding-left: 2rem;">B. Status General :</td>
            </tr>
            <tr>
                <td style="padding-left: 3.3rem; padding-right: 1rem;">
                    <table class="tb-full border">
                        <tr>
                            <td width="50%" class="v-align">
                                <table class="tb-full">
                                    <tr>
                                        <td width="5px" class="pl-05">1).</td>
                                        <td width="80px">Kepala</td>
                                        <td width="2px">:</td>
                                        <td width="20px"><?= $params->data->status->kepala->dbn === 'Ya'? '☑' : '☐'  ?>Dbn;</td>
                                        <td width="10px">
                                            <?= $params->data->status->kepala->check === 'Ya'? '☑' : '☐'  ?>
                                        </td>
                                        <td width="2px">:</td>
                                        <td><?php echo $params->data->status->kepala->value?></td>
                                    </tr>
                                    <tr>
                                        <td class="pl-05"></td>
                                        <td>Mata</td>
                                        <td>:</td>
                                        <td><?= $params->data->status->mata->dbn === 'Ya'? '☑' : '☐'  ?>Dbn;</td>
                                        <td>
                                            <?= $params->data->status->mata->check === 'Ya'? '☑' : '☐'  ?>
                                        </td>
                                        <td>:</td>
                                        <td><?php echo $params->data->status->mata->value?></td>
                                    </tr>
                                    
                                    <tr>
                                        <td class="pl-05"></td>
                                        <td>Telinga</td>
                                        <td>:</td>
                                        <td><?= $params->data->status->telinga->dbn === 'Ya'? '☑' : '☐'  ?>Dbn;</td>
                                        <td>
                                            <?= $params->data->status->telinga->check === 'Ya'? '☑' : '☐'  ?>
                                        </td>
                                        <td>:</td>
                                        <td><?php echo $params->data->status->telinga->value?></td>
                                    </tr>
                                    
                                    <tr>
                                        <td class="pl-05"></td>
                                        <td>Hidung</td>
                                        <td>:</td>
                                        <td><?= $params->data->status->hidung->dbn === 'Ya'? '☑' : '☐'  ?>Dbn;</td>
                                        <td>
                                            <?= $params->data->status->hidung->check === 'Ya'? '☑' : '☐'  ?>
                                        </td>
                                        <td>:</td>
                                        <td><?php echo $params->data->status->hidung->value?></td>
                                    </tr>
                                    
                                    <tr>
                                        <td class="pl-05"></td>
                                        <td>Mulut</td>
                                        <td>:</td>
                                        <td><?= $params->data->status->mulut->dbn === 'Ya'? '☑' : '☐'  ?>Dbn;</td>
                                        <td>
                                            <?= $params->data->status->mulut->check === 'Ya'? '☑' : '☐'  ?>
                                        </td>
                                        <td>:</td>
                                        <td><?php echo $params->data->status->mulut->value?></td>
                                    </tr>
                                    
                                    <tr>
                                        <td class="pl-05"></td>
                                        <td>Gigi</td>
                                        <td>:</td>
                                        <td><?= $params->data->status->gigi->dbn === 'Ya'? '☑' : '☐'  ?>Dbn;</td>
                                        <td>
                                            <?= $params->data->status->gigi->check === 'Ya'? '☑' : '☐'  ?>
                                        </td>
                                        <td>:</td>
                                        <td><?php echo $params->data->status->gigi->value?></td>
                                    </tr>
                                    
                                    <tr>
                                        <td class="pl-05">2).</td>
                                        <td>Leher</td>
                                        <td>:</td>
                                        <td><?= $params->data->status->leher->dbn === 'Ya'? '☑' : '☐'  ?>Dbn;</td>
                                        <td>
                                            <?= $params->data->status->leher->check === 'Ya'? '☑' : '☐'  ?>
                                        </td>
                                        <td>:</td>
                                        <td><?php echo $params->data->status->leher->value?></td>
                                    </tr>
                                    
                                    <tr>
                                        <td class="pl-05">3).</td>
                                        <td>Thorax</td>
                                        <td>:</td>
                                        <td><?= $params->data->status->thorax->dbn === 'Ya'? '☑' : '☐'  ?>Dbn;</td>
                                        <td>
                                            <?= $params->data->status->thorax->check === 'Ya'? '☑' : '☐'  ?>
                                        </td>
                                        <td>:</td>
                                        <td><?php echo $params->data->status->thorax->value?></td>
                                    </tr>
                                    
                                    <tr>
                                        <td class="pl-05"></td>
                                        <td>Jantung</td>
                                        <td>:</td>
                                        <td><?= $params->data->status->jantung->dbn === 'Ya'? '☑' : '☐'  ?>Dbn;</td>
                                        <td>
                                            <?= $params->data->status->jantung->check === 'Ya'? '☑' : '☐'  ?>
                                        </td>
                                        <td>:</td>
                                        <td><?php echo $params->data->status->jantung->value?></td>
                                    </tr>
                                    
                                    <tr>
                                        <td class="pl-05"></td>
                                        <td>Paru</td>
                                        <td>:</td>
                                        <td><?= $params->data->status->paru->dbn === 'Ya'? '☑' : '☐'  ?>Dbn;</td>
                                        <td>
                                            <?= $params->data->status->paru->check === 'Ya'? '☑' : '☐'  ?>
                                        </td>
                                        <td>:</td>
                                        <td><?php echo $params->data->status->paru->value?></td>
                                    </tr>
                                </table>
                            </td>
                            <td width="50%" class="v-align">
                                <table class="tb-full">
                                    <tr>
                                        <td width="5px" class="pl-05">4).</td>
                                        <td width="120px">Abdomen</td>
                                        <td width="2px">:</td>
                                        <td width="30px"><?= $params->data->status->abdomen->dbn === 'Ya'? '☑' : '☐'  ?>Dbn;</td>
                                        <td width="10px">
                                            <?= $params->data->status->abdomen->check === 'Ya'? '☑' : '☐'  ?>
                                        </td>
                                        <td width="2px">:</td>
                                        <td><?php echo $params->data->status->abdomen->value?></td>
                                    </tr>
                                    <tr>
                                        <td class="pl-05"></td>
                                        <td >Hepar</td>
                                        <td >:</td>
                                        <td ><?= $params->data->status->hepar->dbn === 'Ya'? '☑' : '☐'  ?>Dbn;</td>
                                        <td>
                                            <?= $params->data->status->hepar->check === 'Ya'? '☑' : '☐'  ?>
                                        </td>
                                        <td >:</td>
                                        <td><?php echo $params->data->status->hepar->value?></td>
                                    </tr>
                                    <tr>
                                        <td  class="pl-05"></td>
                                        <td>Lien</td>
                                        <td >:</td>
                                        <td><?= $params->data->status->lien->dbn === 'Ya'? '☑' : '☐'  ?>Dbn;</td>
                                        <td >
                                            <?= $params->data->status->lien->check === 'Ya'? '☑' : '☐'  ?>
                                        </td>
                                        <td >:</td>
                                        <td><?php echo $params->data->status->lien->value?></td>
                                    </tr>
                                    <tr>
                                        <td  class="pl-05"></td>
                                        <td >Ginjal</td>
                                        <td >:</td>
                                        <td ><?= $params->data->status->ginjal->dbn === 'Ya'? '☑' : '☐'  ?>Dbn;</td>
                                        <td >
                                            <?= $params->data->status->ginjal->check === 'Ya'? '☑' : '☐'  ?>
                                        </td>
                                        <td >:</td>
                                        <td><?php echo $params->data->status->ginjal->value?></td>
                                    </tr>
                                    <tr>
                                        <td class="pl-05"></td>
                                        <td >Genitalia</td>
                                        <td >:</td>
                                        <td><?= $params->data->status->genitalia->dbn === 'Ya'? '☑' : '☐'  ?>Dbn;</td>
                                        <td >
                                            <?= $params->data->status->genitalia->check === 'Ya'? '☑' : '☐'  ?>
                                        </td>
                                        <td >:</td>
                                        <td><?php echo $params->data->status->genitalia->value?></td>
                                    </tr>
                                    <tr>
                                        <td class="pl-05">5).</td>
                                        <td >Extremitas atas</td>
                                        <td >:</td>
                                        <td ><?= $params->data->status->extremitas_atas->dbn === 'Ya'? '☑' : '☐'  ?>Dbn;</td>
                                        <td >
                                            <?= $params->data->status->extremitas_atas->check === 'Ya'? '☑' : '☐'  ?>
                                        </td>
                                        <td >:</td>
                                        <td><?php echo $params->data->status->extremitas_atas->value?></td>
                                    </tr>
                                    <tr>
                                        <td  class="pl-05"></td>
                                        <td>Extremitas bawah</td>
                                        <td>:</td>
                                        <td ><?= $params->data->status->extremitas_bawah->dbn === 'Ya'? '☑' : '☐'  ?>Dbn;</td>
                                        <td >
                                            <?= $params->data->status->extremitas_bawah->check === 'Ya'? '☑' : '☐'  ?>
                                        </td>
                                        <td>:</td>
                                        <td><?php echo $params->data->status->extremitas_bawah->value?></td>
                                    </tr>
                                </table>
                                <table class="tb-full">
                                    <tr>
                                        <td>Akral Hangat</td>
                                        <td>Oedama</td>
                                    </tr>
                                    <tr>
                                        <td>
                                        <img src="<?php echo $params->image_canvas->canvas1->image_base64 ?>" widht="50px" height="50px" />
                                        </td>
                                        <td>
                                        <img src="<?php echo $params->image_canvas->canvas2->image_base64 ?>" widht="50px" height="50px" />
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
                <td class="data-label" style="padding-left: 2rem;">C. Pemeriksaan Fisik Tambahan</td>
            </tr>
        </table>
        <table class="tb-full">
            <tr>
                <td style="padding-left: 3.3rem; padding-right: 1rem;">
                    <table class="tb-full border">
                        <tr>
                            <td width="60%"class="v-align" style="vertical-align:top; padding-left:0.8rem; padding-top:0.8rem;">
                                <table width="100%" style="border-collapse:collapse;">

                                    <?php for($i=1;$i<=10;$i++): ?>
                            
                                    <tr style="height:28px;">
                                        <!-- NOMOR -->
                                        <td width="25"
                                            style="
                                                vertical-align:top;
                                            ">
                                            <?= $i ?>.
                                        </td>
                            
                                        <!-- TEXT -->
                                        <td>
                                            <?= showValue($params->data->fisik_tambahan->{(string)$i} ?? '', 14) ?>
                                        </td>
                                    </tr>
                            
                                    <?php endfor; ?>
                            
                                </table>
                            </td>
                            <td width="40%" style="border-left:1px solid gray; vertical-align:top;">
                                <img src="<?php echo $params->image_canvas->canvas3->image_base64?>"  style="display:block;" height="300"/>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <div class="pagebreak-avoid">
            <table class="tb-full">
                <tr>
                    <td class="data-label v-align" style="padding-left: 1rem;">7. HASIL PEMERIKSAAN PENUNJANG</td>
                </tr>
            </table>
            <table class="tb-full" style="font-size: 1rem;">
                <tr>
                    <td class="v-align" width="120px"  style="padding-left: 2rem;">a. Laboratorium</td>
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
            </table> 
            <table class="tb-full" style="font-size: 1rem;">
                <tr>
                    <td class="v-align" width="120px"  style="padding-left: 2rem;">b. Radiologi</td>
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
            </table> 
            <table class="tb-full" style="font-size: 1rem;">
                <tr>
                    <td class="v-align" width="120px" style="padding-left: 2rem;">c. EKG</td>
                    <td width="2px" class="v-align">:</td>
                    <td class="v-align"><?php echo $params->ekg ?></td>
                </tr>
            </table> 
            <table class="tb-full" style="font-size: 1rem;">
                <tr>
                    <td class="v-align" width="120px" style="padding-left: 2rem;">d. Lain-lainnya</td>
                    <td width="2px" class="v-align">:</td>
                    <td class="v-align"><?php echo $params->lainnya ?></td>
                </tr>
            </table>
        </div>
        <table class="tb-full">
            <tr>
                <td class="v-align data-label">8. DIAGNOSIS</td>
            </tr>
        </table>
        <table class="tb-full">
            <tr>
                <td>
                    <table class="tb-full">
                         <tr>
                            <td class="pl-2">
                                <table class="tb-full">
                                    <tr>
                                        <td width="150px" class="v-align">Diagnosis Kerja</td>
                                        <td width="2px" class="v-align">:</td>
                                        <td class="pl-2">
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
                                        <td class="v-align">Diagnosa Banding</td>
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
                                        <td class="v-align">Diagnosa Tambahan</td>
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
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <table class="tb-full">
            <tr>
                <td class="v-align data-label">9. MASALAH MEDIS</td>
            </tr>
            <tr>
                <td class="v-align" style="height: 50px; padding-left: 2.5rem;">
                    <?php echo $params->masalah_medis; ?>
                </td>
            </tr>
        </table>
        <table class="tb-full">
            <tr>
                <td class="v-align data-label">10. MASALAH KEPERAWATAN</td>
            </tr>
            <tr>
                <td class="v-align pl-2.5" style="height: 50px; padding-left: 2.5rem;">
                    <?php echo $params->masalah_keperawatan; ?>
                </td>
            </tr>
        </table>
        <?php
        function cleanText($text){
            $text = strip_tags((string)$text);
            $text = html_entity_decode($text, ENT_QUOTES | ENT_HTML5, 'UTF-8');
            $text = preg_replace('/\s+/', ' ', $text);
            return trim($text);
        }
        function toArray($data){
            if(is_object($data)){
                $data = (array)$data;
            }
        
            if(is_array($data)){
                return array_map('toArray', $data);
            }
        
            return $data;
        }
        function buildTindakanList($params){
        
            $result = [];
        
            $freetext = $params->tindakan_freetext ?? '';
            $group    = $params->tindakan_group ?? '';
            $list     = $params->tindakan_list ?? [];
        
            if(is_string($list)){
                $decoded = json_decode($list, true);
        
                if(json_last_error() === JSON_ERROR_NONE){
                    $list = $decoded;
                }else{
                    $list = [];
                }
            }
        
            $list = toArray($list);
        
            if(!is_array($list)){
                $list = [];
            }
        
            if(!empty($group)){
        
                $lines = preg_split('/\r\n|\r|\n/', $group);
        
                foreach($lines as $line){
        
                    $clean = preg_replace('/^\s*\d+\.\s*/', '', $line);
                    $clean = cleanText($clean);
        
                    if($clean !== ''){
                        $result[] = $clean;
                    }
                }
            }
        
            foreach($list as $item){
        
                if(!is_array($item)) continue;
        
                $kode = cleanText(
                    $item['icd_9_code']
                    ?? $item['kode']
                    ?? ''
                );
        
                $nama = cleanText(
                    $item['icd_9_name']
                    ?? $item['nama_layanan']
                    ?? $item['deskripsi']
                    ?? ''
                );
        
                if($kode || $nama){
                    $result[] = trim("$kode - $nama", ' -');
                }
            }
        
            return array_values($result);
        }
        $tindakan = buildTindakanList($params);
        
        ?>
        
        <table class="tb-full">
            <tr>
                <td class="v-align data-label">
                    11. SASARAN / TARGET TERAPI
                </td>
            </tr>
        
            <tr>
                <td style="padding-left: 2.5rem; height: 50px;">
        
                    <?php if(!empty($tindakan)): ?>
        
                        <table style="width:100%; border-collapse:collapse;">
        
                            <?php foreach ($tindakan as $i => $item): ?>
                                <tr>
                                    <td style="width:25px; vertical-align:top;">
                                        <?= ($i+1) ?>.
                                    </td>
        
                                    <td style="vertical-align:top;">
                                        <?= htmlspecialchars($item) ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
        
                        </table>
        
                    <?php else: ?>
        
                        <span>-</span>
        
                    <?php endif; ?>
        
                </td>
            </tr>
        </table>
        <table class="tb-full">
            <tr>
                <td class="v-align data-label" style="padding-top: 10px;">12. RENCANA ASUHAN / TERAPI / STANDING ORDER</td>
            </tr>
            <tr>
                <td class="v-align" style="height: 50px; padding-left: 2.5rem;">
                    <?php echo $params->rencana_pulang->tindakan_asuhan; ?>
                </td>
            </tr>
        </table>
        <div style="margin-top: 0.8rem;padding-left: 2rem; padding-right: 1.2rem;" class="pagebreak-avoid">
            <table class="tb-full" 
                   style="margin-left:-2rem; margin-right:-1.2rem;">
                <tr>
                    <td class="v-align data-label">
                        13. RENCANA PEMULANGAN DAN TINDAK LANJUT PERAWATAN PASIEN
                    </td>
                </tr>
            </table>
            <table class="tb-full border">
                <tr>
                    <td width="30%">
                        <?= $params->rencana_pulang->pemulangan->jenis === 'Rawat_jalan'? '☑' : '☐'  ?>Rawat Jalan
                        <br />
                        <?= $params->rencana_pulang->pemulangan->jenis === 'aps'? '☑' : '☐'  ?>Aps
                        <br />
                        <?= $params->rencana_pulang->pemulangan->jenis === 'obser'? '☑' : '☐'  ?>Observasi
                        <br />
                        <?= $params->rencana_pulang->pemulangan->jenis === 'Rawat_inap'? '☑' : '☐'  ?>Rawat Inap
                        <br />
                        <?= $params->rencana_pulang->pemulangan->dokter_ranap_check === 'Ya' ? '☑' : '☐' ?>
                        DPJP Rawat Inap :
                        <br />
                        
                        <?php if (($params->rencana_pulang->pemulangan->dokter_ranap_check ?? '') === 'Ya'): ?>
                            <div style="text-align:center; margin-top:6px;">
                                <img
                                    src="<?= $params->rencana_pulang->pemulangan->dokter_ranap_stroke ?>"
                                    width="50"
                                    height="50"
                                    style="display:block; margin:0 auto 2px auto;"
                                />
                                <div style="margin-top:0; font-size:0.9rem;">
                                    <?= htmlspecialchars($params->rencana_pulang->pemulangan->dokter_ranap ?? '') ?>
                                </div>
                            </div>
                        <?php else: ?>
                            <!-- spacer agar layout tetap -->
                            <div style="height:20px;"></div>
                        <?php endif; ?>
                        
                        <br />
                        Rujuk Ke :
                        <br />
                        <?php 
                        $isSpesialis = ($params->rencana_pulang->pemulangan->rujuk->jenis ?? '') === 'spesalis';
                        ?>
                        
                        <?= $isSpesialis ? '☑' : '☐' ?> Dokter Spesialis
                        
                        <?php if ($isSpesialis): ?>
                            <?= htmlspecialchars($params->rencana_pulang->pemulangan->rujuk->spesalis_value ?? '') ?>
                        <?php endif; ?>
                        <br />
                        <?php
                        $jenis = $params->rencana_pulang->pemulangan->rujuk->jenis ?? '';
                        ?>
                        
                        <?= $jenis === 'rs' ? '☑' : '☐' ?> RS
                        <?php if ($jenis === 'rs'): ?>
                            <?= htmlspecialchars($params->rencana_pulang->pemulangan->rujuk->rs_value ?? '') ?>
                        <?php endif; ?>
                        <br />
                        
                        <?= $jenis === 'puskesmas' ? '☑' : '☐' ?> Puskesmas
                        <?php if ($jenis === 'puskesmas'): ?>
                            <?= htmlspecialchars($params->rencana_pulang->pemulangan->rujuk->puskesmas_value ?? '') ?>
                        <?php endif; ?>
                        <br />
                        <?= $params->rencana_pulang->pemulangan->rujuk->jenis === 'dokter_keluarga'? '☑' : '☐'  ?>Dokter Keluarga
                        <br />
                        <?= $params->rencana_pulang->pemulangan->rujuk->jenis === 'homecare'? '☑' : '☐'  ?>Homecare
                        <br />
                    </td>
                    <td width="25%" class="border-rf v-middle">
                        <table style="width:100%; height:200px; border-collapse:collapse;">
                            <!-- ATAS -->
                            <tr>
                                <td valign="middle" style="height:50%; text-align:left;">
                                    <p style="margin:0;">
                                        Keluar RS jam :
                                        <?= $params->rencana_pulang->pemulangan->out_rs->waktu; ?> WIB
                                    </p>
                                    <p style="margin:0;">
                                        Ruang :
                                        <?= $params->pasien->bangsal; ?>
                                        <?= $params->pasien->ruang; ?>
                                        <?= $params->pasien->kelas; ?>
                                    </p>
                                </td>
                            </tr>
                        
                            <!-- BAWAH -->
                            <tr>
                                <td valign="middle" style="height:50%; text-align:left;">
                                    <p style="margin:0 0 4px 0;">
                                        Atas Dasar :
                                    </p>
                        
                                    <?= $params->rencana_pulang->pemulangan->atas_dasar === 'kamar_penuh' ? '☑' : '☐' ?>
                                    Kamar Penuh
                                    <br />
                        
                                    <?= $params->rencana_pulang->pemulangan->atas_dasar === 'perlu_fasi' ? '☑' : '☐' ?>
                                    Perlu Fasilitas dan SDM
                                    <br />
                        
                                    <?= $params->rencana_pulang->pemulangan->atas_dasar === 'permintaan' ? '☑' : '☐' ?>
                                    Permintaan Pasien / Keluarga
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td width="25%" class="border-rf v-middle">
                        <table style="width:100%; height:200px; border-collapse:collapse;">
                            <tr>
                                <td valign="middle" style="height:50%; text-align:left;">
                                    <p style="margin:0;">
                                        Indikasi :
                                        <?= $params->rencana_pulang->pemulangan->indikasi; ?>
                                    </p>
                                </td>
                            </tr>
                        
                            <!-- BAWAH -->
                            <tr>
                                <td valign="middle" style="height:50%; text-align:left;">
                                    <p style="margin:0 0 4px 0;">
                                        Diantar Oleh :
                                    </p>
                        
                                    <?= $params->rencana_pulang->pemulangan->diantar === 'ambulan_rs' ? '☑' : '☐' ?>
                                    Ambulance RS
                                    <br />
                        
                                    <?= $params->rencana_pulang->pemulangan->diantar === 'ambulan_lain' ? '☑' : '☐' ?>
                                    Ambulance lain
                                    <br />
                        
                                    <?= $params->rencana_pulang->pemulangan->diantar === 'kendaraan_umum' ? '☑' : '☐' ?>
                                    Kendaraan Umum
                                    <br />
                        
                                    <?= $params->rencana_pulang->pemulangan->diantar === 'kendaran_pribadi' ? '☑' : '☐' ?>
                                    Kendaraan Pribadi
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>
        <div style="margin-top: 0.8rem;padding-left: 2rem; padding-right: 1rem;" class="pagebreak-avoid">
            <table class="tb-full" style="margin-left:-2rem; margin-right:-1.2rem;">
                <tr>
                    <td class="v-align data-label">14. KONDISI SAAT KELUAR IGD</td>
                </tr>
            </table>
            <table class="tb-full border">
                <tr>
                    <td class="pl-05 v-align">
                        Keadaan umum
                    </td>
                    <td class="vl-align" width="5px">:</td>
                    <td class="vl-align"></td>
                </tr>
                <tr>
                    <td width="100px" class="pl-05 v-align">
                        GCS
                    </td>
                    <td class="vl-align" width="5px">:</td>
                    <td class="vl-align">
                        E : 
                        <span style="display:inline-block; width:50px;">
                            <?= $params->kondisi_keluar->gcs->e ?? '' ?>
                        </span>
                        V : 
                        <span style="display:inline-block; width:50px;">
                            <?= $params->kondisi_keluar->gcs->v ?? '' ?>
                        </span>
                        M : 
                        <span style="display:inline-block; width:50px;">
                            <?= $params->kondisi_keluar->gcs->m ?? '' ?>
                        </span>
                    </td>
                </tr>
                <tr>
                    <td width="100px" class="pl-05 v-align">
                        Tanda Vital
                    </td>
                    <td class="vl-align" width="5px">:</td>
                    <td class="vl-align">
                        TD: 
                        <span style="display:inline-block; width:25px;">
                            <?= !empty($params->kondisi_keluar->vital_sign->td_s)
                                ? $params->kondisi_keluar->vital_sign->td_s
                                : 0.0 ?>
                        </span>
                        /
                        <span style="display:inline-block; width:25px;">
                            <?= !empty($params->kondisi_keluar->vital_sign->td_ds)
                                ? $params->kondisi_keluar->vital_sign->td_ds
                                : 0.0 ?>
                        </span>
                        mmHg,
                        &nbsp;&nbsp;
                        N: 
                        <span style="display:inline-block; width:25px;">
                            <?= $params->kondisi_keluar->vital_sign->n ?? '' ?>
                        </span>
                        x/m,
                        &nbsp;&nbsp;
                        RR: 
                        <span style="display:inline-block; width:25px;">
                            <?= $params->kondisi_keluar->vital_sign->r ?? '' ?>
                        </span>
                        x/m,
                        &nbsp;&nbsp;
                        S: 
                        <span style="display:inline-block; width:25px;">
                            <?= $params->kondisi_keluar->vital_sign->s ?? '' ?>
                        </span>
                        °C,
                        &nbsp;&nbsp;
                        SpO<sub>2</sub>:
                        <span style="display:inline-block; width:25px;">
                            <?= $params->kondisi_keluar->vital_sign->spo2 ?? '' ?>
                        </span>
                        %
                    </td>
                </tr>
                <tr>
                    <td width="120px" class="pl-05 v-align">
                        Kondisi saat ini
                    </td>
                    <td class="v-align" width="5px">:</td>
                    <td class="v-align">
                        <?= $params->kondisi_keluar->kondisi ?>
                    </td>
                </tr>
                <tr>
                    <td width="120px" class="pl-05 v-align">
                        Instruksi Pulang
                    </td>
                    <td class="v-align" width="5px">:</td>
                    <td class="v-align">
                        <?= $params->kondisi_keluar->intruksi ?>
                    </td>
                </tr>
            </table>
        </div>
        <div style="margin-top: 0.8rem;padding-left: 2rem; padding-right: 1rem;" class="pagebreak-avoid">
            <table class="tb-full" style="margin-left:-2rem; margin-right:-1.2rem;">
                <tr>
                    <td class="data-label v-align">15. EDUKASI PASIEN ( Edukasi awal, disampaikan tentang dignosis, rencana dan tujuan terapi ) :</td>
                </tr>
            </table>
            <table class="tb-full border">
                <tr>
                    <td class="pl-05">
                        Materi Edukasi :
                        <?= $params->edukasi->materi ?? "" ?>
                    </td>
                </tr>
                <tr>
                    <td class="pl-05">
                        Edukasi Awal, disampaikan kepada :
                    </td>
                </tr>
                <tr>
                    <td class="pl-05">
                        <?= $params->edukasi->eduksi_awal->pasien === 'Ya'? '☑' : '☐'  ?>Pasien
                    </td>
                </tr>
                <tr>
                    <td class="pl-05">
                        <?= $params->edukasi->eduksi_awal->keluarga_pasien === 'Ya' ? '☑' : '☐' ?>
                        Keluarga Pasien, nama :
                        <span style="display:inline-block; width:100px;">
                            <?= $params->edukasi->eduksi_awal->nama ?? '' ?>
                        </span>,
                        Hubungan dengan pasien :
                        <?= $params->edukasi->eduksi_awal->hubungan ?? "" ?>
                    </td>
                </tr>
                <tr>
                    <td class="pl-05">
                        <?= $params->edukasi->eduksi_awal->karena === 'Ya'? '☑' : '☐'  ?>
                        Tidak dapat memberi edukasi kepada pasien atau keluarga, karena :
                        <?= $params->edukasi->eduksi_awal->karena_value ?? "" ?>
                    </td>
                </tr>
            </table>
        </div>
        <table class="tb-full" style="margin-top:40px;">
            <tr>
                <!-- KIRI -->
                <td width="50%" class="text-center valign">
                    <div class="ttd-title">Dokter</div>
        
                    <div class="ttd-space"></div>
        
                    <div class="ttd-line">
                        <?php if (!empty($params->ttd_data->dokter_stroke)): ?>
                            <img src="<?= $params->ttd_data->dokter_stroke ?>" width="100" height="100">
                        <?php endif; ?>
                    </div>
        
                    <div class="ttd-label">
                        <?php if (!empty($params->ttd_data->dokter)): ?>
                            <?= $params->ttd_data->dokter ?>
                        <?php else: ?>
                            (............................................................)
                        <?php endif; ?>
                    </div>
        
                    <div class="ttd-sub-label">
                        <?= empty($params->ttd_data->dokter) ? 'Tanda Tangan dan Nama Terang' : '&nbsp;' ?>
                    </div>
                </td>
        
                <!-- KANAN -->
                <td width="50%" class="text-center valign">
                    <div class="ttd-title">Pasien / Penerima Penjelasan</div>
        
                    <div class="ttd-space"></div>
        
                    <div class="ttd-line">
                        <?php if (!empty($params->ttd_data->pasien_stroke)): ?>
                            <img src="<?= $params->ttd_data->pasien_stroke ?>" width="100" height="100">
                        <?php endif; ?>
                    </div>
        
                    <div class="ttd-label">
                        <?php if (!empty($params->ttd_data->pasien)): ?>
                            <?= $params->ttd_data->pasien ?>
                        <?php else: ?>
                            (............................................................)
                        <?php endif; ?>
                    </div>
        
                    <div class="ttd-sub-label">
                        <?= empty($params->ttd_data->pasien) ? 'Tanda Tangan dan Nama Terang' : '&nbsp;' ?>
                    </div>
                </td>
            </tr>
        </table>
    </div>
    <div style="font-size:0.7rem; font-family:Segoe UI, Arial, sans-serif;">
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
                    Revisi 0/VI/2020
                </td>
            </tr>
        </table>
    </div>
</body>

</html>