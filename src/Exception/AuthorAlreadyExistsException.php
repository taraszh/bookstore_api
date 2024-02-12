<?php

declare(strict_types=1);

namespace App\Exception;

use Symfony\Component\HttpFoundation\Response;

class AuthorAlreadyExistsException extends \RuntimeException
{
    public function __construct()
    {
        parent::__construct('author already exists', Response::HTTP_CONFLICT);
    }
}
