<?php

declare(strict_types=1);

namespace App\Repositories\Interfaces;

interface RepositoryInterface
{
    public function get();

    public function create(array $data);

    public function update(int $id, array $data);

    public function delete(int $id);
}
