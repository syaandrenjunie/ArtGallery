<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;

class Favorite extends Model
{
    use HasRoles;
    use SoftDeletes;

    protected $fillable = ['user_id', 'artwork_id'];

    //Relationships
    public function user() {
        return $this->belongsTo(User::class);
        //each fav is for  one user
    }

    public function artwork() {
        return $this->belongsTo('Artwork::class');
    }
}
