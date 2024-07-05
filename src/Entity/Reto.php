<?php

namespace App\Entity;

use App\Repository\RetoRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RetoRepository::class)]
class Reto
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    public function getId(): ?int
    {
        return $this->id;
    }
}
