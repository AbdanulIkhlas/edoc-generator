---
name: bridging-nomor-surat
description: This document contains standard code snippet for integrating Nomor Surat Bridging. AI agents MUST paste these code snippets exactly as provided, without cutting or altering the existing logic.
---

# Bridging Module: Nomor Surat

This document contains standard (_code snippets_) for integrating Nomor Surat Bridging. AI agents MUST paste these code snippets exactly as provided, without cutting or altering the existing logic.

## 1. Config Block (Inject to `output/config.json` -> `external_link`)

Check whether the relevant key already exists in the `external_link` section of `config.json`.
If it **doesn't exist**, add the following block:
```json
"nomor_surat" : {
    "source_type": "ws",
    "source" : "[edoc]/api/ext_link/count_doc?doc_code=<doc_code>&reset_by=year",
    "data_usage" : ["copy"]
}
```

_Make sure to update `<doc_code>` to match this form's actual identifier._

## 2. Sample Data Block (Inject to output/json.js)

### A. Form Properties (Inject to sample & default)
If this object's property does not yet exist in `data.sample` and `data.default`, add it:

Check `./output/json.js`. Add the field that will store the generated number:

```json
"nomor_surat": ""
```

And in `sample.external_link`, add the expected response structure:

```json
"nomor_surat" : {
    "no_surat": "0002"
}
```

## 3. JS Functions & Vue Methods `(Inject to output/index.html -> <script>)`

### In `init_doc_add`

Inside `function init_doc_add(data)`, 
add this code at the comment `// === [BRIDGING_INIT_ADD_HOOK] ===`:

```js
bridgingNomorSurat(data);
```

### G. Global Functions (Inject to `index.html` <script>)

Add the following global bridging function below the `init_doc_edit(data)` function at this comment `// === [BRIDGING_FUNCTION_HOOK] ===`:
```js
function bridgingNomorSurat(data) {
  if (data.external_link && data.external_link.nomor_surat) {
    const nomor = data.external_link.nomor_surat.no_surat || "0000";
    data.nomor_surat = `${nomor}`;
  }
}
```


# IMPORTANT RULES FOR AGENT

1. Verbatim Code Injections: DO NOT reduce, refactor, or truncate any JavaScript/HTML code snippets above.
2. Context Checking: ALWAYS check whether objects already exist before injecting to prevent duplicate function errors.
3. Data Mapping Adaptation: Adjust JSON property mappings ONLY if user explicitly requests a different property container name.
