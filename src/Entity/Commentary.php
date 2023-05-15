<?php

namespace App\Entity;

use App\Repository\CommentaryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommentaryRepository::class)]
class Commentary
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy : "CUSTOM")]
    #[ORM\Column(type:"ulid")]
    #[ORM\CustomIdGenerator(class: "Symfony\Bridge\Doctrine\IdGenerator\UlidGenerator")]
    private string $id;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $content = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\ManyToOne(inversedBy: 'commentaries')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $users = null;

    #[ORM\ManyToMany(targetEntity: Tutorial::class, inversedBy: 'commentaries')]
    private Collection $tutorial;

    #[ORM\ManyToMany(targetEntity: Subject::class, inversedBy: 'commentaries')]
    private Collection $Subject;

    public function __construct()
    {
        $this->tutorial = new ArrayCollection();
        $this->Subject = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

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

    public function getUsers(): ?User
    {
        return $this->users;
    }

    public function setUsers(?User $users): self
    {
        $this->users = $users;

        return $this;
    }

    /**
     * @return Collection<int, Tutorial>
     */
    public function getTutorial(): Collection
    {
        return $this->tutorial;
    }

    public function addTutorial(Tutorial $tutorial): self
    {
        if (!$this->tutorial->contains($tutorial)) {
            $this->tutorial->add($tutorial);
        }

        return $this;
    }

    public function removeTutorial(Tutorial $tutorial): self
    {
        $this->tutorial->removeElement($tutorial);

        return $this;
    }

    /**
     * @return Collection<int, Subject>
     */
    public function getSubject(): Collection
    {
        return $this->Subject;
    }

    public function addSubject(Subject $subject): self
    {
        if (!$this->Subject->contains($subject)) {
            $this->Subject->add($subject);
        }

        return $this;
    }

    public function removeSubject(Subject $subject): self
    {
        $this->Subject->removeElement($subject);

        return $this;
    }
}
