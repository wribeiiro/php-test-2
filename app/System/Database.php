<?php

declare(strict_types=1);

namespace App\System;

class Database
{

    protected $table;

    /**
     * @var \PDO
     */
    protected \PDO $connection;

    private static $instance = null;

    private function __clone()
    {

    }

    private function __construct(){

    }

    public function setConnection()
    {

    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            try {
                self::$instance = new PDO('mysql:host=' . HOST . ';dbname=' . NAME, USER, PASS);
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die('ERROR CATCH'. $e->getmessage());
            }
        }

        return self::$instance;
    }

    /**
     * Use to run a custom query
     *
     * @param string $sql
     * @return array
     */
    public function executeQuery(string $sql): array
    {
        $connection = self::getInstance();

        return $connection->query($sql)->fetchAll(\PDO::FETCH_CLASS, self::class);
    }

    /**
     * Generic get
     *
     * @return array
     */
    public function get(): array
    {
        $connection = self::getInstance();
        $sql = "SELECT * FROM {$this->table} ORDER BY id DESC";

        return $connection->query($sql)->fetchAll(\PDO::FETCH_CLASS, self::class);
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
        $connection = self::getInstance();

        if (!empty($table)) {
            $this->table = $table;
        }
        
        $fields = array_keys($data);
        $binds  = array_pad([], count($fields), '?');

        $sql = 'INSERT INTO ' .$this->table.' ('.implode(',', $fields).') VALUES ('.implode(',', $binds).')';
        $stm = $connection->prepare($sql);

        $stm->execute(array_values($data));

        return (int) $connection->lastInsertId();
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
        $connection = self::getInstance();
        $setFields = implode('=?, ', array_keys($data));

        $sql = "UPDATE {$this->table} SET {$setFields}=? WHERE id = {$id}";
        $stm = $connection->prepare($sql);

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
        $connection = self::getInstance();
        $query   = "DELETE FROM {$this->table} WHERE id = :id";
        $prepare = $connection->prepare($query);

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
        $connection = self::getInstance();
        $query   = "DELETE FROM sales_item WHERE sale_id = :saleId";
        $prepare = $connection->prepare($query);

        $prepare->bindValue(':saleId', $saleId);

        return $prepare->execute();
    }
}
