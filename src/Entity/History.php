<?php

namespace App\Entity;

use App\Repository\HistoryRepository;
use DateTime;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HistoryRepository::class)]
class History
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column]
    private int $firstIn;

    #[ORM\Column]
    private int $secondIn;

    #[ORM\Column(nullable: true)]
    private ?int $firstOut;

    #[ORM\Column(nullable: true)]
    private ?int $secondOut;

    #[ORM\Column(type: 'datetime', nullable: true, options: ['default' => 'CURRENT_TIMESTAMP'])]
    private DateTime $creationTime;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?DateTime $updateTime = null;

    public function __construct()
    {
        $this->creationTime = new DateTime();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getFirstIn(): int
    {
        return $this->firstIn;
    }

    public function setFirstIn(int $firstIn): self
    {
        $this->firstIn = $firstIn;
        return $this;
    }

    public function getSecondIn(): int
    {
        return $this->secondIn;
    }

    public function setSecondIn(int $secondIn): self
    {
        $this->secondIn = $secondIn;
        return $this;
    }

    public function getFirstOut(): ?int
    {
        return $this->firstOut;
    }

    public function setFirstOut(?int $firstOut): self
    {
        $this->firstOut = $firstOut;
        return $this;
    }

    public function getSecondOut(): ?int
    {
        return $this->secondOut;
    }

    public function setSecondOut(?int $secondOut): self
    {
        $this->secondOut = $secondOut;
        return $this;
    }

    public function getCreationTime(): DateTime
    {
        return $this->creationTime;
    }

    public function getUpdateTime(): ?DateTime
    {
        return $this->updateTime;
    }

    public function setUpdateTime(?DateTime $updateTime): self
    {
        $this->updateTime = $updateTime;
        return $this;
    }
}