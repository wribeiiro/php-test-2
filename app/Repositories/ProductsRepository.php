<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\ProductModel;
use App\Repositories\Interfaces\RepositoryInterface;

class ProductsRepository implements RepositoryInterface
{

    /**
     * @var ProductModel
     */
    private $model;

    public function __construct()
    {
        $this->model = new ProductModel();
    }
    
    public function get()
    {
        $sql = "SELECT 
                    products.*, products_type.description as product_type_name,
                    products_type.tax_percentage as tax 
                FROM 
                    products 
                INNER JOIN 
                    products_type 
                ON products.product_type_id = products_type.id";
        
        return $this->model->executeQuery($sql);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(int $id, array $data)
    {
        return $this->model->update($id, $data);
    }

    public function delete(int $id)
    {
        return $this->model->delete($id);
    }
}
