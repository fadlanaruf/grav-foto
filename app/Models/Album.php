<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;

    protected $fillable = [
        'reservation_id',
        'title',
        'description',
        'cover_image',
        'is_public',
    ];

    protected $casts = [
        'is_public' => 'boolean',
    ];

    /**
     * Get the reservation that owns this album.
     */
    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }

    /**
     * Get the photos for this album.
     */
    public function photos()
    {
        return $this->hasMany(AlbumPhoto::class)->orderBy('order');
    }
}
