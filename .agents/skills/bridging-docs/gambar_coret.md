---
name: inject-image-sketch
description: This document provides the standard code snippets for integrating the Image Sketch component. AI agents MUST paste these code snippets exactly as provided, without modifying, truncating, or refactoring any existing logic.
---

# Inject Image Sketch

This sub-skill is responsible for updating `output/index.html`. It integrates a fully interactive Bootstrap 4 + Vue 2 image sketch component that is directly bound to the data state defined in `output/json.js`.

---

# Input and Reference Resources

This skill requires access to the following:

1. Analyze the target image based on the provided prompt, determine the appropriate HTML width and height, and ensure the same dimensions are applied to the PDF output.
2. The reference image can be found at `images/target-gambar-coret.png`.
3. Use the Image Sketch component and place its invocation at the position specified by the user's prompt.

---

# Execution Protocol

## Step 1: Inject into `output/json.js`

Add the following empty default structure to both the sample data and default data version. Do **NOT** include comments.

```json
"image_canvas": {
    "canvas1": {
        "stroke": "",
        "image_base64": "",
        "is_changed": false
    },
    "canvas2": {
        "stroke": "",
        "image_base64": "",
        "is_changed": false
    }
},
```

---

## Step 2: Inject the following code into `<script type="text/javascript" charset="utf-8">`

Insert the code below inside the `// === COMPONENT_HOOKS ===` section.

