<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $table = 'media';

    protected $fillable = [
        'title',
        'type',
        'genre',
        'year',
        'duration',
        'episodes',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
