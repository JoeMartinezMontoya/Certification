<?php

class Admin extends AbstractController
{
    /**
     * Dashboard
     */
    public function index(): void
    {
        $this->requireModel("Administrator");
        $stats = $this->Administrator->getStats();
        $this->render('dashboard',[
            'stats' => $stats
        ]);
    }

    public function articles()
    {
        $this->requireModel("Article");
        $articles = $this->Article->getAll();
        $this->render('articles', [
            'articles' => $articles
        ]);
    }

    public function users()
    {
        $this->requireModel("User");
        $users = $this->User->getAll();
        $this->render('users', [
            'users' => $users
        ]);
    }

    public function edit_user()
    {
        $this->requireModel("User");
        [, , $id] = explode('/', $_GET['p']);
        $user = $this->User->findById($id);

        if (!empty($_POST)) {
            $errors = [];
            $data = [];

            $data['id'] = $id;
            $data['username'] = $_POST['edit_user_username'];
            $data['role'] = isset($_POST['edit_user_role']) && $_POST['edit_user_role'] === 'on' ? 2 : 1;

            if (empty(trim($data['username']))) {
                $errors['username'] = 'Votre pseudo ne peut être vide';
            } elseif (!preg_match('/^[\w]+$/', trim($data['username']))) {
                $errors['username'] = 'Votre pseudo ne peut contenir que des lettres, des chiffres et des underscores';
            } else {
                $data['username'] = trim($data['username']);
            }

            $success = true;

            try {
                $this->User->update($data);
            } catch (Exception $e) {
                echo "Error" . $e->getMessage();
                $success = false;
            }

            if ($success) {
                header("Location: /lab/Certification/admin/users", 301);
                exit();
            }
        }

        $this->render('edit_user', [
            'user' => $user
        ]);
    }
}