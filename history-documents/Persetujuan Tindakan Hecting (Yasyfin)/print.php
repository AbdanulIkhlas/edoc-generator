<?php
// EMR Data
$params = json_decode($argv[1]);

$base_url = $argv[2]; // Base_url
$title = "Persetujuan Tindakan Hecting";
$static_label = json_decode($argv[3]);

?>

<!DOCTYPE html>
<html>

<head>
    <title><?php echo $title ?></title>
</head>
<style>
    .pagebreak {
        page-break-before: always;
    }

    body {
        /* font: 13pt times new roman;
    size: f4;
    padding-bottom: 10px; */
        font-family: sans-serif;
        font-size: 13pt;
        line-height: 1.3;
    }

    .allign {
        text-align: right;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th td {
        width: 30px;
    }

    td {
        height: 20px;
        vertical-align: top;
    }

    .space {
        padding-top: 20px;
    }

    .img100px {
        width: 100px;
        height: 100px;
    }

    .ttd-image {
        margin-top: 5px;
        margin-bottom: 5px;
        width: 100%;
        height: 100px;
    }

    .borderr-hitam {
        border: 3px;
        width: 100px;
    }

    .space-left {
        margin-left: 40px;
    }

    .dot {
        border-bottom: 1px dotted black;
        margin-top: 9px;
    }

    .line {
        text-decoration: overline;
        width: 100%;
    }

    .underline {
        text-decoration: underline;
    }

    .centerr {
        text-align: center;
    }

    .middle {
        vertical-align: middle;
    }

    .tbl-full {
        width: 100%;
    }

    .borderr {
        border: 1px solid black;
    }

    .ml-1 {
        margin-left: 10px;
    }

    .prg {
        /* text-align: justify; */
        text-justify: inter-word;
    }

    .boldd {
        font-weight: bold;
    }

    .pagee {
        /*width: 210mm;*/
        /*height: 290mm;*/
        margin: auto;
        width: initial;
        min-height: initial;
        box-shadow: initial;
        background: initial;
        /*page-break-after: always;*/
    }

    .tdlonggar {
        padding-top: 5px;
        padding-bottom: 5px;
    }

    .ml-2 {
        margin-left: 20px;
    }

    .ml-3 {
        margin-left: 30px;
    }

    .container {
        display: flex;
        gap: 20px;
        /* Atur jarak antara div */
        align-items: center;
        /* Atur untuk membuat sejajar secara vertikal */
        justify-content: flex-start;
        /* Pilih perataan horizontal yang sesuai */
    }

    .box {
        display: flex;
        flex-direction: column;
        align-items: center;
        /* Agar gambar dan teks berada di tengah */
    }

    .text-bottom {
        vertical-align: bottom;
    }

    .ttd-img {
        width: 120px;
        height: 100px;
        object-fit: contain;
        /* atau contain tergantung kebutuhan */
    }
</style>

<body>
    <div class="pagee">
        <!--<table border="0">-->
        <!--    <tr>-->
        <!--        <td align="right">RM15.1</td>-->
        <!--    </tr>-->
        <!--</table>-->
        <table class="tbl-full">
            <tr class="tdlonggar">
                <td width="15%" style="vertical-align: middle; text-align: center;">
                    <img style="width: 70px" src="<?= $base_url; ?>/images/rs/LogoRS.png">
                </td>
                <td width="40%" style="vertical-align: middle;">
                    <h4 style="margin: 0; font-size: 14pt;"><?php echo $static_label->hospital_name; ?></h4>
                    <div style="font-size: 10pt; line-height: 1.3; margin-top: 5px;">
                        <?php echo !empty($static_label->hospital_address) ? $static_label->hospital_address . "<br>" : ""; ?>
                        <?php echo !empty($static_label->hospital_phone) ? "Telp. " . $static_label->hospital_phone . "<br>" : ""; ?>
                        <?php echo !empty($static_label->hospital_email) ? "Email: " . $static_label->hospital_email : ""; ?>
                    </div>
                </td>
                <td class="borderr" width="45%" style="vertical-align: middle; padding: 10px; font-size:12pt">
                    <table style="width: 100%;">
                        <tr>
                            <td class="col-sm" width="36%">No. RM</td>
                            <td width="1%">:</td>
                            <td><?php echo $params->pasien->no_rm; ?></td>
                        </tr>
                        <tr>
                            <td class="col-sm">Nama Pasien</td>
                            <td>:</td>
                            <td><?php echo $params->pasien->nama; ?></td>
                        </tr>
                        <tr>
                            <td class="col-sm">Tanggal Lahir</td>
                            <td>:</td>
                            <td><?php echo $params->pasien->tanggal_lahir_indo; ?></td>
                        </tr>
                        <tr>
                            <td class="col-sm">Jenis Kelamin</td>
                            <td>:</td>
                            <td><?php
                                if (strtoupper($params->pasien->kelamin)  == 'L') {
                                    echo "Laki-laki";
                                } else if (strtoupper($params->pasien->kelamin) == 'P') {
                                    echo "Perempuan";
                                } else {
                                    echo '';
                                }
                                ?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <br />
        <table width="100%" style="border:none">
            <tr style="border:none">
                <td style="border:none" class="centerr borderr tdlonggar">
                    <b>FORM PERSETUJUAN TINDAKAN KEDOKTERAN</b>
                </td>
            </tr>
        </table>
        <br />
        <table class="tbl-full">
            <tr class="borderr tdlonggar">
                <td width="30%" class="borderr" colspan="2">
                    <div class="ml-1">JENIS TINDAKAN</div>
                </td>
                <td class="borderr" colspan="3">
                    <div class="ml-1"><?php echo $params->jenis_tindakan ?? ''; ?></div>
                </td>
            </tr>
            <tr class="borderr tdlonggar">
                <td width="30%" class="borderr" colspan="2">
                    <div class="ml-1">Dokter Pelaksana Tindakan</div>
                </td>
                <td class="borderr" colspan="3">
                    <div class="ml-1"><?php echo $params->dokter_pelaksana; ?></div>
                </td>
            </tr>
            <tr class="borderr tdlonggar">
                <td class="borderr" colspan="2">
                    <div class="ml-1">Pemberi Informasi</div>
                </td>
                <td class="borderr" colspan="3">
                    <div class="ml-1"><?php echo $params->ttd_data->dokter; ?></div>
                </td>
            </tr>
            <tr class="borderr tdlonggar">
                <td class="borderr" colspan="2">
                    <div class="ml-1">Penerima Informasi / Pemberi Persetujuan*</div>
                </td>
                <td class="borderr" colspan="3">
                    <div class="ml-1"><?php echo $params->ttd_data->penerima; ?></div>
                </td>
            </tr>
            <tr class="borderr tdlonggar">
                <td class="borderr" colspan="2">
                    <div class="ml-1">Diberikan Pada waktu</div>
                </td>
                <td class="borderr">
                    <div class="ml-1">Tanggal : <?php echo $params->tanggal_pemberian_indo ?? ''; ?></div>
                </td>
                <td class="borderr" colspan="2">
                    <div class="ml-1">Jam : <?php echo $params->jam_pemberian ?? ''; ?></div>
                </td>
            </tr>
            <tr class="tdlonggar">
                <td width="5%" class="borderr centerr boldd" rowspan="2" style="vertical-align:middle">
                    NO
                </td>
                <td width="25%" class="borderr centerr boldd" rowspan="2" style="vertical-align:middle">
                    JENIS INFORMASI
                </td>
                <td width="40%" class="borderr centerr boldd" rowspan="2" style="vertical-align:middle">
                    ISI INFORMASI
                </td>
                <td width="30%" class="borderr centerr boldd" colspan="2" style="vertical-align:middle">
                    TANDA (&radic;)
                </td>
            </tr>
            <tr class="tdlonggar">
                <td width="15%" class="borderr centerr boldd" style="vertical-align:middle">MENGERTI</td>
                <td width="15%" class="borderr centerr boldd" style="vertical-align:middle">RE EDUKASI</td>
            </tr>
            <?php $no = 1; ?>
            <tr>
                <td class="borderr centerr ">
                    <?php echo $no++ . '.'; ?>
                </td>
                <td class="borderr">
                    <div class="ml-1">Diagnosa (WD dan DD)</div>
                </td>
                <td class="borderr ml-1">
                    <!--<?php echo nl2br($params->jenis_informasi->diagnosa->isi_informasi); ?>-->
                    <?php echo nl2br($params->diagnosa_group); ?>
                </td>
                <td class="borderr centerr middle">
                    <?php echo ($params->jenis_informasi->diagnosa->tanda == "Ya" ? "V" : ""); ?>
                </td>
                <td class="borderr centerr middle">
                    <?php echo ($params->jenis_informasi->diagnosa->tanda_2 == "Ya" ? "V" : ""); ?>
                </td>
            </tr>
            <tr>
                <td class="borderr centerr ">
                    <?php echo $no++ . '.'; ?>
                </td>
                <td class="borderr">
                    <div class="ml-1">Dasar Diagnosis</div>
                </td>
                <td class="borderr ml-1">
                    <?php echo nl2br($params->jenis_informasi->dasar_diagnosa->isi_informasi); ?>
                </td>
                <td class="borderr centerr middle">
                    <?php echo ($params->jenis_informasi->dasar_diagnosa->tanda == "Ya" ? "V" : ""); ?>
                </td>
                <td class="borderr centerr middle">
                    <?php echo ($params->jenis_informasi->dasar_diagnosa->tanda_2 == "Ya" ? "V" : ""); ?>
                </td>
            </tr>
            <tr>
                <td class="borderr centerr ">
                    <?php echo $no++ . '.'; ?>
                </td>
                <td class="borderr">
                    <div class="ml-1">Tindakan Medis</div>
                </td>
                <td class="borderr ml-1">
                    <?php echo nl2br($params->jenis_informasi->tindakan_medis->isi_informasi); ?>
                </td>
                <td class="borderr centerr middle">
                    <?php echo ($params->jenis_informasi->tindakan_medis->tanda == "Ya" ? "V" : ""); ?>
                </td>
                <td class="borderr centerr middle">
                    <?php echo ($params->jenis_informasi->tindakan_medis->tanda_2 == "Ya" ? "V" : ""); ?>
                </td>
            </tr>
            <tr>
                <td class="borderr centerr ">
                    <?php echo $no++ . '.'; ?>
                </td>
                <td class="borderr">
                    <div class="ml-1">
                        Tindakan Pemeriksaan Penunjang (Laboratorium, Radiologi dll )
                    </div>
                </td>
                <td class="borderr ml-1">
                    <?php echo nl2br($params->jenis_informasi->tindakan_pemeriksaan->isi_informasi); ?>
                </td>
                <td class="borderr centerr middle">
                    <?php echo ($params->jenis_informasi->tindakan_pemeriksaan->tanda == "Ya" ? "V" : ""); ?>
                </td>
                <td class="borderr centerr middle">
                    <?php echo ($params->jenis_informasi->tindakan_pemeriksaan->tanda_2 == "Ya" ? "V" : ""); ?>
                </td>
            </tr>
            <tr>
                <td class="borderr centerr ">
                    <?php echo $no++ . '.'; ?>
                </td>
                <td class="borderr">
                    <div class="ml-1">Alat Kesehatan yang dipasang</div>
                </td>
                <td class="borderr ml-1">
                    <?php echo nl2br($params->jenis_informasi->alat_kesehatan->isi_informasi); ?>
                </td>
                <td class="borderr centerr middle">
                    <?php echo ($params->jenis_informasi->alat_kesehatan->tanda == "Ya" ? "V" : ""); ?>
                </td>
                <td class="borderr centerr middle">
                    <?php echo ($params->jenis_informasi->alat_kesehatan->tanda_2 == "Ya" ? "V" : ""); ?>
                </td>
            </tr>
            <tr>
                <td class="borderr centerr ">
                    <?php echo $no++ . '.'; ?>
                </td>
                <td class="borderr">
                    <div class="ml-1">Indikasi tindakan</div>
                </td>
                <td class="borderr ml-1">
                    <?php echo nl2br($params->jenis_informasi->indikasi_tindakan->isi_informasi); ?>
                </td>
                <td class="borderr centerr middle">
                    <?php echo ($params->jenis_informasi->indikasi_tindakan->tanda == "Ya" ? "V" : ""); ?>
                </td>
                <td class="borderr centerr middle">
                    <?php echo ($params->jenis_informasi->indikasi_tindakan->tanda_2 == "Ya" ? "V" : ""); ?>
                </td>
            </tr>
            <tr>
                <td class="borderr centerr ">
                    <?php echo $no++ . '.'; ?>
                </td>
                <td class="borderr">
                    <div class="ml-1">Tata Cara</div>
                </td>
                <td class="borderr ml-1">
                    <?php echo nl2br($params->jenis_informasi->tata_cara->isi_informasi); ?>
                </td>
                <td class="borderr centerr middle">
                    <?php echo ($params->jenis_informasi->tata_cara->tanda == "Ya" ? "V" : ""); ?>
                </td>
                <td class="borderr centerr middle">
                    <?php echo ($params->jenis_informasi->tata_cara->tanda_2 == "Ya" ? "V" : ""); ?>
                </td>
            </tr>
            <tr>
                <td class="borderr centerr ">
                    <?php echo $no++ . '.'; ?>
                </td>
                <td class="borderr">
                    <div class="ml-1">Tujuan</div>
                </td>
                <td class="borderr ml-1">
                    <?php echo nl2br($params->jenis_informasi->tujuan->isi_informasi); ?>
                </td>
                <td class="borderr centerr middle">
                    <?php echo ($params->jenis_informasi->tujuan->tanda == "Ya" ? "V" : ""); ?>
                </td>
                <td class="borderr centerr middle">
                    <?php echo ($params->jenis_informasi->tujuan->tanda_2 == "Ya" ? "V" : ""); ?>
                </td>
            </tr>
            <tr>
                <td class="borderr centerr ">
                    <?php echo $no++ . '.'; ?>
                </td>
                <td class="borderr">
                    <div class="ml-1">Resiko</div>
                </td>
                <td class="borderr ml-1">
                    <?php echo nl2br($params->jenis_informasi->risiko->isi_informasi); ?>
                </td>
                <td class="borderr centerr middle">
                    <?php echo ($params->jenis_informasi->risiko->tanda == "Ya" ? "V" : ""); ?>
                </td>
                <td class="borderr centerr middle">
                    <?php echo ($params->jenis_informasi->risiko->tanda_2 == "Ya" ? "V" : ""); ?>
                </td>
            </tr>
            <tr>
                <td class="borderr centerr ">
                    <?php echo $no++ . '.'; ?>
                </td>
                <td class="borderr">
                    <div class="ml-1">Komplikasi</div>
                </td>
                <td class="borderr ml-1">
                    <?php echo nl2br($params->jenis_informasi->komplikasi->isi_informasi); ?>
                </td>
                <td class="borderr centerr middle">
                    <?php echo ($params->jenis_informasi->komplikasi->tanda == "Ya" ? "V" : ""); ?>
                </td>
                <td class="borderr centerr middle">
                    <?php echo ($params->jenis_informasi->komplikasi->tanda_2 == "Ya" ? "V" : ""); ?>
                </td>
            </tr>
            <tr>
                <td class="borderr centerr ">
                    <?php echo $no++ . '.'; ?>
                </td>
                <td class="borderr">
                    <div class="ml-1">Prognosis</div>
                </td>
                <td class="borderr ml-1">
                    <?php echo nl2br($params->jenis_informasi->prognosis->isi_informasi); ?>
                </td>
                <td class="borderr centerr middle">
                    <?php echo ($params->jenis_informasi->prognosis->tanda == "Ya" ? "V" : ""); ?>
                </td>
                <td class="borderr centerr middle">
                    <?php echo ($params->jenis_informasi->prognosis->tanda_2 == "Ya" ? "V" : ""); ?>
                </td>
            </tr>
            <tr>
                <td class="borderr centerr ">
                    <?php echo $no++ . '.'; ?>
                </td>
                <td class="borderr">
                    <div class="ml-1">Resiko bila tidak dilakukan tindakan</div>
                </td>
                <td class="borderr ml-1">
                    <?php echo nl2br($params->jenis_informasi->risiko_bila_tidak_dilakukan_tindakan->isi_informasi); ?>
                </td>
                <td class="borderr centerr middle">
                    <?php echo ($params->jenis_informasi->risiko_bila_tidak_dilakukan_tindakan->tanda == "Ya" ? "V" : ""); ?>
                </td>
                <td class="borderr centerr middle">
                    <?php echo ($params->jenis_informasi->risiko_bila_tidak_dilakukan_tindakan->tanda_2 == "Ya" ? "V" : ""); ?>
                </td>
            </tr>
            <tr>
                <td class="borderr centerr ">
                    <?php echo $no++ . '.'; ?>
                </td>
                <td class="borderr">
                    <div class="ml-1">Alternatif</div>
                </td>
                <td class="borderr ml-1">
                    <?php echo nl2br($params->jenis_informasi->alternatif->isi_informasi); ?>
                </td>
                <td class="borderr centerr middle">
                    <?php echo ($params->jenis_informasi->alternatif->tanda == "Ya" ? "V" : ""); ?>
                </td>
                <td class="borderr centerr middle">
                    <?php echo ($params->jenis_informasi->alternatif->tanda_2 == "Ya" ? "V" : ""); ?>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="borderr">
                    <div class="ml-1">Lain-lain</div>
                </td>
                <td class="borderr ml-1">
                    <?php echo nl2br($params->jenis_informasi->lain_lain->isi_informasi); ?>
                </td>
                <td class="borderr centerr middle">
                    <?php echo ($params->jenis_informasi->lain_lain->tanda == "Ya" ? "V" : ""); ?>
                </td>
                <td class="borderr centerr middle">
                    <?php echo ($params->jenis_informasi->lain_lain->tanda_2 == "Ya" ? "V" : ""); ?>
                </td>
            </tr>
        </table>
        <table class="tbl-full">
            <tr>
                <td width="70%" class="borderr">
                    <div class="ml-1 prg">
                        Dengan ini menyatakan bahwa saya dokter <?php echo !empty($params->ttd_data->dokter) ? $params->ttd_data->dokter : '................................'; ?>
                        telah menerangkan hal-hal diatas secara benar dan jelas dan memberikan kesempatan
                        untuk bertanya dan / atau berdiskusi
                    </div>
                </td>
                <td class="centerr borderr">
                    Tanda tangan
                    <div class="ttd-image">
                        <img src="<?php echo $params->ttd_data->dokter_stroke  ?>" style="height: 90px; width: auto; display: block; margin: 10px auto;">
                    </div>
                    <?php echo $params->ttd_data->dokter ?>
                </td>
            </tr>
            <tr>
                <td width="70%" class="borderr">
                    <div class="ml-1 prg">
                        Dengan ini menyatakan bahwa <?php echo !empty($params->yang_menyatakan) ? $params->yang_menyatakan : 'saya / keluarga pasien'; ?> <?php echo !empty($params->pasien->nama) ? $params->pasien->nama : '................................'; ?>
                        telah menerima informasi sebagaimana diatas yang saya beri tanda / paraf dikolom kanannya
                        serta telah diberi kesempatan untuk bertanya / berdiskusi dan telah memahaminya
                    </div>
                </td>
                <td class="centerr borderr">
                    Tanda tangan
                    <div class="ttd-image">
                        <img src="<?php echo $params->ttd_data->penerima_stroke  ?>" style="height: 100px; width: auto; display: block; margin: 10px auto;">
                    </div>
                    <?php echo $params->ttd_data->penerima; ?>

                </td>
            </tr>
            <tr>
                <td colspan="2" class="borderr prg">
                    Catatan : Bila pasien tidak kompeten atau tidak mau menerima informasi, maka penerima informasi adalah wali atau keluarga terdekat
                </td>
            </tr>
        </table>

    </div>

    <br /><br />
    <div class="pagebreak">
        <!--<table border="0">-->
        <!--    <tr>-->
        <!--        <td align="right">RM 15.12</td>-->
        <!--    </tr>-->
        <!--</table>-->
        <table class="tbl-full borderr">
            <tr>
                <td class="borderr">
                    <center><B>PERSETUJUAN TINDAKAN KEDOKTERAN</B></center>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="ml-1">
                        Yang bertanda tangan di bawah ini saya,
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <table class="ml-2">
                        <tr>
                            <td width="18%">Nama</td>
                            <td width="1%">:</td>
                            <td>
                                <?php echo $params->ttd_data->menyatakan; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Umur</td>
                            <td>:</td>
                            <td>
                                <?php echo !empty($params->persetujuan_tindakan_kedokteran->yang_bertandatangan->umur) ? $params->persetujuan_tindakan_kedokteran->yang_bertandatangan->umur . " Tahun" : ""; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Jenis Kelamin</td>
                            <td>:</td>
                            <td>
                                <?php
                                $kelamin = $params->persetujuan_tindakan_kedokteran->yang_bertandatangan->kelamin;
                                echo ($kelamin == 'L' ? "Laki-laki" : ($kelamin == 'P' ? "Perempuan" : ""));
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>:</td>
                            <td>
                                <?php echo $params->persetujuan_tindakan_kedokteran->yang_bertandatangan->alamat; ?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="prg ml-1">
                        Dengan ini menyatakan SETUJU untuk dilakukan tindakan gigi :
                        <?php echo $params->persetujuan_tindakan_kedokteran->tindakan; ?>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="prg ml-1">
                        <?php if (isset($params->yang_menyatakan) && $params->yang_menyatakan === 'Saya'): ?>
                            Terhadap saya
                        <?php elseif (isset($params->yang_menyatakan) && $params->yang_menyatakan === 'Keluarga Pasien'): ?>
                            Terhadap <?php echo !empty($params->persetujuan_tindakan_kedokteran->terhadap->value) ? $params->persetujuan_tindakan_kedokteran->terhadap->value : "......................."; ?> saya
                        <?php else: ?>
                            Terhadap saya atau <?php echo !empty($params->persetujuan_tindakan_kedokteran->terhadap->value) ? $params->persetujuan_tindakan_kedokteran->terhadap->value . " saya" : ".......................  saya"; ?>
                        <?php endif; ?>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <table class="ml-2">
                        <tr>
                            <td width="18%">Nama</td>
                            <td width="1%">:</td>
                            <td>
                                <?php echo $params->persetujuan_tindakan_kedokteran->terhadap->nama; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Umur</td>
                            <td>:</td>
                            <td>
                                <?php echo !empty($params->persetujuan_tindakan_kedokteran->terhadap->umur) ? $params->persetujuan_tindakan_kedokteran->terhadap->umur . " Tahun" : ""; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Jenis Kelamin</td>
                            <td>:</td>
                            <td>
                                <?php
                                $kelamin = $params->persetujuan_tindakan_kedokteran->terhadap->kelamin;
                                echo ($kelamin == 'L' ? "Laki-laki" : ($kelamin == 'P' ? "Perempuan" : ""));
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>:</td>
                            <td>
                                <?php echo $params->persetujuan_tindakan_kedokteran->terhadap->alamat; ?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="prg ml-1" style="margin-top: 3px; text-align:justify; padding-right:8px">
                        Saya memahami perlunya dan manfaat tindakan tersebut sebagaiman telah dijelaskan dalam tabel
                        pemberian informasi pada halaman sebelumnya termasuk resiko dan komplikasi yang mungkin timbul.
                        Saya juga menyadari bahwa oleh karena ilmu kedokteran bukan ilmu pasti, maka keberhasilan
                        tindakan kedokteran bukanlah keniscayaan, melainkan tergantung kepada Tuhan Yang Maha Esa.
                    </div>
                    <br>
                </td>
            </tr>
            <tr>
                <td>
                    <table class="ml-2">
                        <tr>
                            <td width="50%"></td>
                            <td>
                                <?php echo $static_label->hospital_city; ?>,
                                <?php echo !empty($params->ttd_data->tanggal_indo) ? $params->ttd_data->tanggal_indo  : "................"; ?>
                                Jam, <?php echo !empty($params->ttd_data->jam) ? $params->ttd_data->jam . " WIB" : "............"; ?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <!--start ttd-->
                <td>
                    <table>
                        <tr>
                            <td class="centerr" width="33.3%">
                                Yang Menyatakan
                            </td>
                            <td colspan="2" class="centerr" width="66.3%">
                                Saksi-saksi
                            </td>
                            <!--<td class="centerr" width="33.3%">-->
                            <!--    Saksi 2-->
                            <!--</td>-->
                            <!--<td class="centerr" width="50%">-->
                            <!--    Dokter-->
                            <!--</td>-->
                        </tr>
                        <tr>
                            <td class="centerr">
                                <img src="<?php echo $params->ttd_data->menyatakan_stroke ?>" style="height: 100px; width: auto; display: block; margin: 10px auto;">
                            </td>
                            <td class="centerr" width="33.3%">
                                <img src="<?php echo $params->ttd_data->saksi1_stroke ?>" style="height: 100px; width: auto; display: block; margin: 10px auto;">
                            </td>
                            <td class="centerr" width="33.3%">
                                <img src="<?php echo $params->ttd_data->saksi2_stroke ?>" style="height: 100px; width: auto; display: block; margin: 10px auto;">
                            </td>
                            <!--<td class="centerr">-->
                            <!--<img src="<?php echo $params->ttd_data->dokter_stroke ?>" style="height: 100px; width: auto; display: block; margin: 10px auto;">-->
                            <!--</td>-->
                        </tr>
                        <tr>
                            <td class="centerr">
                                <?php echo $params->ttd_data->menyatakan; ?>
                            </td>
                            <td class="centerr">
                                <?php echo $params->ttd_data->saksi1; ?>
                            </td>
                            <td class="centerr">
                                <?php echo $params->ttd_data->saksi2; ?>
                            </td>
                            <!--<td class="centerr">-->
                            <!--<?php echo $params->ttd_data->dokter; ?>-->
                            <!--</td>-->
                        </tr>
                    </table>
                </td>
                <!--end ttd-->
            </tr>
        </table>
    </div>
</body>