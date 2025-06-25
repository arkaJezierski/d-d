<?php

namespace App\Entity;

use App\Repository\StoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StoryRepository::class)]
class Story
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'stories')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $author = null;

    /**
     * @var Collection<int, StoryStep>
     */
    #[ORM\OneToMany(targetEntity: StoryStep::class, mappedBy: 'story')]
    private Collection $storySteps;

    public function __construct()
    {
        $this->storySteps = new ArrayCollection();
    }

    public function getId(): ?int
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(?User $author): static
    {
        $this->author = $author;

        return $this;
    }

    /**
     * @return Collection<int, StoryStep>
     */
    public function getStorySteps(): Collection
    {
        return $this->storySteps;
    }

    public function addStoryStep(StoryStep $storyStep): static
    {
        if (!$this->storySteps->contains($storyStep)) {
            $this->storySteps->add($storyStep);
            $storyStep->setStory($this);
        }

        return $this;
    }

    public function removeStoryStep(StoryStep $storyStep): static
    {
        if ($this->storySteps->removeElement($storyStep)) {
            // set the owning side to null (unless already changed)
            if ($storyStep->getStory() === $this) {
                $storyStep->setStory(null);
            }
        }

        return $this;
    }
}
