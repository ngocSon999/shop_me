<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function index(Request $request): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admins.feedback.index');
    }

    public function getList(Request $request): JsonResponse
    {
        $data = Feedback::with([
            'customer' => function ($query) {
                $query->select('id', 'name');
            }
        ])
        ->paginate(20);

        return response()->json($data);
    }

    public function delete(Feedback $id): RedirectResponse
    {
        $id->delete();

        return redirect()
            ->route('admin.feedback.index')
            ->with('success', 'Xóa phản hồi thành công!');
    }

    public function update(Feedback $feedback, Request $request): JsonResponse
    {
        $status = $request->get('status');
        $feedback->update(['status' => $status]);

        return response()->json([
            'message' => 'Cập nhật trạng thái thành công',
            'code' => 200
        ]);
    }
}
