<?php

namespace App\Entity;

use App\Repository\SolarDataRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: SolarDataRepository::class)]
class SolarData
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'solarData')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Customer $customer = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $createdAt = null;

    #[ORM\Column]
    #[Assert\NotBlank]
    private ?int $production = null;

    #[ORM\Column]
    #[Assert\NotBlank]
    private ?int $co2 = null;

    #[ORM\Column]
    #[Assert\NotBlank]
    private ?int $threes = null;

    #[ORM\Column]
    private ?float $productionDay = null;

    #[ORM\Column]
    private ?int $productionTotal = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setCustomer(?Customer $customer): static
    {
        $this->customer = $customer;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getProduction(): ?int
    {
        return $this->production;
    }

    public function setProduction(int $production): static
    {
        $this->production = $production;

        return $this;
    }

    public function getCo2(): ?int
    {
        return $this->co2;
    }

    public function setCo2(int $co2): static
    {
        $this->co2 = $co2;

        return $this;
    }

    public function getThrees(): ?int
    {
        return $this->threes;
    }

    public function setThrees(int $threes): static
    {
        $this->threes = $threes;

        return $this;
    }

    public function getProductionDay(): ?float
    {
        return $this->productionDay;
    }

    public function setProductionDay(float $productionDay): static
    {
        $this->productionDay = $productionDay;

        return $this;
    }

    public function getProductionTotal(): ?int
    {
        return $this->productionTotal;
    }

    public function setProductionTotal(int $productionTotal): static
    {
        $this->productionTotal = $productionTotal;

        return $this;
    }
}
