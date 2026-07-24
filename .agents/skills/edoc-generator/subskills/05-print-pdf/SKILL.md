---
name: edoc-05-print-pdf
description: Generates the eDoc PHP print/PDF rendering template file (print.php). Replicates document layout strictly using HTML tables and custom CSS/inline styling optimized for DOMPDF engine, bound to the $params PHP object from saved eDoc JSON data. Use when building or updating the PDF print template.
---

# Sub-Skill 05: Print PDF Generator

This sub-skill handles the creation of `output/print.php`. It constructs a PHP file that outputs clean, print-ready HTML/CSS compatible with server-side PDF generation tools (DOMPDF/mpdf), mapping data from the `$params` input object.

---

## Input Resources

This sub-skill requires access to:

1. **Document Image / PDF**: Located in `images/` (analyzed for visual page structure, margins, table layout, borders, font styles, and signature layout).
2. **Print Boilerplate Template**: `.agents/skills/edoc-generator/resources/templates/template_print.php`.
3. **Generated Data Sample File**: `output/json.js` (to verify exact property key paths under `$params`).
4. **Gold Standard Reference Examples (IMPORTANT)**: Read existing `print.php` files inside `.agents/skills/edoc-generator/examples/` to view previously created PDF printouts that can be used as references, while ensuring that the design and layout remain similar to the original image or PDF

---

## Execution Protocol

### Step 1: Initialize PHP Environment & CLI Arguments

1. Load base template from `.agents/skills/edoc-generator/resources/templates/template_print.php`.
2. Extract incoming CLI arguments in PHP:
3. Read `.agents/skills/edoc-generator/examples/[document_name]/print.php` to view previously created PDF printouts that can be used as references, while ensuring that the design and layout remain similar to the original image or PDF

```php
<?php
// EMR Data
$params = json_decode($argv[1]);

$base_url = $argv[2]; // Base_url

$title = "[DOCUMENT TITLE HERE]";

$static_label = json_decode($argv[3]);
?>
```

---

### Step 2: Build HTML/CSS Printable Structure

Replicate the document design using pure HTML tables and print-friendly CSS.

#### Layouting Rules

- ALL layouting MUST use HTML `<table>` elements (`width="100%"`, `border-collapse: collapse;`).
- DONT using CSS frameworks like Bootstrap.
- Styling must rely on pre-defined CSS utility classes or custom inline CSS (`style="..."`).

#### Standard font & body styling

```css
body {
    font-family: sans-serif;
    font-size: 13pt;
    line-height: 1.3;
}

table {
    width: 100%;
    border-collapse: collapse;
}

td {
    height: 20px;
    vertical-align: top;
}
```

#### Mandatory Standard Hospital Header (Kop RS)

MUST use exact HTML structure below for Kop RS:

```html
<table style="width: 100%;">
    <tr style="padding-bottom: 5px; padding-top: 5px;">
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
                        if (strtoupper($params->pasien->kelamin) == 'L') {
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
```

#### Table Data & Checkmark Output

Display checkboxes as text symbols ("V"):

```php
<?php echo ($params->jenis_informasi->diagnosa->tanda == "Ya" ? "V" : ""); ?>
```

Preserve line breaks for textareas using `nl2br()`:

```php
<?php echo nl2br($params->diagnosa_freetext); ?>
```

#### Signatures (TTD Block)

Render image strokes for signatures:

```html
<img src="<?php echo $params->ttd_data->dokter_stroke; ?>" style="height: 100px; width: auto; display: block; margin: 10px auto;">
```

Render signer name below the stroke image.

For dates, the system accepts date data in this format: "yyyy-mm-dd", for example "2026-08-01". Use this function to convert it into an Indonesian date format, such as "1 Agustus 2026". Just save the function at the top of the file

```php
<?php
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
```
by calling it in this way
```php
<?= tgl_indo($params->pasien->tanggal_lahir) ?>
```


---

### Step 3: Write Output File

Save the printable PHP file to:

```text
output/print.php
```

---

## Output Template Structure Example (`output/print.php`)

```php
<?php
// EMR Data
$params = json_decode($argv[1]);

$base_url = $argv[2]; // Base_url

$title = "FORM PERSETUJUAN TINDAKAN KEDOKTERAN GIGI";

$static_label = json_decode($argv[3]);

?>

<!DOCTYPE html>
<html>

<head>
    <title><?php echo $title ?></title>
</head>

<style>
    body {
        font-family: sans-serif;
        font-size: 13pt;
        line-height: 1.3;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    td {
        height: 20px;
        vertical-align: top;
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

    .boldd {
        font-weight: bold;
    }

    .pagee {
        margin: auto;
        width: initial;
        min-height: initial;
        box-shadow: initial;
        background: initial;
    }

    .tdlonggar {
        padding-top: 5px;
        padding-bottom: 5px;
    }

    .ttd-image {
        margin-top: 5px;
        margin-bottom: 5px;
        width: 100%;
        height: 100px;
    }
</style>

<body>
    <div class="pagee">

        <!-- Kop RS Header -->
        <table style="width: 100%;">
            <tr style="padding-bottom: 5px; padding-top: 5px;">
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
                                if (strtoupper($params->pasien->kelamin) == 'L') {
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

        <!-- Title Banner -->
        <table width="100%" style="border:none">
            <tr style="border:none">
                <td style="border:none" class="centerr borderr tdlonggar">
                    <b><?php echo $title; ?></b>
                </td>
            </tr>
        </table>

        <br />

        <!-- Dynamic Content Table -->
        <table class="tbl-full">
            <tr class="borderr tdlonggar">
                <td width="30%" class="borderr">JENIS TINDAKAN</td>
                <td class="borderr"><?php echo $params->jenis_tindakan ?? ''; ?></td>
            </tr>
            <tr class="borderr tdlonggar">
                <td class="borderr">Dokter Pelaksana</td>
                <td class="borderr"><?php echo $params->dokter_pelaksana ?? ''; ?></td>
            </tr>
        </table>

        <br />

        <!-- Signatures Table -->
        <table class="tbl-full">
            <tr>
                <td width="50%" class="centerr borderr">
                    Pemberi Informasi
                    <div class="ttd-image">
                        <img src="<?php echo $params->ttd_data->dokter_stroke; ?>" style="height: 100px; width: auto; display: block; margin: 10px auto;">
                    </div>
                    <?php echo $params->ttd_data->dokter; ?>
                </td>
                <td width="50%" class="centerr borderr">
                    Penerima Informasi
                    <div class="ttd-image"> 
                        <img src="<?php echo $params->ttd_data->penerima_stroke; ?>" style="height: 100px; width: auto; display: block; margin: 10px auto;">
                    </div>
                    <?php echo $params->ttd_data->penerima; ?>
                </td>
            </tr>
        </table>

    </div>
</body>

</html>
```

## Critical Rules

1. Exact Kop RS Matching: NEVER alter the Kop RS HTML table structure. Use the exact code provided in Step 2.
2. Strict HTML Table Layout: DONT using Bootstrap or external layout frameworks. Use HTML <table> elements and custom/inline CSS for page structure.
3. Property Path Consistency: Ensure property paths under $params-> correspond exactly to key paths generated in output/json.js.
4. For all variables called to display data, use handler chaining as follows  `<?php echo $params->ttd_data->dokter_stroke ?? "" ?>`