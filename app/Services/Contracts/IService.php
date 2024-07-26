<?php

namespace App\Services\Contracts;


interface IService
{
    public function getAll();
    public function getById($id);
    public function create(array $data);
    public function update(int $id, array $data);
    public function delete(int $id);
}