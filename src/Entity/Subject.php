<?php

namespace App\Entity;

use App\Repository\SubjectRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Ulid;

#[ORM\Entity(repositoryClass: SubjectRepository::class)]
class Subject
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'NONE')]
    #[ORM\Column(type: Types::STRING)]
    private ?string $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    private ?string $content = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\OneToMany(mappedBy: 'subject', targetEntity: CommentarySubject::class)]
    private Collection $commentarySubjects;

    #[ORM\ManyToMany(targetEntity: Category::class, mappedBy: 'subject')]
    private Collection $categories;

    public function __construct()
    {
        $this->commentarySubjects = new ArrayCollection();
        $this->categories = new ArrayCollection();
        $this->id = Ulid::generate();
    }

    public function getId(): ?string
    {
        return $this->id;
    }


    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

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

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

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
            $commentarySubject->setSubject($this);
        }

        return $this;
    }

    public function removeCommentarySubject(CommentarySubject $commentarySubject): self
    {
        if ($this->commentarySubjects->removeElement($commentarySubject)) {
            // set the owning side to null (unless already changed)
            if ($commentarySubject->getSubject() === $this) {
                $commentarySubject->setSubject(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Category>
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Category $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories->add($category);
            $category->addSubject($this);
        }

        return $this;
    }

    public function removeCategory(Category $category): self
    {
        if ($this->categories->removeElement($category)) {
            $category->removeSubject($this);
        }

        return $this;
    }
}
