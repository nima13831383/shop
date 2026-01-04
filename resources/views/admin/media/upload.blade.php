@extends('admin.layouts.master')

@section('main-content')
<div class="page-content-wrapper border">
    <form action="{{ route('admin.media.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <input type="text" name="title" placeholder="عنوان (اختیاری)">

        <select name="collection">
            <option value="images">تصویر</option>
            <option value="videos">ویدیو</option>
            <option value="files">فایل</option>
        </select>

        <input type="file" name="file" required>

        <button type="submit">آپلود</button>
    </form>
</div>
@endsection
