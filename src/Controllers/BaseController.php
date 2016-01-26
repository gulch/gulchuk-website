<?php

namespace Gulchuk\Controllers;

use duncan3dc\Laravel\BladeInstance;

class BaseController
{
    protected $blade;

    public function __construct()
    {
        $this->blade = new BladeInstance(__DIR__ . '/../../views', __DIR__ . '/../../cache/views');
    }
}