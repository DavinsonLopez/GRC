<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    use HasFactory;

    protected $fillable = [
        'reporte_id',
        'user_id',
        'contenido',
    ];

    public function reporte()
    {
        return $this->belongsTo(Reporte::class);
    }
}
