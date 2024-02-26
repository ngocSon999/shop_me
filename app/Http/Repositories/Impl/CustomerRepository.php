<?php
namespace App\Http\Repositories\Impl;

use App\Http\Repositories\CustomerRepoInterface;
use App\Models\Customer;
use App\Models\CustomerHistory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class CustomerRepository extends BaseRepository implements CustomerRepoInterface
{
    /**
     * @param $inputs
     * @return mixed
     * @throws \Exception
     */
    public function register($inputs): mixed
    {
        $data = [
            'name' => $inputs['name'],
            'code' => $uniqueId = Str::uuid(),
            'email' => $inputs['email'],
            'phone' => $inputs['phone'],
            'gender' => $inputs['gender'],
            'address' => $inputs['address'],
            'password' => Hash::make($inputs['password']),
        ];

        if (!empty($inputs['avatar'])) {
            $file = $inputs['avatar'];
            $ext = $file->extension();
            $filesize = $file->getSize();
            $imageName = 'customer-'.time().'.'.$ext;

            if (strcasecmp($ext, 'jpg') == 0 || strcasecmp($ext, 'jpeg') == 0
                || strcasecmp($ext, 'png') == 0) {

                if ($filesize < 7000000) {
                    $file->move('upload/customers/', $imageName);
                    $path = 'upload/customers/'.$imageName;
                    $data['avatar'] = $path;
                }
            }
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
}
