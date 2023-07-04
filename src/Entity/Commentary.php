<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\CommentaryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Uid\Ulid;

#[ORM\Entity(repositoryClass: CommentaryRepository::class)]
#[ApiResource(
    normalizationContext: ["groups" => "commentaries_read"]
)]
class Commentary
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'NONE')]
    #[ORM\Column(type: Types::STRING)]
    #[Groups(["commentaries_read", "tutorials_read", "subjects_read"])]
    private string $id;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups(["commentaries_read", "tutorials_read", "subjects_read"])]
    private ?string $content = null;

    #[ORM\ManyToOne(inversedBy: 'commentaries')]
    #[Groups(["commentaries_read", "tutorials_read", "subjects_read"])]
    private ?User $users = null;

    #[ORM\ManyToMany(targetEntity: Tutorial::class, inversedBy: 'commentaries')]
    #[Groups(["commentaries_read"])]
    private Collection $tutorials;

    #[ORM\ManyToMany(targetEntity: Subject::class, inversedBy: 'commentaries')]
    #[Groups(["commentaries_read"])]
    private Collection $subjects;

    public function __construct()
    {
        $this->tutorials = new ArrayCollection();
        $this->id = Ulid::generate();
        $this->subjects = new ArrayCollection();
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): static
    {
        $this->content = $content;

        return $this;
    }

    public function getUsers(): ?User
    {
        return $this->users;
    }

    public function setUsers(?User $users): static
    {
        $this->users = $users;

        return $this;
    }

    /**
     * @return Collection<int, Tutorial>
     */
    public function getTutorials(): Collection
    {
        return $this->tutorials;
    }

    public function addTutorial(Tutorial $tutorial): static
    {
        if (!$this->tutorials->contains($tutorial)) {
            $this->tutorials->add($tutorial);
        }

        return $this;
    }

    public function removeTutorial(Tutorial $tutorial): static
    {
        $this->tutorials->removeElement($tutorial);

        return $this;
    }

    /**
     * @return Collection<int, Subject>
     */
    public function getSubjects(): Collection
    {
        return $this->subjects;
    }

    public function addSubject(Subject $subject): static
    {
        if (!$this->subjects->contains($subject)) {
            $this->subjects->add($subject);
        }

        return $this;
    }

    public function removeSubject(Subject $subject): static
    {
        $this->subjects->removeElement($subject);

        return $this;
    }
}
