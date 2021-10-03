<?php

class User extends DB
{
    public function __construct()
    {
        $this->_table = "users";
        $this->databaseConnexion();
    }

    public function findById(string $id)
    {
        $sql = "SELECT * FROM {$this->_table} WHERE id = '$id'";
        $query = $this->_connexion->prepare($sql);
        $query->execute();
        return $query->fetch();
    }

    public function findByMail(string $mail)
    {
        $sql = "SELECT * FROM {$this->_table} WHERE mail = '$mail'";
        $query = $this->_connexion->prepare($sql);
        $query->execute();
        return $query->fetch();
    }

    /**
     * @param array $data
     * @return string|void
     */
    public function insertInto(array $data)
    {
        $mail = $username = $password = $created_at = null;
        extract($data);
        try {
            $created_at = date_format(new DateTime(), 'Y-m-d H:i:s');
            $sql = "INSERT INTO users (mail, username, password, created_at) VALUES (:mail, :username, :password, :created_at)";
            $query = $this->_connexion->prepare($sql);
            $query->bindParam(':mail', $mail, PDO::PARAM_STR);
            $query->bindParam(':username', $username, PDO::PARAM_STR);
            $query->bindParam(':password', $password, PDO::PARAM_STR);
            $query->bindParam(':created_at', $created_at, PDO::PARAM_STR);
            $query->execute();
        } catch (PDOException $e) {
            return "Error" . $e->getMessage();
        }
    }

    /**
     * @param array $data
     * @return string|void
     */
    public function update(array $data)
    {
        $username = $password = $id = null;
        extract($data);
        try {
            $updated_at = date_format(new DateTime(), 'Y-m-d H:i:s');
            $sql = "UPDATE users SET username = :username, password = :password WHERE id = :id";
            $query = $this->_connexion->prepare($sql);
            $query->bindParam(':username', $username, PDO::PARAM_STR);
            $query->bindParam(':password', $password, PDO::PARAM_STR);
            $query->bindParam(':id', $id, PDO::PARAM_STR);
            $query->execute();
        } catch (PDOException $e) {
            return "Error" . $e->getMessage();
        }
    }

    public function deleteById(string $id)
    {
        $sql = "DELETE FROM users WHERE id = :id";
        try {
            $query = $this->_connexion->prepare($sql);
            $query->bindParam(':id', $id, PDO::PARAM_STR);
            $query->execute();
        } catch (PDOException $e) {
            return "Error" . $e->getMessage();
        }
        return true;
    }

}