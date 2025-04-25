<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Mapping\ClassMetadata;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $name = null;

    #[ORM\Column(length: 50)]
    private ?string $lastname = null;

    #[ORM\Column(length: 50)]
    private ?string $email = null;

    #[ORM\Column(length: 50)]
    private ?string $phone = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): static
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): static
    {
        $this->phone = $phone;

        return $this;
    }

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('name', new Assert\NotBlank(['message' => 'Este campo no puede quedar vacio' ]));
        $metadata->addPropertyConstraint('lastname', new Assert\NotBlank(['message' => 'Este campo no puede quedar vacio' ]));
        $metadata->addPropertyConstraint('email', new Assert\NotBlank(['message' => 'Este campo no puede quedar vacio' ]));
        $metadata->addPropertyConstraint('phone', new Assert\NotBlank(['message' => 'Este campo no puede quedar vacio' ]));

        $metadata->addPropertyConstraint('phone', new Regex([
            'pattern' => '/^\d{10}$/',
            'message' => 'Este campo debe contener 10 digitos'
        ]));

        $metadata ->addPropertyConstraint('phone', new Regex ([
            'pattern' => '/^\d+$/',
            'message' => 'Este campo no puede contener letras'
        ]));

        $metadata ->addPropertyConstraint('email', new Assert\Email(['message' => 'Ingrese un correo valido']));
        $metadata ->addConstraint(new UniqueEntity([
            'fields' => 'email',
            'message' => 'Ya existe un usuario registrado',
        ]));
    }
}
