<?php

namespace App\Http\Services;

use App\Models\User;
use Cartalyst\Sentinel\Users\UserInterface;
use Illuminate\Http\Request;

interface SentinelServiceInterface extends BaseServiceInterface
{
    public function authenticate(Request $request): UserInterface|bool;

    public function getRoles();

    public function getAllRoles();

    public function createUser(Request $request): void;

    public function editUser($id);
    public function getAllUser(?string $slug);
    public function getDataUserAndSearch(Request $request): array;

    public function getUserById($id): User;

    public function updateUserById($request, $id): void;
    public function deleteUserById($id): void;
}
