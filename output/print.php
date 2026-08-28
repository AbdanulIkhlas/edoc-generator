<?php
    // EMR Data
    $params = json_decode($argv[1]);

    $base_url = $argv[2]; // Base_url
    $title = "Formulir Edukasi Pasien Dan Keluarga Terintegrasi";
	$static_label = json_decode($argv[3]);

    $pasien = $params->pasien; 
    $pengkajian = $params->pengkajian;
    $edukasiData = $params->edukasiData; 
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>
    <?= $title ?>
  </title>
  <style>
    body {
      font: 10pt times new roman;
      size: f4;
      line-height: 1.4;
      /*padding-bottom: 10px;*/
    }

    table {
      border: 1px solid #000000;
      border-collapse: collapse;
      text-align: left;
      page-break-after: auto;
      width: 100%;
    }

    table tr {
      /*border: 1px solid #000000;*/
      border-collapse: collapse;
      /* padding: 10px;
            margin: 10px; */
      page-break-inside: avoid;
      page-break-after: auto;
    }

    table th {
      border-collapse: collapse;
      font-weight: bold;
      padding: 10px;
    }

    table td {
      border: 1px solid #000000;
      border-collapse: collapse;
      padding-left: 5px;
      padding-right: 5px;
      /*padding: 1px 0.5em;*/
      page-break-inside: avoid;
      page-break-after: avoid;
      vertical-align: top;
      word-wrap: break-word;
    }

    .mini-table {
      margin: 0;
      padding: 0;
      border: none;
    }

    .mini-table tr {
      margin: 0;
      padding: 0;
      border: none;
    }

    .mini-table tr td {
      margin: 0;
      /* padding: 1px 0.5em 1px 0.5em; */
      border: none;
      vertical-align: top;
    }

    /* Table border tr */
    .mini-table-2 {
      margin: 0;
      padding: 0;
      border-collapse: collapse;
      /* Menghindari duplikasi border */
    }

    .mini-table-2 tr {
      border: 1px solid #000000;
      /* Hanya memberikan border pada tr */
    }

    .mini-table-2 tr td {
      margin: 0;
      /*padding: 1px 0.5em;*/
      border: none;
      /* Menghapus border pada td */
      text-align: left;
      vertical-align: top;
    }

    .numbering {
      margin: 0 0.5em;
    }

    .paragraph {
      text-align: justify;
      text-rendering: geometricPrecision;
    }

    .flex-container {
      display: -webkit-box;
      display: flex;
      -webkit-box-pack: left;
      flex-wrap: wrap;
      margin-right: 11px;
      /*padding-right: 11px;*/
    }

    .flex-child {
      flex: 1;
      -webkit-box-flex: 1;
      -webkit-flex: 1;
    }

    .flex-child-dotted {
      flex: 1;
      -webkit-box-flex: 1;
      -webkit-flex: 1;
      border-bottom: 2px dotted black;
      margin: 0.25em 0.25em 0 0.25em;
    }

    /* checkbox / kotak centang */
    .checkbox {
      width: 0.25em;
      height: 1em;
      border: 1px solid black;
      padding: 2px 0.5em 2px 0.5em;
      margin-right: 0.5em;
    }

    .pagebreak {
      min-height: 1px;
      page-break-before: always;
    }

    .text-top {
      vertical-align: top;
    }

    p {
      margin: 0;
    }

    ul {
      margin: 0;
    }

    .label {
      border: 1px solid red;
      background-color: red;
      color: white;
      padding: 2px;
    }

    /*.kotak-nomor {*/
    /*  border: 1px solid black;*/
    /*  padding: 4px;*/
    /*  margin: 2px;*/
    /*  text-align: center;*/
    /*  width: 30px;*/
    /*}*/
    
    .kotak-nomor {
  /*display: inline-block;*/
  width: 30px;
  height: 30px;
  border: 1px solid #000;
  text-align: center;
  line-height: 30px;
  margin: 2px;
  position: relative; /* penting untuk posisi absolut anak */
  /*font-size: 14px;*/
}

.kotak-nomor.checked::before {
  content: "✔";
  position: absolute;
  /*top: 10px;*/
  left: 30%;
  height: 30px;
  transform: translateX(-50%);
  font-size: 20px;
  color: black;
}

/* Supaya angka tetap kelihatan jelas, kamu bisa geser sedikit ke bawah */
.kotak-nomor.checked {
  /*padding-top: 10px;*/
  /*line-height: 10px;*/
}


  </style>
</head>

