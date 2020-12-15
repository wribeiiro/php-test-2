<?php

namespace App\Services;

use App\System\Controller;
use App\Repositories\SalesRepository;
use App\Validations\SalesValidation;
use App\Validations\SalesItemValidation;

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

        $items = $data["items"];

        unset($data["items"]);

        $result = $this->sales_repository->create($data);

        if ($result > 0) {
            foreach ($items as $item) {
                $item["sale_id"] = $result;
    
                $this->sales_repository->createItem($item);
            }
        }

        return $result;
    }

    public function createItem(array $data) {

        $this->validate = (new SalesItemValidation())->makeValidation($data);

        if ($this->validate !== null) {
            return $this->validate;
        }

        $result = $this->sales_repository->createItem($data);

        return $result;
    }

    public function update(array $data, int $id) {
        $this->validate = (new SalesValidation())->makeValidation($data);

        if ($this->validate !== null) {
            return $this->validate;
        }

        try {
            $sale = $this->sales_repository->update($id, $data);
        } catch (\Exception $e) {
            $sale = $e->getMessage();
        }

        return $sale;
    }

    public function delete(int $id) {
        try {
            $sale = $this->sales_repository->delete($id);
            $this->sales_repository->deleteItem($id);
        } catch (\Exception $e) {
            $sale = $e->getMessage();
        }

        return $sale;
    }
}
