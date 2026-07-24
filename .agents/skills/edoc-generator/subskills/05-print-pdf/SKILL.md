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
2. The `.output/print.php` file has already been created, so just work on it directly, and make changes only to the section [print.php#L0-333](textBlock;file:///e%3A/A%20Main%20Storage/Project/FG/edoc-generator/output/print.php#L0-333) without any code being removed. use the existing classes.
3. **Generated Data Sample File**: `output/json.js` (to verify exact property key paths under `$params`).
4. **Gold Standard Reference Examples (IMPORTANT)**: Read existing `print.php` files inside `.agents/skills/edoc-generator/examples/` to view previously created PDF printouts that can be used as references, while ensuring that the design and layout remain similar to the original image or PDF

---

## Execution Protocol

### Step 1: Initialize PHP Environment & CLI Arguments

1. Read `.agents/skills/edoc-generator/examples/[document_name]/print.php` to view previously created PDF printouts that can be used as references, while ensuring that the design and layout remain similar to the original image or PDF

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

Edit the printable PHP file to:

```text
output/print.php
```

---

## Critical Rules
1. Exact Kop RS Matching: NEVER alter the Kop RS HTML table structure. Use the exact code provided in Step 2.
2. Strict HTML Table Layout: DONT using Bootstrap or external layout frameworks. Use HTML <table> elements and custom/inline CSS for page structure.
3. Property Path Consistency: Ensure property paths under $params-> correspond exactly to key paths generated in output/json.js.
4. For all variables called to display data, use handler chaining as follows  `<?php echo $params->ttd_data->dokter_stroke ?? "" ?>`.
5. Firstly, create a `print.php` file in the `./output` directory using this template in its entirety: `.agents\skills\edoc-generator\resources\templates\template_print.php`. Use this full code as the starting template for `print.php` without omitting anything, and use the existing styling; if none exists, create the styling from scratch. For the layout, use a table, and the entire display must match the PHP template exactly; there must be no differences, and it must be neat.
6. Ensure that all sections are wrapped; all content is enclosed within a row-structured master table (.main-outer-table) with `page-break-inside: auto`. Remove `page-break-inside: avoid` from the large container so that if the content exceeds the boundaries of Page 1, the table rows will break naturally and flow onto Page 2 without leaving the remainder of Page 1 blank.
7. In short, don’t remove anything from the template; use everything that’s there first, and if there’s anything missing, only then should you add it – don’t remove anything.