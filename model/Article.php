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

    /**
     * @param array $data
     * @return string|void
     */
    public function insertInto(array $data)
    {
        extract($data);
        try {
            $created_at = date_format($created_at, 'Y-m-d H:i:s');
            $sql = "INSERT INTO articles (title, content, created_at, slug) VALUES (:title, :content, :created_at, :slug)";
            $query = $this->_connexion->prepare($sql);
            $query->bindParam(':title', $title, PDO::PARAM_STR);
            $query->bindParam(':content', $content, PDO::PARAM_STR);
            $query->bindParam(':created_at', $created_at, PDO::PARAM_STR);
            $query->bindParam(':slug', $slug, PDO::PARAM_STR);
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
        $unwanted_array = ['Š' => 'S', 'š' => 's', 'Ž' => 'Z', 'ž' => 'z', 'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A', 'Æ' => 'A', 'Ç' => 'C', 'È' => 'E', 'É' => 'E',
            'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ø' => 'O', 'Ù' => 'U',
            'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ý' => 'Y', 'Þ' => 'B', 'ß' => 'Ss', 'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a', 'æ' => 'a', 'ç' => 'c',
            'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i', 'ð' => 'o', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o',
            'ö' => 'o', 'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ý' => 'y', 'þ' => 'b', 'ÿ' => 'y'];
        $normalizedText = strtr($subject, $unwanted_array);
        $normalizedText = trim($normalizedText);
        $normalizedText = str_replace(["'", '"', '|', '`', '~', ' ', "!", '?', '#'], ['-', '-', '-', '-', '-', '-', '', '', ''], $normalizedText);
        return strtolower($normalizedText);
    }
}