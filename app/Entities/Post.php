<?php

namespace App\Entities;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping AS ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="posts")
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string $description
 * @property string $content
 * @property ArrayCollection|Category $category
 * @property boolean $is_public
 * @property boolean $is_featured
 * @property \DateTime $date
 * @property string $image
 * @property int $views
 * @property ArrayCollection|Tag[] $tags
 * @property ArrayCollection|Comment[] $comments
 */
class Post
{
    const STATUS_DRAFT = 0;
    const STATUS_PUBLIC = 1;

    const STANDARD_POST = 0;
    const FEATURED_POST = 1;

    /** @ORM\Id @ORM\Column(type="integer") @ORM\GeneratedValue */
    protected $id;

    /** @ORM\Column(type="string") */
    protected $title;

    /** @ORM\Column(type="string") */
    protected $slug;

    /** @ORM\Column(type="string") */
    protected $description;

    /** @ORM\Column(type="text") */
    protected $content;

    /**
     * @ORM\ManyToOne(targetEntity="Category")
     * @ORM\JoinColumn(name="category", referencedColumnName="id")
     * @var ArrayCollection|Category
     */
    protected $category;

    /** @ORM\Column(type="boolean") */
    protected $is_public;

    /** @ORM\Column(type="boolean") */
    protected $is_featured;

    /** @ORM\Column(type="date") */
    protected $date;

    /** @ORM\Column(type="string", nullable=true) */
    protected $image;

    /** @ORM\Column(type="integer", nullable=true) */
    protected $views;//, fetch="EAGER"
    /**
     * @ORM\ManyToMany(targetEntity="Tag" , fetch="EAGER")
     * @ORM\JoinTable(name="post_tags",
     *      joinColumns={@ORM\JoinColumn(name="post_id", referencedColumnName="id", onDelete="CASCADE")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="tag_id", referencedColumnName="id")}
     *      )
     * @var ArrayCollection|Tag[]
     */
    protected $tags;

    /**
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="post_id")
     * @var ArrayCollection|Comment[]
     */
    protected $comments;

    public function __construct()
    {
        $this->category = new ArrayCollection();
        $this->tags = new ArrayCollection();
        $this->comments = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param mixed $slug
     */
    public function setSlug($slug): void
    {
        $this->slug = str_slug($slug);
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content): void
    {
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     */
    public function setCategory(Category $category): void
    {
        $this->category = $category;
    }

    /**
     * @return mixed
     */
    public function isPublic()
    {
        return $this->is_public == self::STATUS_PUBLIC;
    }

    /**
     * @param int $status
     */
    public function setIsPublic(int $status): void
    {
        if ($this->checkStatus($status)) {
            throw new \InvalidArgumentException('wrong status');
        }

        $this->is_public = $status;
    }

    /**
     * @return mixed
     */
    public function getViews()
    {
        return $this->views;
    }

    /**
     * @param mixed $views
     */
    public function setViews($views): void
    {
        $this->views = $views;
    }

    /**
     * @return mixed
     */
    public function isFeatured()
    {
        return $this->is_featured;
    }

    /**
     * @param int $typePost
     */
    public function setIsFeatured(int $typePost): void
    {
        if ($this->checkTypePost($typePost)) {
            throw new \InvalidArgumentException('wrong status');
        }

        $this->is_featured = $typePost;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date->format('Y-m-d');
    }

    /**
     * @param mixed $date
     */
    public function setDate($date): void
    {
        $this->date = new \DateTime($date);
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image): void
    {
        $this->image = $image;
    }

    /**
     * @return Tag[]|ArrayCollection
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @param Tag|ArrayCollection $tag
     */
    public function addTag(Tag $tag): void
    {
        if (!$this->tags->contains($tag)) {
            $this->tags->add($tag);
        }
    }


    public function setTags(array $tags): void
    {
        foreach ($tags as $tag) {
            $this->addTag($tag);
        }
    }

    public function getStatusArray()
    {
        return [self::STATUS_PUBLIC, self::STATUS_DRAFT];
    }

    public function getTypePostArray()
    {
        return [self::STANDARD_POST, self::FEATURED_POST];
    }

    public function checkStatus($status)
    {
        return (!in_array($status, $this->getStatusArray(), false));
    }

    public function checkTypePost($status)
    {
        return (!in_array($status, $this->getTypePostArray(), false));
    }

    public function selectedTagsId()
    {
        $tags = $this->tags->getValues();
        $tagsIdArray = [];

        foreach ($tags as $tag) {
            $tagsIdArray[] = $tag->getId();
        }
        return $tagsIdArray;
    }

    public function getTagsTitles()
    {
        if ($this->tags->isEmpty()) {
            return 'нет тегов';
        }

        $tags = $this->tags->getValues();
        $tagsIdArray = [];

        foreach ($tags as $tag) {
            $tagsIdArray[] = $tag->getTitle();
        }
        return implode(', ', $tagsIdArray);
    }

    /**
     * @return Comment[]|ArrayCollection
     */
    public function getComments()
    {
        return $this->comments;
    }

    public function isDraft()
    {
        return $this->is_public == self::STATUS_DRAFT;
    }
}
