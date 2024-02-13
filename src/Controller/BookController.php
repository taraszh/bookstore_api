<?php

namespace App\Controller;

use App\Model\CreateBookRequest;
use App\Model\PutBookRequest;
use App\Service\BookService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

class BookController extends AbstractController
{
    public function __construct(
        private readonly BookService $bookService,
    ) {
    }

    #[Route(path: '/api/book', name: 'book_post', methods: ['POST'])]
    public function createBook(#[MapRequestPayload] CreateBookRequest $createBookRequest): JsonResponse
    {
        return $this->json($this->bookService->createBook($createBookRequest));
    }

    #[Route(path: '/api/books/{page}', name: 'books_get', requirements: ['page' => '\d+'], methods: ['GET'])]
    public function getBooks(int $page = 1): JsonResponse
    {
        return $this->json($this->bookService->getBooksResponse($page));
    }

    #[Route(path: '/api/book/{id}', name: 'book_get', requirements: ['page' => '\d+'], methods: ['GET'])]
    public function getBook(int $id): JsonResponse
    {
        return $this->json($this->bookService->getBook($id));
    }

    #[Route(path: '/api/book/{id}', name: 'book_patch', requirements: ['page' => '\d+'], methods: ['PUT'])]
    public function updateBook(int $id, #[MapRequestPayload] PutBookRequest $putBookRequest): JsonResponse
    {
        $this->bookService->updateBook($id, $putBookRequest);

        return $this->json(null);
    }
}