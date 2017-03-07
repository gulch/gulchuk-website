<?php

namespace Gulchuk\Controllers\Backend;

use Gulchuk\Controllers\BaseController;

class DashboardController extends BaseController
{
    public function index()
    {
        return $this->httpResponse($this->view('backend/dashboard'));
    }
}