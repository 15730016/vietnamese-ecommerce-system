<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'position',
        'description',
        'image',
        'email',
        'phone',
        'social_links',
        'order',
        'status',
    ];

    protected $casts = [
        'social_links' => 'array',
        'order' => 'integer',
        'status' => 'boolean',
    ];

    public function multimedia()
    {
        return $this->morphMany(Multimedia::class, 'multimediable');
    }

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc');
    }

    public function getFacebookUrlAttribute()
    {
        return $this->social_links['facebook'] ?? null;
    }

    public function getTwitterUrlAttribute()
    {
        return $this->social_links['twitter'] ?? null;
    }

    public function getLinkedinUrlAttribute()
    {
        return $this->social_links['linkedin'] ?? null;
    }

    public function getInstagramUrlAttribute()
    {
        return $this->social_links['instagram'] ?? null;
    }
}
