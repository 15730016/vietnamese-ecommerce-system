<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Multimedia extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'file_name',
        'file_path',
        'file_type',
        'mime_type',
        'size',
        'alt_text',
        'description',
        'uploaded_by',
    ];

    protected $casts = [
        'size' => 'integer',
        'uploaded_by' => 'integer',
    ];

    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    public function getFullUrlAttribute()
    {
        return asset('storage/' . $this->file_path);
    }

    public function isImage()
    {
        return str_starts_with($this->mime_type, 'image/');
    }

    public function isVideo()
    {
        return str_starts_with($this->mime_type, 'video/');
    }
}
