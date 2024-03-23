<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Repositories\CardRepoInterface;
use App\Http\Requests\Admin\CardRequest;
use App\Http\Services\BaseServiceInterface;
use App\Models\Card;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\JsonResponse;

class CardController extends Controller
{
    protected CardRepoInterface $cardRepository;
    protected BaseServiceInterface $baseService;

    public function __construct(
        CardRepoInterface $cardRepository,
        BaseServiceInterface $baseService
    )
    {
        $this->cardRepository = $cardRepository;
        $this->baseService = $baseService;
    }
    public function rechargeCard(CardRequest $request): RedirectResponse
    {
        $data = $request->all();
        $data['customer_id'] = Auth::id();
        $this->cardRepository->store($data, Card::class);

        return redirect()->back()->with('success', 'Nạp thẻ cào thành công');
    }

    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admins.cards.index');
    }

    public function getList(Request $request): JsonResponse
    {
        $filter = [
            'filter' => [
                'searchColumns' => [
                    'serial', 'number'
                ],
                'inputFields' => [
                    'status' => $request->input('status'),
                    'type' => $request->input('type'),
                ]
            ]
        ];

        $request->merge($filter);
        $data = $this->baseService->getDataBuilder($request, Card::class);

        return response()->json($data);
    }

    public function update(Request $request, $id): JsonResponse
    {
        try {
            DB::beginTransaction();
            $data['status'] = $request->get('status');
            $this->cardRepository->update($data, $id, Card::class);
            DB::commit();

            return response()->json([
                'code' => 200,
                'message' => 'Cập nhật trạng thái thẻ thành công',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'code' => 500,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function delete($id): RedirectResponse
    {
        $this->cardRepository->delete($id, Card::class);

        return redirect()->route('admin.cards.index')->with('success', 'Xóa thẻ cào thành công!');
    }
}
