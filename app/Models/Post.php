<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        // 'id', 'created_at', 'updated_at'   هو يملأها لذلك لا نكتبها
        'user_id',
        'title',
        'content',
        'photo',
        'slug'
    ];
    protected $dates = ["deleted_at"];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

//    نضيفه ايضا بدون الحاجة لاي دي
    public function tag()
    {
        return $this->belongsToMany(Tag::class);
    }
}
