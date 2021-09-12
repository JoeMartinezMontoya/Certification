<?php

abstract class DB
{
    private $_host = "localhost";
    private $_db_name = "certification";
    private $_username = "root";
    private $_password = "";
    private $_params = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ];

    protected $_connexion;

    public $_table;
    public $_id;

    public function databaseConnexion()
    {
        $this->_connexion = null;
        try {
            $this->_connexion = new PDO(
                "mysql:host={$this->_host};dbname={$this->_db_name}",
                $this->_username, $this->_password, $this->_params
            );
            $this->_connexion->exec('set names utf8');
        } catch (PDOException $exception) {
            echo "Erreur : {$exception->getMessage()}";
        }
    }

    public function getAll()
    {
        $sql = "SELECT * FROM {$this->_table}";
        $query = $this->_connexion->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    public function getOneById()
    {
        $sql = "SELECT * FROM {$this->_table} WHERE id = {$this->_id}";
        $query = $this->_connexion->prepare($sql);
        $query->execute();
        return $query->fetch();
    }
}