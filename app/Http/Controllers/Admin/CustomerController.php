<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Repositories\CustomerRepoInterface;
use App\Http\Services\BaseServiceInterface;
use App\Models\Customer;
use App\Models\CustomerHistory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class CustomerController extends Controller
{
    protected CustomerRepoInterface $customerRepository;
    protected BaseServiceInterface $baseService;

    public function __construct(
        CustomerRepoInterface $customerRepository,
        BaseServiceInterface $baseService
    )
    {
        $this->customerRepository = $customerRepository;
        $this->baseService = $baseService;
    }

    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admins.customers.index');
    }

    public function createForm($bannerId = null): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $banner = $bannerId ? $this->bannerService->getById($bannerId) : null;

        return view('admins.banners.form_create', compact('banner'));
    }

    public function getList(Request $request): JsonResponse
    {
        $filter = [
            'filter' => [
                'searchColumns' => [
                    'name', 'email', 'phone'
                ],
                'inputFields' => [
                    'code' => $request->input('code'),
                ]
            ]
        ];

        $request->merge($filter);
        $data = $this->baseService->getDataBuilder($request, Customer::class);

        return response()->json($data);
    }

    public function editCoin($id): RedirectResponse|view
    {
        $customer = $this->customerRepository->getById($id, Customer::class);
        if (!empty($customer)) {
            return view('admins.customers.form_create', compact('customer'));
        }

        return redirect()->back()->with('danger', 'Customer not found');
    }

    public function update(Request $request, $id): RedirectResponse
    {
        try {
            $this->bannerService->update($request, $id);

            return redirect()->route('admin.customers.index')->with('success', 'update customer thành công!');
        } catch (\Exception $e) {
            Log::error('Error update customers: '. $e->getMessage());

            return redirect()->route('admin.customers.index')->with('error', 'Có lỗi xảy ra vui lòng thử lại sau');
        }
    }

    public function delete($id): RedirectResponse
    {
        //TODO
    }

    public function addCoin($id, Request $request): RedirectResponse
    {
        $request->validate([
            'add_coin' => 'required|integer|min:1|max:99999999',
        ]);

        $customer = $this->customerRepository->getById($id, Customer::class);
        if (empty($customer)) {
            return redirect()->back()->with('danger', 'Customer not found');
        }

        $currentCoin = $customer->coin;
        $coin = $request->input('add_coin');
        $totalCoin = $currentCoin + $coin;
        try {
            DB::beginTransaction();
            $customer->coin = $totalCoin;
            $customer->save();

            CustomerHistory::create([
                'customer_id' => $customer->id,
                'note' => 'Nạp tiền vào tài khoản bởi admin',
                'coin_spent' => $coin,
                'total_coin' => $totalCoin,
            ]);
            DB::commit();

            return redirect()->route('admin.customers.index')->with('success', 'Nạp tiền thành công');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('lỗi nạp tiền cho khách hàng '. $customer->email. 'mesageError: '.$e->getMessage());

            return redirect()->back()->with('warning', 'Có lỗi xảy ra trong quá trình giao dịch. Vui lòng thử lại');
        }
    }

    public function show($id): RedirectResponse|view
    {
        $customer = $this->customerRepository->getById($id, Customer::class);
        if (empty($customer)) {
            return redirect()->back()->with('danger', 'Customer not found');
        }

        return view('admins.customers.show', compact('customer'));
    }

    public function transactionHistory($id, Request $request): Factory|View|Application|RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        $customer = $this->customerRepository->getById($id, Customer::class);
        if (empty($customer)) {
            return redirect()->back()->with('danger', 'Customer not found');
        }
        $histories = $customer->customerHistory;

        return view('admins.customers.history', compact('customer', 'histories'));
    }

    public function updatePassword(Request $request): JsonResponse
    {
        $request->validate([
            'password' => 'required|min:6|max:32',
            'password_confirmation' => 'required|same:password'
        ]);

        $id = $request->input('customer_id');
        $password = $request->input('password');
        $data = [
            'password' => Hash::make($password),
        ];

        try {
            DB::beginTransaction();
            $this->customerRepository->update($data, $id, Customer::class);
            DB::commit();
            Log::info('Change password customer by admin: success fully');

            return response()->json([
                'code' => 200,
                'message' => 'Cập nhật mật khẩu thành công'
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error change password customer by admin : '. $e->getMessage());

            return response()->json([
                'code' => 500,
                'message' => 'Có lỗi xảy ra vui lòng thử lại!'
            ]);
        }
    }
}
