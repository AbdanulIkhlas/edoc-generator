---
name: bridging-dokter-dpjp
description: This document contains standard code snippet for integrating Dokter DPJP Bridging. AI agents MUST paste these code snippets exactly as provided, without cutting or altering the existing logic.
---

# Bridging Module: Dokter DPJP

This document contains standard (_code snippets_) for integrating Dokter DPJP Bridging. AI agents MUST paste these code snippets exactly as provided, without cutting or altering the existing logic.

## 1. Config Block (Inject to `output/config.json` -> `external_link`)

Check whether the relevant key already exists in the `external_link` section of `config.json`.
If it **doesn't exist**, add the following block:
```json
"dokter_dpjp_data": {
    "source_type": "ws",
    "source": "[simrs]/e_doc_api/visitation/doctor_dpjp/<reg_number>",
    "data_usage": [
        "copy"
    ]
}
```

## 2. Sample Data Block (Inject to output/json.js)

### A. Form Properties (Inject to sample & default)
If this object's property does not yet exist in `data.sample` and `data.default`, add it:

Check `./output/json.js`. If this is a new bridging and the target JSON object does not exist in the `sample`, add the following structure (adjust fields based on needs):

```json
"ttd_data": {
  "dokter":"",
  "dokter_stroke":"",
}
```

If the JSON object already exists, there is no need to add it. (Inform the agent whether the JSON object is already present).

### B. External Link Dummy Payload (Inject to sample.external_link)

Check `sample.external_link` to see if the key already exists. If it doesn\'t exist, add the following block in its entirety without any modifications:
```json
"dokter_dpjp_data": {
    "no_register": "1910250010",
    "id_pasien": "00002248",
    "id_pendaftaran": 225,
    "id_layanan_pendaftaran": 276,
    "id_dokter_dpjp": 634,
    "nama_dokter_dpjp": "dr. Priyo Budi Santosa, Sp.A M.Kes",
    "id_spesialis": 1,
    "nama_spesialis": "Anak",
    "id_profesi": 2,
    "nama_profesi": "Dokter Spesialis",
    "nip": "",
    "no_sip": "",
    "no_str": "",
    "no_sik": "",
    "ttd_image" : "000002_682b2a74c336d.png"
}
```

## 3. JS Functions & Vue Methods `(Inject to output/index.html -> <script>)`

### A. Autocomplete Config Function

Add this at the comment `// === [CONFIG_AUTOCOMPLETE_HOOK] ===` alongside other autocomplete configs:
```js
function configDokter1(data) {
  return {
    element: "#dokter_auto1",
    url: "/api/emr/autocomplete?source_name=dokter",
    query_params: {
      status: "",
      spesialisasi: "",
    },
    markup_template: function (repo) {
      return `<b>${repo.nama}</b>`;
    },
    selection_template: function (repo) {
      // Write string format for autocomplete label
      if (repo.id != "") {
        // Map to the correct JSON path for the signature name
        data.ttd_data.dokter_stroke = repo.nama || data.ttd_data.dokter_stroke;
      }

      return data.ttd_data.dokter_stroke || "";
    },
  };
}
```

### In Vue `methods` `init`

Find the `init` method within the Vue instance `methods`. Add the initialization call for the autocomplete on this comment
 `// === [AUTOCOMPLETE_HOOK] ===`:

```js
// Setup auto complete
autocomplete(configDokter1(data));
```

### In `init_doc_add`

At the end of `function init_doc_add(data)`, add on this comment 
`// === [BRIDGING_INIT_ADD_HOOK] ===` and `// === [BRIDGING_INIT_EDIT_HOOK] ===`:

```js
bridgingDokterDPJP(data);
```

### G. Bridging Functions (Inject to `index.html` <script>)

Add the following global bridging function below the `init_doc_edit(data)` function.
add on this comment `// === [BRIDGING_FUNCTION_HOOK] ===`
```js
function bridgingDokterDPJP(data) {
    const dpjp = data.external_link?.dokter_dpjp_data?.nama_dokter_dpjp || "";
    data.ttd_data.dokter = dpjp;
    setSelect2($("#dokter_auto1"), dpjp, dpjp);

    // Jika TTD dokter menggunakan Image
    // const ttd_image = data.external_link?.dokter_dpjp_data?.ttd_image;
    // data.ttd_data.dokter_stroke = ttd_image ? getUrlHandler() + ttd_image : "";

    // Jika TTD dokter menggunakan QR Code
    setTimeout(() => {
        data.ttd_data.dokter_stroke = generatorQr(dpjp);
    }, 1000);
}
```

(Adjust the object mapping properties based on what is actually needed for the document.)

## 4. HTML Elements & Modals `(Inject to output/index.html -> <form id="formadd">)`

### A. Form Section Component (New Bridging Section)

If this is a new form section, use the following full HTML block:

Inside the `<form id="formadd">` tag, place the following autocomplete select element in the appropriate section:

```html
<select
  id="dokter_ttd_auto1"
  class="form-control"
  style="width: 300px;"
></select>
```

if use ttd-section, using this
```html
 <ttd-section
    mode="QRCODE"
    label="Dokter"
    select_id="dokter_auto1"
    name_input_type="DOKTER"
    v-model="ttd_data.dokter"
    path_name="ttd_data.dokter"
    :stroke="ttd_data.dokter_stroke"
    path_stroke="ttd_data.dokter_stroke"
    @update-stroke="ttd_data.dokter_stroke = $event"
    @open-ttd-modal="openTTDModalHandler"
/>
```


# IMPORTANT RULES FOR AGENT

1. Verbatim Code Injections: DO NOT reduce, refactor, or truncate any JavaScript/HTML code snippets above.
2. Context Checking: ALWAYS check whether objects already exist before injecting to prevent duplicate function errors.
3. Data Mapping Adaptation: Adjust JSON property mappings ONLY if user explicitly requests a different property container name.
