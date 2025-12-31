<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GLightbox + Plyr Example</title>

    <!-- GLightbox CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" />

    <!-- Plyr CSS -->
    <link rel="stylesheet" href="https://cdn.plyr.io/3.6.8/plyr.css" />

    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background: #f5f5f5;
        }

        h1 {
            text-align: center;
            margin-bottom: 40px;
        }

        .gallery a {
            display: inline-block;
            margin: 10px;
            border: 2px solid #ccc;
            border-radius: 8px;
            overflow: hidden;
            width: 200px;
            text-align: center;
        }

        .gallery img {
            width: 100%;
            display: block;
        }

        .gallery span {
            display: block;
            padding: 5px;
            background: #fff;
        }
    </style>
</head>

<body>

    <h1>GLightbox + Plyr Example</h1>

    <div class="gallery">
        <!-- Image -->
        <a href="https://picsum.photos/1200/800" class="glightbox" data-title="Sample Image" data-description="This is an example image">
            <img src="https://picsum.photos/400/267" alt="Image">
            <span>Image</span>
        </a>

        <!-- Video MP4 -->
        <a href="https://www.w3schools.com/html/mov_bbb.mp4" class="glightbox" data-type="video" data-title="MP4 Video">
            <img src="https://via.placeholder.com/400x267?text=MP4+Video" alt="MP4 Video">
            <span>MP4 Video</span>
        </a>

        <!-- YouTube Video -->
        <a href="https://www.youtube.com/watch?v=lcbL-WQ0pAY" class="glightbox" data-type="video" data-source="youtube" data-title="YouTube Video">
            <img src="https://via.placeholder.com/400x267?text=YouTube" alt="YouTube Video">
            <span>YouTube Video</span>
        </a>

        <!-- Vimeo Video -->
        <a href="https://vimeo.com/115041822" class="glightbox" data-type="video" data-source="vimeo" data-title="Vimeo Video">
            <img src="https://via.placeholder.com/400x267?text=Vimeo" alt="Vimeo Video">
            <span>Vimeo Video</span>
        </a>
    </div>

    <!-- Inline HTML content -->
    <a href="#inline-content" class="glightbox" data-title="Inline Content">
        <img src="https://via.placeholder.com/400x267?text=Inline+HTML" alt="Inline HTML">
        <span>Inline HTML</span>
    </a>

    <div style="display:none;" id="inline-content">
        <h2>Hello!</h2>
        <p>This is inline HTML content inside the lightbox.</p>
    </div>

    <!-- GLightbox JS -->
    <script src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script>

    <!-- Plyr JS -->
    <script src="https://cdn.plyr.io/3.6.8/plyr.polyfilled.js"></script>

    <script>
        const lightbox = GLightbox({
            selector: '.glightbox',
            autoplayVideos: true,
            plyr: {
                css: 'https://cdn.plyr.io/3.6.8/plyr.css',
                js: 'https://cdn.plyr.io/3.6.8/plyr.polyfilled.js',
                config: {
                    ratio: '16:9',
                    muted: false,
                    hideControls: false,
                    youtube: {
                        noCookie: true,
                        rel: 0,
                        showinfo: 0
                    },
                    vimeo: {
                        byline: false,
                        portrait: false,
                        title: false
                    }
                }
            }
        });

        // Example: Listen to events
        lightbox.on('slide_changed', ({
            current
        }) => {
            if (current.player) {
                console.log('Video slide changed: ', current);
            }
        });
    </script>

</body>

</html>
