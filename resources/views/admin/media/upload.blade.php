@extends('admin.layouts.master')
@section('css')
@parent
<style>
    .media-upload-wrapper {
        max-width: 600px;
        margin: 30px auto;
        background: #fff;
        padding: 25px;
        border-radius: 8px;
        border: 1px solid #ddd;
    }

    .media-upload-wrapper h1 {
        margin-bottom: 20px;
    }

    .media-upload-form .form-group {
        margin-bottom: 15px;
    }

    .media-upload-form label {
        display: block;
        font-weight: bold;
        margin-bottom: 5px;
    }

    .media-upload-form input,
    .media-upload-form select {
        width: 100%;
        padding: 8px 10px;
    }

    .upload-box {
        border: 2px dashed #bbb;
        padding: 30px;
        text-align: center;
        cursor: pointer;
        position: relative;
    }

    .upload-box span {
        color: #777;
    }

    .upload-box input[type="file"] {
        position: absolute;
        inset: 0;
        opacity: 0;
        cursor: pointer;
    }

    #preview {
        margin-top: 10px;
    }

    #preview img,
    #preview video {
        max-width: 100%;
        max-height: 200px;
        display: block;
    }

    .btn-primary {
        background: #2271b1;
        color: #fff;
        padding: 10px 15px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .btn-secondary {
        display: inline-block;
        margin-left: 10px;
        color: #555;
    }
</style>
@endsection
@section('main-content')
<div class="media-upload-wrapper">

    <h1>Add Media</h1>

    @if($errors->any())
    <div class="alert alert-danger">
        {{ $errors->first() }}
    </div>
    @endif

    <form action="{{ route('admin.media.store') }}"
        method="POST"
        enctype="multipart/form-data"
        class="media-upload-form">

        @csrf

        <div class="form-group">
            <label>Title (optional)</label>
            <input type="text" name="title" placeholder="Media title">
        </div>

        <div class="form-group">
            <label>Media type</label>
            <select name="collection">
                <option value="images">Image</option>
                <option value="videos">Video</option>
                <option value="files">File</option>
            </select>
        </div>

        <div class="form-group">
            <label>Upload file</label>

            <div class="upload-box" id="uploadBox">
                <span>Click or drag file here</span>
                <input type="file" name="file" id="fileInput" required>
            </div>

            <div id="preview"></div>
        </div>

        <button type="submit" class="btn-primary">
            Upload Media
        </button>

        <a href="{{ route('admin.media.index') }}" class="btn-secondary">
            ← Back to Library
        </a>

    </form>
</div>
@endsection
@section('js')
@parent
<script>
    const input = document.getElementById('fileInput');
    const preview = document.getElementById('preview');

    input.addEventListener('change', function() {
        preview.innerHTML = '';

        const file = this.files[0];
        if (!file) return;

        if (file.type.startsWith('image')) {
            const img = document.createElement('img');
            img.src = URL.createObjectURL(file);
            preview.appendChild(img);
        } else if (file.type.startsWith('video')) {
            const video = document.createElement('video');
            video.src = URL.createObjectURL(file);
            video.controls = true;
            preview.appendChild(video);
        } else {
            preview.innerHTML = `<p>📄 ${file.name}</p>`;
        }
    });
</script>
@endsection
