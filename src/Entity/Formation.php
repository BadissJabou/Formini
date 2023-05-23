<?php

namespace App\Entity;

use App\Repository\FormationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\Integer;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use App\Entity\Participant;

#[ORM\Entity(repositoryClass: FormationRepository::class)]
class Formation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]

    
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Participant", mappedBy="formation")
     */
    private $participants;

    public function __construct()
    {
        $this->participants = new ArrayCollection();
    }

      /**
     * @return Collection|Participant[]
     */

    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 3)]
    private ?string $price = null;

    #[ORM\Column]
    private ?int $duration = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $begin_at = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(int $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    public function getBeginAt(): ?\DateTimeInterface
    {
        return $this->begin_at;
    }

    public function setBeginAt(\DateTimeInterface $begin_at): self
    {
        $this->begin_at = $begin_at;

        return $this;
    }

    
     /**
     * @return Collection<int, Participant>
     */
    public function getParticipants(): Collection
    {
        return $this->participants;
    }

    public function addParticipnt(Participant $participnt): self
    {
        if (!$this->participants->contains($participnt)) {
            $this->participants[] = $participnt;
            $participnt->setFormation($this);
        }

        return $this;
    }

    public function removeParticipnt(Participant $participnt): self
    {
        if ($this->participants->removeElement($participnt)) {
            // set the owning side to null (unless already changed)
            if ($participnt->getFormation() === $this) {
                $participnt->setFormation(null);
            }
        }

        return $this;
    }

    public function addParticipant(Participant $participant): self
    {
        if (!$this->participants->contains($participant)) {
            $this->participants[] = $participant;
            $participant->setFormation($this);
        }

        return $this;
    }

    public function removeParticipant(Participant $participant): self
    {
        if ($this->participants->removeElement($participant)) {
            // set the owning side to null (unless already changed)
            if ($participant->getFormation() === $this) {
                $participant->setFormation(null);
            }
        }

        return $this;
    }




}
