<?php

declare(strict_types=1);

namespace App\Exception;

use Symfony\Component\HttpFoundation\Response;

class BookExistsException extends \RuntimeException
{
    public function __construct()
    {
        parent::__construct('book already exists', Response::HTTP_CONFLICT);
    }
}
