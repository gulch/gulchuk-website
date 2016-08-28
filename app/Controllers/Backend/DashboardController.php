<?php

namespace Gulchuk\Controllers\Backend;

use Gulchuk\Controllers\BaseController;

class DashboardController extends BaseController
{
    public function index()
    {
        return $this->response($this->view('backend.dashboard'));
    }
}