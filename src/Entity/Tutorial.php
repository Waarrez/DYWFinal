<?php

namespace App\Entity;

use App\Repository\TutorialRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Ulid;

#[ORM\Entity(repositoryClass: TutorialRepository::class)]
class Tutorial
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'NONE')]
    #[ORM\Column(type: Types::STRING)]
    private ?string $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $content = null;

    #[ORM\Column(length: 255)]
    private ?string $url = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $published_at = null;

    #[ORM\OneToMany(mappedBy: 'tutorial', targetEntity: CommentaryTutorial::class)]
    private Collection $commentaryTutorials;

    public function __construct()
    {
        $this->commentaryTutorials = new ArrayCollection();
    }

    public function getId(): ?string
    {
        return $this->id = Ulid::generate();
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
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

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getPublishedAt(): ?\DateTimeImmutable
    {
        return $this->published_at;
    }

    public function setPublishedAt(\DateTimeImmutable $published_at): self
    {
        $this->published_at = $published_at;

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
            $commentaryTutorial->setTutorial($this);
        }

        return $this;
    }

    public function removeCommentaryTutorial(CommentaryTutorial $commentaryTutorial): self
    {
        if ($this->commentaryTutorials->removeElement($commentaryTutorial)) {
            // set the owning side to null (unless already changed)
            if ($commentaryTutorial->getTutorial() === $this) {
                $commentaryTutorial->setTutorial(null);
            }
        }

        return $this;
    }
}
