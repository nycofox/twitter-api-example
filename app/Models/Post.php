<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'body'];

    protected $appends = ['user_name'];

    public function getUserNameAttribute()
    {
        return $this->user->name;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
