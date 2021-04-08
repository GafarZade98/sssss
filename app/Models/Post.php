<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'title',
        'description',
        'image',
        'content',
        'keyword',
        'item_id',
        'topic_id',
        'user_id',
        'file',
        'status',
    ];
    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    /**
     * @return BelongsTo
     */

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
    /**
     * @return BelongsTo
     */

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }
}
