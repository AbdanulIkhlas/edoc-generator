<?php
// Helper untuk membersihkan format tanggal jika kosong, NaN, undefined, dsb.
function clean_date($date)
{
    if (empty($date)) {
        return '';
    }
    $str = trim((string)$date);
    if ($str === '' || $str === '0000-00-00' || $str === '0000-00-00 00:00:00' || strtolower($str) === 'null' || strtolower($str) === 'undefined') {
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
    Tanggal Kedatangan : <?= clean_date($params->tanggal_datang_indo ?? ($params->tanggal_datang ?? '')) ?>
</td>

</html>