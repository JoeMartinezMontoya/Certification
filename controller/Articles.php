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

    public function create()
    {
        
    }
}