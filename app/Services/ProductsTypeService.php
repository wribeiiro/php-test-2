<?php

namespace App\Services;

use App\System\Controller;
use App\Repositories\ProductsTypeRepository;
use App\Validations\ProductsTypeValidation;

class ProductsTypeService extends Controller {

    /**
     * @var ProductsTypeRepository
     */
    private $products_type_repository;

    public function __construct()
    {
        $this->products_type_repository = new ProductsTypeRepository();
    }

    public function getAll() {
        return $this->products_type_repository->get();
    }

    public function getById(int $id) {
        return $this->products_type_repository->get($id);
    }

    public function create(array $data) {

        $this->validate = (new ProductsTypeValidation())->makeValidation($data);

        if ($this->validate !== null) {
            return $this->validate;
        }

        $result = $this->products_type_repository->create($data);

        return $result;
    }

    public function update(array $data, int $id) {
        $this->validate = (new ProductsTypeValidation())->makeValidation($data);

        if ($this->validate !== null) {
            return $this->validate;
        }

        try {
            $productType = $this->products_type_repository->update($id, $data);
        } catch (\Exception $e) {
            $productType = $e->getMessage();
        }

        return $productType;
    }

    public function delete(int $id) {
        try {
            $productType = $this->products_type_repository->delete($id);
        } catch (\Exception $e) {
            $productType = $e->getMessage();
        }

        return $productType;
    }
}
