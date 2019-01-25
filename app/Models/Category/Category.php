<?php

namespace App\Models\Category;

use App\Models\Post\Post;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Category
 *
 * @property string $title
 * @property string $slug
 * @property string $create_at
 * @property string $update_at
 *
 * @package App\Models\Category
 */
class Category extends Model
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
        return $this->hasMany(Post::class);
    }
}
