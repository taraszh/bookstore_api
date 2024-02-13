<?php

namespace App\Controller;

use App\Model\CreateAuthorRequest;
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

    #[Route(path: '/api/author', name: 'author_post', methods: ['POST'])]
    public function createAuthor(
        #[MapRequestPayload] CreateAuthorRequest $createAuthorRequest
    ): JsonResponse {
        return $this->json($this->authorService->createAuthor($createAuthorRequest));
    }

    #[Route(path: '/api/authors/{page}', name: 'authors_get', requirements: ['page' => '\d+'], methods: ['GET'])]
    public function getAuthors(int $page = 1): JsonResponse
    {
        return $this->json($this->authorService->getAuthorsResponse($page));
    }
}