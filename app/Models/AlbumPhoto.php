<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlbumPhoto extends Model
{
    use HasFactory;

    protected $fillable = [
        'album_id',
        'photo_path',
        'caption',
        'order',
    ];

    /**
     * Get the album that owns this photo.
     */
    public function album()
    {
        return $this->belongsTo(Album::class);
    }
}
