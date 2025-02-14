<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory, HasUuids;

    protected $guarded = [];

    public function user() {
        return $this->belongsTo(User::class);
    }

    protected $casts = [
        'is_published' => 'boolean',
    ];

}
