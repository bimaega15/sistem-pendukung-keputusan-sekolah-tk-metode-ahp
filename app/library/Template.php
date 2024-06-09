<?php

class Template
{
    private $data = [];

    public function __construct()
    {
    }

    public function assign($key, $value)
    {
        $this->data[$key] = $value;
    }

    public function display($templateFile)
    {
        extract($this->data);
        ob_start();
        require_once $templateFile;
        $output = ob_get_clean();
        echo $output;
    }
}
