<?php

class Administrator extends DB
{
    public function __construct()
    {
        $this->databaseConnexion();
    }

    public function getStats()
    {
        $sql = "SELECT 
                    (SELECT COUNT(id) FROM articles) articlesCount,
                    (SELECT COUNT(id) FROM users) usersCount
                FROM dual";
        $query = $this->_connexion->prepare($sql);
        $query->execute();
        return $query->fetch();
    }
}