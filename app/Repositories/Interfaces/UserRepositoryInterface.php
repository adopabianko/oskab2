<?php

namespace App\Repositories\Interfaces;

interface UserRepositoryInterface {
    public function findAll();
    public function findAllWithPaginate($reqParam);
    public function save($userData);
    public function findRoleUser($userId);
    public function update($reqParam, $userData);
    public function destroy($id);
    public function profileUpdate($reqParam, $userData);
}