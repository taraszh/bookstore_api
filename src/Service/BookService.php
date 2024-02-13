<?php

namespace App\Service;

use App\Entity\Author;
use App\Entity\Book;
use App\Exception\BookAlreadyExistsException;
use App\Exception\InvalidAuthorException;
use App\Model\BookListItem;
use App\Model\BookListResponse;
use App\Model\CreateBookRequest;
use App\Model\ResourceCreatedResponse;
use App\Repository\BookRepository;

class BookService
{
    public function __construct(
        private readonly BookRepository $bookRepository,
        private readonly AuthorService  $authorService
    ) {
    }

    public function createBook(CreateBookRequest $createBookRequest): ResourceCreatedResponse
    {
        $this->validateBook($createBookRequest);

        $book = $this->getBook($createBookRequest);

        $this->bookRepository->save($book);

        return new ResourceCreatedResponse($book->getId());
    }

    public function getBook(CreateBookRequest $createBookRequest): Book
    {
        $book = new Book();
        $book->setTitle($createBookRequest->title);
        $book->setDescription($createBookRequest->description);
        $book->setPublicationDate($createBookRequest->publicationDate);

        $authors = $this->getAuthors($createBookRequest);

        /** @var Author[] $authors */
        foreach ($authors as $author) {
            $book->addAuthor($author);
        }

        return $book;
    }

    private function getAuthors(CreateBookRequest $createBookRequest): array
    {
        $authorsIds = $createBookRequest->authorsIds;
        $authors = $this->authorService->getAuthors($authorsIds);

        if (count($authorsIds) !== count($authors)) {
            throw new InvalidAuthorException();
        }

        return $authors;
    }

    /**
     * @param CreateBookRequest $createBookRequest
     * @return void
     */
    private function validateBook(CreateBookRequest $createBookRequest): void
    {
        $bookExists = $this->bookRepository->findOneBy(['title' => $createBookRequest->title]);
        if ($bookExists) {
            throw new BookAlreadyExistsException();
        }
    }

    public function getBooksResponse(int $page): BookListResponse
    {
        $books = $this->bookRepository->findBy(
            criteria: [],
            offset: PaginationUtils::calculateOffset($page, BookListResponse::MAX_ITEMS_PER_PAGE)
        );
        
        return new BookListResponse(
            array_map(
                $this->mapBook(...),
                $books
            )
        );
    }
    
    private function mapBook(Book $book): BookListItem
    {
        $item = new BookListItem();
        
        $item->setId($book->getId());
        $item->setTitle($book->getTitle());
        $item->setDescription($book->getDescription());

        if ($book->getPublicationDate()) {
            $item->setPublicationDate($book->getPublicationDate()->format('Y-m-d'));
        }
        
        foreach ($book->getAuthors() as $author) {
            $authors[] = $this->authorService->mapAuthor($author);
        }
        
        $item->setAuthors($authors);
        
        return $item;
    }
}