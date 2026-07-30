Please generate a complete 5-file eDoc package using the `edoc-generator` [SKILL.md](file;file:///e%3A/A%20Main%20Storage/Project/edoc-typing/Automation-create-edoc/.agents/skills/edoc-generator/SKILL.md)  skill by executing Sub-Skill 01 through Sub-Skill 05 sequentially.


### 1. Source Reference Files
- Primary PDF Template: images/template.pdf [template.pdf](file;file:///e%3A/A%20Main%20Storage/Project/edoc-typing/Automation-create-edoc/images/template.pdf) 


### 2 
Just create the HTML—no need to do the bridging just yet—and make sure it’s neat and consistent with the JSON and the template.pdf.

---

### 3. Signature & Signer Specifications
- Total Signatures Required: 1 Signature 
- Signature Breakdown & Placement:
  1. Dokter:
     - Placement: Bottom Right of the document
     - Mode: `IMAGE`
     - Input Type / Auto-Complete: `DOKTER` (uses Select2 auto-complete dokter_auto)
     - JSON Stroke Key: `ttd_data.dokter_stroke`
     - JSON Name Key: `ttd_data.dokter`

---

### 4. Image Annotation / Sketch Overlay (Coretan Image)
- Requires Image Overlay/Drawing Component?: YES
- Base Overlay Image Path: images/target-gambar-coret.png
- Canvas / Placement Location: on STATUS LOKALIS section, left text area field
- use [gambar_coret.md](file;file:///e%3A/A%20Main%20Storage/Project/edoc-typing/Automation-create-edoc/.agents/skills/edoc-generator/resources/bridging_docs/gambar_coret.md) skills with width : 600px and height : 400px for html and for pdf adjusted

---

### 5. Other Information

1. For ‘Tindak Lanjut’, there is a checkbox with the options ‘MRS’ and ‘PULANG / KRS,’; this is a single-choice checkbox, and when ‘PULANG / KRS,’ is selected, a drop-down menu appears with the options ‘Ijin Dokter’ and ‘Menolak’.
2. For the “Rencana Asuhan Medis” section, there is a drop-down menu with the options “Menolak Rawat Inap ” or “Menolak Rujuk”. Please add another option that directly displays a text input field.
3. Please ensure you adhere to these UI standards, particularly regarding the checkboxes [ui_components.md](file;file:///e%3A/A%20Main%20Storage/Project/edoc-typing/Automation-create-edoc/.agents/skills/edoc-generator/resources/ui_components.md) 

Create it without errors and in line with your existing skills

Just go ahead and create everything, accept everything, without asking me any questions first—except for the results; let me review them first before accepting them.