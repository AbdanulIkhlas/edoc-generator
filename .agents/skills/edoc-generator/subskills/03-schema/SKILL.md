---
name: edoc-03-schema
description: Generates the eDoc JSON Schema file (schema.json) for validating structure and property types of saved eDoc data. Reads json.js structure and ignores external_link. Use after json.js is created or updated.
---

# Sub-Skill 03: JSON Schema Generator

This sub-skill handles the creation of `output/schema.json`. It inspects the data model from `output/json.js` and generates a valid JSON Schema Draft-04 document representing the persistent form state.

---

## Input Resources

This sub-skill requires access to:
1. **Generated Sample Data**: `output/json.js` (specifically analyzing the footprint of the `sample` or `default` object).

---

## Execution Protocol

### Step 1: Parse Data Model Footprint
1. Read `output/json.js` and inspect the keys and nested objects under `data.sample` (or `data.default`).
2. **EXCLUDE `external_link`**: Do NOT include the `external_link` object or any bridging API response structures in the schema. Schema validation only applies to persistent form input data saved by the user.

### Step 2: Map JavaScript Data Types to JSON Schema Primitives
Recursively traverse the object tree and map data types to JSON Schema Draft-04 definitions:
- **String** (`""`, `"YATI PURBA"`, `"1985-10-24"`) ➔ `{"type": "string"}`
- **Number / Float / Integer** (`0`, `0.0`, `160.0`, `55`) ➔ `{"type": "number"}` or `{"type": "integer"}`
- **Boolean** (`true`, `false`) ➔ `{"type": "boolean"}`
- **Array** (`[]`, `[...]`) ➔ `{"type": "array", "items": {}}`
- **Object** (`{...}`) ➔ `{"type": "object", "properties": { ... }}`

### Step 3: Construct JSON Schema Draft-04 Tree
Wrap the extracted property schema tree in the standard JSON Schema Draft-04 boilerplate:

```json
{
    "$schema": "[http://json-schema.org/draft-04/schema#](http://json-schema.org/draft-04/schema#)",
    "type": "object",
    "properties": {
        // Schema properties mapping goes here
    }
}
```

### Step 4: Write Output File
Format and write the output as valid JSON to:
`output/schema.json`


## Reference Output Structure Example (output/schema.json)
```json
{
    "$schema": "[http://json-schema.org/draft-04/schema#](http://json-schema.org/draft-04/schema#)",
    "type": "object",
    "properties": {
        "pasien": {
            "type": "object",
            "properties": {
                "nama": { "type": "string" },
                "no_rm": { "type": "string" },
                "kelamin": { "type": "string" },
                "tanggal_lahir": { "type": "string" },
                "tanggal_lahir_indo": { "type": "string" }
            }
        },
        "dokter_pelaksana": { "type": "string" },
        "jenis_tindakan": { "type": "string" },
        "checkAll": { "type": "boolean" },
        "vital_sign": {
            "type": "object",
            "properties": {
                "tinggi_badan": { "type": "number" },
                "berat_badan": { "type": "number" }
            }
        },
        "ttd_data": {
            "type": "object",
            "properties": {
                "tanggal": { "type": "string" },
                "tanggal_indo": { "type": "string" },
                "jam": { "type": "string" },
                "dokter": { "type": "string" },
                "dokter_stroke": { "type": "string" },
                "penerima": { "type": "string" },
                "penerima_stroke": { "type": "string" }
            }
        }
    }
}
```

## Critical Rules
1. Exclude external_link: NEVER include `external_link` or bridging payload schemas inside `schema.json`.
2. Schema Draft Standard: MUST include `"$schema": "http://json-schema.org/draft-04/schema#"` as the root attribute.
3. Valid JSON Formatting: Output MUST be strictly valid JSON without comments, trailing commas, or quotes around integer/number types.
4. There's no need to use `required`