<?php


namespace Source\Core;


use League\Plates\Engine;

class View
{
    private $plates;

    public function __construct(string $dir, string $ext = "php")
    {
        $this->plates = Engine::create($dir, $ext);
    }

    public function render(string $templateName, array $data)
    {
        return $this->plates->render($templateName,$data);
    }
}