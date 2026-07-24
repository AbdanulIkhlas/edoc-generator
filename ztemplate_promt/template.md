Please generate a complete 5-file eDoc package using the `edoc-generator` skill by executing Sub-Skill 01 through Sub-Skill 05 sequentially.


### 1. Source Reference Files
- Primary PDF Template: images/template.pdf
- Page Images (if PDF is split): 
  - Page 1: `images/page1.png`
  - Page 2: `images/page2.png`
  - Additional Pages: `[e.g., images/page3.png or N/A]`

---

### 2. SIMRS Bridging Specifications
(example)
1. px_data: Full bridging
2. dokter_dpjp_data: Full bridging
3. vital_sign: Partial bridging (ONLY: `berat_badan` and `tinggi_badan`)
4. diagnosa_list: Partial bridging (ONLY: `Diagnosa Sekunder`)
5. Additional Bridging: `[e.g., action_patient, prescription, or N/A]`

---

### 3. Signature & Signer Specifications
- Total Signatures Required: `[e.g., 3 Signatures]`
- Signature Breakdown & Placement:
  1. Doctor / DPJP Signature:
     - Placement: Bottom Left / Right of the document
     - Mode: `IMAGE`
     - Input Type / Auto-Complete: `DOKTER` (uses Select2 auto-complete)
     - JSON Stroke Key: `ttd_data.dokter_stroke`
     - JSON Name Key: `ttd_data.dokter`
  2. Patient / Family Signature:
     - Placement: Bottom Center
     - Mode: `CANVAS` (or `IMAGE` via `patient/<no_rm>.png`)
     - Input Type / Auto-Complete: `TEXT` (Free text input)
     - JSON Stroke Key: `ttd_data.penerima_stroke`
     - JSON Name Key: `ttd_data.penerima`
  3. Healthcare Worker / Witness Signature:
     - Placement: Bottom Right
     - Mode: `IMAGE`
     - Input Type / Auto-Complete: `NAKES` (uses Nakes Select2 auto-complete)
     - JSON Stroke Key: `ttd_data.saksi1_stroke`
     - JSON Name Key: `ttd_data.saksi1`

---

### 4. Image Annotation / Sketch Overlay (Coretan Image)
- Requires Image Overlay/Drawing Component?: `[YES / NO]`
- Base Overlay Image Path: `[e.g., images/body_diagram.png or N/A]`
- Canvas / Placement Location: `[e.g., Card Section: "Pemeriksaan Fisik - Diagram Anatomi"]`
- JSON Target Keys for Coretan:
  - Base64 Stroke Key: `[e.g., coretan_image_stroke]`
  - Canvas Reference Name: `[e.g., canvas_anatomy]`

---

### 5. Other Information
1. ...
2. ...