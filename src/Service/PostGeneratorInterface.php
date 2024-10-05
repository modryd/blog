<?php
// src/Service/PostGeneratorInterface.php

namespace App\Service;

interface PostGeneratorInterface
{
    public function generatePost(): array;
}