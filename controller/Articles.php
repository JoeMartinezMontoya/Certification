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

        //If the content is too long, add a short sample of the string
        foreach ($articles as $k => $v) {
            $tempContent = $v['content'];
            if (strlen($tempContent) >= 30) {
                $articles[$k]['excerpt'] = substr($tempContent, 0, 30) . '...';
            } else {
                $articles[$k]['excerpt'] = $v['content'];
            }
        }

        $this->render('index', [
            'articles' => $articles
        ]);
    }

    /**
     * Listing of all the current user articles
     */
    public function user_index()
    {
        $this->requireModel("Article");
        $articles = $this->Article->findAllById((int)$_SESSION['id']);

        //If the content is too long, add a short sample of the string
        foreach ($articles as $k => $v) {
            $tempContent = $v['content'];
            if (strlen($tempContent) >= 30) {
                $articles[$k]['excerpt'] = substr($tempContent, 0, 30) . '...';
            } else {
                $articles[$k]['excerpt'] = $v['content'];
            }
        }

        $this->render('user_index', [
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

        //Simplified date
        $article['created_at'] = date('d/m/Y', strtotime($article['created_at']));
        if ($article['updated_at'] !== null) {
            $article['updated_at'] = date('d/m/Y', strtotime($article['updated_at']));
        }

        $this->render('show', [
            'article' => $article
        ]);
    }

    /**
     * Create one article
     */
    public function new(): void
    {
        $content = $title = $created_at = $slug = $author_id = null;
        if (!empty($_POST)) {
            $this->requireModel("Article");
            $errors = [];

            extract($_POST);

            if ($title !== '') {
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

            if ($content !== '') {
                $content = htmlspecialchars($content, ENT_QUOTES);
                if (strlen($content) <= 20) {
                    $errors['content'] = "Votre contenu doit faire 20 caractères au minimum";
                }
            } else {
                $errors['content'] = "Le contenu est incorrect";
            }

            $created_at = new DateTime();
            $author_id = $_SESSION['id'];

            if (empty($errors)) {
                $data = [
                    'title' => $title,
                    'content' => $content,
                    'created_at' => $created_at,
                    'slug' => $slug,
                    'author_id' => $author_id
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

    /**
     * Edit one article
     */
    public function edit()
    {
        $this->requireModel("Article");
        [, , , $id] = explode('/', $_GET['p']);
        $article = $this->Article->findById($id);

        if (!empty($_POST)) {
            $errors = [];

            extract($_POST);

            if ($title !== '') {
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

            if ($content !== '') {
                $content = htmlspecialchars($content, ENT_QUOTES);
                if (strlen($content) <= 20) {
                    $errors['content'] = "Votre contenu doit faire 20 caractères au minimum";
                }
            } else {
                $errors['content'] = "Le contenu est incorrect";
            }

            if (empty($errors)) {
                $data = [
                    'id' => $id,
                    'title' => $title,
                    'content' => $content,
                    'slug' => $slug
                ];

                $success = true;
                try {
                    $this->Article->update($data);
                } catch (Exception $e) {
                    echo "Error" . $e->getMessage();
                    $success = false;
                }

                if ($success) {
                    header("Location: /lab/Certification/articles/show/$slug", false, 301);
                    exit();
                }
            }else{
                var_dump($errors);
            }
        }

        $this->render('edit', [
            'article' => $article
        ]);
    }

    /**
     * Delete one article
     */
    public function delete()
    {
        [ , , $id] = explode('/', $_GET['p']);
        $this->requireModel("Article");
        $article = $this->Article->findById($id);
        $errors = [];
        if (!$article) {
            $errors[] = "Cet article n'existe pas";
        }else{
            $this->Article->deleteById($id);
            header("Location: /lab/Certification/articles", false, 301);
            exit();
        }
    }
}