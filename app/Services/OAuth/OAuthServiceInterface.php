<?php

namespace App\Services\OAuth;

interface OAuthServiceInterface
{
    public function authenticate(string $code): void;
}
