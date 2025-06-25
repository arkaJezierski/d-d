<?php

namespace App\Entity;

use App\Repository\StoryStepRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StoryStepRepository::class)]
class StoryStep
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column]
    private ?bool $isStart = null;

    #[ORM\ManyToOne(inversedBy: 'storySteps')]
    private ?Story $story = null;

    /**
     * @var Collection<int, StoryChoice>
     */
    #[ORM\OneToMany(targetEntity: StoryChoice::class, mappedBy: 'storyStep')]
    private Collection $storyChoices;

    public function __construct()
    {
        $this->storyChoices = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function isStart(): ?bool
    {
        return $this->isStart;
    }

    public function setIsStart(bool $isStart): static
    {
        $this->isStart = $isStart;

        return $this;
    }

    public function getStory(): ?Story
    {
        return $this->story;
    }

    public function setStory(?Story $story): static
    {
        $this->story = $story;

        return $this;
    }

    /**
     * @return Collection<int, StoryChoice>
     */
    public function getStoryChoices(): Collection
    {
        return $this->storyChoices;
    }

    public function addStoryChoice(StoryChoice $storyChoice): static
    {
        if (!$this->storyChoices->contains($storyChoice)) {
            $this->storyChoices->add($storyChoice);
            $storyChoice->setStoryStep($this);
        }

        return $this;
    }

    public function removeStoryChoice(StoryChoice $storyChoice): static
    {
        if ($this->storyChoices->removeElement($storyChoice)) {
            // set the owning side to null (unless already changed)
            if ($storyChoice->getStoryStep() === $this) {
                $storyChoice->setStoryStep(null);
            }
        }

        return $this;
    }
}
