<?php
namespace App\Http\Services\Impl;

use App\Http\Repositories\UserRepoInterface;
use App\Http\Services\SentinelServiceInterface;
use App\Models\User;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Cartalyst\Sentinel\Users\UserInterface;
use Illuminate\Http\Request;

class SentinelService extends BaseService implements SentinelServiceInterface
{
    protected UserRepoInterface $userRepository;

    public function __construct(UserRepoInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    public function authenticate(Request $request): UserInterface|bool
    {
        return $this->userRepository->userLogin([
            'email' => $request->email,
            'password' => $request->password,
        ], (bool) $request->remember);
    }

    public function getRoles()
    {
        return Sentinel::getRoleRepository()->where('slug', '!=', 'super-admin')->get();
    }

    public function getAllRoles()
    {
        return Sentinel::getRoleRepository()->get();
    }

    public function createUser(Request $request): void
    {
        $credentials = [
            'first_name' => $request->first_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => $request->password,
        ];
        $role = $request->role;
        $this->userRepository->createUser($credentials, $role);
    }

    public function editUser($id)
    {
        return $this->userRepository->editUser($id);
    }
    public function getAllUser(?string $slug)
    {
        if (!empty($slug)) {
            return Sentinel::getUserRepository()->whereHas('roles', function ($query) use ($slug) {
                $query->where('slug', $slug);
            })->get();
        }

        return Sentinel::getUserRepository()->whereHas('roles', function ($query) use ($slug) {
            $query->where('slug','!=', 'super-admin');
        })->get();
    }
    public function getDataUserAndSearch(Request $request): array
    {
        $filter = [
            'filter' => [
                'searchColumns' => [
                    'email',
                    'phone',
                    'first_name',
                    'last_name',
                ],
                'inputFields' => [
                    'first_name' => $request->user_name,
                    'email' => $request->email,
                ],
                'start_date' => [
                    'created_at' => $request->start_date,
                ],
                'end_date' => [
                    'created_at' => $request->end_date,
                ],
            ],
        ];

        if(!empty($request->input('role_id'))) {
            $filter['filter']['whereHas'] = [
                'roles' => [
                    'role_id' => $request->role_id
                ]
            ];
        }
        $request->merge($filter);
        $request->merge([
            'withRelation' => ['roles']
        ]);

        return $this->getDataBuilder($request, User::class);
    }

    public function getUserById($id): User
    {
        return Sentinel::findById($id);
    }

    public function updateUserById($request, $id): void
    {
        $user = Sentinel::findById($id);
        $credentials = [
            'first_name' => $request->first_name,
            'email' => $request->email,
            'phone' => $request->phone,
        ];

        if (!empty($request->password)) {
            $credentials['password'] = $request->password;
        }

        $user = Sentinel::update($user, $credentials);
        if ($request->role) {
            $roleUpdate = Sentinel::findRoleById($request->role);
            $user->roles()->sync($roleUpdate);
        }
    }
    public function deleteUserById($id): void
    {
        $user = Sentinel::findById($id);
        $user->delete();
    }
}
