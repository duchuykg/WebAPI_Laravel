<?php

namespace App\Repositories\Contracts;

interface IRepository
{
    public function getById($id);
    public function getAll();
    public function create(array $data);
    public function update(int $id, array $data);
    public function delete(int $id);
}