<?php

namespace App\User\Dto;

class CreateUserDto
{
    public function __construct(
        public string $name,
        public string $email,
        public string $password
    ) {}
}