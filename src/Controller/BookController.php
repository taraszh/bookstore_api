<?php

namespace App\Controller;

use App\Model\CreateBookRequest;
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
}