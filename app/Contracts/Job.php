<?php

namespace App\Contracts;

interface Job
{
    public function handle(array $options): void;
}
