<?php

namespace App\Shortcodes;

use Vedmant\LaravelShortcodes\Shortcode;

class Quote extends Shortcode
{

    public function render($content)
    {
        $atts = $this->atts;

        // متن کوت
        $quoteText = trim(strip_tags($content)) ?: 'Your quote here';
        $atts = fixAndCleanShortcodeAttributes($atts);
        // اطلاعات نویسنده
        $author = $atts['author'] ?? 'Anonymous';
        $via = $atts['via'] ?? '';
        $avatar = $atts['avatar'] ?? 'assets/images/avatar/default.jpg';
        // اگر داخل ادمین هستیم، شورتکد خام نمایش داده شود
        if (request()->is('admin/*')) {
            return "[quote author=\"{$author}\" via=\"{$via}\" avatar=\"{$avatar}\"]{$quoteText}[/quote]";
        }

        // خروجی HTML واقعی
        return <<<HTML
<!-- Quote START -->
<div class="col-lg-10 col-xl-8 mx-auto mt-4">
    <div class="bg-light rounded-3 p-3 p-md-4">
        <!-- Content -->
        <q class="lead">{$quoteText}</q>
        <!-- Avatar -->
        <div class="d-flex align-items-center mt-3">
            <!-- Avatar image -->
            <div class="avatar avatar-md">
                <img class="avatar-img rounded-circle" src="{$avatar}" alt="avatar">
            </div>
            <!-- Info -->
            <div class="ms-2">
                <h6 class="mb-0"><a href="#">{$author}</a></h6>
                <p class="mb-0 small">{$via}</p>
            </div>
        </div>
    </div>
</div>
<!-- Quote END -->
HTML;
    }
}


function fixAndCleanShortcodeAttributes(array $atts): array
{
    $fixed = [];
    $keys = array_keys($atts);
    $i = 0;

    while ($i < count($keys)) {
        $key = $keys[$i];
        $value = $atts[$key] ?? '';

        // اگر ایندکس عددی، رد شود
        if (is_int($key)) {
            $i++;
            continue;
        }

        // همه ایندکس‌های عددی بعدی را بچسبان
        while (isset($keys[$i + 1]) && is_int($keys[$i + 1])) {
            $nextKey = $keys[$i + 1];
            $value .= ' ' . $atts[$nextKey];
            $i++;
        }

        // پاکسازی کامل
        $value = html_entity_decode($value, ENT_QUOTES | ENT_HTML5);
        $value = trim($value, "\"'");
        $value = str_replace(["\xC2\xA0", "\u{A0}"], ' ', $value);
        $value = preg_replace('/\s+/', ' ', $value);
        $value = trim($value);

        $fixed[$key] = $value;
        $i++;
    }

    return $fixed;
}
