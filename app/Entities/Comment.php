<?php

namespace App\Entities;

use Doctrine\ORM\Mapping AS ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="comments")
 * @package App\Entities
 *
 * @property int $id
 * @property string $text
 * @property int $user_id
 * @property int $post_id
 * @property boolean $status
 * @property \DateTime $date
 */
class Comment
{
    const STATUS_WAITING_VERIFICATION = 0;
    const STATUS_PUBLIC = 1;

    /** @ORM\Id @ORM\Column(type="integer") @ORM\GeneratedValue */
    protected $id;

    /** @ORM\Column(type="string") */
    protected $text;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", onDelete="CASCADE")
     * @var Post
     */
    protected $user_id;

    /**
     * @ORM\ManyToOne(targetEntity="Post", inversedBy="comments")
     * @ORM\JoinColumn(name="post_id", referencedColumnName="id", onDelete="CASCADE")
     * @var Post
     */
    protected $post_id;

    /** @ORM\Column(type="boolean") */
    protected $status;

    /** @ORM\Column(type="date") */
    protected $date;

    /**
     * @param Post $post_id
     */
    public function setPostId(Post $post_id): void
    {
        $this->post_id = $post_id;
    }

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
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @param string $text
     */
    public function setText(string $text): void
    {
        $this->text = $text;
    }

    /**
     * @return int
     */
    public function getAuthor()
    {
        return $this->user_id;
    }

    /**
     * @param int $user_id
     */
    public function setUserId($user_id): void
    {
        $this->user_id = $user_id;
    }

    /**
     * @return int
     */
    public function getPostId(): int
    {
        return $this->post_id;
    }

    /**
     * @return bool
     */
    public function isStatus(): bool
    {
        return $this->status;
    }

    /**
     * @param bool $status
     */
    public function setStatus(bool $status): void
    {
        $this->status = $status;
    }

    /**
     * @return \DateTime
     */
    public function getDate(): \DateTime
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     */
    public function setDate(\DateTime $date): void
    {
        $this->date = $date;
    }

    public function toggleStatus(): void
    {
        // dd($this->status);
        if ($this->status == self::STATUS_WAITING_VERIFICATION) {
            $this->status = self::STATUS_PUBLIC;
        } else {
            $this->status = self::STATUS_WAITING_VERIFICATION;
        }
    }
}
