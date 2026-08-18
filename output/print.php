<?php
// EMR Data
$params = json_decode($argv[1]);
// $cekaja = json_decode($argv[0]);

$base_url = $argv[2]; // Base_url
$title = "Catatan Perkembangan Pasien Terintegrasi";
$static_label = json_decode($argv[3]);
?>

<!DOCTYPE html>
<html>

<head>
	<title><?php echo $title; ?></title>
</head>
<style>
	/*body {*/
	/*    font-family: 'Calibri', sans-serif;*/
	/*}*/

	table {
		width: 100%;
		border-collapse: collapse;
		border: 1px solid #000;
		text-align: left;
		page-break-after: auto;
	}

	table tr {
		border: 1px solid #000;
	}

	table th,
	table td {
		border: 1px solid #000;
		padding: 4px 8px;
		word-wrap: break-word;
		vertical-align: top;
		page-break-inside: avoid;
		page-break-after: avoid;
	}

	table th {
		text-align: center;
		font-weight: bold;
		vertical-align: middle;
		background-color: #f2f2f2;
		/* Opsional, untuk memperjelas header */
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
		padding: 2px 2px;
		border: none;
		/*vertical-align: top;*/
	}

	.text-center {
		text-align: center;
	}

	.page-breaker {
		page-break-before: always;
	}
</style>

