<?php
$tindakan = buildTindakanList(
    $params->tindakan_freetext ?? '',
    $params->tindakan_list ?? []
);

function buildTindakanList($freetext, $list = [])
{
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
                $result[] = "$layanan | ICD 9 : -";
            }
        }
    }

    return $result;
}
?>

<html>
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

</html>