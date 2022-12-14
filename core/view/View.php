<?php

namespace core\view;

use Twig\Loader\FilesystemLoader;
use Twig\Environment;

abstract class View
{
    protected string $templatePath;
    protected FilesystemLoader $loader;
    protected Environment $twig;

    public function __construct()
    {
        $this->loader = new FilesystemLoader(TEMPLATES_PATH);
        $this->twig = new Environment($this->loader, [
            'debug' => false,
            'charset' => 'UTF-8',
            'strict_variable' => false,
            'optimizations' => -1,
            'auto_reload' => true,
            'cache' => CACHE_PATH
        ]);
    }

    abstract public function render(string $template, $data = null): void;
}
