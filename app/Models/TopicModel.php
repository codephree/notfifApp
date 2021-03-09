<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TopicModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'topic'
    ];

    protected static function boot()
    {
        parent::boot();

        TopicModel::saving(function ($topic) {
            //print_r($topic);
        });
    }
}
