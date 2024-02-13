<?php

namespace App\Service;

use App\Entity\Author;
use App\Entity\Book;
use App\Exception\AuthorAlreadyExistsException;
use App\Exception\InvalidAuthorException;
use App\Model\ResourceCreatedResponse;
use App\Repository\AuthorRepository;

class AuthorService
{
    public function __construct(private readonly AuthorRepository $authorRepository)
    {
    }

    public function createAuthor(Author $author): ResourceCreatedResponse
    {
        $isAuthorAlreadyExcist = $this->authorRepository->findOneBy([
                'firstName' => $author->getFirstName(),
                'lastName' => $author->getLastName()]
        );

        if ($isAuthorAlreadyExcist) {
            throw new AuthorAlreadyExistsException();
        }

        $this->authorRepository->save($author);

        return new ResourceCreatedResponse($author->getId());

    }

    public function getAuthors(array $authorsIds): array
    {
        return $this->authorRepository->findBy(['id' => $authorsIds]);
    }
}