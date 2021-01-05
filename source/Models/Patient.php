<?php


namespace Source\Models;


use Source\Core\Model;

class Patient extends Model
{
    protected static $safe = ["id", "created_at", "updated_at"];

    private $table = "pacients";

    public function boostrap(string $name, string $age, string $email, string $symptoms, string $image = null): Patient
    {
        $this->name = $name;
        $this->age = $age;
        $this->symptoms = $symptoms;
        $this->email = $email;
        $this->image = $image;
        return $this;
    }

    public function find(string $terms, string $params, string $column = "*"): ?Patient
    {
        $find = $this->read("SELECT {$column} FROM {$this->table} WHERE {$terms}", $params);

        if ($this->fail() || !$find->rowCount()) {
            return null;
        }
        return $find->fetchObject(__CLASS__);
    }

    public function findById(int $id): ?Patient
    {
        return $this->find("id = :id", "id={$id}");
    }

    public function findByEmail(string $email): ?Patient
    {
        return $this->find("email = :email", "email={$email}");
    }

    public function all(int $limit = 30, int $offset = 0): ?array
    {
        $all = $this->read("SELECT * FROM {$this->table} LIMIT :limit OFFSET :offset", "limit={$limit}&offset={$offset}");

        if ($this->fail() || !$all->rowCount()) {
            return null;
        }

        return $all->fetchAll();
    }

    public function countAll(): ?int
    {
        $stmt = $this->read("SELECT * FROM {$this->table}");

        if ($this->fail()) {
            return null;
        }
        return $stmt->rowCount() ?? 0;

    }

    public function countAllWithoutAppointment(): ?int
    {
        $stmt = $this->read("SELECT * FROM {$this->table} WHERE appointment = 0");

        if ($this->fail()) {
            return null;
        }
        return $stmt->rowCount() ?? 0;

    }

    public function countAllWithAppointment(): ?int
    {
        $stmt = $this->read("SELECT * FROM {$this->table} WHERE appointment = 1");

        if ($this->fail()) {
            return null;
        }
        return $stmt->rowCount() ?? 0;

    }


    public function findAllWithAppointmentDone()
    {
        $stmt = $this->read("SELECT * FROM {$this->table} WHERE appointment = 1");
        if ($this->fail() || !$stmt->rowCount()) {
            return null;
        }
        return $stmt->fetchAll();
    }

    public function findAllWithoutAppointmentDone()
    {
        $stmt = $this->read("SELECT * FROM {$this->table} WHERE appointment = 0");
        if ($this->fail() || !$stmt->rowCount()) {
            return null;
        }
        return $stmt->fetchAll();

    }


    public function save()
    {
        if (!$this->required()) {
            return null;
        }
        // Criação de usuário

        if (empty($this->id)) {
            if ($this->findByEmail($this->email)) {
                $this->fail = new \PDOException();
                $this->message = "Email já está cadastrado em outro paciente";
                return null;
            }

            $userID = $this->create($this->table, $this->safe());
            if ($this->fail()) {
                $this->message = "Erro ao cadastrar verifique os dados";
                return null;
            }
            $this->message = "Paciente Registrado com sucesso";
        }
        // Update no usuário
        if (!empty($this->id)) {
            $userID = $this->id;
            if ($this->find("email = :email AND id != :id", "email={$this->email}&id={$userID}")) {
                $this->message = "Email já está cadastrado em outro paciente";
                return null;
            }

            $this->update($this->table, "id = :id", "id={$userID}", $this->safe());
            if ($this->fail()) {
                $this->message = "Erro ao atualizar";
                return null;
            }
        }
        $this->data = ($this->findByID($userID))->data();
        return $this;

    }

    private function required(): bool
    {
        if (empty($this->name || $this->age || $this->symptoms || $this->email)) {
            $this->fail = new \PDOException();
            $this->message = "Campos obrigatorios não inseridos";
            return false;
        }

        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $this->fail = new \PDOException();
            $this->message = "Formato de email não válido";
            return false;
        }

        return true;

    }
}