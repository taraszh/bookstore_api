<?php

namespace App\Controller;

use App\Entity\Author;
use App\Model\ResourceCreatedResponse;
use App\Service\AuthorService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

class AuthorController extends AbstractController
{
    public function __construct(private readonly AuthorService $authorService)
    {
    }

    #[Route(path: '/api/author', name: 'author_create', methods: ['POST'])]
    public function createAuthor(
        #[MapRequestPayload] Author $author
    ): JsonResponse
    {
        return $this->json($this->authorService->createAuthor($author));
    }
}