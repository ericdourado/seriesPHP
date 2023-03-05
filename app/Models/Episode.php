<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    use HasFactory;
    protected $fillable = ['number'];
    public $timestamps = false;
    protected $casts = [
        "watched" => 'boolean'
    ];

    public function season()
    {
        return $this->belongsTo(Season::class);
    }

    // protected function watched(): Attribute
    // {
    //     // return Attribute::make(
    //     //     get: fn ($value) => ucfirst($value),
    //     // );
    //     return new Attribute(
    //         get: fn($watched) => (bool)$watched,
    //     );
    // }

}
