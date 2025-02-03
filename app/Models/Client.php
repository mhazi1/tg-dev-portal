<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    /** @use HasFactory<\Database\Factories\ClientFactory> */
    use HasFactory;

    protected $casts = [
        'verified' => 'boolean'
    ];

    protected $fillable = [
        'name',
        'role',
        'company',
        'verified'
    ];
}
