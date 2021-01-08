<?php

namespace App\Repositories;

use App\Repositories\Interfaces\RoleRepositoryInterface;
use App\Models\Role;

class RoleRepository implements RoleRepositoryInterface {

    public function findAll() {
        return Role::orderBy('id', 'desc')->get();
    }

    public function findAllWithPaginate($reqParam) {
        $name = $reqParam->name;
        $display_name = $reqParam->display_name;

        return Role::when($name, function($q) use ($name) {
            return $q->where('name', $name);
        })
            ->when($display_name, function($q) use ($display_name) {
                return $q->where('display_name', $display_name);
            })
            ->orderBy('id', 'desc')
            ->paginate(10);
    }

    public function save($roleData) {
        $role = new Role($roleData);

        return $role->save();
    }

    public function findById($id) {
        return Role::findOrFail($id);
    }

    public function update($reqParam, $roleData) {
        return $roleData->update($reqParam->all());
    }
}