```js
Vue.component('image_canvas', {
        props: {
            id: String,
            width: String,
            height: String,
            background_image: String,
            image_base64: String,
            stroke: String,
        },
        mounted() {
            this.addCanvasListeners(this.id, this.$refs[this.id]);
            this.loadBackgroundImage();
            this.loadBase64Image(this.stroke);
        },
        data() {
            return {
                drawings: {
                    brushSize: 2,
                    brushColor: '#000000',
                    isDrawing: false,
                    isErasing: false,
                    lastX: 0,
                    lastY: 0,
                },
            };
        },
        methods: {
            addCanvasListeners(name, canvas) {
                if (!canvas) {
                    console.warn(`[addCanvasListeners] canvas ${name} undefined`);
                    return;
                }
                canvas.addEventListener('mousedown', (e) => this.startDraw(e, name));
                canvas.addEventListener('mousemove', (e) => this.moveDraw(e, name));
                canvas.addEventListener('mouseup', () => this.stopDraw(name));
                canvas.addEventListener('mouseout', () => this.stopDraw(name));
                canvas.addEventListener('touchstart', (e) => this.startDraw(e, name));
                canvas.addEventListener('touchmove', (e) => this.moveDraw(e, name));
                canvas.addEventListener('touchend', () => this.stopDraw(name));
            },
            getCoordinates(event, canvas) {
                const rect = canvas.getBoundingClientRect();
                if (event.touches) {
                    return { x: event.touches[0].clientX - rect.left, y: event.touches[0].clientY - rect.top };
                }
                return { x: event.offsetX, y: event.offsetY };
            },
            startDraw(event, name) {
                event.preventDefault();
                const canvas = this.$refs[name];
                const drawing = this.drawings;
                drawing.isDrawing = true;
                const { x, y } = this.getCoordinates(event, canvas);
                drawing.lastX = x;
                drawing.lastY = y;
            },
            moveDraw(event, name) {
                const canvas = this.$refs[name];
                const drawing = this.drawings;
                if (!drawing.isDrawing) return;
                event.preventDefault();
                const ctx = canvas.getContext('2d');
                ctx.lineWidth = drawing.brushSize;
                ctx.strokeStyle = drawing.isErasing ? 'rgba(255, 255, 255, 1)' : drawing.brushColor;
                ctx.globalCompositeOperation = drawing.isErasing ? 'destination-out' : 'source-over';
                ctx.lineJoin = 'round';
                ctx.lineCap = 'round';

                const { x, y } = this.getCoordinates(event, canvas);
                ctx.beginPath();
                ctx.moveTo(drawing.lastX, drawing.lastY);
                ctx.lineTo(x, y);
                ctx.stroke();
                drawing.lastX = x;
                drawing.lastY = y;
            },
            stopDraw(name) {
                if (this.drawings.isDrawing) {
                    this.drawings.isDrawing = false;
                    this.saveAsImage(name);
                }
            },
            startDrawing(name) {
                this.drawings.isErasing = false;
            },
            startErasing(name) {
                this.drawings.isErasing = true;
            },
            clearCanvas(name) {
                Swal.fire({
                    title: 'Apa kamu yakin?',
                    text: 'Anda tidak akan dapat mengembalikan ini!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!',
                }).then((result) => {
                    if (result.isConfirmed || result.value) {
                        const canvas = this.$refs[name];
                        const ctx = canvas.getContext('2d');
                        ctx.clearRect(0, 0, canvas.width, canvas.height);
                        Swal.fire({
                            icon: 'success',
                            title: 'Coretan Anda telah dihapus',
                            showConfirmButton: false,
                            timer: 1000,
                        });
                        this.$emit('update-change', true);
                        this.$emit('update-stroke', '');
                        this.$emit('update-base64', '');
                    }
                });
            },
            isCanvasBlank(canvas) {
                if (!canvas) return true;
                const ctx = canvas.getContext('2d');
                const pixelBuffer = new Uint32Array(
                    ctx.getImageData(0, 0, canvas.width, canvas.height).data.buffer
                );
                return !pixelBuffer.some(color => color !== 0);
            },
            saveAsImage(name) {
                const drawingCanvas = this.$refs[name];
                if (!drawingCanvas) return;

                if (this.isCanvasBlank(drawingCanvas)) {
                    this.$emit('update-change', true);
                    this.$emit('update-stroke', '');
                    this.$emit('update-base64', '');
                    return;
                }

                this.$emit('update-change', true);
                const scaleFactor = 0.8;

                const resizedCanvas = document.createElement('canvas');
                resizedCanvas.width = Math.round(drawingCanvas.width * scaleFactor);
                resizedCanvas.height = Math.round(drawingCanvas.height * scaleFactor);

                const resizedCtx = resizedCanvas.getContext('2d');
                resizedCtx.drawImage(drawingCanvas, 0, 0, resizedCanvas.width, resizedCanvas.height);

                // Simpan gambar stroke aja tanpa background (PNG terkompresi skala)
                const strokeBase64 = resizedCanvas.toDataURL('image/png');
                this.$emit('update-stroke', strokeBase64);

                if (this.background_image) {
                    const bgCanvas = document.createElement('canvas');
                    bgCanvas.width = resizedCanvas.width;
                    bgCanvas.height = resizedCanvas.height;
                    const bgCtx = bgCanvas.getContext('2d');

                    const bgImage = new Image();
                    bgImage.crossOrigin = 'Anonymous';
                    bgImage.src = this.background_image;
                    bgImage.onload = () => {
                        bgCtx.drawImage(bgImage, 0, 0, bgCanvas.width, bgCanvas.height);
                        bgCtx.drawImage(drawingCanvas, 0, 0, bgCanvas.width, bgCanvas.height);
                        const resizedBase64 = bgCanvas.toDataURL('image/jpeg', 0.6);
                        this.$emit('update-base64', resizedBase64);
                    };
                } else {
                    const resizedBase64 = resizedCanvas.toDataURL('image/jpeg', 0.6);
                    this.$emit('update-base64', resizedBase64);
                }
            },
            loadBase64Image(base64 = null) {
                if (!base64) return;
                const drawingCanvas = this.$refs[this.id];
                const drawingCtx = drawingCanvas.getContext('2d');

                const drawingImage = new Image();
                drawingImage.src = base64;

                drawingImage.onload = () => {
                    drawingCtx.clearRect(0, 0, drawingCanvas.width, drawingCanvas.height);
                    drawingCtx.drawImage(drawingImage, 0, 0, drawingCanvas.width, drawingCanvas.height);
                };
            },
            loadBackgroundImage() {
                if (this.background_image) {
                    const canvas = this.$refs[this.id];
                    canvas.style.backgroundImage = `url('${this.background_image}')`;
                    canvas.style.backgroundSize = '100% 100%';
                    canvas.style.backgroundRepeat = 'no-repeat';
                    canvas.style.backgroundPosition = 'center';
                }
            }
        },
        template: `
                <div>
                    <div class="row">
                        <div class="col-md-12 p-0 d-flex justify-content-center">
                            <div :style="'width: '+width+'px;'" class="d-flex justify-content-between">
                                <div>
                                    <div style="display: inline; margin-right: 10px">
                                        <input
                                            type="color"
                                            style="width: 30px"
                                            v-model="drawings.brushColor"
                                        />
                                    </div>
                                    <div style="display: inline; margin-right: 10px; margin-top: 5px">
                                        <input
                                            type="range"
                                            min="1"
                                            max="20"
                                            v-model="drawings.brushSize"
                                        />
                                        <span>{{ drawings.brushSize }}</span>
                                    </div>
                                </div>
                                <div style="display: inline">
                                    <button
                                        type="button"
                                        @click="startDrawing(id)"
                                        class="btn btn-outline-info btn-sm"
                                        data-bs-toggle="tooltip"
                                        data-bs-placement="left"
                                        title="Drawing"
                                    >
                                        <i class="fa fa-paint-brush"></i>
                                    </button>
                                    <button
                                        type="button"
                                        title="Erasing"
                                        @click="startErasing(id)"
                                        class="btn btn-outline-secondary btn-sm"
                                        data-bs-toggle="tooltip"
                                        data-bs-placement="left"
                                    >
                                        <i class="fa fa-eraser"></i>
                                    </button>
                                    <button
                                        type="button"
                                        title="Clear All"
                                        @click="clearCanvas(id)"
                                        class="btn btn-outline-danger btn-sm"
                                        data-bs-toggle="tooltip"
                                        data-bs-placement="left"
                                    >
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 d-flex justify-content-center">
                            <canvas
                                :ref="id"
                                :id="id"
                                :width="width"
                                :height="height"
                                style="border: 1px solid black; margin-right: 3px"
                            ></canvas>
                        </div>
                    </div>
                </div>
            `
    });

```

