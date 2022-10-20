<?php

namespace App\Entity;

use App\Repository\UserRepository;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\Ignore;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 */
class User implements UserInterface, PasswordAuthenticatedUserInterface, \Serializable
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * 
     * 
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * 
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     * 
     * 
     */
    private $roles = ["ROLE_USER"];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     * 
     * 
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $pseudo;


    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $profilePicture;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $bookCount;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $bdCount;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $comicsCount;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $mangaCount;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $cdCount;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $lpCount;

    /**
     * @ORM\Column(type="datetime_immutable", options={"default":"CURRENT_TIMESTAMP"})
     */
    private $createdAt;

    /**
     * @ORM\ManyToMany(targetEntity=Book::class, inversedBy="users")
     */
    private $book;

    /**
     * @ORM\ManyToMany(targetEntity=Bd::class, inversedBy="users")
     */
    private $bd;

    /**
     * @ORM\ManyToMany(targetEntity=Comic::class, inversedBy="users")
     */
    private $comic;

    /**
     * @ORM\ManyToMany(targetEntity=Manga::class, inversedBy="users")
     */
    private $manga;

    /**
     * @ORM\ManyToMany(targetEntity=Cd::class, inversedBy="users")
     */
    private $cd;

    /**
     * @ORM\ManyToMany(targetEntity=Lp::class, inversedBy="users")
     */
    private $lp;

    public function __construct()
    {

        $this->createdAt = new \DateTimeImmutable();
        $this->book = new ArrayCollection();
        $this->Bd = new ArrayCollection();
        $this->Comic = new ArrayCollection();
        $this->Manga = new ArrayCollection();
        $this->cd = new ArrayCollection();
        $this->lp = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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


    public function getProfilePicture(): ?string
    {
        return $this->profilPicture;
    }

    public function setProfilePicture(?string $profilePicture): self
    {
        $this->profilePicture = $profilePicture;

        return $this;
    }

    public function getBookCount(): ?int
    {
        return $this->bookCount;
    }

    public function setBookCount(?int $bookCount): self
    {
        $this->bookCount = $bookCount;

        return $this;
    }

    public function getBdCount(): ?int
    {
        return $this->bdCount;
    }

    public function setBdCount(?int $bdCount): self
    {
        $this->bdCount = $bdCount;

        return $this;
    }

    public function getComicsCount(): ?int
    {
        return $this->comicsCount;
    }

    public function setComicsCount(?int $comicsCount): self
    {
        $this->comicsCount = $comicsCount;

        return $this;
    }

    public function getMangaCount(): ?int
    {
        return $this->mangaCount;
    }

    public function setMangaCount(?int $mangaCount): self
    {
        $this->mangaCount = $mangaCount;

        return $this;
    }

    public function getCdCount(): ?int
    {
        return $this->cdCount;
    }

    public function setCdCount(?int $cdCount): self
    {
        $this->cdCount = $cdCount;

        return $this;
    }

    public function getLpCount(): ?int
    {
        return $this->lpCount;
    }

    public function setLpCount(?int $lpCount): self
    {
        $this->lpCount = $lpCount;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->CreatedAt;
    }

    public function setCreatedAt(\DateTimeImmutable $CreatedAt): self
    {
        $this->CreatedAt = $CreatedAt;

        return $this;
    }

    /**
     * @return Collection<int, Book>
     */
    public function getBook(): Collection
    {
        return $this->book;
    }

    public function addBook(Book $book): self
    {
        if (!$this->book->contains($book)) {
            $this->book[] = $book;
        }

        return $this;
    }

    public function removeBook(Book $book): self
    {
        $this->book->removeElement($book);

        return $this;
    }

    /**
     * @return Collection<int, Bd>
     */
    public function getBd(): Collection
    {
        return $this->bd;
    }

    public function addBd(Bd $bd): self
    {
        if (!$this->bd->contains($bd)) {
            $this->bd[] = $bd;
        }

        return $this;
    }

    public function removeBd(Bd $bd): self
    {
        $this->bd->removeElement($bd);

        return $this;
    }

    /**
     * @return Collection<int, Comic>
     */
    public function getComic(): Collection
    {
    return $this->comic;
}

    public function addComic(Comic $comic): self
    {
        if (!$this->comic->contains($comic)) {
            $this->comic[] = $comic;
        }

        return $this;
    }

    public function removeComic(Comic $comic): self
    {
        $this->comic->removeElement($comic);

        return $this;
    }

    /**
     * @return Collection<int, Manga>
     */
    public function getManga(): Collection
    {
    return $this->manga;
}

    public function addManga(Manga $manga): self
    {
        if (!$this->manga->contains($manga)) {
            $this->manga[] = $manga;
        }

        return $this;
    }

    public function removeManga(Manga $manga): self
    {
        $this->manga->removeElement($manga);

        return $this;
    }

    /**
     * @return Collection<int, Cd>
     */
    public function getCd(): Collection
    {
        return $this->cd;
    }

    public function addCd(Cd $cd): self
    {
        if (!$this->cd->contains($cd)) {
            $this->cd[] = $cd;
        }

        return $this;
    }

    public function removeCd(Cd $cd): self
    {
        $this->cd->removeElement($cd);

        return $this;
    }

    /**
     * @return Collection<int, Lp>
     */
    public function getLp(): Collection
    {
        return $this->lp;
    }

    public function addLp(Lp $lp): self
    {
        if (!$this->lp->contains($lp)) {
            $this->lp[] = $lp;
        }

        return $this;
    }

    public function removeLp(Lp $lp): self
    {
        $this->lp->removeElement($lp);

        return $this;
    }


    // ESSENTIEL POUR UPLOAD UNE IMAGE - SINON BLOCAGE CAR IMPOSSIBLE DE SERIALIZER UN FILE 
    
    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->email,
            $this->password,
            // see section on salt below
            // $this->salt,
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->email,
            $this->password,
            // see section on salt below
            // $this->salt
        ) = unserialize($serialized);
    }


}
