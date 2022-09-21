<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $pseudo;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slugPseudo;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="datetime")
     */
    private $age;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $profile_picture;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="integer")
     */
    private $bookCount;

    /**
     * @ORM\Column(type="integer")
     */
    private $cdCount;

    /**
     * @ORM\Column(type="integer")
     */
    private $comicCount;

    /**
     * @ORM\Column(type="integer")
     */
    private $mangaCount;

    /**
     * @ORM\Column(type="integer")
     */
    private $lpCount;

    /**
     * @ORM\Column(type="integer")
     */
    private $bdCount;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    public function setPseudo(string $pseudo): self
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    public function getSlugPseudo(): ?string
    {
        return $this->slugPseudo;
    }

    public function setSlugPseudo(string $slugPseudo): self
    {
        $this->slugPseudo = $slugPseudo;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getAge(): ?string
    {
        return $this->age;
    }

    public function setAge(string $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getProfilePicture(): ?string
    {
        return $this->profile_picture;
    }

    public function setProfilePicture(string $profile_picture): self
    {
        $this->profile_picture = $profile_picture;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getBookCount(): ?int
    {
        return $this->bookCount;
    }

    public function setBookCount(int $bookCount): self
    {
        $this->bookCount = $bookCount;

        return $this;
    }

    public function getCdCount(): ?int
    {
        return $this->cdCount;
    }

    public function setCdCount(int $cdCount): self
    {
        $this->cdCount = $cdCount;

        return $this;
    }

    public function getComicCount(): ?int
    {
        return $this->comicCount;
    }

    public function setComicCount(int $comicCount): self
    {
        $this->comicCount = $comicCount;

        return $this;
    }

    public function getMangaCount(): ?int
    {
        return $this->mangaCount;
    }

    public function setMangaCount(int $mangaCount): self
    {
        $this->mangaCount = $mangaCount;

        return $this;
    }

    public function getLpCount(): ?int
    {
        return $this->lpCount;
    }

    public function setLpCount(int $lpCount): self
    {
        $this->lpCount = $lpCount;

        return $this;
    }

    public function getBdCount(): ?int
    {
        return $this->bdCount;
    }

    public function setBdCount(int $bdCount): self
    {
        $this->bdCount = $bdCount;

        return $this;
    }
}
