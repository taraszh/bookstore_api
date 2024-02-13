<?php

declare(strict_types=1);

namespace App\Exception;

use Symfony\Component\HttpFoundation\Response;

class InvalidAuthorException extends \RuntimeException
{
    public function __construct()
    {
        parent::__construct('invalid author', Response::HTTP_BAD_REQUEST);
    }
}
