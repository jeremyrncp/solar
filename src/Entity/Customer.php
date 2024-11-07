<?php

namespace App\Entity;

use App\Repository\CustomerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CustomerRepository::class)]
class Customer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $username = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $logo = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $uid = null;

    /**
     * @var Collection<int, SolarData>
     */
    #[ORM\OneToMany(targetEntity: SolarData::class, mappedBy: 'customer', orphanRemoval: true)]
    private Collection $solarData;

    public function __construct()
    {
        $this->solarData = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(?string $logo): static
    {
        $this->logo = $logo;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getUid(): ?string
    {
        return $this->uid;
    }

    public function setUid(string $uid): static
    {
        $this->uid = $uid;

        return $this;
    }

    /**
     * @return Collection<int, SolarData>
     */
    public function getSolarData(): Collection
    {
        return $this->solarData;
    }

    public function addSolarData(SolarData $solarData): static
    {
        if (!$this->solarData->contains($solarData)) {
            $this->solarData->add($solarData);
            $solarData->setCustomer($this);
        }

        return $this;
    }

    public function removeSolarData(SolarData $solarData): static
    {
        if ($this->solarData->removeElement($solarData)) {
            // set the owning side to null (unless already changed)
            if ($solarData->getCustomer() === $this) {
                $solarData->setCustomer(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->name;
    }
}
