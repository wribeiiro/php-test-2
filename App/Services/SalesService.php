<?php

namespace App\Services;

use App\System\Controller;
use App\Repositories\SalesRepository;
use App\Validations\SalesValidation;

class SalesService extends Controller {

    /**
     * @var SalesRepository
     */
    private $sales_repository;

    public function __construct()
    {
        $this->sales_repository = new SalesRepository();
    }

    public function getAll() {
        return $this->sales_repository->get();
    }

    public function getItems(int $id) {
        return $this->sales_repository->getItems($id);
    }

    public function getById(int $id) {
        return $this->sales_repository->get($id);
    }

    public function create(array $data) {

        $this->validate = (new SalesValidation())->makeValidation($data);

        if ($this->validate !== null) {
            return $this->validate;
        }

        $result = $this->sales_repository->create($data);

        return $result;
    }

    public function update(array $data, int $id) {
        $this->validate = (new SalesValidation())->makeValidation($data);

        if ($this->validate !== null) {
            return $this->validate;
        }

        try {
            $product = $this->sales_repository->update($id, $data);
        } catch (\Exception $e) {
            $product = $e->getMessage();
        }

        return $product;
    }

    public function delete(int $id) {
        try {
            $product = $this->sales_repository->delete($id);
        } catch (\Exception $e) {
            $product = $e->getMessage();
        }

        return $product;
    }
}
