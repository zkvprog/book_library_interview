<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\AuthorRepository;

/**
 * @ORM\Entity(repositoryClass=AuthorRepository::class)
 */
class Author
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", options={"unsigned": true})
     */
    private int $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    private string $name;

    /**
     * @var int
     *
     * @ORM\Column(type="smallint", options={"default" : 0, "unsigned": true})
     */
    private int $book_count = 0;


    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getBookCount(): ?int
    {
        return $this->book_count;
    }

    /**
     * @param int $bookCount
     * @return $this
     */
    public function setBookCount(int $bookCount): self
    {
        $this->book_count = $bookCount;
        return $this;
    }

    public function __toString(): string
    {
        return $this->name;
    }
}