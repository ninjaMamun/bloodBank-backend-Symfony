<?php

namespace App\Entity;

use App\Repository\AreaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AreaRepository::class)]
class Area
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

//    #[ORM\OneToMany(mappedBy: 'area', targetEntity: Donor::class)]
//    private Collection $donors;

//    public function __construct()
//    {
//        $this->donors = new ArrayCollection();
//    }

    public function getId(): ?int
    {
        return $this->id;
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

//    /**
//     * @return Collection<int, Donor>
//     */
//    public function getDonors(): Collection
//    {
//        return $this->donors;
//    }
//
//    public function addDonor(Donor $donor): self
//    {
//        if (!$this->donors->contains($donor)) {
//            $this->donors->add($donor);
//            $donor->setArea($this);
//        }
//
//        return $this;
//    }
//
//    public function removeDonor(Donor $donor): self
//    {
//        if ($this->donors->removeElement($donor)) {
//            // set the owning side to null (unless already changed)
//            if ($donor->getArea() === $this) {
//                $donor->setArea(null);
//            }
//        }
//
//        return $this;
//    }
}
