<?php

namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use LaravelDoctrine\ORM\Auth\Authenticatable;
use LaravelDoctrine\Extensions\Timestamps\Timestamps;
use LaravelDoctrine\ORM\Notifications\Notifiable;

/**
 * @ORM\Entity
 * @ORM\Table(name="doc_users")
 */
class User implements AuthenticatableContract, CanResetPasswordContract
{

    use Authenticatable, CanResetPassword, Timestamps, Notifiable;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    protected $email;

    /**
     * @var string
     * @ORM\Column(type="string",nullable=false)
     */
    protected $name;

    /**
     * @var string
     * @ORM\Column(type="boolean", options={"default":0})
     */
    protected $is_admin;

    public function setName($name)
    {
        return $this->name = $name;
    }

    public function setEmail($email)
    {
        return $this->email = $email;
    }

    public function getName()
    {
        return $this->name;
    }

    public function isAdmin()
    {
        return $this->is_admin;
    }

}

