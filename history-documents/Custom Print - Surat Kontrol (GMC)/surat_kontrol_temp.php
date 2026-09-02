<link rel="stylesheet" href="<?= base_url('assets/css/printing/printing-sep.css') ?>"/>
<script type="text/javascript">
    function cetak() {
       setTimeout(function(){ window.close();},300);
       window.print();    
    }
</script>
<style type="text/css">
   

    .tabel-sep {empty-cells: show; border-radius:5px; border-spacing:0;margin-top:5px; clear: both; border-collapse: collapse; background: #fff; color: #000;}

    .tabel-sep thead th{
        border: 1px solid #000;
        font-weight: bold;
    }

    .tabel-sep tbody td{
        border: 1px solid #000;
        padding-left: 10px;
        padding-right: 3px;
        font-weight: bold;
    }

    .tabel-sep .number{text-align: center;}
    .tabel-sep th rowspan, td rowspan{vertical-align: middle;}
    .tabel-sep th {font-weight: bold;}
    .tabel-sep td.border-none{
        border-top: none; 
        border-left: none; 
        border-bottom: none; 
    }
</style>
<title><?= $title ?></title>

<body style="background: #ffffff; flex-direction: row; " onload="cetak()">

<?php
    date_default_timezone_set(get_constant('TIMEZONE', 'Asia/Jakarta'));
    $sep = $surat_kontrol->sep;

    require_once('./extlib/barcode/barcode.php');
    $generator = new barcode_generator();
    $barcode_options = array(
        'f'     => 'svg',
        's'     => 'code-128',
        'd'     => $surat_kontrol->noSuratKontrol,
        'w'     => '190',
        'h'     => '30',
        'p'     => '0',
    );
    if (!empty($surat_kontrol->noSuratKontrol)) {
        $raw_svg = $generator->render_svg('code-128', $surat_kontrol->noSuratKontrol, $barcode_options);
        $svg_barcode = preg_replace('/<text.*?>.*?<\/text>/s', '', $raw_svg);
    } else {
        $svg_barcode = '';
    }
?>
<div class="page">

    <table width="100%">
        <tr>
            <td width="26%" valign="top">
                <img src="<?= base_url('assets/img/bpjs.png') ?>"  height="30px" />
            </td>
            <td width="39%" align="left" valign="top">
                <b style="font-weight: normal;font-size:14px;">
                <?php 
                    if($surat_kontrol->namaJnsKontrol === 'Kontrol'){
                        echo "SURAT RENCANA KONTROL";
                    }else{
                        echo "SURAT PERINTAH RAWAT INAP";
                    }
                ?>
                
                </b><br/>
                <b style="font-weight: normal;font-size:12px;"><?= strtoupper($clinic->nama) ?></b>
            </td>
            <td width="35%" valign="top" align="left" style="padding-left:40px">
                <b style="font-size:14px;">No. <?= $surat_kontrol->noSuratKontrol?></b>
                <br>
                <b style="font-size:13px;">Tgl. <?= indo_tgl($surat_kontrol->tglRencanaKontrol) ?></b>
            </td>
        </tr>
    </table>
    <br>
    <table width="100%">
        <?php if($surat_kontrol->namaJnsKontrol === 'Kontrol'){ ?>
        <tr>
            <td width="70%" valign="top">
                <!-- ------------------------- -->
                 <table width="100%" >
                    <?php if($surat_kontrol->namaJnsKontrol === 'Kontrol'){ ?>
                    <tr>
                        <td colspan="2">Kepada Yth</td>
                        <td  colspan="5"><?= $surat_kontrol->namaDokter ?></td>
                    </tr>
                    <tr>
                        <td colspan="2"></td>
                        <td colspan="5" style="text-transform: capitalize">Sp./Sub. <?= $surat_kontrol->namaPoliTujuan ?></td>
                    </tr>
                    <tr>
                        <td><br></td>
                    </tr>
                    <?php } ?>
                    <tr>
                        <td colspan="3">Mohon Pemeriksaan dan Penanganan Lebih Lanjut : </td>
                    </tr>
                    <tr>
                        <td width="25%" valign="top">No Kartu</td>
                        <td width="1%" valign="top">:</td>
                        <td valign="top"><?= ($surat_kontrol->namaJnsKontrol === "Kontrol")?$surat_kontrol->sep->peserta->noKartu:$data->nopolish ?></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>No.RM</td>
                        <td>:</td>
                        <td><?= $data->id_pasien ?></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>

                    </tr>
                    <tr>
                        <td valign="top">Nama Peserta</td>
                        <td valign="top">:</td>
                        <td valign="top">
                            <?= ($surat_kontrol->namaJnsKontrol === "Kontrol")?$surat_kontrol->sep->peserta->nama:$data->pasien ?>
                            <?php 
                                $kelamin = ($surat_kontrol->namaJnsKontrol === "Kontrol") ? $surat_kontrol->sep->peserta->kelamin : $data->kelamin;
                                $label_kelamin = (strtoupper($kelamin) === 'P' || strtolower($kelamin) === 'perempuan') ? 'Perempuan' : ((strtoupper($kelamin) === 'L' || strtolower($kelamin) === 'laki-laki') ? 'Laki-laki' : $kelamin);
                            ?>
                            (<?= $label_kelamin ?>)
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>

                    </tr>
                    <tr>
                        <td valign="top">Tgl.Lahir</td>
                        <td valign="top">:</td>
                        <td valign="top"><?= ($surat_kontrol->namaJnsKontrol === "Kontrol")?datefmysql($surat_kontrol->sep->peserta->tglLahir):datefmysql($data->tanggal_lahir) ?></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td valign="top">Diagnosa Awal</td>
                        <td valign="top">:</td>
                        <td valign="top"><?= $surat_kontrol->sep->diagnosa?:'-' ?></td>
                        <td></td>

                    </tr>
                    <tr>
                        <td valign="top">Tgl. Entri</td>
                        <td valign="top">:</td>
                        <td valign="top"><?= indo_tgl($surat_kontrol->tglTerbit) ?></td>
                        <td></td>
                    </tr>
                    <?php if (get_constant('AUTO_CREATE_PENJADWALAN_SURAT_KONTROL', false)) { ?>
                        <?php if($surat_kontrol->namaJnsKontrol === 'Kontrol'){ ?>
                            <tr>
                                <td valign="top">No Antrian</td>
                                <td valign="top">:</td>
                                <td valign="top"><?= ($data->id_penjadwalan != NULL)?$data->no_antrian: '-' ?></td>
                                <td></td>
                            </tr>
                        <?php } ?>
                    <?php } ?>
                </table>
                <!-- ------------------------- -->
            </td>
            <td width="30%" valign="top" align="right">
                <table width="100%" >
                    <tr>
                        <td align="right" valign="top">
                            <!-- barcode batang -->
                            <?= $svg_barcode ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="height: 50px;"></td>
                    </tr>
                    <tr>
                        <td align="right" valign="top" style="">
                            <p style="padding-right:15px; margin: 0;">Mengetahui</p>
                            <?php
                                $ttd = $surat_kontrol->namaDokterPembuat;
                                if(!$ttd){
                                    $ttd = $surat_kontrol->namaDokter;
                                }

                                $url = base_url('printing/generate_qrcode_satuparam') . '?id=' .$ttd;

                                if($ttd){
                                    echo '<img src="'. $url .'" width="100px" height="100px" />';
                                } else {
                                    echo '<div style="padding-top: 5em"></div>';
                                }
                            ?>
                            <br>
                            <div style="text-transform: capitalize; text-align: center; width: 40%">
                                <?= ($surat_kontrol->namaJnsKontrol === 'Kontrol')?$surat_kontrol->namaDokterPembuat:$surat_kontrol->namaDokter ?>
                            </div>
                        </td>
                    </tr>
                </table>
                
            </td>
        </tr>
        <?php } ?>
    </table>
    
    <table width="100%" border="0">
        <tr>
            <td width="100%" valign="top">
                Demikian atas bantuannya, diucapkan banyak terimakasih.
                <?php if($surat_kontrol->namaJnsKontrol === 'Kontrol') : ?>
                <div style="border: 1px solid #000; padding: 5px; font-size: 11px; margin-top: 5px; line-height: 1.3;">
                    <div style="border-bottom:1px solid black; text-align: center;"><b style="font-weight:bold">PERHATIAN</b></div>
                    <br>
                    1. Pasien wajib datang sesuai tanggal kontrol yang tertera<br>
                    2. Pasien yang datang di luar tanggal kontrol tidak dapat dilayani<br>
                    3. Harap membawa :
                    <ul style="margin: 0; padding-left: 20px; list-style-type: none;">
                        <li>- Kartu BPJS Kesehatan / KTP</li>
                        <li>- Surat Kontrol ini</li>
                        <li>- Dokumen pendukung lainnya (jika diperlukan)</li>
                    </ul>
                    4. Apabila berhalangan hadir, silahkan menghubungi petugas untuk penjadwalan ulang
                    <div style="margin-top: 4px; padding-top: 3px; ">
                        <b style="font-weight:bold; font-size:11px">
                            Nomor Whatsapp / Telepon Petugas : <?= $clinic->telp ?>
                        </b>
                    </div>
                </div>
                <?php endif; ?>
                <div style="font-size:10px; margin-top: 3px;">
                    Tgl.Cetak:&nbsp;<?= date('d/m/Y h:i:s A') ?>
                </div>
            </td>
        </tr>
    </table>
</div>
</body>
