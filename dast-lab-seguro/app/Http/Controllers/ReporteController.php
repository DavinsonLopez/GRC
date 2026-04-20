<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use App\Models\Reporte;
use Illuminate\Http\Request;

class ReporteController extends Controller
{
    public function dashboard()
    {
        if (!session('user_id')) {
            return redirect('/login')->with('error', 'Debes iniciar sesion.');
        }

        $totalReportes = Reporte::count();
        $conImagen = Reporte::whereNotNull('imagen')->count();
        $ultimos = Reporte::orderBy('id', 'desc')->limit(5)->get();

        return view('dashboard', compact('totalReportes', 'conImagen', 'ultimos'));
    }

    public function index()
    {
        if (!session('user_id')) {
            return redirect('/login')->with('error', 'Debes iniciar sesion.');
        }

        $reportes = Reporte::orderBy('id', 'desc')->get();

        return view('reportes.index', compact('reportes'));
    }

    public function create()
    {
        if (!session('user_id')) {
            return redirect('/login')->with('error', 'Debes iniciar sesion.');
        }

        return view('reportes.create');
    }

    public function store(Request $request)
    {
        if (!session('user_id')) {
            return redirect('/login')->with('error', 'Debes iniciar sesion.');
        }

        $validated = $request->validate([
            'titulo' => 'required|string|max:180',
            'descripcion' => 'nullable|string|max:5000',
            'imagen' => 'nullable|file|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $filename = uniqid('inc_', true) . '.' . $file->getClientOriginalExtension();
            $imagePath = $file->storeAs('uploads', $filename, 'public');
        }

        Reporte::create([
            'user_id' => session('user_id'),
            'titulo' => $validated['titulo'],
            'descripcion' => $validated['descripcion'] ?? null,
            'imagen' => $imagePath ? '/storage/' . $imagePath : null,
        ]);

        return redirect('/reportes')->with('status', 'Incidencia creada.');
    }

    public function show($id)
    {
        $reporte = Reporte::findOrFail($id);

        if ((int) $reporte->user_id !== (int) session('user_id')) {
            abort(403);
        }

        $comentarios = Comentario::where('reporte_id', $reporte->id)->orderBy('id', 'desc')->get();

        return view('reportes.show', compact('reporte', 'comentarios'));
    }

    public function edit($id)
    {
        if (!session('user_id')) {
            return redirect('/login')->with('error', 'Debes iniciar sesion.');
        }

        $reporte = Reporte::findOrFail($id);

        if ((int) $reporte->user_id !== (int) session('user_id')) {
            abort(403);
        }

        return view('reportes.edit', compact('reporte'));
    }

    public function update(Request $request, $id)
    {
        if (!session('user_id')) {
            return redirect('/login')->with('error', 'Debes iniciar sesion.');
        }

        $validated = $request->validate([
            'titulo' => 'required|string|max:180',
            'descripcion' => 'nullable|string|max:5000',
            'imagen' => 'nullable|file|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $reporte = Reporte::findOrFail($id);

        if ((int) $reporte->user_id !== (int) session('user_id')) {
            abort(403);
        }

        $reporte->titulo = $validated['titulo'];
        $reporte->descripcion = $validated['descripcion'] ?? null;

        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $filename = uniqid('inc_', true) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('uploads', $filename, 'public');
            $reporte->imagen = '/storage/' . $path;
        }

        $reporte->save();

        return redirect('/reportes/' . $reporte->id)->with('status', 'Reporte actualizado.');
    }

    public function destroy($id)
    {
        if (!session('user_id')) {
            return redirect('/login')->with('error', 'Debes iniciar sesion.');
        }

        $reporte = Reporte::findOrFail($id);

        if ((int) $reporte->user_id !== (int) session('user_id')) {
            abort(403);
        }

        $reporte->delete();

        return redirect('/reportes')->with('status', 'Incidencia eliminada.');
    }
}
