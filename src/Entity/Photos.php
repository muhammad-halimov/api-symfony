<?php

namespace App\Entity;

//use ApiPlatform\Metadata\Get;
//use ApiPlatform\Metadata\GetCollection;
use App\Entity\Traits\UpdatedAtTrait;
use App\Repository\PhotosRepository;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
//use Symfony\Component\Serializer\Annotation\Groups;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: PhotosRepository::class)]

//#[Get(normalizationContext: ['groups' => ['photos:read']])]
//#[GetCollection(normalizationContext: ['groups' => ['photos:read']])]
#[ORM\HasLifecycleCallbacks]

#[Vich\Uploadable]
class Photos
{
    use UpdatedAtTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
//    #[Groups(['photos:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
//    #[Groups(['photos:read'])]
    private ?string $title = null;

    #[Vich\UploadableField(mapping: 'product_description_images', fileNameProperty: 'image')]
    #[Assert\Image(mimeTypes: ['image/png', 'image/jpeg', 'image/jpg', 'image/webp'])]
//    #[Groups(['photos:read'])]
    private ?File $imageFile = null;

    #[ORM\Column(type: 'string', nullable: true)]
//    #[Groups(['photos:read'])]
    private ?string $image = null;

    #[ORM\ManyToOne(inversedBy: 'photos')]
//    #[Groups(['photos:read'])]
    private ?Participants $participants = null;

    #[ORM\ManyToOne(inversedBy: 'images')]
    private ?History $history = null;

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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageFile(?File $imageFile): self
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile)
            $this->updatedAt = new DateTime();

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

    public function getHistory(): ?History
    {
        return $this->history;
    }

    public function setHistory(?History $history): static
    {
        $this->history = $history;

        return $this;
    }
}
