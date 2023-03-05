<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Serie extends Model
{
    use HasFactory;
    protected $fillable = ['nome', 'cover'];
    protected $appends = ['links'];
    

    public function seasons()
    {
        return $this->hasMany(Season::class, 'serie_id');
    }
    public function episodes()
    {
        return $this->hasManyThrough(Episode::class, Season::class);
    }
    
    public function links(): Attribute
    {
        return new Attribute(
            get: fn () => [
                [
                    'rel' => 'self',
                    'url' => "/api/series/{$this->id}"
                ],
                [
                    'rel' => 'seasons',
                    'url' => "/api/series/{$this->id}/seasons"
                ],
                [
                    'rel' => 'episodes',
                    'url' => "/api/series/{$this->id}/episodes"
                ],
            ],
        );
    }
    
    public static function booted()
    {
        self::addGlobalScope('ordered', function (Builder $querybuilder) {
            $querybuilder->orderBy('nome');
        });
    }


}





