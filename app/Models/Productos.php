<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
    use HasFactory;

    public function categorias(){

        return $this->belongsTo(Categorias::class, 'id_categoria');

    }

    public function marcas(){

        return $this->belongsTo(Marcas::class, 'id_marca');

    }

}
