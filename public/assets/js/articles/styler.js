jQuery(function ($) {
    $(".fr-view ul").each(function () {
        const $ul = $(this);

        // پاک کردن کلاس‌ها و استایل‌های ul
        $ul.removeAttr("class style");

        // اضافه کردن کلاس‌های جدید
        $ul.addClass("list-group list-group-borderless mb-3");

        // پردازش li ها
        $ul.find("li").each(function () {
            const $li = $(this);

            // پاک کردن class و style قبلی li
            $li.removeAttr("class style");

            // افزودن کلاس bootstrap
            $li.addClass("list-group-item");

            // اگر آیکن نداشت، اضافه کن
            if ($li.find("i.fas").length === 0) {
                $li.prepend(
                    '<i class="fas fa-check-circle text-success me-2"></i>'
                );
            }
        });
    });
});
