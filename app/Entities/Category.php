<?php

namespace App\Entities;

use Doctrine\ORM\Mapping AS ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="doc_categories")
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

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getSlug()
    {
        return $this->title;
    }

    public function setSlug($slug)
    {
        $this->slug = str_slug($slug);
    }
}