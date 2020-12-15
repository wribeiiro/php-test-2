<?php

namespace App\Repositories\Interfaces;

interface RepositoryInterface
{
    public function get();

    public function create(array $data);

    public function update(int $id, array $data);

    public function delete(int $id);
}