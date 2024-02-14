<?php

namespace App\Model;

readonly class UploadCoverResponse
{
    public function __construct(private string $link)
    {
    }

    public function getLink(): string
    {
        return $this->link;
    }
}