---

## Step 3: Inject the component invocation into `output/index.html`

Insert the component at the exact location specified by the user's prompt.

Adjust the following based on the document:

- Canvas ID
- JSON binding
- Background image filename
- Width and height

```html
<image_canvas
    id="canvas1"
    width="490"
    height="350"
    :image_base64="image_canvas.canvas1.image_base64"
    :stroke="image_canvas.canvas1.stroke"
    @update-stroke="image_canvas.canvas1.stroke = $event"
    @update-base64="image_canvas.canvas1.image_base64 = $event"
    @update-change="image_canvas.canvas1.is_changed = $event"
    :background_image="`http://${window.location.host}/images/lokaliss.png`">
</image_canvas>
```

---

## Step 4: Inject into `output/print.php`

Add the helper function near the top of the file.

```php
<?php
if (!function_exists('render_image_canvas')) {
    function render_image_canvas($bg_url, $stroke_base64, $width = 390, $height = 250) {
        ob_start();
        ?>
        <div style="width: <?= $width ?>px; height: <?= $height ?>px; margin: 0 auto; font-size: 0; line-height: 0;
                    background-image: url('<?= $bg_url ?>');
                    background-size: <?= $width ?>px <?= $height ?>px;
                    background-repeat: no-repeat;
                    background-position: center;">
            <?php if (!empty($stroke_base64)): ?>
                <img src="<?= $stroke_base64 ?>" style="width: <?= $width ?>px; height: <?= $height ?>px; display: block; margin: 0; padding: 0;">
            <?php endif; ?>
        </div>
        <?php
        return ob_get_clean();
    }
}
?>
```

Invoke the helper at the appropriate location in the PDF layout.

Ensure that:

- The background image matches the HTML component.
- Width and height are identical to those used in `output/index.html`.
- The stroke data is mapped correctly.

```php
<?= render_image_canvas(
    $base_url . '/images/lokaliss.png',
    $params->image_canvas->canvas1->stroke ?? '',
    390,
    278
) ?>
```

---

# IMPORTANT RULES FOR THE AI AGENT

1. **Paste the code snippets exactly as provided.** Never refactor, simplify, truncate, or modify any part of the JavaScript, HTML, or PHP code.
2. **Prevent duplicate injections.** Before injecting, always verify whether the component, helper function, or JSON object already exists.
3. **Only adapt the data mapping when explicitly requested.** The default container name is `image_canvas`; do not rename or restructure it unless the user specifically asks for a different mapping.
4. **Determine the correct placement intelligently.** Analyze the user's prompt and the document layout to identify where the Image Sketch component should appear in both the HTML form and the PDF template.
5. **Keep HTML and PDF dimensions synchronized.** The canvas width and height used in `output/index.html` must exactly match those used by `render_image_canvas()` in `output/print.php`.
6. **Adapt resource names only when necessary.** Background image filenames, canvas IDs, and JSON bindings should match the actual document context while preserving the same component behavior.