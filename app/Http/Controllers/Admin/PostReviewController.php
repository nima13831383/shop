<?php

namespace App\Http\Controllers\Admin;

use App\Models\PostReview;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class PostReviewController extends Controller
{
    public function show(PostReview $review)
    {
        return response()->json([
            'id' => $review->id,
            'user' => [
                'name' => $review->user?->name ?? 'کاربر حذف‌شده',
                'avatar' => $review->user?->avatar ?? asset('assets/images/avatar/default.jpg'),
            ],
            'post' => [
                'title' => $review->post?->title ?? '---'
            ],
            'time' => $review->created_at->diffForHumans(),
            'text' => $review->comment ?? '',
        ]);
    }

    /**
     * لیست کامنت‌ها
     */
    public function index($page = 1)
    {
        $reviews = PostReview::with(['post', 'user'])
            ->latest()
            ->paginate(4, ['*'], 'page', $page);

        return view('admin.review.index', compact('reviews'));
    }

    public function trashed($page = 1)
    {
        $reviews = PostReview::onlyTrashed() // فقط پست‌های Soft Deleted
            ->latest()
            ->with(['post', 'user'])
            ->latest()
            ->paginate(4, ['*'], 'page', $page);

        return view('admin.review.index-trash', compact('reviews'));
    }
    /**
     * فرم ویرایش کامنت
     */
    public function edit(PostReview $review)
    {
        return view('admin.review.edit', compact('review'));
    }

    /**
     * آپدیت کامنت
     */
    public function update(Request $request, PostReview $review)
    {
        $validated = $request->validate([
            'name'   => 'required|string|max:255',
            'email'  => 'required|email',
            'comment' => 'nullable|string',
            'rating' => 'required|integer|min:1|max:5',
            'status' => 'required|in:approved,unapproved,pending',
        ]);

        $review->update($validated);

        return redirect()
            ->route('admin.reviews.index')
            ->with('success', 'کامنت با موفقیت به‌روزرسانی شد.');
    }

    /**
     * حذف نرم (Soft Delete)
     */
    public function destroy(PostReview $review)
    {
        $review->delete();

        return redirect()
            ->route('admin.reviews.index')
            ->with('success', 'کامنت با موفقیت حذف شد.');
    }

    /**
     * حذف کامل (Force Delete)
     */
    public function forcedelete($review)
    {
        $review = PostReview::onlyTrashed()->findOrFail($review);

        $review->forceDelete();

        return redirect()
            ->route('admin.reviews.index')
            ->with('success', 'کامنت به‌صورت کامل حذف شد.');
    }

    /**
     * بازیابی کامنت حذف‌شده
     */
    public function restore($review)
    {
        $review = PostReview::onlyTrashed()->findOrFail($review);

        $review->restore();

        return redirect()
            ->route('admin.reviews.index')
            ->with('success', 'کامنت با موفقیت بازیابی شد.');
    }
    public function toggleStatus(Request $request)
    {
        $review = PostReview::findOrFail($request->id);

        $review->status = $request->status;
        $review->save();

        return response()->json([
            'message' => "وضعیت کامنت با موفقیت تغییر کرد.",
            'status' => $review->status
        ]);
    }
}
