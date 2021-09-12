<?php

class Article extends DB
{
    public function __construct()
    {
        $this->_table = "articles";
        $this->databaseConnexion();
    }

    public function findBySlug(string $slug)
    {
        $sql = "SELECT * FROM {$this->_table} WHERE slug = '$slug'";
        $query = $this->_connexion->prepare($sql);
        $query->execute();
        return $query->fetch();
    }
}