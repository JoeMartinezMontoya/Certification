<?php

abstract class AbstractController
{
    public function requireModel(string $model)
    {
        require_once(ROOT . "model/$model.php");
        $this->$model = new $model();
    }

    public function render(string $file, array $data = [])
    {
        extract($data);
        ob_start();
        require_once(ROOT . 'view/' . strtolower(get_class($this)) . '/' . $file . '.php');
        $content = ob_get_clean();

        require_once(ROOT . 'view/base.php');
    }
}