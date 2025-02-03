<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    /** @use HasFactory<\Database\Factories\CertificateFactory> */
    use HasFactory;

    protected $casts = [
        'verified' => 'boolean',
        'expiry_date' => 'datetime'
    ];

    protected $fillable = [
        'common_name',
        'country',
        'organization',
        'expiry_date',
        'status',
        'verified',
    ];
}
