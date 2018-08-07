<?php

namespace System;

/**
 * Class View
 *
 * @package Wardex\View
 */
class View
{
    private $extends;

    /**
     * @var array
     */
    private $blocks = [];

    /**
     * @var \SplStack
     */
    private $blockNames;

    /**
     * Путь до директории с шаблонами
     * @var string
     */
    private $path;

    /**
     * View constructor.
     *
     * @param string $path
     */
    public function __construct(string $path)
    {
        $this->path = $path;
        $this->blockNames = new \SplStack();
    }

    /**
     * @param string $name
     * @param array  $params
     *
     * @return string
     * @throws \Throwable
     */
    public function render($name, array $params = []): string
    {
        $level = ob_get_level();
        $this->extends = null;
        try {
            ob_start();
            extract($params, EXTR_OVERWRITE);
            /** @noinspection PhpIncludeInspection */
            require "{$this->path}/{$name}.php";
            $content = ob_get_clean();
        } catch (\Throwable $e) {
            while (ob_get_level() > $level) {
                ob_end_clean();
            }
            throw $e;
        }
        if (null === $this->extends) {
            return $content;
        }

        return $this->render($this->extends);
    }

    /**
     * @param string $view
     */
    public function extend($view): void
    {
        $this->extends = $view;
    }

    /**
     * @param $name
     * @param $content
     */
    public function block($name, $content): void
    {
        if ($this->hasBlock($name)) {
            return;
        }

        $this->blocks[$name] = $content;
    }

    /**
     * @param $name
     *
     * @return bool
     */
    public function ensure($name): bool
    {
        if ($this->hasBlock($name)) {
            return false;
        }
        $this->start($name);

        return true;
    }

    /**
     * @param $name
     */
    public function start($name): void
    {
        $this->blockNames->push($name);
        ob_start();
    }

    public function stop(): void
    {
        $content = ob_get_clean();
        $name = $this->blockNames->pop();
        if ($this->hasBlock($name)) {
            return;
        }

        $this->blocks[$name] = $content;
    }

    /**
     * @param $name
     *
     * @return string
     */
    public function renderBlock($name): string
    {
        return $this->blocks[$name] ?? '';
    }

    /**
     * @param $name
     *
     * @return bool
     */
    private function hasBlock($name): bool
    {
        return array_key_exists($name, $this->blocks);
    }
}
