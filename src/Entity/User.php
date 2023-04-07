<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Uid\Ulid;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy : "NONE")]
    #[ORM\Column(type: Types::STRING)]
    private string $id;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $username = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\ManyToOne(inversedBy: 'users')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Profile $profile = null;

    #[ORM\OneToMany(mappedBy: 'users', targetEntity: CommentaryTutorial::class)]
    private Collection $commentaryTutorials;

    #[ORM\OneToMany(mappedBy: 'users', targetEntity: CommentarySubject::class)]
    private Collection $commentarySubjects;

    public function __construct()
    {
        $this->commentaryTutorials = new ArrayCollection();
        $this->commentarySubjects = new ArrayCollection();
        $this->id = Ulid::generate();
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->username;
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
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getProfile(): ?Profile
    {
        return $this->profile;
    }

    public function setProfile(?Profile $profile): self
    {
        $this->profile = $profile;

        return $this;
    }

    /**
     * @return Collection<int, CommentaryTutorial>
     */
    public function getCommentaryTutorials(): Collection
    {
        return $this->commentaryTutorials;
    }

    public function addCommentaryTutorial(CommentaryTutorial $commentaryTutorial): self
    {
        if (!$this->commentaryTutorials->contains($commentaryTutorial)) {
            $this->commentaryTutorials->add($commentaryTutorial);
            $commentaryTutorial->setUsers($this);
        }

        return $this;
    }

    public function removeCommentaryTutorial(CommentaryTutorial $commentaryTutorial): self
    {
        if ($this->commentaryTutorials->removeElement($commentaryTutorial)) {
            // set the owning side to null (unless already changed)
            if ($commentaryTutorial->getUsers() === $this) {
                $commentaryTutorial->setUsers(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CommentarySubject>
     */
    public function getCommentarySubjects(): Collection
    {
        return $this->commentarySubjects;
    }

    public function addCommentarySubject(CommentarySubject $commentarySubject): self
    {
        if (!$this->commentarySubjects->contains($commentarySubject)) {
            $this->commentarySubjects->add($commentarySubject);
            $commentarySubject->setUsers($this);
        }

        return $this;
    }

    public function removeCommentarySubject(CommentarySubject $commentarySubject): self
    {
        if ($this->commentarySubjects->removeElement($commentarySubject)) {
            // set the owning side to null (unless already changed)
            if ($commentarySubject->getUsers() === $this) {
                $commentarySubject->setUsers(null);
            }
        }

        return $this;
    }
}
