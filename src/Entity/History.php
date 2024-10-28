<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use App\Controller\HistoryController;
use App\Controller\HistoryController2;
use App\Entity\Traits\UpdatedAtTrait;
use App\Repository\HistoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\HasLifecycleCallbacks]
#[ApiResource(
    operations: [
        new GetCollection(uriTemplate: 'histories/heroes', controller: HistoryController::class),
        new GetCollection(uriTemplate: 'histories/harkovsk', controller: HistoryController2::class),
        new GetCollection(),
        new Get()
    ],
    normalizationContext: ['groups' => 'history:read'],
    paginationEnabled: false,
)]
#[ORM\Entity(repositoryClass: HistoryRepository::class)]
#[Vich\Uploadable]
class History
{
    use UpdatedAtTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['history:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['history:read'])]
    private ?string $type = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Groups(['history:read'])]
    private ?string $bio = null;

    /**
     * @var Collection<int, Photos>
     */
    #[ORM\OneToMany(targetEntity: Photos::class, mappedBy: 'history', cascade: ['persist', 'remove'])]
    private Collection $images;

    public function __construct()
    {
        $this->images = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getBio(): ?string
    {
        return $this->bio;
    }

    public function setBio(?string $bio): static
    {
        $this->bio = $bio;

        return $this;
    }

    /**
     * @return Collection<int, Photos>
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Photos $image): static
    {
        if (!$this->images->contains($image)) {
            $this->images->add($image);
            $image->setHistory($this);
        }

        return $this;
    }

    public function removeImage(Photos $image): static
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getHistory() === $this) {
                $image->setHistory(null);
            }
        }

        return $this;
    }
}
