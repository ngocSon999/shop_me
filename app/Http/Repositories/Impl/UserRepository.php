<?php
namespace App\Http\Repositories\Impl;

use App\Http\Repositories\UserRepoInterface;
use App\Models\User;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Cartalyst\Sentinel\Users\UserInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserRepository implements UserRepoInterface
{
    public function userLogin($credentials, $remember): UserInterface|bool
    {
        $user = Sentinel::authenticate($credentials, $remember);
        if ($user) {
            $user->last_login = now();
            $user->save();
        }

        return $user;
    }

    public function createUser($credentials, $role): bool|UserInterface
    {
        try {
            $user = Sentinel::registerAndActivate($credentials);
            $user->roles()->attach(Sentinel::findRoleById($role));

            return $user;
        } catch (\Exception $e) {
            Log::error('Error creating user: ' . $e->getMessage(), [
                'credentials' => $credentials,
                'role' => $role,
                'exception' => $e,
            ]);

            return false;
        }
    }

    public function editUser($id)
    {
        return Sentinel::findById($id);
    }
}
