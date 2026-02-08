<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\PostReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Throwable;
use Illuminate\Support\Facades\Http;

class PostReviewController extends Controller
{
    public function store(Request $request)
    {
        try {
            $request->validate([
                'g-recaptcha-response' => 'required',
            ]);

            // Validate Recaptcha
            $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
                'secret'   => env('RECAPTCHA_SECRET_KEY'),
                'response' => $request->input('g-recaptcha-response'),
                'remoteip' => $request->ip(),
            ]);

            if (!$response->json()['success']) {
                return back()->withErrors(['captcha' => 'کد امنیتی نامعتبر است'])->withInput();
            }

            // قوانین اعتبارسنجی معمولی
            $rules = [
                'comment' => 'required|string'
            ];

            if (!Auth::check()) {
                $rules['name']  = 'required|string|max:255';
                $rules['email'] = 'required|email';
            }

            $request->validate($rules);

            // ذخیره نظر
            PostReview::create([
                'post_id'   => $request->post_id,
                'parent_id' => $request->parent_id,
                'user_id'   => Auth::id(),
                'name'      => Auth::check() ? Auth::user()->name  : $request->name,
                'email'     => Auth::check() ? Auth::user()->email : $request->email,
                'comment'   => $request->comment,
                'status'    => 'pending',
            ]);

            return back()->with('success', 'نظر شما پس از تایید نمایش داده می‌شود');
        } catch (\Throwable $e) {
            dd($e);
        }
    }
}
