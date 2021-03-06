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

    public function findById(string $id)
    {
        $sql = "SELECT * FROM {$this->_table} WHERE id = '$id'";
        $query = $this->_connexion->prepare($sql);
        $query->execute();
        return $query->fetch();
    }

    public function findAllById(int $id)
    {
        $sql = "SELECT * FROM {$this->_table} WHERE author_id = '$id'";
        $query = $this->_connexion->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    /**
     * @param array $data
     * @return string|void
     */
    public function insertInto(array $data)
    {
        $title = $content = $created_at = $slug = $author_id = null;
        extract($data);
        try {
            $created_at = date_format($created_at, 'Y-m-d H:i:s');
            $sql = "
INSERT INTO articles (title, content, created_at, slug, author_id) 
VALUES (:title, :content, :created_at, :slug, :author_id)
";
            $query = $this->_connexion->prepare($sql);
            $query->bindParam(':title', $title, PDO::PARAM_STR);
            $query->bindParam(':content', $content, PDO::PARAM_STR);
            $query->bindParam(':created_at', $created_at, PDO::PARAM_STR);
            $query->bindParam(':slug', $slug, PDO::PARAM_STR);
            $query->bindParam(':author_id', $author_id, PDO::PARAM_INT);
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
        $id = $title = $content = $slug = null;
        extract($data);
        try {
            $updated_at = date_format(new DateTime(), 'Y-m-d H:i:s');
            $sql = "UPDATE articles SET title = :title, content = :content, updated_at = :updated_at, slug = :slug WHERE id = :id";
            $query = $this->_connexion->prepare($sql);
            $query->bindParam(':title', $title, PDO::PARAM_STR);
            $query->bindParam(':content', $content, PDO::PARAM_STR);
            $query->bindParam(':updated_at', $updated_at, PDO::PARAM_STR);
            $query->bindParam(':slug', $slug, PDO::PARAM_STR);
            $query->bindParam(':id', $id, PDO::PARAM_STR);
            $query->execute();
        } catch (PDOException $e) {
            return "Error" . $e->getMessage();
        }
    }

    public function deleteById(string $id)
    {
        $sql = "DELETE FROM articles WHERE id = :id";
        try {
            $query = $this->_connexion->prepare($sql);
            $query->bindParam(':id', $id, PDO::PARAM_STR);
            $query->execute();
        } catch (PDOException $e) {
            return "Error" . $e->getMessage();
        }
    }

    /**
     * Turns a string into a slug
     * @param string $subject
     * @return string
     */
    public function slugify(string $subject)
    {
        $unwanted_array = ['??' => 'S', '??' => 's', '??' => 'Z', '??' => 'z', '??' => 'A', '??' => 'A', '??' => 'A', '??' => 'A', '??' => 'A', '??' => 'A', '??' => 'A', '??' => 'C', '??' => 'E', '??' => 'E',
            '??' => 'E', '??' => 'E', '??' => 'I', '??' => 'I', '??' => 'I', '??' => 'I', '??' => 'N', '??' => 'O', '??' => 'O', '??' => 'O', '??' => 'O', '??' => 'O', '??' => 'O', '??' => 'U',
            '??' => 'U', '??' => 'U', '??' => 'U', '??' => 'Y', '??' => 'B', '??' => 'Ss', '??' => 'a', '??' => 'a', '??' => 'a', '??' => 'a', '??' => 'a', '??' => 'a', '??' => 'a', '??' => 'c',
            '??' => 'e', '??' => 'e', '??' => 'e', '??' => 'e', '??' => 'i', '??' => 'i', '??' => 'i', '??' => 'i', '??' => 'o', '??' => 'n', '??' => 'o', '??' => 'o', '??' => 'o', '??' => 'o',
            '??' => 'o', '??' => 'o', '??' => 'u', '??' => 'u', '??' => 'u', '??' => 'y', '??' => 'b', '??' => 'y'];
        $normalizedText = strtr($subject, $unwanted_array);
        $normalizedText = trim($normalizedText);
        $normalizedText = str_replace(["'", '"', '|', '`', '~', ' ', "!", '?', '#'], ['-', '-', '-', '-', '-', '-', '', '', ''], $normalizedText);
        return strtolower($normalizedText);
    }
}