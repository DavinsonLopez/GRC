<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{
    public function store(Request $request, $reporteId)
    {
        // Vulnerabilidad: no se valida ni sanea el input para permitir XSS almacenado.
        Comentario::create([
            'reporte_id' => $reporteId,
            'user_id' => session('user_id'),
            'contenido' => $request->input('contenido'),
        ]);

        return redirect('/reportes/' . $reporteId)->with('status', 'Comentario agregado.');
    }
}
