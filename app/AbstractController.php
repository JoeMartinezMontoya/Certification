<?php

abstract class AbstractController
{
    /**
     * @param string $model
     */
    public function requireModel(string $model): void
    {
        require_once(ROOT . "model/$model.php");
        $this->$model = new $model();
    }

    /**
     * Captures datas, convert them into variables and send them to base.php
     * @param string $file
     * @param array $data
     */
    public function render(string $file, array $data = []): void
    {
        extract($data);
        ob_start();
        require_once(ROOT . 'view/' . strtolower(get_class($this)) . '/' . $file . '.php');
        $content = ob_get_clean();

        require_once(ROOT . 'view/base.php');
    }
}