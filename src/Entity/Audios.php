<?php

namespace App\Entity;

//use ApiPlatform\Metadata\ApiResource;
//use ApiPlatform\Metadata\Get;
//use ApiPlatform\Metadata\GetCollection;
use App\Entity\Traits\UpdatedAtTrait;
use App\Repository\AudiosRepository;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
//use Symfony\Component\Serializer\Annotation\Groups;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: AudiosRepository::class)]

//#[Get(normalizationContext: ['groups' => ['audios:read']])]
//#[GetCollection(normalizationContext: ['groups' => ['audios:read']])]

#[ORM\HasLifecycleCallbacks]

#[Vich\Uploadable]
class Audios
{
    use UpdatedAtTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
//    #[Groups(['audios:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
//    #[Groups(['audios:read'])]
    private ?string $title = null;

    #[Vich\UploadableField(mapping: 'product_description_audios', fileNameProperty: 'audio')]
    #[Assert\File(mimeTypes: ['audio/mpeg', 'audio/wav', 'audio/mp3'])]
//    #[Groups(['audios:read'])]
    private ?File $audioFile = null;

    #[ORM\Column(type: 'string', nullable: true)]
//    #[Groups(['audios:read'])]
    private ?string $audio = null;

    #[ORM\ManyToOne(inversedBy: 'audios')]
//    #[Groups(['audios:read'])]
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

    public function getAudio(): ?string
    {
        return $this->audio;
    }

    public function setAudio(?string $audio): static
    {
        $this->audio = $audio;

        return $this;
    }

    public function getAudioFile(): ?File
    {
        return $this->audioFile;
    }

    public function setAudioFile(?File $audioFile): self
    {
        $this->audioFile = $audioFile;

        if (null !== $audioFile)
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
}
