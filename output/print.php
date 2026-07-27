<?php
// EMR Data
$params = json_decode($argv[1]);

$base_url = $argv[2]; // Base_url
$title = "Persetujuan Umum (General Consent)";
$static_label = json_decode($argv[3]);

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

    /* === [NEW_STYLE_HOOK] === */
    /* AI will add additional styles here */
</style>

<body>
    <table class="main-outer-table" style="width: 100%; page-break-inside: auto;">
        <!-- KOP RS ROW -->
        <tr>
            <td style="padding-bottom: 20px;">
                <table style="width: 100%;">
                    <tr style="padding-bottom: 5px; padding-top: 5px;">
                        <td width="15%" style="vertical-align: middle; text-align: center;">
                            <img style="width: 70px" src="<?= $base_url; ?>/images/rs/LogoRS.png">
                        </td>
                        <td width="40%" style="vertical-align: middle;">
                            <h4 style="margin: 0; font-size: 14pt;"><?php echo $static_label->hospital_name ?? ''; ?></h4>
                            <div style="font-size: 10pt; line-height: 1.3; margin-top: 5px;">
                                <?php echo !empty($static_label->hospital_address) ? $static_label->hospital_address . "<br>" : ""; ?>
                                <?php echo !empty($static_label->hospital_phone) ? "Telp. " . $static_label->hospital_phone . "<br>" : ""; ?>
                                <?php echo !empty($static_label->hospital_email) ? "Email: " . $static_label->hospital_email : ""; ?>
                            </div>
                        </td>
                        <td width="45%" style="vertical-align: middle; padding: 10px; font-size:12pt; border: 1px solid black;">
                            <table style="width: 100%;">
                                <tr>
                                    <td width="36%">No. RM</td>
                                    <td width="1%">:</td>
                                    <td><?php echo $params->pasien->no_rm ?? ''; ?></td>
                                </tr>
                                <tr>
                                    <td>Nama Pasien</td>
                                    <td>:</td>
                                    <td><?php echo $params->pasien->nama ?? ''; ?></td>
                                </tr>
                                <tr>
                                    <td>Tanggal Lahir</td>
                                    <td>:</td>
                                    <td><?php echo !empty($params->pasien->tanggal_lahir) ? tgl_indo($params->pasien->tanggal_lahir) : ($params->pasien->tanggal_lahir_indo ?? ''); ?></td>
                                </tr>
                                <tr>
                                    <td>Jenis Kelamin</td>
                                    <td>:</td>
                                    <td><?php
                                        $kelamin = strtoupper($params->pasien->kelamin ?? '');
                                        if ($kelamin == 'L') {
                                            echo "Laki-laki";
                                        } else if ($kelamin == 'P') {
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
            </td>
        </tr>
        
        <!-- TITLE ROW -->
        <tr>
            <td style="text-align: center; font-weight: bold; font-size: 16pt; padding-bottom: 20px; text-decoration: underline;">
                PERSETUJUAN UMUM (GENERAL CONSENT)
            </td>
        </tr>
        
        <!-- DATA AWAL ROW -->
        <tr>
            <td>
                <table style="width: 100%; margin-bottom: 10px;">
                    <tr>
                        <td colspan="3" style="padding-bottom: 5px;">Yang bertandatangan di bawah ini :</td>
                    </tr>
                    <tr>
                        <td width="20%">Nama</td>
                        <td width="2%">:</td>
                        <td><?php echo $params->bertanda_tangan->nama ?? ''; ?></td>
                    </tr>
                    <tr>
                        <td>Kelamin</td>
                        <td>:</td>
                        <td><?php echo $params->bertanda_tangan->kelamin ?? ''; ?></td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>:</td>
                        <td><?php echo $params->bertanda_tangan->alamat ?? ''; ?></td>
                    </tr>
                    <tr>
                        <td>Tempat, Tgl Lahir</td>
                        <td>:</td>
                        <td><?php echo ($params->bertanda_tangan->tempat_lahir ?? '') . ', ' . tgl_indo($params->bertanda_tangan->tanggal_lahir ?? ''); ?></td>
                    </tr>
                    <tr>
                        <td>No. Identitas</td>
                        <td>:</td>
                        <td><?php echo $params->bertanda_tangan->no_identitas ?? ''; ?></td>
                    </tr>
                    <tr>
                        <td>No. Telp</td>
                        <td>:</td>
                        <td><?php echo $params->bertanda_tangan->telp ?? ''; ?></td>
                    </tr>
                    <tr>
                        <td>Pekerjaan</td>
                        <td>:</td>
                        <td><?php echo $params->bertanda_tangan->pekerjaan ?? ''; ?></td>
                    </tr>

                    <tr>
                        <td colspan="3" style="padding-top: 10px; padding-bottom: 5px;">Dengan ini bertindak atas nama : <b><?php echo $params->bertindak_atas_nama ?? ''; ?></b> dari :</td>
                    </tr>
                    <tr>
                        <td>Nama</td>
                        <td>:</td>
                        <td><?php echo $params->pasien->nama ?? ''; ?></td>
                    </tr>
                    <tr>
                        <td>Kelamin</td>
                        <td>:</td>
                        <td><?php echo $params->pasien->kelamin ?? ''; ?></td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>:</td>
                        <td><?php echo $params->pasien->alamat ?? ''; ?></td>
                    </tr>
                    <tr>
                        <td>Tempat, Tgl Lahir</td>
                        <td>:</td>
                        <td><?php echo ($params->pasien->tempat_lahir ?? '') . ', ' . tgl_indo($params->pasien->tanggal_lahir ?? ''); ?></td>
                    </tr>
                    <tr>
                        <td>No RM</td>
                        <td>:</td>
                        <td><?php echo $params->pasien->no_rm ?? ''; ?></td>
                    </tr>
                    <tr>
                        <td>No. Telp</td>
                        <td>:</td>
                        <td><?php echo $params->pasien->telp ?? ''; ?></td>
                    </tr>
                </table>
            </td>
        </tr>
        
        <!-- 1. PERAWATAN DAN PENGOBATAN -->
        <tr>
            <td style="padding-bottom: 10px;">
                <b>Untuk memberikan persetujuan tentang :</b><br><br>
                <b>1. PERAWATAN DAN PENGOBATAN</b>
                <table style="width: 100%; margin-top: 5px;">
                    <tr>
                        <td width="3%">a.</td>
                        <td style="text-align: justify;">Saya mengetahui bahwa saya memiliki kondisi yang membutuhkan perawatan medis, saya mengijinkan dokter dan professional kesehatan lainnya untuk melakukan prosedur diagnostik dan untuk memberikan pengobatan medis yang diperlukan dalam penilaian profesional mereka. Prosedur diagnostik dan perawatan medis termasuk tetapi tidak terbatas pada elektro kardiograms, x-ray, tes darah, terapi fisik, pasang infus, pasang NGT, pasang kateter, test darah dan pemberian obat, injeksi (IM, SC).</td>
                    </tr>
                    <tr>
                        <td>b.</td>
                        <td style="text-align: justify;">Saya sadar bahwa praktik kedokteran dan bedah bukanlah ilmu pasti dan saya mengakui bahwa tidak ada jaminan atau hasil apapun, terhadap perawatan prosedur atau pemeriksaan apapun yang dilakukan kepada saya.</td>
                    </tr>
                    <tr>
                        <td>c.</td>
                        <td>Saya mengerti dan memahami bahwa :
                            <table style="width: 100%;">
                                <tr>
                                    <td width="3%">1.</td>
                                    <td style="text-align: justify;">Saya memiliki hak untuk mengajukan pertanyaan tentang pengobatan yang diusulkan (termasuk identitas setiap orang yang memberikan atau mengamati pengobatan) setiap saat.</td>
                                </tr>
                                <tr>
                                    <td>2.</td>
                                    <td style="text-align: justify;">Saya mengerti dan memahami bahwa saya memiliki hak untuk persetujuan atau menolak persetujuan, untuk setiap prosedur / terapi.</td>
                                </tr>
                                <tr>
                                    <td>3.</td>
                                    <td style="text-align: justify;">Saya mengerti bahwa banyak dokter pada staf medis rumah sakit yang bukan karyawan tetap staf tamu yang telah diberikan hak untuk menggunakan fasilitas untuk perawatan dan pengobatan pasien mereka.</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <!-- 2. PELEPASAN INFORMASI -->
        <tr>
            <td style="padding-bottom: 10px;">
                <b>2. PELEPASAN INFORMASI</b>
                <table style="width: 100%; margin-top: 5px;">
                    <tr>
                        <td style="text-align: justify;">Saya memahami informasi yang ada di dalam diri saya, termasuk diagnosis hasil laboratorium dan hasil tes diagnostik yang akan digunakan untuk perawatan medis dan RS akan menjamin kerahasiaannya. Saya memberikan wewenang kepada RS untuk memberikan informasi tentang rahasia kedokteran saya bila diperlukan untuk memproses <b><?php echo $params->informasi_rahasia_kedokteran ?? 'klaim BPJS / Jamkesmas / KIS / Perusahaan / lembaga pemerintahan lainnya'; ?></b> *).</td>
                    </tr>
                    <tr>
                        <td style="text-align: justify; padding-top: 5px;">Saya <b><?php echo strtolower($params->pelepasan_informasi_wewenang ?? ''); ?></b> wewenang kepada RS untuk memberikan tentang data dan informasi kesehatan saya kepada keluarga terdekat saya, yaitu :</td>
                    </tr>
                    <tr>
                        <td style="text-align: justify;">Menyatakan bahwa sesuai Kewajiban Simpan Rahasia Kedokteran dan mengacu pada Peraturan Menteri Kesehatan Republik Indonesia Nomor 36/MENKES/PERIII/2008, Maka saya menunjuk yang tersebut di bawah ini untuk dapat diberitahukan tentang kondisi kesehatan saya:</td>
                    </tr>
                    <tr>
                        <td>
                            <table style="width: 100%;">
                                <?php 
                                $list_pelepasan = $params->pelepasan_informasi_list ?? [];
                                $max_pelepasan = max(3, count($list_pelepasan));
                                for ($i = 0; $i < $max_pelepasan; $i++) {
                                    $nama = isset($list_pelepasan[$i]) && !empty($list_pelepasan[$i]->nama) ? $list_pelepasan[$i]->nama : '......................................................................';
                                    echo "<tr>
                                            <td width=\"3%\">" . ($i + 1) . ".</td>
                                            <td>{$nama}</td>
                                          </tr>";
                                }
                                ?>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <!-- 3. PRIVASI -->
        <tr>
            <td style="padding-bottom: 10px;">
                <b>3. PRIVASI</b>
                <table style="width: 100%; margin-top: 5px;">
                    <tr>
                        <td style="text-align: justify;">Saya <b><?php echo strtolower($params->privasi_mengijinkan ?? ''); ?></b> Rumah Sakit memberikan akses bagi keluarga dan handai taulan serta orang-orang yang akan menengok / menemui saya:</td>
                    </tr>
                    <tr>
                        <td>
                            <table style="width: 100%;">
                                <tr>
                                    <td width="5%"></td>
                                    <td width="45%"><b>Nama</b></td>
                                    <td width="50%"><b>Hubungan dengan pasien</b></td>
                                </tr>
                                <?php 
                                $list_privasi = $params->privasi_daftar_keluarga ?? [];
                                $max_privasi = max(3, count($list_privasi));
                                for ($i = 0; $i < $max_privasi; $i++) {
                                    $nama = isset($list_privasi[$i]) && !empty($list_privasi[$i]->nama) ? $list_privasi[$i]->nama : '.............................................';
                                    $hubungan = isset($list_privasi[$i]) && !empty($list_privasi[$i]->hubungan) ? $list_privasi[$i]->hubungan : '.............................................';
                                    echo "<tr>
                                            <td>" . ($i + 1) . ".</td>
                                            <td>{$nama}</td>
                                            <td>({$hubungan})</td>
                                          </tr>";
                                }
                                ?>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: justify; padding-top: 10px;">Saya <b><?php echo strtolower($params->privasi_khusus_menginginkan ?? ''); ?></b> privasi khusus, Sebutkan bila ada permintaan privasi khusus :</td>
                    </tr>
                    <tr>
                        <td>
                            <table style="width: 100%;">
                                <?php 
                                $list_khusus = $params->privasi_khusus_list ?? [];
                                $max_khusus = max(3, count($list_khusus));
                                for ($i = 0; $i < $max_khusus; $i++) {
                                    $keterangan = isset($list_khusus[$i]) && !empty($list_khusus[$i]->keterangan) ? $list_khusus[$i]->keterangan : '......................................................................';
                                    echo "<tr>
                                            <td width=\"3%\">" . ($i + 1) . ".</td>
                                            <td>{$keterangan}</td>
                                          </tr>";
                                }
                                ?>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <!-- 4. KEROHANIAN -->
        <tr>
            <td style="padding-bottom: 10px;">
                <b>4. KEROHANIAN</b>
                <table style="width: 100%; margin-top: 5px;">
                    <tr>
                        <td style="text-align: justify;">Saya <b><?php echo ($params->kerohanian_menginginkan ?? '') === 'Ya' ? 'menginginkan' : 'tidak menginginkan'; ?></b> Pelayanan Kerohanian, 
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <?php if(($params->checkbox_menginginkan_kerohanian ?? '') === 'Tidak'): ?> [ V ] Tidak <?php else: ?> [ &nbsp; ] Tidak <?php endif; ?>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <?php if(($params->checkbox_menginginkan_kerohanian ?? '') === 'Ya'): ?> [ V ] Ya, Sebutkan Agama : <?php echo $params->kerohanian_agama ?? '..............................................'; ?> <?php else: ?> [ &nbsp; ] Ya, Sebutkan Agama : .............................................. <?php endif; ?>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <!-- 5. BARANG PRIBADI -->
        <tr>
            <td style="padding-bottom: 10px;">
                <b>5. BARANG PRIBADI</b>
                <table style="width: 100%; margin-top: 5px;">
                    <tr>
                        <td style="text-align: justify;">
                            <?php if(!empty($params->barang_pribadi_setuju)): ?> <b>[ V ]</b> <?php else: ?> <b>[ &nbsp; ]</b> <?php endif; ?>
                            Saya Setuju untuk tidak membawa barang-barang berharga yang tidak diperlukan, seperti perhiasan,Elekronik, dll. Selama Perawatan di RS Yasyfin Darussalam Gontor. Saya memahami dan menyetujui bahwa apabila saya membawanya, Maka RS Yasyfin Darussalam Gontor tidak bertanggung jawab terhadap kehilangan, kerusakan, dan pencurian.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <!-- 6. PERAWATAN DAN DPJP -->
        <tr>
            <td style="padding-bottom: 10px;">
                <b>6. PERAWATAN DAN DOKTER PENANGGUNG JAWAB PERAWATAN (DPJP)</b>
                <table style="width: 100%; margin-top: 5px;">
                    <tr>
                        <td style="text-align: justify;">
                            Saya Setuju dirawat di ruang : <b><?php echo $params->perawatan_ruang ?? '.................................'; ?></b><br>
                            Dan memilih DPJP : <b><?php echo $params->perawatan_dpjp ?? '.................................'; ?></b> Kelas : <b><?php echo $params->perawatan_kelas ?? '.................................'; ?></b>,<br>
                            Bila ruang perawatan penuh, Saya bersedia ditempatkan di : <b><?php echo $params->perawatan_bersedia_ditempatkan_di ?? '.................................'; ?></b>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <!-- 7. INFORMASI BIAYA -->
        <tr>
            <td style="padding-bottom: 10px;">
                <b>7. INFORMASI BIAYA</b>
                <table style="width: 100%; margin-top: 5px;">
                    <tr>
                        <td style="text-align: justify;">Saya telah memahami tentang informasi biaya pengobatan atau biaya tindakan yang dijelaskan oleh petugas Rumah Sakit.</td>
                    </tr>
                    <tr>
                        <td style="text-align: justify;">Saya menyatakan bahwa seluruh biaya perawatan saya akan :</td>
                    </tr>
                    <tr>
                        <td>
                            <table style="width: 100%;">
                                <tr>
                                    <td width="5%"><?php echo !empty($params->informasi_biaya_dibayar_sendiri) ? '[ V ]' : '[ &nbsp; ]'; ?></td>
                                    <td>dibayar sendiri</td>
                                </tr>
                                <tr>
                                    <td><?php echo !empty($params->informasi_biaya_ditanggung) ? '[ V ]' : '[ &nbsp; ]'; ?></td>
                                    <td>ditanggung oleh <b><?php echo !empty($params->informasi_biaya_ditanggung) ? ($params->informasi_biaya_ditanggung_text ?? '') : '......................................................................'; ?></b></td>
                                </tr>
                                <tr>
                                    <td><?php echo !empty($params->informasi_biaya_diklaimkan) ? '[ V ]' : '[ &nbsp; ]'; ?></td>
                                    <td>diklaimkan ke asuransi/perusahaan <b><?php echo !empty($params->informasi_biaya_diklaimkan) ? ($params->informasi_biaya_diklaimkan_text ?? '') : '......................................................................'; ?></b></td>
                                </tr>
                                <tr>
                                    <td><?php echo !empty($params->informasi_biaya_perkiraan) ? '[ V ]' : '[ &nbsp; ]'; ?></td>
                                    <td>perkiraan biaya kurang lebih Rp. <b><?php echo !empty($params->informasi_biaya_perkiraan) ? ($params->informasi_biaya_perkiraan_text ?? '') : '......................................................................'; ?></b></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <!-- 8. PENGAJUAN KELUHAN -->
        <tr>
            <td style="padding-bottom: 10px;">
                <b>8. PENGAJUAN KELUHAN</b>
                <table style="width: 100%; margin-top: 5px;">
                    <tr>
                        <td style="text-align: justify;">Saya telah menerima informasi tentang tata cara mengajukan dan mengatasi keluhan terkait pelayanan medik yang diberikan dan saya setuju untuk mengikuti tata cara pengajuan keluhan sesuai prosedur yang ada.</td>
                    </tr>
                    <tr>
                        <td style="text-align: justify;">Saya telah membaca dan sepenuhnya <b>( <?php echo $params->pengajuan_keluhan_setuju ?? 'SETUJU / TIDAK SETUJU'; ?> *)</b> dengan setiap pernyataan yang terdapat dalam formulir ini dan menandatanganinya dengan kesadaran penuh dan tanpa paksaan.</td>
                    </tr>
                    <tr>
                        <td style="font-size: 10pt; padding-top: 10px;">
                            *) Coret yang tidak perlu<br>
                            **) Bila pasien tidak kompeten atau tidak mau menerima informasi, maka wali atau seseorang yang diberi hak untuk menyetujui tindakan terhadap pasien tersebut
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <!-- TTD ROW -->
        <tr>
            <td style="padding-top: 20px;">
                <table style="width: 100%; text-align: center;">
                    <tr>
                        <td width="33%"></td>
                        <td width="33%"></td>
                        <td width="33%">
                            Ponorogo, <?php echo !empty($params->ttd_data->tanggal) ? tgl_indo($params->ttd_data->tanggal) : '......................'; ?> jam <?php echo $params->ttd_data->jam ?? '.........'; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Saksi Keluarga</td>
                        <td>Petugas Admisi</td>
                        <td>Yang Menyatakan,<br>Penderita / Wali **)</td>
                    </tr>
                    <tr>
                        <td style="height: 100px; vertical-align: middle;">
                            <?php if(!empty($params->ttd_data->saksi_keluarga_stroke)): ?>
                                <img src="<?php echo $params->ttd_data->saksi_keluarga_stroke; ?>" style="height: 100px; width: auto; display: block; margin: 0 auto;">
                            <?php endif; ?>
                        </td>
                        <td style="height: 100px; vertical-align: middle;">
                            <?php if(!empty($params->ttd_data->petugas_admisi_stroke)): ?>
                                <img src="<?php echo $params->ttd_data->petugas_admisi_stroke; ?>" style="height: 100px; width: auto; display: block; margin: 0 auto;">
                            <?php endif; ?>
                        </td>
                        <td style="height: 100px; vertical-align: middle;">
                            <?php if(!empty($params->ttd_data->menyatakan_stroke)): ?>
                                <img src="<?php echo $params->ttd_data->menyatakan_stroke; ?>" style="height: 100px; width: auto; display: block; margin: 0 auto;">
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>( <?php echo !empty($params->ttd_data->saksi_keluarga) ? $params->ttd_data->saksi_keluarga : '.............................................'; ?> )</td>
                        <td>( <?php echo !empty($params->ttd_data->petugas_admisi) ? $params->ttd_data->petugas_admisi : '.............................................'; ?> )</td>
                        <td>( <?php echo !empty($params->ttd_data->menyatakan) ? $params->ttd_data->menyatakan : '.............................................'; ?> )</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>