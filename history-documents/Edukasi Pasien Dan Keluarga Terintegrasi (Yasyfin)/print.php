<?php
// EMR Data
$params = json_decode($argv[1]);

$base_url = $argv[2]; // Base_url
$title = "EDUKASI PASIEN DAN KELUARGA TERINTEGRASI";
$static_label = json_decode($argv[3]);
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
        font: 12px times new roman;
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
        width: 50px;
        height: 50px;
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
    
    .tabel-kop { border: 1px solid #000; font-family: 'Times New Roman', serif; margin-bottom: 0; width: 100%; }
    
    .font-tanggal{
        font-size:14px;
    }
    
    .font-paragraph{
        font-size:12px;
    }
    
    .font-title{
        font-size:14pt;
    }
    
    .assmen{
        margin-bottom: 20px;
    }
</style>

<body>
    <table>
        <tr>
            <td valign="center" width="52%" class="table-borderless">
                <table class="table-borderless">
                    <tr>
                        <td align="center" width="30%">
                            <img id="logo" style="width:100%;" src="<?= $base_url; ?>/images/rs/LogoRS.png">
                        </td>
                        <td align="left">
                            <p style="font-size:16px;"><b><?php echo $static_label->hospital_name ?? '' ?></b></p>
                            <p style="font-size:12px;"><?php echo $static_label->hospital_address ?? '' ?></p>
                            <p style="font-size:12px;">
                                <?= !empty($static_label->hospital_email) ? "Email : " . $static_label->hospital_email : '' ?> </br>
                                <?= !empty($static_label->hospital_phone) ? "Telp. " . htmlspecialchars($static_label->hospital_phone) : 'Telp. ( 0352 ) 3597202' ?>
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
            <td valign="middle" style="border: 1px solid #000;">
                <table class="table-borderless " style="height:100px">
                    <tr>
                        <td valign="top" class="font-paragraph">
                            <!--<div style="border:1px dotted black; border-radius:12px; height:100%">-->
                                <table class="table-borderless">
                                    <tr>
                                        <td valign="top" width="35%"><b>No RM</b></td>
                                        <td valign="top" width="1%"><b>:</b></td>
                                        <td valign="top">
                                            <?= $params->pasien->no_rm ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td valign="top" ><b>Nama</b></td>
                                        <td valign="top" ><b>:</b></td>
                                        <td valign="top">
                                            <?= $params->pasien->nama ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td valign="top" ><b>Tanggal Lahir</b></td>
                                        <td valign="top" ><b>:</b></td>
                                        <td valign="top">
                                            <?= $params->pasien->tanggal_lahir_indo ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td valign="top" ><b>Alamat</b></td>
                                        <td valign="top" ><b>:</b></td>
                                        <td valign="top">
                                            <?= $params->pasien->alamat ?>
                                        </td>
                                    </tr>
                                </table>
                            <!--</div>-->
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    
    <table border="0">
        <tr>
            <th style="padding: 20px;"><h4><b>EDUKASI PASIEN DAN KELUARGA TERINTEGRASI</b></h4></th>
        </tr>
    </table>
    
    <table border="0" class="assmen">
        <tr>
            <td colspan="6"><b>A. ASSESMENT KEBUTUHAN EDUKASI</b></td>
        </tr>
        <tr>
            <td colspan="6">Data Pasien</td>
        </tr>
        <tr>
            <td width="20%" valign="top">Tinggal Bersama</td>
            <td width="2%" valign="top">:</td>
            <td width="19.5%" valign="top">
                <span>
                    <input type="checkbox" <?= $params->tinggal_bersama === 'Anak' ? 'checked' : '' ?>>Anak
                </span>
            </td>
            <td width="19.5%" valign="top">
                <span>
                    <input type="checkbox" <?= $params->tinggal_bersama === 'Orang Tua' ? 'checked' : '' ?>>Orang Tua
                </span>
            </td>
            <td width="19.5%" valign="top">
                <span>
                    <input type="checkbox" <?= $params->tinggal_bersama === 'Sendiri' ? 'checked' : '' ?>>Sendiri
                </span>
            </td>
            <td width="19.5%" valign="top">
                <span>
                    <input type="checkbox" <?= $params->tinggal_bersama === 'Suami' ? 'checked' : '' ?>>Suami
                </span>
            </td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td valign="top">
                <span>
                    <input type="checkbox" <?= $params->tinggal_bersama === 'Istri' ? 'checked' : '' ?>>Istri
                </span>
            </td>
            <td valign="top" colspan="3">
                <span>
                    <input type="checkbox" <?= $params->tinggal_bersama === 'Pondok Pesantren' ? 'checked' : '' ?>>Pondok Pesantren
                </span>
            </td>
        </tr>
        <tr>
            <td valign="top">Hambatan</td>
            <td valign="top">:</td>
            <td valign="top">
                <span>
                    <input type="checkbox" <?= $params->hambatan->ada_tdk === 'Tidak' ? 'checked' : '' ?>>Tidak
                </span>
            </td>
            <td valign="top">
                <span>
                    <input type="checkbox" <?= $params->hambatan->ada_tdk === 'Ada' ? 'checked' : '' ?>>Ada, meliputi :
                </span>
            </td>
            <td valign="top">
                <span>
                    <input type="checkbox" <?= $params->hambatan->dengar === 'Gangguan Pendengaran' ? 'checked' : '' ?>>Gangguan Pendengaran
                </span>
            </td>
            <td valign="top">
                <span>
                    <input type="checkbox" <?= $params->hambatan->emosi === 'Gangguan Emosi' ? 'checked' : '' ?>>Gangguan Emosi
                </span>
            </td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td valign="top">
                <span>
                    <input type="checkbox" <?= $params->hambatan->lihat === 'Gangguan Penglihatan' ? 'checked' : '' ?>>Gangguan Penglihatan
                </span>
            </td>
            <td valign="top">
                <span>
                    <input type="checkbox" <?= $params->hambatan->bicara === 'Gangguan Bicara' ? 'checked' : '' ?>>Gangguan Bicara
                </span>
            </td>
            <td valign="top">
                <span>
                    <input type="checkbox" <?= $params->hambatan->motivasi === 'Motivasi Kurang / Buruk' ? 'checked' : '' ?>>Motivasi Kurang / Buruk
                </span>
            </td>
            <td valign="top">
                <span>
                    <input type="checkbox" <?= $params->hambatan->fisik === 'Fisik Lemah' ? 'checked' : '' ?>>Fisik Lemah
                </span>
            </td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td valign="top">
                <span>
                    <input type="checkbox" <?= $params->hambatan->alkohol === 'Alkoholik' ? 'checked' : '' ?>>Alkoholik
                </span>
            </td>
            <td valign="top">
                <span>
                    <input type="checkbox" <?= $params->hambatan->perokok === 'Perokok Aktif / Pasif' ? 'checked' : '' ?>>Perokok Aktif / Pasif
                </span>
            </td>
            <td valign="top" colspan="2">
                <span>
                    <input type="checkbox" <?= $params->hambatan->tdk_mampu === 'Secara fisiologis tidak mampu belajar' ? 'checked' : '' ?>>Secara fisiologis tidak mampu belajar
                </span>
            </td>
        </tr>
        <tr>
            <td valign="top">Pendidikan Pasien</td>
            <td valign="top">:</td>
            <td valign="top">
                <span>
                    <input type="checkbox" <?= $params->pasien->pendidikan === 'SD' ? 'checked' : '' ?>>SD
                </span>
            </td>
            <td valign="top">
                <span>
                    <input type="checkbox" <?= $params->pasien->pendidikan === 'SMP' ? 'checked' : '' ?>>SMP
                </span>
            </td>
            <td valign="top">
                <span>
                    <input type="checkbox" <?= $params->pasien->pendidikan === 'SMA' ? 'checked' : '' ?>>SMA
                </span>
            </td>
            <td valign="top">
                <span>
                    <input type="checkbox" <?= $params->pasien->pendidikan === 'D3' ? 'checked' : '' ?>>D3
                </span>
            </td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td valign="top">
                <span>
                    <input type="checkbox" <?= $params->pasien->pendidikan === 'S1' ? 'checked' : '' ?>>S1
                </span>
            </td>
            <td valign="top" colspan="3">
                <span>
                    <input type="checkbox" <?= $params->pasien->pendidikan === 'Lainnya' ? 'checked' : '' ?>>Lain-lain :
                    <?= $params->pasien->pendidikan_lainnya ?>
                </span>
            </td>
        </tr>
        <tr>
            <td valign="top">Edukasi diberikan kepada</td>
            <td valign="top">:</td>
            <td valign="top">
                <span>
                    <input type="checkbox" <?= $params->edukasi->pasien === 'Pasien' ? 'checked' : '' ?>>Pasien
                </span>
            </td>
            <td valign="top">
                <span>
                    <input type="checkbox" <?= $params->edukasi->ayah_ibu === 'Orang Tua' ? 'checked' : '' ?>>Orang Tua :
                    <?= $params->edukasi->ayah_ibu_pilihan ?>
                </span>
            </td>
            <td valign="top" colspan="2">
                <span>
                    <input type="checkbox" <?= $params->edukasi->keluarga === 'Keluarga' ? 'checked' : '' ?>>Keluarga :
                    <?= $params->edukasi->keluarga_pilihan ?>
                </span>
            </td>
        </tr>
        <tr>
            <td valign="top">Kemampuan Bahasa</td>
            <td valign="top">:</td>
            <td valign="top">
                <span>
                    <input type="checkbox" <?= $params->kemampuan_bahasa->indonesia === 'Indonesia' ? 'checked' : '' ?>>Indonesia
                </span>
            </td>
            <td valign="top">
                <span>
                    <input type="checkbox" <?= $params->kemampuan_bahasa->asing === 'Asing' ? 'checked' : '' ?>>Asing
                </span>
            </td>
            <td valign="top" colspan="2">
                <span>
                    <input type="checkbox" <?= $params->kemampuan_bahasa->daerah === 'Daerah' ? 'checked' : '' ?>>Daerah :
                    <?= $params->kemampuan_bahasa->daerah_apa ?>
                </span>
                <br />
                <span>
                    <input type="checkbox" <?= $params->kemampuan_bahasa->nilai === 'Nilai - Nilai Spiritual dan Budaya' ? 'checked' : '' ?>>Nilai - Nilai Spiritual dan Budaya :
                    <?= $params->kemampuan_bahasa->nilai_apa ?>
                </span>
            </td>
        </tr>
        <tr>
            <td valign="top">Perlu Penerjemah</td>
            <td valign="top">:</td>
            <td valign="top">
                <span>
                    <input type="checkbox" <?= $params->penerjemah === 'Tidak' ? 'checked' : '' ?>>Tidak
                </span>
            </td>
            <td valign="top">
                <span>
                    <input type="checkbox" <?= $params->penerjemah === 'Ya' ? 'checked' : '' ?>>Ya
                </span>
            </td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td valign="top">Baca &amp; Tulis</td>
            <td valign="top">:</td>
            <td valign="top">
                <span>
                    <input type="checkbox" <?= $params->baca_tulis === 'Tidak' ? 'checked' : '' ?>>Tidak
                </span>
            </td>
            <td valign="top">
                <span>
                    <input type="checkbox" <?= $params->baca_tulis === 'Ya' ? 'checked' : '' ?>>Ya
                </span>
            </td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td valign="top">Agama</td>
            <td valign="top">:</td>
            <td valign="top">
                <span>
                    <input type="checkbox" <?= $params->pasien->agama === 'Islam' ? 'checked' : '' ?>>Islam
                </span>
            </td>
            <td valign="top">
                <span>
                    <input type="checkbox" <?= $params->pasien->agama === 'Kristen' ? 'checked' : '' ?>>Kristen
                </span>
            </td>
            <td valign="top">
                <span>
                    <input type="checkbox" <?= $params->pasien->agama === 'Katolik' ? 'checked' : '' ?>>Katolik
                </span>
            </td>
            <td valign="top">
                <span>
                    <input type="checkbox" <?= $params->pasien->agama === 'Hindu' ? 'checked' : '' ?>>Hindu
                </span>
            </td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td valign="top">
                <span>
                    <input type="checkbox" <?= $params->pasien->agama === 'Buddha' ? 'checked' : '' ?>>Buddha
                </span>
            </td>
            <td valign="top">
                <span>
                    <input type="checkbox" <?= $params->pasien->agama === 'Konghuchu' ? 'checked' : '' ?>>Konghuchu
                </span>
            </td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td valign="top">Kesediaan Menerima Edukasi</td>
            <td valign="top">:</td>
            <td valign="top">
                <span>
                    <input type="checkbox" <?= $params->kesediaan === 'Tidak' ? 'checked' : '' ?>>Tidak
                </span>
            </td>
            <td valign="top">
                <span>
                    <input type="checkbox" <?= $params->kesediaan === 'Ya' ? 'checked' : '' ?>>Ya
                </span>
            </td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td valign="top">Cara Edukasi</td>
            <td valign="top">:</td>
            <td valign="top">
                <span>
                    <input type="checkbox" <?= $params->cara_edukasi->lisan === 'Lisan' ? 'checked' : '' ?>>Lisan
                </span>
            </td>
            <td valign="top">
                <span>
                    <input type="checkbox" <?= $params->cara_edukasi->tulisan === 'Tulisan' ? 'checked' : '' ?>>Tulisan
                </span>
            </td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td valign="top">Kebutuhan Edukasi</td>
            <td valign="top">:</td>
            <td valign="top" colspan="2">
                <span>
                    <input type="checkbox" <?= $params->kebutuhan_edukasi->hak === 'Hak untuk berpartisipasi pada proses pelayanan' ? 'checked' : '' ?>>Hak untuk berpartisipasi pada proses pelayanan
                </span>
            </td>
            <td valign="top" colspan="2">
                <span>
                    <input type="checkbox" <?= $params->kebutuhan_edukasi->proses === 'Proses pemberian informasi consent' ? 'checked' : '' ?>>Proses pemberian informasi consent
                </span>
            </td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td valign="top" colspan="2">
                <span>
                    <input type="checkbox" <?= $params->kebutuhan_edukasi->almed === 'Penggunaan alat medis yang aman' ? 'checked' : '' ?>>Penggunaan alat medis yang aman
                </span>
            </td>
            <td valign="top" colspan="2">
                <span>
                    <input type="checkbox" <?= $params->kebutuhan_edukasi->cuci === 'Cuci tangan yang benar' ? 'checked' : '' ?>>Cuci tangan yang benar
                </span>
            </td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td valign="top" colspan="4">
                <span>
                    <input type="checkbox" <?= $params->kebutuhan_edukasi->rujukan === 'Rujukan Edukasi' ? 'checked' : '' ?>>Rujukan Edukasi
                </span>
            </td>
        </tr>
    </table>
    
    <table border="0" class="edukasi">
        <tr>
            <td><b>B. EDUKASI</b></td>
        </tr>
    </table>
    
    <table class="table-bordered" style="width:100%; margin-top:5px; font-size: 10px;">
        <thead>
            <tr>
                <th rowspan="2" style="width:12%;">TGL &amp; JAM EDUKASI</th>
                <th rowspan="2" style="width:30%;">MATERI EDUKASI BERDASARKAN KEBUTUHAN</th>
                <th rowspan="2" style="width:25%;">SARANA EDUKASI</th>
                <th rowspan="2" style="width:8%;">LAMA EDUKASI (MENIT)</th>
                <th rowspan="2" style="width:25%;">HASIL VERIFIKASI</th>
                <th rowspan="2" style="width:12%;">TGL RE-EDUKASI / RE-DEMONSTRASI</th>
                <th rowspan="2" style="width:12%;">Tempat</th>
                <th colspan="2" style="width:16%;">TTD &amp; NAMA JELAS</th>
            </tr>
            <tr>
                <th style="width: 50%;">PEMBERI EDUKASI</th>
                <th style="width: 50%;">PASIEN / KELUARGA<br>(HUBUNGAN)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td valign="top">
                    <?= $params->baris_satu->tanggal_indo ?>, <?= $params->baris_satu->jam ?> WIB
                </td>
                <td valign="top">
                    <p><b>1. Admision :</b></p>
                    <input type="checkbox" <?= $params->baris_satu->materi->jenis === 'Jenis dan fasilitas pelayanan rumah sakit' ? 'checked' : '' ?>>Jenis dan fasilitas pelayanan rumah sakit
                    <br />
                    <input type="checkbox" <?= $params->baris_satu->materi->akses === 'Akses dan alur mendapatkan pelayanan rumah sakit' ? 'checked' : '' ?>>Akses dan alur mendapatkan pelayanan rumah sakit
                </td>
                <td valign="top">
                    <input type="checkbox" <?= $params->baris_satu->sarana_edukasi->lea === 'Leaflet' ? 'checked' : '' ?>>Leaflet
                    <br />
                    <input type="checkbox" <?= $params->baris_satu->sarana_edukasi->boo === 'Booklet' ? 'checked' : '' ?>>Booklet
                    <br />
                    <input type="checkbox" <?= $params->baris_satu->sarana_edukasi->lembar === 'Lembar balik' ? 'checked' : '' ?>>Lembar balik
                    <br />
                    <input type="checkbox" <?= $params->baris_satu->sarana_edukasi->audio === 'Audio visual' ? 'checked' : '' ?>>Audio visual
                    <br />
                    <input type="checkbox" <?= $params->baris_satu->sarana_edukasi->lisan === 'Lisan' ? 'checked' : '' ?>>Lisan
                </td>
                <td valign="top"><?= $params->baris_satu->lama_edukasi ?></td>
                <td valign="top">
                    <input type="checkbox" <?= $params->baris_satu->hasil === 'Sudah mengerti' ? 'checked' : '' ?>>Sudah mengerti
                    <br />
                    <input type="checkbox" <?= $params->baris_satu->hasil === 'Re - edukasi' ? 'checked' : '' ?>>Re - edukasi
                    <br />
                    <input type="checkbox" <?= $params->baris_satu->hasil === 'Re - demonstrasi' ? 'checked' : '' ?>>Re - demonstrasi
                </td>
                <td valign="top"><?= $params->baris_satu->tanggal_re_indo ?></td>
                <td valign="top"><?= $params->baris_satu->tempat ?></td>
                <td align="center">
                    <img src="<?= $params->baris_satu->pemberi_stroke ?>" class="tanda-tangan" style="display: block;margin-top: 10px">
                    <p style="margin-top: 10px">
                        <?= $params->baris_satu->pemberi ?>
                    </p>
                </td>
                <td align="center">
                    <img src="<?= $params->baris_satu->pasien_stroke ?>" class="tanda-tangan" style="display: block;margin-top: 10px">
                    <p style="margin-top: 10px">
                        <?= $params->baris_satu->pasien ?>
                    </p>
                </td>
            </tr>
            <tr>
                <td valign="top">
                    <?= $params->baris_dua->tanggal_indo ?>, <?= $params->baris_dua->jam ?> WIB
                </td>
                <td valign="top">
                    <p><b>2. Dokter :</b></p>
                    <input type="checkbox" <?= $params->baris_dua->materi->awal === 'Assesment awal dan kondisi pasien' ? 'checked' : '' ?>>Assesment awal dan kondisi pasien
                    <br />
                    <input type="checkbox" <?= $params->baris_dua->materi->diag === 'Diagnosa pasien' ? 'checked' : '' ?>>Diagnosa pasien
                    <br />
                    <input type="checkbox" <?= $params->baris_dua->materi->rencana === 'Rencana asuhan' ? 'checked' : '' ?>>Rencana asuhan
                    <br />
                    <input type="checkbox" <?= $params->baris_dua->materi->ass === 'Assesment nyeri' ? 'checked' : '' ?>>Assesment nyeri
                    <br />
                    <input type="checkbox" <?= $params->baris_dua->materi->manag === 'Management nyeri' ? 'checked' : '' ?>>Management nyeri
                    <br />
                    <input type="checkbox" <?= $params->baris_dua->materi->ulang === 'Assesment ulang tentang hasil asuhan yang sudah diberikan' ? 'checked' : '' ?>>Assesment ulang tentang hasil asuhan yang sudah diberikan
                    <br />
                    <input type="checkbox" <?= $params->baris_dua->materi->lanjut === 'Pengobatan lanjutan' ? 'checked' : '' ?>>Pengobatan lanjutan
                    <br />
                    <input type="checkbox" <?= $params->baris_dua->materi->harap === 'Pengobatan yang tidak diharapkan' ? 'checked' : '' ?>>Pengobatan yang tidak diharapkan
                    <br />
                    <input type="checkbox" <?= $params->baris_dua->materi->lanjutan === 'Asuhan lanjutan' ? 'checked' : '' ?>>Asuhan lanjutan
                    <br />
                    <span style="padding-left: 20px;">
                        <input type="checkbox" <?= $params->baris_dua->materi->lanjutan_apa === 'Di Rumah' ? 'checked' : '' ?>>Di Rumah
                    </span>
                    <br />
                    <span style="padding-left: 20px;">
                        <input type="checkbox" <?= $params->baris_dua->materi->lanjutan_apa === 'Rujuk' ? 'checked' : '' ?>>Rujuk
                    </span>
                </td>
                <td valign="top">
                    <input type="checkbox" <?= $params->baris_dua->sarana_edukasi->lea === 'Leaflet' ? 'checked' : '' ?>>Leaflet
                    <br />
                    <input type="checkbox" <?= $params->baris_dua->sarana_edukasi->boo === 'Booklet' ? 'checked' : '' ?>>Booklet
                    <br />
                    <input type="checkbox" <?= $params->baris_dua->sarana_edukasi->lembar === 'Lembar balik' ? 'checked' : '' ?>>Lembar balik
                    <br />
                    <input type="checkbox" <?= $params->baris_dua->sarana_edukasi->audio === 'Audio visual' ? 'checked' : '' ?>>Audio visual
                    <br />
                    <input type="checkbox" <?= $params->baris_dua->sarana_edukasi->lisan === 'Lisan' ? 'checked' : '' ?>>Lisan
                </td>
                <td valign="top"><?= $params->baris_dua->lama_edukasi ?></td>
                <td valign="top">
                    <input type="checkbox" <?= $params->baris_dua->hasil_ass_diag === 'Sudah mengerti' ? 'checked' : '' ?>>Sudah mengerti
                    <br />
                    <input type="checkbox" <?= $params->baris_dua->hasil_ass_diag === 'Re - edukasi' ? 'checked' : '' ?>>Re - edukasi
                    <br />
                    <input type="checkbox" <?= $params->baris_dua->hasil_ass_diag === 'Re - demonstrasi' ? 'checked' : '' ?>>Re - demonstrasi
                    <br />
                    <br />
                    <input type="checkbox" <?= $params->baris_dua->hasil_rencana_ass === 'Sudah mengerti' ? 'checked' : '' ?>>Sudah mengerti
                    <br />
                    <input type="checkbox" <?= $params->baris_dua->hasil_rencana_ass === 'Re - edukasi' ? 'checked' : '' ?>>Re - edukasi
                    <br />
                    <input type="checkbox" <?= $params->baris_dua->hasil_rencana_ass === 'Re - demonstrasi' ? 'checked' : '' ?>>Re - demonstrasi
                    <br />
                    <br />
                    <input type="checkbox" <?= $params->baris_dua->hasil_obat_lanjut === 'Sudah mengerti' ? 'checked' : '' ?>>Sudah mengerti
                    <br />
                    <input type="checkbox" <?= $params->baris_dua->hasil_obat_lanjut === 'Re - edukasi' ? 'checked' : '' ?>>Re - edukasi
                    <br />
                    <input type="checkbox" <?= $params->baris_dua->hasil_obat_lanjut === 'Re - demonstrasi' ? 'checked' : '' ?>>Re - demonstrasi
                </td>
                <td valign="top"><?= $params->baris_dua->tanggal_re_indo ?></td>
                <td valign="top"><?= $params->baris_dua->tempat ?></td>
                <td align="center">
                    <img src="<?= $params->baris_dua->pemberi_stroke ?>" class="tanda-tangan" style="display: block;margin-top: 10px">
                    <p style="margin-top: 10px">
                        <?= $params->baris_dua->pemberi ?>
                    </p>
                </td>
                <td align="center">
                    <img src="<?= $params->baris_dua->pasien_stroke ?>" class="tanda-tangan" style="display: block;margin-top: 10px">
                    <p style="margin-top: 10px">
                        <?= $params->baris_dua->pasien ?>
                    </p>
                </td>
            </tr>
            <tr>
                <td valign="top">
                    <?= $params->baris_tiga->tanggal_indo ?>, <?= $params->baris_tiga->jam ?> WIB
                </td>
                <td valign="top">
                    <p><b>3. Gizi :</b></p>
                    <input type="checkbox" <?= $params->baris_tiga->materi->diet === 'Diet & Nutrisi' ? 'checked' : '' ?>>Diet &amp; Nutrisi
                    <br />
                    <input type="checkbox" <?= $params->baris_tiga->materi->nyuluh === 'Penyuluhan' ? 'checked' : '' ?>>Penyuluhan
                    <br />
                    <input type="checkbox" <?= $params->baris_tiga->materi->kunci === '5 Kunci keamanan Pangan' ? 'checked' : '' ?>>5 Kunci keamanan Pangan
                </td>
                <td valign="top">
                    <input type="checkbox" <?= $params->baris_tiga->sarana_edukasi->lea === 'Leaflet' ? 'checked' : '' ?>>Leaflet
                    <br />
                    <input type="checkbox" <?= $params->baris_tiga->sarana_edukasi->boo === 'Booklet' ? 'checked' : '' ?>>Booklet
                    <br />
                    <input type="checkbox" <?= $params->baris_tiga->sarana_edukasi->lembar === 'Lembar balik' ? 'checked' : '' ?>>Lembar balik
                    <br />
                    <input type="checkbox" <?= $params->baris_tiga->sarana_edukasi->audio === 'Audio visual' ? 'checked' : '' ?>>Audio visual
                    <br />
                    <input type="checkbox" <?= $params->baris_tiga->sarana_edukasi->lisan === 'Lisan' ? 'checked' : '' ?>>Lisan
                </td>
                <td valign="top"><?= $params->baris_tiga->lama_edukasi ?></td>
                <td valign="top">
                    <input type="checkbox" <?= $params->baris_tiga->hasil === 'Sudah mengerti' ? 'checked' : '' ?>>Sudah mengerti
                    <br />
                    <input type="checkbox" <?= $params->baris_tiga->hasil === 'Re - edukasi' ? 'checked' : '' ?>>Re - edukasi
                    <br />
                    <input type="checkbox" <?= $params->baris_tiga->hasil === 'Re - demonstrasi' ? 'checked' : '' ?>>Re - demonstrasi
                </td>
                <td valign="top"><?= $params->baris_tiga->tanggal_re_indo ?></td>
                <td valign="top"><?= $params->baris_tiga->tempat ?></td>
                <td align="center">
                    <img src="<?= $params->baris_tiga->pemberi_stroke ?>" class="tanda-tangan" style="display: block;margin-top: 10px">
                    <p style="margin-top: 10px">
                        <?= $params->baris_tiga->pemberi ?>
                    </p>
                </td>
                <td align="center">
                    <img src="<?= $params->baris_tiga->pasien_stroke ?>" class="tanda-tangan" style="display: block;margin-top: 10px">
                    <p style="margin-top: 10px">
                        <?= $params->baris_tiga->pasien ?>
                    </p>
                </td>
            </tr>
            <tr>
                <td valign="top">
                    <?= $params->baris_empat->tanggal_indo ?>, <?= $params->baris_empat->jam ?> WIB
                </td>
                <td valign="top">
                    <p><b>4. Farmasi :</b></p>
                    <input type="checkbox" <?= $params->baris_empat->materi->obat === 'Cara penggunaan obat-obatan yang efektif dan aman' ? 'checked' : '' ?>>Cara penggunaan obat-obatan yang efektif dan aman
                    <br />
                    <input type="checkbox" <?= $params->baris_empat->materi->efek === 'Potensi efek samping obat-obatan yang diberikan' ? 'checked' : '' ?>>Potensi efek samping obat-obatan yang diberikan
                    <br />
                    <input type="checkbox" <?= $params->baris_empat->materi->potensi === 'Potensi interaksi obat dengan obat dan atau obat dengan makanan' ? 'checked' : '' ?>>Potensi interaksi obat dengan obat dan atau obat dengan makanan
                </td>
                <td valign="top">
                    <input type="checkbox" <?= $params->baris_empat->sarana_edukasi->lea === 'Leaflet' ? 'checked' : '' ?>>Leaflet
                    <br />
                    <input type="checkbox" <?= $params->baris_empat->sarana_edukasi->boo === 'Booklet' ? 'checked' : '' ?>>Booklet
                    <br />
                    <input type="checkbox" <?= $params->baris_empat->sarana_edukasi->lembar === 'Lembar balik' ? 'checked' : '' ?>>Lembar balik
                    <br />
                    <input type="checkbox" <?= $params->baris_empat->sarana_edukasi->audio === 'Audio visual' ? 'checked' : '' ?>>Audio visual
                    <br />
                    <input type="checkbox" <?= $params->baris_empat->sarana_edukasi->lisan === 'Lisan' ? 'checked' : '' ?>>Lisan
                </td>
                <td valign="top"><?= $params->baris_empat->lama_edukasi ?></td>
                <td valign="top">
                    <input type="checkbox" <?= $params->baris_empat->hasil === 'Sudah mengerti' ? 'checked' : '' ?>>Sudah mengerti
                    <br />
                    <input type="checkbox" <?= $params->baris_empat->hasil === 'Re - edukasi' ? 'checked' : '' ?>>Re - edukasi
                    <br />
                    <input type="checkbox" <?= $params->baris_empat->hasil === 'Re - demonstrasi' ? 'checked' : '' ?>>Re - demonstrasi
                </td>
                <td valign="top"><?= $params->baris_empat->tanggal_re_indo ?></td>
                <td valign="top"><?= $params->baris_empat->tempat ?></td>
                <td align="center">
                    <img src="<?= $params->baris_empat->pemberi_stroke ?>" class="tanda-tangan" style="display: block;margin-top: 10px">
                    <p style="margin-top: 10px">
                        <?= $params->baris_empat->pemberi ?>
                    </p>
                </td>
                <td align="center">
                    <img src="<?= $params->baris_empat->pasien_stroke ?>" class="tanda-tangan" style="display: block;margin-top: 10px">
                    <p style="margin-top: 10px">
                        <?= $params->baris_empat->pasien ?>
                    </p>
                </td>
            </tr>
            <tr>
                <td valign="top">
                    <?= $params->baris_lima->tanggal_indo ?>, <?= $params->baris_lima->jam ?> WIB
                </td>
                <td valign="top">
                    <p><b>5. Keperawatan :</b></p>
                    <input type="checkbox" <?= $params->baris_lima->materi->orien === 'Orientasi ruang perawatan' ? 'checked' : '' ?>>Orientasi ruang perawatan
                    <br />
                    <input type="checkbox" <?= $params->baris_lima->materi->almed === 'Penggunaan peralatan medis yang efektif dan aman' ? 'checked' : '' ?>>Penggunaan peralatan medis yang efektif dan aman
                    <br />
                    <span style="padding-left: 20px;">
                        <input type="checkbox" <?= $params->baris_lima->materi->almed_apa === 'Tensimeter' ? 'checked' : '' ?>>Tensimeter
                    </span>
                    <br />
                    <span style="padding-left: 20px;">
                        <input type="checkbox" <?= $params->baris_lima->materi->almed_apa === 'Termometer' ? 'checked' : '' ?>>Termometer
                    </span>
                    <br />
                    <span style="padding-left: 20px;">
                        <input type="checkbox" <?= $params->baris_lima->materi->almed_apa === 'Lainnya' ? 'checked' : '' ?>>
                        <?= $params->baris_lima->materi->almed_lain ?>
                    </span>
                    <br />
                    <input type="checkbox" <?= $params->baris_lima->materi->cara === 'Cara batuk efektif' ? 'checked' : '' ?>>Cara batuk efektif
                    <br />
                    <input type="checkbox" <?= $params->baris_lima->materi->pengkajian === 'Pengkajian' ? 'checked' : '' ?>>Pengkajian
                    <br />
                    <input type="checkbox" <?= $params->baris_lima->materi->diag === 'Diagnosa' ? 'checked' : '' ?>>Diagnosa
                    <br />
                    <input type="checkbox" <?= $params->baris_lima->materi->rencana === 'Rencana tindakan' ? 'checked' : '' ?>>Rencana tindakan
                    <br />
                    <input type="checkbox" <?= $params->baris_lima->materi->ass === 'Assesmen dan Manajemen nyeri' ? 'checked' : '' ?>>Assesmen dan Manajemen nyeri
                    <br />
                    <input type="checkbox" <?= $params->baris_lima->materi->adl === 'ADL' ? 'checked' : '' ?>>ADL
                    <br />
                    <span style="padding-left: 20px;">
                        <input type="checkbox" <?= $params->baris_lima->materi->adl_apa === 'Personal Hygiene' ? 'checked' : '' ?>>Personal Hygiene
                    </span>
                    <br />
                    <span style="padding-left: 20px;">
                        <input type="checkbox" <?= $params->baris_lima->materi->adl_apa === 'Vulva Hygiene' ? 'checked' : '' ?>>Vulva Hygiene
                    </span>
                    <br />
                    <span style="padding-left: 20px;">
                        <input type="checkbox" <?= $params->baris_lima->materi->adl_apa === 'Lainnya' ? 'checked' : '' ?>>
                        <?= $params->baris_lima->materi->adl_lain ?>
                    </span>
                    <br />
                    <input type="checkbox" <?= $params->baris_lima->materi->waktu === 'Waktu control' ? 'checked' : '' ?>>Waktu control
                    <br />
                    <input type="checkbox" <?= $params->baris_lima->materi->rumah === 'Penanganan dan cara perawatan di rumah' ? 'checked' : '' ?>>Penanganan dan cara perawatan di rumah
                </td>
                <td valign="top">
                    <input type="checkbox" <?= $params->baris_lima->sarana_edukasi->lea === 'Leaflet' ? 'checked' : '' ?>>Leaflet
                    <br />
                    <input type="checkbox" <?= $params->baris_lima->sarana_edukasi->boo === 'Booklet' ? 'checked' : '' ?>>Booklet
                    <br />
                    <input type="checkbox" <?= $params->baris_lima->sarana_edukasi->lembar === 'Lembar balik' ? 'checked' : '' ?>>Lembar balik
                    <br />
                    <input type="checkbox" <?= $params->baris_lima->sarana_edukasi->audio === 'Audio visual' ? 'checked' : '' ?>>Audio visual
                    <br />
                    <input type="checkbox" <?= $params->baris_lima->sarana_edukasi->lisan === 'Lisan' ? 'checked' : '' ?>>Lisan
                </td>
                <td valign="top"><?= $params->baris_lima->lama_edukasi ?></td>
                <td valign="top">
                    <input type="checkbox" <?= $params->baris_lima->hasil_orien_almed === 'Sudah mengerti' ? 'checked' : '' ?>>Sudah mengerti
                    <br />
                    <input type="checkbox" <?= $params->baris_lima->hasil_orien_almed === 'Re - edukasi' ? 'checked' : '' ?>>Re - edukasi
                    <br />
                    <input type="checkbox" <?= $params->baris_lima->hasil_orien_almed === 'Re - demonstrasi' ? 'checked' : '' ?>>Re - demonstrasi
                    <br />
                    <br />
                    <input type="checkbox" <?= $params->baris_lima->hasil_cuci_adl === 'Sudah mengerti' ? 'checked' : '' ?>>Sudah mengerti
                    <br />
                    <input type="checkbox" <?= $params->baris_lima->hasil_cuci_adl === 'Re - edukasi' ? 'checked' : '' ?>>Re - edukasi
                    <br />
                    <input type="checkbox" <?= $params->baris_lima->hasil_cuci_adl === 'Re - demonstrasi' ? 'checked' : '' ?>>Re - demonstrasi
                    <br />
                    <br />
                    <input type="checkbox" <?= $params->baris_lima->hasl_wkt_cara === 'Sudah mengerti' ? 'checked' : '' ?>>Sudah mengerti
                    <br />
                    <input type="checkbox" <?= $params->baris_lima->hasl_wkt_cara === 'Re - edukasi' ? 'checked' : '' ?>>Re - edukasi
                    <br />
                    <input type="checkbox" <?= $params->baris_lima->hasl_wkt_cara === 'Re - demonstrasi' ? 'checked' : '' ?>>Re - demonstrasi
                </td>
                <td valign="top"><?= $params->baris_lima->tanggal_re_indo ?></td>
                <td valign="top"><?= $params->baris_lima->tempat ?></td>
                <td align="center">
                    <img src="<?= $params->baris_lima->pemberi_stroke ?>" class="tanda-tangan" style="display: block;margin-top: 10px">
                    <p style="margin-top: 10px">
                        <?= $params->baris_lima->pemberi ?>
                    </p>
                </td>
                <td align="center">
                    <img src="<?= $params->baris_lima->pasien_stroke ?>" class="tanda-tangan" style="display: block;margin-top: 10px">
                    <p style="margin-top: 10px">
                        <?= $params->baris_lima->pasien ?>
                    </p>
                </td>
            </tr>
            <tr>
                <td valign="top">
                    <?= $params->baris_enam->tanggal_indo ?>, <?= $params->baris_enam->jam ?> WIB
                </td>
                <td valign="top">
                    <p><b>6. Fisioterapi :</b></p>
                    <input type="checkbox" <?= $params->baris_enam->materi_satu === 'Lainnya' ? 'checked' : '' ?>> <?= $params->baris_enam->materi_satu_apa ?>
                    <br />
                    <input type="checkbox" <?= $params->baris_enam->materi_dua === 'Lainnya' ? 'checked' : '' ?>> <?= $params->baris_enam->materi_dua_apa ?>
                    <br />
                    <input type="checkbox" <?= $params->baris_enam->materi_tiga === 'Lainnya' ? 'checked' : '' ?>> <?= $params->baris_enam->materi_tiga_apa ?>
                    <br />
                    <input type="checkbox" <?= $params->baris_enam->materi_empat === 'Lainnya' ? 'checked' : '' ?>> <?= $params->baris_enam->materi_empat_apa ?>
                </td>
                <td valign="top">
                    <input type="checkbox" <?= $params->baris_enam->sarana_edukasi->lea === 'Leaflet' ? 'checked' : '' ?>>Leaflet
                    <br />
                    <input type="checkbox" <?= $params->baris_enam->sarana_edukasi->boo === 'Booklet' ? 'checked' : '' ?>>Booklet
                    <br />
                    <input type="checkbox" <?= $params->baris_enam->sarana_edukasi->lembar === 'Lembar balik' ? 'checked' : '' ?>>Lembar balik
                    <br />
                    <input type="checkbox" <?= $params->baris_enam->sarana_edukasi->audio === 'Audio visual' ? 'checked' : '' ?>>Audio visual
                    <br />
                    <input type="checkbox" <?= $params->baris_enam->sarana_edukasi->lisan === 'Lisan' ? 'checked' : '' ?>>Lisan
                </td>
                <td valign="top"><?= $params->baris_enam->lama_edukasi ?></td>
                <td valign="top">
                    <input type="checkbox" <?= $params->baris_enam->hasil === 'Sudah mengerti' ? 'checked' : '' ?>>Sudah mengerti
                    <br />
                    <input type="checkbox" <?= $params->baris_enam->hasil === 'Re - edukasi' ? 'checked' : '' ?>>Re - edukasi
                    <br />
                    <input type="checkbox" <?= $params->baris_enam->hasil === 'Re - demonstrasi' ? 'checked' : '' ?>>Re - demonstrasi
                </td>
                <td valign="top"><?= $params->baris_enam->tanggal_re_indo ?></td>
                <td valign="top"><?= $params->baris_enam->tempat ?></td>
                <td align="center">
                    <img src="<?= $params->baris_enam->pemberi_stroke ?>" class="tanda-tangan" style="display: block;margin-top: 10px">
                    <p style="margin-top: 10px">
                        <?= $params->baris_enam->pemberi ?>
                    </p>
                </td>
                <td align="center">
                    <img src="<?= $params->baris_enam->pasien_stroke ?>" class="tanda-tangan" style="display: block;margin-top: 10px">
                    <p style="margin-top: 10px">
                        <?= $params->baris_enam->pasien ?>
                    </p>
                </td>
            </tr>
            <tr>
                <td valign="top">
                    <?= $params->baris_tuju->tanggal_indo ?>, <?= $params->baris_tuju->jam ?> WIB
                </td>
                <td valign="top">
                    <p><b>7. Ponek :</b></p>
                    <input type="checkbox" <?= $params->baris_tuju->materi->bahasa === 'Bahasa pada ibu hamil' ? 'checked' : '' ?>>Bahasa pada ibu hamil
                    <br />
                    <input type="checkbox" <?= $params->baris_tuju->materi->rawat === 'Perawatan nifas' ? 'checked' : '' ?>>Perawatan nifas
                    <br />
                    <input type="checkbox" <?= $params->baris_tuju->materi->cara === 'Cara pemberian ASI' ? 'checked' : '' ?>>Cara pemberian ASI
                    <br />
                    <input type="checkbox" <?= $params->baris_tuju->materi->tanda === 'Tanda bahaya pada bayi' ? 'checked' : '' ?>>Tanda bahaya pada bayi
                    <br />
                    <input type="checkbox" <?= $params->baris_tuju->materi->imd === 'IMD' ? 'checked' : '' ?>>IMD
                    <br />
                    <input type="checkbox" <?= $params->baris_tuju->materi->gabung === 'Rawat gabung' ? 'checked' : '' ?>>Rawat gabung
                    <br />
                    <input type="checkbox" <?= $params->baris_tuju->materi->metode === 'Perawatan metode kanguru (PMK)' ? 'checked' : '' ?>>Perawatan metode kanguru (PMK)
                </td>
                <td valign="top">
                    <input type="checkbox" <?= $params->baris_tuju->sarana_edukasi->lea === 'Leaflet' ? 'checked' : '' ?>>Leaflet
                    <br />
                    <input type="checkbox" <?= $params->baris_tuju->sarana_edukasi->boo === 'Booklet' ? 'checked' : '' ?>>Booklet
                    <br />
                    <input type="checkbox" <?= $params->baris_tuju->sarana_edukasi->lembar === 'Lembar balik' ? 'checked' : '' ?>>Lembar balik
                    <br />
                    <input type="checkbox" <?= $params->baris_tuju->sarana_edukasi->audio === 'Audio visual' ? 'checked' : '' ?>>Audio visual
                    <br />
                    <input type="checkbox" <?= $params->baris_tuju->sarana_edukasi->lisan === 'Lisan' ? 'checked' : '' ?>>Lisan
                </td>
                <td valign="top"><?= $params->baris_tuju->lama_edukasi ?></td>
                <td valign="top">
                    <input type="checkbox" <?= $params->baris_tuju->hasil === 'Sudah mengerti' ? 'checked' : '' ?>>Sudah mengerti
                    <br />
                    <input type="checkbox" <?= $params->baris_tuju->hasil === 'Re - edukasi' ? 'checked' : '' ?>>Re - edukasi
                    <br />
                    <input type="checkbox" <?= $params->baris_tuju->hasil === 'Re - demonstrasi' ? 'checked' : '' ?>>Re - demonstrasi
                </td>
                <td valign="top"><?= $params->baris_tuju->tanggal_re_indo ?></td>
                <td valign="top"><?= $params->baris_tuju->tempat ?></td>
                <td align="center">
                    <img src="<?= $params->baris_tuju->pemberi_stroke ?>" class="tanda-tangan" style="display: block;margin-top: 10px">
                    <p style="margin-top: 10px">
                        <?= $params->baris_tuju->pemberi ?>
                    </p>
                </td>
                <td align="center">
                    <img src="<?= $params->baris_tuju->pasien_stroke ?>" class="tanda-tangan" style="display: block;margin-top: 10px">
                    <p style="margin-top: 10px">
                        <?= $params->baris_tuju->pasien ?>
                    </p>
                </td>
            </tr>
            <tr>
                <td valign="top">
                    <?= $params->baris_delapan->tanggal_indo ?>, <?= $params->baris_delapan->jam ?> WIB
                </td>
                <td valign="top">
                    <p><b>8. Lain-lain :</b></p>
                    <input type="checkbox" <?= $params->baris_delapan->materi_satu === 'Lainnya' ? 'checked' : '' ?>> <?= $params->baris_delapan->materi_satu_apa ?>
                    <br />
                    <input type="checkbox" <?= $params->baris_delapan->materi_dua === 'Lainnya' ? 'checked' : '' ?>> <?= $params->baris_delapan->materi_dua_apa ?>
                    <br />
                    <input type="checkbox" <?= $params->baris_delapan->materi_tiga === 'Lainnya' ? 'checked' : '' ?>> <?= $params->baris_delapan->materi_tiga_apa ?>
                    <br />
                    <input type="checkbox" <?= $params->baris_delapan->materi_empat === 'Lainnya' ? 'checked' : '' ?>> <?= $params->baris_delapan->materi_empat_apa ?>
                </td>
                <td valign="top">
                    <input type="checkbox" <?= $params->baris_delapan->sarana_edukasi->lea === 'Leaflet' ? 'checked' : '' ?>>Leaflet
                    <br />
                    <input type="checkbox" <?= $params->baris_delapan->sarana_edukasi->boo === 'Booklet' ? 'checked' : '' ?>>Booklet
                    <br />
                    <input type="checkbox" <?= $params->baris_delapan->sarana_edukasi->lembar === 'Lembar balik' ? 'checked' : '' ?>>Lembar balik
                    <br />
                    <input type="checkbox" <?= $params->baris_delapan->sarana_edukasi->audio === 'Audio visual' ? 'checked' : '' ?>>Audio visual
                    <br />
                    <input type="checkbox" <?= $params->baris_delapan->sarana_edukasi->lisan === 'Lisan' ? 'checked' : '' ?>>Lisan
                </td>
                <td valign="top"><?= $params->baris_delapan->lama_edukasi ?></td>
                <td valign="top">
                    <input type="checkbox" <?= $params->baris_delapan->hasil === 'Sudah mengerti' ? 'checked' : '' ?>>Sudah mengerti
                    <br />
                    <input type="checkbox" <?= $params->baris_delapan->hasil === 'Re - edukasi' ? 'checked' : '' ?>>Re - edukasi
                    <br />
                    <input type="checkbox" <?= $params->baris_delapan->hasil === 'Re - demonstrasi' ? 'checked' : '' ?>>Re - demonstrasi
                </td>
                <td valign="top"><?= $params->baris_delapan->tanggal_re_indo ?></td>
                <td valign="top"><?= $params->baris_delapan->tempat ?></td>
                <td align="center">
                    <img src="<?= $params->baris_delapan->pemberi_stroke ?>" class="tanda-tangan" style="display: block;margin-top: 10px">
                    <p style="margin-top: 10px">
                        <?= $params->baris_delapan->pemberi ?>
                    </p>
                </td>
                <td align="center">
                    <img src="<?= $params->baris_delapan->pasien_stroke ?>" class="tanda-tangan" style="display: block;margin-top: 10px">
                    <p style="margin-top: 10px">
                        <?= $params->baris_delapan->pasien ?>
                    </p>
                </td>
            </tr>
        </tbody>
    </table>
</body>

</html>