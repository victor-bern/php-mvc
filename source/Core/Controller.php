<?php


namespace Source\Core;


class Controller
{

    protected $view;

    public function __construct(string $dir = CONF_BASE_TEMPLATE, $ext = "php")
    {
        $this->view = new View($dir, $ext);
    }

}