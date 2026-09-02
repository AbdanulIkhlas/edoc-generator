<link rel="stylesheet" href="<?= base_url('assets/css/printing/printing-sep.css') ?>" />
<script type="text/javascript">
    function cetak() {
        setTimeout(function() {
            window.close();
        }, 300);
        window.print();
    }
</script>
<style type="text/css">
    .tabel-sep {
        empty-cells: show;
        border-radius: 5px;
        border-spacing: 0;
        margin-top: 5px;
        clear: both;
        border-collapse: collapse;
        background: #fff;
        color: #000;
    }

    .tabel-sep thead th {
        border: 1px solid #000;
        font-weight: bold;
    }

    .tabel-sep tbody td {
        border: 1px solid #000;
        padding-left: 10px;
        padding-right: 3px;
        font-weight: bold;
    }

    .tabel-sep .number {
        text-align: center;
    }

    .tabel-sep th rowspan,
    td rowspan {
        vertical-align: middle;
    }

    .tabel-sep th {
        font-weight: bold;
    }

    .tabel-sep td.border-none {
        border-top: none;
        border-left: none;
        border-bottom: none;
    }
</style>
<title><?= $title ?></title>

<body style="background: #ffffff; flex-direction: row; " onload="cetak()">

    <?php
    //    echo "<pre>";
    //    echo print_r($surat_kontrol);
    //    echo "</pre>";
    // $json = json_decode($json, false);
    $sep = $surat_kontrol->sep;
    ?>
    <div class="page">

        <table width="100%">
            <tr>
                <td width="30%" valign="top">
                    <img src="<?= base_url('assets/img/bpjs.png') ?>" height="30px" />
                </td>
                <td width="35%" align="center" valign="top">
                    <b style="font-weight: bold;font-size:14px;">
                        <?php
                        if ($surat_kontrol->namaJnsKontrol === 'Kontrol') {
                            echo "SURAT RENCANA KONTROL";
                        } else {
                            echo "SURAT PERINTAH RAWAT INAP";
                        }
                        ?>

                    </b><br />
                    <b style="font-weight: bold;font-size:12px;"><?= strtoupper($clinic->nama) ?></b>
                </td>
                <td width="35%" valign="top" align="right">
                    <b style="font-size:15px;">No. <?= $surat_kontrol->noSuratKontrol ?></b>
                </td>
            </tr>
        </table>
        <br>
        <table width="100%">
            <?php if ($surat_kontrol->namaJnsKontrol === 'Kontrol') { ?>
                <tr>
                    <td colspan="7">Kepada Yth</td>
                </tr>
                <tr>
                    <td colspan="7"><?= $surat_kontrol->namaDokter ?></td>
                </tr>
                <tr>
                    <td colspan="7" style="text-transform: capitalize">Sp./Sub. <?= $surat_kontrol->namaPoliTujuan ?></td>
                </tr>
                <tr>
                    <td><br></td>
                </tr>
            <?php } ?>
            <tr>
                <td colspan="3">Mohon Pemeriksaan dan Penanganan Lebih Lanjut : </td>
            </tr>
            <tr>
                <td>No Kartu</td>
                <td>:</td>
                <td><?= ($surat_kontrol->namaJnsKontrol === "Kontrol") ? $surat_kontrol->sep->peserta->noKartu : $data->nopolish ?></td>
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
                <td>Nama Peserta</td>
                <td>:</td>
                <td><?= ($surat_kontrol->namaJnsKontrol === "Kontrol") ? $surat_kontrol->sep->peserta->nama : $data->pasien ?></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>

            </tr>
            <tr>
                <td>Tgl.Lahir</td>
                <td>:</td>
                <td><?= ($surat_kontrol->namaJnsKontrol === "Kontrol") ? datefmysql($surat_kontrol->sep->peserta->tglLahir) : datefmysql($data->tanggal_lahir) ?></td>
                <td></td>
            </tr>
            <tr>
                <td>Diagnosa Awal</td>
                <td>:</td>
                <td><?= $surat_kontrol->sep->diagnosa ?: '-' ?></td>
                <td></td>

            </tr>
            <tr>
                <td><?= ($surat_kontrol->namaJnsKontrol === 'Kontrol') ? 'Rencana Kontrol' : 'Rencana Inap' ?></td>
                <td>:</td>
                <td><?= datefmysql($surat_kontrol->tglRencanaKontrol) ?></td>
                <td></td>
            </tr>
            <?php if (get_constant('AUTO_CREATE_PENJADWALAN_SURAT_KONTROL', false) == true) { ?>
                <?php if ($surat_kontrol->namaJnsKontrol === 'Kontrol') { ?>
                    <tr>
                        <td>No Antrian</td>
                        <td>:</td>
                        <td><?= ($data->id_penjadwalan != NULL) ? $data->no_antrian : '-' ?></td>
                        <td></td>
                    </tr>
                <?php } ?>
            <?php } ?>
        </table>
        <table width="100%" border="0">
            <tr>
                <td width="65%" valign="top">
                    Demikian atas bantuannya, diucapkan banyak terimakasih.
                    <?php if ($surat_kontrol->namaJnsKontrol === 'Kontrol') : ?>
                        <div style="border: 1px solid #000; padding: 5px; font-size: 11px; margin-top: 5px; line-height: 1.3;">
                            <b style="font-weight:bold">PERHATIAN</b><br>
                            1. Pasien wajib datang sesuai tanggal kontrol yang tertera<br>
                            2. Pasien yang datang di luar tanggal kontrol tidak dapat dilayani<br>
                            3. Harap membawa :
                            <ul style="margin: 0; padding-left: 20px; list-style-type: circle;">
                                <li>Kartu BPJS Kesehatan / KTP</li>
                                <li>Surat Kontrol ini</li>
                                <li>Dokumen pendukung lainnya (jika diperlukan)</li>
                            </ul>
                            4. Apabila berhalangan hadir, silahkan menghubungi petugas untuk penjadwalan ulang
                            <?php if (!empty($clinic->telp)): ?>
                                <div style="border-top: 1px dashed #000; margin-top: 4px; padding-top: 3px;">
                                    <b style="font-weight:bold">Nomor WhatsApp / Telepon Petugas : <?= $clinic->telp ?></b>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                    <div style="font-size:10px; margin-top: 3px;">
                        Tgl.Entri:&nbsp; <?= datefmysql($surat_kontrol->tglTerbit) ?>&nbsp;|&nbsp;Tgl.Cetak:&nbsp;<?= datefmysql(date('Y-m-d')) ?>
                    </div>
                </td>
                <td width="35%" align="right" valign="top">
                    Mengetahui DPJP,<br><br>
                    <?php
                    $ttd = $surat_kontrol->namaDokterPembuat;
                    if (!$ttd) {
                        $ttd = $surat_kontrol->namaDokter;
                    }

                    $url = base_url('printing/generate_qrcode_satuparam') . '?id=' . $ttd;

                    if ($ttd) {
                        echo '<img src="' . $url . '" width="100px" height="100px" />';
                    } else {
                        echo '<div style="padding-top: 5em"></div>';
                    }
                    ?>
                    <br>
                    <div style="text-transform: capitalize; text-align: center; width: 40%">
                        <?= ($surat_kontrol->namaJnsKontrol === 'Kontrol') ? $surat_kontrol->namaDokterPembuat : $surat_kontrol->namaDokter ?>
                    </div>
                </td>
            </tr>
        </table>
    </div>
</body>