<?php


namespace Source\Core;


class Db
{
    /**
     * @var \PDO
     *
     */
    private $db;

    public function __construct()
    {
        try {
            $this->db = new \PDO("mysql:Host=" . CONF_DB_HOST . ";dbname=" . CONF_DB_DBNAME, CONF_DB_USER, CONF_DB_PASSWD,
                [
                    \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ,
                    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                    \PDO::ATTR_CASE => \PDO::CASE_NATURAL
                ]);
        } catch (\PDOException $exception) {
            var_dump("faiou");
        }
    }


    public function getDb(): \PDO
    {
        return $this->db;
    }
}