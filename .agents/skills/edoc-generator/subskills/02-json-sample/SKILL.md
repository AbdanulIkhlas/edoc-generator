---
name: edoc-02-json-sample
description: Generates the eDoc sample data JavaScript file (json.js). Combines analyzed document form inputs with bridging dummy data to produce sample and default objects with strict partial field pruning rules. Use when building or updating the data model for eDoc Vue 2 bindings and print renderer.
---

# Sub-Skill 02: Data Sample Generator

This sub-skill handles the creation of `output/json.js`. It constructs the master JavaScript object containing populated dummy data (`sample`) and clean/empty initial structures (`default`).

---

## Input Resources

This sub-skill requires access to:
1. **Document Image / PDF**: Located in `images/` (analyzed for all form fields, checkboxes, textareas, signatures, and static labels).
2. **Generated Config File**: `output/config.json` (to know which bridging keys are active).
3. **Bridging Directory Index**: `.agents/skills/edoc-generator/resources/bridging_docs/index.json`.
4. **Bridging Documentation Catalog**: Individual markdown files inside `.agents/skills/edoc-generator/resources/bridging_docs/`.
5. **User Prompt / Instructions**: Specific requests regarding partial bridging fields (e.g., "vital_sign cuman berat_badan dan tinggi_badan").

---

## Execution Protocol

### Step 1: Form Field Extraction & Analysis
1. Analyze the reference document image/PDF to extract all user-input fields:
   - Patient info (e.g., `nama`, `no_rm`, `kelamin`, `tanggal_lahir`, `tanggal_lahir_indo`).
   - Form-specific inputs (e.g., `jenis_tindakan`, `dokter_pelaksana`, `diagnosa_freetext`, `diagnosa_group`).
   - Dynamic objects/sections (e.g., `jenis_informasi` with nested `isi_informasi`, `tanda`, `tanda_2`).
   - Signatures and metadata (e.g., `ttd_data` containing `tanggal`, `jam`, `dokter`, `dokter_stroke`, `penerima`, `penerima_stroke`).
2. Standardize property names using `snake_case` naming conventions.

### Step 2: Read & Filter Bridging Data Snippets
1. Read `output/config.json` to identify active bridging keys under `external_link`.
2. Map each key via `resources/bridging_docs/index.json` to open the corresponding markdown file (e.g., `resources/bridging_docs/vital_sign.md`).
3. Extract:
   - **Sample Data Block**: Internal object mapping for `sample.[module]` (e.g., `vital_sign`).
   - **External Link Dummy Block**: API payload dummy data for `sample.external_link.[module]` (e.g., `vital_sign_data_list`).

### Step 3: Apply Partial Field Pruning Rules (CRITICAL)
If the user specifies partial bridging fields (e.g., "vital_sign only berat_badan and tinggi_badan"):
1. **Keep `external_link` Dummy Payload Intact**: The API response payload under `sample.external_link` remains standard/full.
2. **Prune `sample.[module]` and `default.[module]`**:
   - Keep ONLY the requested fields (e.g., `berat_badan`, `tinggi_badan`).
   - OMIT all unrequested properties (e.g., `tensi_sistole`, `tensi_diastole`, `gcs_e`, `gcs_v`, `gcs_m`, `suhu`, `nadi`, `nafas`, `spo2`).

### Step 4: Construct Master JS Structure (`const data`)
Assemble the JavaScript object with two root keys:

1. **`sample` Object**:
   - Populate form properties with realistic Indonesian healthcare dummy data.
   - Attach the `external_link` object containing dummy bridging responses.
2. **`default` Object**:
   - Replicate the exact hierarchy of `sample` EXCEPT `external_link`.
   - Reset string fields to `""`.
   - Reset numbers to `0` or `0.0`.
   - Reset booleans to `false`.
   - Reset arrays to `[]`.
   - DO NOT include `external_link` inside `default`.

### Step 5: Write Output File
Format and write the output as valid JavaScript code to:
`output/json.js`

---

## Output Format Specification

The generated `output/json.js` MUST strictly follow this JavaScript syntax:

```javascript
const data = {
    "sample": {
        "pasien": {
            "nama": "YATI PURBA NN",
            "no_rm": "00116356",
            "kelamin": "P",
            "tanggal_lahir": "1985-10-24",
            "tanggal_lahir_indo": "24 Oktober 1985"
        },
        "dokter_pelaksana": "dr. Efraim Petrick",
        "jenis_tindakan": "Pembersihan Karang Gigi",
        "checkAll": false,
        "vital_sign": {
            "tinggi_badan": 160.0,
            "berat_badan": 55.0
        },
        "ttd_data": {
            "tanggal": "2026-07-15",
            "tanggal_indo": "15 Juli 2026",
            "jam": "10:09",
            "dokter": "dr. Efraim Petrick",
            "dokter_stroke": "[http://192.168.0.201:1201/000002_682b2a74c336d.png](http://192.168.0.201:1201/000002_682b2a74c336d.png)",
            "penerima": "YATI PURBA NN",
            "penerima_stroke": "[http://192.168.0.201:1201/patient/00116356.png](http://192.168.0.201:1201/patient/00116356.png)"
        },
        "external_link": {
            "px_data": {
                "no_rm": "00116356",
                "nama": "YATI PURBA NN",
                "kelamin": "P",
                "tanggal_lahir": "1985-10-24"
            },
            "vital_sign_data_list": [
                {
                    "no_register": "2202230010",
                    "id_pasien": "00206957",
                    "tinggi_badan": "160",
                    "berat_badan": "55",
                    "layanan": [
                        {
                            "dokter": "dr. Efraim Petrick",
                            "waktu_visitasi": "2026-07-15 10:00:00"
                        }
                    ]
                }
            ]
        }
    },
    "default": {
        "pasien": {
            "nama": "",
            "no_rm": "",
            "kelamin": "",
            "tanggal_lahir": "",
            "tanggal_lahir_indo": ""
        },
        "dokter_pelaksana": "",
        "jenis_tindakan": "",
        "checkAll": false,
        "vital_sign": {
            "tinggi_badan": 0.0,
            "berat_badan": 0.0
        },
        "ttd_data": {
            "tanggal": "",
            "tanggal_indo": "",
            "jam": "",
            "dokter": "",
            "dokter_stroke": "",
            "penerima": "",
            "penerima_stroke": ""
        }
    }
};
```

## Critical Rules
1. Valid JS Declaration: The file MUST start with `const data = {` and end with `};.`
2. Default Cleanliness: `default` MUST match the schema of `sample` (excluding `external_link`). NEVER put `external_link` inside `default`.
3. Strict Field Pruning: If user asks for partial fields (e.g. "vital_sign only BB and TB"), remove all unrequested fields from `sample.vital_sign` and `default.vital_sign`.
4. Data Type Preservation: Date strings must follow `YYYY-MM-DD`, human-readable dates must follow `DD Month YYYY` in `Indonesian` (e.g., "24 Oktober 1985"), and numeric must be `numbers/floats`.