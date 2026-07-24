---
name: ui-components-standarization
description: This guideline contains the standard UI design and component rules that MUST be followed when creating the index.html file. Every form element must remain consistent and neatly structured according to the standards below.
---

# Standard UI Component Guidelines (Bootstrap 4 & Vue 2)

This guideline contains the standard UI design and component rules that **MUST** be followed when creating the `index.html` file. Every form element must remain consistent and neatly structured according to the standards below.

---

## 1. Section Container (Card Wrapper)

Each main section of the eDoc form (for example: "Patient Data", "Vital Signs", "Consent", etc.) **MUST** be wrapped using the following Bootstrap Card component:

```html
<!-- Start Card [Section Name] -->
<div class="card patient-card shadow-sm mt-5" id="card-[section-id]">
    <div class="card-header bg-light">
        <h5 class="mb-0 text-dark">[Section Title]</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <!-- Place input/form elements here -->
            </div>
        </div>
    </div>
</div>
<!-- End Card [Section Name] -->
```

---

## 2. Layouting Rules

- Every group of inputs **MUST** be wrapped inside a `<div class="row">`.
- Use the Bootstrap 4 responsive grid system (`col-md-12`, `col-md-6`, `col-md-4`, `col-md-3`, etc.) to keep the form layout aligned, balanced, and responsive.

---

## 3. Checkbox Styling Rules

### A. Single Choice Checkbox (Yes / No or Single Selection)

Regular unstyled checkboxes are **NOT ALLOWED**. They **MUST** be wrapped using an Input Group with bordered labels as shown below:

```html
<div class="row">
    <div class="col-md-3">
        <div class="input-group" style="display: flex; flex-wrap: nowrap; align-items: stretch;">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <input id="[field_id]_Yes" type="checkbox" v-model="[model_name]"
                        true-value="Yes" false-value="" />
                </div>
            </div>
            <label for="[field_id]_Yes" class="form-check-label"
                style="flex-grow: 1; padding: .375rem .75rem; border: 1px solid #ced4da; display: flex; align-items: center; border-top-right-radius: 4px; border-bottom-right-radius: 4px;">
                Yes
            </label>
        </div>

        <div class="input-group" style="display: flex; flex-wrap: nowrap; align-items: stretch;">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <input id="[field_id]_No" type="checkbox" v-model="[model_name]"
                        true-value="No" false-value="" />
                </div>
            </div>
            <label for="[field_id]_No" class="form-check-label"
                style="flex-grow: 1; padding: .375rem .75rem; border: 1px solid #ced4da; display: flex; align-items: center; border-top-right-radius: 4px; border-bottom-right-radius: 4px;">
                No
            </label>
        </div>
    </div>
</div>
```

---

### B. Checkbox + Text Input ("Other")

Use the following pattern whenever a checkbox option includes an additional text input (for example, the "Other" option):

```html
<div class="input-group" style="display: flex; flex-wrap: nowrap; align-items: stretch; margin-bottom: .5rem;">
    <div class="input-group-prepend">
        <div class="input-group-text">
            <input id="[field_id]_Other" type="checkbox" v-model="[model_name]"
                true-value="Other" false-value="" />
        </div>
    </div>

    <label for="[field_id]_Other" class="form-check-label"
        style="padding: .375rem .75rem; border: 1px solid #ced4da; display: flex; align-items: center;">
        Other
    </label>

    <input type="text"
        class="form-control"
        v-model="[model_value_other]"
        title="[field_id]_Other_value"
        :disabled="[model_name] !== 'Other'" />
</div>
```

---

## 4. Input Controls & Labels

### A. Standard Input with Label

Standard format for text, date, or similar input fields:

```html
<div class="form-group">
    <label for="[field_id]" class="form-check-label">
        <b>[Label Name]</b>
    </label>

    <input
        id="[field_id]"
        type="text"
        class="form-control"
        v-model="[model_name]" />
</div>
```

---

### B. Input Group with Unit (Prepend / Append)

Standard format for numeric inputs with measurement units (such as Kg, Cm, mmHg, %, etc.):

```html
<div class="form-group">
    <label for="[field_id]" class="form-check-label">
        <b>[Label Name]</b>
    </label>

    <div class="input-group">
        <input
            id="[field_id]"
            type="number"
            class="form-control"
            v-model.number="[model_name]" />

        <div class="input-group-prepend">
            <span class="input-group-text">[Unit, e.g. Kg]</span>
        </div>
    </div>
</div>
```

---

## 5. General Layout Guidelines

- **Layout Consistency:** Ensure vertical spacing (`margin-bottom`, `mt-4`, etc.) and column arrangements remain visually balanced and organized throughout the form.
- **Flexibility:** If additional custom components are required that are not covered in this guideline, the AI may design them as needed, provided they continue to use **Bootstrap 4** and remain aesthetically consistent with the Card and Input Group standards defined above.