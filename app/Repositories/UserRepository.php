<?php

namespace App\Repositories;

use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Models\User;
use App\Models\RoleUser;

class UserRepository implements UserRepositoryInterface {

    public function findAll() {
        return User::with('role_user.role')
        ->where('active', 1)
        ->orderBy('id', 'desc')->get();
    }

    public function findAllWithPaginate($reqParam) {
        $role = $reqParam->role;
        $name = $reqParam->name;
        $email = $reqParam->email;

        return User::with('role_user.role')
        ->when($role && $role !== 'all', function($q) use ($role) {
            $q->whereHas('role_user.role', function($q) use ($role) {
                return $q->where('name', $role);
            });
        })
        ->when($name, function($q) use ($name){
            return $q->where('name', $name);
        })
        ->when($email, function($q) use ($email){
            return $q->where('email', $email);
        })
        ->where('active', 1)
        ->orderBy('id', 'desc')->paginate(10);
    }

    public function save($userData) {
        \DB::beginTransaction();

        try {
            $roleId = $userData['role_id'];

            unset($userData['role_id']);

            $user = new User($userData);
            $user->password = \Hash::make($userData['password']);

            $user->save();
            $user->attachRole($roleId);

            \DB::commit();

            return true;
        } catch(\Exception $e) {
            \DB::rollback();

            return false;
        }

    }

    public function findRoleUser($userId) {
        return RoleUser::where('user_id', $userId)->first();
    }

    public function update($reqParam, $userData) {
        \DB::beginTransaction();

        try {
            $password = $reqParam->password;
            $updateParam = $reqParam->all();

            if (!empty($password)) {
                $password = \Hash::make($password);

                $updateParam['password'] = $password;
            } else {
                unset($updateParam['password']);
            }

            $roleId = $updateParam['role_id'];

            unset($updateParam['role_id']);

            $userData->update($updateParam);

            $userData->syncRoles([$roleId]);

            \DB::commit();
        } catch(\Exception $e) {
            \DB::rollback();

            return false;
        }
    }

    public function destroy($id) {
        return User::where('id', $id)->update(['active' => 0]);
    }

    public function profileUpdate($reqParam, $userData) {
        $reqParam['password'] = \Hash::make($reqParam->password);

        return $userData->update($reqParam->all());
    }
}
