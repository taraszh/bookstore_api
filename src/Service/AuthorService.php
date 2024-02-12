<?php

namespace App\Service;

use App\Entity\Author;
use App\Exception\AuthorAlreadyExistsException;
use App\Model\ResourceCreatedResponse;
use App\Repository\AuthorRepository;

class AuthorService
{
        public function __construct(private readonly AuthorRepository $authorRepository)
        {
        }
        
        public function createAuthor(Author $author)
        {
            $isAuthorAlreadyExcist = $this->authorRepository->findOneBy([
                'firstName' => $author->getFirstName(),
                'lastName' => $author->getLastName()]
            );

            if ($isAuthorAlreadyExcist) {
                return new AuthorAlreadyExistsException();
            }
            
            $this->authorRepository->save($author);
            
            return new ResourceCreatedResponse($author->getId());
            
        }
}