@extends('admin.layouts.master')
@section('css')
@parent
<style>
    .media-library {
        padding: 20px;
    }

    .media-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .media-actions {
        display: flex;
        gap: 10px;
    }

    .media-actions input,
    .media-actions select {
        padding: 6px 10px;
    }

    .media-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
        gap: 15px;
        margin-bottom: 20px;
    }

    .media-card {
        border: 1px solid #ddd;
        background: #fff;
        border-radius: 6px;
        overflow: hidden;
        transition: 0.2s;
    }

    .media-card:hover {
        box-shadow: 0 5px 15px rgba(0, 0, 0, .1);
    }

    .media-thumb {
        height: 140px;
        background: #f5f5f5;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .media-thumb img,
    .media-thumb video {
        max-width: 100%;
        max-height: 100%;
    }

    .media-info {
        padding: 10px;
        font-size: 13px;
    }

    .media-name {
        font-weight: bold;
        margin-bottom: 3px;
    }

    .media-type {
        color: #777;
        font-size: 12px;
    }

    .media-info input {
        width: 100%;
        font-size: 11px;
        margin-top: 5px;
    }

    .media-actions-bottom {
        padding: 8px;
        text-align: center;
        border-top: 1px solid #eee;
    }

    .media-actions-bottom button {
        background: #e74c3c;
        color: #fff;
        border: none;
        padding: 5px 10px;
        cursor: pointer;
        border-radius: 4px;
    }
</style>
@endsection
@section('main-content')
<!-- <div class="page-content-wrapper border">
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
</div> -->

<div class="media-library">

    {{-- Header --}}
    <div class="media-header">
        <h2>Media Library</h1>

            <div class="media-actions">
                <input type="text" id="mediaSearch" placeholder="Search media...">

                <select id="mediaFilter">
                    <option value="all">All</option>
                    <option value="images">Images</option>
                    <option value="videos">Videos</option>
                    <option value="files">Files</option>
                </select>


                <a href="{{ route('admin.media.upload') }}" class="btn btn-primary">
                    + Add Media
                </a>
            </div>
    </div>

    @foreach($items as $item)
    <h3>{{ $item->title }}</h2>
        {{-- Grid --}}
        <div class="media-grid" id="mediaGrid">



            @foreach($item->getMedia('*') as $media)

            <div class="media-card"
                data-name="{{ strtolower($media->name) }}"
                data-type="{{ $media->collection_name }}"
                data-mime="{{ $media->mime_type }}">

                {{-- Preview --}}
                <div class="media-thumb">
                    @if(str_starts_with($media->mime_type, 'image'))
                    <img src="{{ $media->getUrl('thumb') ?? $media->getUrl() }}">
                    @elseif(str_starts_with($media->mime_type, 'video'))
                    <video src="{{ $media->getUrl() }}"></video>
                    @else
                    <div class="media-file">
                        📄
                    </div>
                    @endif
                </div>

                {{-- Info --}}
                <div class="media-info">
                    <div class="media-name">{{ $media->name }}</div>
                    <div class="media-type">{{ $media->collection_name }}</div>

                    <input type="text"
                        value="{{ $media->getFullUrl() }}"
                        readonly
                        onclick="this.select()">
                </div>

                {{-- Actions --}}
                <div class="media-actions-bottom">
                    <form method="POST"
                        action="{{ route('admin.media.delete', $media->id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            onclick="return confirm('Delete this media?')">
                            🗑 Delete
                        </button>
                    </form>
                </div>
            </div>

            @endforeach


        </div>
        @endforeach
</div>
@endsection
@section('js')
@parent
<script>
    document.addEventListener('DOMContentLoaded', function() {

        const searchInput = document.getElementById('mediaSearch');
        const filterSelect = document.getElementById('mediaFilter');
        const mediaCards = document.querySelectorAll('.media-card');

        function filterMedia() {
            const searchValue = searchInput.value.toLowerCase();
            const filterValue = filterSelect.value;

            mediaCards.forEach(card => {
                const name = card.dataset.name;
                const type = card.dataset.type;

                const matchSearch = name.includes(searchValue);
                const matchFilter = filterValue === 'all' || type === filterValue;

                if (matchSearch && matchFilter) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        }

        searchInput.addEventListener('keyup', filterMedia);
        filterSelect.addEventListener('change', filterMedia);

    });
</script>
@endsection
