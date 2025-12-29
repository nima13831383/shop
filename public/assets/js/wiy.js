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
jQuery(function ($) {
    var $editorDiv = $("#froala-editor");

    var uploadImageUrl = $editorDiv.data("upload-url");
    var uploadVideoUrl = $editorDiv.data("upload-video-url");
    var csrfToken = $editorDiv.data("csrf");

    /* ===============================
       آیکون دکمه
    =============================== */
    FroalaEditor.DefineIcon("videoShortcode", {
        NAME: "play",
        FA_PREFIX: "fas",
        FA_NAME: "play",
    });

    /* ===============================
       دکمه شورت‌کد ویدیو
    =============================== */
    FroalaEditor.RegisterCommand("videoShortcode", {
        title: "Insert Video Shortcode",
        focus: true,
        undo: true,
        refreshAfterCallback: true,
        callback: function () {
            let videoUrl = prompt("Video URL (mp4):");
            if (!videoUrl) return;

            let coverUrl = prompt("Cover Image URL (optional):");

            let shortcode = coverUrl
                ? `[video cover="${coverUrl}"]${videoUrl}[/video]`
                : `[video]${videoUrl}[/video]`;

            this.html.insert(shortcode + "<br>");
        },
    });

    /* ===============================
       INIT Froala (فقط یک بار)
    =============================== */
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
            "videoShortcode", // ✅ دکمه شورت‌کد
            "insertTable",
            "|",
            "undo",
            "redo",
            "html",
        ],

        // image upload
        imageUploadURL: uploadImageUrl,
        imageUploadParams: { _token: csrfToken },
        imageUploadMethod: "POST",
        imageAllowedTypes: ["jpeg", "jpg", "png", "gif"],
        imageMaxSize: 5 * 1024 * 1024,

        // video upload
        videoUploadURL: uploadVideoUrl,
        videoUploadParams: { _token: csrfToken },
        videoUploadMethod: "POST",
        videoAllowedTypes: ["mp4", "webm", "ogg"],
        videoMaxSize: 50 * 1024 * 1024,
    });

    /* ===============================
       Submit فرم
    =============================== */
    $("#postform").on("submit", function () {
        $("#body").val(editor.html.get());
    });
});
