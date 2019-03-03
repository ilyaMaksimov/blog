<?php

namespace App\Entities;

use App\Components\Image;
use Carbon\Carbon;
use Doctrine\ORM\Mapping as ORM;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use LaravelDoctrine\ORM\Auth\Authenticatable;
use LaravelDoctrine\Extensions\Timestamps\Timestamps;
use LaravelDoctrine\ORM\Notifications\Notifiable;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 *
 * @property int $id
 * @property string $email
 * @property string $name
 * @property string $password
 * @property string $remember_token
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property boolean $is_admin
 * @property string|null $avatar
 */
class User implements AuthenticatableContract, CanResetPasswordContract
{

    use Authenticatable, CanResetPassword, Timestamps, Notifiable;

    const SIMPLE = 0;
    const ADMIN = 1;

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

    /** @ORM\Column(type="string", nullable=true) */
    protected $avatar;

    public function getId()
    {
        return $this->id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function isAdmin()
    {
        return $this->is_admin;
    }

    public function getAvatar()
    {
        return $this->avatar;
    }

    public function getPathAvatar()
    {
        return Image::getPath($this->getAvatar());
    }

    public function setAvatar($avatar): void
    {
        $this->avatar = $avatar;
    }
}

