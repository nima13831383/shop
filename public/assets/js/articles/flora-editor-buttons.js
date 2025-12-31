// /// <reference types="jquery" />
// jQuery(document).ready(function ($) {
//     var editorDiv = $("#froala-editor");

//     var editor = new FroalaEditor("#froala-editor", {
//         // آپلود تصویر
//         imageUploadURL: editorDiv.data("upload-url"),
//         imageUploadParams: { _token: editorDiv.data("csrf") },
//         imageUploadMethod: "POST",
//         imageAllowedTypes: ["jpeg", "jpg", "png", "gif"],
//         imageMaxSize: 5 * 1024 * 1024,

//         // آپلود ویدیو
//         videoUploadURL: editorDiv.data("upload-video-url"),
//         videoUploadParams: { _token: editorDiv.data("csrf") },
//         videoUploadMethod: "POST",
//         videoAllowedTypes: ["mp4", "webm", "ogg"],
//         videoMaxSize: 50 * 1024 * 1024, // مثلا 50MB
//     });

//     // وقتی فرم submit شد، مقدار HTML داخل textarea بریز
//     $("#postform").on("submit", function () {
//         $("#body").val(editor.html.get());
//     });
// });

/// <reference types="jquery" />
// jQuery(function ($) {
//     var $editorDiv = $("#froala-editor");

//     var uploadImageUrl = $editorDiv.data("upload-url");
//     var uploadVideoUrl = $editorDiv.data("upload-video-url");
//     var csrfToken = $editorDiv.data("csrf");
//     FroalaEditor.POPUP_TEMPLATES["videoPopup"] = "[_CUSTOM_LAYER_]";

//     /* ===============================
//        آیکون دکمه
//     =============================== */
//     FroalaEditor.DefineIcon("videoShortcode", {
//         NAME: "play",
//         template: "font_awesome_5",
//     });

//     /* ===============================
//        دکمه شورت‌کد ویدیو
//     =============================== */
//     FroalaEditor.RegisterCommand("videoShortcode", {
//         title: "Insert Video Shortcode",
//         icon: "videoShortcode",
//         focus: true,
//         undo: true,
//         refreshAfterCallback: true,
//         callback: function () {
//             let videoUrl = prompt("Video URL (mp4):");
//             if (!videoUrl) return;

//             let coverUrl = prompt("Cover Image URL (optional):");

//             let shortcode = coverUrl
//                 ? `[video cover="${coverUrl}"]${videoUrl}[/video]`
//                 : `[video]${videoUrl}[/video]`;

//             this.html.insert(shortcode + "<br>");
//         },
//     });

//     /* ===============================
//        INIT Froala (فقط یک بار)
//     =============================== */
//     var editor = new FroalaEditor("#froala-editor", {
//         toolbarButtons: [
//             "fullscreen",
//             "bold",
//             "italic",
//             "underline",
//             "strikeThrough",
//             "subscript",
//             "superscript",
//             "|",
//             "fontFamily",
//             "fontSize",
//             "color",
//             "inlineStyle",
//             "paragraphStyle",
//             "|",
//             "paragraphFormat",
//             "align",
//             "formatOL",
//             "formatUL",
//             "outdent",
//             "indent",
//             "|",
//             "insertLink",
//             "insertImage",
//             "insertVideo",
//             "videoShortcode", // ✅ دکمه شورت‌کد
//             "insertTable",
//             "|",
//             "undo",
//             "redo",
//             "html",
//         ],

//         // image upload
//         imageUploadURL: uploadImageUrl,
//         imageUploadParams: { _token: csrfToken },
//         imageUploadMethod: "POST",
//         imageAllowedTypes: ["jpeg", "jpg", "png", "gif"],
//         imageMaxSize: 5 * 1024 * 1024,

//         // video upload
//         videoUploadURL: uploadVideoUrl,
//         videoUploadParams: { _token: csrfToken },
//         videoUploadMethod: "POST",
//         videoAllowedTypes: ["mp4", "webm", "ogg"],
//         videoMaxSize: 50 * 1024 * 1024,
//     });