<body>
	<table width="100%">
		<tr>
			<td style="width: 60%; vertical-align: middle">
				<table class="mini-table">
					<tr>
						<td width="25%" style="vertical-align: middle">
							<center><img style="width: 80%;" src="<?= $base_url ?>/images/rs/LogoRS.png"></center>
						</td>
						<td style="vertical-align: middle">
							<h3 class="text-center" style="margin: 0"><?php echo $static_label->hospital_name ?? "" ?></h3>							<center><?php echo $static_label->hospital_address; ?> </center>
							<center>Tlp. <?php echo $static_label->hospital_phone; ?></center>
							<center>Email. <?php echo $static_label->hospital_email; ?></center>
						</td>
					</tr>
				</table>
			</td>
			<td style="vertical-align: middle">
				<table class="mini-table">
					<tr>
						<td style="width: 31%;">No. RM</td>
						<td width="1%">:</td>
						<td>
							<?= $params->pasien->no_rm ?>
						</td>
					</tr>
					<tr>
						<td class="text-top">Nama</td>
						<td>:</td>
						<td>
							<?= $params->pasien->nama ?>
						</td>
					</tr>
					<tr>
						<td>Tgl Lahir</td>
						<td>:</td>
						<td>
							<?= $params->pasien->tanggal_lahir_indo ?>
						</td>
					</tr>
					<tr>
						<td>Jenis Kelamin</td>
						<td>:</td>
						<td>
							<?= $params->pasien->kelamin === "L"
								? "Laki-laki"
								: "Perempuan" ?>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	<table width="100%">
		<tr>
			<td class="text-center" colspan="5" style="height: 3em; vertical-align: middle; font-size: 15pt">
				<b>CATATAN PERKEMBANGAN PASIEN TERINTEGRASI</b>
			</td>
		</tr>
		<tr>
			<th width="13%">Tanggal & Pukul</th>
			<th width="15%">Profesional Pemberi Asuhan</th>
			<th width="32%">Hasil Asesmen-IAR Penatalaksanaan Pasien (SOAP/ADIME/SBAR)<br>(Nama, paraf, pada akhir catatan)</th>
			<th width="23%">Intruksi PPA<br>(Termasuk Pasca Bedah)</th>
			<th width="17%">Verifikasi DPJP (Nama, paraf, tgl, pukul)</th>
		</tr>
		<?php foreach ($params->data_list as $i => $v): ?>
			<tr>
				<td>
					<?= $v->tanggal_cppt_indo ? "{$v->tanggal_cppt_indo} <br>" : "" ?>
					<?= $v->jam_cppt ? "{$v->jam_cppt} WIB <br>" : "" ?>
					<?= $v->klinik ? "Klinik : {$v->klinik} <br>" : "" ?>
					<?= $v->igd ? "IGD : {$v->igd} <br>" : "" ?>
					<?php if ($v->bangsal || $v->ruang || $v->kelas): ?>
						Ruang :
						<?= $v->bangsal ?>
						<?= $v->ruang ? " - Ruang {$v->ruang}" : "" ?>
						<?= $v->kelas ? " - Kelas {$v->kelas}" : "" ?>
					<?php endif; ?>
				</td>
				<td align="center">
					<?= $v->profesi ?>
				</td>
				<td>
					<?php if ($v->pilihan === "SOAP"): ?>
						<div>
							<b>S</b> : <br> <?= nl2br(
												trim($v->hasil_asesmen->catatan_s)
											) ?> <br>
							<b>O</b> : <br> <?= nl2br(
												trim($v->hasil_asesmen->catatan_o)
											) ?> <br>
							<b>A</b> : <br> <?= nl2br(
												trim($v->hasil_asesmen->catatan_a)
											) ?> <br>
							<b>P</b> : <br> <?= nl2br(
												trim($v->hasil_asesmen->catatan_p)
											) ?>
						</div>
					<?php endif; ?>
					<?php if ($v->pilihan === "ADIME"): ?>
						<div>
							<b>A</b> : <br> <?= nl2br(
												trim($v->hasil_adime->adime_a)
											) ?> <br>
							<b>D</b> : <br> <?= nl2br(
												trim($v->hasil_adime->adime_d)
											) ?> <br>
							<b>I</b> : <br> <?= nl2br(
												trim($v->hasil_adime->adime_i)
											) ?> <br>
							<b>ME</b> : <br> <?= nl2br(
													trim($v->hasil_adime->adime_me)
												) ?>
						</div>
					<?php endif; ?>
					<?php if ($v->pilihan === "SBAR"): ?>
						<div>
							<b>S</b> : <br> <?= nl2br(
												trim($v->hasil_sbar->sbar_s)
											) ?> <br>
							<b>B</b> : <br> <?= nl2br(
												trim($v->hasil_sbar->sbar_b)
											) ?> <br>
							<b>A</b> : <br> <?= nl2br(
												trim($v->hasil_sbar->sbar_a)
											) ?> <br>
							<b>R</b> : <br> <?= nl2br(trim($v->hasil_sbar->sbar_r)) ?>
						</div>
					<?php endif; ?>
				</td>
				<td>
					<?= $v->instruksi_ppa ? "{$v->instruksi_ppa} <br>" : "" ?>

					<?php if (
						$v->perawat_harian &&
						$v->perawat_harian !== "-" &&
						($v->profesi !== "Apoteker" && $v->pilihan !== "ADIME" && $v->pilihan !== "SBAR")
					): ?>
						<!--<table class="table-bordered" v-show="(item.perawat_harian && item.perawat_harian !== '-') && (item.profesi !== 'Apoteker' && item.pilihan !== 'ADIME')">-->
						<table width="100%" style="margin-top: 5px">
							<tr>
								<td align="center">
									<?php if ($v->profesi === 'Perawat'): ?>
										<span>Perawat</span>
									<?php elseif ($v->profesi === 'Bidan'): ?>
										<span>Bidan</span>
									<?php elseif ($v->profesi === 'Dokter'): ?>
										<span>Dokter</span>
									<?php else: ?>
										<span>Nama Pemeriksa/PPA</span>
									<?php endif; ?>
								</td>
							</tr>
							<?php if ($v->tanda_tangan_harian): ?>
								<tr>
									<td align="center">
										<?php if (!empty($v->tanda_tangan_harian)): ?>
											<img src="<?= $v->tanda_tangan_harian ?>" style="height:60px; width:60px;">
										<?php endif; ?>
									</td>
								</tr>
							<?php endif; ?>
							<tr>
								<td align="center">
									<?= $v->perawat_harian ?>
								</td>
							</tr>
						</table>
					<?php endif; ?>

					<?php if (
						(($v->perawat_menyerahkan &&
							$v->perawat_menyerahkan !== "-") ||
							($v->perawat_menerima && $v->perawat_menerima !== "-")) &&
						(($v->profesi === 'Perawat' || $v->profesi === 'Bidan') && $v->pilihan !== "ADIME" && $v->pilihan !== "SBAR")
					): ?>
						<!--<table class="table-bordered" v-show="(item.perawat_menyerahkan && item.perawat_menyerahkan !== '-') && (item.perawat_menerima && item.perawat_menerima !== '-') && (item.profesi === 'Perawat' && item.pilihan !== 'ADIME')">-->
						<table width="100%" style="margin-top: 5px">
							<tr>
								<td colspan="2" align="center">Serah Terima Pasien</td>
							</tr>
							<tr>
								<td align="center">Menyerahkan</td>
								<td align="center">Menerima</td>
							</tr>
							<?php if (
								$v->tanda_tangan_menyerahkan ||
								$v->tanda_tangan_menerima
							): ?>
								<tr>
									<td align="center" style="vertical-align: middle">
										<?php if (!empty($v->tanda_tangan_menyerahkan)): ?>
											<img src="<?= $v->tanda_tangan_menyerahkan ?>" style="height:60px; width:60px;">
										<?php endif; ?>
									</td>
									<td align="center" style="vertical-align: middle">
										<?php if (!empty($v->tanda_tangan_menerima)): ?>
											<img src="<?= $v->tanda_tangan_menerima ?>" style="height:60px; width:60px;">
										<?php endif; ?>
									</td>
								</tr>
							<?php endif; ?>
							<tr>
								<td align="center">
									<?= $v->perawat_menyerahkan ?>
								</td>
								<td align="center">
									<?= $v->perawat_menerima ?>
								</td>
							</tr>
						</table>
					<?php endif; ?>

					<?php if (
						$v->apoteker &&
						$v->apoteker != "-" &&
						($v->profesi === "Apoteker" && $v->pilihan !== "ADIME" && $v->pilihan !== "SBAR")
					): ?>
						<!--<table class="table-bordered" v-show="(item.apoteker && item.apoteker != '-') && (item.profesi === 'Apoteker' && item.pilihan !== 'ADIME')">-->
						<table width="100%" style="margin-top: 5px">
							<tr>
								<td align="center">Apoteker</td>
							</tr>
							<?php if ($v->tanda_tangan_apoteker): ?>
								<tr>
									<td align="center">
										<?php if (!empty($v->tanda_tangan_apoteker)): ?>
											<img src="<?= $v->tanda_tangan_apoteker ?>" style="height:60px; width:60px;">
										<?php endif; ?>
									</td>
								</tr>
							<?php endif; ?>
							<tr>
								<td align="center">
									<?= $v->apoteker ?>
								</td>
							</tr>
						</table>
					<?php endif; ?>

					<?php if (
						$v->ahli_gizi &&
						$v->ahli_gizi != "-" &&
						$v->pilihan === "ADIME"
					): ?>
						<!--<table class="table-bordered" v-show="(item.ahli_gizi && item.ahli_gizi != '-') &&  (item.pilihan === 'ADIME')">-->
						<table width="100%" style="margin-top: 5px">
							<tr>
								<td align="center">Ahli Gizi</td>
							</tr>
							<?php if ($v->tanda_tangan_ahli_gizi): ?>
								<tr>
									<td align="center">
										<?php if (!empty($v->tanda_tangan_ahli_gizi)): ?>
											<img src="<?= $v->tanda_tangan_ahli_gizi ?>" style="height:60px; width:60px;">
										<?php endif; ?>
									</td>
								</tr>
							<?php endif; ?>
							<tr>
								<td align="center">
									<?= $v->ahli_gizi ?>
								</td>
							</tr>
						</table>
					<?php endif; ?>

					<?php if (
						(($v->sbar_pelapor &&
							$v->sbar_pelapor != "-") ||
							($v->sbar_penerima &&
								$v->sbar_penerima != "-")) &&
						$v->pilihan === "SBAR"
					): ?>
						<!--<table class="table-bordered" v-show="(item.ahli_gizi && item.ahli_gizi != '-') &&  (item.pilihan === 'ADIME')">-->
						<table width="100%" style="margin-top: 5px">
							<tr>
								<td colspan="2" align="center">Verifikasi TBAK</td>
							</tr>
							<tr>
								<td align="center" style="width:50%">Pelapor<br /><span style="font-size:15px"><?= $v->tanggal_indo_tanda_tangan_sbar_pelapor ?></span><br /><span style="font-size:15px"><?= $v->jam_tanda_tangan_sbar_pelapor ?> WIB</span></td>
								<td align="center" style="width:50%">Penerima<br /><span style="font-size:15px"><?= $v->tanggal_indo_tanda_tangan_sbar_penerima ?></span><br /><span style="font-size:15px"><?= $v->jam_tanda_tangan_sbar_penerima ?> WIB</span></td>
							</tr>
							<?php if (
								$v->tanda_tangan_sbar_pelapor ||
								$v->tanda_tangan_sbar_penerima
							): ?>
								<tr>
									<td align="center" style="vertical-align: middle">
										<?php if (!empty($v->tanda_tangan_sbar_pelapor)): ?>
											<img src="<?= $v->tanda_tangan_sbar_pelapor ?>" style="height:60px; width:60px;">
										<?php endif; ?>
									</td>
									<td align="center" style="vertical-align: middle">
										<?php if (!empty($v->tanda_tangan_sbar_penerima)): ?>
											<img src="<?= $v->tanda_tangan_sbar_penerima ?>" style="height:60px; width:60px;">
										<?php endif; ?>
									</td>
								</tr>
							<?php endif; ?>
							<tr>
								<td align="center">
									<?= $v->sbar_pelapor ?>
								</td>
								<td align="center">
									<?= $v->sbar_penerima ?>
								</td>
							</tr>
						</table>
					<?php endif; ?>
				</td>
				<td align="center">
					<?php if ($v->verifikasi_dpjp->status_verif === true): ?>
						<div>
							<?php if (!empty($v->verifikasi_dpjp->tanda_tangan)): ?>
								<img src="<?= $v->verifikasi_dpjp
												->tanda_tangan ?>" style="height:80px; width:80px;"> <br>
							<?php endif; ?>
							<?= $v->verifikasi_dpjp->nama_dpjp ?> <br>
							<?= $v->verifikasi_dpjp->tanggal_indo_verif ?> <br>
							<?= $v->verifikasi_dpjp->jam_verif ?>
						</div>
					<?php endif; ?>
				</td>
			</tr>
		<?php endforeach; ?>
	</table>
</body>