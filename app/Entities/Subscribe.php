<?php

namespace App\Entities;

use Doctrine\ORM\Mapping AS ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="subscribes")
 * @package App\Entities
 *
 * @property int $id
 * @property string $email
 * @property string $token
 * @property \DateTime $date
 */
class Subscribe
{
    const VERIFY = null;

    /** @ORM\Id @ORM\Column(type="integer") @ORM\GeneratedValue */
    protected $id;
    /** @ORM\Column(type="string") */
    protected $email;
    /** @ORM\Column(type="string", nullable=true) */
    protected $token;
    /** @ORM\Column(type="date") */
    protected $date;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param null|string $token
     */
    public function verify($token = null)
    {
        $this->token = $token;
    }

    public function generateToken(): void
    {
        $this->token = str_random(100);
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date): void
    {
        $this->date = new \DateTime($date);
    }

}
