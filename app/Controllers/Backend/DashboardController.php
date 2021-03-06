<?php

namespace App\Controllers\Backend;

use App\Controllers\BaseController;
use Psr\Http\Message\ResponseInterface;

class DashboardController extends BaseController
{
    public function index(): ResponseInterface
    {
        return $this->httpResponse($this->view('backend/dashboard'));
    }
}
