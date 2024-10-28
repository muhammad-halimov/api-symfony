<?php

namespace App\Entity;

use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use App\Repository\MainScreenRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[Get(normalizationContext: ['groups' => 'main_screen:read'])]
#[GetCollection(normalizationContext: ['groups' => 'main_screen:read'])]

#[ORM\Entity(repositoryClass: MainScreenRepository::class)]
class MainScreen
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['main_screen:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['main_screen:read'])]
    private ?string $titleSvo = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['main_screen:read'])]
    private ?string $titleHeroes = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['main_screen:read'])]
    private ?string $titleMembers = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitleSvo(): ?string
    {
        return $this->titleSvo;
    }

    public function setTitleSvo(?string $titleSvo): static
    {
        $this->titleSvo = $titleSvo;

        return $this;
    }

    public function getTitleHeroes(): ?string
    {
        return $this->titleHeroes;
    }

    public function setTitleHeroes(?string $titleHeroes): static
    {
        $this->titleHeroes = $titleHeroes;

        return $this;
    }

    public function getTitleMembers(): ?string
    {
        return $this->titleMembers;
    }

    public function setTitleMembers(?string $titleMembers): static
    {
        $this->titleMembers = $titleMembers;

        return $this;
    }
}
