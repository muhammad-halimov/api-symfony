<?php

namespace App\Entity;

use App\Entity\Traits\UpdatedAtTrait;
use App\Repository\VideosRepository;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Serializer\Annotation\Groups;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\HasLifecycleCallbacks]
#[ORM\Entity(repositoryClass: VideosRepository::class)]
#[Vich\Uploadable]
class Videos
{
    use UpdatedAtTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['participants:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]

    private ?string $title = null;

    #[Vich\UploadableField(mapping: 'product_description_videos', fileNameProperty: 'video')]
    #[Assert\File(mimeTypes: ['video/mp4', 'video/avi', 'video/mkv'])]
    #[Groups(['participants:read'])]
    private ?File $videoFile = null;

    #[ORM\Column(type: 'string', nullable: true)]
    #[Groups(['participants:read'])]
    private ?string $video = null;

    #[ORM\ManyToOne(inversedBy: 'videos')]
    #[Groups(['participants:read'])]
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

    public function getVideo(): ?string
    {
        return $this->video;
    }

    public function setVideo(?string $video): static
    {
        $this->video = $video;

        return $this;
    }

    public function getVideoFile(): ?File
    {
        return $this->videoFile;
    }

    public function setVideoFile(?File $videoFile): self
    {
        $this->videoFile = $videoFile;

        if (null !== $videoFile)
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
