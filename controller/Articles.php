<?php

class Articles extends AbstractController
{
    /**
     * Listing of all the articles
     */
    public function index()
    {
        $this->requireModel("Article");
        $articles = $this->Article->getAll();

        $this->render('index', [
            'articles' => $articles
        ]);
    }

    /**
     * Display one specific article
     * @param string $slug
     */
    public function show(string $slug)
    {
        $this->requireModel("Article");
        $article = $this->Article->findBySlug($slug);

        $this->render('show', [
            'article' => $article
        ]);
    }


    /**
     * Create one article
     */
    public function new()
    {
        if (!empty($_POST)) {

            $this->requireModel("Article");
            $errors = [];

            extract($_POST);

            if ($title !== "") {
                $min = 2;
                $max = 40;
                if (strlen($title) <= $min || strlen($title) >= $max) {
                    $errors['title'] = "Le titre ne peut contenir moins de $min ou plus de $max caractères";
                } else {
                    $title = htmlspecialchars($title);
                    $slug = $this->Article->slugify($title);
                }
            } else {
                $errors['title'] = "Le titre ne peut être vide";
            }

            if ($content !== "") {

                $content = htmlspecialchars($content, ENT_QUOTES);
                if (strlen($content) <= 20) {
                    $errors['content'] = "Votre contenu doit faire 20 caractères au minimum";
                }
            } else {
                $errors['content'] = "Le contenu est incorrect";
            }
            $created_at = new DateTime();

            if (empty($errors)) {
                $data = [
                    'title' => $title,
                    'content' => $content,
                    'created_at' => $created_at,
                    'slug' => $slug
                ];
                $success = true;
                try {
                    $this->Article->insertInto($data);
                } catch (Exception $e) {
                    echo "Error" . $e->getMessage();
                    $success = false;
                }

                if ($success) {
                    header("Location: /lab/Certification/articles/show/$slug", false, 301);
                    exit();
                }

            } else {
                var_dump($errors);
            }
        }
        $this->render('new');
    }
}