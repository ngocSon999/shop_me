<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Repositories\BankRepoInterface;
use App\Http\Requests\Admin\BankRequest;
use App\Http\Requests\Admin\BannerRequest;
use App\Http\Services\BannerServiceInterface;
use App\Http\Services\BaseServiceInterface;
use App\Models\Bank;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BankController extends Controller
{
    protected BankRepoInterface $bankRepository;
    protected BaseServiceInterface $baseService;

    public function __construct(
        BankRepoInterface $bankRepository,
        BaseServiceInterface $baseService
    )
    {
        $this->bankRepository = $bankRepository;
        $this->baseService = $baseService;
    }

    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admins.banks.index');
    }

    public function createForm($bankId = null): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $bank = $bankId ? $this->bankRepository->getById($bankId, Bank::class) : null;

        return view('admins.banks.form_create', compact('bank'));
    }

    public function store(BankRequest $request): RedirectResponse
    {
        try {
            $bank = $this->bankRepository->store($request->except('_token'), Bank::class);

            return redirect()->route('admin.banks.index')->with('success', 'Tạo thẻ thanh toán thành công');
        } catch (\Exception $e) {
            Log::error('Error create banks: '. $e->getMessage());

            return redirect()->route('admin.banks.index')->with('error', 'Có lỗi xảy ra vui lòng thử lại sau');
        }
    }

    public function getList(Request $request): JsonResponse
    {
        $filter = [
            'filter' => [
                'searchColumns' => [
                    'bank_name', 'bank_number', 'bank_account','bank_address'
                ],
                'inputFields' => [
                    'status' => $request->input('status'),
                ]
            ]
        ];

        $request->merge($filter);
        $data = $this->baseService->getDataBuilder($request, Bank::class);

        return response()->json($data);
    }

    public function edit($id): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $bank = $this->bankRepository->getById($id, Bank::class);

        return view('admins.banks.form_create', compact('bank'));
    }

    public function update(BankRequest $request, $id): RedirectResponse
    {
        try {
            DB::beginTransaction();
            $this->bankRepository->update($request->except(['_token']), $id, Bank::class);
            DB::commit();

            return redirect()->route('admin.banks.index')->with('success', 'update thẻ thanh toán thành công!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error update banks: '. $e->getMessage());

            return redirect()->route('admin.banks.index')->with('error', 'Có lỗi xảy ra vui lòng thử lại sau');
        }
    }

    public function delete($id): RedirectResponse
    {
        $this->bankRepository->delete($id, Bank::class);

        return redirect()->route('admin.banks.index')->with('success', 'Xóa tài khoản thẻ thành công!');
    }
}
