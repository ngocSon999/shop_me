<?php
namespace App\Http\Repositories\Impl;

use App\Http\Repositories\CustomerRepoInterface;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class CustomerRepository extends BaseRepository implements CustomerRepoInterface
{
    /**
     * @param $inputs
     * @return mixed
     * @throws \Exception
     */
    public function register($inputs): mixed
    {
        if (!empty($inputs['avatar'])) {
            $file = $inputs['avatar'];
            $fileName = $file->getClientOriginalName();
            $ext = $file->extension();
            $filesize = $file->getSize();
            if (strcasecmp($ext, 'jpg') == 0 || strcasecmp($ext, 'jpeg') == 0
                || strcasecmp($ext, 'png') == 0) {
                if ($filesize < 7000000) {
                    $file->move('upload/customers/', $fileName);
                    $path = 'upload/customers/'.$fileName;
                    $data['avatar'] = $path;
                }
            }
        }
        $data = [
          'name' => $inputs['name'],
          'email' => $inputs['email'],
          'phone' => $inputs['phone'],
          'gender' => $inputs['gender'],
          'address' => $inputs['address'],
          'password' => Hash::make($inputs['password']),
        ];

        DB::beginTransaction();
        try {
            $customer = Customer::create($data);
            DB::commit();

            return $customer;
        } catch (\Exception $e) {
            DB::rollBack();

            throw $e;
        }
    }

    public function exchangeCoin($coin): bool
    {
        try {
            $customer = Auth::user();
            $customer->coin = $customer->coin - $coin;

            $customer->save();


            return true;
        } catch (\Exception $e) {
            Log::error('Error exchange coin: '.$e->getMessage());

            return false;
        }
    }
}
