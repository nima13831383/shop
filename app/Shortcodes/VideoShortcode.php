<?php

namespace App\Shortcodes;

use Vedmant\LaravelShortcodes\Shortcode;

class VideoShortcode extends Shortcode
{
    public function render($content)
    {
        $atts = $this->atts;

        // لینک ویدیو
        $videoUrl = strip_tags($content) ?? '#';
        // کاور پیش‌فرض
        $cover = $atts['cover'] ?? url('assets/images/no-img.webp');
        $sourceAttr = is_local($videoUrl)
            ? ''
            : 'data-source="youtube"';

        // اگر داخل پنل ادمین هستیم، شورتکد خام نمایش داده شود
        // if (request()->is('admin/*')) {

        //     return "[video cover=\"{$cover}\"]{$videoUrl}[/video]";
        // }

        // خروجی HTML واقعی
        return <<<HTML

<!-- Video START -->
			<div class="row mt-4">
					<div class="col-xl-10 mx-auto">
						<!-- Card item START -->
						<div class="card overflow-hidden h-200px h-sm-300px h-lg-400px h-xl-500px rounded-3 text-center" style="background-image:url({$cover}); background-position: center left; background-size: cover;">
							<!-- Card Image overlay -->
							<div class="bg-overlay bg-dark opacity-4"></div>
							<div class="card-img-overlay d-flex align-items-center p-2 p-sm-4">
								<div class="w-100 my-auto">
									<div class="row justify-content-center">
										<!-- Video -->
										<div class="col-12">
                                            <!-- Video MP4 -->
                <a href="{$videoUrl}" class="glightbox btn btn-lg text-danger btn-round btn-white-shadow  position-static mb-0" data-type="video" {$sourceAttr} data-draggable="false"
  data-touch-navigation="false">
                    <i class="fas fa-play"></i>
                </a>

										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- Card item END -->
					</div>
				</div>
				<!-- Video END -->


HTML;
    }
}
function is_local(string $url): string
{
    // YouTube
    if (preg_match('~(youtube\.com/watch\?v=|youtu\.be/)~i', $url)) {
        return 'false';
    }

    // MP4 (local یا external)
    if (preg_match('~\.mp4(\?.*)?$~i', $url)) {
        return 'true';
    }

    return 'true';
}
