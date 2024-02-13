<?php

declare(strict_types=1);

namespace App\Model;

use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Constraints as Assert;


class CreateAuthorRequest
{
    #[NotNull]
    #[Assert\Length(min: 2, max: 255)]
    public string $firstName;

    #[NotNull]
    #[Assert\Length(min: 2, max: 255)]
    public string $lastName;

    #[Assert\Length(min: 2, max: 255)]
    public ?string $middleName = null;
}
