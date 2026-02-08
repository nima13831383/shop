<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class CaptchaController extends Controller
{
    public function image()
    {
        $code = rand(1000, 9999);
        session(['captcha_image' => $code]);

        $img = imagecreate(120, 40);
        $bg = imagecolorallocate($img, 240, 240, 240);
        $text = imagecolorallocate($img, 20, 20, 20);

        imagestring($img, 5, 35, 10, $code, $text);

        header('Content-Type: image/png');
        imagepng($img);
        imagedestroy($img);
        exit;
    }
}