//     /* ===============================
//        Submit فرم
//     =============================== */
//     $("#postform").on("submit", function () {
//         $("#body").val(editor.html.get());
//     });
// });

jQuery(function ($) {
    var $editorDiv = $("#froala-editor");

    var uploadImageUrl = $editorDiv.data("upload-url");
    var uploadVideoUrl = $editorDiv.data("upload-video-url");
    var csrfToken = $editorDiv.data("csrf");

    // ===============================
    // Popups Templates
    // ===============================
    FroalaEditor.POPUP_TEMPLATES["videoPopup"] = "[_BUTTONS_][_CUSTOM_LAYER_]";
    FroalaEditor.POPUP_TEMPLATES["quotePopup"] = "[_BUTTONS_][_CUSTOM_LAYER_]";

    // ===============================
    // Icons
    // ===============================
    FroalaEditor.DefineIcon("videoShortcode", {
        NAME: "play",
        template: "font_awesome_5",
    });
    FroalaEditor.DefineIcon("quoteShortcode", {
        NAME: "quote-right",
        template: "font_awesome_5",
    });

    // ===============================
    // Video Plugin
    // ===============================
    FroalaEditor.PLUGINS.videoPlugin = function (editor) {
        function initPopup() {
            var template = {
                buttons: "",
                custom_layer: `
                    <div class="fr-input-line mb-2">
                        <input id="video-url" type="text" placeholder="Video URL (mp4)" class="fr-input w-100">
                    </div>
                    <div class="fr-input-line mb-2">
                        <input id="cover-url" type="text" placeholder="Cover URL (optional)" class="fr-input w-100">
                    </div>
                    <div class="fr-action-buttons text-right">
                        <button type="button" class="fr-command fr-insert btn btn-primary btn-sm">Insert</button>
                        <button type="button" class="fr-command fr-cancel btn btn-secondary btn-sm">Cancel</button>
                    </div>
                `,
            };

            var $popup = editor.popups.create("videoPopup", template);

            $popup.find(".fr-insert").on("click", function () {
                var videoUrl = $("#video-url").val();
                var coverUrl = $("#cover-url").val();
                if (!videoUrl) return;

                var shortcode = coverUrl
                    ? `[video cover="${coverUrl}"]${videoUrl}[/video]`
                    : `[video]${videoUrl}[/video]`;

                editor.html.insert(shortcode + "<br>");
                editor.popups.hide("videoPopup");
            });

            $popup.find(".fr-cancel").on("click", function () {
                editor.popups.hide("videoPopup");
            });

            return $popup;
        }

        function showPopup() {
            var $popup = editor.popups.get("videoPopup");
            if (!$popup) $popup = initPopup();

            editor.popups.setContainer("videoPopup", editor.$tb);

            var $btn = editor.$tb.find(
                '.fr-command[data-cmd="videoShortcode"]'
            );
            var left = $btn.offset().left + $btn.outerWidth() / 2;
            var top = $btn.offset().top + $btn.outerHeight();

            editor.popups.show("videoPopup", left, top, $btn.outerHeight());
        }

        return {
            showPopup: showPopup,
            hidePopup: function () {
                editor.popups.hide("videoPopup");
            },
        };
    };

    // ===============================
    // Quote Plugin
    // ===============================
    FroalaEditor.PLUGINS.quotePlugin = function (editor) {
        function initPopup() {
            var template = {
                buttons: "",
                custom_layer: `
                    <div class="fr-input-line mb-2">
                        <input id="quote-author" type="text" placeholder="Author" class="fr-input w-100">
                    </div>
                    <div class="fr-input-line mb-2">
                        <input id="quote-avatar" type="text" placeholder="Avatar URL (optional)" class="fr-input w-100">
                    </div>
                    <div class="fr-input-line mb-2">
                        <input id="quote-via" type="text" placeholder="via (optional)" class="fr-input w-100">
                    </div>
                    <div class="fr-input-line mb-2">
                        <textarea id="quote-text" placeholder="Quote text" class="fr-input w-100" rows="5"></textarea>
                    </div>
                    <div class="fr-action-buttons text-right">
                        <button type="button" class="fr-command fr-insert btn btn-primary btn-sm">Insert</button>
                        <button type="button" class="fr-command fr-cancel btn btn-secondary btn-sm">Cancel</button>
                    </div>
                `,
            };

            var $popup = editor.popups.create("quotePopup", template);

            $popup.find(".fr-insert").on("click", function () {
                var author = $("#quote-author").val();
                var avatar = $("#quote-avatar").val();
                var via = $("#quote-via").val();
                var text = $("#quote-text").val();

                if (!text) return;

                var shortcode = `[quote author="${author}" via="${via}" avatar="${avatar}"]${text}[/quote]`;

                editor.html.insert(shortcode + "<br>");
                editor.popups.hide("quotePopup");
            });

            $popup.find(".fr-cancel").on("click", function () {
                editor.popups.hide("quotePopup");
            });

            return $popup;
        }

        function showPopup() {
            var $popup = editor.popups.get("quotePopup");
            if (!$popup) $popup = initPopup();

            editor.popups.setContainer("quotePopup", editor.$tb);

            var $btn = editor.$tb.find(
                '.fr-command[data-cmd="quoteShortcode"]'
            );
            var left = $btn.offset().left + $btn.outerWidth() / 2;
            var top = $btn.offset().top + $btn.outerHeight();

            editor.popups.show("quotePopup", left, top, $btn.outerHeight());
        }

        return {
            showPopup: showPopup,
            hidePopup: function () {
                editor.popups.hide("quotePopup");
            },
        };
    };

    // ===============================
    // Register Commands
    // ===============================
    FroalaEditor.RegisterCommand("videoShortcode", {
        title: "Insert Video Shortcode",
        icon: "videoShortcode",
        undo: false,
        focus: false,
        plugin: "videoPlugin",
        callback: function () {
            if (!this.popups.isVisible("videoPopup")) {
                this.videoPlugin.showPopup();
            } else {
                this.popups.hide("videoPopup");
            }
        },
    });

    FroalaEditor.RegisterCommand("quoteShortcode", {
        title: "Insert Quote Shortcode",
        icon: "quoteShortcode",
        undo: false,
        focus: false,
        plugin: "quotePlugin",
        callback: function () {
            if (!this.popups.isVisible("quotePopup")) {
                this.quotePlugin.showPopup();
            } else {
                this.popups.hide("quotePopup");
            }
        },
    });

    // ===============================
    // Initialize Froala
    // ===============================
    var editor = new FroalaEditor("#froala-editor", {
        toolbarButtons: [
            "fullscreen",
            "bold",
            "italic",
            "underline",
            "strikeThrough",
            "subscript",
            "superscript",
            "|",
            "fontFamily",
            "fontSize",
            "color",
            "inlineStyle",
            "paragraphStyle",
            "|",
            "paragraphFormat",
            "align",
            "formatOL",
            "formatUL",
            "outdent",
            "indent",
            "|",
            "insertLink",
            "insertImage",
            "insertVideo",
            "videoShortcode",
            "quoteShortcode",
            "insertTable",
            "|",
            "undo",
            "redo",
            "html",
        ],
        imageUploadURL: uploadImageUrl,
        imageUploadParams: { _token: csrfToken },
        imageUploadMethod: "POST",
        imageAllowedTypes: ["jpeg", "jpg", "png", "gif"],
        imageMaxSize: 5 * 1024 * 1024,
        videoUploadURL: uploadVideoUrl,
        videoUploadParams: { _token: csrfToken },
        videoUploadMethod: "POST",
        videoAllowedTypes: ["mp4", "webm", "ogg"],
        videoMaxSize: 50 * 1024 * 1024,
    });

    $("#postform").on("submit", function () {
        $("#body").val(editor.html.get());
    });
});

