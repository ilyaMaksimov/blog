<?php

namespace App\Entities;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping AS ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="categories")
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 */
class Category
{
    /** @ORM\Id @ORM\Column(type="integer") @ORM\GeneratedValue */
    protected $id;
    /** @ORM\Column(type="string") */
    protected $title;
    /** @ORM\Column(type="string") */
    protected $slug;

    /*
     * @ORM\OneToMany(targetEntity="Post")
     * @var ArrayCollection|Post[]
     */
    protected $post;


    public function getPost()
    {
        $this->post;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param $slug
     */
    public function setSlug(string $slug)
    {
        $this->slug = str_slug($slug);
    }
}
