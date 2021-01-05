<?php

declare(strict_types=1);

namespace App\System;

class Database
{

    /**
     * @var \PDO
     */
    protected $conn;

    /**
     * @var string
     */
    protected $table;

    public function __construct()
    {
        $this->setConnection();
    }

    /**
     * Create a connection with database
     *
     * @return void
     */
    private function setConnection(): void
    {
        try {
            $this->conn = new \PDO(DATABASE['dbdriver'] . ":host=" . DATABASE['hostname'] . ";port=" . DATABASE['port']  . ";dbname=" . DATABASE['database'], DATABASE['username'], DATABASE['password']);

            $this->conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $except) {
            die($except->getCode() .  " - " .$except->getMessage());
        }
    }

    /**
     * Use to run a custom query
     *
     * @param string $sql
     * @return array
     */
    public function executeQuery(string $sql): array
    {
        return $this->conn->query($sql)->fetchAll(\PDO::FETCH_CLASS, self::class);
    }

    /**
     * Generic get
     *
     * @return array
     */
    public function get(): array
    {
        $sql = "SELECT * FROM {$this->table} ORDER BY id DESC";

        return $this->conn->query($sql)->fetchAll(\PDO::FETCH_CLASS, self::class);
    }

    /**
     * Generic create
     *
     * @param array $data
     * @param string $table
     * @return int
     */
    public function create(array $data, string $table = ""): int
    {
        if (!empty($table)) {
            $this->table = $table;
        }
        
        $fields = array_keys($data);
        $binds  = array_pad([], count($fields), '?');

        $sql = 'INSERT INTO ' .$this->table.' ('.implode(',', $fields).') VALUES ('.implode(',', $binds).')';
        $stm = $this->conn->prepare($sql);

        $stm->execute(array_values($data));

        return (int) $this->conn->lastInsertId();
    }

    /**
     * Generic update
     *
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update(int $id, array $data): bool
    {
        $setFields = implode('=?, ', array_keys($data));

        $sql = "UPDATE {$this->table} SET {$setFields}=? WHERE id = {$id}";
        $stm = $this->conn->prepare($sql);

        return $stm->execute(array_values($data));
    }

    /**
     * Generic delete
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $query   = "DELETE FROM {$this->table} WHERE id = :id";
        $prepare = $this->conn->prepare($query);

        $prepare->bindValue(':id', $id);

        return $prepare->execute();
    }

    /**
     * Used only sales
     *
     * @param int $saleId
     * @return bool
     */
    public function deleteItem(int $saleId): bool
    {
        $query   = "DELETE FROM sales_item WHERE sale_id = :saleId";
        $prepare = $this->conn->prepare($query);

        $prepare->bindValue(':saleId', $saleId);

        return $prepare->execute();
    }
}
