<form action="{{ route('media.store') }}" method="POST" enctype="multipart/form-data">
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
