<?php

declare(strict_types=1);

namespace App\Model;

use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Constraints as Assert;


class UpdateBookRequest
{
    #[NotNull]
    #[Assert\Length(min: 1, max: 255)]
    public ?string $title;

    #[Assert\Length(min: 1, max: 255)]
    public ?string $description = null;

    public ?\DateTimeInterface $publicationDate = null;

    #[NotNull]
    #[NotBlank]
    public ?array $authorsIds = null;
}
