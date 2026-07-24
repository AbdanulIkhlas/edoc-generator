---
name: edoc-04-form-html
description: Generates the eDoc Vue 2 interactive form HTML document (index.html). Follows strict UI component design system guidelines, applies two-way v-model bindings matching json.js, and injects bridging JS functions, and modals. Use when building or updating the user interface form.
---

# Sub-Skill 04: Form HTML Generator

This sub-skill handles the creation of `output/index.html`. It constructs a fully interactive Bootstrap 4 and Vue 2 web form that connects UI input elements directly to the data state defined in `output/json.js`.

---

## Input and Reference Resources

This sub-skill requires access to:

1. **Document Image / PDF**: Located in `images/` (analyzed for visual structure, sections, labels, and form controls).
2. **Form Boilerplate Template**: `.agents/skills/edoc-generator/resources/templates/template_form.html`.
3. **UI Component Guidelines**: `.agents/skills/edoc-generator/resources/ui_components.md`.
4. **Generated Data Sample File**: `output/json.js` (for exact `v-model` binding paths).
5. **Generated Config File**: `output/config.json` (to know active bridging modules).
6. **Bridging Catalog Docs**: Relevant markdown files inside `.agents/skills/edoc-generator/resources/bridging_docs/`.
7. **User Prompt / Instructions**: Specific requests regarding partial bridging fields (e.g., "vital_sign cuman berat_badan dan tinggi_badan").
8. **Gold Standard Reference Examples (IMPORTANT)**: Read existing `index.html` files inside `.agents/skills/edoc-generator/examples/` to mirror real-world implementation, Vue lifecycle scripts, modal structures, and card layouts.

---

## Execution Protocol

### Step 1: Read UI Guidelines, Boilerplate & Reference Examples

1. Read `.agents/skills/edoc-generator/resources/ui_components.md` to load standard HTML snippets and layout rules.
2. Read `.agents/skills/edoc-generator/resources/templates/template_form.html` to use as the root container and JS framework baseline.
3. Read `.agents/skills/edoc-generator/examples/[document_name]/index.html` to mirror real-world implementation, Vue lifecycle scripts, modal structures, and card layouts.

### Step 2: Build HTML Form Sections & Layout

Analyze the document image and group form elements into section cards following `resources/ui_components.md`:

1. **Section Wrappers**: Wrap each major form section in a Bootstrap Card container:
   `<div class="card patient-card shadow-sm mt-4" id="card-[section-id]">`
2. **Grid & Rows**: Wrap form groups inside `<div class="row">` and use Bootstrap responsive grid classes (`col-md-12`, `col-md-6`, `col-md-3`).
3. **Inputs & Labels**: Use standard `<label>` tags with `<b>` bold styling attached to input elements with `v-model`.
4. **Checkboxes**: DONT using raw `<input type="checkbox">`. MUST use custom `input-group` wrapper with `true-value="Ya"` and `false-value=""`.
5. **Signature**: Use the custom Vue component `<ttd-section>` with `mode="QRCODE"`, `mode="IMAGE"` or `mode="CANVAS"`, then map the `@update-stroke` event. And if the signature is for healthcare workers using autocomplete, don’t forget to set up the configuration as follows, adjusting the name and signature and storing them in an object called `ttd_data` or something similar. An example configuration is shown in the code below.

```js
function configDokter1(data) {
  return {
    element: "#dokter_auto1",
    url: "/api/emr/autocomplete?source_name=dokter",
    // biar bisa ngetik dan search di modal
    dropdownParent: "#tandaTanganModal",
    allowClear: true,
    query_params: {
      status: "",
      spesialisasi: "",
      show_integrasi: true,
    },
    markup_template: function (repo) {
      return `<b>${repo.nama}</b>`;
    },
    selection_template: function (repo) {
      // tulis format string untuk label autocomplete
      var res = "";
      if (repo.id != "") {
        res = repo.nama || data.ttd_data.dokter1;
        data.ttd_data.dokter1 = res;
      }

      return res;
    },
  };
}

function configNakes1(data) {
  return {
    element: "#nakes_auto1",
    url: "/api/emr/autocomplete?source_name=dokter",
    // biar bisa ngetik dan search di modal
    dropdownParent: "#tandaTanganModal",
    allowClear: true,
    query_params: {
      status: "",
      spesialisasi: "",
      show_integrasi: true,
    },
    markup_template: function (repo) {
      return `<b>${repo.nama}</b>`;
    },
    selection_template: function (repo) {
      // tulis format string untuk label autocomplete
      var res = "";
      if (repo.id != "") {
        res = repo.nama || data.ttd_data.nakes1;
        data.ttd_data.nakes1 = res;
      }

      return res;
    },
  };
}
```

### Step 3: Inject Vue 2 App & Data Bindings

1. In the `<script>` section, initialize Vue 2 using `init_doc(doc_id, data, operation)`.
2. Ensure every `v-model` path on HTML inputs corresponds 1:1 with property paths in `output/json.js` (e.g., `v-model="pasien.nama"`, `v-model="jenis_tindakan"`).


### Step 4: Write Output File

Save the complete HTML document to:
`output/index.html`

---

## Code Injection & Structural Hook Guidelines

First, create an `index.html` file in the `./output` directory using this template in its entirety: `.agents\skills\edoc-generator\resources\templates\template_form.html` [template_form.html](file;file:///e%3A/A%20Main%20Storage/Project/FG/edoc-generator/.agents/skills/edoc-generator/resources/templates/template_form.html). Then, look for these comments in the file: `=== START CONTAINER CODE ===` and `=== END CONTAINER CODE ===`. These mark the boundaries of the code that you can update, edit, or add to; do not remove anything within these boundaries, as they are part of the template. Make your changes only within this section and do not modify any other parts of the template.

# Important Notes
1. There should be no header KOP in the HTML, and all sections or card-based sections
2. Never use page tabs
3. In short, don’t remove anything from the template; use everything that’s there first, and if there’s anything missing, only then should you add it – don’t remove anything.