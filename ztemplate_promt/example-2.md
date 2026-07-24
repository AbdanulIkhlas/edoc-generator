Please generate a complete 5-file eDoc package using the `edoc-generator` [SKILL.md](file;file:///e%3A/A%20Main%20Storage/Project/edoc-typing/Automation-create-edoc/.agents/skills/edoc-generator/SKILL.md)  skill by executing Sub-Skill 01 through Sub-Skill 05 sequentially.


### 1. Source Reference Files
- Primary PDF Template: images/template.pdf [template.pdf](file;file:///e%3A/A%20Main%20Storage/Project/edoc-typing/Automation-create-edoc/images/template.pdf) 


### 2 Rules
1. Just create the HTML—no need to do the bridging just yet—and make sure it’s neat and consistent with the JSON and the template.pdf.
2. Create it without errors and in line with your existing skills
3. Just go ahead and create everything, accept everything, without asking me any questions first—except for the results; let me review them first before accepting them.
4. Please ensure you adhere to these UI standards, particularly regarding the checkboxes [ui_components.md](file;file:///e%3A/A%20Main%20Storage/Project/edoc-typing/Automation-create-edoc/.agents/skills/edoc-generator/resources/ui_components.md) 

---

### 3. Signature & Signer Specifications
- Total Signatures Required: 3 Signature 
- Signature Breakdown & Placement:
  1. Saksi Keluarga:
     - Placement: Left in section signature
     - Mode: `CANVAS`
     - Input Type / Auto-Complete: `TEXT` (Free text input)
     - JSON Stroke Key: `ttd_data.saksi_stroke`
     - JSON Name Key: `ttd_data.saksi`
  2. Petugas Admisi
     - Placement: Center in section signature
     - Mode: `IMAGE`
     - Input Type / Auto-Complete: `NAKES` (uses Nakes Select2 auto-complete)
     - JSON Stroke Key: `ttd_data.petugas_stroke`
     - JSON Name Key: `ttd_data.petugas`
  3. Yang Menyatakan
     - Placement: Right in section signature
     - Mode: `IMAGE`
     - Input Type / Auto-Complete: `TEXT` (Free text input)
     - JSON Stroke Key: `ttd_data.menyatakan_stroke`
     - JSON Name Key: `ttd_data.menyatakan`


### 5. Other Information (in Indonesian)

1. text pada Dengan ini bertindak atas nama diri sendiri/suami/istri/anak/ibu/ayah/saudara *) dari : pada section  Diisi Oleh Pasien / Keluarga di awal , itu adalah dropdown dengan option Diri Sendiri, Suami, Istri, Anak, Ibu, Ayah, Saudara
2. pada bagian no `3. PRIVASI`, text Saya mengijinkan / tidak mengijinkan *), itu adalah dropdown juga
3. masih pada bagian no `3. PRIVASI`, pada bagian gambar pertama ini , itu adalah list data yang bisa di tambah tambah gitu
4. pada bagian no `4. KEROHANIAN`, text Saya Menginginkan / Tidak menginginkan *) adalah dropdown
5. pada bagian no `7. INFORMASI BIAYA`, pada gambar kedua ini , itu adalah checklist atau checkbox yang aktif ketika di checklist di html nya, dan di pdf nya ke checklist jika di checklist.


