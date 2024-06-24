<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections;
use Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection;

class Customer extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'balance',
        'address',
        'bio',
        'password',
        'birthday',
        'more',
        'is_active',
    ];

    protected $casts = [
        'more' => 'array',
        'is_active' => 'boolean',
    ];

    protected $dates = [
        'birthday',
    ];

}
