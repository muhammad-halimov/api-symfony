<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use App\Controller\ParticipantsController;
use App\Controller\ParticipantsController2;
use App\Entity\Traits\UpdatedAtTrait;
use App\Repository\ParticipantsRepository;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Serializer\Annotation\Groups;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\HasLifecycleCallbacks]
#[ApiResource(
    operations: [
        new GetCollection(uriTemplate: 'participants/harkovsk', controller: ParticipantsController::class),
        new GetCollection(uriTemplate: 'participants/heroes', controller: ParticipantsController2::class),
        new GetCollection(),
        new Get()
    ],
    normalizationContext: ['groups' => 'participants:read'],
    paginationEnabled: false,
)]
#[ORM\Entity(repositoryClass: ParticipantsRepository::class)]
#[Vich\Uploadable]
class Participants
{
    use UpdatedAtTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['participants:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['participants:read'])]
    private ?string $type = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['participants:read'])]
    private ?string $surname = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['participants:read'])]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['participants:read'])]
    private ?string $patronym = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Groups(['participants:read'])]
    private ?string $bio = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    #[Groups(['participants:read'])]
    private ?DateTimeInterface $birth = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    #[Groups(['participants:read'])]
    private ?DateTimeInterface $death = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    #[Groups(['participants:read'])]
    private ?DateTimeInterface $updated = null;

    /**
     * @var Collection<int, Poems>
     */
    #[ORM\OneToMany(targetEntity: Poems::class, mappedBy: 'participants', cascade: ['persist', 'remove'])]
    private Collection $poems;

    /**
     * @var Collection<int, Photos>
     */
    #[ORM\OneToMany(targetEntity: Photos::class, mappedBy: 'participants', cascade: ['persist', 'remove'])]
    private Collection $photos;

    /**
     * @var Collection<int, Audios>
     */
    #[ORM\OneToMany(targetEntity: Audios::class, mappedBy: 'participants', cascade: ['persist', 'remove'])]
    private Collection $audios;

    /**
     * @var Collection<int, Videos>
     */
    #[ORM\OneToMany(targetEntity: Videos::class, mappedBy: 'participants', cascade: ['persist', 'remove'])]
    private Collection $videos;

    public function __construct()
    {
        $this->poems = new ArrayCollection();
        $this->photos = new ArrayCollection();
        $this->audios = new ArrayCollection();
        $this->videos = new ArrayCollection();
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

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(?string $surname): static
    {
        $this->surname = $surname;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getPatronym(): ?string
    {
        return $this->patronym;
    }

    public function setPatronym(?string $patronym): static
    {
        $this->patronym = $patronym;

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

    public function getBirth(): ?DateTimeInterface
    {
        return $this->birth;
    }

    public function setBirth(?DateTimeInterface $birth): static
    {
        $this->birth = $birth;

        return $this;
    }

    public function getDeath(): ?DateTimeInterface
    {
        return $this->death;
    }

    public function setDeath(?DateTimeInterface $death): static
    {
        $this->death = $death;

        return $this;
    }

    public function getUpdated(): ?DateTimeInterface
    {
        return $this->updated;
    }

    public function setUpdated(?DateTimeInterface $updated): static
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * @return Collection<int, Poems>
     */
    public function getPoems(): Collection
    {
        return $this->poems;
    }

    public function addPoem(Poems $poem): static
    {
        if (!$this->poems->contains($poem)) {
            $this->poems->add($poem);
            $poem->setParticipants($this);
        }

        return $this;
    }

    public function removePoem(Poems $poem): static
    {
        if ($this->poems->removeElement($poem)) {
            // set the owning side to null (unless already changed)
            if ($poem->getParticipants() === $this) {
                $poem->setParticipants(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Photos>
     */
    public function getPhotos(): Collection
    {
        return $this->photos;
    }

    public function addPhoto(Photos $photo): static
    {
        if (!$this->photos->contains($photo)) {
            $this->photos->add($photo);
            $photo->setParticipants($this);
        }

        return $this;
    }

    public function removePhoto(Photos $photo): static
    {
        if ($this->photos->removeElement($photo)) {
            // set the owning side to null (unless already changed)
            if ($photo->getParticipants() === $this) {
                $photo->setParticipants(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Audios>
     */
    public function getAudios(): Collection
    {
        return $this->audios;
    }

    public function addAudio(Audios $audio): static
    {
        if (!$this->audios->contains($audio)) {
            $this->audios->add($audio);
            $audio->setParticipants($this);
        }

        return $this;
    }

    public function removeAudio(Audios $audio): static
    {
        if ($this->audios->removeElement($audio)) {
            // set the owning side to null (unless already changed)
            if ($audio->getParticipants() === $this) {
                $audio->setParticipants(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Videos>
     */
    public function getVideos(): Collection
    {
        return $this->videos;
    }

    public function addVideo(Videos $video): static
    {
        if (!$this->videos->contains($video)) {
            $this->videos->add($video);
            $video->setParticipants($this);
        }

        return $this;
    }

    public function removeVideo(Videos $video): static
    {
        if ($this->videos->removeElement($video)) {
            // set the owning side to null (unless already changed)
            if ($video->getParticipants() === $this) {
                $video->setParticipants(null);
            }
        }

        return $this;
    }
}
