<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artwork extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'status',
        'primary_art',
        'latitude',
        'longitude',
        'height',
        'width',
        'cost',
        'live',
        'created_by',
        'created_at',
        'updated_at'
    ];
}
