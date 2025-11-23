<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Artwork extends Model
{
    /** @use HasFactory<\Database\Factories\ArtworkFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $table = 'artworks';

    protected $fillable = ['title', 'price', 'picture', 'artist_id', 'category_id'];

    public function artist()
    {
        return $this->belongsTo(Artist::class, 'artist_id');
        //an art is owned by an artist
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
        //an art is under a category
    }

    public function favorites(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'favorites')
            ->withTimestamps();
    }

    public function favoritesCount(): int
    {
        return $this->favorites()->count();
    }

    public function isFavoritedBy($userId): bool
    {
        return $this->favorites()->where('user_id', $userId)->exists();
    }
}
