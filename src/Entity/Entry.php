<?php

namespace App\Entity;
use Symfony\Component\Validator\Constraints as Assert;

class Entry
{
    /**
     * @Assert\NotBlank
     * @Assert\Length(min=3, max=100)
     * @Assert\Type("string")
     */
    public $name;
    
    /**
     * @Assert\NotBlank
     * @Assert\Email
     * @Assert\Regex("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/")
     */
    public $email;

    /**
     * @Assert\NotBlank
     * @Assert\Length(min=9, max=9)
     * @Assert\Type("numeric")
     */
    public $tlf;

    /**
     * @Assert\NotBlank
     * @Assert\Length(min=3, max=100)
     */
    public $cat;
    /*
        * @Assert\NotBlank
        * @Assert\Choice({"Hotel", "Pista", "Complemento"})
    */
    public $active;

    public function __construct()
    {
        $this->name = '';
        $this->email = '';
        $this->tlf = '';
        $this->cat = '';
        $this->active = false;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getTlf()
    {
        return $this->tlf;
    }

    public function setTlf($tlf)
    {
        $this->tlf = $tlf;
    }

    public function getCat()
    {
        return $this->cat;
    }

    public function setCat($cat)
    {
        $this->cat = $cat;
    }

    public function getActive()
    {
        return $this->active;
    }

    public function setActive($active)
    {
        $this->active = $active;
    }
}
