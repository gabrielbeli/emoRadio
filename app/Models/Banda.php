<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banda extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'imagem']; 

    public function albuns()
    {
        return $this->hasMany(Album::class);
    }
}
