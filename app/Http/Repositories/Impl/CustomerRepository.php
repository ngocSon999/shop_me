<?php
namespace App\Http\Repositories\Impl;

use App\Http\Repositories\CustomerRepoInterface;
use App\Models\Customer;
use App\Models\CustomerHistory;
use App\Traits\StorageTrait;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class CustomerRepository extends BaseRepository implements CustomerRepoInterface
{
    use StorageTrait;
    /**
     * @param $inputs
     * @return mixed
     * @throws \Exception
     */
    public function register($request): mixed
    {
        $data = [
            'name' => $request->name,
            'code' => Str::uuid(),
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ];

        if (!empty($request->avatar)) {
            $resultPath = $this->storageTraitUpload($request, 'avatar','customers');
            $data['avatar'] = $resultPath['file_path'];
        }

        DB::beginTransaction();
        try {
            $customer = Customer::create($data);
            DB::commit();

            return $customer;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error create customer: '.$e->getMessage());

            throw $e;
        }
    }

    public function exchangeCoin($coin): bool
    {
        try {
            $customer = Auth::user();
            $currentCoin = $customer->coin - $coin;
            CustomerHistory::create([
                'customer_id' => $customer->id,
                'note' => 'Trừ xu mua tài khoản game',
                'coin_spent' => $coin,
                'total_coin' => $currentCoin,
            ]);
            $customer->coin = $currentCoin;
            $customer->save();

            return true;
        } catch (\Exception $e) {
            Log::error('Error exchange coin customer: '.$customer->email .' message: '.$e->getMessage());

            return false;
        }
    }

    /**
     * @throws \Exception
     */
    public function updateProfile($request): ?Authenticatable
    {
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ];
        if (!empty($request->password)) {
            $data['password'] = Hash::make($request->password);
        }
        $customer = Auth::user();

        if (!empty($request->avatar)) {
            $resultPath = $this->storageTraitUpload($request, 'avatar','customers');
            $oldAvatar = public_path($customer->avatar);
            $data['avatar'] = $resultPath['file_path'];
        }

        DB::beginTransaction();
        try {
            $customer->update($data);
            if (!empty($oldAvatar)) {
                if (file_exists($oldAvatar)) {
                    unlink($oldAvatar);
                }
            }
            DB::commit();

            return $customer;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error create customer: '.$e->getMessage());

            throw $e;
        }
    }
}
