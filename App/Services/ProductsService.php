<?php

namespace App\Services;

use App\System\Controller;
use App\Repositories\ProductsRepository;
use App\Validations\ProductsValidation;

class ProductsService extends Controller {

    /**
     * @var ProductsRepository
     */
    private $products_repository;

    public function __construct()
    {
        $this->products_repository = new ProductsRepository();
    }

    public function getAll() {
        return $this->products_repository->get();
    }

    public function getById(int $id) {
        return $this->products_repository->get($id);
    }

    public function create(array $data) {

        $this->validate = (new ProductsValidation())->makeValidation($data);

        if ($this->validate !== null) {
            return $this->validate;
        }

        $result = $this->products_repository->create($data);

        return $result;
    }

    public function update(array $data, int $id) {
        $this->validate = (new ProductsValidation())->makeValidation($data);

        if ($this->validate !== null) {
            return $this->validate;
        }

        try {
            $product = $this->products_repository->update($id, $data);
        } catch (\Exception $e) {
            $product = $e->getMessage();
        }

        return $product;
    }

    public function delete(int $id) {
        try {
            $product = $this->products_repository->delete($id);
        } catch (\Exception $e) {
            $product = $e->getMessage();
        }

        return $product;
    }
}
