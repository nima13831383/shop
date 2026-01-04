
@extends('admin.layouts.master')

@section('main-content')
<div class="page-content-wrapper border">
        <h1>Media Library</h1>

    @if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
    @endif

    @foreach($items as $item)
    <h3>{{ $item->id }} - {{ $item->name ?? 'Item' }}</h3>

    @foreach($item->getMedia('*') as $media)
    <div style="margin-bottom: 20px; border: 1px solid #ccc; padding: 10px;">
        @if($media->mime_type && str_starts_with($media->mime_type, 'image'))
        <img src="{{ $media->getUrl('thumb') ?? $media->getUrl() }}" style="max-width:150px; display:block;">
        @endif

        <p>Name: {{ $media->name }}</p>
        <p>File: <input type="text" value="{{ $media->getFullUrl() }}" readonly style="width:100%"></p>

        <form method="POST" action="{{ route('admin.media.delete', $media->id) }}">
            @csrf
            @method('DELETE')
            <button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
        </form>
    </div>
    @endforeach
    @endforeach
</div>
@endsection
