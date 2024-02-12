<?php

namespace App\Model;

class ResourceCreatedResponse
{
    public function __construct(private readonly int $id)
    {
    }

    public function getId(): int
    {
        return $this->id;
    }
}