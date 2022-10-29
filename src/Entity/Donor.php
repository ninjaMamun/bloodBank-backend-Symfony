<?php

namespace App\Entity;

use App\Repository\DonorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DonorRepository::class)]
class Donor
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 3)]
    private ?string $bloodGroup = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $mobile = null;

    #[ORM\Column(length: 255)]
    private ?string $mail = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $lastDonateDate = null;

    #[ORM\Column(nullable: true)]
    private ?int $numberOfDonation = null;

    #[ORM\Column(length: 255)]
    private ?string $profilePicture = null;

    #[ORM\ManyToOne(inversedBy: 'donors')]
    #[ORM\JoinColumn(nullable: false)]
    private Area $area;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBloodGroup(): ?string
    {
        return $this->bloodGroup;
    }

    public function setBloodGroup(string $bloodGroup): self
    {
        $this->bloodGroup = $bloodGroup;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getMobile(): ?string
    {
        return $this->mobile;
    }

    public function setMobile(string $mobile): self
    {
        $this->mobile = $mobile;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getLastDonateDate(): ?\DateTimeInterface
    {
        return $this->lastDonateDate;
    }

    public function setLastDonateDate(?\DateTimeInterface $lastDonateDate): self
    {
        $this->lastDonateDate = $lastDonateDate;

        return $this;
    }

    public function getNumberOfDonation(): ?int
    {
        return $this->numberOfDonation;
    }

    public function setNumberOfDonation(?int $numberOfDonation): self
    {
        $this->numberOfDonation = $numberOfDonation;

        return $this;
    }

    public function getProfilePicture(): ?string
    {
        return $this->profilePicture;
    }

    public function setProfilePicture(string $profilePicture): self
    {
        $this->profilePicture = $profilePicture;

        return $this;
    }

    public function getArea(): Area
    {
        return $this->area;
    }

    public function setArea(Area $area): self
    {
        $this->area = $area;

        return $this;
    }


}

