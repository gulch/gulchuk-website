<?php

namespace gulch\Assets;

use gulch\Assets\Renderer\RendererInterface;

class Asset
{
    private $renderer;
    private $assets = [];

    public function __construct(RendererInterface $renderer)
    {
        $this->renderer = $renderer;
    }

    public function add(string $asset): Asset
    {
        $this->assets[] = $asset;

        return $this;
    }

    public function render()
    {
        return $this->renderer->render($this->assets);
    }

    public function __toString()
    {
        return $this->render();
    }
}