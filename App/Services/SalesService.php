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

    public function getSales() {
        return $this->sales_repository->get();
    }

    public function getSale(int $id) {
        return $this->sales_repository->get($id);
    }

    public function create(array $data) {

        $this->validate = (new SalesValidation)->makeValidation($data);

        if ($this->validate !== null) {
            return $this->validate;
        }

        $result = $this->sales_repository->create($data);

        return $result;
    }

    public function update(array $data, int $id) {
        $this->validate = (new SalesValidation)->makeValidation($data);

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
        } catch (\Exception $e) {
            $sale = $e->getMessage();
        }

        return $sale;
    }
}
