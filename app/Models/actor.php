<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class actor extends Model
{
    use HasFactory;
    public function film(){
        return $this->BelongsToMany(Film::class, 'aktor_film', 'id_aktor', 'id_film');
    }
}
