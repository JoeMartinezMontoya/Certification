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

            var_dump($title);
            if ($title !== "") {

                $title = htmlspecialchars($title);
                $title = $this->Article->normalize($title);
                $slug = str_replace(' ', '-', strtolower($title));

            } else {
                $errors['title'] = "Le titre est incorrect";
            }

            if ($content !== "") {

                $content = htmlspecialchars($content, ENT_QUOTES);

                if ($content <= 20) {
                    $errors['content'] = "Votre contenu doit faire 20 caractères au minimum";
                }

            } else {
                $errors['content'] = "Le contenu est incorrect";
            }

            $created_at = new DateTime();
            var_dump($content, $slug, $created_at, $errors);
        }
        $this->render('new');
    }


}