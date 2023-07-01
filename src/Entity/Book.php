<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\BookRepository;

/**
 * @ORM\Entity(repositoryClass=BookRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class Book
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
     * @ORM\ManyToMany(targetEntity="App\Entity\Author", inversedBy="books")
     */
    private $author;

    /**
     * @var string
     *
     * @ORM\Column(type="text")
     */
    private string $description;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    private string $image;

    public function __construct()
    {
        $this->author = new ArrayCollection();
    }

    /**
     * @var int
     *
     * @ORM\Column(type="smallint")
     */
    private int $year;

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
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return $this
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return Collection
     */
    public function getAuthor(): ?Collection
    {
        return $this->author;
    }

    /**
     * @param Author $author
     * @return $this
     */
    public function addAuthor(Author $author): self
    {
        if (!$this->author->contains($author)) {
            $this->author[] = $author;
        }

        return $this;
    }

    /**
     * @param Author $author
     * @return $this
     */
    public function removeAuthor(Author $author): self
    {
        $this->author->removeElement($author);

        return $this;
    }

    /**
     * @return string|null
     */
    public function getImage(): ?string
    {
        return $this->image;
    }

    /**
     * @param string $image
     * @return $this
     */
    public function setImage(string $image): self
    {
        $this->image = $image;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getYear(): ?int
    {
        return $this->year;
    }

    /**
     * @param int $year
     * @return $this
     */
    public function setYear(int $year): self
    {
        $this->year = $year;
        return $this;
    }
}