<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;

    protected $table = 'albuns';

    protected $fillable = ['nome', 'banda_id', 'imagem'];

    public function banda()
    {
        return $this->belongsTo(Banda::class);
    }

    public function favoritos()
    {
    return $this->hasMany(Favorito::class);
    }

}
