/// <reference types="jquery" />
jQuery(document).ready(function ($) {
    var editorDiv = $("#froala-editor");

    var editor = new FroalaEditor("#froala-editor", {
        // آپلود تصویر
        imageUploadURL: editorDiv.data("upload-url"),
        imageUploadParams: { _token: editorDiv.data("csrf") },
        imageUploadMethod: "POST",
        imageAllowedTypes: ["jpeg", "jpg", "png", "gif"],
        imageMaxSize: 5 * 1024 * 1024,

        // آپلود ویدیو
        videoUploadURL: editorDiv.data("upload-video-url"),
        videoUploadParams: { _token: editorDiv.data("csrf") },
        videoUploadMethod: "POST",
        videoAllowedTypes: ["mp4", "webm", "ogg"],
        videoMaxSize: 50 * 1024 * 1024, // مثلا 50MB
    });

    // وقتی فرم submit شد، مقدار HTML داخل textarea بریز
    $("#postform").on("submit", function () {
        $("#body").val(editor.html.get());
    });
});
