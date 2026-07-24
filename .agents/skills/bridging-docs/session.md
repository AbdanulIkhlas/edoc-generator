---
name: bridging-session
description: This document contains standard code snippet for integrating Session Bridging. AI agents MUST paste these code snippets exactly as provided, without cutting or altering the existing logic.
---

# Bridging Module: Session

This document contains standard (_code snippets_) for integrating Session Bridging. AI agents MUST paste these code snippets exactly as provided, without cutting or altering the existing logic.

## 1. Config Block (Inject to `output/config.json` -> `external_link`)

Check whether the relevant key already exists in the `external_link` section of `config.json`.
If it **doesn't exist**, add the following block:
```json
"session": true
```

## 2. Sample Data Block (Inject to output/json.js)

### A. Form Properties (Inject to sample & default)
If this object's property does not yet exist in `data.sample` and `data.default`, add it:

Check `./output/json.js`. If this is a new bridging, you usually define target keys directly inside `sample` and receive the `user_session_data` object.

```json
"user_session_data": {
    "user_id": 6,
    "fullname": "Farmagitechs",
    "username": "fgadmin",
    "group_name": "Admins"
}
```

## 3. JS Functions & Vue Methods `(Inject to output/index.html -> <script>)`

### In `init_doc_add`

Inside `function init_doc_add(data)`, add this code at the comment `// === [BRIDGING_INIT_ADD_HOOK] ===`:

```js
bridgingUserSession(data);
```

### G. Global Functions (Inject to `index.html` <script>)

Add the following global bridging function below the `init_doc_edit(data)` function at this comment `// === [BRIDGING_FUNCTION_HOOK] ===`:
```js
function bridgingUserSession(data) {
  if (data.user_session_data) {
    // You can use this function to map session data to document fields on initial add
    // e.g. data.nama_pemeriksa = data.user_session_data.fullname;
    console.log("Session User Data: ", data.user_session_data);
  }
}
```


# IMPORTANT RULES FOR AGENT

1. Verbatim Code Injections: DO NOT reduce, refactor, or truncate any JavaScript/HTML code snippets above.
2. Context Checking: ALWAYS check whether objects already exist before injecting to prevent duplicate function errors.
3. Data Mapping Adaptation: Adjust JSON property mappings ONLY if user explicitly requests a different property container name.
