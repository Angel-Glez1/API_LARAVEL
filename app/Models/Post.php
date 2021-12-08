<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;


    const BORRADO = 1;
    const PUBLICADO = 2;
    protected $fillabel = [
        'name',
        'slug',
        'extract',
        'body',
        'status',
        'category_id',
        'user_id',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }


    // Relacion uno a muchos polimorficas
    public function iamges()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
