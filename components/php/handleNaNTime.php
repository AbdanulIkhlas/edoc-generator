<?php
// Helper untuk membersihkan format waktu / jam jika NaN:NaN, undefined, dsb.
function clean_time($time)
{
    if (empty($time)) {
        return '';
    }
    $str = trim((string)$time);
    if ($str === '' || strtolower($str) === 'null' || strtolower($str) === 'undefined') {
        return '';
    }
    if (stripos($str, 'NaN') !== false || stripos($str, 'undefined') !== false || stripos($str, 'null') !== false) {
        return '';
    }
    return $str;
}
?>

<html>
<!-- contoh -->
<td width="50%">
    Waktu Pemeriksaan: <?= clean_time($params->waktu_pemeriksaan ?? '') ?>
</td>

</html>