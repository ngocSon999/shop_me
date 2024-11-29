<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    public function feedback(Request $request): JsonResponse
    {
        try {
            $customer = Auth::user();
            $data['message'] = $request->get('message');
            $data['rating'] = $request->get('rating') ?? 0;
            $data['customer_id'] = $customer->id;

            Feedback::create($data);

            return response()->json([
                'message' => 'Cảm ơn bạn đã gửi phản hồi',
                'code' => 200
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Có lỗi xảy ra vui lòng thử lại sau',
                'code' => 500
            ]);
        }
    }
}
