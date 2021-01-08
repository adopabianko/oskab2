<?php

namespace App\Repositories\Interfaces;

interface RoleRepositoryInterface {
    public function findAll();
    public function findAllWithPaginate($reqParam);
    public function save($roleData);
    public function findById($id);
    public function update($reqParam, $roleData);
}
