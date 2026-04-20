<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use App\Models\Reporte;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{
    public function store(Request $request, $reporteId)
    {
        if (!session('user_id')) {
            return redirect('/login')->with('error', 'Debes iniciar sesion.');
        }

        $reporte = Reporte::findOrFail($reporteId);
        if ((int) $reporte->user_id !== (int) session('user_id')) {
            abort(403);
        }

        $validated = $request->validate([
            'contenido' => 'required|string|max:3000',
        ]);

        Comentario::create([
            'reporte_id' => $reporteId,
            'user_id' => session('user_id'),
            'contenido' => $validated['contenido'],
        ]);

        return redirect('/reportes/' . $reporteId)->with('status', 'Comentario agregado.');
    }
}
