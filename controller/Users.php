<?php

class Users extends AbstractController
{
    /**
     * Add User
     */
    public function register()
    {
        if (!empty($_POST)) {
            $username = $password = $mail = $confirm_password = "";
            $errors = [];

            extract($_POST);

            if (empty(trim($mail))) {
                $errors['mail'] = 'Votre mail ne peut être vide';
            } else {
                $mail = trim($mail);
            }

            if (empty(trim($username))) {
                $errors['username'] = 'Votre pseudo ne peut être vide';
            } elseif (!preg_match('/^[\w]+$/', trim($username))) {
                $errors['username'] = 'Votre pseudo ne peut contenir que des lettres, des chiffres et des underscores';
            } else {
                $username = trim($username);
            }

            $min = 6;
            if (empty(trim($password))) {
                $errors['password'] = 'Veuillez entrer un mot de passe';
            } elseif (strlen(trim($password)) <= $min) {
                $errors['password'] = "Votre mot de passe doit contenir au minimum $min caractères";
            } else {
                $password = trim($password);
            }

            if (empty(trim($confirm_password))) {
                $errors['confirm_password'] = 'Veuillez confirmer votre mot de passe';
            } else {
                $confirm_password = trim($confirm_password);
                if (empty($errors['confirm_password']) && ($password !== $confirm_password)) {
                    $errors['confirm_password'] = 'Les mots de passe doivent être identique';
                }
            }

            if (empty($errors)) {
                $password = password_hash($password, PASSWORD_BCRYPT);
                $data = [
                    'mail' => $mail,
                    'username' => $username,
                    'password' => $password
                ];
                $this->requireModel("User");
                try {
                    $this->User->insertInto($data);
                    header("Location: /lab/Certification/", false, 301);
                    exit();
                } catch (Exception $e) {
                    echo $e->getMessage();
                }
            } else {
                print_r($errors);
            }
        }
        $this->render('register');
    }

    public function login()
    {
        if (!empty($_POST)) {
            $mail = $password = "";
            $errors = [];

            extract($_POST);

            $this->requireModel("User");

            if (trim($mail) !== "" && filter_var($mail, FILTER_VALIDATE_EMAIL) !== false) {
                $user = $this->User->findByMail($mail);
            } else {
                $errors['mail'] = "Mail invalide";
            }

            if (password_verify($password, $user['password']) === true) {
                session_start();
                $_SESSION['id'] = $user['id'];
                $_SESSION['mail'] = $user['mail'];
                $_SESSION['username'] = $user['username'];

                header("Location: /lab/Certification/", false, 301);
                exit();
            }
        }
        $this->render('login');
    }

    public function logout()
    {
        $this->render('logout');
    }
}