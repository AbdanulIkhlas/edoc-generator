<div style="padding-bottom: 15px;">
        <table style="width: 100%;">
            <tr>
                <td width="15%" style="vertical-align: middle; text-align: center;">
                    <img style="width: 75px;" src="<?= $base_url; ?>/images/rs/LogoRS.png">
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
                    <div style="border: 1px solid black; padding: 6px 10px; font-size: 10.5pt;">
                        <table style="width: 100%;">
                            <tr>
                                <td style="width: 36%;">No RM</td>
                                <td style="width: 2%;">:</td>
                                <td><?= $params->pasien->no_rm ?? ''; ?></td>
                            </tr>
                            <tr>
                                <td>Nama Pasien</td>
                                <td>:</td>
                                <td><?= $params->pasien->nama ?? ''; ?><?= !empty($params->pasien->kelamin) ? ' (' . (strtoupper($params->pasien->kelamin)[0] ?? '') . ')' : ''; ?></td>
                            </tr>
                            <tr>
                                <td>Tanggal Lahir</td>
                                <td>:</td>
                                <td><?= !empty($params->pasien->tanggal_lahir) ? tgl_indo($params->pasien->tanggal_lahir) : ($params->pasien->tanggal_lahir_indo ?? ''); ?></td>
                            </tr>
                            <tr>
                                <td>NIK</td>
                                <td>:</td>
                                <td><?= $params->pasien->nik ?? $params->external_link->px_data->no_identitas ?? ''; ?></td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
        </table>
    </div>