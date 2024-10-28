<?php

namespace App\Entity;

//use ApiPlatform\Metadata\Get;
//use ApiPlatform\Metadata\GetCollection;
use App\Repository\PoemsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
//use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: PoemsRepository::class)]
//#[Get(normalizationContext: ['groups' => ['poems:read']])]
//#[GetCollection(normalizationContext: ['groups' => ['poems:read']])]

#[ORM\HasLifecycleCallbacks]
class Poems
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
//    #[Groups(['poems:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
//    #[Groups(['poems:read'])]
    private ?string $title = null;

    #[ORM\Column(length: 255, nullable: true)]
//    #[Groups(['poems:read'])]
    private ?string $description = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
//    #[Groups(['poems:read'])]
    private ?string $text = null;

    #[ORM\ManyToOne(cascade: ['persist', 'remove'], inversedBy: 'poems')]
//    #[Groups(['poems:read'])]
    private ?Participants $participants = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): static
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

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(?string $text): static
    {
        $this->text = $text;

        return $this;
    }

    public function getParticipants(): ?Participants
    {
        return $this->participants;
    }

    public function setParticipants(?Participants $participants): static
    {
        $this->participants = $participants;

        return $this;
    }
}
