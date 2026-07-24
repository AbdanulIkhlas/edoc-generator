---
name: edoc-generator
description: Master orchestrator skill for automatically creating SIMRS Electronic Documents (eDoc) from document image/PDF references. Coordinates sub-skills to generate config.json, json.js, schema.json, index.html (Vue 2), and print.php using standardized bridging documentation and UI guidelines. Use when the user requests end-to-end eDoc creation from a document design or layout image.
---

# eDoc Generator - Master Orchestrator

This skill coordinates the automated end-to-end pipeline for converting hospital document images or PDFs into functional SIMRS Electronic Documents (eDoc). It orchestrates 5 modular sub-skills sequentially to produce all required eDoc output files.

---

## Workspace & Resource Mapping

Before initiating any task, ensure access to the following workspace resources:

```text
.agents/skills/edoc-generator/
├── SKILL.md                          # Master Orchestrator (This File)
├── resources/
│   ├── ui_components.md              # UI Design System & Component Rules
│   ├── examples/                     # Document references
│   │   ├── [document_name]/           # Folder name same as document name for reference
│   │   │   ├── config.json 
│   │   │   ├── json.js
│   │   │   ├── schema.json
│   │   │   ├── index.html
│   │   │   └── print.php
│   ├── templates/
│   │   ├── template_form.html        # Vue 2 Form Boilerplate
│   │   └── template_print.php       # PHP Print/PDF Boilerplate
│   └── bridging_docs/
│       ├── index.json                # Bridging Module Directory Map
│       └── [module_name].md          # Standard Snippets per Bridging Module
├── subskills/
│   ├── 01-config/SKILL.md            # Config Generator Sub-Skill
│   ├── 02-json-sample/SKILL.md        # Data Sample Generator Sub-Skill
│   ├── 03-schema/SKILL.md            # JSON Schema Generator Sub-Skill
│   ├── 04-form-html/SKILL.md         # Form HTML Generator Sub-Skill
│   └── 05-print-pdf/SKILL.md         # Print PHP Generator Sub-Skill
└── output/
    ├── config.json                     # Generated config.json
    ├── json.js                         # Generated json.js
    ├── schema.json                     # Generated schema.json
    ├── index.html                      # Generated index.html
    └── print.php                       # Generated print.php
```

## Execution Pipeline (Sequential Flow)
When an eDoc creation request is triggered:

0. User Input: Image/PDF + Bridging Specs
1. Call 01-config sub-skill to generates output/config.json
2. Call 02-json-sample sub-skill generates output/json.js
3. Call 03-schema sub-skill to generates output/schema.json
4. Call 04-form-html sub-skill to generates output/index.html
5. Call 05-print-pdf sub-skill to generates output/print.php


## Step-by-Step Execution Protocol

### Step 0: Input Parsing & Resource Inspection
1. Analyze Document Input: Read the provided image or PDF reference located in images/. Identify form sections, inputs, text areas, signatures, and static labels.
2. Identify Bridging Requirements: Parse user instructions regarding requested SIMRS endpoints (e.g., px_data, dokter_dpjp_data, vital_sign).
3. Check Partial Bridging Scope: Determine if the user requested Full Bridging or Selective Field Bridging (e.g., vital_sign containing only berat_badan and tinggi_badan).
4. Load Catalog Index: Read resources/bridging_docs/index.json to resolve paths for requested bridging documentation.

### Step 1: Execute 01-config Sub-Skill
- Goal: Produce output/config.json.
- Action: Invoke .agents/skills/edoc-generator/subskills/01-config/SKILL.md.
- Instruction: Map requested bridging modules to their corresponding API source paths defined in resources/bridging_docs/.
- Validation: Ensure output/config.json contains a valid external_link object with valid JSON syntax.

### Step 2: Execute 02-json-sample Sub-Skill
- Goal: Produce output/json.js.
- Action: Invoke .agents/skills/edoc-generator/subskills/02-json-sample/SKILL.md.
- Instruction:
    - Analyze form inputs from the image and combine them with output/config.json.
    - Generate the sample object (dummy values + bridging data) and default object (empty initial state).
    - Apply Selective Field Pruning Rules: Include ONLY requested fields when partial bridging is specified.
- Validation: Ensure output/json.js is structured as const data = { sample: { ... }, default: { ... } };.

### Step 3: Execute 03-schema Sub-Skill
- Goal: Produce output/schema.json.
- Action: Invoke .agents/skills/edoc-generator/subskills/03-schema/SKILL.md.
- Instruction: Generate JSON Schema Draft-04 definitions reflecting the property hierarchy in output/json.js.
- Validation: Ensure all properties match data types (string, number, boolean, object, array).

### Step 4: Execute 04-form-html Sub-Skill
- Goal: Produce output/index.html.
- Action: Invoke .agents/skills/edoc-generator/subskills/04-form-html/SKILL.md.
- Instruction:
    - Read UI layout directives from resources/ui_components.md.
    - Use resources/templates/template_form.html as the base boilerplate.
    - Wrap sections using ```<div class="card patient-card"> ```.
    - Use standard custom input-group checkboxes and input-label formatting.
    - Inject Vue 2 two-way bindings (v-model) and bridging script snippets.
- Validation: Verify Vue bindings align exactly with key paths in json.js.

### Step 5: Execute 05-print-pdf Sub-Skill
- Goal: Produce output/print.php.
- Action: Invoke .agents/skills/edoc-generator/subskills/05-print-pdf/SKILL.md.
- Instruction:
    - Use resources/templates/template_print.php as the base boilerplate.
    - Replicate the visual layout of the document in HTML/CSS optimized for PDF printing, keeping it as close as possible to the original PDF or image layout
    - Map dynamic PHP outputs using $params->[key_path].
    - Render static hospital headers ($static_label) and signature images (stroke Base64/URL).
- Validation: Ensure all variables safely handle empty states with empty() checks or ternary defaults.


## Critical Rules & Constraints
1. Zero Snippet Mutation: Snippets extracted from resources/bridging_docs/*.md (e.g., modal IDs, method names) MUST be injected verbatim into index.html unless explicit field pruning is required.
2. Selective Field Pruning: When a user requests specific fields from a bridging module (e.g., "vital_sign only BB and TB"), prune all unrequested properties from sample, default, JS binding scripts, and UI modals.
3. Strict UI Compliance: All form UI generation in Step 4 MUST adhere to component structures defined in resources/ui_components.md.
4. Output Isolation: All generated files MUST be saved inside the output/ directory unless instructed otherwise.