<?php

namespace App\DataFixtures;

use App\Entity\Author;
use App\Entity\Book;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AuthorBookFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 100; $i++) {
            $author = new Author();
            $author->setFirstName("author_$i");
            $author->setLastName("author_$i");

            $book = new Book();
            $book->setTitle("book_$i");
            $book->setPublicationDate(new \DateTime());

            $book->addAuthor($author);
            $author->addBook($book);

            $manager->persist($author);

            $manager->flush();
        }
    }
}
