<?php

namespace App\Entity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EntryRepository")
 */
class Entry
{   
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @Assert\NotBlank
     * @Assert\Length(min=3, max=100)
     * @Assert\Type("string")
     * 
     * @ORM\Column(type="string", length=100)
     */
    private $name;
    
    /**
     * @Assert\NotBlank
     * @Assert\Email
     * @Assert\Regex("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/")
     
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @Assert\NotBlank
     * @Assert\Length(min=9, max=9)
     * @Assert\Type("numeric")
     * 
     * @ORM\Column(type="integer")
     */
    private $tlf;

    /**
     * @Assert\NotBlank
     * @Assert\Length(min=3, max=100)
     * 
     * @ORM\Column(type="string", length=100)
     */
    private $cat;
    /*
    * @Assert\NotBlank
    * @Assert\Choice({"Hotel", "Pista", "Complemento"})

    * @ORM\Column(type="string", length=100)
    */
    private $active;

    /* 
    * @ORM\Column(type="datetime")
    */
    private $created_at;

    /**
    * @ORM\Column(type="datetime")
    */
    private $modified_at;

    public function __construct()
    {
        $this->name = '';
        $this->email = '';
        $this->tlf = 0;
        $this->cat = '';
        $this->active = false;
        $this->created_at = new \DateTime();
        $this->modified_at = new \DateTime();
    }

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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getTlf(): ?string
    {
        return $this->tlf;
    }

    public function setTlf(string $tlf): self
    {
        $this->tlf = $tlf;

        return $this;
    }

    public function getCat(): ?string
    {
        return $this->cat;
    }

    public function setCat(string $cat): self
    {
        $this->cat = $cat;

        return $this;
    }

    public function getActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getLastModified(): ?\DateTimeInterface
    {
        return $this->modified_at;
    }

    public function setLastModified(\DateTimeInterface $modified_at): self
    {
        $this->modified_at = $modified_at;
        return $this;
    }

}
