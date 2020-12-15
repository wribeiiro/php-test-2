<?php

namespace App\Repositories;

use App\Models\ProductTypeModel;
use App\Repositories\Interfaces\RepositoryInterface;
class ProductsTypeRepository implements RepositoryInterface {

    /**
     * @var ProductTypeModel
     */
    private $model;

    public function __construct() {
        $this->model = new ProductTypeModel(); 
    }
    
    public function get() {
        return $this->model->get();
    }

    public function create(array $data) {
        return $this->model->create($data);
    }

    public function update(int $id, array $data) {
        return $this->model->update($id, $data);
    }

    public function delete(int $id) {
        return $this->model->delete($id);
    }
}
