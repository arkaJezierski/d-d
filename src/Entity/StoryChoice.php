<?php

namespace App\Entity;

use App\Repository\StoryChoiceRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StoryChoiceRepository::class)]
class StoryChoice
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $text = null;

    #[ORM\ManyToOne(inversedBy: 'storyChoices')]
    #[ORM\JoinColumn(nullable: false)]
    private ?StoryStep $storyStep = null;

    #[ORM\ManyToOne(inversedBy: 'storyChoices')]
    private ?StoryStep $nextStep = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): static
    {
        $this->text = $text;

        return $this;
    }

    public function getStoryStep(): ?StoryStep
    {
        return $this->storyStep;
    }

    public function setStoryStep(?StoryStep $storyStep): static
    {
        $this->storyStep = $storyStep;

        return $this;
    }

    public function getNextStep(): ?StoryStep
    {
        return $this->nextStep;
    }

    public function setNextStep(?StoryStep $nextStep): static
    {
        $this->nextStep = $nextStep;

        return $this;
    }
}
