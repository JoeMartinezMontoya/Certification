<?php

class Home extends AbstractController
{
    /**
     * Homepage
     */
    public function index(): void
    {
        $this->render('home');
    }
}