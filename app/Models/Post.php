<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Post extends Model
{
    use HasFactory;

    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = ['id', 'title', 'author', 'content','image' ];

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function setImageAttribute($value)
    {
        if (!empty($value)) {
            $filename = $value->getClientOriginalName();
            $location = storage_path('app/public/posts');
            $value->move($location, $filename);
            $this->attributes['image'] = $filename;
        }
    }
    public function getImageAttribute($value)

    {

        return asset('storage/posts/'.$value);

    }

}