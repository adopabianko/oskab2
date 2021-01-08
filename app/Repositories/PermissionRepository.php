<?php

namespace App\Repositories;

use App\Repositories\Interfaces\PermissionRepositoryInterface;
use App\Models\Permission;

class PermissionRepository implements PermissionRepositoryInterface {

    public function findAll() {
        return Permission::orderBy('id', 'desc')->get();
    }

    public function findAllWithPaginate($reqParam) {
        $name = $reqParam->name;
        $display_name = $reqParam->display_name;

        return Permission::when($name, function($q) use ($name) {
            return $q->where('name', $name);
        })
        ->when($display_name, function($q) use ($display_name) {
            return $q->where('display_name', $display_name);
        })
        ->orderBy('id', 'desc')
        ->paginate(10);
    }

    public function save($permissionData) {
        $permission = new Permission($permissionData);

        return $permission->save();
    }

    public function findById($id) {
        return Permission::findOrFail($id);
    }

    public function update($reqParam, $permissionData) {
        return $permissionData->update($reqParam->all());
    }
}
