<?php

namespace Source\Core;

use PDO;
use PDOException;

abstract class Model
{
    /**
     * @var PDO | null
     */
    private $db;
    /**
     * @var object | null
     */
    protected $data;
    /**
     * @var PDOException | null
     */
    protected $fail;
    /**
     * @var string | null
     */
    protected $message;

    public function data(): ?object
    {
        return $this->data;
    }

    public function message(): ?string
    {
        return $this->message;
    }

    public function fail(): ?PDOException
    {
        return $this->fail;
    }


    public function __set($name, $value)
    {
        if (empty($this->data)) {
            $this->data = new \stdClass();
        }

        return $this->data->$name = $value;
    }

    public function __get($name)
    {
        return ($this->data->$name ?? null);
    }

    public function __isset($name)
    {
        return isset($this->data->$name);
    }

    public function create(string $entity, array $data): ?int
    {
        try {
            $this->db = (new Db())->getDb();
            $keys = implode(",", array_keys($data));
            $values = ":" . implode(", :", array_keys($data));
            $stmt = $this->db->prepare("INSERT INTO {$entity} ({$keys}) VALUES ({$values})");
            $stmt->execute($this->filter($data));


        } catch (PDOException $exception) {
            $this->fail = $exception;
            return null;
        }
        return $this->db->lastInsertId();
    }

    public function read(string $sql, string $params = null)
    {
        try {
            $this->db = (new Db)->getDb();
            $stmt = $this->db->prepare($sql);
            if ($params) {
                parse_str($params, $params);
                foreach ($params as $key => $value) {
                    if ($key == 'limit' || $key == 'offset') {
                        $stmt->bindValue(":{$key}", $value, \PDO::PARAM_INT);
                    } else {
                        $stmt->bindValue(":{$key}", $value, \PDO::PARAM_STR);
                    }
                }
            }
            $stmt->execute();
            return $stmt;
        } catch (PDOException $exception) {
            $this->fail = $exception;
            return null;
        }


    }

    public function update(string $entity, string $terms, string $params, array $data): ?int
    {
        try {
            $this->db = (new Db())->getDb();
            $dataSet = [];
            foreach ($data as $key => $value) {
                $dataSet[] = "{$key} = :{$key}";
            }
            $dataSet = implode(", ", $dataSet);
            parse_str($params, $params);
            $stmt = $this->db->prepare("UPDATE {$entity} SET {$dataSet} WHERE {$terms}");
            $stmt->execute($this->filter(array_merge($data, $params)));

            return ($stmt->rowCount() ?? 1);
        } catch (PDOException $exception) {
            $this->fail = $exception;
            return null;
        }

    }

    public function delete(string $entity, string $terms, string $params)
    {
        try {
            $this->db = (new Db())->getDb();
            $stmt = $this->db->prepare("DELETE FROM {$entity} WHERE {$terms}");
            parse_str($params, $params);
            $stmt->execute($this->filter($params));

            return ($stmt->rowCount() ?? 1);
        } catch (\PDOException $exception) {
            $this->fail = $exception;
            return null;
        }

    }


    private function filter(array $data): array
    {
        $filter = [];
        foreach ($data as $key => $value) {
            $filter[$key] = (is_null($value) ? null : filter_var($value,
                FILTER_SANITIZE_SPECIAL_CHARS));
            if (is_numeric($value)) {
                $filter[$key] = filter_var($value,
                    FILTER_VALIDATE_INT);
            }
        }

        return $filter;
    }

    public function safe()
    {
        $safe = (array)$this->data;
        foreach (static::$safe as $item) {
            unset($safe[$item]);
        }
        return $safe;
    }
}