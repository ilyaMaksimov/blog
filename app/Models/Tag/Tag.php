<?php

namespace App\Models\Tag;

use App\Models\Post\Post;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Tag
 *
 * @property string $title
 * @property string $slug
 * @property string $create_at
 * @property string $update_at
 *
 * @package App\Models\Tag
 */
class Tag extends Model
{
    use Sluggable;

    protected $guarded = [];

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

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_tags', 'tag_id', 'post_id');
    }
}
