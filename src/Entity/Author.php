<?php

namespace App\Entity;

use App\Repository\AuthorRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Table(name: 'author')]
#[ORM\Entity(repositoryClass: AuthorRepository::class)]
class Author
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255, nullable: false)]
    private string $firstName;

    #[ORM\Column(type: 'string', length: 255, nullable: false)]
    private string $lastName;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $middleName = null;

    #[ORM\ManyToMany(targetEntity: Book::class, inversedBy: "authors")]
    #[ORM\JoinTable(name: 'author_book')]
    private Collection $books;

    public function __construct()
    {
        $this->books = new ArrayCollection();
    }
    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    public function getBooks(): Collection
    {
        return $this->books;
    }

    public function addBook(Book $book): void
    {
        $book->addAuthor($this);
        
        $this->books[] = $book;
    }
}