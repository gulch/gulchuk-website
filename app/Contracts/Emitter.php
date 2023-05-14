<?php

namespace App\Contracts;

use Psr\Http\Message\ResponseInterface;

interface Emitter
{
    /**
     * @param ResponseInterface $response 
     * @return mixed
     */
    public function emit(ResponseInterface $response);
}
