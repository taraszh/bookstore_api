<?php

namespace App\Service;

use App\Entity\Author;
use App\Entity\Book;
use App\Exception\AuthorExistsException;
use App\Exception\InvalidAuthorException;
use App\Model\AuthorListItem;
use App\Model\AuthorListResponse;
use App\Model\CreateAuthorRequest;
use App\Model\ResourceCreatedResponse;
use App\Repository\AuthorRepository;

class AuthorService
{
    public function __construct(private readonly AuthorRepository $authorRepository)
    {
    }

    public function createAuthor(CreateAuthorRequest $createAuthorRequest): ResourceCreatedResponse
    {
        $this->validateAuthor($createAuthorRequest);
        $author = $this->getAuthor($createAuthorRequest);
        
        $this->authorRepository->save($author);

        return new ResourceCreatedResponse($author->getId());
    }
    
    public function getAuthors(array $authorsIds): array
    {
        return $this->authorRepository->findBy(['id' => $authorsIds]);
    }

    private function getAuthor(CreateAuthorRequest $createAuthorRequest): Author
    {
        $author = new Author();
        $author->setFirstName($createAuthorRequest->firstName);
        $author->setLastName($createAuthorRequest->lastName);
        $author->setMiddleName($createAuthorRequest->middleName);

        return $author;
    }

    private function validateAuthor(CreateAuthorRequest $createAuthorRequest): void
    {
        $authorExists = $this->authorRepository->findOneBy([
            'firstName' => $createAuthorRequest->firstName,
            'lastName' => $createAuthorRequest->lastName
        ]);

        if ($authorExists) {
            throw new AuthorExistsException();
        }
    }

    public function getAuthorsResponse(int $page): AuthorListResponse
    {
        $authors = $this->authorRepository->findBy(
            criteria: [],
            offset: PaginationUtils::calculateOffset($page, AuthorListResponse::MAX_ITEMS_PER_PAGE)
        );
        
        return new AuthorListResponse(
            array_map(
                $this->mapAuthor(...),
                $authors
            )
        );
    }
    
    public function mapAuthor(Author $author): AuthorListItem
    {
        $item = new AuthorListItem();
        
        $item->setId($author->getId());
        $item->setFirstName($author->getFirstName());
        $item->setLastName($author->getLastName());
        $item->setMiddleName($author->getMiddleName());
        
        return $item;
    }
}