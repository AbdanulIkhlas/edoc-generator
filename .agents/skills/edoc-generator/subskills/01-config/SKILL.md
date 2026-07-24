---
name: edoc-01-config
description: Generates the eDoc configuration JSON file (`config.json`) containing SIMRS bridging API specifications. Maps requested bridging modules to their corresponding web service endpoints based on the bridging documentation. Use this skill when creating or updating the `external_link` configuration in eDoc.
---

# Sub-Skill 01: Config Generator

This sub-skill generates the `output/config.json` file by mapping user-requested SIMRS bridging modules into standardized web service (`ws`) endpoint definitions extracted from the bridging documentation.

---

# Input Resources

This sub-skill requires access to:
1. **User Request / Prompt**: The list of requested bridging modules (e.g., `px_data`, `dokter_dpjp_data`, `vital_sign_data_list`).
2. **Bridging Directory Index**: `.agents/skills/edoc-generator/resources/bridging_docs/index.json`.
3. **Bridging Module Docs**: Individual markdown files inside `.agents/skills/edoc-generator/resources/bridging_docs/`.

---

# Execution Protocol

## Step 1 — Resolve Bridging Keys

1. Identify every requested bridging key from the user prompt or document analysis.
2. Read:

   ```
   resources/bridging_docs/index.json
   ```

3. Resolve each bridging key to its corresponding documentation file.
4. If a bridging key cannot be found in `index.json`:
   - Output a warning.
   - Search all files inside:

     ```
     resources/bridging_docs/
     ```

   - Use the closest matching documentation if found.

---

## Step 2 — Extract Config Snippets

For every resolved bridging module:

1. Open its Markdown documentation.
   Example:

   ```
   resources/bridging_docs/vital_sign.md
   ```

2. Locate the **Config Block** section.

   Common section names include:

   - `## 1. Config Block`
   - `external_link`
   - JSON configuration snippet

3. Copy the JSON object for that module **verbatim**.

Do **not** modify:

- endpoint paths
- data_usage
- source_type
- placeholders

---

## Step 3 — Construct the Output Object

Wrap every extracted configuration inside:

```json
{
    "external_link": {
        // extracted bridging configuration
    }
}
```

Validate that the final JSON:

- has proper commas
- uses quoted keys
- contains no trailing commas
- is syntactically valid

---

## Step 4 — Write Output File

Save the generated JSON to:

```
output/config.json
```

---

# Structural Specification

Each module inside `external_link` **must** follow this schema:

```json
"[module_key]": {
    "source_type": "ws",
    "source": "[simrs]/path/to/endpoint/<placeholder>",
    "data_usage": [
        "copy"
    ]
}
```

---

# Reference Output Example

```json
{
    "external_link": {
        "px_data": {
            "source_type": "ws",
            "source": "[simrs]/e_doc_api/patient/get/<patient_id>/full",
            "data_usage": [
                "copy"
            ]
        },
        "dokter_dpjp_data": {
            "source_type": "ws",
            "source": "[simrs]/e_doc_api/visitation/doctor_dpjp/<reg_number>",
            "data_usage": [
                "copy"
            ]
        },
        "vital_sign_data_list": {
            "source_type": "ws",
            "source": "[simrs]/e_doc_api/visitation/patient_vital_sign_list/<reg_number>",
            "data_usage": [
                "copy"
            ]
        }
    }
}
```

---

# Critical Rules

## 1. Exact Endpoint Paths

Never alter, reconstruct, or invent endpoint URLs.

Always use the exact `source` value from the corresponding bridging documentation.

---

## 2. Do Not Filter Endpoints

Even if the user requests only specific fields, for example:

- Vital Sign → BB only
- Vital Sign → BB + TB

the generated `config.json` **must still use the full endpoint**.

Field filtering is handled later during the data binding process (Sub-Skill 02 and Sub-Skill 04), **not** in the configuration layer.

---

## 3. Strict JSON Formatting

The generated output **must** be valid JSON.

Requirements:

- No comments
- No trailing commas
- All keys must be quoted
- Proper nesting
- Proper closing braces and brackets

---

## Final Output

The only generated artifact for this sub-skill is:

```
output/config.json
```

The file must contain a single valid JSON object with the following top-level structure:

```json
{
    "external_link": {
        ...
    }
}
```