<body>
  <!--<table  class="mini-table">-->
  <!--    <tr>-->
  <!--        <td><img src="<?= "$base_url/images/rs/logoRS.png" ?>" style="width: 80px;" alt=""></td>-->
  <!--        <td align="center">-->
  <!--            <span style="margin:0; font-size: .9rem;">DINAS KESEHATAN ACEH TENGAH</span>-->
  <!--            <h4 style="margin:0; font-size: 1.3rem; text-transform: uppercase;">-->
  <!--                <b><?= $static_label->hospital_name ?? '' ?></b>-->
  <!--            </h4>-->
  <!--            <small style="font-size: .8rem;"><i><?= $static_label->hospital_address ?? '' . ' Telp. ' . $static_label->hospital_phone ?? '' ?></i></small>-->
  <!--        </td>-->
  <!--        <td>-->
              <!--<img src=">" style="width: 80px;" alt="">-->
  <!--        </td>-->
  <!--    </tr>-->
  <!--    <tr>-->
  <!--        <td colspan="3">-->
  <!--            <hr style="height: 2px; border-width: 0; color: gray; background-color: black;" />-->
  <!--        </td>-->
  <!--    </tr>-->
  <!--</table>-->
  
  <!-- Start Header -->
    <table class="mini-table">
        <tr>
            <td width="50%">
                <table class="mini-table">
                    <tr>
                        <td><img src="<?= "$base_url/images/rs/LogoRS.png" ?>" style="width: 60px;" alt=""></td>
                        <td align="center">
                            <span style="margin:0; font-size: .9rem;"></span>
                            <h4 style="margin:0; font-size: 1.3rem; text-transform: uppercase;">
                                <b><?= $static_label->hospital_name ?></b>
                            </h4>
                            <small style="font-size: .8rem;"><i><?= $static_label->hospital_address . ' Telp. ' . $static_label->hospital_phone ?></i></small>
                        </td>
                        <!--<td>-->
                            <!--<img src="<?= "$base_url/images/rs/paripurna-kars.png" ?>" style="width: 60px;" alt="">-->
                        <!--</td>-->
                    </tr>
                    <tr>
                        <td colspan="3">
                            <hr style="height: 2px; border-width: 0; color: gray; background-color: black;" />
                        </td>
                    </tr>
                </table>
            </td>
            <td style="vertical-align: top; padding-left: 1rem">
                <div style="border:1px solid black; padding: 1rem; border-radius: 1rem">
                    <table class="mini-table">
                        <tr>
                            <td>Nama</td>
                            <td>:</td>
                            <td>
                                <?= $params->pasien->nama_pasien ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Tgl Lahir</td>
                            <td>:</td>
                            <td>
                                <?= $params->pasien->tgl_lahir_indo ?>
                            </td>
                        </tr>
                        <tr>
                            <td width="20%">No. RM</td>
                            <td width="1%">:</td>
                            <td>
                                <?= $params->pasien->no_rm ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Ruang</td>
                            <td>:</td>
                            <td>
                                <?= $params->pasien->bangsal ?> <?= $params->pasien->ruang ? " - Ruang {$params->pasien->ruang}" : '' ?> <?= $params->pasien->kelas ? " - Kelas {$params->pasien->kelas}" : '' ?>
                            </td>
                        </tr>
                    </table>
                </div>
            </td>
        </tr>
    </table>
    <!-- End Header -->
  <h3 align="center">
    <b>FORMULIR EDUKASI PASIEN DAN KELUARGA TERINTEGRASI</b>
  </h3>
  <table>
    <tr>
      <td style="border: none">
        <table class="mini-table">
          <tr>
            <td colspan="3">
              Beri ceklis (&#10003;) untuk pengisian formulir dibawah ini
            </td>
          </tr>
          <tr>
            <th>
              I. Assesmen <br />
              &ensp;&ensp;Data Pasien
            </th>
          </tr>
        </table>

        <table class="mini-table">
          <tr>
            <td width="1%">a.</td>
            <td width="20%">Tingkat Pendidikan</td>
            <td width="1%">:</td>
            <td>
              <input type="checkbox" <?php echo ($pengkajian->tingkat_pendidikan === 'Tidak Sekolah' ? 'checked' : '');
              ?>> Tidak Sekolah
            </td>
            <td>
              <input type="checkbox" <?php echo ($pengkajian->tingkat_pendidikan === 'SD' ? 'checked' : ''); ?>> SD
            </td>
            <td>
              <input type="checkbox" <?php echo ($pengkajian->tingkat_pendidikan === 'SMU' ? 'checked' : ''); ?>> SMU
            </td>
            <td>
              <input type="checkbox" <?php echo ($pengkajian->tingkat_pendidikan === 'Perguruan Tinggi' ? 'checked' :
              ''); ?>> Perguruan Tinggi
            </td>
          </tr>
          <tr>
            <td>b.</td>
            <td>Kemampuan Bahasa</td>
            <td>:</td>
            <td>
              <input type="checkbox" <?php echo $pengkajian->bahasa->value === 'Indonesia' ? 'checked' : ''; ?>>
              Indonesia
            </td>
            <td>
              <input type="checkbox" <?php echo $pengkajian->bahasa->value === 'Daerah' ? 'checked' : ''; ?>>
              Daerah <?= $pengkajian->bahasa->isi_daerah ? " : {$pengkajian->bahasa->isi_daerah}" : '' ?>
            </td>
            <td>
              <input type="checkbox" <?php echo $pengkajian->bahasa->value === 'Asing' ? 'checked' : ''; ?>>
              Asing <?= $pengkajian->bahasa->isi_asing ? " : {$pengkajian->bahasa->isi_asing}" : '' ?>
            </td>
          </tr>
          <tr>
            <td>c.</td>
            <td>Perlu Penterjemah</td>
            <td>:</td>
            <td>
              <input type="checkbox" <?php echo $pengkajian->penerjemah === 'Ya' ? 'checked' : ''; ?>>
              Ya
            </td>
            <td>
              <input type="checkbox" <?php echo $pengkajian->penerjemah === 'Tidak' ? 'checked' : ''; ?>>
              Tidak
            </td>
          </tr>
          <tr>
            <td>d.</td>
            <td>Baca & Tulis</td>
            <td>:</td>
            <td>
              <input type="checkbox" <?php echo $pengkajian->baca === 'Bisa' ? 'checked' : ''; ?>>
              Bisa
            </td>
            <td>
              <input type="checkbox" <?php echo $pengkajian->baca === 'Tidak' ? 'checked' : ''; ?>>
              Tidak
            </td>
          </tr>
          <tr>
            <td rowspan="2">e.</td>
            <td>Hambatan</td>
            <td>:</td>
            <td>
              <input type="checkbox" <?php echo $pengkajian->hambatan->value === 'Ada' ? 'checked' : ''; ?>>
              Ada
            </td>
            <td>
              <input type="checkbox" <?php echo $pengkajian->hambatan->value === 'Tidak' ? 'checked' : ''; ?>>
              Tidak
            </td>
          </tr>
          <tr>
            <td colspan="6">
              <table class="mini-table">
                <tr>
                  <td>
                    <input type="checkbox" <?php echo $pengkajian->hambatan->g_pendengaran === true ? 'checked' : '';
                    ?>>
                    Gangguan Pendengaran
                  </td>
                  <td>
                    <input type="checkbox" <?php echo $pengkajian->hambatan->g_emosional === true ? 'checked' : ''; ?>>
                    Gangguan Emosi
                  </td>
                  <td>
                    <input type="checkbox" <?php echo $pengkajian->hambatan->g_penglihatan === true ? 'checked' : '';
                    ?>>
                    Gangguan penglihatan
                  </td>
                </tr>
                <tr>
                  <td>
                    <input type="checkbox" <?php echo $pengkajian->hambatan->g_bicara === true ? 'checked' : ''; ?>>
                    Gangguan Bicara
                  </td>
                  <td>
                    <input type="checkbox" <?php echo $pengkajian->hambatan->motivasi_kurang === true ? 'checked' : '';
                    ?>>
                    Motivasi Kurang/buruk
                  </td>
                  <td>
                    <input type="checkbox" <?php echo $pengkajian->hambatan->memori_hilang === true ? 'checked' : '';
                    ?>>
                    Memori Hilang
                  </td>
                </tr>
                <tr>
                  <td>
                    <input type="checkbox" <?php echo $pengkajian->hambatan->fisik_lemah === true ? 'checked' : ''; ?>>
                    Fisik Lemah
                  </td>
                  <td>
                    <input type="checkbox" <?php echo $pengkajian->hambatan->alkoholik === true ? 'checked' : ''; ?>>
                    Alkoholik
                  </td>
                  <td>
                    <input type="checkbox" <?php echo $pengkajian->hambatan->perokok === true ? 'checked' : ''; ?>>
                    Perokok aktif/pasif *
                  </td>
                </tr>
                <tr>
                  <td colspan="3">
                    <input type="checkbox" <?php echo $pengkajian->hambatan->fisiologis === true ? 'checked' : ''; ?>>
                    Secara Fisiologis tdk mampu belajar
                  </td>
                </tr>
              </table>
            </td>
          </tr>
          <tr>
            <td>f.</td>
            <td>Agama</td>
            <td>:</td>
            <td>
              <input type="checkbox" <?php echo $pengkajian->agama === 'Islam' ? 'checked' : ''; ?>>
              Islam
            </td>
            <td>
              <input type="checkbox" <?php echo $pengkajian->agama === 'Protestan' ? 'checked' : ''; ?>>
              Protestan
            </td>
            <td>
              <input type="checkbox" <?php echo $pengkajian->agama === 'Katolik' ? 'checked' : ''; ?>>
              Katolik
            </td>
            <td>
              <input type="checkbox" <?php echo $pengkajian->agama === 'Hindu' ? 'checked' : ''; ?>>
              Hindu
            </td>
          </tr>
          <tr>
            <td>g.</td>
            <td colspan="4">Nilai-nilai/ Keyakinan/ kepercayaan/ pantangan pada pasien :</td>
          </tr>
          <tr>
            <td colspan="2">&nbsp;</td>
            <td>:</td>
            <td>
              <input type="checkbox" <?php echo $pengkajian->nilai_keyakinan->value === 'Tidak' ? 'checked' : ''; ?>>
              Tidak
            </td>
            <td>
              <input type="checkbox" <?php echo $pengkajian->nilai_keyakinan->value === 'Ya' ? 'checked' : ''; ?>>
              Ya <?= $pengkajian->nilai_keyakinan->isian ? " : {$pengkajian->nilai_keyakinan->isian}" : '' ?>
            </td>
          </tr>
          <tr>
            <td>h.</td>
            <td>Cara Edukasi</td>
            <td>:</td>
            <td>
              <input type="checkbox" <?php echo $pengkajian->cara_edukasi === 'Lisan' ? 'checked' : ''; ?>>
              Lisan
            </td>
            <td>
              <input type="checkbox" <?php echo $pengkajian->cara_edukasi === 'Tulisan' ? 'checked' : ''; ?>>
              Tulisan
            </td>
          </tr>
          <tr>
            <td>i.</td>
            <td>Kesediaan menerima informasi</td>
            <td>:</td>
            <td>
              <input type="checkbox" <?php echo $pengkajian->kesediaan->value === 'Ya' ? 'checked' : ''; ?>>
              Ya
            </td>
            <td>
              <input type="checkbox" <?php echo $pengkajian->kesediaan->value === 'Tidak' ? 'checked' : ''; ?>>
              Tidak <?= $pengkajian->kesediaan->isian ? " : {$pengkajian->kesediaan->isian}" : '' ?>
            </td>
          </tr>
          <tr>
            <td colspan="5"><i>*Diisi Oleh Petugas Admisi</i></td>
          </tr>
        </table>
      </td>
      <td style=" width: 18%">
        <table class="mini-table">
          <tr>
            <td>
              Metode: <br>
              1 = Audio <br>
              2 = Demontrasi <br>
              3 = Lisan <br>
              4 = Tulisan <br>
              5 = Visualisasi
            </td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>
              Evaluasi Respon: <br>
              1 = Tidak Mengerti <br>
              2 = Menyatakan Paham <br>
              3 = Mampu menjelaskan <br>
              4 = Mampu demontrasi / simulasi
            </td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>
              Tingkat pemahaman: <br>
              1 = Edukasi pertama <br>
              2 = Re – edukasi ke 2/3 atau lebih
            </td>
          </tr>
        </table>
      </td>
    </tr>
    <tr>
      <td colspan="2">
        <table class="mini-table">
          <tr>
            <th colspan="2">Kebutuhan Edukasi</th>
          </tr>
          <tr>
            <td>
              <input type="checkbox" <?php echo ($pengkajian->kebutuhan->kondisi_kesehatan === true ? 'checked' : '');
              ?>> Kondisi kesehatan, diagnosa pasti dan penatalaksanaannya
            </td>
            <td>
              <input type="checkbox" <?php echo ($pengkajian->kebutuhan->inform_consent === true ? 'checked' : '');
              ?>> Proses pemberian Informed Consent
            </td>
          </tr>
          <tr>
            <td>
              <input type="checkbox" <?php echo ($pengkajian->kebutuhan->hak_partisipasi === true ? 'checked' : '');
              ?>> Hak untuk berpatisipasi pada proses pelayanan
            </td>
            <td>
              <input type="checkbox" <?php echo ($pengkajian->kebutuhan->diet === true ? 'checked' : '');
              ?>> Diet dan Nutrisi
            </td>
          </tr>
          <tr>
            <td>
              <input type="checkbox" <?php echo ($pengkajian->kebutuhan->p_pemeriksaan === true ? 'checked' : '');
              ?>> Prosedur pemeriksaan
            </td>
            <td>
              <input type="checkbox" <?php echo ($pengkajian->kebutuhan->nyeri === true ? 'checked' : '');
              ?>> Manajemen Nyeri
            </td>
          </tr>
          <tr>
            <td>
              <input type="checkbox" <?php echo ($pengkajian->kebutuhan->alat_medis === true ? 'checked' : '');
              ?>> Penggunaan alat medis yang aman
            </td>
            <td>
              <input type="checkbox" <?php echo ($pengkajian->kebutuhan->cuci_tangan === true ? 'checked' : '');
              ?>> Cuci tangan yang benar
            </td>
          </tr>
          <tr>
            <td>
              <input type="checkbox" <?php echo ($pengkajian->kebutuhan->rehabilitasi === true ? 'checked' : '');
              ?>> Teknik rehabilitasi
            </td>
            <td>
              <input type="checkbox" <?php echo ($pengkajian->kebutuhan->merokok === true ? 'checked' : '');
              ?>> Bahaya Merokok
            </td>
          </tr>
          <tr>
            <td>
              <input type="checkbox" <?php echo ($pengkajian->kebutuhan->obat_efektif === true ? 'checked' : '');
              ?>> Penggunaan obat secara efektif dan aman, efek samping serta interaksinya
            </td>
            <td>
              <input type="checkbox" <?php echo ($pengkajian->kebutuhan->rujukan_edukasi === true ? 'checked' : '');
              ?>> Rujukan Edukasi
            </td>
          </tr>
          <tr>
            <td colspan="2">
              <input type="checkbox" <?php echo ($pengkajian->kebutuhan->lainnya === true ? 'checked' : '');
              ?>> Lain –lain  <?= $pengkajian->kebutuhan->isi_lainnya ? " : {$pengkajian->kebutuhan->isi_lainnya}" : '' ?>
            </td>
          </tr>
        </table>
      </td>
    </tr>
    <tr>
      <td colspan="2">
        <table class="mini-table">
          <tr>
            <th colspan="2">Catatan:</th>
          </tr>
          <tr>
            <td width="1%">1.</td>
            <td>
              Pemberi edukasi adalah semua petugas rumah sakit yang melayani pasien ( Dokter, perawat, bidan, ahli gizi,
              apoteker, fisioterapis, radiographer dan tenaga kesehatan lainnya)
            </td>
          </tr>
          <tr>
            <td>2.</td>
            <td>
              Edukasi diberikan sesuai kebutuhan pasien berdasarkan pengkajian awal pasien dan rencana penanganan pasien
              assesmen data pasien diisi oleh perawat
            </td>
          </tr>
          <tr>
            <td>3.</td>
            <td>
              Pemberian edukasi dicatat kemudian dibubuhi tanda tangan dan nama jelas pemberi edukasi serta tandatangani
              pasien / keluarga
            </td>
          </tr>
      </td>
    </tr>
  </table>
      </td>
    </tr>
  </table>
  <br>
  <div class="pagebreak">
      
  </div>
  <table>
    <tr style="text-align: center; font-weight: bold">
      <td rowspan="2" style="vertical-align: middle;">Hari/ Tanggal/ Jam</td>
      <td rowspan="2" style="vertical-align: middle;">Metode</td>
      <td rowspan="2" style="vertical-align: middle;">Profesi/ Perihal</td>
      <td rowspan="2" style="vertical-align: middle;">Materi Pendidikan</td>
      <td rowspan="2" style="vertical-align: middle;">Estimasi Waktu</td>
      <td rowspan="2" style="vertical-align: middle;">Tingkat Pemaham an</td>
      <td rowspan="2" style="vertical-align: middle;">Evaluasi Respon</td>
      <td colspan="2" style="vertical-align: middle;">Nama & Tanda Tangan</td>
    </tr>
    <tr style="text-align: center; font-weight: bold">
      <td style="vertical-align: middle;">Pasien/ Keluarga</td>
      <td style="vertical-align: middle;">Pemberi Edukasi</td>
    </tr>
    <tr>
        <td>
            <?= $edukasiData->dokter->hari ? "{$edukasiData->dokter->hari} / " : '' ?>
            <?= $edukasiData->dokter->tanggal_indo ? "{$edukasiData->dokter->tanggal_indo} / " : '' ?>
            <?= $edukasiData->dokter->jam ? "{$edukasiData->dokter->jam} WIB " : '' ?>
        </td>
        <td align="center">
            <div class="kotak-nomor <?php echo ($edukasiData->dokter->metode === "1" ? 'checked' : '' ); ?>"> 1 </div>
            <div class="kotak-nomor <?php echo ($edukasiData->dokter->metode === "2" ? 'checked' : '' ); ?>"> 2 </div>
            <div class="kotak-nomor <?php echo ($edukasiData->dokter->metode === "3" ? 'checked' : '' ); ?>"> 3 </div>
            <div class="kotak-nomor <?php echo ($edukasiData->dokter->metode === "4" ? 'checked' : '' ); ?>"> 4 </div>
            <div class="kotak-nomor <?php echo ($edukasiData->dokter->metode === "5" ? 'checked' : '' ); ?>"> 5 </div>
        </td>
        <td>
            <?= $edukasiData->dokter->profesi ?>
        </td>
        <td>
            <div class="flex-container">
                <div>
                    <input type="checkbox" <?php echo ($edukasiData->dokter->no_1 === true ? 'checked' : ''); ?>>
                </div>
                <div>
                    Penjelasan penyakit, penyebab tanda & gejala, penatalaksana
                </div>
            </div>
            <div class="flex-container">
                <div>
                    <input type="checkbox" <?php echo ($edukasiData->dokter->no_2 === true ? 'checked' : ''); ?>>
                </div>
                <div>
                    Hasil Pemeriksaan dan pengobatan
                </div>
            </div>
            <div class="flex-container">
                <div>
                    <input type="checkbox" <?php echo ($edukasiData->dokter->no_3 === true ? 'checked' : ''); ?>>
                </div>
                <div>
                    Tindakan Medis ( Operasi )
                </div>
            </div>
            <div class="flex-container">
                <div>
                    <input type="checkbox" <?php echo ($edukasiData->dokter->no_4 === true ? 'checked' : ''); ?>>
                </div>
                <div>
                    Perkiraan hari Rawat
                </div>
            </div>
            <div class="flex-container">
                <div>
                    <input type="checkbox" <?php echo ($edukasiData->dokter->no_5 === true ? 'checked' : ''); ?>>
                </div>
                <div>
                    Penjelasan Komplikasi yang mungkin terjadi
                </div>
            </div>
            <div class="flex-container">
                <div>
                    <input type="checkbox" <?php echo ($edukasiData->dokter->no_6 === true ? 'checked' : ''); ?>>
                </div>
                <div>
                    Penjelasan tentang Informed Consent
                </div>
            </div>
            <div class="flex-container">
                <div>
                    <input type="checkbox" <?php echo ($edukasiData->dokter->no_7 === true ? 'checked' : ''); ?>>
                </div>
                <div>
                    <?= $edukasiData->dokter->no_isian ?>
                </div>
            </div>
        </td>
        <td>
            <?= $edukasiData->dokter->estimasi ?>
        </td>
        <td align="center">
            <div class="kotak-nomor <?php echo ($edukasiData->dokter->pemahaman === "1" ? 'checked' : '' ); ?>"> 1 </div>
            <div class="kotak-nomor <?php echo ($edukasiData->dokter->pemahaman === "2" ? 'checked' : '' ); ?>"> 2 </div>
        </td>
        <td align="center">
            <div class="kotak-nomor <?php echo ($edukasiData->dokter->evaluasi === "1" ? 'checked' : '' ); ?>"> 1 </div>
            <div class="kotak-nomor <?php echo ($edukasiData->dokter->evaluasi === "2" ? 'checked' : '' ); ?>"> 2 </div>
            <div class="kotak-nomor <?php echo ($edukasiData->dokter->evaluasi === "3" ? 'checked' : '' ); ?>"> 3 </div>
            <div class="kotak-nomor <?php echo ($edukasiData->dokter->evaluasi === "4" ? 'checked' : '' ); ?>"> 4 </div>
        </td>
        <td>
            <div style="text-align: center; vertical-align:middle">
                <img src="<?php echo $params->paraf->ttd_1 ?>" width="100%" height="50px" >
            </div>
            <?= $edukasiData->dokter->pasien_edu ?>
        </td>
        <td>
            <div style="text-align: center; vertical-align:middle">
                <img src="<?php echo $params->paraf->ttd_2 ?>" width="100%" height="50px" >
            </div>
            <?= $edukasiData->dokter->pemberi_edu ?>
        </td>
    </tr>
    <tr>
        <td>
            <?= $edukasiData->mpp->hari ? "{$edukasiData->mpp->hari} / " : '' ?>
            <?= $edukasiData->mpp->tanggal_indo ? "{$edukasiData->mpp->tanggal_indo} / " : '' ?>
            <?= $edukasiData->mpp->jam ? "{$edukasiData->mpp->jam} WIB " : '' ?>
        </td>
        <td align="center">
            <div class="kotak-nomor <?php echo ($edukasiData->mpp->metode === "1" ? 'checked' : '' ); ?>"> 1 </div>
            <div class="kotak-nomor <?php echo ($edukasiData->mpp->metode === "2" ? 'checked' : '' ); ?>"> 2 </div>
            <div class="kotak-nomor <?php echo ($edukasiData->mpp->metode === "3" ? 'checked' : '' ); ?>"> 3 </div>
            <div class="kotak-nomor <?php echo ($edukasiData->mpp->metode === "4" ? 'checked' : '' ); ?>"> 4 </div>
            <div class="kotak-nomor <?php echo ($edukasiData->mpp->metode === "5" ? 'checked' : '' ); ?>"> 5 </div>
        </td>
        <td>
            <?= $edukasiData->mpp->profesi ?>
        </td>
        <td>
            <div class="flex-container">
                <div>
                    <input type="checkbox" <?php echo ($edukasiData->mpp->no_1 === true ? 'checked' : ''); ?>>
                </div>
                <div>
                    Pelayanan Pasien Pulang dengan masalah Kompleks
                </div>
            </div>
            <div class="flex-container">
                <div>
                    <input type="checkbox" <?php echo ($edukasiData->mpp->no_2 === true ? 'checked' : ''); ?>>
                </div>
                <div>
                    Edukasi Pasien dengan perawatan lanjutan
                </div>
            </div>
            <div class="flex-container">
                <div>
                    <input type="checkbox" <?php echo ($edukasiData->mpp->no_3 === true ? 'checked' : ''); ?>>
                </div>
                <div>
                    Pelayanan pasien rujuk
                </div>
            </div>
            <div class="flex-container">
                <div>
                    <input type="checkbox" <?php echo ($edukasiData->mpp->no_4 === true ? 'checked' : ''); ?>>
                </div>
                <div>
                    <?= $edukasiData->mpp->no_isian ?>
                </div>
            </div>
        </td>
        <td>
            <?= $edukasiData->mpp->estimasi ?>
        </td>
        <td align="center">
            <div class="kotak-nomor <?php echo ($edukasiData->mpp->pemahaman === "1" ? 'checked' : '' ); ?>"> 1 </div>
            <div class="kotak-nomor <?php echo ($edukasiData->mpp->pemahaman === "2" ? 'checked' : '' ); ?>"> 2 </div>
        </td>
        <td align="center">
            <div class="kotak-nomor <?php echo ($edukasiData->mpp->evaluasi === "1" ? 'checked' : '' ); ?>"> 1 </div>
            <div class="kotak-nomor <?php echo ($edukasiData->mpp->evaluasi === "2" ? 'checked' : '' ); ?>"> 2 </div>
            <div class="kotak-nomor <?php echo ($edukasiData->mpp->evaluasi === "3" ? 'checked' : '' ); ?>"> 3 </div>
            <div class="kotak-nomor <?php echo ($edukasiData->mpp->evaluasi === "4" ? 'checked' : '' ); ?>"> 4 </div>
        </td>
        <td>
            <div style="text-align: center; vertical-align:middle">
                <img src="<?php echo $params->paraf->ttd_3 ?>" width="100%" height="50px" >
            </div>
            <?= $edukasiData->mpp->pasien_edu ?>
        </td>
        <td>
            <div style="text-align: center; vertical-align:middle">
                <img src="<?php echo $params->paraf->ttd_4 ?>" width="100%" height="50px" >
            </div>
            <?= $edukasiData->mpp->pemberi_edu ?>
        </td>
    </tr>
    <tr>
        <td>
            <?= $edukasiData->bidan->hari ? "{$edukasiData->bidan->hari} / " : '' ?>
            <?= $edukasiData->bidan->tanggal_indo ? "{$edukasiData->bidan->tanggal_indo} / " : '' ?>
            <?= $edukasiData->bidan->jam ? "{$edukasiData->bidan->jam} WIB " : '' ?>
        </td>
        <td align="center">
            <div class="kotak-nomor <?php echo ($edukasiData->bidan->metode === "1" ? 'checked' : '' ); ?>"> 1 </div>
            <div class="kotak-nomor <?php echo ($edukasiData->bidan->metode === "2" ? 'checked' : '' ); ?>"> 2 </div>
            <div class="kotak-nomor <?php echo ($edukasiData->bidan->metode === "3" ? 'checked' : '' ); ?>"> 3 </div>
            <div class="kotak-nomor <?php echo ($edukasiData->bidan->metode === "4" ? 'checked' : '' ); ?>"> 4 </div>
            <div class="kotak-nomor <?php echo ($edukasiData->bidan->metode === "5" ? 'checked' : '' ); ?>"> 5 </div>
        </td>
        <td>
            <?= $edukasiData->bidan->profesi ?>
        </td>
        <td>
            <div class="flex-container">
                <div>
                    <input type="checkbox" <?php echo ($edukasiData->bidan->no_1 === true ? 'checked' : ''); ?>>
                </div>
                <div>
                    Pendidikan Kesehatan Tentang : <?= $edukasiData->bidan->no_1_isian ?>
                </div>
            </div>
            <div class="flex-container">
                <div>
                    <input type="checkbox" <?php echo ($edukasiData->bidan->no_2 === true ? 'checked' : ''); ?>>
                </div>
                <div>
                    Hasil Asuhan perawatan
                </div>
            </div>
            <div class="flex-container">
                <div>
                    <input type="checkbox" <?php echo ($edukasiData->bidan->no_3 === true ? 'checked' : ''); ?>>
                </div>
                <div>
                    Penanganan & cara perawatan di rumah
                </div>
            </div>
            <div class="flex-container">
                <div>
                    <input type="checkbox" <?php echo ($edukasiData->bidan->no_4 === true ? 'checked' : ''); ?>>
                </div>
                <div>
                    Perawatan Luka
                </div>
            </div>
            <div class="flex-container">
                <div>
                    <input type="checkbox" <?php echo ($edukasiData->bidan->no_5 === true ? 'checked' : ''); ?>>
                </div>
                <div>
                    Alat-alat yang perlu disiapkan di rumah
                </div>
            </div>
            <div class="flex-container">
                <div>
                    <input type="checkbox" <?php echo ($edukasiData->bidan->no_6 === true ? 'checked' : ''); ?>>
                </div>
                <div>
                    Informasi pasien baru
                </div>
            </div>
            <div class="flex-container">
                <div>
                    <input type="checkbox" <?php echo ($edukasiData->bidan->no_7 === true ? 'checked' : ''); ?>>
                </div>
                <div>
                    Penggunaan peralatan medis yang aman (infus pump, siringe pump, injeksi insulin, dsb)
                </div>
            </div>
            <div class="flex-container">
                <div>
                    <input type="checkbox" <?php echo ($edukasiData->bidan->no_8 === true ? 'checked' : ''); ?>>
                </div>
                <div>
                    Lain-lain : <?= $edukasiData->bidan->no_isian ?>
                </div>
            </div>
        </td>
        <td>
            <?= $edukasiData->bidan->estimasi ?>
        </td>
        <td align="center">
            <div class="kotak-nomor <?php echo ($edukasiData->bidan->pemahaman === "1" ? 'checked' : '' ); ?>"> 1 </div>
            <div class="kotak-nomor <?php echo ($edukasiData->bidan->pemahaman === "2" ? 'checked' : '' ); ?>"> 2 </div>
        </td>
        <td align="center">
            <div class="kotak-nomor <?php echo ($edukasiData->bidan->evaluasi === "1" ? 'checked' : '' ); ?>"> 1 </div>
            <div class="kotak-nomor <?php echo ($edukasiData->bidan->evaluasi === "2" ? 'checked' : '' ); ?>"> 2 </div>
            <div class="kotak-nomor <?php echo ($edukasiData->bidan->evaluasi === "3" ? 'checked' : '' ); ?>"> 3 </div>
            <div class="kotak-nomor <?php echo ($edukasiData->bidan->evaluasi === "4" ? 'checked' : '' ); ?>"> 4 </div>
        </td>
        <td>
            <div style="text-align: center; vertical-align:middle">
                <img src="<?php echo $params->paraf->ttd_5 ?>" width="100%" height="50px" >
            </div>
            <?= $edukasiData->bidan->pasien_edu ?>
        </td>
        <td>
            <div style="text-align: center; vertical-align:middle">
                <img src="<?php echo $params->paraf->ttd_6 ?>" width="100%" height="50px" >
            </div>
            <?= $edukasiData->bidan->pemberi_edu ?>
        </td>
    </tr>
    <tr>
        <td>
            <?= $edukasiData->kebersihan->hari ? "{$edukasiData->kebersihan->hari} / " : '' ?>
            <?= $edukasiData->kebersihan->tanggal_indo ? "{$edukasiData->kebersihan->tanggal_indo} / " : '' ?>
            <?= $edukasiData->kebersihan->jam ? "{$edukasiData->kebersihan->jam} WIB " : '' ?>
        </td>
        <td align="center">
            <div class="kotak-nomor <?php echo ($edukasiData->kebersihan->metode === "1" ? 'checked' : '' ); ?>"> 1 </div>
            <div class="kotak-nomor <?php echo ($edukasiData->kebersihan->metode === "2" ? 'checked' : '' ); ?>"> 2 </div>
            <div class="kotak-nomor <?php echo ($edukasiData->kebersihan->metode === "3" ? 'checked' : '' ); ?>"> 3 </div>
            <div class="kotak-nomor <?php echo ($edukasiData->kebersihan->metode === "4" ? 'checked' : '' ); ?>"> 4 </div>
            <div class="kotak-nomor <?php echo ($edukasiData->kebersihan->metode === "5" ? 'checked' : '' ); ?>"> 5 </div>
        </td>
        <td>
            <?= $edukasiData->kebersihan->profesi ?>
        </td>
        <td>
            <div class="flex-container">
                <div>
                    <input type="checkbox" <?php echo ($edukasiData->kebersihan->no_1 === true ? 'checked' : ''); ?>>
                </div>
                <div>
                    Cara cuci tangan
                </div>
            </div>
            <div class="flex-container">
                <div>
                    <input type="checkbox" <?php echo ($edukasiData->kebersihan->no_2 === true ? 'checked' : ''); ?>>
                </div>
                <div>
                    Etika Batuk
                </div>
            </div>
            <div class="flex-container">
                <div>
                    <input type="checkbox" <?php echo ($edukasiData->kebersihan->no_3 === true ? 'checked' : ''); ?>>
                </div>
                <div>
                    Cara Buang sampah medis dan non medis
                </div>
            </div>
            <div class="flex-container">
                <div>
                    <input type="checkbox" <?php echo ($edukasiData->kebersihan->no_4 === true ? 'checked' : ''); ?>>
                </div>
                <div>
                    Tempat Toileting
                </div>
            </div>
            <div class="flex-container">
                <div>
                    <input type="checkbox" <?php echo ($edukasiData->kebersihan->no_5 === true ? 'checked' : ''); ?>>
                </div>
                <div>
                    Bahaya merokok
                </div>
            </div>
            <div class="flex-container">
                <div>
                    <input type="checkbox" <?php echo ($edukasiData->kebersihan->no_6 === true ? 'checked' : ''); ?>>
                </div>
                <div>
                    <?= $edukasiData->kebersihan->no_isian ?>
                </div>
            </div>
        </td>
        <td>
            <?= $edukasiData->kebersihan->estimasi ?>
        </td>
        <td align="center">
            <div class="kotak-nomor <?php echo ($edukasiData->kebersihan->pemahaman === "1" ? 'checked' : '' ); ?>"> 1 </div>
            <div class="kotak-nomor <?php echo ($edukasiData->kebersihan->pemahaman === "2" ? 'checked' : '' ); ?>"> 2 </div>
        </td>
        <td align="center">
            <div class="kotak-nomor <?php echo ($edukasiData->kebersihan->evaluasi === "1" ? 'checked' : '' ); ?>"> 1 </div>
            <div class="kotak-nomor <?php echo ($edukasiData->kebersihan->evaluasi === "2" ? 'checked' : '' ); ?>"> 2 </div>
            <div class="kotak-nomor <?php echo ($edukasiData->kebersihan->evaluasi === "3" ? 'checked' : '' ); ?>"> 3 </div>
            <div class="kotak-nomor <?php echo ($edukasiData->kebersihan->evaluasi === "4" ? 'checked' : '' ); ?>"> 4 </div>
        </td>
        <td>
            <div style="text-align: center; vertical-align:middle">
                <img src="<?php echo $params->paraf->ttd_7 ?>" width="100%" height="50px" >
            </div>
            <?= $edukasiData->kebersihan->pasien_edu ?>
        </td>
        <td>
            <div style="text-align: center; vertical-align:middle">
                <img src="<?php echo $params->paraf->ttd_8 ?>" width="100%" height="50px" >
            </div>
            <?= $edukasiData->kebersihan->pemberi_edu ?>
        </td>
    </tr>
    <tr>
        <td>
            <?= $edukasiData->farmasis->hari ? "{$edukasiData->farmasis->hari} / " : '' ?>
            <?= $edukasiData->farmasis->tanggal_indo ? "{$edukasiData->farmasis->tanggal_indo} / " : '' ?>
            <?= $edukasiData->farmasis->jam ? "{$edukasiData->farmasis->jam} WIB " : '' ?>
        </td>
        <td align="center">
            <div class="kotak-nomor <?php echo ($edukasiData->farmasis->metode === "1" ? 'checked' : '' ); ?>"> 1 </div>
            <div class="kotak-nomor <?php echo ($edukasiData->farmasis->metode === "2" ? 'checked' : '' ); ?>"> 2 </div>
            <div class="kotak-nomor <?php echo ($edukasiData->farmasis->metode === "3" ? 'checked' : '' ); ?>"> 3 </div>
            <div class="kotak-nomor <?php echo ($edukasiData->farmasis->metode === "4" ? 'checked' : '' ); ?>"> 4 </div>
            <div class="kotak-nomor <?php echo ($edukasiData->farmasis->metode === "5" ? 'checked' : '' ); ?>"> 5 </div>
        </td>
        <td>
            <?= $edukasiData->farmasis->profesi ?>
        </td>
        <td>
            <div class="flex-container">
                <div>
                    <input type="checkbox" <?php echo ($edukasiData->farmasis->no_1 === true ? 'checked' : ''); ?>>
                </div>
                <div>
                    Nama Obat dan Kegunaannya
                </div>
            </div>
            <div class="flex-container">
                <div>
                    <input type="checkbox" <?php echo ($edukasiData->farmasis->no_2 === true ? 'checked' : ''); ?>>
                </div>
                <div>
                    Aturan pemakaian obat & dosis
                </div>
            </div>
            <div class="flex-container">
                <div>
                    <input type="checkbox" <?php echo ($edukasiData->farmasis->no_3 === true ? 'checked' : ''); ?>>
                </div>
                <div>
                    Kontraindikasi obat & efek samping obat
                </div>
            </div>
            <div class="flex-container">
                <div>
                    <input type="checkbox" <?php echo ($edukasiData->farmasis->no_4 === true ? 'checked' : ''); ?>>
                </div>
                <div>
                    Aturan & cara pemakaian obat high alert
                </div>
            </div>
            <div class="flex-container">
                <div>
                    <input type="checkbox" <?php echo ($edukasiData->farmasis->no_5 === true ? 'checked' : ''); ?>>
                </div>
                <div>
                    Efek samping dan interaksi obat high alert
                </div>
            </div>
            <div class="flex-container">
                <div>
                    <input type="checkbox" <?php echo ($edukasiData->farmasis->no_6 === true ? 'checked' : ''); ?>>
                </div>
                <div>
                    <?= $edukasiData->farmasis->no_isian ?>
                </div>
            </div>
        </td>
        <td>
            <?= $edukasiData->farmasis->estimasi ?>
        </td>
        <td align="center">
            <div class="kotak-nomor <?php echo ($edukasiData->farmasis->pemahaman === "1" ? 'checked' : '' ); ?>"> 1 </div>
            <div class="kotak-nomor <?php echo ($edukasiData->farmasis->pemahaman === "2" ? 'checked' : '' ); ?>"> 2 </div>
        </td>
        <td align="center">
            <div class="kotak-nomor <?php echo ($edukasiData->farmasis->evaluasi === "1" ? 'checked' : '' ); ?>"> 1 </div>
            <div class="kotak-nomor <?php echo ($edukasiData->farmasis->evaluasi === "2" ? 'checked' : '' ); ?>"> 2 </div>
            <div class="kotak-nomor <?php echo ($edukasiData->farmasis->evaluasi === "3" ? 'checked' : '' ); ?>"> 3 </div>
            <div class="kotak-nomor <?php echo ($edukasiData->farmasis->evaluasi === "4" ? 'checked' : '' ); ?>"> 4 </div>
        </td>
        <td>
            <div style="text-align: center; vertical-align:middle">
                <img src="<?php echo $params->paraf->ttd_9 ?>" width="100%" height="50px" >
            </div>
            <?= $edukasiData->farmasis->pasien_edu ?>
        </td>
        <td>
            <div style="text-align: center; vertical-align:middle">
                <img src="<?php echo $params->paraf->ttd_10 ?>" width="100%" height="50px" >
            </div>
            <?= $edukasiData->farmasis->pemberi_edu ?>
        </td>
    </tr>
    <tr>
        <td>
            <?= $edukasiData->nutrisionis->hari ? "{$edukasiData->nutrisionis->hari} / " : '' ?>
            <?= $edukasiData->nutrisionis->tanggal_indo ? "{$edukasiData->nutrisionis->tanggal_indo} / " : '' ?>
            <?= $edukasiData->nutrisionis->jam ? "{$edukasiData->nutrisionis->jam} WIB " : '' ?>
        </td>
        <td align="center">
            <div class="kotak-nomor <?php echo ($edukasiData->nutrisionis->metode === "1" ? 'checked' : '' ); ?>"> 1 </div>
            <div class="kotak-nomor <?php echo ($edukasiData->nutrisionis->metode === "2" ? 'checked' : '' ); ?>"> 2 </div>
            <div class="kotak-nomor <?php echo ($edukasiData->nutrisionis->metode === "3" ? 'checked' : '' ); ?>"> 3 </div>
            <div class="kotak-nomor <?php echo ($edukasiData->nutrisionis->metode === "4" ? 'checked' : '' ); ?>"> 4 </div>
            <div class="kotak-nomor <?php echo ($edukasiData->nutrisionis->metode === "5" ? 'checked' : '' ); ?>"> 5 </div>
        </td>
        <td>
            <?= $edukasiData->nutrisionis->profesi ?>
        </td>
        <td>
            <div class="flex-container">
                <div>
                    <input type="checkbox" <?php echo ($edukasiData->nutrisionis->no_1 === true ? 'checked' : ''); ?>>
                </div>
                <div>
                    Diet dan Nutrisi
                </div>
            </div>
            <div class="flex-container">
                <div>
                    <input type="checkbox" <?php echo ($edukasiData->nutrisionis->no_2 === true ? 'checked' : ''); ?>>
                </div>
                <div>
                    Konsultasi gizi rawat inap
                </div>
            </div>
            <div class="flex-container">
                <div>
                    <input type="checkbox" <?php echo ($edukasiData->nutrisionis->no_3 === true ? 'checked' : ''); ?>>
                </div>
                <div>
                    Konsultasi gizi rawat jalan
                </div>
            </div>
            <div class="flex-container">
                <div>
                    <input type="checkbox" <?php echo ($edukasiData->nutrisionis->no_4 === true ? 'checked' : ''); ?>>
                </div>
                <div>
                    Diet selama perawatan
                </div>
            </div>
            <div class="flex-container">
                <div>
                    <input type="checkbox" <?php echo ($edukasiData->nutrisionis->no_5 === true ? 'checked' : ''); ?>>
                </div>
                <div>
                    Diet untuk dirumah
                </div>
            </div>
            <div class="flex-container">
                <div>
                    <input type="checkbox" <?php echo ($edukasiData->nutrisionis->no_6 === true ? 'checked' : ''); ?>>
                </div>
                <div>
                    Alergi Makanan
                </div>
            </div>
            <div class="flex-container">
                <div>
                    <input type="checkbox" <?php echo ($edukasiData->nutrisionis->no_7 === true ? 'checked' : ''); ?>>
                </div>
                <div>
                    <?= $edukasiData->nutrisionis->no_isian ?>
                </div>
            </div>
        </td>
        <td>
            <?= $edukasiData->nutrisionis->estimasi ?>
        </td>
        <td align="center">
            <div class="kotak-nomor <?php echo ($edukasiData->nutrisionis->pemahaman === "1" ? 'checked' : '' ); ?>"> 1 </div>
            <div class="kotak-nomor <?php echo ($edukasiData->nutrisionis->pemahaman === "2" ? 'checked' : '' ); ?>"> 2 </div>
        </td>
        <td align="center">
            <div class="kotak-nomor <?php echo ($edukasiData->nutrisionis->evaluasi === "1" ? 'checked' : '' ); ?>"> 1 </div>
            <div class="kotak-nomor <?php echo ($edukasiData->nutrisionis->evaluasi === "2" ? 'checked' : '' ); ?>"> 2 </div>
            <div class="kotak-nomor <?php echo ($edukasiData->nutrisionis->evaluasi === "3" ? 'checked' : '' ); ?>"> 3 </div>
            <div class="kotak-nomor <?php echo ($edukasiData->nutrisionis->evaluasi === "4" ? 'checked' : '' ); ?>"> 4 </div>
        </td>
        <td>
            <div style="text-align: center; vertical-align:middle">
                <img src="<?php echo $params->paraf->ttd_11 ?>" width="100%" height="50px" >
            </div>
            <?= $edukasiData->nutrisionis->pasien_edu ?>
        </td>
        <td>
            <div style="text-align: center; vertical-align:middle">
                <img src="<?php echo $params->paraf->ttd_12 ?>" width="100%" height="50px" >
            </div>
            <?= $edukasiData->nutrisionis->pemberi_edu ?>
        </td>
    </tr>
    <tr>
        <td>
            <?= $edukasiData->nyeri->hari ? "{$edukasiData->nyeri->hari} / " : '' ?>
            <?= $edukasiData->nyeri->tanggal_indo ? "{$edukasiData->nyeri->tanggal_indo} / " : '' ?>
            <?= $edukasiData->nyeri->jam ? "{$edukasiData->nyeri->jam} WIB " : '' ?>
        </td>
        <td align="center">
            <div class="kotak-nomor <?php echo ($edukasiData->nyeri->metode === "1" ? 'checked' : '' ); ?>"> 1 </div>
            <div class="kotak-nomor <?php echo ($edukasiData->nyeri->metode === "2" ? 'checked' : '' ); ?>"> 2 </div>
            <div class="kotak-nomor <?php echo ($edukasiData->nyeri->metode === "3" ? 'checked' : '' ); ?>"> 3 </div>
            <div class="kotak-nomor <?php echo ($edukasiData->nyeri->metode === "4" ? 'checked' : '' ); ?>"> 4 </div>
            <div class="kotak-nomor <?php echo ($edukasiData->nyeri->metode === "5" ? 'checked' : '' ); ?>"> 5 </div>
        </td>
        <td>
            <?= $edukasiData->nyeri->profesi ?>
        </td>
        <td>
            <div class="flex-container">
                <div>
                    <input type="checkbox" <?php echo ($edukasiData->nyeri->no_1 === true ? 'checked' : ''); ?>>
                </div>
                <div>
                    Farmakologi : Obat oral / Injeksi / sedasi
                </div>
            </div>
            <div class="flex-container">
                <div>
                    <input type="checkbox" <?php echo ($edukasiData->nyeri->no_2 === true ? 'checked' : ''); ?>>
                </div>
                <div>
                    Non Farmakologi : Latihan nafas dalam
                </div>
            </div>
            <div class="flex-container">
                <div>
                    <input type="checkbox" <?php echo ($edukasiData->nyeri->no_3 === true ? 'checked' : ''); ?>>
                </div>
                <div>
                    Non Farmakologi : Distraksi
                </div>
            </div>
            <div class="flex-container">
                <div>
                    <input type="checkbox" <?php echo ($edukasiData->nyeri->no_4 === true ? 'checked' : ''); ?>>
                </div>
                <div>
                    Pengalihan Perhatian
                </div>
            </div>
            <div class="flex-container">
                <div>
                    <input type="checkbox" <?php echo ($edukasiData->nyeri->no_5 === true ? 'checked' : ''); ?>>
                </div>
                <div>
                    Evaluasi Nyeri sesuai derajat
                </div>
            </div>
            <div class="flex-container">
                <div>
                    <input type="checkbox" <?php echo ($edukasiData->nyeri->no_6 === true ? 'checked' : ''); ?>>
                </div>
                <div>
                    <?= $edukasiData->nyeri->no_isian ?>
                </div>
            </div>
        </td>
        <td>
            <?= $edukasiData->nyeri->estimasi ?>
        </td>
        <td align="center">
            <div class="kotak-nomor <?php echo ($edukasiData->nyeri->pemahaman === "1" ? 'checked' : '' ); ?>"> 1 </div>
            <div class="kotak-nomor <?php echo ($edukasiData->nyeri->pemahaman === "2" ? 'checked' : '' ); ?>"> 2 </div>
        </td>
        <td align="center">
            <div class="kotak-nomor <?php echo ($edukasiData->nyeri->evaluasi === "1" ? 'checked' : '' ); ?>"> 1 </div>
            <div class="kotak-nomor <?php echo ($edukasiData->nyeri->evaluasi === "2" ? 'checked' : '' ); ?>"> 2 </div>
            <div class="kotak-nomor <?php echo ($edukasiData->nyeri->evaluasi === "3" ? 'checked' : '' ); ?>"> 3 </div>
            <div class="kotak-nomor <?php echo ($edukasiData->nyeri->evaluasi === "4" ? 'checked' : '' ); ?>"> 4 </div>
        </td>
        <td>
            <div style="text-align: center; vertical-align:middle">
                <img src="<?php echo $params->paraf->ttd_13 ?>" width="100%" height="50px" >
            </div>
            <?= $edukasiData->nyeri->pasien_edu ?>
        </td>
        <td>
            <div style="text-align: center; vertical-align:middle">
                <img src="<?php echo $params->paraf->ttd_14 ?>" width="100%" height="50px" >
            </div>
            <?= $edukasiData->nyeri->pemberi_edu ?>
        </td>
    </tr>
    <tr>
        <td>
            <?= $edukasiData->medik->hari ? "{$edukasiData->medik->hari} / " : '' ?>
            <?= $edukasiData->medik->tanggal_indo ? "{$edukasiData->medik->tanggal_indo} / " : '' ?>
            <?= $edukasiData->medik->jam ? "{$edukasiData->medik->jam} WIB " : '' ?>
        </td>
        <td align="center">
            <div class="kotak-nomor <?php echo ($edukasiData->medik->metode === "1" ? 'checked' : '' ); ?>"> 1 </div>
            <div class="kotak-nomor <?php echo ($edukasiData->medik->metode === "2" ? 'checked' : '' ); ?>"> 2 </div>
            <div class="kotak-nomor <?php echo ($edukasiData->medik->metode === "3" ? 'checked' : '' ); ?>"> 3 </div>
            <div class="kotak-nomor <?php echo ($edukasiData->medik->metode === "4" ? 'checked' : '' ); ?>"> 4 </div>
            <div class="kotak-nomor <?php echo ($edukasiData->medik->metode === "5" ? 'checked' : '' ); ?>"> 5 </div>
        </td>
        <td>
            <?= $edukasiData->medik->profesi ?>
        </td>
        <td>
            <div class="flex-container">
                <div>
                    <input type="checkbox" <?php echo ($edukasiData->medik->no_1 === true ? 'checked' : ''); ?>>
                </div>
                <div>
                    Fisioterapi
                </div>
            </div>
            <div class="flex-container">
                <div>
                    <input type="checkbox" <?php echo ($edukasiData->medik->no_2 === true ? 'checked' : ''); ?>>
                </div>
                <div>
                    Okupasi Terapi
                </div>
            </div>
            <div class="flex-container">
                <div>
                    <input type="checkbox" <?php echo ($edukasiData->medik->no_3 === true ? 'checked' : ''); ?>>
                </div>
                <div>
                    Terapi Wicara
                </div>
            </div>
            <div class="flex-container">
                <div>
                    <input type="checkbox" <?php echo ($edukasiData->medik->no_4 === true ? 'checked' : ''); ?>>
                </div>
                <div>
                    Ortotik Prostetik
                </div>
            </div>
            <div class="flex-container">
                <div>
                    <input type="checkbox" <?php echo ($edukasiData->medik->no_5 === true ? 'checked' : ''); ?>>
                </div>
                <div>
                    <?= $edukasiData->medik->no_isian ?>
                </div>
            </div>
        </td>
        <td>
            <?= $edukasiData->medik->estimasi ?>
        </td>
        <td align="center">
            <div class="kotak-nomor <?php echo ($edukasiData->medik->pemahaman === "1" ? 'checked' : '' ); ?>"> 1 </div>
            <div class="kotak-nomor <?php echo ($edukasiData->medik->pemahaman === "2" ? 'checked' : '' ); ?>"> 2 </div>
        </td>
        <td align="center">
            <div class="kotak-nomor <?php echo ($edukasiData->medik->evaluasi === "1" ? 'checked' : '' ); ?>"> 1 </div>
            <div class="kotak-nomor <?php echo ($edukasiData->medik->evaluasi === "2" ? 'checked' : '' ); ?>"> 2 </div>
            <div class="kotak-nomor <?php echo ($edukasiData->medik->evaluasi === "3" ? 'checked' : '' ); ?>"> 3 </div>
            <div class="kotak-nomor <?php echo ($edukasiData->medik->evaluasi === "4" ? 'checked' : '' ); ?>"> 4 </div>
        </td>
        <td>
            <div style="text-align: center; vertical-align:middle">
                <img src="<?php echo $params->paraf->ttd_15 ?>" width="100%" height="50px" >
            </div>
            <?= $edukasiData->medik->pasien_edu ?>
        </td>
        <td>
            <div style="text-align: center; vertical-align:middle">
                <img src="<?php echo $params->paraf->ttd_16 ?>" width="100%" height="50px" >
            </div>
            <?= $edukasiData->medik->pemberi_edu ?>
        </td>
    </tr>
    <tr>
        <td>
            <?= $edukasiData->medis->hari ? "{$edukasiData->medis->hari} / " : '' ?>
            <?= $edukasiData->medis->tanggal_indo ? "{$edukasiData->medis->tanggal_indo} / " : '' ?>
            <?= $edukasiData->medis->jam ? "{$edukasiData->medis->jam} WIB " : '' ?>
        </td>
        <td align="center">
            <div class="kotak-nomor <?php echo ($edukasiData->medis->metode === "1" ? 'checked' : '' ); ?>"> 1 </div>
            <div class="kotak-nomor <?php echo ($edukasiData->medis->metode === "2" ? 'checked' : '' ); ?>"> 2 </div>
            <div class="kotak-nomor <?php echo ($edukasiData->medis->metode === "3" ? 'checked' : '' ); ?>"> 3 </div>
            <div class="kotak-nomor <?php echo ($edukasiData->medis->metode === "4" ? 'checked' : '' ); ?>"> 4 </div>
            <div class="kotak-nomor <?php echo ($edukasiData->medis->metode === "5" ? 'checked' : '' ); ?>"> 5 </div>
        </td>
        <td>
            <?= $edukasiData->medis->profesi ?>
        </td>
        <td>
            <div class="flex-container">
                <div>
                    <input type="checkbox" <?php echo ($edukasiData->medis->no_1 === true ? 'checked' : ''); ?>>
                </div>
                <div>
                    Persiapan Pemeriksaan radiodiagnostik
                </div>
            </div>
            <div class="flex-container">
                <div>
                    <input type="checkbox" <?php echo ($edukasiData->medis->no_2 === true ? 'checked' : ''); ?>>
                </div>
                <div>
                    Pengawasan diri selama dan setelah radiasi Persiapan pemeriksaan darah / urine / dan sampel lainnya
                </div>
            </div>
            <div class="flex-container">
                <div>
                    <input type="checkbox" <?php echo ($edukasiData->medis->no_3 === true ? 'checked' : ''); ?>>
                </div>
                <div>
                    <?= $edukasiData->medis->no_isian ?>
                </div>
            </div>
        </td>
        <td>
            <?= $edukasiData->medis->estimasi ?>
        </td>
        <td align="center">
            <div class="kotak-nomor <?php echo ($edukasiData->medis->pemahaman === "1" ? 'checked' : '' ); ?>"> 1 </div>
            <div class="kotak-nomor <?php echo ($edukasiData->medis->pemahaman === "2" ? 'checked' : '' ); ?>"> 2 </div>
        </td>
        <td align="center">
            <div class="kotak-nomor <?php echo ($edukasiData->medis->evaluasi === "1" ? 'checked' : '' ); ?>"> 1 </div>
            <div class="kotak-nomor <?php echo ($edukasiData->medis->evaluasi === "2" ? 'checked' : '' ); ?>"> 2 </div>
            <div class="kotak-nomor <?php echo ($edukasiData->medis->evaluasi === "3" ? 'checked' : '' ); ?>"> 3 </div>
            <div class="kotak-nomor <?php echo ($edukasiData->medis->evaluasi === "4" ? 'checked' : '' ); ?>"> 4 </div>
        </td>
        <td>
            <div style="text-align: center; vertical-align:middle">
                <img src="<?php echo $params->paraf->ttd_17 ?>" width="100%" height="50px" >
            </div>
            <?= $edukasiData->medis->pasien_edu ?>
        </td>
        <td>
            <div style="text-align: center; vertical-align:middle">
                <img src="<?php echo $params->paraf->ttd_18 ?>" width="100%" height="50px" >
            </div>
            <?= $edukasiData->medis->pemberi_edu ?>
        </td>
    </tr>
    <tr>
        <td>
            <?= $edukasiData->rohaniawan->hari ? "{$edukasiData->rohaniawan->hari} / " : '' ?>
            <?= $edukasiData->rohaniawan->tanggal_indo ? "{$edukasiData->rohaniawan->tanggal_indo} / " : '' ?>
            <?= $edukasiData->rohaniawan->jam ? "{$edukasiData->rohaniawan->jam} WIB " : '' ?>
        </td>
        <td align="center">
            <div class="kotak-nomor <?php echo ($edukasiData->rohaniawan->metode === "1" ? 'checked' : '' ); ?>"> 1 </div>
            <div class="kotak-nomor <?php echo ($edukasiData->rohaniawan->metode === "2" ? 'checked' : '' ); ?>"> 2 </div>
            <div class="kotak-nomor <?php echo ($edukasiData->rohaniawan->metode === "3" ? 'checked' : '' ); ?>"> 3 </div>
            <div class="kotak-nomor <?php echo ($edukasiData->rohaniawan->metode === "4" ? 'checked' : '' ); ?>"> 4 </div>
            <div class="kotak-nomor <?php echo ($edukasiData->rohaniawan->metode === "5" ? 'checked' : '' ); ?>"> 5 </div>
        </td>
        <td>
            <?= $edukasiData->rohaniawan->profesi ?>
        </td>
        <td>
            <div class="flex-container">
                <div>
                    <input type="checkbox" <?php echo ($edukasiData->rohaniawan->no_1 === true ? 'checked' : ''); ?>>
                </div>
                <div>
                    Bimbingan Rohani
                </div>
            </div>
            <div class="flex-container">
                <div>
                    <input type="checkbox" <?php echo ($edukasiData->rohaniawan->no_2 === true ? 'checked' : ''); ?>>
                </div>
                <div>
                    Konseling spiritual akhir hayat
                </div>
            </div>
            <div class="flex-container">
                <div>
                    <input type="checkbox" <?php echo ($edukasiData->rohaniawan->no_3 === true ? 'checked' : ''); ?>>
                </div>
                <div>
                    Bimbingan Ibadah
                </div>
            </div>
            <div class="flex-container">
                <div>
                    <input type="checkbox" <?php echo ($edukasiData->rohaniawan->no_4 === true ? 'checked' : ''); ?>>
                </div>
                <div>
                    Doa
                </div>
            </div>
            <div class="flex-container">
                <div>
                    <input type="checkbox" <?php echo ($edukasiData->rohaniawan->no_5 === true ? 'checked' : ''); ?>>
                </div>
                <div>
                    <?= $edukasiData->rohaniawan->no_isian ?>
                </div>
            </div>
        </td>
        <td>
            <?= $edukasiData->rohaniawan->estimasi ?>
        </td>
        <td align="center">
            <div class="kotak-nomor <?php echo ($edukasiData->rohaniawan->pemahaman === "1" ? 'checked' : '' ); ?>"> 1 </div>
            <div class="kotak-nomor <?php echo ($edukasiData->rohaniawan->pemahaman === "2" ? 'checked' : '' ); ?>"> 2 </div>
        </td>
        <td align="center">
            <div class="kotak-nomor <?php echo ($edukasiData->rohaniawan->evaluasi === "1" ? 'checked' : '' ); ?>"> 1 </div>
            <div class="kotak-nomor <?php echo ($edukasiData->rohaniawan->evaluasi === "2" ? 'checked' : '' ); ?>"> 2 </div>
            <div class="kotak-nomor <?php echo ($edukasiData->rohaniawan->evaluasi === "3" ? 'checked' : '' ); ?>"> 3 </div>
            <div class="kotak-nomor <?php echo ($edukasiData->rohaniawan->evaluasi === "4" ? 'checked' : '' ); ?>"> 4 </div>
        </td>
        <td>
            <div style="text-align: center; vertical-align:middle">
                <img src="<?php echo $params->paraf->ttd_19 ?>" width="100%" height="50px" >
            </div>
            <?= $edukasiData->rohaniawan->pasien_edu ?>
        </td>
        <td>
            <div style="text-align: center; vertical-align:middle">
                <img src="<?php echo $params->paraf->ttd_20 ?>" width="100%" height="50px" >
            </div>
            <?= $edukasiData->rohaniawan->pemberi_edu ?>
        </td>
    </tr>
    <tr>
        <td>
            <?= $edukasiData->lain_lain->hari ? "{$edukasiData->lain_lain->hari} / " : '' ?>
            <?= $edukasiData->lain_lain->tanggal_indo ? "{$edukasiData->lain_lain->tanggal_indo} / " : '' ?>
            <?= $edukasiData->lain_lain->jam ? "{$edukasiData->lain_lain->jam} WIB " : '' ?>
        </td>
        <td align="center">
            <div class="kotak-nomor <?php echo ($edukasiData->lain_lain->metode === "1" ? 'checked' : '' ); ?>"> 1 </div>
            <div class="kotak-nomor <?php echo ($edukasiData->lain_lain->metode === "2" ? 'checked' : '' ); ?>"> 2 </div>
            <div class="kotak-nomor <?php echo ($edukasiData->lain_lain->metode === "3" ? 'checked' : '' ); ?>"> 3 </div>
            <div class="kotak-nomor <?php echo ($edukasiData->lain_lain->metode === "4" ? 'checked' : '' ); ?>"> 4 </div>
            <div class="kotak-nomor <?php echo ($edukasiData->lain_lain->metode === "5" ? 'checked' : '' ); ?>"> 5 </div>
        </td>
        <td>
            <?= $edukasiData->lain_lain->profesi ?>
        </td>
        <td>
            <div class="flex-container">
                <div>
                    <input type="checkbox" <?php echo ($edukasiData->lain_lain->no_1 === true ? 'checked' : ''); ?>>
                </div>
                <div>
                    Hak dan Kewajiban Pasien
                </div>
            </div>
            <div class="flex-container">
                <div>
                    <input type="checkbox" <?php echo ($edukasiData->lain_lain->no_2 === true ? 'checked' : ''); ?>>
                </div>
                <div>
                    Jam Konsultasi
                </div>
            </div>
            <div class="flex-container">
                <div>
                    <input type="checkbox" <?php echo ($edukasiData->lain_lain->no_3 === true ? 'checked' : ''); ?>>
                </div>
                <div>
                    Tata tertib dan fasilitas RS
                </div>
            </div>
            <div class="flex-container">
                <div>
                    <input type="checkbox" <?php echo ($edukasiData->lain_lain->no_4 === true ? 'checked' : ''); ?>>
                </div>
                <div>
                    Informasi kejadian yang tidak diharapkan
                </div>
            </div>
            <div class="flex-container">
                <div>
                    <input type="checkbox" <?php echo ($edukasiData->lain_lain->no_5 === true ? 'checked' : ''); ?>>
                </div>
                <div>
                    <?= $edukasiData->lain_lain->no_isian ?>
                </div>
            </div>
        </td>
        <td>
            <?= $edukasiData->lain_lain->estimasi ?>
        </td>
        <td align="center">
            <div class="kotak-nomor <?php echo ($edukasiData->lain_lain->pemahaman === "1" ? 'checked' : '' ); ?>"> 1 </div>
            <div class="kotak-nomor <?php echo ($edukasiData->lain_lain->pemahaman === "2" ? 'checked' : '' ); ?>"> 2 </div>
        </td>
        <td align="center">
            <div class="kotak-nomor <?php echo ($edukasiData->lain_lain->evaluasi === "1" ? 'checked' : '' ); ?>"> 1 </div>
            <div class="kotak-nomor <?php echo ($edukasiData->lain_lain->evaluasi === "2" ? 'checked' : '' ); ?>"> 2 </div>
            <div class="kotak-nomor <?php echo ($edukasiData->lain_lain->evaluasi === "3" ? 'checked' : '' ); ?>"> 3 </div>
            <div class="kotak-nomor <?php echo ($edukasiData->lain_lain->evaluasi === "4" ? 'checked' : '' ); ?>"> 4 </div>
        </td>
        <td>
            <div style="text-align: center; vertical-align:middle">
                <img src="<?php echo $params->paraf->ttd_21 ?>" width="100%" height="50px" >
            </div>
            <?= $edukasiData->lain_lain->pasien_edu ?>
        </td>
        <td>
            <div style="text-align: center; vertical-align:middle">
                <img src="<?php echo $params->paraf->ttd_22 ?>" width="100%" height="50px" >
            </div>
            <?= $edukasiData->lain_lain->pemberi_edu ?>
        </td>
    </tr>
    
  </table>

  <div align="right"><b>RI RM 15 / Rev.0 / 2022</b></div>
</body>

</html>