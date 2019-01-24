<?php

namespace App\Models\Post;

use App\Models\Category\Category;
use App\Models\Comment\Comment;
use App\Models\Tag\Tag;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Post
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string $content
 * @property string $description
 * @property int|null $category_id
 * @property int $status
 * @property int $views
 * @property int $is_featured
 * @property string $date
 * @property string $image
 * @property string $created_at
 * @property string $updated_at
 * @package App\Models\Post
 */
class Post extends Model
{
    use Sluggable;

    const STATUS_DRAFT = 0;
    const STATUS_PUBLIC = 1;

    protected $guarded = [];

    protected $casts = [
        'is_featured' => 'boolean'
    ];

    /**
     * Return the sluggable configuration array for this model.
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tags', 'post_id', 'tag_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function selectedTagsId(): array
    {
        return $this->tags->pluck('id')->all();
    }

    public function getTagsTitles(): string
    {
        return $this->tags->isEmpty() ? 'нет тегов' : implode(', ', $this->tags->pluck('title')->all());
    }
}