<?php

namespace App\Entity;

use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\TutorialRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Uid\Ulid;

#[ORM\Entity(repositoryClass: TutorialRepository::class)]
#[ApiResource(
    normalizationContext: ["groups" => "tutorials_read"]
)]
#[ApiFilter(
    SearchFilter::class,
    properties: ["title" => "partial"]
)]
class Tutorial
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'NONE')]
    #[ORM\Column(type: Types::STRING)]
    #[Groups(["tutorials_read"])]
    private string $id;

    #[ORM\Column(length: 255)]
    #[Groups(["tutorials_read"])]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups(["tutorials_read"])]
    private ?string $content = null;

    #[ORM\Column(length: 255)]
    #[Groups(["tutorials_read"])]
    private ?string $url = null;

    #[ORM\Column]
    #[Groups(["tutorials_read"])]
    private ?\DateTimeImmutable $publishedAt = null;

    #[ORM\ManyToMany(targetEntity: Commentary::class, mappedBy: 'tutorials')]
    #[Groups(["tutorials_read"])]
    private Collection $commentaries;

    #[ORM\ManyToMany(targetEntity: Category::class, mappedBy: 'tutorials')]
    #[Groups(["tutorials_read"])]
    private Collection $categories;

    #[ORM\Column(type: Types::STRING)]
    #[Groups(["tutorials_read"])]
    private string $slug;

    public function __construct()
    {
        $this->commentaries = new ArrayCollection();
        $this->id = Ulid::generate();
        $this->publishedAt = new \DateTimeImmutable();
        $this->categories = new ArrayCollection();
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
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

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): static
    {
        $this->url = $url;

        return $this;
    }

    public function getPublishedAt(): ?\DateTimeImmutable
    {
        return $this->publishedAt;
    }

    public function setPublishedAt(\DateTimeImmutable $publishedAt): static
    {
        $this->publishedAt = $publishedAt;

        return $this;
    }

    /**
     * @return Collection<int, Commentary>
     */
    public function getCommentaries(): Collection
    {
        return $this->commentaries;
    }

    public function addCommentary(Commentary $commentary): static
    {
        if (!$this->commentaries->contains($commentary)) {
            $this->commentaries->add($commentary);
            $commentary->addTutorial($this);
        }

        return $this;
    }

    public function removeCommentary(Commentary $commentary): static
    {
        if ($this->commentaries->removeElement($commentary)) {
            $commentary->removeTutorial($this);
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

    public function addCategory(Category $category): static
    {
        if (!$this->categories->contains($category)) {
            $this->categories->add($category);
            $category->addTutorial($this);
        }

        return $this;
    }

    public function removeCategory(Category $category): static
    {
        if ($this->categories->removeElement($category)) {
            $category->removeTutorial($this);
        }

        return $this;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }
}
